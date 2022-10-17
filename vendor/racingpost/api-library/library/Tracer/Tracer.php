<?php

namespace API\Tracer;

use DDTrace\Encoders\Json;
use DDTrace\Tracer as DDTracer;
use DDTrace\Transport\Http;
use DDTrace\GlobalTracer;
use DDTrace\Tag as Tag;

/**
 * Class Tracer
 * @package RP\Trace
 *
 * Wrapper for DDTrace.  Simplifies usage of traces.
 *
 * TODO: If sub spans are not closed when closing the root span (e.g. when exception is thrown), the root span is not logged to dd
 * TODO: Handle database query spans
 * TODO: Handle redis query spans
 */
class Tracer
{
    protected $tracer;
    protected $span;
    protected $scope;
    protected $definedSpans = [];
    protected $definedScopes = [];
    protected $rootSpanName = 'api_request';

    public function __construct()
    {
        // where to send the logs
        if (!empty($_SERVER['DATADOG_TRACE_AGENT_HOSTNAME'])) {
            $ddTraceEndpoint = 'http://' . $_SERVER['DATADOG_TRACE_AGENT_HOSTNAME'] . ':8126/v0.3/traces';
        } else {
            $ddTraceEndpoint = 'http://localhost:8126/v0.3/traces';
        }

        // Creates a tracer with default transport and default propagators
        $config = [
            'service_name' => str_replace('_', '-', PRODUCT_KEY), // The name of the service.
            'enabled' => true, // If tracer is not enabled, all spans will be created as noop.
            'global_tags' => [
                'env' => strtolower($this->envName()),
                'request_source' => empty($this->getHeader('X-API-Key')) ? 'B2C' : 'B2B',
                'b2b-client' => $this->getHeader('X-API-Customer', ''),
                'traffic-source' => $this->getHeader('X-Traffic-Source', ''),
                'product' => sprintf("%s v%d", strtolower(PRODUCT_KEY), PRODUCT_VERSION),
                'service' => sprintf("%s v%d", strtolower(PRODUCT_KEY), PRODUCT_VERSION),
                'version' => (isset($_SERVER['PRODUCT_BRANCH']) ? $_SERVER['PRODUCT_BRANCH'] : ''),
            ], // Set of tags being added to every span.
            'endpoint' => $ddTraceEndpoint,
        ];

        $config['global_tags'] = array_merge($config['global_tags'], $this->parseTagsFromRequestHeader());

        $resourceName = $_SERVER['REQUEST_URI'];
        // munge the url to replace the variable elements with underscore
        $datesAndNumbersFromURL = [];
        $extractCount = preg_match_all('/(\d+-\d+-\d+)|(\d+)/', $resourceName, $datesAndNumbersFromURL);  // extract dates and numbers

        if ($extractCount) {
            $datesAndNumbersFromURL = implode('; ', $datesAndNumbersFromURL[0]);
            $resourceName = preg_replace('/\d+-\d+-\d+|\d+/', '_', $_SERVER['REQUEST_URI']);
            $config['global_tags']['url_variables'] = $datesAndNumbersFromURL;
        }

        $transport = new Http(new Json(), null, $config);
        $this->tracer = new DDTracer(
            $transport,
            null,
            $config
        );

        // Sets a global tracer (singleton). Ideally tracer should be
        // injected as a dependency
        GlobalTracer::set($this->tracer);

        // Flushes traces to agent.
        register_shutdown_function(function () {
            GlobalTracer::get()->flush();
        });

        // start the root span
        $this->span = $this->startSpan($this->rootSpanName);
        $this->span->setTag(Tag::SPAN_TYPE, 'web');
        $this->span->setTag(Tag::RESOURCE_NAME, $_SERVER['REQUEST_METHOD'] . ' ' . $resourceName);
    }

    /**
     * @param $spanName
     * @return \DDTrace\Span|\DDTrace\Contracts\Span
     */
    public function startSpan($spanName)
    {
        // span needs a scope
        $this->scope = $this->makeScope($spanName);
        // remember the span for later use
        $this->definedSpans[$spanName] = $this->scope->getSpan();

        return $this->definedSpans[$spanName];
    }

    /**
     * @param $spanName
     * @return \DDTrace\Contracts\Scope
     */
    protected function makeScope($spanName): \DDTrace\Contracts\Scope
    {
        $this->definedScopes[$spanName] = $this->tracer->startActiveSpan(strtolower($spanName));
        // remember the scope for later use
        return $this->definedScopes[$spanName];
    }

    /**
     * @param $spanName
     * @param $tagName
     * @param $tagValue
     * @return bool
     *
     * Tag name can be any string but there are some tag name with special meanings in dd.  E.g. http.status_code
     * Tag values - ensure that int or floats are used as required as these may be turned into measurable values in dd
     */
    public function setTagForSpan($spanName, $tagName, $tagValue)
    {
        if (is_object($this->definedSpans[$spanName])) {
            $this->definedSpans[$spanName]->setTag($tagName, $tagValue);
            return true;
        }

        return false;
    }

    public function closeSpan($spanName)
    {
        if (is_object($this->definedScopes[$spanName])) {
            $this->definedScopes[$spanName]->close();
        }
    }

    /**
     * @param $tagName
     * @param $tagValue
     * @return mixed|null
     */
    public function setTagForRootSpan($tagName, $tagValue)
    {
        return $this->setTagForSpan($this->rootSpanName, $tagName, $tagValue);
    }

    /**
     * @param $spanName
     * @param $error
     * @return mixed|null
     */
    public function setErrorForSpan($spanName, $error)
    {
        return $this->setTagForSpan($spanName, Tag::ERROR, $error);
    }

    /**
     * @param $error
     * @return mixed|null
     */
    public function setErrorForRootSpan($error)
    {
        return $this->setErrorForSpan($this->rootSpanName, $error);
    }

    /**
     * @param $httpStatus
     * @return mixed|null
     */
    public function setHttpStatus($httpStatus)
    {
        return $this->setTagForRootSpan(Tag::HTTP_STATUS_CODE, (int)$httpStatus);
    }

    public function finalise(): void
    {
        $this->closeSpan($this->rootSpanName);
        GlobalTracer::get()->flush();
    }

    /**
     * @param $headerName
     * @param null $defaultValue
     * @return string
     */
    protected function getHeader($headerName, $defaultValue = null)
    {
        $headers = getallheaders();
        return isset($headers[$headerName]) ? filter_var(trim($headers[$headerName]), FILTER_SANITIZE_STRING) : $defaultValue;
    }

    /**
     * @return string
     */
    protected function envName()
    {
        $map = [
            'PR' => 'UAT',
            'LIVE' => 'PRODUCTION'
        ];

        $reportedEnv = strtoupper($_SERVER['RP_ENVIRONMENT']);

        return isset($map[$reportedEnv]) ? $map[$reportedEnv] : $reportedEnv;
    }

    protected function parseTagsFromRequestHeader()
    {
        // Example of request header ('X-APMTags') -> rp-component=homepage; rp-version=1.2.0;
        $tagString = $this->getHeader('X-APMTags', '');
        $parsedTags = [];
        $tags = explode(';', $tagString);
        foreach ($tags as $tag) {
            $tag = filter_var(trim($tag), FILTER_SANITIZE_STRING);
            if (!empty($tag)) {
                $parts = explode('=', $tag);
                $parsedTags[trim($parts[0])] = trim($parts[1]);
            }
        }

        return $parsedTags;
    }
}
