<?php

namespace Tests;

use Api\Row\Methods\IsEarlyCloserPdfAvailable;

/**
 * Class IsEarlyCloserPdfAvailable
 *
 * @package Tests
 */
class IsEarlyCloserPdfAvailableTest extends \PHPUnit\Framework\TestCase
{
    use IsEarlyCloserPdfAvailable;

    /**
     * @param array $rows
     * @param $expectedResult
     * @dataProvider providerIsEarlyCloserPdfAvailableTest
     */
    public function testIsEarlyCloserPdfAvailableTest(array $rows, $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->isEarlyCloserPdfAvailable($rows));
    }

    /**
     * @return array
     */
    public function providerIsEarlyCloserPdfAvailableTest()
    {

        $row1 = new \Api\Row\RaceInstance();
        $row1->early_closing_race_yn = 'Y';
        $row1->race_status_code = 'R';
        $row1->count_runners = 15;
        $row1->no_of_runners = 12;

        $row2 = new \Api\Row\RaceInstance();
        $row2->early_closing_race_yn = 'Y';
        $row2->race_status_code = 'C';
        $row2->count_runners = 15;
        $row2->no_of_runners = 15;

        $row3 = new \Api\Row\RaceInstance();
        $row3->early_closing_race_yn = 'N';
        $row3->race_status_code = 'R';
        $row3->count_runners = 15;
        $row3->no_of_runners = 15;

        return [
            [
                [
                    $row1, $row2
                ],
                true
            ],
            [
                [
                    $row1, $row3
                ],
                false
            ],
        ];
    }
}
