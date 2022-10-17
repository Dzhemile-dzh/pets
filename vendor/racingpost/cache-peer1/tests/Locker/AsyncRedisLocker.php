<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 2017-06-19
 * Time: 18:29
 */

namespace Tests\Locker;

use Phalcon\Cache\Locker\RedisClusterLocker;

class AsyncRedisLocker extends \Worker
{

    public $redis;
    public $key;
    public $content;
    public $setContent;

    public function __construct(\RedisCluster $redis, $key, $content, $setContent = null)
    {
        $this->redis = $redis;
        $this->content = $content;
        $this->setContent = $setContent;
        $this->key = $key;
    }

    public function run()
    {
        $this->synchronized(function ($thread) {
            $locker = new RedisClusterLocker($thread->redis);
            $locker->lock($this->content, $thread->key);
            usleep(300000);
            if ($this->setContent !== null) {
                $thread->redis->setContent = $this->setContent;
            } else {
                $locker->unlock();
            }
        }, $this);
    }
}
