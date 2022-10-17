<?php

namespace Rp;

/**
 * Class Formatter
 * @package Rp
 */
class Formatter extends \Phalcon\Logger\Formatter
{
    const PATTERN = '{datetime} - {type} - {request_method}: {httd_host} {request_uri} - [{request_tag}] - {message}{eol}';

    /**
     * @var string
     */
    protected $requestTag;

    /**
     * Formatter constructor.
     * @param string $requestTag
     */
    public function __construct($requestTag)
    {
        $this->requestTag = $requestTag;
    }

    /**
     * @param      $message
     * @param      $type
     * @param      $timestamp
     * @param null $context
     *
     * @return string
     */
    public function format($message, $type, $timestamp, $context = null)
    {
        $microtime = $this->getMicrotime();

        $map = [
            'eol'               => PHP_EOL,
            'datetime'          => $this->formatDate($microtime),
            'message'           => $this->getMessage($message, $context),
            'type'              => $this->getTypeString($type),
            'request_method'    => $_SERVER['REQUEST_METHOD'],
            'httd_host'         => $_SERVER['HTTP_HOST'],
            'request_uri'       => $_SERVER['REQUEST_URI'],
            'request_tag'       => $this->requestTag,
        ];

        return $this->interpolate(self::PATTERN, $map);
    }

    /**
     *
     *
     * @param string $microtime
     *
     * @return string
     */
    public function formatDate($microtime)
    {
        list($micro, $timestamp) = explode(' ', $microtime);

        $dateTime = $this->getDatetime()
            ->setTimestamp($timestamp)
            ->format('Y-m-d H:i:s');

        $right = sprintf('%\'.03d', round($micro * 1000));
        return $dateTime . '.' . $right;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return mixed
     */
    protected function getMicrotime()
    {
        return microtime();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \DateTime
     */
    protected function getDatetime()
    {
        return new \DateTime();
    }

    /**
     * Format message based on params array
     *
     * Elements of second argument will be passed as rest arguments of sprintf
     * It is possible to lazy-call object methods on log write
     * For this, as one of params pass array where first element will be object link, second - method name.
     * Array elements starting from third will be passed as method arguments:
     *
     * <code>
     *   $this->error('This is %s URL: %s!', 'awesome', [$url, 'formatUrl', 'canonical']);
     * </code>
     * In this example message will be an execution result of the next code:
     * <code>
     *   sprintf('This is %s URL: %s!', 'awesome', $url->formatUrl('canonical'));
     * </code>
     *
     * Another example:
     * <code>
     *   $this->error('This is result of first call %s and this is result of second: %s', [$object1, 'method1'], [$object2, 'method2', 'arg1', $arg2])
     * </code>
     * equals to:
     * <code>
     *   sprintf('This is result of first call %s and this is result of second: %s', $object1->method1(), $object2->method2('arg1', $arg2));
     * </code>
     *
     * @param string $message
     * @param array $params
     *
     * @return string
     */
    private function getMessage($message, $params = null)
    {
        if (empty($params) || !is_array($params)) {
            return $message;
        }

        $preparedParams = [];
        foreach ($params as $param) {
            if (is_array($param) && sizeof($param) >= 2 && is_object($param[0])) {
                if(method_exists($param[0], $param[1])) {
                    $preparedParams[] = call_user_func_array([$param[0], $param[1]], array_slice($param, 2));
                } else {
                    $preparedParams[] = sprintf('%s::%s(%s)', get_class($param[0]), $param[1], implode(', ', array_slice($param, 2)));
                }
            } else {
                $preparedParams[] = $param;
            }
        }

        return vsprintf($message, $preparedParams);
    }
}
