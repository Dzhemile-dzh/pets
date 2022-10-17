<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 5/18/2016
 * Time: 12:37 AM
 */

namespace Tests\Bo\Bloodstock;

use Api\Input\Request\Horses\Bloodstock\StallionBook as Request;
use Tests\Stubs\Bo\Bloodstock as Bo;

class StallionBookTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Input\Request\Horses\Bloodstock\StallionBook\Index $request
     * @param array                                                       $expectedResult
     *
     * @dataProvider providerTestStallionBookGetSearchResult
     */
    public function testGetSearchResult($request, $expectedResult)
    {
        $stallionBook = new \Tests\Stubs\Bo\Bloodstock\StallionBook($request);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($stallionBook->getSearchResult($request))
        );
    }

    /**
     * @return array
     */
    public function providerTestStallionBookGetSearchResult()
    {
        return require 'source/providerTestStallionBookGetSearchResult.php';
    }

    /**
     * @param \Api\Input\Request\Horses\Bloodstock\StallionBook\Names $request
     * @param array                                                   $expectedResult
     *
     * @dataProvider providerTestStallionBookGetNames
     */
    public function testGetNames($request, $expectedResult)
    {
        $stallionBook = new \Tests\Stubs\Bo\Bloodstock\StallionBook($request);
        $actual = $stallionBook->getNames();

        $this->assertEquals(
            $expectedResult,
            $actual
        );
    }

    public function providerTestStallionBookGetNames()
    {
        return require 'source/providerTestStallionBookGetNames.php';
    }
}
