<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 2/26/2016
 * Time: 12:47 PM
 */

namespace Tests\Bo\Bloodstock;

use Api\Input\Request\Horses\Bloodstock\Stallion as Request;
use Tests\Stubs\Bo\Bloodstock as Bo;
use Tests\Stubs\Models\Selectors;

/**
 * Class StallionTest
 *
 * @package Tests\Bo\Bloodstock
 */
class StallionTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param Request\NickDescendants $request
     * @param                         $expectedResult
     *
     * @dataProvider providerTestGetNickDescendants
     */
    public function testGetNickDescendants(Request\NickDescendants $request, $expectedResult)
    {
        $bo = new Bo\Stallion\NickDescendants($request);
        $this->assertEquals($expectedResult, $bo->getNickDescendants());
    }

    /**
     * @return array
     */
    public function providerTestGetNickDescendants()
    {
        return require 'source/providerTestGetNickDescendants.php';
    }

    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyStatisticsTop $request
     * @param array                                                              $expectedResult
     *
     * @dataProvider providerTestGetProgenyStatisticsTop
     */
    public function testGetProgenyStatisticsTop(Request\ProgenyStatisticsTop $request, array $expectedResult)
    {
        $bo = new Bo\Stallion\ProgenyStatisticsTop($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getRows())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetProgenyStatisticsTop()
    {
        return require 'source/providerTestGetProgenyStatisticsTop.php';
    }

    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyBroodmareSiresStatisticsTop $request
     * @param array                                                                            $expectedResult
     *
     * @dataProvider providerTestGetProgenyBroodmareSiresStatisticsTop
     */
    public function testGetProgenyBroodmareSiresStatisticsTop(
        Request\ProgenyBroodmareSiresStatisticsTop $request,
        array $expectedResult
    ) {
        $bo = new Bo\Stallion\ProgenyStatisticsTop($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getProgenyBroodmareSires())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetProgenyBroodmareSiresStatisticsTop()
    {
        return require 'source/providerTestGetProgenyBroodmareSiresStatisticsTop.php';
    }

    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyEntries $request
     * @param array                                                        $expectedResult
     *
     * @dataProvider providerTestGetProgenyEntries
     */
    public function testGetProgenyEntries(Request\ProgenyEntries $request, array $expectedResult)
    {
        $bo = new Bo\Stallion\ProgenyEntries($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getProgenyEntries($request))
        );
    }

    /**
     * @return array
     */
    public function providerTestGetProgenyEntries()
    {
        return require 'source/providerTestGetProgenyEntries.php';
    }

    /**
     * @param Request\FeeHistory $request
     * @param array              $expectedResult
     *
     * @dataProvider providerTestGetFeeHistory
     */
    public function testGetFeeHistory(Request\FeeHistory $request, array $expectedResult)
    {
        $bo = new Bo\Stallion\FeeHistory($request);
        $this->assertEquals($expectedResult, $bo->getFeeHistory());
    }

    /**
     * @return array
     */
    public function providerTestGetFeeHistory()
    {
        return require 'source/providerTestGetFeeHistory.php';
    }

    /**
     * @param Request\SaleStatistics $request
     * @param                        $expectedActualResult
     * @param                        $expectedPreparedResult
     *
     * @dataProvider providerTestGetSaleStatistics
     */
    public function testGetSaleStatistics(
        Request\SaleStatistics $request,
        $expectedPreparedResult,
        $expectedActualResult
    ) {
        $bo = new Bo\Stallion\SaleStatistics($request);
        $receivedActualResult = $bo->getRows();
        $this->assertEquals($expectedActualResult, $receivedActualResult);

        $receivedPreparedResult = $bo->prepareRows($receivedActualResult);
        $this->assertEquals($expectedPreparedResult, $receivedPreparedResult);
    }

    public function providerTestGetSaleStatistics()
    {
        return require 'source/providerTestGetSaleStatistics.php';
    }

    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyStatisticsGoingForm $request
     * @param array                                                                    $expectedResult
     *
     * @dataProvider providerTestGetProgenyStatisticsGoingForm
     */
    public function testGetProgenyStatisticsGoingForm(Request\ProgenyStatisticsGoingForm $request, $expectedResult)
    {
        $bo = new Bo\Stallion\ProgenyStatisticsGoingForm($request);

        $this->assertEquals($expectedResult, $bo->getGoingForm());
    }

    /**
     * @return array
     */
    public function providerTestGetProgenyStatisticsGoingForm()
    {
        return require 'source/providerTestGetProgenyStatisticsGoingForm.php';
    }
}
