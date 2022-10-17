<?php

namespace Tests;

use Api\Constants\Horses;
use Api\Row\Methods\MapRaceStatusCode;

/**
 * Class MapRaceStatusCodeTest
 *
 * @package Tests
 */
class MapRaceStatusCodeTest extends \PHPUnit\Framework\TestCase
{
    use MapRaceStatusCode;

    /**
     * @param $testCaseObject - the object with all properties we pass to the method
     * @param $expectedResult - the expected result which should be hardcoded and used for comparison
     * @dataProvider providerMapRaceStatusCode
     */
    public function testMapRaceStatusCode($testCaseObject, $expectedResult)
    {
        $this->assertEquals(
            $expectedResult['race_status_code'],
            $this->mapRaceStatusCode(
                $testCaseObject['race_status_code'],
                $testCaseObject['no_of_runners'],
                $testCaseObject['early_closing_race_yn']
            )
        );
    }

    /**
     * @return array
     */
    public function providerMapRaceStatusCode()
    {
        return [
            'test_case_1' => [
                [
                    'race_status_code' => 'C',
                    'no_of_runners' => 10,
                    'early_closing_race_yn' => 'Y'
                ],
                [
                    'race_status_code' => Horses::RACE_STATUS_WORD_EARLY_CLOSER
                ]
            ],
            'test_case_2' => [
                [
                    'race_status_code' => 'C',
                    'no_of_runners' => 10,
                    'early_closing_race_yn' => null
                ],
                [
                    'race_status_code' => Horses::RACE_STATUS_WORD_CALENDER
                ]
            ],
            'test_case_3' => [
                [
                    'race_status_code' => 'R',
                    'no_of_runners' => 10,
                    'early_closing_race_yn' => null
                ],
                [
                    'race_status_code' => Horses::RACE_STATUS_WORD_RESULT
                ]
            ],
        ];
    }
}
