<?php

namespace Tests\Api\Row\Methods;

use Api\Constants\Horses;
use Api\Row\Methods\GetEachWayTerms;

/**
 * Class GetEachWayTermsTest
 *
 * @package Tests
 */
class GetEachWayTermsTest extends \PHPUnit\Framework\TestCase
{
    use GetEachWayTerms;

    /**
     * @param $testCaseObject - the object with all properties we pass to the method
     * @param $expectedResult - the expected each-way terms to be returned
     *
     * @dataProvider dataProvider
     */
    public function testGetEachWayTerms($testCaseObject, $expectedResult)
    {
        $this->assertEquals(
            $expectedResult['each_way'],
            $this->getEachWayTerms(
                $testCaseObject['race_status_code'],
                $testCaseObject['no_of_runners'],
                $testCaseObject['race_group_code']
            )
        );
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                [
                    'race_status_code' => Horses::RACE_STATUS_OVERNIGHT_STR,
                    'no_of_runners' => 4,
                    'race_group_code' => 'Y'
                ],
                [
                    'each_way' => 'Win Only'
                ]
            ],
            [
                [
                    'race_status_code' => Horses::RACE_STATUS_RESULTS_STR,
                    'no_of_runners' => 6,
                    'race_group_code' => null
                ],
                [
                    'each_way' => '1-2'
                ]
            ],
            [
                [
                    'race_status_code' => Horses::RACE_STATUS_OVERNIGHT_STR,
                    'no_of_runners' => 12,
                    'race_group_code' => 'H'
                ],
                [
                    'each_way' => '1-3'
                ]
            ],
            [
                [
                    'race_status_code' => Horses::RACE_STATUS_RESULTS_STR,
                    'no_of_runners' => 18,
                    'race_group_code' => 'H'
                ],
                [
                    'each_way' => '1-4'
                ]
            ],
            [
                [
                    'race_status_code' => Horses::RACE_STATUS_OVERNIGHT_STR,
                    'no_of_runners' => 20,
                    'race_group_code' => null
                ],
                [
                    'each_way' => '1-3'
                ]
            ],
            [
                [
                    'race_status_code' => Horses::RACE_STATUS_CALENDAR_STR,
                    'no_of_runners' => 12,
                    'race_group_code' => null
                ],
                [
                    'each_way' => null
                ]
            ],
        ];
    }
}
