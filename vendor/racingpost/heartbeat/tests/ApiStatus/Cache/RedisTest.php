<?php

namespace Tests\ApiStatus\Cache;

use Phalcon\Config\Adapter\EnvironmentVariablesNew;
use ApiStatus\Cache\Redis as ApiRedis;

/**
 * Class RedisTest
 * @package Tests\ApiStatus\Cache
 */
class RedisTest extends \PHPUnit\Framework\TestCase
{
    use \Tests\ApiStatus\Config;

    const ENV_SUFFIX = '_API_STATUS';

    /**
     * @inheritdoc
     */
    protected function tearDown()
    {
        $this->cleanUpServerVars();
    }

    /**
     * @inheritdoc
     */
    private function getRedisMock()
    {
        $stubRedis = $this->getMockBuilder(\Redis::class)
            ->setMethods(['connect', 'auth', 'set', 'get', 'del'])
            ->getMock();
        $stubRedis->expects($this->any())->method('connect')->will(
            $this->onConsecutiveCalls(false, true, true, true, true, true)
        );
        $stubRedis->expects($this->any())->method('auth')->will(
            $this->onConsecutiveCalls(false, true, true, true, true)
        );
        $stubRedis->expects($this->any())->method('set')->will($this->onConsecutiveCalls(false, true, true, true));
        $stubRedis->expects($this->any())->method('get')->will(
            $this->onConsecutiveCalls(false, \ApiStatus\Cache\Redis::STATUS_VALUE, \ApiStatus\Cache\Redis::STATUS_VALUE)
        );
        $stubRedis->expects($this->any())->method('del')->will($this->onConsecutiveCalls(false, 1));

        return $stubRedis;
    }

    /**
     * @inheritdoc
     */
    public function testAllStatuses()
    {
        $config = $this->getConfig([
            'AUTH_REDIS_HOST_API_STATUS' => "localhost",
            'AUTH_REDIS_PORT_API_STATUS' => 6379,
            'AUTH_REDIS_AUTHKEY_API_STATUS' => "racingpost",
            'CTRL_REDIS_PERSISTENT_API_STATUS' => 0,
        ]);

        $redis = $this->getRedisMock();
        $mode = ApiRedis::CHECK_CONN
            | ApiRedis::CHECK_AUTH
            | ApiRedis::CHECK_WRITE
            | ApiRedis::CHECK_READ
            | ApiRedis::CHECK_DELETE;

        $this->assertEquals(
            (Object)[
                'statuses' => (Object)[
                    'connection' => false,
                    'auth' => null,
                    'write' => false,
                    'read' => false,
                    'delete' => false,
                ],
                'healthy' => false,
            ],
            (new ApiRedis($config))->setRedis($redis)->setMode($mode)->getStatuses(),
            'can not connect'
        );
        $this->assertEquals(
            (Object)[
                'statuses' => (Object)[
                    'connection' => true,
                    'auth' => false,
                    'write' => false,
                    'read' => false,
                    'delete' => false
                ],
                'healthy' => false,
            ],
            (new ApiRedis($config))->setRedis($redis)->setMode($mode)->getStatuses(),
            'can not auth'
        );
        $this->assertEquals(
            (Object)[
                'statuses' => (Object)[
                    'connection' => true,
                    'auth' => true,
                    'write' => false,
                    'read' => false,
                    'delete' => false
                ],
                'healthy' => false,
            ],
            (new ApiRedis($config))->setRedis($redis)->setMode($mode)->getStatuses(),
            'can not write'
        );
        $this->assertEquals(
            (Object)[
                'statuses' => (Object)[
                    'connection' => true,
                    'auth' => true,
                    'write' => true,
                    'read' => false,
                    'delete' => false
                ],
                'healthy' => false,
            ],
            (new ApiRedis($config))->setRedis($redis)->setMode($mode)->getStatuses(),
            'can not read'
        );
        $this->assertEquals(
            (Object)[
                'statuses' => (Object)[
                    'connection' => true,
                    'auth' => true,
                    'write' => true,
                    'read' => true,
                    'delete' => false
                ],
                'healthy' => false,
            ],
            (new ApiRedis($config))->setRedis($redis)->setMode($mode)->getStatuses()
        );
        $this->assertEquals(
            (Object)[
                'statuses' => (Object)[
                    'connection' => true,
                    'auth' => true,
                    'write' => true,
                    'read' => true,
                    'delete' => true
                ],
                'healthy' => true,
            ],
            (new ApiRedis($config))->setRedis($redis)->setMode($mode)->getStatuses()
        );
    }

    /**
     * @inheritdoc
     */
    public function testObtainStatusesFailure()
    {
        $redis = $this->getRedisMock();
        $this->assertEquals(
            (Object)[
                'statuses' => null,
                'healthy' => null
            ],
            (new ApiRedis(new \Phalcon\Config([])))->setRedis($redis)->getStatuses()
        );
    }

    /**
     * @inheritdoc
     */
    private function getRedisMockPartial()
    {
        $stubRedis = $this->getMockBuilder(\RedisCluster::class)
            ->setMethods(['set', 'get', 'del'])
            ->getMock();
        $stubRedis->expects($this->any())->method('set')->will($this->onConsecutiveCalls(false, true, true, true));
        $stubRedis->expects($this->any())->method('get')->will(
            $this->onConsecutiveCalls(false, \ApiStatus\Cache\Redis::STATUS_VALUE, \ApiStatus\Cache\Redis::STATUS_VALUE)
        );
        $stubRedis->expects($this->any())->method('del')->will($this->onConsecutiveCalls(false, 1));

        return $stubRedis;
    }

    /**
     * @inheritdoc
     */
    public function testPartialStatuses()
    {
        $config = $this->getConfig([
            'CTRL_REDIS_CACHEON_API_STATUS' => "1",
            'AUTH_REDIS_CLUSTER_API_STATUS' => "127.0.0.1:30001;127.0.0.1:30002;127.0.0.1:30003",
        ]);

        $redis = $this->getRedisMockPartial();

        $this->assertEquals(
            (Object)[
                'statuses' => (Object)[
                    'write' => false,
                    'read' => false,
                    'delete' => false
                ],
                'healthy' => false,
            ],
            (new ApiRedis($config))->setRedis($redis)->getStatuses(),
            'can not write'
        );
        $this->assertEquals(
            (Object)[
                'statuses' => (Object)[
                    'write' => true,
                    'read' => false,
                    'delete' => false
                ],
                'healthy' => false,
            ],
            (new ApiRedis($config))->setRedis($redis)->getStatuses(),
            'can not read'
        );
        $this->assertEquals(
            (Object)[
                'statuses' => (Object)[
                    'write' => true,
                    'read' => true,
                    'delete' => false
                ],
                'healthy' => false,
            ],
            (new ApiRedis($config))->setRedis($redis)->getStatuses()
        );
        $this->assertEquals(
            (Object)[
                'statuses' => (Object)[
                    'write' => true,
                    'read' => true,
                    'delete' => true
                ],
                'healthy' => true,
            ],
            (new ApiRedis($config))->setRedis($redis)->getStatuses()
        );
    }
}
