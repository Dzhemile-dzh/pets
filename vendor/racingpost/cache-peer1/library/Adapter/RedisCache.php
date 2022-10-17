<?php

namespace Phalcon\Adapter;

use \Phalcon\Cache\Backend;
use \Phalcon\Cache\Exception;
use \Phalcon\Cache\BackendInterface;
use \Phalcon\Cache\FrontendInterface;
use DDTrace\Tags as Tags;

class RedisCache extends Backend implements BackendInterface
{

    /**
     * @var $redis \Redis
     */
    protected $redis = null;

    /**
     * Phalcon\Cache\Backend\Redis constructor
     *
     * @param FrontendInterface $frontend
     * @param array | \Redis | \RedisCluster options
     *
     * @throws Exception
     * @internal param FrontendInterface $frontend
     */
    public function __construct(FrontendInterface $frontend, $options = null)
    {
        if (($options instanceof \Redis) || ($options instanceof \RedisCluster)) {
            $this->redis = $options;
        } else {
            if (!is_array($options)) {
                $options = [];
            }

            if (!isset($options["host"])) {
                throw new Exception('Element host is not found in config array.');
            }

            if (!isset($options["port"])) {
                throw new Exception('Element port is not found in config array.');
            }

            if (!isset($options["index"])) {
                $options["index"] = 0;
            }

            if (!isset($options["persistent"])) {
                throw new Exception('Element persistent is not found in config array.');
            }
        }

        parent::__construct($frontend, $options);
    }

    /**
     * Create internal connection to redis
     * @codeCoverageIgnore
     */
    public function _connect()
    {
        if ($this->redis === null) {
            $options = $this->_options;
            $redis = new \Redis();

            if ($options["persistent"]) {
                $success = $redis->pconnect($options["host"], $options["port"]);
            } else {
                $success = $redis->connect($options["host"], $options["port"]);
            }

            if (!$success) {
                throw new Exception("Could not connect to the Redisd server " . $options["host"] . ":" . $options["port"]);
            }

            if (isset($options["auth"])) {
                $success = $redis->auth($options['auth']);

                if (!$success) {
                    throw new Exception("Failed to authenticate with the Redisd server");
                }
            }

            if (isset($options["index"])) {
                $success = $redis->select($options["index"]);

                if (!$success) {
                    throw new Exception("Redisd server selected database failed");
                }
            }

            $this->redis = $redis;
        }
    }

    /**
     * @return array|null|\Redis|\RedisCluster
     * @codeCoverageIgnore
     */
    private function getRedis()
    {
        $redis = $this->redis;
        if (!is_object($redis)) {
            $this->_connect();
            $redis = $this->redis;
        }
        return $redis;
    }

    /**
     * Returns a cached content
     *
     * @param int|string keyName
     * @param   long lifetime
     * @return  mixed
     */
    public function get($keyName, $lifetime = null)
    {
        $redis = $this->getRedis();

        if (class_exists('\OpenTracing\GlobalTracer')) {
            //Keys look like:
            //_PHCRHORSES_API_2&GET&/horses/profile/horse/1406150/overview
            //We should log
            //GET /horses/profile
            preg_match('/[_A-Z0-9]*&([_A-Z0-9]*)&(\/[a-z]*\/[a-z]*)/', $keyName, $matches);
            $redisResource = $matches[1] . ' ' . $matches[2];
            $redisProfile = \OpenTracing\GlobalTracer::get()->startActiveSpan('redis_lookup');
            $redisSpan = $redisProfile->getSpan();
            $redisServerNameKey = '';
            if (defined("PRODUCT_KEY")) {
                $redisServerNameKey = 'AUTH_REDIS_CLUSTER_' . str_replace('_API', '', PRODUCT_KEY);
            }
            $redisSpan->setTag(\DDTrace\Tags\SERVICE_NAME, isset($_SERVER[$redisServerNameKey]) ? $_SERVER[$redisServerNameKey] : 'redis_cache');
            $redisSpan->setTag(\DDTrace\Tags\SPAN_TYPE, 'cache');
            $redisSpan->setTag(\DDTrace\Tags\RESOURCE_NAME, $redisResource);
        }
        $frontend = $this->_frontend;
        $lastKey = $this->_prefix . $keyName;
        $this->_lastKey = $lastKey;
        $cachedContent = $redis->get($lastKey);

        if (!$cachedContent) {
            if (isset($redisSpan)) {
                $redisSpan->setTag('REDIS_RESULT', 'MISS');
                $redisProfile->close();
            }
            return null;
        }

        if (!is_numeric($cachedContent)) {
            if (isset($redisSpan)) {
                $redisSpan->setTag('REDIS_RESULT', 'HIT');
                $redisProfile->close();
            }
            return $cachedContent;
        }

        if (isset($redisSpan)) {
            $redisSpan->setTag('REDIS_RESULT', 'HIT');
            $redisProfile->close();
        }
        return $frontend->afterRetrieve($cachedContent);
    }

