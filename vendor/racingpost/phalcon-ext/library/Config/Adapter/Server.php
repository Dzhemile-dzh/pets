<?php
namespace Phalcon\Config\Adapter;

use Phalcon\Config;
use Phalcon\Config\Exception;
use Phalcon\DI\InjectionAwareInterface;
use Phalcon\DiInterface;
use Phalcon\Logger;

/**
 * Used as read-only server variables collection
 * Throws exceptions on any attempt to write variable or to get undefined variable
 *
 * @package Phalcon\Config\Adapter
 * @author Roman Kelemen <roman.kelemen@racingpost.com>
 */
class Server extends Config implements InjectionAwareInterface
{
    const DEFAULT_LOGGER_KEY = 'logger';

    /**
     * @var DiInterface
     */
    private $_di;

    /**
     * @var string
     */
    private $_loggerServiceKey;

    /**
     * Constructor. No parameters required
     *
     * @param string $loggerServiceKey
     */
    public function __construct($loggerServiceKey = self::DEFAULT_LOGGER_KEY)
    {
        parent::__construct($_SERVER);
        $this->_loggerServiceKey = $loggerServiceKey;
    }

    /**
     * @return DiInterface
     */
    public function getDi()
    {
        return $this->_di;
    }

    /**
     * @param DiInterface $di
     */
    public function setDi(\Phalcon\DiInterface $di)
    {
        $this->_di = $di;
    }

    /**
     * Trying to get logger instance from DI
     *
     * @return null|\Phalcon\DI\ServiceInterface
     */
    public function getLogger()
    {
        if (!$this->getDi() || !$this->getDi()->has($this->_loggerServiceKey)) {
            return null;
        }

        $logger = $this->getDi()->get($this->_loggerServiceKey);
        if (!($logger instanceof \Phalcon\Logger\AdapterInterface)) {
            return null;
        }

        return $logger;
    }
    
    protected function triggerError($message)
    {
        return trigger_error($message, E_USER_ERROR);
    }
}
