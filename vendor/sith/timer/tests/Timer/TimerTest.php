<?php
namespace RP\Tests\Timer;

use RP\Tests\AbstractTest;

class TimerTest extends AbstractTest
{
    public function testGetName()
    {
        $mock = \Phake::partialMock('\RP\Utils\Timer\Timer', 123, '[dummy name]', '[dummy decription]');

        $actual = $mock->getName();
        $expected = '[dummy name]';
        $this->assertEquals(
            $expected,
            $actual,
            'getName() returned wrong value'
        );
    }

    public function testStop()
    {
        $mock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($mock)->stop()->thenCallParent();
        \Phake::when($mock)->getMicrotime()->thenReturn(123456789);
        \Phake::when($mock)->isStopped()->thenReturn(false);

        $actual = $this->getProtectedVariable($mock, 'endTime');
        $expected = null;
        $this->assertEquals(
            $expected,
            $actual,
            'endTime should be null before timer is stopped'
        );

        $mock->stop();

        $actual = $this->getProtectedVariable($mock, 'endTime');
        $expected = 123456789;
        $this->assertEquals(
            $expected,
            $actual,
            'endTime should not be null if timer is stopped'
        );
    }

    public function testStopWarning()
    {
        $mock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($mock)->stop()->thenCallParent();
        \Phake::when($mock)->getMicrotime()->thenReturn(123456789);
        \Phake::when($mock)->isStopped()->thenReturn(true);

        @$mock->stop();
        $this->setExpectedException('\PHPUnit_Framework_Error_Warning');
        $mock->stop();
    }

    public function testGetSetTime()
    {
        $mock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($mock)->getTime()->thenCallParent();
        \Phake::when($mock)->setStartTime(\Phake::anyParameters())->thenCallParent();
        \Phake::when($mock)->stop()->thenCallParent();
        \Phake::when($mock)->getMicrotime()->thenReturn(123456789);

        $mock->setStartTime(123456780);
        $actual = $mock->getTime();
        $expected = 9;
        $this->assertEquals(
            $expected,
            $actual,
            'getTime() returned wrong value'
        );

        \Phake::verify($mock)->stop();
    }

    public function testGetOwnTime()
    {
        $subTimerMock1 = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($subTimerMock1)->getTime()->thenReturn(5);
        $subTimerMock2 = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($subTimerMock2)->getTime()->thenReturn(10);

        $mock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($mock)->getOwnTime()->thenCallParent();
        \Phake::when($mock)->getTime()->thenReturn(25);
        \Phake::when($mock)->getTimers()->thenReturn([$subTimerMock1, $subTimerMock2]);

        $actual = $mock->getOwnTime();
        $expected = 10;
        $this->assertEquals(
            $expected,
            $actual,
            'getOwnTime() returned wrong value'
        );
    }

    public function testSubTimers()
    {
        $mock = \Phake::mock('\RP\Utils\Timer\Timer');

        \Phake::when($mock)->addTimer(\Phake::anyParameters())->thenCallParent();
        \Phake::when($mock)->hasTimers()->thenCallParent();
        \Phake::when($mock)->getTimers()->thenCallParent();

        $actual = $mock->hasTimers();
        $expected = false;
        $this->assertEquals(
            $expected,
            $actual,
            'hasTimers() returned wrong value'
        );

        $actual = $mock->getTimers();
        $expected = [];
        $this->assertEquals(
            $expected,
            $actual,
            'getTimers() returned wrong value'
        );

        $subTimerMock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($subTimerMock)->getId()->thenReturn('[dummy id]');
        $mock->addTimer($subTimerMock);

        $actual = $mock->hasTimers();
        $expected = true;
        $this->assertEquals(
            $expected,
            $actual,
            'hasTimers() returned wrong value'
        );

        $actual = $mock->getTimers();
        $expected = ['[dummy id]' => $subTimerMock];
        $this->assertEquals(
            $expected,
            $actual,
            'getTimers() returned wrong value'
        );
    }

    public function testGetTimer()
    {
        $mock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($mock)->getTimer(\Phake::anyParameters())->thenCallParent();
        \Phake::when($mock)->addTimer(\Phake::anyParameters())->thenCallParent();

        $actual = $mock->getTimer('[dummy name]');
        $expected = null;
        $this->assertEquals(
            $expected,
            $actual,
            'getTimer() returned wrong value'
        );

        $subTimerMock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($subTimerMock)->getId()->thenReturn('[dummy id]');
        $mock->addTimer($subTimerMock);
        $actual = $mock->getTimer('[dummy id]');
        $expected = $subTimerMock;
        $this->assertEquals(
            $expected,
            $actual,
            'getTimer() returned wrong value'
        );
    }

    public function testGetMicrotime()
    {
        $mock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($mock)->getMicrotime()->thenCallParent();

        $actual = \Phake::makeVisible($mock)->getMicrotime();
        $expected = microtime(true);
        $this->assertEquals(
            number_format($expected, 0),
            number_format($actual, 0),
            'Microtime returned with errors'
        );
    }

    public function testGetId()
    {
        $mock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($mock)->getId()->thenCallParent();
        $this->setProtectedVariable($mock, 'id', 'dummy id');

        $actual = $mock->getId();
        $expected = 'dummy id';
        $this->assertEquals(
            $expected,
            $actual,
            'getId() returned with errors'
        );
    }

    public function testGetDescription()
    {
        $mock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($mock)->getDescription()->thenCallParent();
        $this->setProtectedVariable($mock, 'description', 'dummy description');

        $actual = $mock->getDescription();
        $expected = 'dummy description';
        $this->assertEquals(
            $expected,
            $actual,
            'getDescription() returned with errors'
        );
    }

    /**
     * @dataProvider providerIsStopped
     */
    public function testIsStopped($endTime, $expected)
    {
        $mock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($mock)->isStopped()->thenCallParent();
        $this->setProtectedVariable($mock, 'endTime', $endTime);

        $this->assertEquals(
            $expected,
            $mock->isStopped()
        );
    }

    public function providerIsStopped()
    {
        return [
            [123456, true],
            [null,   false],
        ];
    }
}
