<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/28/2016
 * Time: 5:03 PM
 */

namespace Tests;

class GetOverallPrizeMoneyTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $expected
     * @param $pound
     * @param $euro
     * @param $rate
     *
     * @dataProvider dataProviderTestGetOverallPrizeMoneyRateSuccess
     */
    public function testGetOverallPrizeMoneySuccess($expected, $pound, $euro, $rate)
    {
        $mock = $this->getMockForTrait('\Api\Row\Methods\SeasonalStatistics\GetOverallPrizeMoney');

        $this->assertEquals($expected, $mock->getOverallPrizeMoney($pound, $euro, $rate));
    }

    public function dataProviderTestGetOverallPrizeMoneyRateSuccess()
    {
        return [
            [15, 10, 1, 0.2],
            [10, 10, 0, 1.5],
            [10, 0, 10, 1],
            [15, '10', 1, 0.2],
            [10, 10, 0, '1.5'],
            [10, 0, '10', 1],
        ];
    }

    /**
     * @param $rate
     *
     * @dataProvider dataProviderTestGetOverallPrizeMoneyRateZero
     */
    public function testGetOverallPrizeMoneyRateZero($rate)
    {
        $mock = $this->getMockForTrait('\Api\Row\Methods\SeasonalStatistics\GetOverallPrizeMoney');

        $this->assertNull($mock->getOverallPrizeMoney(1, 1, $rate));
    }

    public function dataProviderTestGetOverallPrizeMoneyRateZero()
    {
        return [
            [''],
            [0],
            [false],
            [-0.01],
            [-5],
        ];
    }

    /**
     * @param $pound
     * @param $euro
     *
     * @dataProvider dataProviderTestGetOverallPrizeMoneyPoundOrEuroNegative
     */
    public function testGetOverallPrizeMoneyPoundOrEuroNegative($pound, $euro)
    {
        $mock = $this->getMockForTrait('\Api\Row\Methods\SeasonalStatistics\GetOverallPrizeMoney');

        $this->assertNull($mock->getOverallPrizeMoney($pound, $euro, 1));
    }

    public function dataProviderTestGetOverallPrizeMoneyPoundOrEuroNegative()
    {
        return [
            [1,-1],
            [-1,1],
            [-1,0],
            [0,-1],
            [1,-0.03],
            [-0.03, ''],
        ];
    }
}
