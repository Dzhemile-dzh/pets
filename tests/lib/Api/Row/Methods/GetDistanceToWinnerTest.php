<?php

namespace Tests;

use Api\Constants\Horses as Constants;
use Phalcon\Exception;
use Api\Row\RaceInstance;

class GetDistanceToWinnerTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @param RaceInstance $row
     * @param $expectedResult
     *
     * @dataProvider providerTestGetDistanceToWinnerForm
     */
    public function testGetDistanceToWinnerForm(RaceInstance $row, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->getDistanceToWinnerForm());
    }

    /**
     * @return array
     */
    public function providerTestGetDistanceToWinnerForm()
    {
        $template = [
            'dtw_sum_distance_value' => 10,
            'orig_race_output_order' => 2,
            'dtw_count_horse_race' => 3,
            'dtw_total_distance_value' => 2,
        ];
        $result = [];
        foreach (Constants::RACE_OUTCOME_CODES_NON_FINISHERS as $outcomeCode) {
            $row = RaceInstance::createFromArray(['race_outcome_code' => $outcomeCode] + $template);
            $result[] = [$row, null];
        }
        $row = RaceInstance::createFromArray(['race_outcome_code' => chr(189)] + $template);
        $result[] = [$row, $row->getDistanceToWinner()];
        return $result;
    }

    /**
     * @param RaceInstance $row
     * @param string $isNonRunner
     * @param string $expectedResult
     *
     * @dataProvider providerTestGetDistanceRunnerHorseToWinnerForm
     */
    public function testGetDistanceRunnerHorseToWinnerForm(RaceInstance $row, $isNonRunner, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->getDistanceRunnerHorseToWinnerForm($isNonRunner));
    }

    /**
     * @return array
     */
    public function providerTestGetDistanceRunnerHorseToWinnerForm()
    {
        $template = [
            'dtw_sum_distance_value' => 10,
            'orig_race_output_order' => 2,
            'dtw_count_horse_race' => 3,
            'dtw_total_distance_value' => 2,
            'race_outcome_code' => chr(189)
        ];
        $row = RaceInstance::createFromArray($template);
        $expected = $row->getDistanceToWinnerForm();
        return [
            [$row, 'Y', null],
            [$row, 'N', $expected],
            [$row, 'y', $expected],
            [$row, '', $expected],
            [$row, null, $expected]
        ];
    }

    /**
     * @param \Api\Row\RaceInstance $row
     * @param  array                              $expectedResult
     *
     * @dataProvider providerTestGetDistanceToWinner
     */
    public function testGetDistanceToWinner(\Api\Row\RaceInstance $row, $expectedResult)
    {

        $this->assertEquals($expectedResult, $row->getDistanceToWinner());
    }

    /**
     * @return array
     */
    public function providerTestGetDistanceToWinner()
    {

        $row1 = new \Api\Row\RaceInstance();
        $row1->orig_race_output_order = 3;
        $row1->dtw_rp_distance_desc = null;
        $row1->dtw_sum_distance_value = 11.50;
        $row1->dtw_count_horse_race = 0;
        $row1->dtw_total_distance_value = 50;


        $row2 = new \Api\Row\RaceInstance();
        $row2->orig_race_output_order = 1;
        $row2->dtw_rp_distance_desc = 'dht';
        $row2->dtw_sum_distance_value = 0;
        $row2->dtw_count_horse_race = 0;
        $row2->dtw_total_distance_value = 50;

        $row3 = new \Api\Row\RaceInstance();
        $row3->orig_race_output_order = 4;
        $row3->dtw_rp_distance_desc = null;
        $row3->dtw_sum_distance_value = 0.05;
        $row3->dtw_count_horse_race = 3;
        $row3->dtw_total_distance_value = 50;

        $row4 = new \Api\Row\RaceInstance();
        $row4->orig_race_output_order = 4;
        $row4->dtw_rp_distance_desc = null;
        $row4->dtw_sum_distance_value = 30.63;
        $row4->dtw_count_horse_race = 3;
        $row4->dtw_total_distance_value = 50;

        $row5 = new \Api\Row\RaceInstance();
        $row5->orig_race_output_order = 4;
        $row5->dtw_rp_distance_desc = null;
        $row5->dtw_sum_distance_value = 7.65;
        $row5->dtw_count_horse_race = 0;
        $row5->dtw_total_distance_value = 50;

        $row6 = new \Api\Row\RaceInstance();
        $row6->orig_race_output_order = 1;
        $row6->dtw_rp_distance_desc = 'dht';
        $row6->dtw_sum_distance_value = 0;
        $row6->dtw_count_horse_race = 0;
        $row6->dtw_total_distance_value = 0;

        $row7 = new \Api\Row\RaceInstance();
        $row7->orig_race_output_order = 1;
        $row7->dtw_rp_distance_desc = 'dht';
        $row7->dtw_sum_distance_value = null;
        $row7->dtw_count_horse_race = 7;
        $row7->dtw_total_distance_value = 15;


        return [
            [$row1, '11' .chr(189).'L'],
            [$row2, null],
            [$row3, 'nse+'],
            [$row4, '31+L'],
            [$row5, '7' .chr(190).'L'],
            [$row6, null],
            [$row7, null],
        ];
    }

    /**
     * @param \Api\Row\RaceInstance $row
     * @param  array                              $expectedResult
     *
     * @dataProvider providerTestGetWinningDistance
     */
    public function testGetWinningDistance(\Api\Row\RaceInstance $row, $expectedResult)
    {

        $this->assertEquals($expectedResult, $row->GetWinningDistance());
    }

    /**
     * @return array
     */
    public function providerTestGetWinningDistance()
    {

        $row1 = new \Api\Row\RaceInstance();
        $row1->orig_race_output_order = 1;
        $row1->dtw_rp_distance_desc = 'dht';
        $row1->dtw_sum_distance_value = 0;
        $row1->dtw_count_horse_race = 0;
        $row1->dtw_total_distance_value = 50;


        $row2 = new \Api\Row\RaceInstance();
        $row2->orig_race_output_order = 1;
        $row2->dtw_rp_distance_desc = '1 1/4';
        $row2->dtw_sum_distance_value = 1.25;
        $row2->dtw_count_horse_race = 0;
        $row2->dtw_total_distance_value = 50;

        $row3 = new \Api\Row\RaceInstance();
        $row3->orig_race_output_order = 1;
        $row3->dtw_rp_distance_desc = 'hd';
        $row3->dtw_sum_distance_value = 0.2;
        $row3->dtw_count_horse_race = 0;
        $row3->dtw_total_distance_value = 50;

        $row4 = new \Api\Row\RaceInstance();
        $row4->orig_race_output_order = 1;
        $row4->dtw_rp_distance_desc = '2 1/4';
        $row4->dtw_sum_distance_value = 2.25;
        $row4->dtw_count_horse_race = 0;
        $row4->dtw_total_distance_value = 50;

        $row5 = new \Api\Row\RaceInstance();
        $row5->orig_race_output_order = 1;
        $row5->dtw_rp_distance_desc = 'shd';
        $row5->dtw_sum_distance_value = 0.1;
        $row5->dtw_count_horse_race = 0;
        $row5->dtw_total_distance_value = 50;

        $row6 = new \Api\Row\RaceInstance();
        $row6->orig_race_output_order = 1;
        $row6->dtw_rp_distance_desc = 'dht';
        $row6->dtw_sum_distance_value = 0;
        $row6->dtw_count_horse_race = 0;
        $row6->dtw_total_distance_value = 0;

        $row7 = new \Api\Row\RaceInstance();
        $row7->orig_race_output_order = 1;
        $row7->dtw_rp_distance_desc = 'dht';
        $row7->dtw_sum_distance_value = null;
        $row7->dtw_count_horse_race = 5;
        $row7->dtw_total_distance_value = 10;

        return [
            [$row1, 'dht'],
            [$row2, '1' .chr(188).'L'],
            [$row3, 'hd'],
            [$row4, '2' .chr(188).'L'],
            [$row5, 'shd'],
            [$row6, null],
            [$row7, null],
        ];
    }
}
