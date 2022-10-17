<?php

namespace Phalcon\Cache\Factory;

use Api\Config;
use Phalcon\Adapter\RedisCache;
use Phalcon\Cache\Frontend\Output;
use Phalcon\Cache\Indexer\RedisIndexer;
use Phalcon\Cache\Locker\RedisClusterLocker;
use Phalcon\Cache\Response\Peer1ResponseProcessor;
use Phalcon\Mvc\User\Component;
use RP\Cache\Core\Factory\ICacheComponent;
use RP\Cache\Core\Indexer\IndexerInterface;
use RP\Cache\LifeTime;
use RP\ContentAttributes\Element\ContentAttributes;

/**
 * Class LegacyCacheComponent
 * Default cache component factory - suitable for Peer1 like caching
 *
 * @package RP\Cache\Factory
 * @copyright 2015 Racing Post
 * @codeCoverageIgnore
 */
class Peer1CacheComponent extends Component implements ICacheComponent
{
    const CONFIG_CACHE_KEY = 'redis';
    const CONFIG_CACHE_KEY_LIFETIME = 'lifetime';
    const DEFAULT_CACHE_LIFETIME = LifeTime::LONG;

    /**
     * @var \RedisCluster
     */
    protected $redis;
    private $contentAttributes;
    private $config;

    public function __construct(\RedisCluster $redisCluster, ContentAttributes $contentAttributes, \Phalcon\Config $config = null)
    {
        $this->redis = $redisCluster;
        $this->contentAttributes = $contentAttributes;
        $this->config = $config;
    }

    /**
     * @return \Phalcon\Cache\BackendInterface
     * @throws Exception
     */
    public function createAdapter()
    {
        $frontend = new Output([
            'lifetime' => LifeTime::readPredefinedLifeTime(self::DEFAULT_CACHE_LIFETIME)
        ]);

        return new RedisCache($frontend, $this->redis);
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->contentAttributes->tags()->getUniqueKey();
    }

    /**
     * @return \RP\Cache\Core\IResponseDTO
     */
    public function createResponseDTO()
    {
        return new Peer1ResponseProcessor();
    }

    /**
     * @return IndexerInterface
     */
    public function createIndexer()
    {
        if ($this->config !== null && $this->config->offsetExists('redis')) {
            $weight = $this->config->get('redis')->get('weight', 0);
        } else {
            $weight = 0;
        }

        return new RedisIndexer($this->redis, $this->contentAttributes, $weight);
    }

    public function createLocker()
    {
        return new RedisClusterLocker($this->redis);
    }
}
