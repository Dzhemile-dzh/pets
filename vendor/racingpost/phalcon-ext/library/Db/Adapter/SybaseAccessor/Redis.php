<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 4/15/2016
 * Time: 2:04 PM
 */

namespace Phalcon\Db\Adapter\SybaseAccessor;

use Phalcon\DI;
use Phalcon\Config;

class Redis extends \Phalcon\Db\Adapter\SybaseAccessor
{
    private $redis;
    private $connectionId;
    private $connectionCounterKey;
    private $threshold;
    private $retryPossibleNumber;
    private $connectionInterval;
    private $zScore;

    /**
     * return boolean
     */
    public function open()
    {
        for ($i = 0; $i < $this->retryPossibleNumber; $i++) {
            $numConnection = $this->redis->zCount($this->connectionCounterKey, "-inf", "+inf");

            if ($numConnection < $this->threshold) {
                $this->zScore = time();
                $this->redis->zAdd($this->connectionCounterKey, $this->zScore, $this->connectionId);
                return true;
            } elseif (!$this->cleanUpConnections()) {
                usleep($this->connectionInterval);
            }
        }
        return false;
    }

    /**
     * Method cleans up data related with connections
     */
    public function close()
    {
        if (!is_null($this->redis) && !is_null($this->connectionCounterKey) && !is_null($this->connectionId)) {
            $this->redis->zRem($this->connectionCounterKey, $this->connectionId);
        }
    }

    /**
     * @throws \Exception
     * @return \Phalcon\Db\Adapter\SybaseAccessor
     */
    protected function setSettings()
    {
        if (!DI::getDefault()->has('redis')) {
            throw new ValidationException("The 'Redis' service does not exist");
        }
        $this->redis = DI::getDefault()->getShared('redis');
        $this->connectionId = uniqid();

        //we cast milliseconds to microseconds for using in 'usleep' function
        $this->connectionInterval = $this->getConfig()->database->connection->interval * 1000;
        $this->connectionCounterKey = self::getKeyOfCounter($this->getConfig());
        $this->threshold = $this->getConfig()->database->connection->threshold;
        $this->retryPossibleNumber = $this->getConfig()->database->connection->retrynumber;

        return $this;
    }

    public function isValidConfig(Config $config)
    {
        if (isset($config->database)
            && isset($config->database->servername)
            && isset($config->database->connection)
            && isset($config->database->connection->interval)
            && isset($config->database->connection->threshold)
            && isset($config->database->connection->retrynumber)
        ) {
            return true;
        }
        return false;
    }

    /**
     * @param Config $config
     *
     * @return string
     * @throws ValidationException
     */
    public static function getKeyOfCounter(Config $config)
    {
        if (isset($config->database) && isset($config->database->servername)) {
            return $config->database->servername . static::KEY_SUFFIX;
        }
        throw new ValidationException("Impossible to retrieve key of a counter");
    }

    /**
     * Method returns amount of deleted connections
     *
     * @return integer
     */
    private function cleanUpConnections()
    {
        $countRemovedConnections = $this->redis->zRemRangeByScore($this->connectionCounterKey, 0, time() - static::EXPIRES_SEC);
        return $countRemovedConnections;
    }
}
