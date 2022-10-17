<?php

namespace Tests\Bo;

use Api\Row\RaceInstance as RiRow;
use Phalcon\Mvc\Model\Row\General as GeneralRow;

class JockeyProfileTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Input\Request\Horses\Profile\Jockey\BookedRides $request
     * @param array                                                $expectedResult
     *
     * @dataProvider providerTestGetBookedRides
     */
    public function testGetBookedRides(
        \Api\Input\Request\Horses\Profile\Jockey\BookedRides $request,
        array $expectedResult
    ) {
        $JockeyProfileObject = new \Tests\Stubs\Bo\JockeyProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($JockeyProfileObject->getBookedRides())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetBookedRides()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Jockey\BookedRides(
                    [],
                    [
                        'jockeyId' => 80136
                    ]
                ),
                [
                    (Object)[
                        'race_instance_uid' => 612952,
                        'race_datetime' => '14.11.2014 12:05:00',
                        'course_name' => 'NEWCASTLE',
                        'course_style_name' => 'Newcastle',
                        'course_type_code' => 'N',
                        'race_instance_title' => 'ITPS Novices\' Hurdle',
                        'race_status_code' => 'O',
                        'horse_style_name' => 'Duke Of Yorkshire',
                        'horse_uid' => 818959,
                        'course_uid' => 195,
                        'running_conditions' => null,
                        "race_type_code" => "F",
                        "race_type_desc" => "Flat Turf"
                    ],
                    (Object)[
                        'race_instance_uid' => 613100,
                        'race_datetime' => '14.11.2014 13:05:00',
                        'course_name' => 'NEWCASTLE',
                        'course_style_name' => 'Newcastle',
                        'course_type_code' => 'N',
                        'race_instance_title' => 'Cellular Solutions Mares\' Maiden Hurdle',
                        'race_status_code' => 'O',
                        'horse_style_name' => 'Attention Seaker',
                        'horse_uid' => 836369,
                        'course_uid' => 195,
                        'running_conditions' => null,
                        "race_type_code" => "F",
                        "race_type_desc" => "Flat Turf"
                    ],
                    (Object)[
                        'race_instance_uid' => 613104,
                        'race_datetime' => '14.11.2014 15:25:00',
                        'course_name' => 'NEWCASTLE',
                        'course_style_name' => 'Newcastle',
                        'course_type_code' => 'N',
                        'race_instance_title' => 'STP Construction Maiden Open National Hunt Flat Race',
                        'race_status_code' => 'O',
                        'horse_style_name' => 'Kara Tara',
                        'horse_uid' => 871644,
                        'course_uid' => 195,
                        'running_conditions' => null,
                        "race_type_code" => "F",
                        "race_type_desc" => "Flat Turf"
                    ],
                    (Object)[
                        'race_instance_uid' => 613146,
                        'race_datetime' => '17.11.2014 12:45:00',
                        'course_name' => 'LEICESTER',
                        'course_style_name' => 'Leicester',
                        'course_type_code' => 'N',
                        'race_instance_title' => 'Ashby Magna Juvenile Fillies\' Hurdle',
                        'race_status_code' => '4',
                        'horse_style_name' => 'Announcement',
                        'horse_uid' => 401313,
                        'course_uid' => 195,
                        'running_conditions' => null,
                        "race_type_code" => "F",
                        "race_type_desc" => "Flat Turf"
                    ]
                ]
            ]
        ];
    }

    /**
     *
     * @dataProvider providerTestGetBigRaceWins
     */
    public function testGetBigRaceWins(
        \Api\Input\Request\Horses\Profile\Jockey\BigRaceWins $request,
        array $expectedResult
    ) {
        $jockeyProfile = new \Tests\Stubs\Bo\JockeyProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($jockeyProfile->getBigRaceWins())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetBigRaceWins()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Jockey\BigRaceWins(
                    [],
                    [
                        'jockeyId' => 80136
                    ]
                ),
                array(
                    0 =>
                        RiRow::createFromArray(array(
                            'race_date' => 'Mar  4 2017  3:35PM',
                            'rp_abbrev_3' => 'DON',
                            'country' => 'GB ',
                            'course_type_code' => 'B',
                            'course_type_code1' => 'B',
                            'distance_yard' => 5721,
                            'race_instance_uid' => 668478,
                            'race_instance_title' => 'BetBright Grimthorpe Handicap Chase',
                            'course_name' => 'DONCASTER',
                            'course_style_name' => 'Doncaster',
                            'trainer_short_name' => 'B Ellison',
                            'prize_sterling' => 34408,
                            'prize_euro' => 0,
                            'days_diff' => 229,
                            'race_outcome_code' => '1',
                            'race_outcome_position' => 1,
                            'disq_desc' => null,
                            'horse_style_name' => 'Definitly Red',
                            'country_origin_code' => 'IRE',
                            'horse_uid' => 830608,
                            'trainer_style_name' => 'Brian Ellison',
                            'trainer_uid' => 4431,
                            'trainer_ptp_type_code' => 'N',
                            'race_type_code' => 'C',
                            'race_group_desc' => 'Handicap',
                            'race_group_code' => 'H',
                            'course_uid' => 15,
                            'video_detail' => array(
                                0 =>
                                    GeneralRow::createFromArray(array(
                                        'race_instance_uid' => 668478,
                                        'ptv_video_id' => 185545,
                                        'video_provider' => 'ATR',
                                        'complete_race_uid' => 248,
                                        'complete_race_start' => 0,
                                        'complete_race_end' => 1,
                                        'finish_race_uid' => 248,
                                        'finish_race_start' => 0,
                                        'finish_race_end' => 1,
                                    )),
                            ),
                        )),
                    1 =>
                        RiRow::createFromArray(array(
                            'race_date' => 'Apr 15 2016  3:45PM',
                            'rp_abbrev_3' => 'AYR',
                            'country' => 'GB ',
                            'course_type_code' => 'B',
                            'course_type_code1' => 'B',
                            'distance_yard' => 4510,
                            'race_instance_uid' => 646612,
                            'race_instance_title' => 'Hillhouse Quarry Handicap Chase (Listed Race)',
                            'course_name' => 'AYR',
                            'course_style_name' => 'Ayr',
                            'trainer_short_name' => 'B Ellison',
                            'prize_sterling' => 25627.5,
                            'prize_euro' => 0,
                            'days_diff' => 552,
                            'race_outcome_code' => '1',
                            'race_outcome_position' => 1,
                            'disq_desc' => null,
                            'horse_style_name' => 'Definitly Red',
                            'country_origin_code' => 'IRE',
                            'horse_uid' => 830608,
                            'trainer_style_name' => 'Brian Ellison',
                            'trainer_uid' => 4431,
                            'trainer_ptp_type_code' => 'N',
                            'race_type_code' => 'C',
                            'race_group_desc' => 'Listed Handicap',
                            'race_group_code' => 'H',
                            'course_uid' => 3,
                            'video_detail' => array(
                                0 =>
                                    GeneralRow::createFromArray(array(
                                        'race_instance_uid' => 646612,
                                        'ptv_video_id' => 1121573,
                                        'video_provider' => 'RUK',
                                        'complete_race_uid' => 2590473,
                                        'complete_race_start' => 308,
                                        'complete_race_end' => 717,
                                        'finish_race_uid' => 2590474,
                                        'finish_race_start' => 608,
                                        'finish_race_end' => 663,
                                    )),
                            ),
                        )),
                )
            ],
        ];
    }

    /**
     *
     * @dataProvider providerTestGetSinceAWin
     */
    public function testGetSinceAWin(
        \Api\Input\Request\Horses\Profile\Jockey\Last14Days $request,
        $expectedResult
    ) {
        $jockeyProfile = new \Tests\Stubs\Bo\JockeyProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($jockeyProfile->getSinceAWin())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetSinceAWin()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Jockey\Last14Days(
                    [],
                    [
                        'jockeyId' => 87600
                    ]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray([
                    'flat' => (Object)[
                        'zenithOfficial' => 90.833333330000002,
                        'race_type' => 'flat',
                        'runs' => 7579,
                        'days' => 4598,
                    ],
                    'jumps' => (Object)[
                        'zenithOfficial' => 90.833333330000002,
                        'race_type' => 'jumps',
                        'runs' => 2,
                        'days' => 1,
                    ]
                ])
            ],
        ];
    }

    /**
     *
     * @dataProvider providerTestGetLast14Days
     */
    public function testGetLast14Days(
        \Api\Input\Request\Horses\Profile\Jockey\Last14Days $request,
        array $expectedResult
    ) {
        $jockeyProfile = new \Tests\Stubs\Bo\JockeyProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($jockeyProfile->getLast14Days())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetLast14Days()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Jockey\Last14Days(
                    [],
                    [
                        'jockeyId' => 80136
                    ]
                ),
                array(
                    0 =>
                        RiRow::createFromArray(array(
                            'race_instance_uid' => 684860,
                            'race_datetime' => 'Oct 18 2017  5:25PM',
                            'course_uid' => 87,
                            'race_instance_title' => 'Watch Racing UK Anywhere Handicap Hurdle',
                            'race_type_code' => 'H',
                            'distance_yard' => 3520,
                            'furlongs' => 16,
                            'horse_uid' => 865033,
                            'horse_style_name' => 'Seamour',
                            'country_origin_code' => 'IRE',
                            'weight_carried_lbs' => 159,
                            'rp_betting_movements' => 'op 15/8',
                            'course_rp_abbrev_3' => 'WET',
                            'course_rp_abbrev_4' => 'Weth',
                            'course_name' => 'WETHERBY',
                            'course_style_name' => 'Wetherby',
                            'course_type_code' => 'B',
                            'course_code' => 'WETH',
                            'first_time_yn' => null,
                            'rp_postmark_difference' => null,
                            'race_outcome_code' => '3',
                            'odds_value' => 1.75,
                            'trainer_short_name' => 'B Ellison',
                            'trainer_ptp_type_code' => 'N',
                            'going_type_services_desc' => 'Gd',
                            'prize_sterling' => 5523.3000000000002,
                            'prize_euro' => 0,
                            'race_outcome_position' => 3,
                            'no_of_runners' => 12,
                            'rp_close_up_comment' => 'held up, headway into midfield 5th, chased leaders when not fluent 2 out, soon ridden, stayed on',
                            'rp_horse_head_gear_code' => null,
                            'odds_desc' => '7/4F',
                            'trainer_uid' => 4431,
                            'trainer_style_name' => 'Brian Ellison',
                            'rp_postmark' => null,
                            'rp_pre_postmark' => 132,
                            'actual_race_class' => '3',
                            'rp_ages_allowed_desc' => '3yo+',
                            'race_group_code' => 'H',
                            'race_group_desc' => 'Handicap',
                            'race_output_order' => 3,
                            'orig_race_output_order' => 3,
                            'dtw_rp_distance_desc' => null,
                            'dtw_sum_distance_value' => 2,
                            'dtw_count_horse_race' => 0,
                            'dtw_total_distance_value' => 30.300000000000001,
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::createFromArray(array(
                                            'race_instance_uid' => 684860,
                                            'ptv_video_id' => 1309813,
                                            'video_provider' => 'RUK',
                                            'complete_race_uid' => 2722314,
                                            'complete_race_start' => 344,
                                            'complete_race_end' => 598,
                                            'finish_race_uid' => 2722315,
                                            'finish_race_start' => 536,
                                            'finish_race_end' => 598,
                                        )),
                                ),
                        )),
                    1 =>
                        RiRow::createFromArray(array(
                            'race_instance_uid' => 684858,
                            'race_datetime' => 'Oct 18 2017  4:55PM',
                            'course_uid' => 87,
                            'race_instance_title' => 'Subscribe To Racing UK On Youtube Handicap Chase',
                            'race_type_code' => 'C',
                            'distance_yard' => 3336,
                            'furlongs' => 15,
                            'horse_uid' => 883862,
                            'horse_style_name' => 'Nomoreblackjack',
                            'country_origin_code' => 'IRE',
                            'weight_carried_lbs' => 163,
                            'rp_betting_movements' => 'op 7/2 tchd 10/3',
                            'course_rp_abbrev_3' => 'WET',
                            'course_rp_abbrev_4' => 'Weth',
                            'course_name' => 'WETHERBY',
                            'course_style_name' => 'Wetherby',
                            'course_type_code' => 'B',
                            'course_code' => 'WETH',
                            'first_time_yn' => null,
                            'rp_postmark_difference' => null,
                            'race_outcome_code' => '6',
                            'odds_value' => 4.5,
                            'trainer_short_name' => 'Mrs S Smith',
                            'trainer_ptp_type_code' => 'N',
                            'going_type_services_desc' => 'Gd',
                            'prize_sterling' => 6498,
                            'prize_euro' => 0,
                            'race_outcome_position' => 6,
                            'no_of_runners' => 8,
                            'rp_close_up_comment' => 'prominent, led 5 out, ridden when headed before 4 out, weakening and already beaten when jumped badly right 3 out',
                            'rp_horse_head_gear_code' => null,
                            'odds_desc' => '9/2',
                            'trainer_uid' => 4788,
                            'trainer_style_name' => 'Sue Smith',
                            'rp_postmark' => null,
                            'rp_pre_postmark' => 141,
                            'actual_race_class' => '3',
                            'rp_ages_allowed_desc' => '4yo+',
                            'race_group_code' => 'H',
                            'race_group_desc' => 'Handicap',
                            'race_output_order' => 6,
                            'orig_race_output_order' => 6,
                            'dtw_rp_distance_desc' => null,
                            'dtw_sum_distance_value' => 26.5,
                            'dtw_count_horse_race' => 0,
                            'dtw_total_distance_value' => 32.5,
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::createFromArray(array(
                                            'race_instance_uid' => 684858,
                                            'ptv_video_id' => 1309809,
                                            'video_provider' => 'RUK',
                                            'complete_race_uid' => 2722291,
                                            'complete_race_start' => 316,
                                            'complete_race_end' => 756,
                                            'finish_race_uid' => 2722248,
                                            'finish_race_start' => 511,
                                            'finish_race_end' => 575,
                                        )),
                                ),
                        )),
                )
            ],
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Jockey\Statistics $request
     * @param array                                               $expectedResult
     *
     * @dataProvider providerTestGetStatistics
     */
    public function testGetStatistics(
        \Api\Input\Request\Horses\Profile\Jockey\Statistics $request,
        array $expectedResult
    ) {
        $jockeyProfileObject = new \Tests\Stubs\Bo\JockeyProfile($request);

        $result = $jockeyProfileObject->getStatistics();

        $this->assertEquals($result, $expectedResult);
    }

    /**
     * @param StatisticsRequest $request
     *
     * @return array
     */
    public function providerTestGetStatistics($request)
    {

        return [
            [
                new \Api\Input\Request\Horses\Profile\Jockey\Statistics(
                    [
                        2011,
                        2012,
                        'GB',
                        'jumps',
                        'distance',
                        null,
                    ],
                    [
                        'jockeyId' => 13380
                    ]
                ),
                [
                    "OVERALL" => [
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "0-3850",
                            "rides" => 481,
                            "wins" => 55,
                            "place_2nd_number" => 59,
                            "place_3rd_number" => 58,
                            "place_4th_number" => 62,
                            "race_placed" => 145,
                            "percent" => 11,
                            "stakes" => -96.56,
                            "total_prize" => 377378.84,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "3851-4290",
                            "rides" => 111,
                            "wins" => 21,
                            "place_2nd_number" => 11,
                            "place_3rd_number" => 11,
                            "place_4th_number" => 5,
                            "race_placed" => 39,
                            "percent" => 19,
                            "stakes" => -13.83,
                            "total_prize" => 99902.73,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "4291-4950",
                            "rides" => 281,
                            "wins" => 27,
                            "place_2nd_number" => 31,
                            "place_3rd_number" => 29,
                            "place_4th_number" => 34,
                            "race_placed" => 71,
                            "percent" => 10,
                            "stakes" => -140.55,
                            "total_prize" => 171543.68,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "4951-5830",
                            "rides" => 174,
                            "wins" => 23,
                            "place_2nd_number" => 22,
                            "place_3rd_number" => 21,
                            "place_4th_number" => 22,
                            "race_placed" => 55,
                            "percent" => 13,
                            "stakes" => -3.13,
                            "total_prize" => 189454.7,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "5831-null",
                            "rides" => 17,
                            "wins" => 4,
                            "place_2nd_number" => 2,
                            "place_3rd_number" => 3,
                            "place_4th_number" => 1,
                            "race_placed" => 10,
                            "percent" => 24,
                            "stakes" => 45,
                            "total_prize" => 310163.46,
                        ]
                    ],
                    "CHASE" => [
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => null,
                            "group_name" => "0-3850",
                            "rides" => 111,
                            "wins" => 17,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 15,
                            "stakes" => -13.81,
                            "total_prize" => 166189.52,
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => null,
                            "group_name" => "3851-4290",
                            "rides" => 40,
                            "wins" => 8,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 20,
                            "stakes" => -1.93,
                            "total_prize" => 47548.83,
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => null,
                            "group_name" => "4291-4950",
                            "rides" => 108,
                            "wins" => 10,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 9,
                            "stakes" => -51.75,
                            "total_prize" => 79272.76,
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => null,
                            "group_name" => "4951-5830",
                            "rides" => 114,
                            "wins" => 18,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 16,
                            "stakes" => 5.7,
                            "total_prize" => 164081.38,
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => null,
                            "group_name" => "5831-null",
                            "rides" => 16,
                            "wins" => 4,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 25,
                            "stakes" => 46,
                            "total_prize" => 310163.46,
                        ]
                    ],
                    "HURDLE" => [
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => null,
                            "group_name" => "0-3850",
                            "rides" => 308,
                            "wins" => 31,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 10,
                            "stakes" => -60.22,
                            "total_prize" => 187204.2,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => null,
                            "group_name" => "3851-4290",
                            "rides" => 68,
                            "wins" => 12,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 18,
                            "stakes" => -12.65,
                            "total_prize" => 50642.9,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => null,
                            "group_name" => "4291-4950",
                            "rides" => 173,
                            "wins" => 17,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 10,
                            "stakes" => -88.8,
                            "total_prize" => 92270.92,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => null,
                            "group_name" => "4951-5830",
                            "rides" => 60,
                            "wins" => 5,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 8,
                            "stakes" => -8.83,
                            "total_prize" => 25373.32,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => null,
                            "group_name" => "5831-null",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ]
                    ],
                    "NHF" => [
                        (Object)[
                            "category" => "NHF",
                            "group_id" => null,
                            "group_name" => "0-3850",
                            "rides" => 62,
                            "wins" => 7,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 11,
                            "stakes" => -22.54,
                            "total_prize" => 23985.12,
                        ],
                        (Object)[
                            "category" => "NHF",
                            "group_id" => null,
                            "group_name" => "3851-4290",
                            "rides" => 3,
                            "wins" => 1,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 33,
                            "stakes" => 0.75,
                            "total_prize" => 1711,
                        ]
                    ],
                ],
            ],
            [
                new \Api\Input\Request\Horses\Profile\Jockey\Statistics(
                    [
                        2010,
                        2015,
                        'IRE',
                        'jumps',
                        'course',
                        null,
                    ],
                    [
                        'jockeyId' => 13380
                    ]
                ),
                [
                    "OVERALL" => [
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 183,
                            "group_name" => "GALWAY",
                            "rides" => 4,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -4,
                            "total_prize" => 1155,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 188,
                            "group_name" => "LIMERICK",
                            "rides" => 3,
                            "wins" => 2,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 2,
                            "percent" => 67,
                            "stakes" => 22,
                            "total_prize" => 30600,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 190,
                            "group_name" => "LISTOWEL",
                            "rides" => 4,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 1,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -4,
                            "total_prize" => 500,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 203,
                            "group_name" => "KILBEGGAN",
                            "rides" => 2,
                            "wins" => 0,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 0,
                            "stakes" => -2,
                            "total_prize" => 1360,
                        ]
                    ],
                    "CHASE" => [
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => 183,
                            "group_name" => "GALWAY",
                            "rides" => 2,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -2,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => 188,
                            "group_name" => "LIMERICK",
                            "rides" => 2,
                            "wins" => 2,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 100,
                            "stakes" => 23,
                            "total_prize" => 28125,
                        ],
                        (Object)[
                            "category" => "CHASE",
                            "group_id" => 190,
                            "group_name" => "LISTOWEL",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ]
                    ],
                    "HURDLE" => [
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => 183,
                            "group_name" => "GALWAY",
                            "rides" => 2,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -2,
                            "total_prize" => 1155,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => 203,
                            "group_name" => "KILBEGGAN",
                            "rides" => 2,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -2,
                            "total_prize" => 1360,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => 188,
                            "group_name" => "LIMERICK",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 2475,
                        ],
                        (Object)[
                            "category" => "HURDLE",
                            "group_id" => 190,
                            "group_name" => "LISTOWEL",
                            "rides" => 3,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -3,
                            "total_prize" => 500,
                        ]
                    ]
                ]
            ],
            [
                new \Api\Input\Request\Horses\Profile\Jockey\Statistics(
                    [
                        2011,
                        2012,
                        'GB',
                        'flat',
                        'month',
                        null,
                    ],
                    [
                        'jockeyId' => 13380
                    ]
                ),
                [
                    "OVERALL" => [
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "April 2011",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ]
                    ],
                    "4YO+" => [
                        (Object)[
                            "category" => "4YO+",
                            "group_id" => null,
                            "group_name" => "April 2011",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ]
                    ]
                ],
            ],
            [
                new \Api\Input\Request\Horses\Profile\Jockey\Statistics(
                    [
                        2010,
                        2015,
                        'GB',
                        'flat',
                        'race-type',
                        'turf',
                    ],
                    [
                        'jockeyId' => 9482
                    ]
                ),
                [
                    "OVERALL" => [
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "Handicap",
                            "rides" => 3,
                            "wins" => 0,
                            "place_2nd_number" => 2,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 2,
                            "percent" => 0,
                            "stakes" => -3,
                            "total_prize" => 3275.9,
                        ]
                    ],
                    "4YO+" => [
                        (Object)[
                            "category" => "4YO+",
                            "group_id" => null,
                            "group_name" => "Handicap",
                            "rides" => 3,
                            "wins" => 0,
                            "place_2nd_number" => null,
                            "place_3rd_number" => null,
                            "place_4th_number" => null,
                            "race_placed" => null,
                            "percent" => 0,
                            "stakes" => -3,
                            "total_prize" => 3275.9,
                        ]
                    ]
                ],
            ],
            [
                new \Api\Input\Request\Horses\Profile\Jockey\Statistics(
                    [
                        2014,
                        2015,
                        'IRE',
                        'flat',
                        'trainer',
                        'aw',
                        'championship'
                    ],
                    [
                        'jockeyId' => 91319
                    ]
                ),
                [
                    "OVERALL" => [
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 67,
                            "group_name" => "Sir Mark Prescott Bt",
                            "rides" => 1,
                            "wins" => 1,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 100,
                            "stakes" => 2,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => 29816,
                            "group_name" => "Anthony McCann",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ]
                    ],
                    "4YO+" => [
                        (Object)[
                            "category" => "4YO+",
                            "group_id" => 67,
                            "group_name" => "Sir Mark Prescott Bt",
                            "rides" => 1,
                            "wins" => 1,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1,
                            "percent" => 100,
                            "stakes" => 2,
                            "total_prize" => 0,
                        ],
                        (Object)[
                            "category" => "4YO+",
                            "group_id" => 29816,
                            "group_name" => "Anthony McCann",
                            "rides" => 1,
                            "wins" => 0,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 0,
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Jockey\Index $request
     * @param                                                $expectedResult
     *
     * @dataProvider providerTestGetJockey
     */
    public function testGetJockey(
        \Api\Input\Request\Horses\Profile\Jockey\Index $request,
        $expectedResult
    ) {
        $jockeyProfileObject = new \Tests\Stubs\Bo\JockeyProfile($request);
        $result = $jockeyProfileObject->getJockey();

        $this->assertEquals($result, $expectedResult);
    }

    /**
     * @return array
     */
    public function providerTestGetJockey()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Jockey\Index([], ['jockeyId' => 80136]),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'jockey_uid' => 80136,
                        'jockey_name' => 'DANNY COOK',
                        'ptp_type_code' => 'N',
                        'flat_jockey_type_code' => 'P',
                        'jump_jockey_type_code' => 'P',
                        'jockey_sex' => 'M',
                        'style_name' => 'Danny Cook',
                        'aka_style_name' => 'D Cook',
                        'christian_name' => 'Danny Robin',
                        'longest_flat_losing_seq' => null,
                        'longest_flat_winning_seq' => null,
                        'present_flat_losing_seq' => null,
                        'present_flat_winning_seq' => null,
                        'longest_jump_losing_seq' => null,
                        'longest_jump_winning_seq' => null,
                        'present_jump_losing_seq' => null,
                        'present_jump_winning_seq' => null,
                        'lowest_riding_weight' => null,
                        'country_code' => 'GB',
                        'jockey_last_14_days' => \Api\Row\WinsRuns::createFromArray(
                            [
                                'runs' => 5,
                                'wins' => 1,
                            ]
                        ),
                        'since_a_win' => (Object)[
                            'flat' => (Object)[
                                'zenithOfficial' => 90.833333330000002,
                                'race_type' => 'flat',
                                'runs' => 7579,
                                'days' => 4598,
                            ],
                            'jumps' => (Object)[
                                'zenithOfficial' => 90.833333330000002,
                                'race_type' => 'jumps',
                                'runs' => 2,
                                'days' => 1,
                            ],
                        ]
                    ]
                )
            ]
        ];
    }
}
