<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 1/12/2017
 * Time: 1:33 PM
 */

namespace Tests\Bo\StakesData;

use Api\Input\Request\Horses\StakesData\Horse as Request;
use PHPUnit_Framework_TestCase;
use Tests\Stubs\Bo\StakesData\Horse;

class HorseTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider dataProviderTestGetData
     *
     * @param $request
     * @param $expectedResult
     */
    public function testGetData($request, $expectedResult)
    {
        $bo = new Horse($request);
        $this->assertEquals($expectedResult, $bo->getData());
    }

    /**
     * @return array
     */
    public function dataProviderTestGetData()
    {
        return [
            [
                new Request(
                    [],
                    [
                        'horseId' => 1
                    ]
                ),
                [
                    'last_7_days' => \Api\Row\StakesData\Horse::createFromArray(
                        [
                            'section' => 'last_7_days',
                            'wins' => 0,
                            'runs' => 1,
                            'stake' => '-1.00000000000000',
                        ]
                    ),
                    'last_14_days' => \Api\Row\StakesData\Horse::createFromArray(
                        [
                            'section' => 'last_14_days',
                            'wins' => 0,
                            'runs' => 1,
                            'stake' => '-1.00000000000000',
                        ]
                    ),
                    'last_month' => \Api\Row\StakesData\Horse::createFromArray(
                        [
                            'section' => 'last_month',
                            'wins' => 0,
                            'runs' => 2,
                            'stake' => '-2.00000000000000',
                        ]
                    ),
                    'last_3_months' => \Api\Row\StakesData\Horse::createFromArray(
                        [
                            'section' => 'last_3_months',
                            'wins' => 2,
                            'runs' => 6,
                            'stake' => '17.00000000000000',
                        ]
                    ),
                    'last_6_months' => \Api\Row\StakesData\Horse::createFromArray(
                        [
                            'section' => 'last_6_months',
                            'wins' => 3,
                            'runs' => 14,
                            'stake' => '13.00000000000000',
                        ]
                    ),
                ]
            ]
        ];
    }

    /**
     * @dataProvider dataProviderTestGetCurrentSeason
     *
     * @param $request
     * @param $expectedResult
     */
    public function testGetCurrentSeason($request, $expectedResult)
    {
        $bo = new Horse($request);
        $this->assertEquals($expectedResult, $bo->getCurrentSeason());
    }

    /**
     * @return array
     */
    public function dataProviderTestGetCurrentSeason()
    {
        return [
            [
                new Request(
                    [],
                    [
                        'horseId' => 1
                    ]
                ),
                [
                    'flat' => \Api\Row\StakesData\Horse::createFromArray(
                        [
                            'race_type' => 'flat',
                            'wins' => 0,
                            'runs' => 1,
                            'stake' => '-1.00000000000000',
                        ]
                    ),
                    'jumps' => null,
                ]
            ]
        ];
    }
}
