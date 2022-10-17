<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/5/2016
 * Time: 10:33 AM
 */

namespace Tests\Bo\Bloodstock;

use Api\Input\Request\Horses\Bloodstock\SalesStatistics as Request;
use Tests\Stubs\Bo\Bloodstock\SalesStatistics as Bo;

class SalesStatisticsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param Request\Sires $request
     * @param               $expectedActualResult
     * @param               $expectedPreparedResult
     *
     * @dataProvider providerTestGetSaleStatistics
     */
    public function testGetSires(Request\Sires $request, $expectedActualResult, $expectedPreparedResult)
    {
        $bo = new Bo\Sires($request);
        $receivedActualResult = $bo->getRows();
        $this->assertEquals($expectedActualResult, $receivedActualResult);

        $receivedPreparedResult = $bo->prepareRows($receivedActualResult);
        $this->assertEquals($expectedPreparedResult, $receivedPreparedResult);
    }

    public function providerTestGetSaleStatistics()
    {
        return require 'source/providerTestGetSires.php';
    }

    /**
     * @param Request\Sales $request
     * @param               $expectedActualResult
     * @param               $expectedPreparedResult
     *
     * @dataProvider providerTestGetSalesStatisticsSales
     */
    public function testGetSales(Request\Sales $request, $expectedActualResult, $expectedPreparedResult)
    {
        $bo = new Bo\Sales($request);
        $receivedActualResult = $bo->getRows();
        $this->assertEquals($expectedActualResult, $receivedActualResult);

        $receivedPreparedResult = $bo->prepareRows($receivedActualResult);
        $this->assertEquals($expectedPreparedResult, $receivedPreparedResult);
    }

    public function providerTestGetSalesStatisticsSales()
    {
        return require 'source/providerTestGetSales.php';
    }

    /**
     * @param Request\Vendors $request
     * @param                 $expectedActualResult
     * @param                 $expectedPreparedResult
     *
     * @dataProvider providerTestGetSalesStatisticsVendors
     */
    public function testGetVendors(Request\Vendors $request, $expectedActualResult, $expectedPreparedResult)
    {
        $bo = new Bo\Vendors($request);
        $receivedActualResult = $bo->getRows();
        $this->assertEquals($expectedActualResult, $receivedActualResult);

        $receivedPreparedResult = $bo->prepareRows($receivedActualResult);
        $this->assertEquals($expectedPreparedResult, $receivedPreparedResult);
    }

    public function providerTestGetSalesStatisticsVendors()
    {
        return require 'source/providerTestGetSalesStatisticsVendors.php';
    }

    /**
     * @param Request\Buyers $request
     * @param                $expectedActualResult
     * @param                $expectedPreparedResult
     *
     * @dataProvider providerTestGetSalesStatisticsBuyers
     */
    public function testGetBuyers(Request\Buyers $request, $expectedActualResult, $expectedPreparedResult)
    {
        $bo = new Bo\Buyers($request);
        $receivedActualResult = $bo->getRows();
        $this->assertEquals($expectedActualResult, $receivedActualResult);

        $receivedPreparedResult = $bo->prepareRows($receivedActualResult);
        $this->assertEquals($expectedPreparedResult, $receivedPreparedResult);
    }

    /**
     * @return array
     */
    public function providerTestGetSalesStatisticsBuyers()
    {
        return require 'source/providerTestGetSalesStatisticsBuyers.php';
    }
}
