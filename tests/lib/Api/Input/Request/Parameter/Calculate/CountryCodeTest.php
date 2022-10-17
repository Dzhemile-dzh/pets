<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/20/2017
 * Time: 10:48 AM
 */

namespace Tests\Api\Input\Request\Parameter\Calculate;

use Api\Input\Request\Parameter\Calculate;
use Tests\Api\Input\Request\Parameter\Calculate as Base;

class CountryCodeTest extends Base
{
    /**
     * @param $requestMethods
     * @param $expectedCountryCode
     *
     * @dataProvider dataProviderTestGetCountryCodeSuccess
     */
    public function testGetCountryCodeSuccess($requestMethods, $expectedCountryCode)
    {
        $countryCode = new Calculate\CountryCode();
        $this->setUpCalculation($requestMethods, $countryCode);
        $this->assertSame($expectedCountryCode, $countryCode->getValue());
    }

    public function dataProviderTestGetCountryCodeSuccess()
    {
        return [
            [
                [
                    'getId' => 1,
                    'isParameterProvided' => true,
                    'getRaceType' => 'flat',
                    'get' => [
                        'get' => (Object)[
                            'country_code' => 'GB'
                        ]
                    ],
                    'getSelectors' => new \Models\Selectors()
                ],
                'GB'
            ],
            [
                [
                    'getId' => 1,
                    'isParameterProvided' => false,
                    'get' => [
                        'get' => (Object)[
                            'country_code' => 'IRE'
                        ]
                    ],
                ],
                'IRE'
            ],
            [
                [
                    'getId' => 1,
                    'isParameterProvided' => false,
                    'get' => [
                        'get' => (Object)[
                            'country_code' => 'USA'
                        ]
                    ],
                ],
                'GB'
            ],
        ];
    }

    /**
     * @param $requestMethods
     *
     * @dataProvider dataProviderTestGetCountryCodeFailure
     */
    public function testGetCountryCodeFailure($requestMethods)
    {
        $countryCode = new Calculate\CountryCode();
        $this->setUpCalculation($requestMethods, $countryCode);
        $this->expectException('Api\Exception\NotFound');

        $countryCode->getValue();
    }

    public function dataProviderTestGetCountryCodeFailure()
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
}
