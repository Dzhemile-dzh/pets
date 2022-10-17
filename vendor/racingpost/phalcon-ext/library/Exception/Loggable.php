<?php
namespace Phalcon\Exception;

use Phalcon\DI;
use Phalcon\Exception;
use Phalcon\Logger\AdapterInterface;

/**
 * Common exception that writes error message to log
 *
 * @package Phalcon\Exception
 * @author Roman Kelemen <roman.kelemen@racingpost.com>
 */
abstract class Loggable extends Exception
{
    /**
     * Logger instance to write logs
     * @var AdapterInterface
     */
    protected $logger;

    /**
     * @var array
     */
    protected $context = [];

    /**
     * @inheritdoc
     * @param AdapterInterface $logger Logger instance
     * @param string $message
     * @param int $code
     */
    public function __construct(AdapterInterface $logger, $message = "", array $context = [], $code = 0, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
        $this->logger = $logger;
        $this->context = $context;
        $this->logError($this->getLogMessage(), $this->getContext());
    }

    /**
     * Build log message
     *
     * @return string
     */
    public function getLogMessage()
    {
        return sprintf('%s thrown with message "%s" in file %s (%d)',
            get_class($this),
            $this->getMessage(),
            $this->getFile(),
            $this->getLine()
        );
    }

    /**
     * Build logger context
     *
     * @return array
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * Get logger instance
     *
     * @return \Phalcon\Logger\AdapterInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * Write error to log
     *
     * @param string $message
     * @param array $context
     */
    abstract protected function logError($message, array $context);
}