<?php
namespace Rp;

use \Phalcon\Logger\Adapter\File as FileLogger;
use \Phalcon\Logger\Adapter\Dummy as NullLogger;
use Rp\Exception\LoggerConfigurationError;

/**
 * Class Logger
 * @package Rp
 */
class Logger
{
    const REQUEST_TAG_PARAMETER_NAME = 'tag';
    const REQUEST_TAG_DEFAULT = '-';

    /**
     * @var \Phalcon\Logger\AdapterInterface
     */
    private $loggerAggregate;

    protected $mapLevel = [
        'FATAL'     => \Phalcon\Logger::EMERGENCY,  // FATAL
        'EMERGENCY' => \Phalcon\Logger::EMERGENCY,
        'CRITICAL'  => \Phalcon\Logger::CRITICAL,
        'ALERT'     => \Phalcon\Logger::ALERT,
        'ERROR'     => \Phalcon\Logger::ERROR,
        'WARNING'   => \Phalcon\Logger::WARNING,
        'WARN'      => \Phalcon\Logger::WARNING,
        'NOTICE'    => \Phalcon\Logger::NOTICE,
        'INFO'      => \Phalcon\Logger::INFO,
        'DEBUG'     => \Phalcon\Logger::DEBUG,
        'CUSTOM'    => \Phalcon\Logger::CUSTOM,
        'SPECIAL'   => \Phalcon\Logger::SPECIAL,
        'TRACE'     => \Phalcon\Logger::SPECIAL,  // TRACE
    ];

    /**
     * Logger constructor.
     *
     * @param null $configuration
     */
    public function __construct($configuration = null)
    {
        $this->loggerAggregate = $this->createAggregateInstance($configuration);
    }

    /**
     * @deprecated
     *
     * @param $message
     *
     * We can pass more parameters. They is used to create the message.
     *
     * @return $this
     */
    public function trace($message)
    {
        $arguments = array_slice(func_get_args(), 1);
        array_unshift($arguments, (string)$message);

        array_unshift($arguments, \Phalcon\Logger::SPECIAL);

        call_user_func_array([$this->loggerAggregate, 'log'], $arguments);
        return $this;
    }

    /**
     * @param string $message
     *
     * We can pass more parameters. They is used to create the message.
     *
     * @return $this
     */
    public function debug($message)
    {
        $arguments = array_slice(func_get_args(), 1);
        array_unshift($arguments, (string)$message);

        call_user_func_array([$this->loggerAggregate, 'debug'], $arguments);
        return $this;
    }

    /**
     * @param string $message
     *
     * We can pass more parameters. They is used to create the message.
     *
     * @return $this
     */
    public function info($message)
    {
        $arguments = array_slice(func_get_args(), 1);
        array_unshift($arguments, (string)$message);

        call_user_func_array([$this->loggerAggregate, 'info'], $arguments);
        return $this;
    }

    /**
     * @param string $message
     *
     * We can pass more parameters. They is used to create the message.
     *
     * @return $this
     */
    public function notice($message)
    {
        $arguments = array_slice(func_get_args(), 1);
        array_unshift($arguments, (string)$message);

        call_user_func_array([$this->loggerAggregate, 'notice'], $arguments);
        return $this;
    }

    /**
     * @param string $message
     *
     * We can pass more parameters. They is used to create the message.
     *
     * @return $this
     */
    public function warning($message)
    {
        $arguments = array_slice(func_get_args(), 1);
        array_unshift($arguments, (string)$message);

        call_user_func_array([$this->loggerAggregate, 'warning'], $arguments);
        return $this;
    }

    /**
     * @param string $message
     *
     * We can pass more parameters. They is used to create the message.
     *
     * @return $this
     */
    public function alert($message)
    {
        $arguments = array_slice(func_get_args(), 1);
        array_unshift($arguments, (string)$message);

        call_user_func_array([$this->loggerAggregate, 'alert'], $arguments);
        return $this;
    }

    /**
     * @param string $message
     *
     * We can pass more parameters. They is used to create the message.
     *
     * @return $this
     */
    public function error($message)
    {
        $arguments = array_slice(func_get_args(), 1);
        array_unshift($arguments, (string)$message);

        call_user_func_array([$this->loggerAggregate, 'error'], $arguments);
        return $this;
    }

    /**
     * @param string $message
     *
     * We can pass more parameters. They is used to create the message.
     *
     * @return $this
     */
    public function fatal($message)
    {
        $arguments = array_slice(func_get_args(), 1);
        array_unshift($arguments, (string)$message);

        call_user_func_array([$this->loggerAggregate, 'emergency'], $arguments);
        return $this;
    }

    /**
     * @param $message
     *
     * We can pass more parameters. They is used to create the message.
     *
     * @return $this
     */
    public function emergency($message)
    {
        $arguments = array_slice(func_get_args(), 1);
        array_unshift($arguments, (string)$message);

        call_user_func_array([$this->loggerAggregate, 'emergency'], $arguments);
        return $this;
    }

    /**
     * @param string $message
     *
     * We can pass more parameters. They is used to create the message.
     *
     * @return $this
     */
    public function log($message)
    {
        call_user_func_array([$this->loggerAggregate, 'log'], func_get_args());
        return $this;
    }

    /**
     * @codeCoverageIgnore
     *
     * Create instance of inner logger
     *
     * @param null|array $configuration
     *
     * @return \Phalcon\Logger\AdapterInterface ;
     * @throws LoggerConfigurationError
     */
    protected function createAggregateInstance(array $configuration = [])
    {
        $filename = isset($configuration['filename']) ? $configuration['filename'] : null;
        $options = isset($configuration['options']) ? $configuration['options'] : null;

        if (is_null($filename)) {
            $logger = new NullLogger();
        } else {
            $logger = new FileLogger($filename, $options);
        }

        $logger->setFormatter($this->createFormatter($this->findRequestTag($configuration)));

        if (isset($configuration['level'])) {
            $logger->setLogLevel($this->mapLogLevel($configuration['level']));
        }

        return $logger;
    }

    /**
     * @param $configuration
     * @return string
     */
    protected function findRequestTag($configuration) {
        if (!array_key_exists(Logger::REQUEST_TAG_PARAMETER_NAME, $configuration)) {
            return Logger::REQUEST_TAG_DEFAULT;
        }

        return $configuration[Logger::REQUEST_TAG_PARAMETER_NAME];
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $requestTag
     * @return Formatter
     */
    protected function createFormatter($requestTag)
    {
        return new Formatter($requestTag);
    }

    /**
     * @codeCoverageIgnore
     * @param $level
     *
     * @return mixed
     */
    protected function mapLogLevel($level) {
        $level = strtoupper(trim($level));
        if (isset($this->mapLevel[$level])) {
            return $this->mapLevel[$level];
        }
        return \Phalcon\Logger::SPECIAL;
    }
}
