<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/20/2017
 * Time: 1:16 PM
 */

namespace Tests\Api\Input\Request\Parameter\Calculate\RaceType;

use Api\Input\Request\Parameter\Calculate\RaceType\Course as RaceType;
use Tests\Api\Input\Request\Parameter\Calculate as Base;

class CourseTest extends Base
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
                    'getCourseId' => 1,
                    'get' => [
                        'getDefaultValues' => [
                            'course_type_code' => 'B'
                        ],
                        'getLastRaceTypeCode' => 'X'
                    ],
                    'getSelectors' => new \Models\Selectors()
                ],
                'flat'
            ],
            [
                [
                    'get' => [
                        'getDefaultValues' => [
                            'course_type_code' => 'J'
                        ]
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
