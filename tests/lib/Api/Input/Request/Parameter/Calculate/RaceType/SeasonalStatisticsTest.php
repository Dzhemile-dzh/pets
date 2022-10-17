<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/20/2017
 * Time: 11:50 AM
 */

namespace Tests\Api\Input\Request\Parameter\Calculate\RaceType;

use Api\Input\Request\Parameter\Calculate\RaceType\SeasonalStatistics as RaceType;
use Tests\Api\Input\Request\Parameter\Calculate as Base;

class SeasonalStatisticsTest extends Base
{
    /**
     * @param $requestMethods
     * @param $expectedRaceType
     *
     * @dataProvider dataProviderTestGetRaceTypeSuccess
     */
    public function testGetRaceTypeSuccess($requestMethods, $expectedRaceType)
    {
        $raceType = new RaceType();
        $this->setUpCalculation($requestMethods, $raceType);
        $this->assertSame($expectedRaceType, $raceType->getValue());
    }

    public function dataProviderTestGetRaceTypeSuccess()
    {
        return [
            [
                [
                    'getSeasonData' => [
                        (Object)[
                            'season_type_code' => 'F'
                        ]
                    ],
                    'get' => [
                        'get' => new \stdClass()
                    ],
                    'getSelectors' => new \Models\Selectors()
                ],
                'flat'
            ],
            [
                [
                    'getSeasonData' => [
                        (Object)[
                            'season_type_code' => 'J'
                        ]
                    ],
                    'get' => [
                        'get' => new \stdClass()
                    ],
                    'getSelectors' => new \Models\Selectors()
                ],
                'jumps'
            ],
        ];
    }

    /**
     * @param $requestMethods
     *
     * @dataProvider dataProviderTestGetRaceTypeNull
     */
    public function testGetRaceTypeNull($requestMethods)
    {
        $raceType = new RaceType();
        $this->setUpCalculation($requestMethods, $raceType);

        $this->assertNull($raceType->getValue());
    }

    public function dataProviderTestGetRaceTypeNull()
    {
        return [
            [
                [
                    'get' => null,
                ]
            ],
        ];
    }
}
