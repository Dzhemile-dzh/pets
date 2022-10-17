<?php
namespace Phalcon\Logger\Adapter;

use Phalcon\Logger\AdapterInterface;
use Phalcon\Logger\FormatterInterface;

/**
 * Class Dummy
 * @package Phalcon\Logger\Adapter
 */
class Dummy implements AdapterInterface
{
    /**
     * @param FormatterInterface $formatter
     * @return $this
     */
    public function setFormatter(FormatterInterface $formatter)
    {
        return $this;
    }

    /**
     * Returns the internal formatter
     */
    public function getFormatter()
    {
        return null;
    }

    /**
     * Filters the logs sent to the handlers to be greater or equals than a specific level
     */
    public function setLogLevel($level)
    {
        return $this;
    }

    /**
     * Returns the current log level
     */
    public function getLogLevel()
    {
        return null;
    }

    /**
     * Sends/Writes messages to the file log
     */
    public function log($type, $message = null, array $context = null)
    {
        return $this;
    }

    /**
     * Starts a transaction
     */
    public function begin()
    {
        return $this;
    }

    /**
     * Commits the internal transaction
     */
    public function commit()
    {
        return $this;
    }

    /**
     * Rollbacks the internal transaction
     */
    public function rollback()
    {
        return $this;
    }

    /**
     * Closes the logger
     */
    public function close()
    {
        return null;
    }

    /**
     * Sends/Writes a debug message to the log
     */
    public function debug($message, array $context = null)
    {
        return $this;
    }

    /**
     * Sends/Writes an error message to the log
     */
    public function error($message, array $context = null)
    {
        return $this;
    }

    /**
     * Sends/Writes an info message to the log
     */
    public function info($message, array $context = null)
    {
        return $this;
    }

    /**
     * Sends/Writes a notice message to the log
     */
    public function notice($message, array $context = null)
    {
        return $this;
    }

    /**
     * Sends/Writes a warning message to the log
     */
    public function warning($message, array $context = null)
    {
        return $this;
    }

    /**
     * Sends/Writes an alert message to the log
     */
    public function alert($message, array $context = null)
    {
        return $this;
    }

    /**
     * Sends/Writes an emergency message to the log
     */
    public function emergency($message, array $context = null)
    {
        return $this;
    }
}