    /**
     * Stores cached content into the file backend and stops the frontend
     *
     * @param int|null|string $keyName
     * @param null $content
     * @param null $lifetime
     * @param bool $stopBuffer
     *
     * @return bool
     * @throws Exception
     * @internal param int|string $keyName
     * @internal param content $string
     * @internal param lifetime $long
     * @internal param stopBuffer $boolean
     */
    public function save($keyName = null, $content = null, $lifetime = null, $stopBuffer = true)
    {
        if (class_exists('\OpenTracing\GlobalTracer')) {
            //Keys look like:
            //_PHCRHORSES_API_2&GET&/horses/profile/horse/1406150/overview
            //We should log
            //GET /horses/profile
            preg_match('/[_A-Z0-9]*&([_A-Z0-9]*)&(\/[a-z]*\/[a-z]*)/', $keyName, $matches);
            $redisResource = $matches[1] . ' ' . $matches[2];
            $redisProfile = \OpenTracing\GlobalTracer::get()->startActiveSpan('redis_save');
            $redisSpan = $redisProfile->getSpan();
            $redisServerNameKey = '';
            if (defined("PRODUCT_KEY")) {
                $redisServerNameKey = 'AUTH_REDIS_CLUSTER_' . str_replace('_API', '', PRODUCT_KEY);
            }

            $redisSpan->setTag(\DDTrace\Tags\SERVICE_NAME, isset($_SERVER[$redisServerNameKey]) ? $_SERVER[$redisServerNameKey] : 'redis_cache');
            $redisSpan->setTag(\DDTrace\Tags\SPAN_TYPE, 'cache');
            $redisSpan->setTag(\DDTrace\Tags\RESOURCE_NAME, $redisResource);
        }

        if (!$keyName) {
            $lastKey = $this->_lastKey;
        } else {
            $prefixedKey = $this->_prefix . $keyName;
            $lastKey = $prefixedKey;
        }

        if (!$lastKey) {
            if (isset($redisSpan)) {
                $redisSpan->setTag(\DDTrace\Tags\ERROR, new Exception("The cache must be started first"));
            }
            throw new Exception("The cache must be started first");
        }

        $frontend = $this->_frontend;

        /**
         * Check if a connection is created or make a new one
         */
        $redis = $this->getRedis();

        if (!$content) {
            $cachedContent = $frontend->getContent();
        } else {
            $cachedContent = $content;
        }

        /**
         * Prepare the content in the frontend
         */
        if (!is_numeric($cachedContent)) {
            $cachedContent = $frontend->beforeStore($cachedContent);
        }

        if (!$lifetime) {
            $ttl = $frontend->getLifetime();
        } else {
            $ttl = $lifetime;
        }

        $success = $redis->setex($lastKey, $ttl, $cachedContent);

        if (!$success) {
            if (isset($redisSpan)) {
                $redisSpan->setTag(\DDTrace\Tags\ERROR, new Exception("Failed storing the data in redis"));
            }
            throw new Exception("Failed storing the data in redis");
        }

        if ($stopBuffer === true) {
            $frontend->stop();
        }

        $this->_started = false;
        if (isset($redisSpan)) {
            $redisProfile->close();
        }
        return $success;
    }

    /**
     * Deletes a value from the cache by its key
     *
     * @param int|string keyName
     *
     * @return int
     * @throws Exception
     */
    public function delete($keyName)
    {
        if (class_exists('\OpenTracing\GlobalTracer')) {
            //Keys look like:
            //_PHCRHORSES_API_2&GET&/horses/profile/horse/1406150/overview
            //We should log
            //GET /horses/profile
            preg_match('/[_A-Z0-9]*&([_A-Z0-9]*)&(\/[a-z]*\/[a-z]*)/', $keyName, $matches);
            $redisResource = $matches[1] . ' ' . $matches[2];
            $redisProfile = \OpenTracing\GlobalTracer::get()->startActiveSpan('redis_delete');
            $redisSpan = $redisProfile->getSpan();
            $redisServerNameKey = '';
            if (defined("PRODUCT_KEY")) {
                $redisServerNameKey = 'AUTH_REDIS_CLUSTER_' . str_replace('_API', '', PRODUCT_KEY);
            }
            $redisSpan->setTag(\DDTrace\Tags\SERVICE_NAME,
                isset($_SERVER[$redisServerNameKey]) ? $_SERVER[$redisServerNameKey] : 'redis_cache');
            $redisSpan->setTag(\DDTrace\Tags\SPAN_TYPE, 'cache');
            $redisSpan->setTag(\DDTrace\Tags\RESOURCE_NAME, $redisResource);
        }
        $redis = $this->getRedis();

        $prefixedKey = $this->_prefix . $keyName;
        $lastKey = $prefixedKey;
        /**
         * Delete the key from redis
         */
        $response = $redis->del($lastKey);
        if (isset($redisSpan)) {
            $redisProfile->close();
        }
        return $response;
    }

