<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 6/1/2016
 * Time: 4:48 PM
 */

namespace ApiStatus\Cache;

use Phalcon\Config;

/**
 * Class Status
 * Class is intended to obtain all essential statuses of Redis.
 * Since, the sequence of call methods has value we use status trigger to have consistent info
 * about performed calls of methods
 *
 * @package ApiStatus\Redis
 */
class Redis extends \ApiStatus\Status
{
    const STATUS_VALUE = 'API STATUS';

    const CHECK_CONN = 1;
    const CHECK_AUTH = 2;
    const CHECK_WRITE = 4;
    const CHECK_READ = 8;
    const CHECK_DELETE = 16;

    /**
     * @var string
     */
    private $configRedis;

    /**
     * @var \Redis
     */
    private $redis;

    /**
     * @var string
     */
    private $redisKey;

    private $mode;

    protected $statuses = [
        'statuses' => null,
        'healthy' => null,
    ];

    public function __construct(Config $config)
    {
        $this->setMode(self::CHECK_WRITE | self::CHECK_READ | self::CHECK_DELETE);
        parent::__construct($config);
    }

    /**
     * @param \Redis|\RedisCluster $redis
     *
     * @throws \BadMethodCallException
     * @return $this
     */
    public function setRedis($redis)
    {
        if ($this->isRedis($redis)) {
            $this->redis = $redis;
        } else {
            throw new \BadMethodCallException(
                "Argument 1 passed to " . __METHOD__ . "() must be an instance of Redis or RedisCluster"
            );
        }

        return $this;
    }

    /**
     * @param $mode
     *
     * @return $this
     */
    public function setMode($mode)
    {
        if (is_integer($mode)) {
            $this->mode = $mode;
        }
        return $this;
    }

    /**
     * @return array
     */
    protected function obtainStatuses()
    {
        return function () {
            if ($this->isRedis($this->getRedis())) {
                $this->generateKey();
                $this->fetchStatuses();
            }
        };
    }

    /**
     * @deprecated 0.1.30
     * @return boolean
     */
    private function canConnect()
    {
        $options = $this->getConnectionOptions();
        $connectType = $options["persistent"] ? 'pconnect' : 'connect';

        $this->statuses['statuses']['connection'] = $this->getRedis()->{$connectType}(
            $options["host"],
            $options["port"]
        );
        return $this->statuses['statuses']['connection'];
    }

    /**
     * @deprecated 0.1.30
     *
     * @param boolean $status
     *
     * @return bool
     */
    private function canAuth($status)
    {
        $options = $this->getConnectionOptions();
        $this->statuses['statuses']['auth'] = null;
        $rtnStatus = false;
        if ($status) {
            if (isset($options["auth"])) {
                $rtnStatus = $this->statuses['statuses']['auth'] = $this->getRedis()->auth($options['auth']);
            } else {
                $rtnStatus = true;
            }
        }

        return $rtnStatus;
    }

    /**
     * @param $status
     * @return mixed
     */
    private function canWrite($status)
    {
        $this->statuses['statuses']['write'] = false;
        if ($status) {
            $this->statuses['statuses']['write'] =
                $this->getRedis()->set($this->getRedisKey(), self::STATUS_VALUE) === true;
        }
        return $this->statuses['statuses']['write'];
    }

    /**
     * @param $status
     * @return mixed
     */
    private function canRead($status)
    {
        $value = '';
        if ($status) {
            $value = $this->getRedis()->get($this->getRedisKey());
        }
        $this->statuses['statuses']['read'] = ($value === self::STATUS_VALUE);
        return $this->statuses['statuses']['read'];
    }

    /**
     * @param $status
     * @return mixed
     */
    private function canDelete($status)
    {
        $this->statuses['statuses']['delete'] = false;
        if ($status) {
            $this->statuses['statuses']['delete'] = (bool)$this->getRedis()->del($this->getRedisKey());
        }
        return $this->statuses['statuses']['delete'];
    }

    /**
     * @inheritdoc
     */
    private function fetchStatuses()
    {
        $this->configRedis = $this->getConfig()->get('redis', null);
        if ($this->isValidConfig()) {
            $conn = $this->mode & self::CHECK_CONN ? $this->canConnect() : true;
            $auth = $this->mode & self::CHECK_AUTH ? $this->canAuth($conn) : true;
            $write = $this->mode & self::CHECK_WRITE ? $this->canWrite($auth) : true;
            $read = $this->mode & self::CHECK_READ ? $this->canRead($write) : true;
            $this->mode & self::CHECK_DELETE ? $this->canDelete($read) : false;
        }
        $this->prepareStatuses();
    }

    /**
     * @inheritdoc
     */
    private function prepareStatuses()
    {
        $this->statuses['healthy'] = false;
        if (!empty($this->statuses['statuses'])) {
            $this->statuses['healthy'] = $this->statuses['statuses']['delete'];
            $this->statuses['statuses'] = (Object)$this->statuses['statuses'];
        }
        $this->statuses = (Object)$this->statuses;
    }

    /**
     * @inheritdoc
     */
    private function generateKey()
    {
        $this->redisKey = 'STATUS_' . mt_rand();
    }

    /**
     * @return string
     */
    private function getRedisKey()
    {
        return $this->redisKey;
    }

    /**
     * @return \Redis
     */
    private function getRedis()
    {
        return $this->redis;
    }

    /**
     * @param $redis
     *
     * @return bool
     */
    public static function isRedis($redis)
    {
        return ($redis instanceof \Redis || $redis instanceof \RedisCluster);
    }

    /**
     * @return bool
     */
    protected function isValidConfig()
    {
        if ($this->getRedis() instanceof \Redis) {
            $valid = $this->isValidRedisConfig();
        } else {
            $valid = $this->isValidRedisClusterConfig();
        }
        return $valid;
    }

    /**
     * @return bool
     */
    private function isValidRedisConfig()
    {
        $valid = false;
        if (is_object($this->configRedis) && isset($this->configRedis->host) && isset($this->configRedis->port)) {
            $valid = true;
        }
        return $valid;
    }

    /**
     * @return bool
     */
    private function isValidRedisClusterConfig()
    {
        $valid = false;
        if (is_object($this->configRedis) && isset($this->configRedis->cacheon) && isset($this->configRedis->cluster)) {
            $valid = true;
        }
        return $valid;
    }

    /**
     * @return array
     */
    private function getConnectionOptions()
    {
        $config = $this->configRedis;
        $options = ['host' => $config->host, 'port' => (int)$config->port];
        if (isset($config->authkey)) {
            $options['auth'] = $config->authkey;
        }
        $options['auth'] = !empty($config->authkey) ? $config->authkey : null;
        $options['persistent'] = isset($config->persistent) ? (bool)$config->persistent : false;
        return $options;
    }
}
