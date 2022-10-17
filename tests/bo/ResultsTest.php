<?php

namespace Tests;

use \Phalcon\Mvc\Model\Row\General as GeneralRow;

/**
 * Class Results
 *
 * @package Tests
 */
class Results extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider providerTestWrongRaceId
     * @expectedException \Api\Exception\ValidationError
     */
    public function testWrongRaceId($raceId)
    {
        $request = new \Api\Input\Request\Horses\Results\Index([$raceId]);
        $request->getRaceId();
        new Stubs\Bo\Results($request);
    }

    /**
     * @return array
     */
    public function providerTestWrongRaceId()
    {
        return [
            ['fds'],
            [0],
            [-1],
        ];
    }

    /**
     * @dataProvider providerTestGetStatistic
     */
    public function testGetStatistic($raceId, $expectedResult)
    {

        $request = new \Api\Input\Request\Horses\Results\Index([], ['raceId' => $raceId]);

        $resultsObject = new Stubs\Bo\Results($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($resultsObject->getStatistic())
        );
    }


    /**
     * @return array
     */
    public function providerTestGetStatistic()
    {
        return [
            [
                582658,
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'zenithOfficial' => 90.833333330000002,
                        'race_instance_uid' => 582658,
                        'winners_time_secs' => 57.579999999999998,
                        'diff_to_standard_time_sec' => null,
                        'total_sp' => 50.5,
                        'course_uid' => 1017,
                        'no_of_runners' => 11,
                        'no_of_runners_calculated' => 11,
                        'average_time_sec' => null,
                        'odds_value' => 1,
                        'country_code' => 'PER',
                    ]
                )
            ]
        ];
    }

    /**
     * @dataProvider providerTestGetTote
     */
    public function testGetTote($raceId, $expectedResult)
    {
        $request = new \Api\Input\Request\Horses\Results\Index([], ['raceId' => $raceId]);

        $resultsObject = new Stubs\Bo\Results($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($resultsObject->getTote())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetTote()
    {
        return [
            [
                582658,
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'tote_deadheat_text' => "PARI-MUTUEL: WIN (all including 3 pen stakes): 31.50; PLACE (1-2): 13.80, 13.50; SF (including 2 pen stake): 98.00",
                        'tote_win_money' => null,
                        'tote_place_1_money' => null,
                        'tote_place_2_money' => null,
                        'tote_place_3_money' => null,
                        'tote_place_4_money' => null,
                        'tote_dual_forecast_money' => null,
                        'computer_strght_frcst_money' => null,
                        'tricast_money' => null,
                        'tote_trio_money' => null,
                        'trio_text' => " ",
                        'jackpot_text' => null,
                        'placepot_text' => null,
                        'quadpot_text' => null,
                        'rule4_text' => null,
                        'selling_details_text' => null,
                        'days_diff' => 4902,
                        'country_code' => "PER",
                        'race_comments' => null,
                        'race_status_code' => 'R',
                        'race_instance_uid' => 582658,
                        'scoop6_dividend' => null,
                    ]
                )
            ]
        ];
    }

    /**
     * @param int   $fastRaceId
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetFastResult
     */
    public function testGetFastResult($fastRaceId, $expectedResult)
    {
        $request = new \Api\Input\Request\Horses\Results\Fast([$fastRaceId], []);

        $resultsObject = new Stubs\Bo\Results($request);
        $this->assertEquals(
            $expectedResult,
            $resultsObject->getFastResult()
        );
    }

    /**
     * @return array
     */
    public function providerTestGetFastResult()
    {
        return [
            [
                178847,
                (Object)[
                    'fast_race_instance_uid' => 178847,
                    'course_name' => "SOUTHWELL",
                    'race_datetime' => "Jan 22 2015  2:40PM",
                    'favorite' => null,
                    'no_of_runners' => 7,
                    'non_runners' => "Striking Stone, Misu Pete",
                    'tote_win_money' => "4.60",
                    'dual_forecast' => "10.30",
                    'csf' => "9.26",
                    'tricast' => "17.58",
                    'placepot' => null,
                    'miscellaneous' => "| PL: #1.80, #2.20;Trifecta: #24.40; Weighed In",
                    'race_instance_uid' => 181129,
                    'formbook_yn' => 'Y',
                    'horses' => (Object)[
                        'horse_name' => "Pancake Day",
                        'jockey_name' => "A Elliott",
                        'saddle_cloth_number' => 4,
                        'race_outcome_position' => 1,
                        'starting_price' => "7/2",
                    ]
                ]
            ],
            [
                178848,
                (Object)[
                    'fast_race_instance_uid' => 178848,
                    'course_name' => "SOUTHWELL",
                    'race_datetime' => "Jan 22 2015  2:40PM",
                    'favorite' => null,
                    'no_of_runners' => 7,
                    'non_runners' => "Striking Stone, Misu Pete",
                    'tote_win_money' => "4.60",
                    'dual_forecast' => "10.30",
                    'csf' => "9.26",
                    'tricast' => "17.58",
                    'placepot' => null,
                    'miscellaneous' => "| PL: #1.80, #2.20;Trifecta: #24.40; Weighed In",
                    'race_instance_uid' => null,
                    'formbook_yn' => null,
                    'horses' => (Object)[
                        'horse_name' => "Pancake Day",
                        'jockey_name' => "A Elliott",
                        'saddle_cloth_number' => 4,
                        'race_outcome_position' => 1,
                        'starting_price' => "7/2",
                    ]
                ]
            ]
        ];
    }

    /**
     * @param int   $raceId
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetFastByRaceResult
     */
    public function testGetFastByRaceResult($raceId, $expectedResult)
    {
        $request = new \Api\Input\Request\Horses\Results\FastByRace([$raceId], []);
        $resultsObject = new Stubs\Bo\Results($request);

        $this->assertEquals(
            $expectedResult,
            $resultsObject->getFastByRaceResult()
        );
    }

    /**
     * @return array
     */
    public function providerTestGetFastByRaceResult()
    {
        return [
            [
                671748,
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'course_name' => 'NEWMARKET',
                        'race_datetime' => 'Apr 19 2017  3:35PM',
                        'favorite' => 'Roly Poly 7/2F',
                        'no_of_runners' => 11,
                        'non_runners' => null,
                        'tote_win_money' => '13.20',
                        'dual_forecast' => '176.30',
                        'csf' => '160.45',
                        'tricast' => null,
                        'placepot' => null,
                        'miscellaneous' => '| PL: #3.70, #3.60, #2.20;Trifecta: #1257.70; Weighed In',
                        'race_instance_uid' => 671748,
                        'fast_race_instance_uid' => 207236,
                        'formbook_yn' => 'Y',
                        'horses' =>
                            [
                                0 =>
                                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                                        [
                                            'horse_name' => 'Daban',
                                            'saddle_cloth_number' => 3,
                                            'jockey_name' => 'L Dettori',
                                            'odds_desc' => '12/1',
                                            'race_outcome_position' => 1,
                                        ]
                                    ),
                                1 =>
                                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                                        [
                                            'horse_name' => 'Unforgetable Filly',
                                            'saddle_cloth_number' => 11,
                                            'jockey_name' => 'James Doyle',
                                            'odds_desc' => '14/1',
                                            'race_outcome_position' => 2,
                                        ]
                                    ),
                                2 =>
                                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                                        [
                                            'horse_name' => 'Poet\'s Vanity',
                                            'saddle_cloth_number' => 7,
                                            'jockey_name' => 'Oisin Murphy',
                                            'odds_desc' => '6/1',
                                            'race_outcome_position' => 3,
                                        ]
                                    ),
                            ],
                    ]
                )
            ],
            [
                671661,
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'course_name' => 'CHELTENHAM',
                        'race_datetime' => 'Apr 19 2017  2:05PM',
                        'favorite' => null,
                        'no_of_runners' => 5,
                        'non_runners' => null,
                        'tote_win_money' => '1.30',
                        'dual_forecast' => '20.10',
                        'csf' => '15.80',
                        'tricast' => null,
                        'placepot' => null,
                        'miscellaneous' => '| PL: #1.10, #7.90;Trifecta: #74.40; Weighed In',
                        'race_instance_uid' => 671661,
                        'fast_race_instance_uid' => 207228,
                        'formbook_yn' => 'Y',
                        'horses' =>
                            [
                                0 =>
                                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                                        [
                                            'horse_name' => 'William Henry',
                                            'saddle_cloth_number' => 4,
                                            'jockey_name' => 'D N Russell',
                                            'odds_desc' => '8/15F',
                                            'race_outcome_position' => 1,
                                        ]
                                    ),
                                1 =>
                                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                                        [
                                            'horse_name' => 'Blairs Cove',
                                            'saddle_cloth_number' => 5,
                                            'jockey_name' => 'Ian Popham',
                                            'odds_desc' => '40/1',
                                            'race_outcome_position' => 2,
                                        ]
                                    ),
                            ],
                    ]
                )
            ]
        ];
    }

     /**
     * @dataProvider providerTestGetCourses
     */
    public function testGetCourses($expectedResult)
    {
        $request = new \Api\Input\Request\Horses\Results\Courses([]);

        $resultsObject = new Stubs\Bo\Results($request);
        $this->assertEquals(
            $expectedResult,
            $resultsObject->getCourses()
        );
    }

    /**
     * @return array
     */
    public function providerTestGetCourses()
    {
        return [
            [
                [
                    (Object)[
                        "country_code" => "GB ",
                        "country_desc" => "Great Britain",
                        "courses" => [
                            (Object)[
                                "course_uid" => 32,
                                "course_name" => "AINTREE",
                                "course_style_name" => "Aintree",
                            ],
                            (Object)[
                                "course_uid" => 2,
                                "course_name" => "ASCOT",
                                "course_style_name" => "Ascot",
                            ],
                        ]
                    ],
                    (Object)[
                        "country_code" => "IRE",
                        "country_desc" => "Ireland",
                        "courses" => [
                            (Object)[
                                "course_uid" => 175,
                                "course_name" => "BALLINROBE",
                                "course_style_name" => "Ballinrobe",
                            ],
                            (Object)[
                                "course_uid" => 176,
                                "course_name" => "BELLEWSTOWN",
                                "course_style_name" => "Bellewstown",
                            ],
                        ]
                    ],

                ]
            ]
        ];
    }

    /**
     * @dataProvider providerTestGetDividends`
     */
    public function testGetDividends($raceDate, $expectedResult)
    {
        $request = new \Api\Input\Request\Horses\Results\DateRequest([], ['raceDate' => $raceDate]);

        $resultsObject = new Stubs\Bo\Results($request);

        $dividends = $resultsObject->getDividends($raceDate, []);
        $this->assertEquals($expectedResult, $dividends);
    }

    /**
     * @return array
     */
    public function providerTestGetDividends()
    {
        return [
            [
                '2011-08-08',
                [
                    31 =>
                        [
                            'current_race_number' => 0,
                            'total_number_of_races' => 0,
                            'aggregate_sp' => 29.800000000000001,
                            'favorites_index' => 30,
                            'winning_distances' => 6.9500000000000002,
                            'double_cards' => 34,
                            'betting_man' => 'ALEC BAKER',
                            'analysis_man' => 'RON WOOD',
                            'close_up_man' => 'STEVE PAYNE',
                        ],
                ]
            ],
            [
                '2013-06-23',
                [
                    1017 => [
                        'current_race_number' => 0,
                        'total_number_of_races' => 0,
                        'aggregate_sp' => 25.5,
                        'favorites_index' => 0,
                        'winning_distances' => 3.25,
                        'double_cards' => 48,
                        'betting_man' => null,
                        'analysis_man' => null,
                        'close_up_man' => null,
                    ]
                ]
            ],
        ];
    }

    /**
     * @param $races          Array
     * @param $expectedResult String
     *
     * @dataProvider providerSortRaces
     */
    public function testSortRaces($races, $expectedResult)
    {

        $raceIdA = $races[0];
        $raceIdB = $races[1];

        $requestA = new \Api\Input\Request\Horses\Results\Index([], ['raceId' => $raceIdA]);
        $resultsObjA = new Stubs\Bo\Results($requestA);

        $resultA = $resultsObjA->getRaceInfo($raceIdA);
        $resultB = $resultsObjA->getRaceInfo($raceIdB);


        $reflector = new \ReflectionClass($resultsObjA);

        $rfMethod = $reflector->getMethod('sortRaces');
        $rfMethod->setAccessible(true);

        $actualResult = $rfMethod->invokeArgs(
            $resultsObjA,
            [$resultA, $resultB]
        );

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerSortRaces()
    {
        return [
            [
                [582658, 599697],
                -1
            ],
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Results\Search $request
     * @param array                                    $expectedResult
     *
     * @dataProvider providerTestGetSearchResult
     */
    public function testGetSearchResult(
        \Api\Input\Request\Horses\Results\Search $request,
        array $expectedResult
    ) {
        $resultsObject = new Stubs\Bo\Results($request);

        $searchResult = $resultsObject->getSearchResult();

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($searchResult)
        );
    }

    /**
     * @return array
     */
    public function providerTestGetSearchResult()
    {
        return [
            [
                new \Api\Input\Request\Horses\Results\Search([]),
                [
                    'search_result' => [
                        0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'race_instance_uid' => 633803,
                                'race_instance_title' => 'Straightline Construction Handicap Chase',
                                'race_datetime' => 'Sep 16 2015  6:10PM',
                                'formbook_yn' => 'Y',
                                'r_status' => 'R',
                                'no_of_runners' => null,
                                'no_of_runners_calculated' => 8,
                                'course_country' => 'GB',
                                'country_code' => 'GB ',
                                'course_uid' => 27,
                                'course_name' => 'KELSO',
                                'course_style_name' => 'Kelso',
                                'date_sort' => 'Sep 16 2015 12:00AM',
                            ]
                        ),
                        1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'race_instance_uid' => 633801,
                                'race_instance_title' => 'Farne Salmon & Trout Handicap Chase',
                                'race_datetime' => 'Sep 16 2015  5:10PM',
                                'formbook_yn' => 'Y',
                                'r_status' => 'R',
                                'no_of_runners' => null,
                                'no_of_runners_calculated' => 6,
                                'course_country' => 'GB',
                                'country_code' => 'GB ',
                                'course_uid' => 27,
                                'course_name' => 'KELSO',
                                'course_style_name' => 'Kelso',
                                'date_sort' => 'Sep 16 2015 12:00AM',
                            ]
                        ),
                        2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'race_instance_uid' => 634823,
                                'race_instance_title' => 'Guinness Kerry National Handicap Chase (Grade A)',
                                'race_datetime' => 'Sep 16 2015  4:20PM',
                                'formbook_yn' => 'Y',
                                'r_status' => 'R',
                                'no_of_runners' => 17,
                                'no_of_runners_calculated' => 17,
                                'course_country' => 'IRE',
                                'country_code' => 'IRE',
                                'course_uid' => 190,
                                'course_name' => 'LISTOWEL',
                                'course_style_name' => 'Listowel',
                                'date_sort' => 'Sep 16 2015 12:00AM',
                            ]
                        ),
                    ],
                    'number_of_rows_exceeded' => false
                ]
            ],
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\Results\WinningTimes $request
     * @param array                                          $expectedResult
     *
     * @dataProvider providerTestGetWinningTimes
     */
    public function testGetWinningTimes(
        \Api\Input\Request\Horses\Results\WinningTimes $request,
        array $expectedResult
    ) {
        $resultsObject = new Stubs\Bo\Results($request);

        $actualResult = $resultsObject->getWinningTimes();

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($actualResult)
        );
    }

    public function providerTestGetWinningTimes()
    {
        return [
            [
                new \Api\Input\Request\Horses\Results\WinningTimes([4, '2015-10-27']),
                [
                    0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'race_instance_uid' => 636316,
                            'race_type_code' => 'H',
                            'winners_time_secs' => 299,
                            'rp_going_correction' => -1,
                            'distance_yard' => 4303,
                            'race_datetime' => 'Oct 27 2015  1:55PM',
                            'standard_time' => 264,
                            'rp_going_type_desc' => 'Good',
                            'rp_topspeed' => 49,
                            'rp_postmark' => 105,
                            'horse_style_name' => 'Murray Mount',
                            'horse_uid' => 854146,
                            'time_comparison' => 35,
                            'winners_time_secs_per_furlong' => 15.28700906344411,
                            'time_comparison_per_furlong' => 1.7894492214733908,
                            'rp_going_correction_desc' => 'Soft',
                        ]
                    ),
                    1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'race_instance_uid' => 636317,
                            'race_type_code' => 'C',
                            'winners_time_secs' => 302.89999999999998,
                            'rp_going_correction' => -0.5,
                            'distance_yard' => 4472,
                            'race_datetime' => 'Oct 27 2015  2:30PM',
                            'standard_time' => 289,
                            'rp_going_type_desc' => 'Good',
                            'rp_topspeed' => 101,
                            'rp_postmark' => 140,
                            'horse_style_name' => 'Coologue',
                            'horse_uid' => 859050,
                            'time_comparison' => 13.9,
                            'winners_time_secs_per_furlong' => 14.901162790697672,
                            'time_comparison_per_furlong' => 0.6838103756708408,
                            'rp_going_correction_desc' => 'Good',
                        ]
                    ),
                    2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'race_instance_uid' => 636318,
                            'race_type_code' => 'H',
                            'winners_time_secs' => 257.89999999999998,
                            'rp_going_correction' => -1,
                            'distance_yard' => 3665,
                            'race_datetime' => 'Oct 27 2015  3:00PM',
                            'standard_time' => 228,
                            'rp_going_type_desc' => 'Good',
                            'rp_topspeed' => 36,
                            'rp_postmark' => 104,
                            'horse_style_name' => 'Lady Yeats',
                            'horse_uid' => 838609,
                            'time_comparison' => 29.899999999999999,
                            'winners_time_secs_per_furlong' => 15.481036834924964,
                            'time_comparison_per_furlong' => 1.7948158253751703,
                            'rp_going_correction_desc' => 'Soft',
                        ]
                    ),
                    3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'race_instance_uid' => 636319,
                            'race_type_code' => 'C',
                            'winners_time_secs' => 265.69999999999999,
                            'rp_going_correction' => -0.5,
                            'distance_yard' => 3817,
                            'race_datetime' => 'Oct 27 2015  3:30PM',
                            'standard_time' => 245,
                            'rp_going_type_desc' => 'Good',
                            'rp_topspeed' => 66,
                            'rp_postmark' => 125,
                            'horse_style_name' => 'Gee Hi',
                            'horse_uid' => 755233,
                            'time_comparison' => 20.699999999999999,
                            'winners_time_secs_per_furlong' => 15.314121037463975,
                            'time_comparison_per_furlong' => 1.1930835734870315,
                            'rp_going_correction_desc' => 'Good',
                        ]
                    ),
                    4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'race_instance_uid' => 636320,
                            'race_type_code' => 'H',
                            'winners_time_secs' => 358.10000000000002,
                            'rp_going_correction' => -1,
                            'distance_yard' => 5092,
                            'race_datetime' => 'Oct 27 2015  4:00PM',
                            'standard_time' => 320,
                            'rp_going_type_desc' => 'Good',
                            'rp_topspeed' => 66,
                            'rp_postmark' => 125,
                            'horse_style_name' => 'Georgie Lad',
                            'horse_uid' => 809404,
                            'time_comparison' => 38.100000000000001,
                            'winners_time_secs_per_furlong' => 15.471720345640222,
                            'time_comparison_per_furlong' => 1.6461115475255303,
                            'rp_going_correction_desc' => 'Soft',
                        ]
                    ),
                    5 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'race_instance_uid' => 636321,
                            'race_type_code' => 'B',
                            'winners_time_secs' => 246.30000000000001,
                            'rp_going_correction' => -1,
                            'distance_yard' => 3665,
                            'race_datetime' => 'Oct 27 2015  4:30PM',
                            'standard_time' => 220,
                            'rp_going_type_desc' => 'Good',
                            'rp_topspeed' => 65,
                            'rp_postmark' => 112,
                            'horse_style_name' => 'Criq Rock',
                            'horse_uid' => 868918,
                            'time_comparison' => 26.300000000000001,
                            'winners_time_secs_per_furlong' => 14.784720327421555,
                            'time_comparison_per_furlong' => 1.5787175989085949,
                            'rp_going_correction_desc' => 'Soft',
                        ]
                    )
                ]
            ]
        ];
    }

    /**
     * @param array $runners
     * @param array $expectedResult
     * @dataProvider providerTestAddFavorites
     */
    public function testAddFavorites(
        array $runners,
        array $expectedResult
    ) {
        $request = new \Api\Input\Request\Horses\Results\Index([], ["raceId" => 1]);
        $resultsObject = new Stubs\Bo\Results($request);

        $resultsObject->addFavorites($runners);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($runners)
        );
    }

    public function providerTestAddFavorites()
    {
        return [
            'withOneRunner2ndFavourite' => [
                'inputRunners' => [
                    0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 5,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    ),
                    1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 2,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    ),
                    2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 3,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    )
                ],
                'expected' => [
                    0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 5,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    ),
                    1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 2,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 1,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    ),
                    2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 3,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 1
                        ]
                    )
                ]
            ],
            'withTwoRunners2ndFavourite' => [
                'inputRunners' => [
                    0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 1,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    ),
                    1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 2,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    ),
                    2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 2,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    )
                ],
                'expected' => [
                    0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 1,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 1,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    ),
                    1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 2,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 1,
                            'fav_2nd' => 0
                        ]
                    ),
                    2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 2,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 1,
                            'fav_2nd' => 0
                        ]
                    )
                ]
            ],
            'withTwoOrMoreRunnersWithLowestOdds' => [
                'inputRunners' => [
                    0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 1,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    ),
                    1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 1,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    ),
                    2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 3,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    )
                ],
                'expected' => [
                    0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 1,
                            'joint_1st_fav' => 1,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 1,
                            'fav_2nd' => 0
                        ]
                    ),
                    1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 1,
                            'joint_1st_fav' => 1,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 1,
                            'fav_2nd' => 0
                        ]
                    ),
                    2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 3,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    )
                ]
            ],
            'withThreeOrMoreRunners2ndFavourite' => [
                'inputRunners' => [
                    0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 1,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    ),
                    1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 3,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    ),
                    2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 3,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    ),
                    3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 3,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    ),
                    4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 5,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    )
                ],
                'expected' => [
                    0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 1,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 1,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    ),
                    1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 3,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 1,
                            'fav_2nd' => 0
                        ]
                    ),
                    2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 3,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 1,
                            'fav_2nd' => 0
                        ]
                    ),
                    3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 3,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 1,
                            'fav_2nd' => 0
                        ]
                    ),
                    4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'odds_value' => 5,
                            'joint_1st_fav' => 0,
                            'fav_1st' => 0,
                            'joint_2nd_fav' => 0,
                            'fav_2nd' => 0
                        ]
                    )
                ]
            ]
        ];
    }
}
