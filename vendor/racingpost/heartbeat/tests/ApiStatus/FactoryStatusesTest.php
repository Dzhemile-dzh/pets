<?php

namespace Tests\ApiStatus;

/**
 * Class FactoryStatusesTest
 * @package Tests\ApiStatus
 */
class FactoryStatusesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException \TypeError
     */
    public function testConstructFailure()
    {
        new FactoryStatusesMock([]);
    }

    /**
     * @inheritdoc
     */
    public function testAllGetters()
    {
        $factory = new FactoryStatusesMock(new \Phalcon\Config([]));

        $this->assertInstanceOf(\ApiStatus\Status::class, $factory->getCache());
        $this->assertInstanceOf(\ApiStatus\Status::class, $factory->getSql());
        $this->assertInstanceOf(\ApiStatus\Status::class, $factory->getServerVars());
        $this->assertInstanceOf(\ApiStatus\Status::class, $factory->getReplication());
        $this->assertInstanceOf(\ApiStatus\Status::class, $factory->getAccessMonitor());
    }

    /**
     * @inheritdoc
     */
    public function testGetStatusSuccess()
    {
        $factory = new FactoryStatusesMock(new \Phalcon\Config([]));
        $statusSql = $factory->getStatus('sql');
        $this->assertEquals(
            (Object)[
                'test1' => 'test1',
                'test2' => 'test2',
                'healthy' => true,
            ],
            $statusSql
        );
    }

    /**
     * @expectedException \UnexpectedValueException
     * @expectedExceptionMessage Undefined status: redis
     */
    public function testGetStatusFailureUndefinedStatus()
    {
        $factory = new FactoryStatusesMock(new \Phalcon\Config([]));
        $factory->getCache()->setObtainedStatuses([]);
        $factory->getStatus('redis');
    }

    /**
     * @inheritdoc
     */
    public function testGetMapper()
    {
        $factory = new FactoryStatusesMock(new \Phalcon\Config([]));
        $this->assertEquals(
            ['test1' => 'test1', 'test2' => 'test2', 'healthy' => 'healthy'],
            $factory->getMapper('sql')
        );

        $factory->getSql()->setObtainedStatuses(
            [
                'nodes' => [
                    (Object)[
                        'p_1' => 1,
                        'p_2' => 2,
                        'nested' => null,
                        'healthy' => true,
                    ],
                    (Object)[
                        'p_3' => 1,
                        'p_4' => 2,
                        'nested' => (Object)[
                            'p_3' => 3,
                            'p_4' => 4
                        ],
                        'healthy' => true,
                    ],
                ],
                'healthy' => true,
            ]
        );
        $this->assertEquals(['nodes' => 'nodes', 'healthy' => 'healthy'], $factory->getMapper('sql'));
        $this->assertEquals(
            [
                'p_1' => 'p_1',
                'p_2' => 'p_2',
                'p_3' => 'p_3',
                'p_4' => 'p_4',
                'nested' => 'nested',
                'healthy' => 'healthy',
            ],
            $factory->getMapper('sql', 'nodes')
        );

        $this->assertEquals(
            [
                'p_3' => 'p_3',
                'p_4' => 'p_4',
            ],
            $factory->getMapper('sql', 'nested')
        );
    }

    /**
     * @inheritdoc
     */
    public function testObserversAreUpdated()
    {
        $subject = new \ApiStatus\Server\Variables(new \Phalcon\Config([]));

        $observer = $this->prophesize('\Tests\ApiStatus\FactoryStatusesMock');

        $observer->update($subject)->shouldBeCalled();

        $subject->attach($observer->reveal());
        $subject->getStatuses(true);
    }
}
