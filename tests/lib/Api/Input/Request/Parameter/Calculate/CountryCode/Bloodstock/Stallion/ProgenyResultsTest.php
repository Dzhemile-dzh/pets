<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/20/2017
 * Time: 3:03 PM
 */

namespace Tests\Api\Input\Request\Parameter\Calculate\CountryCode\Bloodstock\Stallion;

use \Api\Input\Request\Parameter\Calculate\CountryCode\Bloodstock\Stallion\ProgenyResults as CountryCode;
use Tests\Api\Input\Request\Parameter\Calculate as Base;

class ProgenyResultsTest extends Base
{
    /**
     * @param $requestMethods
     * @param $expectedRaceType
     *
     * @dataProvider dataProviderTestGetRaceTypeProgenyEntries
     */
    public function testGetRaceTypeProgenyEntries($requestMethods, $expectedRaceType)
    {
        $raceType = new CountryCode();
        $this->setUpCalculation($requestMethods, $raceType);
        $this->assertSame($expectedRaceType, $raceType->getValue());
    }

    /**
     * @return array
     */
    public function dataProviderTestGetRaceTypeProgenyEntries()
    {
        return [
            [
                [
                    'getSeason' => (Object)[
                        'countryCode' => 'IRE'
                    ],
                ],
                'IRE'
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
