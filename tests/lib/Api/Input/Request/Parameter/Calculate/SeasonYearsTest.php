<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/19/2017
 * Time: 4:32 PM
 */

namespace Tests\Api\Input\Request\Parameter\Calculate;

use Api\Input\Request\Parameter\Calculate;

class SeasonYearsTest extends \PHPUnit\Framework\TestCase
{
    public function testGetSeasonYearBeginSuccess()
    {
        $request = $this
            ->getMockBuilder('\Api\Input\Request\HorsesRequest')
            ->disableOriginalConstructor()
            ->setMethods(['isRegisterEmpty', 'getSeasonDateBegin'])
            ->getMockForAbstractClass();
        $request->expects($this->any())->method('isRegisterEmpty')->willReturn(false);
        $request->expects($this->any())->method('getSeasonDateBegin')->willReturn('2017-01-19 16:42:59');

        $calculate = new Calculate\SeasonYearBegin();
        $calculate->setRequest($request);

        $this->assertSame(2017, $calculate->getValue());
    }

    public function testGetSeasonYearBeginFailure()
    {
        $request = $this
            ->getMockBuilder('\Api\Input\Request\HorsesRequest')
            ->disableOriginalConstructor()
            ->setMethods(['isRegisterEmpty', 'getSeasonDateBegin'])
            ->getMockForAbstractClass();
        $request->expects($this->any())->method('isRegisterEmpty')->willReturn(true);

        $calculate = new Calculate\SeasonYearBegin();
        $calculate->setRequest($request);

        $this->assertSame(null, $calculate->getValue());
    }

    public function testGetSeasonYearEndSuccess()
    {
        $request = $this
            ->getMockBuilder('\Api\Input\Request\HorsesRequest')
            ->disableOriginalConstructor()
            ->setMethods(['isRegisterEmpty', 'getSeasonDateEnd'])
            ->getMockForAbstractClass();
        $request->expects($this->any())->method('isRegisterEmpty')->willReturn(false);
        $request->expects($this->any())->method('getSeasonDateEnd')->willReturn('2017-01-19 16:42:59');

        $calculate = new Calculate\SeasonYearEnd();
        $calculate->setRequest($request);

        $this->assertSame(2017, $calculate->getValue());
    }

    public function testGetSeasonYearEndFailure()
    {
        $request = $this
            ->getMockBuilder('\Api\Input\Request\HorsesRequest')
            ->disableOriginalConstructor()
            ->setMethods(['isRegisterEmpty', 'getSeasonDateEnd'])
            ->getMockForAbstractClass();
        $request->expects($this->any())->method('isRegisterEmpty')->willReturn(true);

        $calculate = new Calculate\SeasonYearEnd();
        $calculate->setRequest($request);

        $this->assertSame(null, $calculate->getValue());
    }
}
