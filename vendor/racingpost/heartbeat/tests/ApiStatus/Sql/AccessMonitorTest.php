<?php

namespace Tests\ApiStatus\Sql;

use ApiStatus\Sql\AccessMonitor;

/**
 * Class AccessMonitorTest
 * @package Tests\ApiStatus\Sql
 */
class AccessMonitorTest extends \PHPUnit\Framework\TestCase
{
    use \Tests\ApiStatus\Config;

    const ENV_SUFFIX = '_API_STATUS';
    const CONNECTION_THRESHOLD = '1000';

    /**
     * @param $zCount
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getMocks($zCount)
    {
        $mockRedis = $this->getMockBuilder(\RedisCluster::class)
            ->setMethods(['zCount'])
            ->getMock();
        $mockRedis->expects($this->any())->method('zCount')->willReturn($zCount);

        $config = $this->getConfig(
            [
                'CTRL_DB_CONNECTION_THRESHOLD_API_STATUS' => self::CONNECTION_THRESHOLD,
                'AUTH_DB_SERVERNAME_API_STATUS' => "localhost",
                'CTRL_REDIS_CACHEON_API_STATUS' => "1",
                'AUTH_REDIS_CLUSTER_API_STATUS' => "127.0.0.1:30001;127.0.0.1:30002;127.0.0.1:30003",
            ]
        );

        return [$mockRedis, $config];
    }

    /**
     * @inheritdoc
     */
    public function testSuccess()
    {
        $zCount = 7; //any number
        list($redis, $config) = $this->getMocks($zCount);

        $monitor = (new AccessMonitor($config))->setRedis($redis);
        $actualStatuses = (array)$monitor->getStatuses();

        $expectedStatuses = [
            'connection_count' => $zCount,
            'connection_threshold' => (int)self::CONNECTION_THRESHOLD,//monitor has to cast this value to int
            'healthy' => true,
        ];

        foreach ($expectedStatuses as $key => $value) {
            $this->assertSame($value, $actualStatuses[$key]);
        }
    }

    /**
     * @expectedException \BadMethodCallException
     * @expectedExceptionMessage Argument 1 passed to ApiStatus\Sql\AccessMonitor::setRedis() must be an instance of Redis or RedisCluster
     */
    public function testFailure()
    {
        $zCount = 777; //any number
        list($redis, $config) = $this->getMocks($zCount);
        $redis = null;
        (new AccessMonitor($config))->setRedis($redis);
    }
}
