<?php

namespace RP\ContentAttributes\Strategy;

use Api\Input\Request;
use Phalcon\DiInterface;
use Phalcon\Exception;
use RP\ContentAttributes\Element\ContentAttributes;

/**
 *
 */
class Peer1KeyStrategy
{
    /**
     * @var \Phalcon\DiInterface
     */
    private $di;
    /**@var string */
    private $identifier = null;

    /**
     * @param DiInterface $di
     * @throws \Exception
     */
    public function __construct($di)
    {
        $this->di = $di;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        $domainPart = $this->getDomain();
        $requestParams = $this->getRequestParams();

        if ($this->identifier === null) {
            $identifier = $domainPart . $requestParams['_url'];

            if ($identifier[strlen($identifier) - 1] == '/') {//remove ending slash
                $identifier = substr($identifier, 0, -1);
            }

            $customRequest = $this->getCustomRequest();

            if ($customRequest instanceof \Phalcon\Input\Request) {
                $identifier .= $this->getQueryPartForCustomRequest($customRequest, $requestParams);
            } else {
                $identifier .= $this->getQueryPartForDefaultRequest($requestParams);
            }

            $version = (defined('PRODUCT_VERSION')) ? PRODUCT_VERSION : 0;
            $identifier .= '#' . $version;

            $this->identifier = $identifier;
        }
        return $this->identifier;
    }

    /**
     * @return \Phalcon\Http\Request
     */
    private function getRequest()
    {
        return $this->di->get('request');
    }

    /**
     * @return array
     */
    private function getParams()
    {
        $dispatcher = $this->di->getShared('dispatcher');
        return $dispatcher->getParams();
    }

    /**
     * Look for specific param in router, that contains field should be processed for response
     * @return array
     * @throws Exception
     */
    private function getInvolvedVars()
    {
        $router = $this->di->getShared('router');
        $params = $router->getParams();

        $vars = [];

        if (array_key_exists(ContentAttributes::KEY_ROUTER_INVOLVED_VARS, $params)) {
            $found = $params[ContentAttributes::KEY_ROUTER_INVOLVED_VARS];

            if (is_array($found)) {
                $vars = $found;
            } elseif (is_string($found)) {
                $vars = explode(',', $found);
                foreach ($vars as &$val) {
                    $val = trim($val);
                }
            } else {
                throw new Exception(
                    ContentAttributes::KEY_ROUTER_INVOLVED_VARS . ' may be only array or comma separated string.'
                );
            }
        }
        return $vars;
    }

    /**
     * @deprecated
     * @return array
     */
    private function getDefaultParams()
    {
        $router = $this->di->getShared('router');
        $params = $router->getParams();
        $matches = $router->getMatches();

        $default = [];

        $intersect = array_intersect($params, $matches);

        foreach ($params as $p => $param) {
            if (array_key_exists($p, $intersect)) {
                continue;
            }
            $default[$p] = $param;
        }

        return $default;
    }

    /**
     * Returns first part of key string
     * @return string
     */
    private function getDomain()
    {
        /**@var $request Request*/
        $request = $this->getRequest();
        $host = $request->getHttpHost();
        $tmp = explode(':', $host);
        $host = $tmp[0];
        $scheme = $request->getScheme();

        return "{$scheme}://{$host}";
    }

    /**
     * Returns query params from request
     * @return array
     */
    private function getRequestParams()
    {
        $request = $this->getRequest();
        return $request->getQuery();
    }

    /**
     * Checks and returns Request(mostly used in API) or null in other case
     * @return \Phalcon\Input\Request|null
     */
    private function getCustomRequest()
    {
        $dispatcherParams = $this->getParams();

        if (!empty($dispatcherParams) &&
            is_array($dispatcherParams) &&
            isset($dispatcherParams[0]) &&
            $dispatcherParams[0] instanceof \Phalcon\Input\Request) {
            return $dispatcherParams[0];
        }

        return null;
    }

    /**
     * Builds query part for Custom request
     * @param \Phalcon\Input\Request $customRequest
     * @param array $requestParams
     * @return string
     */
    private function getQueryPartForCustomRequest(\Phalcon\Input\Request $customRequest, $requestParams)
    {
        $part = '';
        $listNamedParameters = $customRequest->getNamedParameters();
        $listAcceptedParameters = array_intersect_key($requestParams, $listNamedParameters);
        if (!empty($listAcceptedParameters)) {
            ksort($listAcceptedParameters);
            $part =  '?' . http_build_query($listAcceptedParameters, null, '&', PHP_QUERY_RFC3986);
        }
        return $part;
    }

    /**
     * Builds query part for default request
     * @param array $requestParams
     * @return string
     */
    private function getQueryPartForDefaultRequest(array $requestParams)
    {
        $involvedVars = $this->getInvolvedVars();
        $part = '';
        sort($involvedVars);

        foreach ($involvedVars as $val) {
            if (isset($requestParams[$val])){
                $part .= "&{$val}={$requestParams[$val]}";
            }
        }

        if ($part != '') {
            $part[0] = '?';
        }

        return $part;
    }
}
