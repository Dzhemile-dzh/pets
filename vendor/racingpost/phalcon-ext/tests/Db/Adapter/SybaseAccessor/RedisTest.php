<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 4/18/2016
 * Time: 10:53 AM
 */

namespace Tests\Db\Adapter\SybaseAccessor;

use Phalcon\DI;
use Phalcon\Config;
use Phalcon\Db\Adapter\SybaseAccessor\Redis as SybaseAccessor;

class RedisTest extends \Tests\CommonTestCase
{
    protected function setUp()
    {
        new DI();
    }

    protected function tearDown()
    {
        DI::getDefault()->reset();
    }

    private function setMockRedis($props)
    {
        $redis = $this->getMockBuilder('stdClass')
            ->setMethods(
                [
                    'zCount',
                    'zAdd',
                    'zRem',
                    'zRemRangeByScore',
                ]
            )->getMock();

        $redis->expects($this->any())->method('zCount')->will(
            $this->onConsecutiveCalls(
                $props['zCount'][0],
                $props['zCount'][1],
                $props['zCount'][2],
                $props['zCount'][3]
            )
        );
        $redis->expects($this->any())->method('zAdd')->will($this->returnValue(null));
        $redis->expects($this->any())->method('zRem')->will($this->returnValue($props['zRem']));
        $redis->expects($this->any())->method('zRemRangeByScore')->will(
            $this->onConsecutiveCalls(
                $props['zRemRangeByScore'][0],
                $props['zRemRangeByScore'][1],
                $props['zRemRangeByScore'][2],
                $props['zRemRangeByScore'][3]
            )
        );

        DI::getDefault()->set('redis', $redis);
    }

    private function getStubConfig($props)
    {
        $config = new Config(
            [
                "database" => [
                    "servername" => "TEST",
                    "connection" => [
                        "threshold" => $props['connectionThreshold'],
                        "retrynumber" => $props['connectionRetrynumber'],
                        "interval" => $props['connectionInterval'],
                    ]
                ],
            ]
        );

        return $config;
    }

    /**
     * @param array $props
     *
     * @dataProvider providerTestOpenSuccess
     */
    public function testOpenSuccess($props)
    {

        $this->setMockRedis($props);
        $redis = new SybaseAccessor($this->getStubConfig($props));

        $start = microtime(true);
        $this->assertTrue($redis->open());
        $total = microtime(true) - $start;

        $this->assertNull($redis->close());
        $countIteration = array_search(9, $props['zCount']) - array_sum($props['zRemRangeByScore']);

        $this->assertGreaterThanOrEqual(($props['connectionInterval'] / 1000) * $countIteration, $total);
    }

    public function providerTestOpenSuccess()
    {
        return [
            [
                [
                    'connectionThreshold' => 10,
                    'connectionRetrynumber' => 4,
                    'connectionInterval' => 500,
                    'zCount' => [10, 10, 10, 9],
                    'zRem' => true,
                    'zRemRangeByScore' => [0, 0, 0, 1],
                ]
            ],
            [
                [
                    'connectionThreshold' => 10,
                    'connectionRetrynumber' => 1,
                    'connectionInterval' => 500,
                    'zCount' => [9, null, null, null],
                    'zRem' => true,
                    'zRemRangeByScore' => [0, null, null, null],
                ]
            ],
            [
                [
                    'connectionThreshold' => 10,
                    'connectionRetrynumber' => 3,
                    'connectionInterval' => 500,
                    'zCount' => [10, 9, 8, null],
                    'zRem' => true,
                    'zRemRangeByScore' => [1, 0, 0, null],
                ]
            ],
        ];
    }

    /**
     * @param array $props
     *
     * @dataProvider providerTestOpenFailure
     */
    public function testOpenFailure($props)
    {
        $this->setMockRedis($props);
        $redis = new SybaseAccessor($this->getStubConfig($props));

        $this->assertFalse($redis->open());
        $this->assertNull($redis->close());
    }

    public function providerTestOpenFailure()
    {
        return [
            [
                [
                    'connectionThreshold' => 10,
                    'connectionRetrynumber' => 4,
                    'connectionInterval' => 500,
                    'zCount' => [13, 12, 11, 10, 9],
                    'zRem' => false,
                    'zRemRangeByScore' => [1, 1, 1, 1],
                ]
            ],
            [
                [
                    'connectionThreshold' => 10,
                    'connectionRetrynumber' => 1,
                    'connectionInterval' => 500,
                    'zCount' => [10, null, null, null],
                    'zRem' => false,
                    'zRemRangeByScore' => [0, null, null, null],
                ]
            ],
            [
                [
                    'connectionThreshold' => 10,
                    'connectionRetrynumber' => 3,
                    'connectionInterval' => 500,
                    'zCount' => [12, 11, 10, 9],
                    'zRem' => false,
                    'zRemRangeByScore' => [1, 1, 1, 1],
                ]
            ],
        ];
    }

    /**
     * @param $props
     * @expectedException \Phalcon\Db\Adapter\SybaseAccessor\ValidationException
     * @expectedExceptionMessage A config for SybaseAccessor is not consistent!
     *
     * @dataProvider providerTestWrongConfig
     */
    public function testWrongConfig($props)
    {
        new SybaseAccessor($this->getStubConfig($props));
    }

    /**
     * @return array
     */
    public function providerTestWrongConfig()
    {
        return [
            [
                [
                    'connectionThreshold' => 10,
                    'connectionRetrynumber' => 4,
                    'connectionInterval' => null,
                ]
            ],
            [
                [
                    'connectionThreshold' => null,
                    'connectionRetrynumber' => null,
                    'connectionInterval' => 500,
                ]
            ],
        ];
    }

    /**
     * @param $props
     * @expectedException \Phalcon\Db\Adapter\SybaseAccessor\ValidationException
     * @expectedExceptionMessage The 'Redis' service does not exist
     *
     * @dataProvider providerTestAbsenceRedis
     */
    public function testAbsenceRedis($props)
    {
        new SybaseAccessor($this->getStubConfig($props));
    }

    /**
     * @return array
     */
    public function providerTestAbsenceRedis()
    {
        return [
            [
                [
                    'connectionThreshold' => 10,
                    'connectionRetrynumber' => 4,
                    'connectionInterval' => 500,
                ]
            ]
        ];
    }

    public function testGetKeyOfCounterSuccess()
    {
        $this->assertEquals("TEST_CONNECTION_COUNTER", SybaseAccessor::getKeyOfCounter($this->getStubConfig([
            'connectionThreshold' => null,
            'connectionRetrynumber' => null,
            'connectionInterval' => null,
        ])));
    }

    /**
     * @expectedException \Phalcon\Db\Adapter\SybaseAccessor\ValidationException
     * @expectedExceptionMessage Impossible to retrieve key of a counter
     */
    public function testGetKeyOfCounterFailure()
    {
        SybaseAccessor::getKeyOfCounter(new Config([]));
    }
}
