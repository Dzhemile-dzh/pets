<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/20/2017
 * Time: 9:46 AM
 */

namespace Tests\Api\Input\Request\Parameter\Calculate;

use Api\Input\Request\Parameter\Calculate;
use Tests\Api\Input\Request\Parameter\Calculate as Base;

class RaceStatusTypeTest extends Base
{
    /**
     * @param $requestMethods
     * @param $expectedRaceStatusType
     *
     * @dataProvider dataProviderTestGetRaceStatusTypeSuccess
     */
    public function testGetRaceStatusTypeSuccess($requestMethods, $expectedRaceStatusType)
    {
        $raceStatusType = new Calculate\RaceStatusType();
        $this->setUpCalculation($requestMethods, $raceStatusType);
        $this->assertSame($expectedRaceStatusType, $raceStatusType->getValue());
    }

    public function dataProviderTestGetRaceStatusTypeSuccess()
    {
        return [
            [
                [
                    'getId' => 1,
                    'getSeasonDateBegin' => '2016-04-03T14:00:00',
                    'getSeasonDateEnd' => '2017-04-03T14:00:00',
                    'set' => null,
                    'get' => [
                        'getProfile' => (Object)[
                            'country_code' => 'USA'
                        ],
                        'checkExistenceOfBigRaces' => true,
                    ],
                ],
                Calculate\RaceStatusType::RACE_STATUS_BIG
            ],
            [
                [
                    'getId' => 1,
                    'getSeasonDateBegin' => '2016-04-03T14:00:00',
                    'getSeasonDateEnd' => '2017-04-03T14:00:00',
                    'set' => null,
                    'get' => [
                        'getProfile' => (Object)[
                            'country_code' => null
                        ],
                        'checkExistenceOfBigRaces' => false,
                    ],
                ],
                Calculate\RaceStatusType::RACE_STATUS_ALL
            ]
        ];
    }

    /**
     * @param $requestMethods
     *
     * @dataProvider dataProviderTestGetRaceStatusTypeNull
     */
    public function testGetRaceStatusTypeNull($requestMethods)
    {
        $raceStatusType = new Calculate\RaceStatusType();
        $this->setUpCalculation($requestMethods, $raceStatusType);

        $this->assertNull($raceStatusType->getValue());
    }

    public function dataProviderTestGetRaceStatusTypeNull()
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
