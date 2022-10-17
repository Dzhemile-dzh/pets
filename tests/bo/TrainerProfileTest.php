<?php

namespace Tests\Bo;

use Api\Row\RaceInstance as RiRow;
use \Phalcon\Mvc\Model\Row\General as GeneralRow;

/**
 * Class TrainerProfileTest
 *
 * @package Tests\Bo
 */
class TrainerProfileTest extends \PHPUnit\Framework\TestCase
{

    /**
     *
     * @dataProvider providerTestGetSinceAWin
     */
    public function testGetSinceAWin(
        \Api\Input\Request\Horses\Profile\Trainer\Last14Days $request,
        $expectedResult
    ) {
        $trainerProfile = new \Tests\Stubs\Bo\TrainerProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($trainerProfile->getSinceAWin())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetSinceAWin()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Trainer\Last14Days(
                    [],
                    [
                        'trainerId' => 87600
                    ]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
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
                    ]
                )
            ],
        ];
    }

    public function dataProviderTestGetRunningToForm()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Trainer\BigRaceWins(
                    [],
                    [
                        'trainerId' => 28624
                    ]
                ),
                '83.333333333333'
            ]
        ];
    }

    /**
     *
     * @dataProvider dataProviderTestGetRunningToForm
     */
    public function testGetRunningToForm(
        \Api\Input\Request\HorsesRequest $request,
        $expectedResult
    ) {
        $trainerProfile = new \Tests\Stubs\Bo\TrainerProfile($request);
        $runningForm = $trainerProfile->getRunningToForm($request->getTrainerId());
        $this->assertEquals(
            $runningForm[$request->getTrainerId()],
            $expectedResult
        );
    }

    /**
     *
     * @dataProvider providerTestGetBigRaceWins
     */
    public function testGetBigRaceWins(
        \Api\Input\Request\Horses\Profile\Trainer\BigRaceWins $request,
        array $expectedResult
    ) {
        $trainerProfile = new \Tests\Stubs\Bo\TrainerProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($trainerProfile->getBigRaceWins())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetBigRaceWins()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Trainer\BigRaceWins(
                    [],
                    [
                        'trainerId' => 9036
                    ]
                ),
                array(
                    0 =>
                        RiRow::createFromArray(array(
                            'race_date' => 'Jul 23 2016  2:10PM',
                            'rp_abbrev_3' => 'ASC',
                            'country' => 'GB ',
                            'course_name' => 'ASCOT',
                            'course_style_name' => 'Ascot',
                            'course_type_code' => 'B',
                            'distance_yard' => 1540,
                            'race_instance_uid' => 654428,
                            'race_instance_title' => 'Wooldridge Group Pat Eddery Stakes (formerly known as the Winkfield Stakes) (Listed Race)',
                            'prize_sterling' => 17013,
                            'prize_euro' => 0,
                            'days_diff' => 457,
                            'race_outcome_code' => '1',
                            'race_outcome_position' => 1,
                            'disq_desc' => null,
                            'horse_style_name' => 'Apex King',
                            'country_origin_code' => 'IRE',
                            'horse_uid' => 1022473,
                            'jockey_style_name' => 'Andrea Atzeni',
                            'jockey_uid' => 87349,
                            'jockey_short_name' => 'A Atzeni',
                            'jockey_ptp_type_code' => 'N',
                            'race_type_code' => 'F',
                            'race_group_desc' => 'Listed',
                            'race_group_code' => '4',
                            'course_uid' => 2,
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::createFromArray(array(
                                            'race_instance_uid' => 654428,
                                            'ptv_video_id' => 1155363,
                                            'video_provider' => 'RUK',
                                            'complete_race_uid' => 2616033,
                                            'complete_race_start' => 351,
                                            'complete_race_end' => 464,
                                            'finish_race_uid' => 2616034,
                                            'finish_race_start' => 409,
                                            'finish_race_end' => 464,
                                        )),
                                ),
                        )),
                    1 =>
                        RiRow::createFromArray(array(
                            'race_date' => 'May 26 2016  6:35PM',
                            'rp_abbrev_3' => 'SAN',
                            'country' => 'GB ',
                            'course_name' => 'SANDOWN',
                            'course_style_name' => 'Sandown',
                            'course_type_code' => 'B',
                            'distance_yard' => 1110,
                            'race_instance_uid' => 650030,
                            'race_instance_title' => 'BetVictor Million Pound Goal National Stakes (Listed Race)',
                            'prize_sterling' => 14744.6,
                            'prize_euro' => 0,
                            'days_diff' => 515,
                            'race_outcome_code' => '1',
                            'race_outcome_position' => 1,
                            'disq_desc' => null,
                            'horse_style_name' => 'Global Applause',
                            'country_origin_code' => 'GB',
                            'horse_uid' => 964674,
                            'jockey_style_name' => 'Ryan Moore',
                            'jockey_uid' => 79202,
                            'jockey_short_name' => 'R L Moore',
                            'jockey_ptp_type_code' => 'N',
                            'race_type_code' => 'F',
                            'race_group_desc' => 'Listed',
                            'race_group_code' => '4',
                            'course_uid' => 54,
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::createFromArray(array(
                                            'race_instance_uid' => 650030,
                                            'ptv_video_id' => 1136577,
                                            'video_provider' => 'RUK',
                                            'complete_race_uid' => 2601911,
                                            'complete_race_start' => 402,
                                            'complete_race_end' => 536,
                                            'finish_race_uid' => 2601912,
                                            'finish_race_start' => 425,
                                            'finish_race_end' => 484,
                                        )),
                                ),
                        )),
                )
            ],
        ];
    }

    /**
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetLast14Days
     */
    public function testGetLast14Days(
        \Api\Input\Request\Horses\Profile\Trainer\Last14Days $request,
        array $expectedResult
    ) {
        $trainerProfile = new \Tests\Stubs\Bo\TrainerProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($trainerProfile->getLast14Days())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetLast14Days()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Trainer\Last14Days(
                    [],
                    [
                        'trainerId' => 9036
                    ]
                ),
                array(
                    0 =>
                        RiRow::createFromArray(array(
                            'race_instance_uid' => 684818,
                            'race_datetime' => 'Oct 19 2017  2:00PM',
                            'course_uid' => 7,
                            'race_instance_title' => 'British Stallion Studs EBF Novice Stakes',
                            'race_type_code' => 'F',
                            'distance_yard' => 1315,
                            'horse_uid' => 1610731,
                            'horse_style_name' => 'Mr Gent',
                            'country_origin_code' => 'IRE',
                            'weight_carried_lbs' => 128,
                            'weight_allowance_lbs' => 0,
                            'rp_betting_movements' => 'op 2/1',
                            'course_rp_abbrev_3' => 'BRI',
                            'course_rp_abbrev_4' => 'Brig',
                            'course_code' => 'BRIG',
                            'going_type_services_desc' => 'GS',
                            'prize_sterling' => 3234.5,
                            'prize_euro' => 0,
                            'no_of_runners' => 6,
                            'rp_close_up_comment' => 'soon tracking leader, effort and every chance just over 2f out, wanting to hang left and unable to quicken over 1f out, lost 2nd 150yds out, soon weakened',
                            'rp_horse_head_gear_code' => null,
                            'odds_desc' => '9/4',
                            'jockey_uid' => 83746,
                            'jockey_style_name' => 'Silvestre De Sousa',
                            'jockey_ptp_type_code' => 'N',
                            'rp_postmark' => null,
                            'rp_pre_postmark' => 71,
                            'actual_race_class' => '5',
                            'rp_ages_allowed_desc' => '2yo',
                            'race_group_code' => '0',
                            'race_group_desc' => 'Unknown',
                            'orig_race_output_order' => 3,
                            'dtw_rp_distance_desc' => null,
                            'dtw_sum_distance_value' => 4.5,
                            'dtw_count_horse_race' => 0,
                            'dtw_total_distance_value' => 16.75,
                            'course_name' => 'BRIGHTON',
                            'course_style_name' => 'Brighton',
                            'course_type_code' => 'F',
                            'rp_postmark_difference' => null,
                            'first_time_yn' => null,
                            'race_outcome_code' => '3  ',
                            'jockey_short_name' => 'S De Sousa',
                            'odds_value' => 2.25,
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::createFromArray(array(
                                            'race_instance_uid' => 684818,
                                            'ptv_video_id' => 248363,
                                            'video_provider' => 'ATR',
                                            'complete_race_uid' => 248363,
                                            'complete_race_start' => 0,
                                            'complete_race_end' => 1,
                                            'finish_race_uid' => 248363,
                                            'finish_race_start' => 0,
                                            'finish_race_end' => 1,
                                        )),
                                ),
                        )),
                    1 =>
                        RiRow::createFromArray(array(
                            'race_instance_uid' => 687359,
                            'race_datetime' => 'Oct 19 2017 12:10PM',
                            'course_uid' => 206,
                            'race_instance_title' => 'Prix Isonomy (Listed Race) (2yo) (Round) (Turf)',
                            'race_type_code' => 'F',
                            'distance_yard' => 1760,
                            'horse_uid' => 1570475,
                            'horse_style_name' => 'Alternative Fact',
                            'country_origin_code' => 'GB',
                            'weight_carried_lbs' => 125,
                            'weight_allowance_lbs' => 0,
                            'rp_betting_movements' => null,
                            'course_rp_abbrev_3' => 'Dea',
                            'course_rp_abbrev_4' => 'Deau',
                            'course_code' => 'DEAU',
                            'going_type_services_desc' => 'VSft',
                            'prize_sterling' => 25641.029999999999,
                            'prize_euro' => 0,
                            'no_of_runners' => 7,
                            'rp_close_up_comment' => 'raced keenly, held up towards rear, headway into midfield 4f out, ridden and kept on from 2f out, driven and won battle for 2nd inside final furlong, no chance with winner',
                            'rp_horse_head_gear_code' => null,
                            'odds_desc' => '42/10',
                            'jockey_uid' => 88850,
                            'jockey_style_name' => 'Cristian Demuro',
                            'jockey_ptp_type_code' => 'N',
                            'rp_postmark' => 0,
                            'rp_pre_postmark' => null,
                            'actual_race_class' => null,
                            'rp_ages_allowed_desc' => '2yo',
                            'race_group_code' => '4',
                            'race_group_desc' => 'Listed',
                            'orig_race_output_order' => 2,
                            'dtw_rp_distance_desc' => '5',
                            'dtw_sum_distance_value' => 5,
                            'dtw_count_horse_race' => 0,
                            'dtw_total_distance_value' => 23.300000000000001,
                            'course_name' => 'DEAUVILLE',
                            'course_style_name' => 'Deauville',
                            'course_type_code' => 'F',
                            'rp_postmark_difference' => null,
                            'first_time_yn' => null,
                            'race_outcome_code' => '2  ',
                            'jockey_short_name' => 'C Demuro',
                            'odds_value' => 4.2000000000000002,
                            'video_detail' => null,
                        )),
                )
            ]
        ];
    }

    /**
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetEntries
     */
    public function testGetEntries(
        \Api\Input\Request\Horses\Profile\Trainer\Entries $request,
        array $expectedResult
    ) {
        $trainerProfile = new \Tests\Stubs\Bo\TrainerProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($trainerProfile->getEntries())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetEntries()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Trainer\Entries(
                    [],
                    [
                        'trainerId' => 288
                    ]
                ),
                [
                    (Object)[
                        "race_instance_uid" => 616940,
                        "horse_uid" => 716279,
                        "style_name" => "Fire King",
                        "race_datetime" => "Jan 28 2015  4:45PM",
                        "style_name1" => "Kempton (A.W)",
                        "race_instance_title" => "32Red.com Handicap",
                        "race_status_code" => "O",
                        "race_group_uid" => 6,
                        "race_group_desc" => "Handicap",
                        "course_uid" => 195,
                        "course_name" => "PUNCHESTOWN",
                        "course_style_name" => "Punchestown",
                        'course_type_code' => 'N',
                        'running_conditions' => null,
                        "race_type_code" => "X",
                        "race_type_desc" => "Flat AW"
                    ],
                    (Object)[
                        "race_instance_uid" => 616942,
                        "horse_uid" => 874052,
                        "style_name" => "Sammy's Choice",
                        "race_datetime" => "Jan 28 2015  5:45PM",
                        "style_name1" => "Kempton (A.W)",
                        "race_instance_title" => "32Red On The App Store Median Auction Maiden Stakes",
                        "race_status_code" => "O",
                        "race_group_uid" => 0,
                        "race_group_desc" => "Unknown",
                        "course_uid" => 195,
                        "course_name" => "PUNCHESTOWN",
                        "course_style_name" => "Punchestown",
                        'course_type_code' => 'N',
                        'running_conditions' => null,
                        "race_type_code" => "F",
                        "race_type_desc" => "Flat Turf"
                    ],
                    (Object)[
                        "race_instance_uid" => 616976,
                        "horse_uid" => 661225,
                        "style_name" => "Teen Ager",
                        "race_datetime" => "Jan 31 2015  4:05PM",
                        "style_name1" => "Lingfield (A.W)",
                        "race_instance_title" => "Download The Ladbrokes App Apprentice Handicap",
                        "race_status_code" => "4",
                        "race_group_uid" => 6,
                        "race_group_desc" => "Handicap",
                        "course_uid" => 195,
                        "course_name" => "PUNCHESTOWN",
                        "course_style_name" => "Punchestown",
                        'course_type_code' => 'N',
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
     * @dataProvider providerTestGetStatisticalSummary
     */
    public function testGetStatisticalSummary(
        \Api\Input\Request\Horses\Profile\Trainer\StatisticalSummary $request,
        array $expectedResult
    ) {
        $trainerProfileObject = new \Tests\Stubs\Bo\TrainerProfile($request);

        $result = $trainerProfileObject->getStatisticalSummary();

        $this->assertEquals($result, $expectedResult);
    }

    /**
     * @return array
     */
    public function providerTestGetStatisticalSummary()
    {

        return [
            [
                new \Api\Input\Request\Horses\Profile\Trainer\StatisticalSummary(
                    [
                        'IRE',
                        'jumps',
                        null,
                    ],
                    [
                        'trainerId' => 14006
                    ]
                ),
                array(
                    0 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'season_start_date' => 'May 31 2005 12:00AM',
                                'season_end_date' => 'Apr 29 2006 11:59PM',
                                'races_number' => 1,
                                'place_1st_number' => 0,
                                'place_2nd_number' => 1,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'win_prize' => 0,
                                'total_prize' => 0,
                                'euro_win_prize' => 0,
                                'euro_total_prize' => 0,
                                'stake' => '-1.00000000000000',
                            )
                        ),
                    1 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'season_start_date' => 'May  4 2014 12:00AM',
                                'season_end_date' => 'May  2 2015 11:59PM',
                                'races_number' => 1,
                                'place_1st_number' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'win_prize' => 0,
                                'total_prize' => 0,
                                'euro_win_prize' => 0,
                                'euro_total_prize' => 0,
                                'stake' => '-1.00000000000000',
                            )
                        ),
                )
            ],
            [
                new \Api\Input\Request\Horses\Profile\Trainer\StatisticalSummary(
                    [
                        'GB',
                        'flat',
                        'turf',
                    ],
                    [
                        'trainerId' => 26099
                    ]
                ),
                array(
                    0 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'season_start_date' => 'Jan  1 2012 12:00AM',
                                'season_end_date' => 'Dec 31 2012 11:59PM',
                                'races_number' => 157,
                                'place_1st_number' => 14,
                                'place_2nd_number' => 11,
                                'place_3rd_number' => 11,
                                'place_4th_number' => 11,
                                'win_prize' => 77650.139999999999,
                                'total_prize' => 113642.64999999999,
                                'euro_win_prize' => 0,
                                'euro_total_prize' => 0,
                                'stake' => '-3.50000000000000',
                            )
                        ),
                    1 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'season_start_date' => 'Jan  1 2013 12:00AM',
                                'season_end_date' => 'Dec 31 2013 11:59PM',
                                'races_number' => 148,
                                'place_1st_number' => 12,
                                'place_2nd_number' => 11,
                                'place_3rd_number' => 8,
                                'place_4th_number' => 10,
                                'win_prize' => 108514.37,
                                'total_prize' => 137261.10000000001,
                                'euro_win_prize' => 0,
                                'euro_total_prize' => 0,
                                'stake' => '-43.75000000000000',
                            )
                        ),
                    2 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'season_start_date' => 'Jan  1 2014 12:00AM',
                                'season_end_date' => 'Dec 31 2014 11:59PM',
                                'races_number' => 170,
                                'place_1st_number' => 16,
                                'place_2nd_number' => 16,
                                'place_3rd_number' => 13,
                                'place_4th_number' => 13,
                                'win_prize' => 49529.800000000003,
                                'total_prize' => 111715,
                                'euro_win_prize' => 0,
                                'euro_total_prize' => 0,
                                'stake' => '20.87500000000000',
                            )
                        ),
                    3 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'season_start_date' => 'Jan  1 2015 12:00AM',
                                'season_end_date' => 'Dec 31 2015 11:59PM',
                                'races_number' => 175,
                                'place_1st_number' => 9,
                                'place_2nd_number' => 14,
                                'place_3rd_number' => 18,
                                'place_4th_number' => 17,
                                'win_prize' => 28059.650000000001,
                                'total_prize' => 61312.970000000001,
                                'euro_win_prize' => 0,
                                'euro_total_prize' => 0,
                                'stake' => '-102.75000000000000',
                            )
                        ),
                    4 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'season_start_date' => 'Jan  1 2016 12:00AM',
                                'season_end_date' => 'Dec 31 2016 11:59PM',
                                'races_number' => 143,
                                'place_1st_number' => 9,
                                'place_2nd_number' => 14,
                                'place_3rd_number' => 8,
                                'place_4th_number' => 16,
                                'win_prize' => 30866.950000000001,
                                'total_prize' => 62905.470000000001,
                                'euro_win_prize' => 0,
                                'euro_total_prize' => 0,
                                'stake' => '-2.59100000000000',
                            )
                        ),
                )
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Trainer\Statistics $request
     * @param array                                                $expectedResult
     *
     * @dataProvider providerTestGetStatistics
     */
    public function testGetStatistics(
        \Api\Input\Request\Horses\Profile\Trainer\Statistics $request,
        array $expectedResult
    ) {
        $trainerProfileObject = new \Tests\Stubs\Bo\TrainerProfile($request);

        $result = $trainerProfileObject->getStatistics();

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
                new \Api\Input\Request\Horses\Profile\Trainer\Statistics(
                    [
                        2014,
                        2015,
                        "GB",
                        "flat",
                        "jockey",
                        null,
                    ],
                    [
                        'trainerId' => 14006
                    ]
                ),
                [
                    'OVERALL' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 78224,
                                'group_name' => 'George Baker',
                                'rides' => 2,
                                'wins' => 1,
                                'stake' => '24.00000000000000',
                                'total_prize' => 4851.75,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 76875,
                                'group_name' => 'Mr D H Dunsdon',
                                'rides' => 6,
                                'wins' => 1,
                                'stake' => '7.00000000000000',
                                'total_prize' => 3820.5799999999999,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 87349,
                                'group_name' => 'Andrea Atzeni',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 699,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 92152,
                                'group_name' => 'Jordan Vaughan',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 384.80000000000001,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 79244,
                                'group_name' => 'Sam Hitchcott',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 7458,
                                'group_name' => 'Franny Norton',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 1202.5,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 1,
                                'placed' => 0,
                            ]
                        ),
                    ],
                    '4YO+' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => '4YO+',
                                'group_id' => 78224,
                                'group_name' => 'George Baker',
                                'rides' => 2,
                                'wins' => 1,
                                'stake' => '24.00000000000000',
                                'total_prize' => 4851.75,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => '4YO+',
                                'group_id' => 76875,
                                'group_name' => 'Mr D H Dunsdon',
                                'rides' => 6,
                                'wins' => 1,
                                'stake' => '7.00000000000000',
                                'total_prize' => 3820.5799999999999,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => '4YO+',
                                'group_id' => 87349,
                                'group_name' => 'Andrea Atzeni',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 699,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => '4YO+',
                                'group_id' => 92152,
                                'group_name' => 'Jordan Vaughan',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 384.80000000000001,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => '4YO+',
                                'group_id' => 79244,
                                'group_name' => 'Sam Hitchcott',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => '4YO+',
                                'group_id' => 7458,
                                'group_name' => 'Franny Norton',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 1202.5,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 1,
                                'placed' => 0,
                            ]
                        ),
                    ],
                ]
            ],
            [
                new \Api\Input\Request\Horses\Profile\Trainer\Statistics(
                    [
                        2014,
                        2015,
                        "IRE",
                        "jumps",
                        "race-type",
                        null,
                    ],
                    [
                        'trainerId' => 14006
                    ]
                ),
                [
                    'OVERALL' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_name' => 'Handicap',
                                'wins' => 0,
                                'rides' => 1,
                                'stake' => -1,
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                    ],
                    'CHASE' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_name' => 'Handicap',
                                'wins' => 0,
                                'rides' => 1,
                                'stake' => -1,
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                    ],
                ]
            ],
            [
                new \Api\Input\Request\Horses\Profile\Trainer\Statistics(
                    [
                        2013,
                        2014,
                        "GB",
                        "flat",
                        "distance",
                        "turf",
                    ],
                    [
                        'trainerId' => 14006
                    ]
                ),
                [
                    'OVERALL' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => 'OVERALL',
                                'group_name' => 5,
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 1,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => 'OVERALL',
                                'group_name' => 6,
                                'rides' => 6,
                                'wins' => 1,
                                'stake' => '20.00000000000000',
                                'total_prize' => 6127.9499999999998,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 1,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => 'OVERALL',
                                'group_name' => 7,
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 1202.5,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 1,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => 'OVERALL',
                                'group_name' => 8,
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                    ],
                    '4YO+' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => '4YO+',
                                'group_name' => 5,
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 1,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => '4YO+',
                                'group_name' => 6,
                                'rides' => 6,
                                'wins' => 1,
                                'stake' => '20.00000000000000',
                                'total_prize' => 6127.9499999999998,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 1,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => '4YO+',
                                'group_name' => 7,
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 1202.5,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 1,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'stats_type' => 'distance',
                                'category' => '4YO+',
                                'group_name' => 8,
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                    ],
                ]
            ],
            [
                new \Api\Input\Request\Horses\Profile\Trainer\Statistics(
                    [],
                    [
                        'trainerId' => 14006
                    ]
                ),
                [
                    'OVERALL' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 2,
                                'group_name' => 'Ascot',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 2385,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 11,
                                'group_name' => 'Cheltenham',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 12,
                                'group_name' => 'Chepstow',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 15,
                                'group_name' => 'Doncaster',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 2370,
                                'place_2nd_number' => 1,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 20,
                                'group_name' => 'Fontwell',
                                'rides' => 9,
                                'wins' => 2,
                                'stake' => '13.00000000000000',
                                'total_prize' => 9383.3999999999996,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 2,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 26,
                                'group_name' => 'Huntingdon',
                                'rides' => 4,
                                'wins' => 0,
                                'stake' => '-4.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 28,
                                'group_name' => 'Kempton',
                                'rides' => 3,
                                'wins' => 0,
                                'stake' => '-3.00000000000000',
                                'total_prize' => 572.39999999999998,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 35,
                                'group_name' => 'Market Rasen',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 36,
                                'group_name' => 'Newbury',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 44,
                                'group_name' => 'Plumpton',
                                'rides' => 8,
                                'wins' => 2,
                                'stake' => '-4.83600000000000',
                                'total_prize' => 9461.25,
                                'place_2nd_number' => 1,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 1,
                                'placed' => 2,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 54,
                                'group_name' => 'Sandown',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 67,
                                'group_name' => 'Stratford',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'OVERALL',
                                'group_id' => 83,
                                'group_name' => 'Towcester',
                                'rides' => 4,
                                'wins' => 0,
                                'stake' => '-4.00000000000000',
                                'total_prize' => 667.79999999999995,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                    ],
                    'CHASE' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 2,
                                'group_name' => 'Ascot',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 2385,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 11,
                                'group_name' => 'Cheltenham',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 12,
                                'group_name' => 'Chepstow',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 15,
                                'group_name' => 'Doncaster',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 2370,
                                'place_2nd_number' => 1,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 20,
                                'group_name' => 'Fontwell',
                                'rides' => 3,
                                'wins' => 1,
                                'stake' => '8.00000000000000',
                                'total_prize' => 2885.4000000000001,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 26,
                                'group_name' => 'Huntingdon',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 35,
                                'group_name' => 'Market Rasen',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 44,
                                'group_name' => 'Plumpton',
                                'rides' => 4,
                                'wins' => 0,
                                'stake' => '-4.00000000000000',
                                'total_prize' => 2194.1999999999998,
                                'place_2nd_number' => 1,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 54,
                                'group_name' => 'Sandown',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 67,
                                'group_name' => 'Stratford',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'CHASE',
                                'group_id' => 83,
                                'group_name' => 'Towcester',
                                'rides' => 3,
                                'wins' => 0,
                                'stake' => '-3.00000000000000',
                                'total_prize' => 667.79999999999995,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                    ],
                    'HURDLE' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'HURDLE',
                                'group_id' => 11,
                                'group_name' => 'Cheltenham',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'HURDLE',
                                'group_id' => 12,
                                'group_name' => 'Chepstow',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'HURDLE',
                                'group_id' => 20,
                                'group_name' => 'Fontwell',
                                'rides' => 4,
                                'wins' => 1,
                                'stake' => '7.00000000000000',
                                'total_prize' => 6498,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'HURDLE',
                                'group_id' => 26,
                                'group_name' => 'Huntingdon',
                                'rides' => 3,
                                'wins' => 0,
                                'stake' => '-3.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'HURDLE',
                                'group_id' => 28,
                                'group_name' => 'Kempton',
                                'rides' => 3,
                                'wins' => 0,
                                'stake' => '-3.00000000000000',
                                'total_prize' => 572.39999999999998,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 1,
                                'place_4th_number' => 0,
                                'placed' => 1,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'HURDLE',
                                'group_id' => 36,
                                'group_name' => 'Newbury',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'HURDLE',
                                'group_id' => 44,
                                'group_name' => 'Plumpton',
                                'rides' => 3,
                                'wins' => 2,
                                'stake' => '0.16400000000000',
                                'total_prize' => 7147.8000000000002,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 2,
                            ]
                        ),
                    ],
                    'NHF' => [
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'NHF',
                                'group_id' => 20,
                                'group_name' => 'Fontwell',
                                'rides' => 2,
                                'wins' => 0,
                                'stake' => '-2.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'NHF',
                                'group_id' => 44,
                                'group_name' => 'Plumpton',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 119.25,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 1,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'NHF',
                                'group_id' => 54,
                                'group_name' => 'Sandown',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'selectors' => null,
                                'category' => 'NHF',
                                'group_id' => 83,
                                'group_name' => 'Towcester',
                                'rides' => 1,
                                'wins' => 0,
                                'stake' => '-1.00000000000000',
                                'total_prize' => 0,
                                'place_2nd_number' => 0,
                                'place_3rd_number' => 0,
                                'place_4th_number' => 0,
                                'placed' => 0,
                            ]
                        ),
                    ],
                ]
            ],
            [
                new \Api\Input\Request\Horses\Profile\Trainer\Statistics(
                    [
                        2014,
                        2015,
                        "IRE",
                        "flat",
                        "race-type",
                        "aw",
                        "championship"
                    ],
                    [
                        'trainerId' => 1132
                    ]
                ),
                [
                    "OVERALL" => [
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "Apprentice",
                            "rides" => 17,
                            "wins" => 1,
                            "percent" => 6,
                            "stakes" => 4,
                            "total_prize" => 12255,
                            "place_2nd_number" => 4,
                            "place_3rd_number" => 2,
                            "place_4th_number" => 0,
                            "race_placed" => 7
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "Claiming",
                            "rides" => 2,
                            "wins" => 1,
                            "percent" => 50,
                            "stakes" => 1.25,
                            "total_prize" => 5875,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 2
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "Handicap",
                            "rides" => 112,
                            "wins" => 15,
                            "percent" => 13,
                            "stakes" => -18.38,
                            "total_prize" => 152227.5,
                            "place_2nd_number" => 12,
                            "place_3rd_number" => 9,
                            "place_4th_number" => 7,
                            "race_placed" => 37
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "Listed",
                            "rides" => 6,
                            "wins" => 0,
                            "percent" => 0,
                            "stakes" => -6,
                            "total_prize" => 19150,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 2,
                            "place_4th_number" => 0,
                            "race_placed" => 3
                        ],
                        (Object)[
                            "category" => "OVERALL",
                            "group_id" => null,
                            "group_name" => "Maiden",
                            "rides" => 61,
                            "wins" => 17,
                            "percent" => 28,
                            "stakes" => -12.89,
                            "total_prize" => 165075,
                            "place_2nd_number" => 11,
                            "place_3rd_number" => 7,
                            "place_4th_number" => 6,
                            "race_placed" => 35
                        ]
                    ],
                    "2YO" => [
                        (Object)[
                            "category" => "2YO",
                            "group_id" => null,
                            "group_name" => "Handicap",
                            "rides" => 2,
                            "wins" => 2,
                            "percent" => 100,
                            "stakes" => 5.75,
                            "total_prize" => 14490,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 2
                        ],
                        (Object)[
                            "category" => "2YO",
                            "group_id" => null,
                            "group_name" => "Listed",
                            "rides" => 1,
                            "wins" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 1100,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 0
                        ],
                        (Object)[
                            "category" => "2YO",
                            "group_id" => null,
                            "group_name" => "Maiden",
                            "rides" => 32,
                            "wins" => 8,
                            "percent" => 25,
                            "stakes" => -12.95,
                            "total_prize" => 90815,
                            "place_2nd_number" => 7,
                            "place_3rd_number" => 4,
                            "place_4th_number" => 3,
                            "race_placed" => 19
                        ]
                    ],
                    "3YO" => [
                        (Object)[
                            "category" => "3YO",
                            "group_id" => null,
                            "group_name" => "Apprentice",
                            "rides" => 10,
                            "wins" => 1,
                            "percent" => 10,
                            "stakes" => 11,
                            "total_prize" => 9010,
                            "place_2nd_number" => 2,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 4
                        ],
                        (Object)[
                            "category" => "3YO",
                            "group_id" => null,
                            "group_name" => "Claiming",
                            "rides" => 1,
                            "wins" => 0,
                            "percent" => 0,
                            "stakes" => -1,
                            "total_prize" => 700,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 1
                        ],
                        (Object)[
                            "category" => "3YO",
                            "group_id" => null,
                            "group_name" => "Handicap",
                            "rides" => 35,
                            "wins" => 8,
                            "percent" => 23,
                            "stakes" => 26.12,
                            "total_prize" => 69235,
                            "place_2nd_number" => 3,
                            "place_3rd_number" => 2,
                            "place_4th_number" => 3,
                            "race_placed" => 13
                        ],
                        (Object)[
                            "category" => "3YO",
                            "group_id" => null,
                            "group_name" => "Listed",
                            "rides" => 3,
                            "wins" => 0,
                            "percent" => 0,
                            "stakes" => -3,
                            "total_prize" => 13550,
                            "place_2nd_number" => 1,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 2
                        ],
                        (Object)[
                            "category" => "3YO",
                            "group_id" => null,
                            "group_name" => "Maiden",
                            "rides" => 29,
                            "wins" => 9,
                            "percent" => 31,
                            "stakes" => 0.06,
                            "total_prize" => 74260,
                            "place_2nd_number" => 4,
                            "place_3rd_number" => 3,
                            "place_4th_number" => 3,
                            "race_placed" => 16
                        ]
                    ],
                    "4YO+" => [
                        (Object)[
                            "category" => "4YO+",
                            "group_id" => null,
                            "group_name" => "Apprentice",
                            "rides" => 7,
                            "wins" => 0,
                            "percent" => 0,
                            "stakes" => -7,
                            "total_prize" => 3245,
                            "place_2nd_number" => 2,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 3
                        ],
                        (Object)[
                            "category" => "4YO+",
                            "group_id" => null,
                            "group_name" => "Claiming",
                            "rides" => 1,
                            "wins" => 1,
                            "percent" => 100,
                            "stakes" => 2.25,
                            "total_prize" => 5175,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 0,
                            "place_4th_number" => 0,
                            "race_placed" => 1
                        ],
                        (Object)[
                            "category" => "4YO+",
                            "group_id" => null,
                            "group_name" => "Handicap",
                            "rides" => 75,
                            "wins" => 5,
                            "percent" => 7,
                            "stakes" => -50.25,
                            "total_prize" => 68502.5,
                            "place_2nd_number" => 9,
                            "place_3rd_number" => 7,
                            "place_4th_number" => 4,
                            "race_placed" => 22
                        ],
                        (Object)[
                            "category" => "4YO+",
                            "group_id" => null,
                            "group_name" => "Listed",
                            "rides" => 2,
                            "wins" => 0,
                            "percent" => 0,
                            "stakes" => -2,
                            "total_prize" => 4500,
                            "place_2nd_number" => 0,
                            "place_3rd_number" => 1,
                            "place_4th_number" => 0,
                            "race_placed" => 1
                        ]
                    ]
                ],
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Trainer\Index $request
     * @param array                                           $expectedResult
     *
     * @dataProvider providerTestGetTrainer
     */
    public function testGetTrainer(
        \Api\Input\Request\Horses\Profile\Trainer\Index $request,
        $expectedResult
    ) {

        $trainerProfileObject = new \Tests\Stubs\Bo\TrainerProfile($request);

        $result = $trainerProfileObject->getTrainer();

        $this->assertEquals($result, $expectedResult);
    }

    /**
     * @return array
     */
    public function providerTestGetTrainer()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Trainer\Index(
                    [],
                    [
                        'trainerId' => 28624
                    ]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'trainer_name' => 'EDUARDO ABARCA',
                        'style_name' => 'Eduardo Abarca',
                        'mirror_name' => 'E ABARCA',
                        'ptp_type_code' => 'N',
                        'trainer_location' => 'Chile',
                        'country_code' => 'CHI',
                        'rp_x_coord' => null,
                        'rp_y_coord' => null,
                        'christian_name' => 'Eduardo',
                        'primary_trainer_code' => 'flat',
                        'running_to_form' => 83.333333333333,
                        'trainer_last_14_days' => \Api\Row\WinsRuns::createFromArray(
                            [
                                'runs' => 6,
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

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     * @param array                            $expectedResult
     *
     * @dataProvider providerTestGetSeasonDefaultValues
     */
    public function testGetSeasonDefaultValues(
        $request,
        array $expectedResult
    ) {
        $bo = new \Tests\Stubs\Bo\TrainerProfile($request);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($bo->getSeasonDefaultValues())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetSeasonDefaultValues()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Trainer\Statistics(
                    [],
                    [
                        'trainerId' => 900
                    ]
                ),
                [
                    'seasonYearBegin' => 2015,
                    'seasonYearEnd' => 2015,
                    'raceType' => 'flat',
                    'countryCode' => 'GB',
                    'statisticsType' => 'course'
                ]
            ],

        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Trainer\Results $request
     * @param array                                             $expectedResult
     *
     * @dataProvider providerTestGetResults
     */
    public function testGetResults(
        \Api\Input\Request\Horses\Profile\Trainer\Results $request,
        array $expectedResult
    ) {
        $trainerProfile = new \Tests\Stubs\Bo\TrainerProfile($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($trainerProfile->getResults())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetResults()
    {
        return [
            [
                new \Api\Input\Request\Horses\Profile\Trainer\Results(
                    [
                        2016
                    ],
                    [
                        'trainerId' => 31567
                    ]
                ),
                array(
                    640767 =>
                        RiRow::createFromArray(array(
                            'race_datetime' => 'Jan  2 2016  2:15PM',
                            'rp_abbrev_3' => 'Cfd',
                            'country_code' => 'GB ',
                            'distance_yard' => 1100,
                            'race_instance_uid' => 640767,
                            'race_instance_title' => 'Scoop6Soccer Results At totepoolliveinfo.com Conditions Stakes (AW Championship Fast-Track Qual\')',
                            'course_style_name' => 'Chelmsford (A.W)',
                            'horse_style_name' => 'Magnus Maximus',
                            'country_origin_code' => 'GB',
                            'horse_uid' => 831567,
                            'prize_sterling' => 1398,
                            'prize_euro' => 0,
                            'days_diff' => 661,
                            'days_diff1' => 661,
                            'race_outcome_code' => '4',
                            'race_outcome_position' => 4,
                            'disq_desc' => null,
                            'jockey_style_name' => 'Pat Cosgrave',
                            'jockey_uid' => 14629,
                            'jockey_short_name' => 'P Cosgrave',
                            'jockey_ptp_type_code' => 'N',
                            'race_type_code' => 'X',
                            'race_group_desc' => 'Unknown',
                            'race_group_code' => '0',
                            'course_uid' => 1083,
                            'course_type_code' => 'X',
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::createFromArray(array(
                                            'race_instance_uid' => 640767,
                                            'ptv_video_id' => 90252,
                                            'video_provider' => 'ATR',
                                            'complete_race_uid' => 90252,
                                            'complete_race_start' => 0,
                                            'complete_race_end' => 1,
                                            'finish_race_uid' => 90252,
                                            'finish_race_start' => 0,
                                            'finish_race_end' => 1,
                                        )),
                                ),
                        )),
                    641118 =>
                        RiRow::createFromArray(array(
                            'race_datetime' => 'Jan  6 2016  2:20PM',
                            'rp_abbrev_3' => 'WOL',
                            'country_code' => 'GB ',
                            'distance_yard' => 1902,
                            'race_instance_uid' => 641118,
                            'race_instance_title' => 'EBF 32Red.com Fillies\' Handicap',
                            'course_style_name' => 'Wolverhampton (A.W)',
                            'horse_style_name' => 'Amaze Me',
                            'country_origin_code' => 'GB',
                            'horse_uid' => 865760,
                            'prize_sterling' => 0,
                            'prize_euro' => 0,
                            'days_diff' => 657,
                            'days_diff1' => 657,
                            'race_outcome_code' => '6',
                            'race_outcome_position' => 6,
                            'disq_desc' => null,
                            'jockey_style_name' => 'Adam Kirby',
                            'jockey_uid' => 83607,
                            'jockey_short_name' => 'A Kirby',
                            'jockey_ptp_type_code' => 'N',
                            'race_type_code' => 'X',
                            'race_group_desc' => 'Handicap',
                            'race_group_code' => 'H',
                            'course_uid' => 513,
                            'course_type_code' => 'X',
                            'video_detail' =>
                                array(
                                    0 =>
                                        GeneralRow::createFromArray(array(
                                            'race_instance_uid' => 641118,
                                            'ptv_video_id' => 91020,
                                            'video_provider' => 'ATR',
                                            'complete_race_uid' => 91020,
                                            'complete_race_start' => 0,
                                            'complete_race_end' => 1,
                                            'finish_race_uid' => 91020,
                                            'finish_race_start' => 0,
                                            'finish_race_end' => 1,
                                        )),
                                ),
                        )),
                )
            ],
        ];
    }
}
