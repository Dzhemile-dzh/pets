<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/20/2017
 * Time: 2:35 PM
 */

namespace Tests\Api\Input\Request\Parameter\Calculate\RaceType\RaceMeetings;

use Api\Input\Request\Parameter\Calculate\RaceType\RaceMeetings\Favourites as RaceType;
use Tests\Api\Input\Request\Parameter\Calculate as Base;

class Favourites extends Base
{
    /**
     * @param $requestMethods
     * @param $expectedRaceType
     *
     * @dataProvider dataProviderTestGetRaceType
     */
    public function testGetRaceType($requestMethods, $expectedRaceType)
    {
        $raceType = new RaceType();
        $this->setUpCalculation($requestMethods, $raceType);
        $this->assertSame($expectedRaceType, $raceType->getValue());
    }

    public function dataProviderTestGetRaceType()
    {
        return [
            [
                [
                    'getId' => 1,
                    'get' => [
                        'getDefaultRaceTypeCode' => 'flat'
                    ],
                ],
                'flat'
            ],
            [
                [
                    'get' => null,
                ],
                null
            ],
        ];
    }
}
