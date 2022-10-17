<?php

namespace Tests;

/**
 * Class GetEarlyClosingRaceReadyTest
 *
 * @package Tests
 */
class GetEarlyClosingRaceReadyTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\RaceInstance $row
     * @param  array                              $expectedResult
     *
     * @dataProvider providerTestGetEarlyClosingRaceReady
     */
    public function testGetEarlyClosingRaceReady(\Api\Row\RaceInstance $row, $expectedResult)
    {

        $this->assertEquals($expectedResult, $row->getEarlyClosingRaceReady());
    }

    /**
     * @return array
     */
    public function providerTestGetEarlyClosingRaceReady()
    {

        $row1 = new \Api\Row\RaceInstance();
        $row1->early_closing_race_yn = 'Y';
        $row1->race_status_code = 'C';
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

        $row4 = new \Api\Row\RaceInstance();
        $row4->early_closing_race_yn = 'Y';
        $row4->race_status_code = 'R';
        $row4->count_runners = 15;
        $row4->no_of_runners = 12;

        $row5 = new \Api\Row\RaceInstance();
        $row5->early_closing_race_yn = 'Y';
        $row5->race_status_code = 'R';
        $row5->count_runners = 15;
        $row5->no_of_runners = 15;




        return [
            [$row1, false],
            [$row2, true],
            [$row3, null],
            [$row4, true],
            [$row5, true],
        ];
    }
}
