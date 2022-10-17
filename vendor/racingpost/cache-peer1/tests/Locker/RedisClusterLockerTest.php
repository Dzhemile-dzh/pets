<?php

namespace Tests\Locker;

require_once realpath(dirname(__FILE__) . '/../') . '/Stubs/Root/RedisCluster.php';

use Phalcon\Cache\Indexer\RedisIndexer;
use Phalcon\Cache\Locker\RedisClusterLocker;
use Phalcon\Http\Response;
use RP\ContentAttributes\Element\ContentAttributes;
use Tests\AsyncClosure;

class RedisClusterLockerTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        \Mockery::close();
    }

    public function testThroughLock()
    {
        $redisSpy = \Mockery::spy(new \RedisCluster());
        $content = null;
        $key = 'SomeKey';

        $locker = new RedisClusterLocker($redisSpy);
        $locker->lock($content, $key);
        $locker->unlock();

        $redisSpy->shouldHaveReceived("set")->times(1);
        $redisSpy->shouldHaveReceived("eval")->times(1);
    }

    public function testNotEmptyContentLock()
    {
        $redisSpy = \Mockery::spy(new \RedisCluster());
        $content = 'Some Content';
        $key = 'SomeKey';

        $locker = new RedisClusterLocker($redisSpy);
        $locker->lock($content, $key);
        $locker->unlock();

        $redisSpy->shouldNotHaveReceived("set");
    }

    /**
     */
    public function testLockHit()
    {
        \Threaded::extend(\RedisCluster::class);
        $redis = new \RedisCluster();
        $redisSpy = \Mockery::spy($redis);
        $content = null;
        $key = 'SomeKey';

        $locker = new RedisClusterLocker($redisSpy);

        $arg = [
            &$content, $key, &$redis
        ];

        $firstThread = new AsyncRedisLocker($redis, $key, $content);
        $firstThread->start();
        usleep(50000);
        $mainLocker = new RedisClusterLocker($redisSpy);
        $mainLocker->lock($content, $key);

        $redisSpy->shouldHaveReceived("get")->atLeast()->times(2);
    }

    public function testGetContentByLock()
    {
        $redis = new \RedisCluster();
        $redisSpy = \Mockery::spy($redis);
        $content = null;
        $key = 'SomeKey';
        $expectedContent = 'someContent';

        $locker = new RedisClusterLocker($redisSpy);

        $arg = [
            &$content, $key, &$redis
        ];

        $firstThread = new AsyncRedisLocker($redis, $key, $content, $expectedContent);
        $firstThread->start();
        usleep(50000);
        $mainLocker = new RedisClusterLocker($redisSpy);
        $mainLocker->lock($content, $key);

        $this->assertEquals($expectedContent, $content);
    }
}