    /**
     * Query the existing cached keys ** DUMMY  **
     *
     * @param string prefix
     *
     * @return array
     * @throws Exception
     * @codeCoverageIgnore
     */
    public function queryKeys($prefix = null)
    {
        return [];
    }

    /**
     * Checks if cache exists and it isn't expired
     *
     * @param string keyName
     * @param   long lifetime
     * @return boolean
     */
    public function exists($keyName = null, $lifetime = null)
    {
        $lastKey = $this->_prefix . $keyName;

        if ($lastKey) {
            $redis = $this->getRedis();

            if (!$redis->get($lastKey)) {
                return false;
            }
            return true;
        }

        return false;
    }

    /**
     * Increment of given $keyName by $value
     *
     * @param  string keyName
     * @param  long lifetime
     * @return long
     * @codeCoverageIgnore
     */
    public function increment($keyName = null, $value = null)
    {
        if (class_exists('\OpenTracing\GlobalTracer')) {
            //Keys look like:
            //_PHCRHORSES_API_2&GET&/horses/profile/horse/1406150/overview
            //We should log
            //GET /horses/profile
            preg_match('/[_A-Z0-9]*&([_A-Z0-9]*)&(\/[a-z]*\/[a-z]*)/', $keyName, $matches);
            $redisResource = $matches[1] . ' ' . $matches[2];
            $redisProfile = \OpenTracing\GlobalTracer::get()->startActiveSpan('redis_increment');
            $redisSpan = $redisProfile->getSpan();
            $redisServerNameKey = '';
            if (defined("PRODUCT_KEY")) {
                $redisServerNameKey = 'AUTH_REDIS_CLUSTER_' . str_replace('_API', '', PRODUCT_KEY);
            }
            $redisSpan->setTag(\DDTrace\Tags\SERVICE_NAME,
                isset($_SERVER[$redisServerNameKey]) ? $_SERVER[$redisServerNameKey] : 'redis_cache');
            $redisSpan->setTag(\DDTrace\Tags\SPAN_TYPE, 'cache');
            $redisSpan->setTag(\DDTrace\Tags\RESOURCE_NAME, $redisResource);
        }
        $redis = $this->getRedis();

        if (!$keyName) {
            $lastKey = $this->_lastKey;
        } else {
            $lastKey = $this->_prefix . $keyName;
            $this->_lastKey = $lastKey;
        }

        if (!$value) {
            $value = 1;
        }

        $response = $redis->incrBy($lastKey, $value);
        if (isset($redisSpan)) {
            $redisProfile->close();
        }
        return $response;
    }

    /**
     * Decrement of $keyName by given $value
     *
     * @param  string keyName
     * @param  long value
     * @return long
     * @codeCoverageIgnore
     */
    public function decrement($keyName = null, $value = null)
    {
        if (class_exists('\OpenTracing\GlobalTracer')) {
            //Keys look like:
            //_PHCRHORSES_API_2&GET&/horses/profile/horse/1406150/overview
            //We should log
            //GET /horses/profile
            preg_match('/[_A-Z0-9]*&([_A-Z0-9]*)&(\/[a-z]*\/[a-z]*)/', $keyName, $matches);
            $redisResource = $matches[1] . ' ' . $matches[2];
            $redisProfile = \OpenTracing\GlobalTracer::get()->startActiveSpan('redis_decrement');
            $redisSpan = $redisProfile->getSpan();
            $redisServerNameKey = '';
            if (defined("PRODUCT_KEY")) {
                $redisServerNameKey = 'AUTH_REDIS_CLUSTER_' . str_replace('_API', '', PRODUCT_KEY);
            }
            $redisSpan->setTag(\DDTrace\Tags\SERVICE_NAME,
                isset($_SERVER[$redisServerNameKey]) ? $_SERVER[$redisServerNameKey] : 'redis_cache');
            $redisSpan->setTag(\DDTrace\Tags\SPAN_TYPE, 'cache');
            $redisSpan->setTag(\DDTrace\Tags\RESOURCE_NAME, $redisResource);
        }
        $redis = $this->getRedis();

        if (!$keyName) {
            $lastKey = $this->_lastKey;
        } else {
            $lastKey = $this->_prefix . $keyName;
            $this->_lastKey = $lastKey;
        }

        if (!$value) {
            $value = 1;
        }
        $response = $redis->decrBy($lastKey, $value);
        if (isset($redisSpan)) {
            $redisProfile->close();
        }
        return $response;
    }

    /**
     * Immediately invalidates all existing items.
     * @codeCoverageIgnore
     */
    public function flush()
    {
        return true;
    }
}
