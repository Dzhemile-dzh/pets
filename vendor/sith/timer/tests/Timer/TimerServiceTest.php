<?php
namespace RP\Tests\Timer;

class TimerServiceTest extends \RP\Tests\AbstractTest
{
    public function testConstructor()
    {
        $mock = \Phake::partialMock('\RP\Utils\Timer\TimerService', 'dummy name', 123);
        $timer = $this->getProtectedVariable($mock, 'pageTimer');

        $this->assertInstanceOf(
            '\RP\Utils\Timer\Timer',
            $timer,
            'Page timer was not created'
        );

        $this->assertInstanceOf(
            '\RP\Utils\Timer\ReporterInterface',
            $this->getProtectedVariable($mock, 'reporter'),
            'Reporter was not created'
        );

        $actual = $timer->getName();
        $expected = 'Page';
        $this->assertEquals(
            $expected,
            $actual,
            'Page timer has wrong name'
        );
    }

    public function testStart()
    {
        $pageTimerMock = \Phake::mock('\RP\Utils\Timer\Timer');
        $mock = \Phake::mock('\RP\Utils\Timer\TimerService');
        $this->setProtectedVariable($mock, 'pageTimer', $pageTimerMock);
        \Phake::when($mock)->start(\Phake::anyParameters())->thenCallParent();
        \Phake::when($mock)->getLastActiveTimer(\Phake::anyParameters())->thenReturn($pageTimerMock);

        $actual = $mock->start('[dummy name]');
        $this->assertInstanceOf(
            '\RP\Utils\Timer\TimerReference',
            $actual,
            'Timer was not created'
        );
    }

    public function testGetTotalTime()
    {
        $pageTimerMock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($pageTimerMock)->getTime()->thenReturn(5);

        $mock = \Phake::mock('\RP\Utils\Timer\TimerService');
        $this->setProtectedVariable($mock, 'pageTimer', $pageTimerMock);
        \Phake::when($mock)->getTotalTime(\Phake::anyParameters())->thenCallParent();

        $actual = $mock->getTotalTime();
        $expected = 5;
        $this->assertEquals(
            $expected,
            $actual,
            'Total time is wrong'
        );
    }

    public function testGetReport()
    {
        $pageTimerMock = \Phake::mock('\RP\Utils\Timer\Timer');
        $reporterMock = \Phake::mock('\RP\Utils\Timer\Reporter');
        \Phake::when($reporterMock)->getReport(\Phake::anyParameters())->thenReturn('[dummy report]');

        $mock = \Phake::mock('\RP\Utils\Timer\TimerService');
        $this->setProtectedVariable($mock, 'pageTimer', $pageTimerMock);
        \Phake::when($mock)->getReport()->thenCallParent();
        \Phake::when($mock)->getReporter()->thenReturn($reporterMock);

        $actual = $mock->getReport();
        $expected = '[dummy report]';
        $this->assertEquals(
            $expected,
            $actual,
            'Report is not generated'
        );

        //\Phake::verify($mock)->getTimerReport($pageTimerMock);
    }

    public function testGetLastActiveTimer()
    {
        $mock = \Phake::mock('\RP\Utils\Timer\TimerService');
        \Phake::when($mock)->getLastActiveTimer()->thenCallParent();
        $this->setProtectedVariable($mock, 'stack', [
            12 => ['timer 1'],
            11 => ['timer 2'],
            25 => ['timer 3'],
            14 => ['timer 4'],
        ]);

        $actual = \Phake::makeVisible($mock)->getLastActiveTimer();
        $expected = ['timer 4'];
        $this->assertEquals(
            $expected,
            $actual,
            'Getting last active timer is wrong'
        );
    }

    public function testGetLastActiveTimerException()
    {
        $mock = \Phake::mock('\RP\Utils\Timer\TimerService');
        \Phake::when($mock)->getLastActiveTimer()->thenCallParent();
        $this->setProtectedVariable($mock, 'stack', []);

        $this->setExpectedException('\RP\Utils\Timer\Exception');
        \Phake::makeVisible($mock)->getLastActiveTimer();
    }

    public function testAddToStack()
    {
        $mock = \Phake::mock('\RP\Utils\Timer\TimerService');
        \Phake::when($mock)->addToStack(\Phake::anyParameters())->thenCallParent();

        $timerMock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($timerMock)->getId()->thenReturn(123);

        \Phake::makeVisible($mock)->addToStack($timerMock);
        $actual = $this->getProtectedVariable($mock, 'stack');
        $expected = [123 => $timerMock];
        $this->assertEquals(
            $expected,
            $actual,
            'Adding to stack is wrong'
        );
    }

    public function testGetReporter()
    {
        $mock = \Phake::mock('\RP\Utils\Timer\TimerService');
        \Phake::when($mock)->getReporter()->thenCallParent();
        $this->setProtectedVariable($mock, 'reporter', 'dummy reporter');

        $actual = \Phake::makeVisible($mock)->getReporter();
        $expected = 'dummy reporter';
        $this->assertEquals(
            $expected,
            $actual,
            'reporter is wrong'
        );
    }

    public function testStopWarning()
    {
        $timerMock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($timerMock)->getId()->thenReturn(123);
        \Phake::when($timerMock)->getName()->thenReturn('fake name');
        \Phake::when($timerMock)->getDescription()->thenReturn('fake description');

        $mock = \Phake::mock('\RP\Utils\Timer\TimerService');
        \Phake::when($mock)->stop(\Phake::anyParameters())->thenCallParent();
        $this->setProtectedVariable($mock, 'stack', []);

        @$mock->stop($timerMock);
        $this->setExpectedException('\PHPUnit_Framework_Error_Warning');
        $mock->stop($timerMock);
    }

    public function testStopCorrect()
    {
        $timerMock1 = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($timerMock1)->getId()->thenReturn(123);
        $timerMock2 = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($timerMock2)->getId()->thenReturn(345);

        $mock = \Phake::mock('\RP\Utils\Timer\TimerService');
        \Phake::when($mock)->stop(\Phake::anyParameters())->thenCallParent();
        $this->setProtectedVariable($mock, 'stack', [123 => $timerMock1, 345 => $timerMock2]);

        $mock->stop($timerMock2);
        \Phake::verify($timerMock2)->stop();
    }

    public function testStopForce()
    {
        $timerMock1 = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($timerMock1)->getId()->thenReturn(123);
        $timerMock2 = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($timerMock2)->getId()->thenReturn(345);

        $mock = \Phake::mock('\RP\Utils\Timer\TimerService');
        \Phake::when($mock)->stop(\Phake::anyParameters())->thenCallParent();
        $this->setProtectedVariable($mock, 'stack', [123 => $timerMock1, 345 => $timerMock2]);

        $mock->stop($timerMock1);
        \Phake::verify($timerMock2)->stop();
        \Phake::verify($timerMock1)->stop();
    }
}
