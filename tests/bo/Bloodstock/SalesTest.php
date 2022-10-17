<?php

namespace Tests\Bo\Bloodstock;

use Api\Input\Request\Horses\Bloodstock\Sales as Request;
use Tests\Stubs\Bo\Bloodstock as Bo;

/**
 * Class SalesTest
 *
 * @package Tests\Bo\Bloodstock
 */
class SalesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Sales\UpcomingSales $request
     * @param array                                                    $expectedResult
     *
     * @dataProvider providerTestGetUpcomingSales
     */
    public function testGetUpcomingSales(Request\UpcomingSales $request, array $expectedResult)
    {
        $bo = new Bo\Sales($request);
        $this->assertEquals(
            $expectedResult,
            $bo->getUpcomingSales($request)
        );
    }

    /**
     * @return array
     */
    public function providerTestGetUpcomingSales()
    {
        return require 'source/providerTestGetUpcomingSales.php';
    }

    /**
     * @param Request\SalesResults $request
     * @param array                $expectedResult
     *
     * @dataProvider providerTestGetSalesResults
     */
    public function testGetSalesResults(Request\SalesResults $request, array $expectedResult)
    {
        $bo = new Bo\Sales($request);
        $this->assertEquals(
            $expectedResult,
            $bo->getSalesResults($request)
        );
    }

    public function providerTestGetSalesResults()
    {
        return require 'source/providerTestGetSalesResults.php';
    }

    /**
     * @param Request\Catalogue $request
     * @param array             $expectedResult
     *
     * @dataProvider providerTestGetCatalogue
     */
    public function testGetCatalogue(Request\Catalogue $request, array $expectedResult)
    {
        $bo = new Bo\Sales($request);
        $this->assertEquals(
            $expectedResult,
            $bo->getCatalogue($request)
        );
    }

    /**
     * @return array
     */
    public function providerTestGetCatalogue()
    {
        return require 'source/providerTestGetCatalogue.php';
    }

    /**
     * @param Request\CatalogueSires|Request\Sires $request
     * @param array                                $expectedResult
     *
     * @dataProvider providerTestGetCatalogueSires
     */
    public function testGetCatalogueSires(Request\CatalogueSires $request, array $expectedResult)
    {
        $bo = new Bo\Sales($request);
        $this->assertEquals(
            $expectedResult,
            $bo->getCatalogueSires($request)
        );
    }

    /**
     * @return array
     */
    public function providerTestGetCatalogueSires()
    {
        return require 'source/providerTestGetCatalogueSires.php';
    }

    /**
     * @param Request\CataloguePreviouslySold $request
     * @param array                           $expectedResult
     *
     * @dataProvider providerTestGetPreviouslySold
     */
    public function testGetPreviouslySold(Request\CataloguePreviouslySold $request, array $expectedResult)
    {
        $bo = new Bo\Sales($request);
        $this->assertEquals(
            $expectedResult,
            $bo->getPreviouslySold()
        );
    }

    /**
     * @return array
     */
    public function providerTestGetPreviouslySold()
    {
        return require 'source/providerTestGetPreviouslySold.php';
    }

    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Sales\CompanyNames $request
     * @param array                                                   $expectedResult
     *
     * @dataProvider providerTestGetCompanyNames
     */
    public function testGetCompanyNames(Request\CompanyNames $request, array $expectedResult)
    {
        $bo = new Bo\Sales($request);
        $this->assertEquals(
            $expectedResult,
            $bo->getSalesCompaniesList($request)
        );
    }

    /**
     * @return array
     */
    public function providerTestGetCompanyNames()
    {
        return require 'source/providerTestGetCompanyNames.php';
    }

    /**
     * @param Request\UpcomingNames $request
     * @param array                 $expectedResult
     *
     * @dataProvider providerTestGetUpcomingNames
     */
    public function testGetUpcomingNames(Request\UpcomingNames $request, $expectedResult)
    {
        $bo = new Bo\Sales($request);
        $this->assertEquals($expectedResult, $bo->getUpcomingNames($request));
    }

    public function providerTestGetUpcomingNames()
    {
        return require 'source/providerTestGetUpcomingNames.php';
    }
}
