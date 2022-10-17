<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 4/14/2016
 * Time: 11:41 AM
 */

namespace Phalcon\Db\Adapter;

use Phalcon\Config;
use Phalcon\Db\Adapter\SybaseAccessor\ValidationException;

abstract class SybaseAccessor
{
    const KEY_SUFFIX = "_CONNECTION_COUNTER";
    const EXPIRES_SEC = 301;// 60*5 + 1 - five minutes plus one second

    private $config;

    public function __construct(Config $config)
    {
        if ($this->isValidConfig($config)) {
            $this->config = $config;
        } else {
            throw new ValidationException("A config for SybaseAccessor is not consistent!");
        }

        $this->setSettings();

        register_shutdown_function([$this, 'close']);
    }

    /**
     * Method returns TRUE if we can connect to the DB, and FALSE otherwise.
     * Also method registers new opened connection.
     *
     * @return boolean
     */
    abstract public function open();

    /**
     * Method registers the closing of connection
     */
    abstract protected function close();

    /**
     * @param Config  $config
     * return boolean
     */
    abstract protected function isValidConfig(Config $config);

    /**
     * @return \Phalcon\Db\Adapter\SybaseAccessor
     */
    abstract protected function setSettings();

    /**
     * @throws \Exception
     * @return \Phalcon\Config
     */
    protected function getConfig()
    {
        return $this->config;
    }
}
