<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/19/2017
 * Time: 4:49 PM
 */

namespace Tests\Api\Input\Request\Parameter\Calculate;

use Api\Input\Request\Parameter\Calculate;
use Tests\Api\Input\Request\Parameter\Calculate as Base;

class RaceTypeTest extends Base
{
    /**
     * @param $requestMethods
     * @param $expectedRaceType
     *
     * @dataProvider dataProviderTestGetRaceTypeSuccess
     */
    public function testGetRaceTypeSuccess($requestMethods, $expectedRaceType)
    {
        $raceType = new Calculate\RaceType();
        $this->setUpCalculation($requestMethods, $raceType);
        $this->assertSame($expectedRaceType, $raceType->getValue());
    }

    public function dataProviderTestGetRaceTypeSuccess()
    {
        return [
            [
                [
                    'getId' => 1,
                    'isParameterProvided' => true,
                    'getCountryCode' => 'GB',
                    'get' => [
                        'get' => (Object)[
                            'race_type_code' => 'F'
                        ]
                    ],
                    'getSelectors' => new \Models\Selectors()
                ],
                'flat'
            ],
            [
                [
                    'getId' => 1,
                    'isParameterProvided' => false,
                    'get' => [
                        'get' => (Object)[
                            'race_type_code' => 'J'
                        ],
                    ],
                    'getSelectors' => new \Models\Selectors()
                ],
                'jumps'
            ],
            [
                [
                    'getId' => 1,
                    'isParameterProvided' => false,
                    'get' => [
                        'get' => (Object)[
                            'race_type_code' => ''
                        ],
                    ],
                    'getSelectors' => new \Models\Selectors()
                ],
                'flat'
            ]
        ];
    }

    /**
     * @param $requestMethods
     *
     * @dataProvider dataProviderTestGetRaceTypeFailure
     */
    public function testGetRaceTypeFailure($requestMethods)
    {
        $raceType = new Calculate\RaceType();
        $this->setUpCalculation($requestMethods, $raceType);
        $this->expectException('Api\Exception\NotFound');

        $raceType->getValue();
    }

    public function dataProviderTestGetRaceTypeFailure()
    {
        return [
            [
                [
                    'getId' => 1,
                    'isParameterProvided' => false,
                    'get' => [
                        'get' => null,
                    ],
                ]
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
        $raceType = new Calculate\RaceType();
        $this->setUpCalculation($requestMethods, $raceType);

        $this->assertNull($raceType->getValue());
    }

    public function dataProviderTestGetRaceTypeNull()
    {
        return [
            [
                [
                    'getId' => 1,
                    'isParameterProvided' => false,
                    'get' => null,
                ]
            ],
        ];
    }
}
