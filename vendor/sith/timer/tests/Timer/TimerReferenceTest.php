<?php
namespace RP\Tests\Timer;

use RP\Tests\AbstractTest;

class TimerReferenceTest extends AbstractTest
{
    public function testConstruct()
    {
        $timerMock = \Phake::mock('\RP\Utils\Timer\Timer');
        $serviceMock = \Phake::mock('\RP\Utils\Timer\TimerService');
        $mock = \Phake::partialMock('\RP\Utils\Timer\TimerReference', $timerMock, $serviceMock);

        $this->assertEquals(
            $timerMock,
            $this->getProtectedVariable($mock, 'timer')
        );
        $this->assertEquals(
            $serviceMock,
            $this->getProtectedVariable($mock, 'timerService')
        );
    }

    public function testStop()
    {
        $timerMock = \Phake::mock('\RP\Utils\Timer\Timer');
        $serviceMock = \Phake::mock('\RP\Utils\Timer\TimerService');
        $mock = \Phake::mock('\RP\Utils\Timer\TimerReference');
        \Phake::when($mock)->stop()->thenCallParent();
        \Phake::when($mock)->getTimer()->thenReturn($timerMock);
        $this->setProtectedVariable($mock, 'timerService', $serviceMock);

        $mock->stop();
        \Phake::verify($serviceMock)->stop($timerMock);
    }

    public function testDestruct()
    {
        $timerMock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($timerMock)->isStopped()->thenReturn(false);
        $serviceMock = \Phake::mock('\RP\Utils\Timer\TimerService');
        $instance = new \RP\Utils\Timer\TimerReference($timerMock, $serviceMock);

        unset($instance);
        \Phake::verify($serviceMock)->stop($timerMock);
    }

    public function testDestructStopped()
    {
        $timerMock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($timerMock)->isStopped()->thenReturn(true);
        $serviceMock = \Phake::mock('\RP\Utils\Timer\TimerService');
        $instance = new \RP\Utils\Timer\TimerReference($timerMock, $serviceMock);

        unset($instance);
        \Phake::verify($serviceMock, \Phake::never())->stop($timerMock);
    }

    public function testGetTimer()
    {
        $timerMock = \Phake::mock('\RP\Utils\Timer\Timer');
        $mock = \Phake::mock('\RP\Utils\Timer\TimerReference');
        \Phake::when($mock)->getTimer()->thenCallParent();
        $this->setProtectedVariable($mock, 'timer', $timerMock);

        $this->assertEquals(
            $timerMock,
            $mock->getTimer()
        );
    }
}