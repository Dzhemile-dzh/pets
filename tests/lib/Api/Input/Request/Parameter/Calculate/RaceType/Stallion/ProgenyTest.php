<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/20/2017
 * Time: 2:42 PM
 */

namespace Tests\Api\Input\Request\Parameter\Calculate\RaceType\Stallion;

use Api\Input\Request\Parameter\Calculate\RaceType\Bloodstock\Stallion as RaceType;
use Tests\Api\Input\Request\Parameter\Calculate as Base;

class ProgenyTest extends Base
{
    /**
     * @param $requestMethods
     * @param $expectedRaceType
     *
     * @dataProvider dataProviderTestGetRaceTypeProgenyEntries
     */
    public function testGetRaceTypeProgenyEntries($requestMethods, $expectedRaceType)
    {
        $raceType = new RaceType\ProgenyEntries();
        $this->setUpCalculation($requestMethods, $raceType);
        $this->assertSame($expectedRaceType, $raceType->getValue());
    }

    public function dataProviderTestGetRaceTypeProgenyEntries()
    {
        return [
            [
                [
                    'getId' => 1,
                    'get' => [
                        'getDefaultRaceType' => 'jumps'
                    ],
                ],
                'jumps'
            ],
            [
                [
                    'get' => null,
                ],
                null
            ],
        ];
    }

    /**
     * @param $requestMethods
     * @param $expectedRaceType
     *
     * @dataProvider dataProviderTestGetRaceTypeProgenyHorses
     */
    public function testGetRaceTypeProgenyHorses($requestMethods, $expectedRaceType)
    {
        $raceType = new RaceType\ProgenyHorses();
        $this->setUpCalculation($requestMethods, $raceType);
        $this->assertSame($expectedRaceType, $raceType->getValue());
    }

    public function dataProviderTestGetRaceTypeProgenyHorses()
    {
        return [
            [
                [
                    'getId' => 1,
                    'get' => [
                        'getFirstAndLastSeasons' => [[1], [1]],
                        'getStartEndSeasonDate' => [new \DateTime(), new \DateTime()],
                        'getDefaultProgenyRaceType' => 'jumps'
                    ],
                ],
                'jumps'
            ],
            [
                [
                    'getId' => 1,
                    'get' => [
                        'getFirstAndLastSeasons' => [],
                        'getCurrentSeason' => (Object)[
                            'raceType' => 'flat'
                        ]
                    ],
                ],
                'flat'
            ],
            [
                [
                    'getId' => 1,
                    'get' => null,
                ],
                null
            ]
        ];
    }

    /**
     * @param $requestMethods
     * @param $expectedRaceType
     *
     * @dataProvider dataProviderTestGetRaceTypeProgenyResults
     */
    public function testGetRaceTypeProgenyResults($requestMethods, $expectedRaceType)
    {
        $raceType = new RaceType\ProgenyResults();
        $this->setUpCalculation($requestMethods, $raceType);
        $this->assertSame($expectedRaceType, $raceType->getValue());
    }

    public function dataProviderTestGetRaceTypeProgenyResults()
    {
        return [
            [
                [
                    'getSeason' => (Object)[
                        'raceType' => 'flat'
                    ],
                ],
                'flat'
            ],
            [
                [
                    'getSeason' => null,
                ],
                null
            ],
        ];
    }
}
