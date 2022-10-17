<?php

namespace ApiStatus\Sql;

use ApiStatus\Cache\Redis;
use Phalcon\Db\Adapter\SybaseAccessor\Redis as Accessor;

/**
 * Class AccessMonitor
 * Class is intended to monitor number of connections to the DB.
 * Class depends from "racingpost/phalcon-ext" ^0.2.20
 * @since 0.1.34
 *
 * @package ApiStatus\Sql
 */
class AccessMonitor extends \ApiStatus\Status
{
    /**
     * @var \Redis|\RedisCluster
     */
    private $redis;

    protected $statuses = [
        'connection_count' => null,
        'connection_threshold' => null,
        'healthy' => true,
    ];

    /**
     * @param \Redis|\RedisCluster $redis
     *
     * @throws \BadMethodCallException
     * @return $this
     */
    public function setRedis($redis)
    {
        if (Redis::isRedis($redis)) {
            $this->redis = $redis;
        } else {
            throw new \BadMethodCallException(
                "Argument 1 passed to " . __METHOD__ . "() must be an instance of Redis or RedisCluster"
            );
        }

        return $this;
    }

    /**
     * @return \Redis|\RedisCluster
     */
    public function getRedis()
    {
        return $this->redis;
    }

    /**
     * @inheritdoc
     */
    public function obtainStatuses()
    {
        return function () {
            $this->statuses['connection_count'] = $this->getRedis()->zCount(
                Accessor::getKeyOfCounter($this->getConfig()),
                "-inf",
                "+inf"
            );
            $this->statuses['connection_threshold'] = $this->getConnectionThreshold();
            $this->statuses = (Object)$this->statuses;
        };
    }

    /**
     * @inheritdoc
     */
    private function getConnectionThreshold()
    {
        if (isset($this->getConfig()->database)
            && isset($this->getConfig()->database->connection)
            && isset($this->getConfig()->database->connection->threshold)
        ) {
            return (int)$this->getConfig()->database->connection->threshold;
        }
    }
}
