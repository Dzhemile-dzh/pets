<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 2/26/2016
 * Time: 12:47 PM
 */

namespace Tests\Bo\Bloodstock;

use Api\Input\Request\Horses\Bloodstock\Statistics as Request;
use Tests\Stubs\Bo\Bloodstock\Statistics as BoStub;
use Bo\Bloodstock\Statistics as Bo;

class StallionStatisticsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param Request\Rating $request
     * @param array          $expectedResult
     *
     * @dataProvider providerTestGetRatingStatistic
     */
    public function testGetRating(Request\Rating $request, array $expectedResult)
    {
        $bo = new BoStub\Rating($request);
        $this->assertEquals($expectedResult, $bo->getRatingStatistic($request));
    }

    /**
     * @return array
     */
    public function providerTestGetRatingStatistic()
    {
        return require 'source/providerTestGetRatingStatistic.php';
    }

    /**
     * @param Request\Yearlings $request
     * @param array             $expectedPreparedResult
     * @param array             $expectedActualResult
     *
     * @dataProvider providerTestGetYearlings
     */
    public function testGetYearlings(Request\Yearlings $request, $expectedPreparedResult, $expectedActualResult)
    {
        $bo = new BoStub\Yearlings($request);
        $receivedActualResult = $bo->getRows();
        $this->assertEquals($expectedActualResult, $receivedActualResult);

        $bo = new Bo\Yearlings($request);
        $receivedPreparedResult = $bo->prepareRows($receivedActualResult);
        $this->assertEquals($expectedPreparedResult, $receivedPreparedResult);
    }

    public function providerTestGetYearlings()
    {
        return require 'source/providerTestGetYearlings.php';
    }

    /**
     * @param Request\TopSires $request
     * @param array             $expectedPreparedResult
     * @param array             $expectedActualResult
     *
     * @dataProvider providerTestGetTopSires
     */
    public function testGetTopSires(Request\TopSires $request, $expectedPreparedResult, $expectedActualResult)
    {
        $bo = new BoStub\TopSires($request);
        $receivedActualResult = $bo->getRows();
        $this->assertEquals($expectedActualResult, $receivedActualResult);

        $bo = new Bo\TopSires($request);
        $receivedPreparedResult = $bo->prepareRows($receivedActualResult);
        $this->assertEquals($expectedPreparedResult, $receivedPreparedResult);
    }

    public function providerTestGetTopSires()
    {
        return require 'source/providerTestGetTopSires.php';
    }

    /**
     * @param Request\TopStallions $request
     * @param array                $expectedActualResult
     *
     * @dataProvider providerTestGetTopStallions
     */
    public function testGetTopStallions(Request\TopStallions $request, $expectedActualResult)
    {
        $bo = new BoStub\TopStallions($request);
        $this->assertEquals($expectedActualResult, $bo->getTopStallions());
    }

    public function providerTestGetTopStallions()
    {
        return require 'source/providerTestGetTopStallions.php';
    }
}
