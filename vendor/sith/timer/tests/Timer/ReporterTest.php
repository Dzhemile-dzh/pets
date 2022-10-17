<?php
/**
 * Created by PhpStorm.
 * User: Roman_Orishko
 * Date: 19.05.2016
 * Time: 17:57
 */

namespace RP\Tests\Timer;


class ReporterTest extends \RP\Tests\AbstractTest
{
    public function testGetTimerReportWithoutSubtimers()
    {
        $timerMock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($timerMock)->getName()->thenReturn('Dummy timer');
        \Phake::when($timerMock)->getTime()->thenReturn(1.23456);
        \Phake::when($timerMock)->hasTimers()->thenReturn(false);

        $mock = \Phake::mock('\RP\Utils\Timer\Reporter');
        \Phake::when($mock)->getReport(\Phake::anyParameters())->thenCallParent();
        \Phake::when($mock)->getTimerReport(\Phake::anyParameters())->thenCallParent();

        $actual = \Phake::makeVisible($mock)->getReport($timerMock);
        $expected = "Dummy timer : 1.23 s [100.00%]\n";
        $this->assertEquals(
            $expected,
            $actual,
            'Report without subtimers is wrong'
        );
    }

    public function testGetTimerReportWithSubtimersAndIndent()
    {
        $mock1 = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($mock1)->getName()->thenReturn('Dummy subtimer 1');
        \Phake::when($mock1)->getTime()->thenReturn(2.345);
        \Phake::when($mock1)->hasTimers()->thenReturn(false);

        $mock2 = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($mock2)->getName()->thenReturn('Dummy subtimer 2');
        \Phake::when($mock2)->getTime()->thenReturn(12.3354);
        \Phake::when($mock2)->hasTimers()->thenReturn(false);

        $timerMock = \Phake::mock('\RP\Utils\Timer\Timer');
        \Phake::when($timerMock)->getName()->thenReturn('Dummy timer');
        \Phake::when($timerMock)->getTime()->thenReturn(16.23456);
        \Phake::when($timerMock)->getOwnTime()->thenReturn(0.23456);
        \Phake::when($timerMock)->hasTimers()->thenReturn(true);
        \Phake::when($timerMock)->getTimers()->thenReturn([$mock1, $mock2]);

        $mock = \Phake::mock('\RP\Utils\Timer\Reporter');
        \Phake::when($mock)->getTimerReport(\Phake::anyParameters())->thenCallParent();

        $actual = \Phake::makeVisible($mock)->getTimerReport($timerMock, $timerMock->getTime(), 1);
        $expected = "    Dummy timer :\n        Dummy subtimer 1 : 2.35 s [14.44%]\n        Dummy subtimer 2 : 12.34 s [75.98%]\n    Total: 16.23 s [100.00%] (own time 0.23 s)\n";
        $this->assertEquals(
            $expected,
            $actual,
            'Report without subtimers is wrong'
        );
    }
}