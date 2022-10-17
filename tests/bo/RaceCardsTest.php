<?php

namespace Tests;

use \Api\Row\Meeting as Meeting;
use \Api\Row\RaceInstance as RaceInstance;
use \Phalcon\Mvc\Model\Row\General as General;
use Tests\Stubs\Bo\RaceCards;

/**
 * Class RaceCardsTest
 *
 * @package Tests
 */
class RaceCardsTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @return array
     */
    public function providerTestGetRaceCard()
    {
        return [
            [
                643539,
                RaceInstance::createFromArray(
                    [
                        'race_instance_title' => 'High Definition Racing UK Next Month Novices\' Hurdle',
                        'rp_ages_allowed_desc' => '4yo+',
                        'race_class' => '4',
                        'official_rating_band_desc' => null,
                        'race_datetime' => date("Y-m-d ") . '12:00',
                        'three_yo_min_weight_lbs' => null,
                        'minimum_weight_lbs' => null,
                        'declared_runners' => 16,
                        'no_of_runners' => 15,
                        'distance_yard' => 3471,
                        'rp_tv_text' => 'RUK',
                        'going_type_desc' => 'Good To Soft',
                        'rp_penalties' => 'each hurdle won 7lb',
                        'course_uid' => 26,
                        'mixed_course_uid' => null,
                        'course_name' => 'HUNTINGDON',
                        'course_style_name' => 'Huntingdon',
                        'rp_horse_types' => '4yo+ which have not won more than three hurdles',
                        'rp_weights' => '4yo 10st 7lb; 5yo+ 11st 2lb',
                        'allowances' => 'fillies & mares 7lb',
                        'entry_fee' => 25,
                        'extra_fee' => null,
                        'country_code' => 'GB ',
                        'foreign' => 0,
                        'rp_stakes' => 5000,
                        'rp_ag_indicator' => 'G',
                        'weights_raised_lbs' => null,
                        'rp_auction_min' => null,
                        'rp_claim_min' => null,
                        'rp_confirmed' => null,
                        'race_status_code' => 'R',
                        'race_type_code' => 'H',
                        'race_group_desc' => null,
                        'going_type_code' => 'GS',
                        'no_of_fences' => 8,
                        'no_of_entries' => 45,
                        'rp_stalls_position' => ' ',
                        'race_group_code' => 'H',
                        'minimum_weight_lbs1' => null,
                        'safety_factor_number' => 16,
                        'early_closing_race_yn' => null,
                        'reopened_yn' => 'N',
                        'division_preference' => 2,
                        'last_year' => 'GRAND MARCH, 06-11-11, David Bass, 3-1 (Kim Bailey) 07 ran.',
                        'forfeits' => [
                            General::createFromArray(
                                [
                                    'stage' => 2,
                                    'forfeit_number' => 58,
                                    'forfeit_value' => 310
                                ]
                            ),
                            General::createFromArray(
                                [
                                    'stage' => 1,
                                    'forfeit_number' => 57,
                                    'forfeit_value' => 250
                                ]
                            )
                        ],
                        'highest_official_rating' => General::createFromArray(
                            [
                                'horse_uid' => 867395,
                                'horse_name' => 'Azzuri',
                                'official_rating' => 80,
                            ]
                        ),
                        'scoop6_race' => 'N',
                        'jackpot_race' => 'N',
                        'william_hill_offer_race' => 'N',
                        'ladbrokes_offer_race' => 'N',
                        'perform_race_uid_atr' => 111773,
                        'perform_race_uid_ruk' => null,
                        'aw_surface_type' => null,
                        'stalls_position_desc' => null,
                        'straight_round_jubilee_code' => null,
                        'prizes' => [
                            0 => (object)[
                                'position_no' => 1,
                                'prize_sterling' => 3249,
                                'prize_euro' => null,
                            ],
                            1 => (object)[
                                'position_no' => 2,
                                'prize_sterling' => 954,
                                'prize_euro' => null,
                            ],
                            2 => (object)[
                                'position_no' => 3,
                                'prize_sterling' => 477,
                                'prize_euro' => null,
                            ],
                            3 => (object)[
                                'position_no' => 4,
                                'prize_sterling' => 238.5,
                                'prize_euro' => null,
                            ],
                        ],
                        'claiming_prices' => [
                            0 => General::createFromArray(
                                [
                                    'horse_name' => 'Kilcascan',
                                    'horse_uid' => 702076,
                                    'start_number' => 1,
                                    'prize_sterling' => 0,
                                    'prize_euro' => null,
                                    'vat_indicator' => null,
                                    'claiming_text' => null
                                ]
                            ),
                            1 => General::createFromArray(
                                [
                                    'horse_name' => 'Kilcascan',
                                    'horse_uid' => 702076,
                                    'start_number' => 2,
                                    'prize_sterling' => 0,
                                    'prize_euro' => null,
                                    'vat_indicator' => null,
                                    'claiming_text' => null
                                ]
                            ),
                            2 => General::createFromArray(
                                [
                                    'horse_name' => 'Kilcascan',
                                    'horse_uid' => 702076,
                                    'start_number' => 3,
                                    'prize_sterling' => 0,
                                    'prize_euro' => null,
                                    'vat_indicator' => null,
                                    'claiming_text' => null
                                ]
                            ),
                            3 => General::createFromArray(
                                [
                                    'horse_name' => 'Kilcascan',
                                    'horse_uid' => 702076,
                                    'start_number' => 4,
                                    'prize_sterling' => 0,
                                    'prize_euro' => null,
                                    'vat_indicator' => null,
                                    'claiming_text' => null
                                ]
                            )
                        ],
                        'other_declarations' => [
                            0 => General::createFromArray(
                                [
                                    'horse_name' => 'KILCASCAN',
                                    'horse_uid' => 702076,
                                    'race_instance_uid' => 637256,
                                    'race_datetime' => 'Nov  9 2015 12:30PM',
                                    'course_name' => 'SOUTHWELL',
                                    'course_uid' => 61,
                                ]
                            ),
                            1 => General::createFromArray(
                                [
                                    'horse_name' => 'URBAN GALE',
                                    'horse_uid' => 722683,
                                    'race_instance_uid' => 637256,
                                    'race_datetime' => 'Nov  9 2015 12:30PM',
                                    'course_name' => 'SOUTHWELL',
                                    'course_uid' => 61,
                                ]
                            ),
                            2 => General::createFromArray(
                                [
                                    'horse_name' => 'MISSION COMPLETE',
                                    'horse_uid' => 775712,
                                    'race_instance_uid' => 637256,
                                    'race_datetime' => 'Nov  9 2015 12:30PM',
                                    'course_name' => 'SOUTHWELL',
                                    'course_uid' => 61,
                                ]
                            ),
                            3 => General::createFromArray(
                                [
                                    'horse_name' => 'CROSS TO BOSTON',
                                    'horse_uid' => 802408,
                                    'race_instance_uid' => 637256,
                                    'race_datetime' => 'Nov  9 2015 12:30PM',
                                    'course_name' => 'SOUTHWELL',
                                    'course_uid' => 61,
                                ]
                            ),
                            4 => General::createFromArray(
                                [
                                    'horse_name' => 'TYPICAL OSCAR',
                                    'horse_uid' => 830041,
                                    'race_instance_uid' => 637256,
                                    'race_datetime' => 'Nov  9 2015 12:30PM',
                                    'course_name' => 'SOUTHWELL',
                                    'course_uid' => 61,
                                ]
                            ),
                            5 => General::createFromArray(
                                [
                                    'horse_name' => 'DOUBLE DAN',
                                    'horse_uid' => 833116,
                                    'race_instance_uid' => 637256,
                                    'race_datetime' => 'Nov  9 2015 12:30PM',
                                    'course_name' => 'SOUTHWELL',
                                    'course_uid' => 61,
                                ]
                            ),
                            6 => General::createFromArray(
                                [
                                    'horse_name' => 'MOORLANDS GEORGE',
                                    'horse_uid' => 845929,
                                    'race_instance_uid' => 637256,
                                    'race_datetime' => 'Nov  9 2015 12:30PM',
                                    'course_name' => 'SOUTHWELL',
                                    'course_uid' => 61,
                                ]
                            ),
                            7 => General::createFromArray(
                                [
                                    'horse_name' => 'LEAGUE OF HIS OWN',
                                    'horse_uid' => 870322,
                                    'race_instance_uid' => 637256,
                                    'race_datetime' => 'Nov  9 2015 12:30PM',
                                    'course_name' => 'SOUTHWELL',
                                    'course_uid' => 61,
                                ]
                            ),
                        ],
                        'live_tab' => 'Y',
                        'claiming_race' => 'Y',
                        'selling_race' => 'N',
                        'plus10_race' => 'Y',
                        'weight_for_age' => null,
                    ]
                )
            ]
        ];
    }

    /**
     * @return array
     */
    public function providerTestGetTodaysTrainers()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\TodaysTrainers(
                    [],
                    []
                ),
                [
                    RaceInstance::createFromArray(
                        [
                            'trainer_name' => 'MICHAEL APPLEBY',
                            'style_name' => 'Michael Appleby',
                            'trainer_uid' => 10363,
                            'trainer_courses' => 'KM3 WO2',
                            'wins' => 1,
                            'places' => 4,
                            'runs' => 24,
                            'days_since_win_flat' => '13',
                            'rides_since_win_flat' => '16',
                            'days_since_win_jump' => '57',
                            'rides_since_win_jump' => '5',
                        ]
                    )
                ]
            ]
        ];
    }

    /**
     *
     * @dataProvider providerTestGetTodaysTrainers
     *
     * @param \Api\Input\Request\Horses\RaceCards\TodaysTrainers $request
     * @param array $expectedResult
     */
    public function testGetTodaysTrainers(
        \Api\Input\Request\Horses\RaceCards\TodaysTrainers $request,
        array $expectedResult
    ) {
        $raceCards = new RaceCards($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($raceCards->getTodaysTrainers($request))
        );
    }

    /**
     * @return array
     */
    public function providerTestGetTodaysJockeys()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\TodaysJockeys(
                    [],
                    []
                ),
                [
                    RaceInstance::createFromArray(
                        [
                            'jockey_type' => 0,
                            'style_name' => 'Leighton Aspell',
                            'jockey_uid' => 11611,
                            'jockey_low_wt_st' => 10,
                            'jockey_low_wt_lb' => 1,
                            'jockey_courses' => ' PL2',
                            'wins' => 19,
                            'runs' => 163,
                            'strike_rate' => 12,
                            'days_since_win' => '2',
                            'rides_since_win' => '5',
                        ]
                    )
                ]
            ]
        ];
    }

    /**
     *
     * @dataProvider providerTestGetTodaysJockeys
     *
     * @param \Api\Input\Request\Horses\RaceCards\TodaysJockeys $request
     * @param array $expectedResult
     */
    public function testGetTodaysJockeys(
        \Api\Input\Request\Horses\RaceCards\TodaysJockeys $request,
        array $expectedResult
    ) {
        $raceCards = new RaceCards($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($raceCards->getTodaysJockeys($request))
        );
    }

    /**
     *
     * @dataProvider providerTestGetPressChallenge
     *
     * @param $expectedResult
     * @param $request
     */
    public function testGetPressChallenge($request, $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($raceCards->getPressChallenge())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetPressChallenge()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\PressChallenge(
                    [],
                    [
                        'raceId' => 636281
                    ]
                ),
                [
                    \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_name' => 'Wot A Shot',
                            'horse_uid' => 789032,
                            'course_uid' => 41,
                            'course_name' => 'Perth',
                            "rp_abbrev_4" => "Hntg",
                            'owner_uid' => 243784,
                            'rp_owner_choice' => 'b',
                            'bet_return' => 91.569999999999993,
                            'newspaper' => 'DAILY MIRROR',
                            'tipster' => 'Newsboy',
                            'wins' => 1756,
                            'runs' => 6599,
                            'strike_rate' => 26,
                            'favs_tipped' => 47,
                            'nap_time' => ' 3.40',
                            'course' => 'PERT',
                            'nap_wins' => 60,
                            'nap_runs' => 228,
                            'profit_loss' => '-37.25',
                            'curr_seq' => '1W',
                            'month_wins' => 33,
                            'month_runs' => 113,
                            'month_profit_loss' => '+32.83',
                            'bank' => 443.67000000000002,
                        ]
                    ),
                    \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_name' => 'Ocean Ready',
                            'horse_uid' => 891153,
                            'course_uid' => 7,
                            'course_name' => 'Brighton',
                            "rp_abbrev_4" => "Hntg",
                            'owner_uid' => 243784,
                            'rp_owner_choice' => 'b',
                            'bet_return' => 90.909999999999997,
                            'newspaper' => 'THE TIMES',
                            'tipster' => 'Rob Wright',
                            'wins' => 1575,
                            'runs' => 6100,
                            'strike_rate' => 25,
                            'favs_tipped' => 45,
                            'nap_time' => ' 4.00',
                            'course' => 'BRIG',
                            'nap_wins' => 48,
                            'nap_runs' => 234,
                            'profit_loss' => '-�56.40',
                            'curr_seq' => '6L',
                            'month_wins' => 18,
                            'month_runs' => 104,
                            'month_profit_loss' => '-26.30',
                            'bank' => 445.80000000000001,
                        ]
                    ),
                ]
            ]
        ];
    }

    /**
     * @dataProvider providerTestRetrieveVerdict
     *
     * @param int $raceId
     * @param RaceInstance $expectedResult
     */
    public function testRetrieveVerdict($request, RaceInstance $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $this->assertEquals(
            $expectedResult,
            $raceCards->retrieveVerdict()
        );
    }

    /**
     * @return array
     */
    public function providerTestRetrieveVerdict()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 644232
                    ]
                ),
                RaceInstance::createFromArray(
                    [
                        'race_instance_uid' => 644232,
                        'race_datetime' => 'Mar 11 2016  6:45PM',
                        'rp_verdict' => 'This is not a strong race for the grade and \\bBERRAHRI\\p might be the ...',
                        'pre_race_instance_comments' => 'This is not a strong race for the grade and \\bBERRAHRI\\p...',
                        'key_stats_str' => "Joey Haynes (" . PHP_EOL
                            . "<b>Caledonia Laird</b>) is showing a profit of &pound;45.00 this season",
                        'horse_uid' => 834606,
                        'horse_style_name' => 'Caledonia Laird',
                        'course_uid' => 1083,
                        'course_country_code' => 'GB',
                        'course_style_name' => 'Chelmsford (A.W)',
                        'owner_uid' => 115568,
                        'rp_owner_choice' => 'a',
                        'saddle_cloth_no' => 1,
                        'non_runner' => 'N'
                    ]
                )
            ]
        ];
    }

    /**
     * @dataProvider providerTestRetrievePostPointerVerdict
     *
     * @param int $raceId
     * @param RaceInstance $expectedResult
     */
    public function testRetrievePostPointerVerdict($request, RaceInstance $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $this->assertEquals(
            $expectedResult,
            $raceCards->retrievePostPointerVerdict()
        );
    }

    /**
     * @return array
     */
    public function providerTestRetrievePostPointerVerdict()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 644232
                    ]
                ),
                RaceInstance::createFromArray(
                    [
                        'race_instance_uid' => 644232,
                        'race_datetime' => 'Mar 11 2016  6:45PM',
                        'rp_verdict' => 'This is not a strong race for the grade and \\bBERRAHRI\\p might be the ...',
                        'pre_race_instance_comments' => 'This is not a strong race for the grade and \\bBERRAHRI\\p...',
                        'key_stats_str' => "Joey Haynes (" . PHP_EOL
                            . "<b>Caledonia Laird</b>) is showing a profit of &pound;45.00 this season",
                        'horse_uid' => 834606,
                        'horse_style_name' => 'Caledonia Laird',
                        'course_uid' => 1083,
                        'course_country_code' => 'GB',
                        'course_style_name' => 'Chelmsford (A.W)',
                        'owner_uid' => 115568,
                        'rp_owner_choice' => 'a',
                        'saddle_cloth_no' => 1,
                        'non_runner' => 'N'
                    ]
                )
            ]
        ];
    }

    /**
     * @dataProvider providerTestGetSpotlightVerdictSelection
     *
     * @param $request
     * @param General $expectedResult
     */
    public function testGetSpotlightVerdictSelection($request, General $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $this->assertEquals(
            $expectedResult,
            $raceCards->getSpotlightVerdictSelection($request->getRaceId())
        );
    }

    /**
     * @return General
     */
    public function providerTestGetSpotlightVerdictSelection()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 902500
                    ]
                ),
                General::createFromArray(
                    [
                        'horse_uid' => 902500,
                        'selection_type_uid' => 1,
                        'horse_name' => "Sightline",
                        'saddle_cloth_no' => 2,
                        'non_runner' => 'N',
                        'owner_uid' => 9896,
                        'rp_owner_choice' => 'a'
                    ]
                )
            ]
        ];
    }

    /**
     * @dataProvider providerTestGetTopspeedSelection
     *
     * @param int $raceId
     * @param General $expectedResult
     */
    public function testGetTopspeedSelection($request, General $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $this->assertEquals(
            $expectedResult,
            $raceCards->getTopspeedSelection()
        );
    }

    /**
     * @return General
     */
    public function providerTestGetTopspeedSelection()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 902500
                    ]
                ),
                General::createFromArray(
                    [
                        'horse_uid' => 989986,
                        'selection_type_uid' => 1,
                        'horse_name' => "Dream Of Dreams"
                    ]
                )
            ]
        ];
    }

    /**
     * @dataProvider providerTestGetTipsterVerdicts
     *
     * @param int $raceId
     * @param array $expectedResult
     */
    public function testGetTipsterVerdicts($request, array $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $this->assertEquals(
            $expectedResult,
            $raceCards->getTipsterVerdicts()
        );
    }

    /**
     * @return array
     */
    public function providerTestGetTipsterVerdicts()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 647699
                    ]
                ),
                [
                    0 => \Api\Row\Horse::createFromArray(
                        [
                            'race_instance_uid' => 647699,
                            'verdict' => 'TEST VERDICT',
                            'newspaper_uid' => 84,
                            'newspaper_name' => 'The Edge',
                            'tipster_uid' => 158,
                            'tipster_name' => 'The Edge',
                            'expire_on' => 'Apr 27 2016 11:59PM',
                            'horse_uid' => 891460,
                            'horse_name' => 'RAAQY',
                            'course_uid' => 2,
                            'course_style_name' => 'Ascot',
                            'course_country_code' => 'GB',
                            'owner_uid' => 1859,
                            'selection_desc' => ' ',
                            'saddle_cloth_no' => 4,
                            'non_runner' => 'N',
                        ]
                    ),
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    public function providerTestGetPreRaceQuotes()
    {
        return [
            [
                644232,
                [
                    General::createFromArray(
                        [
                            'horse_uid' => 706954,
                            'horse_style_name' => 'Clockmaker',
                            'quotes' => "He ran a brilliant race behind Many Clouds at Kelso and ran well again at Carlisle. He just wants better ground so conditions should be ideal for him. It's a nice prize and definitely worth going for",
                            'key_quote_yn' => 'Y',
                            'expire_on' => 'Apr 11 2016  3:08PM',
                        ]
                    ),
                    General::createFromArray(
                        [
                            'horse_uid' => 809534,
                            'horse_style_name' => 'Boonga Roogeta',
                            'quotes' => null,
                            'key_quote_yn' => 'Y',
                            'expire_on' => 'Apr 11 2016  3:08PM',
                        ]
                    ),
                ]
            ]
        ];
    }

    /**
     * @dataProvider providerTestGetComments
     *
     * @param int $raceId
     * @param RaceInstance $expectedResult
     */
    public function testGetComments($request, RaceInstance $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($raceCards->getComments())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetComments()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 836648
                    ]
                ),
                RaceInstance::createFromArray(
                    [
                        General::createFromArray(
                            [
                                "horse_name" => "Al Guwair",
                                "horse_id" => 836648,
                                "spotlight" => "Prominent in market when in the frame in C&D maidens on first two...",
                                "race_datetime" => "Dec 17 2014 12:30PM",
                                "alt_silk_code" => null,
                                "saddle_cloth_no" => 6,
                                "diomed" => "Lightly raced but has plenty to prove and find relegated to a seller."
                            ]
                        ),
                        General::createFromArray(
                            [
                                "horse_name" => "Classic Colori",
                                "horse_id" => 735611,
                                "spotlight" => "Multiple Polytrack winner and good chance at the weights if he can...",
                                "race_datetime" => "Dec 17 2014 12:30PM",
                                "alt_silk_code" => null,
                                "saddle_cloth_no" => 1,
                                "diomed" => "May not have handled Fibresand last time but needs to bounce back with..."
                            ]
                        ),
                    ]
                )
            ]
        ];
    }

    /**
     * @param $request
     * @param $expectedResult object|null
     *
     * @dataProvider providerTestGetPostData
     */
    public function testGetPostData($request, $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $actualResult = $raceCards->getPostData();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestGetPostData()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 636281
                    ]
                ),
                (object)[
                    'runners' => [
                        791898 => General::createFromArray(
                            [
                                'horse_uid' => 791898,
                                'style_name' => 'Tradewinds',
                                'rp_postmark' => 129,
                                'num_topspeed_best_rating' => 123,
                                'official_rating' => 127,
                                'official_rating_today' => 127,
                                'trainer_form_output' => 'a',
                                'going_output' => 'aa',
                                'distance_output' => 'a',
                                'course_output' => '?',
                                'draw_output' => '-',
                                'ability_output' => 'aa',
                                'recent_form_output' => 'aa',
                                'race_status_code' => 'O',
                                'weight_carried_lbs' => 166,
                                'saddle_cloth_no' => 2,
                                'extra_weight_lbs' => 0,
                                'lh_weight_carried_lbs' => null,
                                'out_of_handicap' => null,
                                'trainer_record_output' => '-',
                                'jockey_no_wins_flag' => null,
                                'group_race' => null
                            ]
                        ),
                        803604 => General::createFromArray(
                            [
                                'horse_uid' => 803604,
                                'style_name' => 'Another Mattie',
                                'rp_postmark' => 130,
                                'num_topspeed_best_rating' => 124,
                                'official_rating' => 125,
                                'official_rating_today' => 125,
                                'trainer_form_output' => 'a',
                                'going_output' => 'aa',
                                'distance_output' => 'a',
                                'course_output' => 'a',
                                'draw_output' => '-',
                                'ability_output' => 'aa',
                                'recent_form_output' => 'aa',
                                'race_status_code' => 'O',
                                'weight_carried_lbs' => 164,
                                'saddle_cloth_no' => 7,
                                'extra_weight_lbs' => 0,
                                'lh_weight_carried_lbs' => null,
                                'out_of_handicap' => null,
                                'trainer_record_output' => '-',
                                'jockey_no_wins_flag' => null,
                                'group_race' => null
                            ]
                        ),
                        821670 => General::createFromArray(
                            [
                                'horse_uid' => 821670,
                                'style_name' => 'Caledonia',
                                'rp_postmark' => 128,
                                'num_topspeed_best_rating' => 85,
                                'official_rating' => 122,
                                'official_rating_today' => 122,
                                'trainer_form_output' => 'X',
                                'going_output' => 'aa',
                                'distance_output' => 'a',
                                'course_output' => 'a',
                                'draw_output' => '-',
                                'ability_output' => 'aa',
                                'recent_form_output' => 'aa',
                                'race_status_code' => 'O',
                                'weight_carried_lbs' => 161,
                                'saddle_cloth_no' => 8,
                                'extra_weight_lbs' => 0,
                                'lh_weight_carried_lbs' => null,
                                'out_of_handicap' => null,
                                'trainer_record_output' => '-',
                                'jockey_no_wins_flag' => null,
                                'group_race' => null
                            ]
                        ),
                        842206 => General::createFromArray(
                            [
                                'horse_uid' => 842206,
                                'style_name' => 'Roycano',
                                'rp_postmark' => 132,
                                'num_topspeed_best_rating' => 87,
                                'official_rating' => 127,
                                'official_rating_today' => 127,
                                'trainer_form_output' => 'a',
                                'going_output' => 'aa',
                                'distance_output' => 'a',
                                'course_output' => '?',
                                'draw_output' => '-',
                                'ability_output' => 'aa',
                                'recent_form_output' => 'aa',
                                'race_status_code' => 'O',
                                'weight_carried_lbs' => 166,
                                'saddle_cloth_no' => 3,
                                'extra_weight_lbs' => 0,
                                'lh_weight_carried_lbs' => null,
                                'out_of_handicap' => null,
                                'trainer_record_output' => '-',
                                'jockey_no_wins_flag' => null,
                                'group_race' => null
                            ]
                        ),
                        847738 => General::createFromArray(
                            [
                                'horse_uid' => 847738,
                                'style_name' => 'Sevenballs Of Fire',
                                'rp_postmark' => 126,
                                'num_topspeed_best_rating' => 99,
                                'official_rating' => 126,
                                'official_rating_today' => 126,
                                'trainer_form_output' => 'a',
                                'going_output' => 'aa',
                                'distance_output' => 'a',
                                'course_output' => 'a',
                                'draw_output' => '-',
                                'ability_output' => 'aa',
                                'recent_form_output' => 'aa',
                                'race_status_code' => 'O',
                                'weight_carried_lbs' => 165,
                                'saddle_cloth_no' => 5,
                                'extra_weight_lbs' => 0,
                                'lh_weight_carried_lbs' => null,
                                'out_of_handicap' => null,
                                'trainer_record_output' => '-',
                                'jockey_no_wins_flag' => null,
                                'group_race' => null
                            ]
                        ),
                        858402 => General::createFromArray(
                            [
                                'horse_uid' => 858402,
                                'style_name' => 'Birch Hill',
                                'rp_postmark' => 128,
                                'num_topspeed_best_rating' => 117,
                                'official_rating' => 126,
                                'official_rating_today' => 126,
                                'trainer_form_output' => 'a',
                                'going_output' => 'aa',
                                'distance_output' => 'a',
                                'course_output' => '?',
                                'draw_output' => '-',
                                'ability_output' => 'aa',
                                'recent_form_output' => 'aa',
                                'race_status_code' => 'O',
                                'weight_carried_lbs' => 165,
                                'saddle_cloth_no' => 4,
                                'extra_weight_lbs' => 0,
                                'lh_weight_carried_lbs' => null,
                                'out_of_handicap' => null,
                                'trainer_record_output' => '-',
                                'jockey_no_wins_flag' => null,
                                'group_race' => null
                            ]
                        ),
                        873811 => General::createFromArray(
                            [
                                'horse_uid' => 873811,
                                'style_name' => 'Timon\'s Tara',
                                'rp_postmark' => 130,
                                'num_topspeed_best_rating' => 100,
                                'official_rating' => 112,
                                'official_rating_today' => 112,
                                'trainer_form_output' => 'a',
                                'going_output' => 'aa',
                                'distance_output' => 'a',
                                'course_output' => '?',
                                'draw_output' => '-',
                                'ability_output' => 'aa',
                                'recent_form_output' => 'aa',
                                'race_status_code' => 'O',
                                'weight_carried_lbs' => 151,
                                'saddle_cloth_no' => 9,
                                'extra_weight_lbs' => 0,
                                'lh_weight_carried_lbs' => null,
                                'out_of_handicap' => null,
                                'trainer_record_output' => '-',
                                'jockey_no_wins_flag' => null,
                                'group_race' => null
                            ]
                        ),
                        882349 => General::createFromArray(
                            [
                                'horse_uid' => 882349,
                                'style_name' => 'Takingrisks',
                                'rp_postmark' => 127,
                                'num_topspeed_best_rating' => 111,
                                'official_rating' => 127,
                                'official_rating_today' => 127,
                                'trainer_form_output' => 'aa',
                                'going_output' => 'aa',
                                'distance_output' => 'a',
                                'course_output' => '?',
                                'draw_output' => '-',
                                'ability_output' => 'aa',
                                'recent_form_output' => 'aa',
                                'race_status_code' => 'O',
                                'weight_carried_lbs' => 166,
                                'saddle_cloth_no' => 1,
                                'extra_weight_lbs' => 0,
                                'lh_weight_carried_lbs' => null,
                                'out_of_handicap' => null,
                                'trainer_record_output' => '-',
                                'jockey_no_wins_flag' => null,
                                'group_race' => null
                            ]
                        ),
                        882980 => General::createFromArray(
                            [
                                'horse_uid' => 882980,
                                'style_name' => 'Gully\'s Edge',
                                'rp_postmark' => 130,
                                'num_topspeed_best_rating' => 49,
                                'official_rating' => 126,
                                'official_rating_today' => 126,
                                'trainer_form_output' => 'a',
                                'going_output' => 'aa',
                                'distance_output' => 'a',
                                'course_output' => '?',
                                'draw_output' => '-',
                                'ability_output' => 'aa',
                                'recent_form_output' => 'aa',
                                'race_status_code' => 'O',
                                'weight_carried_lbs' => 165,
                                'saddle_cloth_no' => 6,
                                'extra_weight_lbs' => 0,
                                'lh_weight_carried_lbs' => null,
                                'out_of_handicap' => null,
                                'trainer_record_output' => 'aa',
                                'jockey_no_wins_flag' => null,
                                'group_race' => null
                            ]
                        ),
                    ],
                    'postdata_selection' => General::createFromArray(
                        [
                            'style_name' => 'Muntazah',
                            'horse_uid' => 875013,
                            'selection_type_uid' => 1,
                        ]
                    ),
                    'race_details' => RaceInstance::createFromArray(
                        [
                            'race_type_code' => 'F',
                            'race_datetime' => 'Jun 25 2015  6:10PM',
                            'race_status_code' => 'O',
                            'race_group_code' => 'H',
                            'course_uid' => 22,
                            'rp_abbrev_3' => 'HAM',
                            'country_code' => 'GB',
                            'going_type_code' => 'G',
                            'distance_yard' => 2869,
                        ]
                    ),
                ],
            ],
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 636288
                    ]
                ),
                null
            ]
        ];
    }


    /**
     * @dataProvider providerTestGetSelections
     *
     * @param int $raceId
     * @param \stdClass $expectedResult
     */
    public function testGetSelections($request, \stdClass $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $this->assertEquals($expectedResult, $raceCards->getSelections(true));
    }

    /**
     * @return array
     */
    public function providerTestGetSelections()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 661043
                    ]
                ),
                (Object)[
                    'selections' => [
                        0 => \Api\Row\RaceCards\Selections::createFromArray(
                            [
                                'newspaper_name' => 'RP Ratings',
                                'newspaper_uid' => 2,
                                'sort_order' => 2,
                                'horse_name' => 'Harry Holland',
                                'horse_uid' => 933300,
                                'rp_owner_choice' => 'a',
                                'owner_uid' => 198826,
                                'selection_type' => 'NAP',
                                'selection_cnt' => 1,
                                'rp_postmark' => 74,
                                'country_origin_code' => 'GB',
                                'nap_today_count' => null,
                                'rpr_nap' => 0,
                                'going_output' => 'a',
                                'distance_output' => 'a',
                                'course_output' => 'a',
                                'draw_output' => 'a',
                                'ability_output' => 'aa',
                                'recent_form_output' => 'a',
                                'trainer_form_output' => 'aa',
                                'non_runner' => false,
                                'selection_type_uid' => 3
                            ]
                        ),
                        1 => \Api\Row\RaceCards\Selections::createFromArray(
                            [
                                'newspaper_name' => 'TOPSPEED',
                                'newspaper_uid' => 3,
                                'sort_order' => 3,
                                'horse_name' => 'City Of Angkor Wat',
                                'horse_uid' => 839201,
                                'rp_owner_choice' => 'a',
                                'owner_uid' => 160300,
                                'selection_type' => 'NAP',
                                'selection_cnt' => 1,
                                'rp_postmark' => 71,
                                'country_origin_code' => 'IRE',
                                'nap_today_count' => null,
                                'rpr_nap' => 0,
                                'going_output' => 'a',
                                'distance_output' => 'a',
                                'course_output' => 'a',
                                'draw_output' => 'a',
                                'ability_output' => 'aa',
                                'recent_form_output' => 'a',
                                'trainer_form_output' => 'aa',
                                'non_runner' => false,
                                'selection_type_uid' => 3
                            ]
                        ),
                        2 => \Api\Row\RaceCards\Selections::createFromArray(
                            [
                                'newspaper_name' => 'SPOTLIGHT',
                                'newspaper_uid' => 1,
                                'sort_order' => 1,
                                'horse_name' => 'Encapsulated',
                                'horse_uid' => 837207,
                                'rp_owner_choice' => 'a',
                                'owner_uid' => 34088,
                                'selection_type' => 'NB',
                                'selection_cnt' => 1,
                                'rp_postmark' => 73,
                                'country_origin_code' => 'GB',
                                'nap_today_count' => null,
                                'rpr_nap' => 0,
                                'going_output' => 'a',
                                'distance_output' => 'a',
                                'course_output' => 'aa',
                                'draw_output' => 'a',
                                'ability_output' => 'aa',
                                'recent_form_output' => 'aa',
                                'trainer_form_output' => 'aa',
                                'non_runner' => false,
                                'selection_type_uid' => 3
                            ]
                        ),
                    ],
                    'race_details' => RaceInstance::createFromArray(
                        [
                            'race_type_code' => 'C',
                            'race_datetime' => 'Nov  8 2016  2:50PM',
                            'race_status_code' => 'R',
                            'race_group_code' => 'H',
                            'course_uid' => 26,
                            'rp_abbrev_3' => 'HUN',
                            'country_code' => 'GB',
                            'going_type_code' => 'G',
                            'distance_yard' => 3624,
                            'course_name' => 'HUNTINGDON',
                            'course_uid1' => 26,
                            'course_style_name' => 'Huntingdon',
                            'going_type_code2' => 'G ',
                            'declared_runners' => 22,
                            'no_of_runners' => 22,
                            'going_type_desc' => 'Standard',
                            'rp_tv_text' => 'ATR',
                        ]
                    ),
                    'selections_count' => 3,
                    'selections_selection' => \Api\Row\RaceCards\Selections::createFromArray(
                        [
                            'newspaper_name' => 'RP Ratings',
                            'newspaper_uid' => 2,
                            'sort_order' => 2,
                            'horse_name' => 'Harry Holland',
                            'horse_uid' => 933300,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 198826,
                            'selection_type' => 'NAP',
                            'selection_cnt' => 1,
                            'rp_postmark' => 74,
                            'country_origin_code' => 'GB',
                            'nap_today_count' => null,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => 'a',
                            'course_output' => 'a',
                            'draw_output' => 'a',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'a',
                            'trainer_form_output' => 'aa',
                            'non_runner' => null,
                            'selection_type_uid' => 3
                        ]
                    ),
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\RaceCards\TopSelections $request
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetTopSelections
     */
    public function testGetTopSelections(
        \Api\Input\Request\Horses\RaceCards\TopSelections $request,
        array $expectedResult
    ) {
        $raceCards = new RaceCards($request);
        $this->assertEquals($expectedResult, $raceCards->getTopSelections($request));
    }

    /**
     * @return array
     */
    public function providerTestGetTopSelections()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\TopSelections(['2016-09-30']),
                [
                    \Api\Row\RaceCards\Selections::createFromArray(
                        [
                            'selection_cnt' => 14,
                            'course_uid' => 20,
                            'course_style_name' => 'Fontwell',
                            'horse_uid' => 884974,
                            'horse_style_name' => 'Frodon',
                            'horse_name' => 'FRODON',
                            'race_instance_uid' => 658389,
                            'race_instance_title' => 'Performance Foundations Management Appreciation Novices\' Chase',
                            'race_datetime' => 'Sep 30 2016  2:50PM',
                            'owner_uid' => 242945,
                            'owner_name' => 'P J VOGT &  IAN FOGG',
                            'owner_style_name' => 'P J Vogt &  Ian Fogg',
                            'rp_owner_choice' => 'a',
                            'trainer_uid' => 5767,
                            'trainer_name' => 'PAUL NICHOLLS',
                            'trainer_style_name' => 'Paul Nicholls',
                            'jockey_uid' => 88023,
                            'jockey_name' => 'SAM TWISTON-DAVIES',
                            'jockey_style_name' => 'Sam Twiston-Davies',
                        ]
                    )
                ]
            ]
        ];
    }

    /**
     * @dataProvider             providerExceptionRaceNotFound
     * @expectedException        \Api\Exception\NotFound
     * @expectedExceptionMessage Race instance not found
     *
     * @param int $raceId
     */
    public function testExceptionRaceNotFound($request)
    {
        $raceCards = new RaceCards($request);
        $raceCards->getOfficialRating();
    }

    /**
     * @return array
     */
    public function providerExceptionRaceNotFound()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 1
                    ]
                ),
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 23
                    ]
                )

            ]
        ];
    }

    /**
     * @dataProvider providerTestGetOfficialRating
     *
     * @param int $raceId
     * @param Object $expectedResult
     */
    public function testGetOfficialRating($request, $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $actual = $raceCards->getOfficialRating();
        $this->assertEquals($expectedResult, $actual);
    }

    /**
     * @return array
     */
    public function providerTestGetOfficialRating()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 632531
                    ]
                ),
                (Object)[
                    'race_details' => RaceInstance::createFromArray(
                        [
                            'race_type_code' => 'F',
                            'race_datetime' => 'Aug 26 2015  5:35PM',
                            'race_status_code' => 'O',
                            'race_group_code' => 'H',
                            'course_uid' => 5,
                            'rp_abbrev_3' => 'BAT',
                            'country_code' => 'GB',
                            'going_type_code' => 'GS',
                            'distance_yard' => 1261,
                        ]
                    ),
                    'runners' =>
                        [
                            855795 => General::createFromArray(
                                [
                                    'horse_uid' => 855795,
                                    'horse_name' => 'Secret Spirit',
                                    'weight_carried_lbs' => 130,
                                    'extra_weight' => null,
                                    'official_rating' => 72,
                                    'official_rating_today' => 72,
                                    'adjustment' => 7,
                                    'jockey_id' => 92728,
                                    'last_races' => [
                                        0 => General::createFromArray(
                                            [
                                                'race_instance_uid' => 631299,
                                                'race_datetime' => 'Aug  4 2015  2:30PM',
                                                'race_type_code' => 'F',
                                                'rp_postmark' => 81,
                                                'course_uid' => 52,
                                                'course_name' => 'SALISBURY',
                                                'course_style_name' => 'Salisbury',
                                                'course_country' => 'GB',
                                                'distance_yard' => 1320,
                                                'services_desc' => 'GF',
                                                'race_outcome_code' => '4',
                                                'rp_topspeed' => 49,
                                                'comment' => 'prominent, ridden over 2f out, kept on same pace approaching final furlong',
                                                'no_of_runners_calculated' => 9,
                                                'official_rating' => 72,
                                                'race_group_code' => 'H',
                                            ]
                                        ),
                                        1 => General::createFromArray(
                                            [
                                                'race_instance_uid' => 629394,
                                                'race_datetime' => 'Jul  9 2015  3:00PM',
                                                'race_type_code' => 'F',
                                                'rp_postmark' => 76,
                                                'course_uid' => 8,
                                                'course_name' => 'CARLISLE',
                                                'course_style_name' => 'Carlisle',
                                                'course_country' => 'GB',
                                                'distance_yard' => 1293,
                                                'services_desc' => 'Gd',
                                                'race_outcome_code' => '6',
                                                'rp_topspeed' => 35,
                                                'comment' => 'prominent, ridden 2f out, effort and headway over 1f out, no impression final furlong',
                                                'no_of_runners_calculated' => 9,
                                                'official_rating' => 74,
                                                'race_group_code' => 'H',
                                            ]
                                        ),
                                        2 => General::createFromArray(
                                            [
                                                'race_instance_uid' => 627340,
                                                'race_datetime' => 'Jun 13 2015  6:45PM',
                                                'race_type_code' => 'F',
                                                'rp_postmark' => 45,
                                                'course_uid' => 30,
                                                'course_name' => 'LEICESTER',
                                                'course_style_name' => 'Leicester',
                                                'course_country' => 'GB',
                                                'distance_yard' => 1320,
                                                'services_desc' => 'GS',
                                                'race_outcome_code' => '8',
                                                'rp_topspeed' => 3,
                                                'comment' => 'in touch in midfield, ridden and no response 2f out, weakened final furlong',
                                                'no_of_runners_calculated' => 10,
                                                'official_rating' => 75,
                                                'race_group_code' => 'H',
                                            ]
                                        ),
                                    ],
                                    'lifetime_high' => null,
                                    'lifetime_low' => null,
                                    'annual_high' => null,
                                    'annual_low' => null,
                                    'saddle_cloth_no' => 7,
                                    'lh_weight_carried_lbs' => null,
                                    'out_of_handicap' => null,
                                    'current_official_rating' => 0,
                                    'future_rating_difference' => -72

                                ]
                            ),
                            862903 => General::createFromArray(
                                [
                                    'horse_uid' => 862903,
                                    'horse_name' => 'Honcho',
                                    'weight_carried_lbs' => 124,
                                    'extra_weight' => null,
                                    'official_rating' => 66,
                                    'official_rating_today' => 66,
                                    'adjustment' => 13,
                                    'jockey_id' => 86013,
                                    'last_races' => [
                                        0 => General::createFromArray(
                                            [
                                                'race_instance_uid' => 631836,
                                                'race_datetime' => 'Aug 15 2015  2:15PM',
                                                'race_type_code' => 'F',
                                                'rp_postmark' => 47,
                                                'course_uid' => 174,
                                                'course_name' => 'NEWMARKET (JULY)',
                                                'course_style_name' => 'Newmarket',
                                                'course_country' => 'GB',
                                                'distance_yard' => 1320,
                                                'services_desc' => 'Gd',
                                                'race_outcome_code' => '12',
                                                'rp_topspeed' => 14,
                                                'comment' => 'chased leaders, ridden over 2f out, weakened over 1f out',
                                                'no_of_runners_calculated' => 15,
                                                'official_rating' => 68,
                                                'race_group_code' => 'H',
                                            ]
                                        ),
                                        1 => General::createFromArray(
                                            [
                                                'race_instance_uid' => 630856,
                                                'race_datetime' => 'Jul 31 2015  5:20PM',
                                                'race_type_code' => 'F',
                                                'rp_postmark' => 81,
                                                'course_uid' => 174,
                                                'course_name' => 'NEWMARKET (JULY)',
                                                'course_style_name' => 'Newmarket',
                                                'course_country' => 'GB',
                                                'distance_yard' => 1320,
                                                'services_desc' => 'Gd',
                                                'race_outcome_code' => '1',
                                                'rp_topspeed' => 55,
                                                'comment' => 'led far side pair over 3f, ridden to lead that pair again over 1f out, edged right, ran on to lead well inside final furlong, 1st of 2 that side',
                                                'no_of_runners_calculated' => 8,
                                                'official_rating' => 62,
                                                'race_group_code' => 'H',
                                            ]
                                        ),
                                        2 => General::createFromArray(
                                            [
                                                'race_instance_uid' => 629957,
                                                'race_datetime' => 'Jul 17 2015  7:50PM',
                                                'race_type_code' => 'F',
                                                'rp_postmark' => 68,
                                                'course_uid' => 174,
                                                'course_name' => 'NEWMARKET (JULY)',
                                                'course_style_name' => 'Newmarket',
                                                'course_country' => 'GB',
                                                'distance_yard' => 1320,
                                                'services_desc' => 'GF',
                                                'race_outcome_code' => '8',
                                                'rp_topspeed' => 39,
                                                'comment' => 'steadied start, took keen hold, held up in midfield, lost place and behind when ridden entering final 2f, no threat to leaders but kept on inside final furlong',
                                                'no_of_runners_calculated' => 10,
                                                'official_rating' => 65,
                                                'race_group_code' => 'H',
                                            ]
                                        ),
                                    ],
                                    'lifetime_high' => General::createFromArray(
                                        [
                                            'horse_uid' => 862903,
                                            'official_rating_ran_off' => 62,
                                            'race_type_code' => 'F',
                                            'course_uid' => 174,
                                            'course_name' => 'NEWMARKET (JULY)',
                                            'course_style_name' => 'Newmarket',
                                            'race_instance_uid' => 630856,
                                            'race_datetime' => 'Jul 31 2015  5:20PM',
                                            'race_instance_title' => 'Just Recruitment Group Handicap',
                                            'distance_yard' => 1320,
                                            'rp_close_up_comment' => 'led far side pair over 3f, ridden to lead that pair again over 1f out, edged right, ran on to lead well inside final furlong, 1st of 2 that side',
                                            'race_outcome_code' => '1',
                                            'services_desc' => 'Gd',
                                            'race_group_code' => 'H',
                                            'rp_postmark' => 47,
                                            'rp_topspeed' => 14,
                                            'no_runners' => 8,
                                        ]
                                    ),
                                    'lifetime_low' => General::createFromArray(
                                        [
                                            'horse_uid' => 862903,
                                            'official_rating_ran_off' => 62,
                                            'race_type_code' => 'F',
                                            'course_uid' => 174,
                                            'course_name' => 'NEWMARKET (JULY)',
                                            'course_style_name' => 'Newmarket',
                                            'race_instance_uid' => 630856,
                                            'race_datetime' => 'Jul 31 2015  5:20PM',
                                            'race_instance_title' => 'Just Recruitment Group Handicap',
                                            'distance_yard' => 1320,
                                            'rp_close_up_comment' => 'led far side pair over 3f, ridden to lead that pair again over 1f out, edged right, ran on to lead well inside final furlong, 1st of 2 that side',
                                            'race_outcome_code' => '1',
                                            'services_desc' => 'Gd',
                                            'race_group_code' => 'H',
                                            'rp_postmark' => 47,
                                            'rp_topspeed' => 14,
                                            'no_runners' => 8,
                                        ]
                                    ),
                                    'annual_high' => General::createFromArray(
                                        [
                                            'horse_uid' => 862903,
                                            'official_rating_ran_off' => 62,
                                            'race_type_code' => 'F',
                                            'course_uid' => 174,
                                            'course_name' => 'NEWMARKET (JULY)',
                                            'course_style_name' => 'Newmarket',
                                            'race_instance_uid' => 630856,
                                            'race_datetime' => 'Jul 31 2015  5:20PM',
                                            'race_instance_title' => 'Just Recruitment Group Handicap',
                                            'distance_yard' => 1320,
                                            'rp_close_up_comment' => 'led far side pair over 3f, ridden to lead that pair again over 1f out, edged right, ran on to lead well inside final furlong, 1st of 2 that side',
                                            'race_outcome_code' => '1',
                                            'services_desc' => 'Gd',
                                            'race_group_code' => 'H',
                                            'rp_postmark' => 47,
                                            'rp_topspeed' => 14,
                                            'no_runners' => 8,
                                        ]
                                    ),
                                    'annual_low' => General::createFromArray(
                                        [
                                            'horse_uid' => 862903,
                                            'official_rating_ran_off' => 62,
                                            'race_type_code' => 'F',
                                            'course_uid' => 174,
                                            'course_name' => 'NEWMARKET (JULY)',
                                            'course_style_name' => 'Newmarket',
                                            'race_instance_uid' => 630856,
                                            'race_datetime' => 'Jul 31 2015  5:20PM',
                                            'race_instance_title' => 'Just Recruitment Group Handicap',
                                            'distance_yard' => 1320,
                                            'rp_close_up_comment' => 'led far side pair over 3f, ridden to lead that pair again over 1f out, edged right, ran on to lead well inside final furlong, 1st of 2 that side',
                                            'race_outcome_code' => '1',
                                            'services_desc' => 'Gd',
                                            'race_group_code' => 'H',
                                            'rp_postmark' => 47,
                                            'rp_topspeed' => 14,
                                            'no_runners' => 8,
                                        ]
                                    ),
                                    'saddle_cloth_no' => 8,
                                    'lh_weight_carried_lbs' => null,
                                    'out_of_handicap' => null,
                                    'current_official_rating' => 0,
                                    'future_rating_difference' => -66
                                ]
                            ),
                            737133 => General::createFromArray(
                                [
                                    'horse_uid' => 737133,
                                    'horse_name' => 'Valmina',
                                    'weight_carried_lbs' => 117,
                                    'extra_weight' => null,
                                    'official_rating' => 56,
                                    'official_rating_today' => 57,
                                    'adjustment' => 23,
                                    'jockey_id' => 93947,
                                    'last_races' => [
                                        0 => General::createFromArray(
                                            [
                                                'race_instance_uid' => 632032,
                                                'race_datetime' => 'Aug 13 2015  7:00PM',
                                                'race_type_code' => 'F',
                                                'rp_postmark' => 83,
                                                'course_uid' => 1212,
                                                'course_name' => 'FFOS LAS',
                                                'course_style_name' => 'Ffos Las',
                                                'course_country' => 'GB',
                                                'distance_yard' => 1100,
                                                'services_desc' => 'Gd',
                                                'race_outcome_code' => '1',
                                                'rp_topspeed' => 58,
                                                'comment' => 'soon outpaced, headway halfway, ridden to lead well inside final furlong, ran on',
                                                'no_of_runners_calculated' => 6,
                                                'official_rating' => 55,
                                                'race_group_code' => 'H',
                                            ]
                                        ),
                                        1 => General::createFromArray(
                                            [
                                                'race_instance_uid' => 629325,
                                                'race_datetime' => 'Jul  6 2015  5:55PM',
                                                'race_type_code' => 'F',
                                                'rp_postmark' => 75,
                                                'course_uid' => 93,
                                                'course_name' => 'WINDSOR',
                                                'course_style_name' => 'Windsor',
                                                'course_country' => 'GB',
                                                'distance_yard' => 1320,
                                                'services_desc' => 'GF',
                                                'race_outcome_code' => '10',
                                                'rp_topspeed' => 38,
                                                'comment' => 'steadied after start, held up towards rear, no chance when ridden over 1f out, never involved',
                                                'no_of_runners_calculated' => 15,
                                                'official_rating' => 58,
                                                'race_group_code' => 'H',
                                            ]
                                        ),
                                        2 => General::createFromArray(
                                            [
                                                'race_instance_uid' => 628439,
                                                'race_datetime' => 'Jun 25 2015  9:00PM',
                                                'race_type_code' => 'F',
                                                'rp_postmark' => 68,
                                                'course_uid' => 36,
                                                'course_name' => 'NEWBURY',
                                                'course_style_name' => 'Newbury',
                                                'course_country' => 'GB',
                                                'distance_yard' => 1134,
                                                'services_desc' => 'GF',
                                                'race_outcome_code' => '9',
                                                'rp_topspeed' => 33,
                                                'comment' => 'steadied start from wide draw, held up in last pair and off the pace, ridden and no progress over 1f out',
                                                'no_of_runners_calculated' => 9,
                                                'official_rating' => 60,
                                                'race_group_code' => 'H',
                                            ]
                                        ),
                                    ],
                                    'lifetime_high' => General::createFromArray(
                                        [
                                            'horse_uid' => 737133,
                                            'official_rating_ran_off' => 73,
                                            'race_type_code' => 'F',
                                            'course_uid' => 5,
                                            'course_name' => 'BATH',
                                            'course_style_name' => 'Bath',
                                            'race_instance_uid' => 556406,
                                            'race_datetime' => 'Jun 16 2012  3:15PM',
                                            'race_instance_title' => 'Brandon Trust Fast Furlong Handicap',
                                            'distance_yard' => 1261,
                                            'rp_close_up_comment' => 'reluctant to enter stalls, slowly into stride, in rear, headway 2f out, strong run to dispute lead final 120yds, kept on well to force dead-heat',
                                            'race_outcome_code' => '1',
                                            'services_desc' => 'Gd',
                                            'race_group_code' => 'H',
                                            'rp_postmark' => 47,
                                            'rp_topspeed' => 14,
                                            'no_runners' => 13,
                                        ]
                                    ),
                                    'lifetime_low' => General::createFromArray(
                                        [
                                            'horse_uid' => 737133,
                                            'official_rating_ran_off' => 55,
                                            'race_type_code' => 'F',
                                            'course_uid' => 1212,
                                            'course_name' => 'FFOS LAS',
                                            'course_style_name' => 'Ffos Las',
                                            'race_instance_uid' => 632032,
                                            'race_datetime' => 'Aug 13 2015  7:00PM',
                                            'race_instance_title' => 'Pembrey Handicap',
                                            'distance_yard' => 1100,
                                            'rp_close_up_comment' => 'soon outpaced, headway halfway, ridden to lead well inside final furlong, ran on',
                                            'race_outcome_code' => '1',
                                            'services_desc' => 'Gd',
                                            'race_group_code' => 'H',
                                            'rp_postmark' => 47,
                                            'rp_topspeed' => 14,
                                            'no_runners' => 6,
                                        ]
                                    ),
                                    'annual_high' => General::createFromArray(
                                        [
                                            'horse_uid' => 737133,
                                            'official_rating_ran_off' => 55,
                                            'race_type_code' => 'F',
                                            'course_uid' => 1212,
                                            'course_name' => 'FFOS LAS',
                                            'course_style_name' => 'Ffos Las',
                                            'race_instance_uid' => 632032,
                                            'race_datetime' => 'Aug 13 2015  7:00PM',
                                            'race_instance_title' => 'Pembrey Handicap',
                                            'distance_yard' => 1100,
                                            'rp_close_up_comment' => 'soon outpaced, headway halfway, ridden to lead well inside final furlong, ran on',
                                            'race_outcome_code' => '1',
                                            'services_desc' => 'Gd',
                                            'race_group_code' => 'H',
                                            'rp_postmark' => 47,
                                            'rp_topspeed' => 14,
                                            'no_runners' => 6,
                                        ]
                                    ),
                                    'annual_low' => General::createFromArray(
                                        [
                                            'horse_uid' => 737133,
                                            'official_rating_ran_off' => 55,
                                            'race_type_code' => 'F',
                                            'course_uid' => 1212,
                                            'course_name' => 'FFOS LAS',
                                            'course_style_name' => 'Ffos Las',
                                            'race_instance_uid' => 632032,
                                            'race_datetime' => 'Aug 13 2015  7:00PM',
                                            'race_instance_title' => 'Pembrey Handicap',
                                            'distance_yard' => 1100,
                                            'rp_close_up_comment' => 'soon outpaced, headway halfway, ridden to lead well inside final furlong, ran on',
                                            'race_outcome_code' => '1',
                                            'services_desc' => 'Gd',
                                            'race_group_code' => 'H',
                                            'rp_postmark' => 47,
                                            'rp_topspeed' => 14,
                                            'no_runners' => 6,
                                        ]
                                    ),
                                    'saddle_cloth_no' => 9,
                                    'lh_weight_carried_lbs' => 116,
                                    'out_of_handicap' => 1,
                                    'current_official_rating' => 0,
                                    'future_rating_difference' => -57
                                ]
                            ),
                        ],
                ]
            ]

        ];
    }

    /**
     *
     * @dataProvider providerTestGetStats
     *
     * @param int $raceId
     * @param array $expectedResult
     */
    public function testGetStats($request, array $expectedResult)
    {
        $raceCards = new RaceCards($request);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($raceCards->getStats())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetStats()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 614973
                    ]
                ),
                [
                    'trainer' => [
                        '5372' => \Api\Row\RaceCards\Stats::createFromArray(
                            [
                                'trainer_uid' => 5372,
                                'trainer_name' => 'Ann Duffield',
                                'overall' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'trainer_uid' => 5372,
                                        'wins' => 5,
                                        'runs' => 97,
                                        'profit' => -56.5,
                                        'wins_2yo' => 2,
                                        'runs_2yo' => 51,
                                        'profit_2yo' => '-31.00000000000000',
                                        'wins_3yo' => 2,
                                        'runs_3yo' => 41,
                                        'profit_3yo' => '-24.50000000000000',
                                        'wins_4yo' => 1,
                                        'runs_4yo' => 5,
                                        'profit_4yo' => '-1.00000000000000',
                                    ]
                                ),
                                'last_14_days' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'trainer_uid' => 5372,
                                        'wins' => 0,
                                        'runs' => 7,
                                        'profit' => -7,
                                    ]
                                ),
                                '2yo' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 2,
                                        'runs' => 51,
                                        'profit' => '-31.00000000000000',
                                    ]
                                ),
                                '3yo' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 2,
                                        'runs' => 41,
                                        'profit' => '-24.50000000000000',
                                    ]
                                ),
                                '4yo' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 1,
                                        'runs' => 5,
                                        'profit' => '-1.00000000000000',
                                    ]
                                ),
                            ]
                        ),
                        '67' => \Api\Row\RaceCards\Stats::createFromArray(
                            [
                                'trainer_uid' => 67,
                                'trainer_name' => 'Sir Mark Prescott Bt',
                                'overall' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'trainer_uid' => 67,
                                        'wins' => 5,
                                        'runs' => 21,
                                        'profit' => 3.0750000000000002,
                                        'wins_2yo' => 2,
                                        'runs_2yo' => 8,
                                        'profit_2yo' => '-2.92500000000000',
                                        'wins_3yo' => 3,
                                        'runs_3yo' => 11,
                                        'profit_3yo' => '8.00000000000000',
                                        'wins_4yo' => 0,
                                        'runs_4yo' => 2,
                                        'profit_4yo' => '-2.00000000000000',
                                    ]
                                ),
                                'last_14_days' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'trainer_uid' => 67,
                                        'wins' => 1,
                                        'runs' => 18,
                                        'profit' => -15,
                                    ]
                                ),
                                '2yo' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 2,
                                        'runs' => 8,
                                        'profit' => '-2.92500000000000',
                                    ]
                                ),
                                '3yo' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 3,
                                        'runs' => 11,
                                        'profit' => '8.00000000000000',
                                    ]
                                ),
                                '4yo' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 0,
                                        'runs' => 2,
                                        'profit' => '-2.00000000000000',
                                    ]
                                ),
                            ]
                        )
                    ],
                    'jockey' => [
                        '76872' => \Api\Row\RaceCards\Stats::createFromArray(
                            [
                                'jockey_uid' => 76872,
                                'jockey_name' => 'P J McDonald',
                                'overall' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'jockey_uid' => 76872,
                                        'wins' => 15,
                                        'runs' => 194,
                                        'profit' => -72.900000000000006,
                                        'wins_2yo' => 2,
                                        'runs_2yo' => 50,
                                        'profit_2yo' => '-36.90000000000000',
                                        'wins_3yo' => 4,
                                        'runs_3yo' => 56,
                                        'profit_3yo' => '-25.50000000000000',
                                        'wins_4yo' => 9,
                                        'runs_4yo' => 88,
                                        'profit_4yo' => '-10.50000000000000',
                                    ]
                                ),
                                'last_14_days' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'jockey_uid' => 76872,
                                        'wins' => 0,
                                        'runs' => 3,
                                        'profit' => -3,
                                    ]
                                ),
                                '2yo' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 2,
                                        'runs' => 50,
                                        'profit' => '-36.90000000000000',
                                    ]
                                ),
                                '3yo' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 4,
                                        'runs' => 56,
                                        'profit' => '-25.50000000000000',
                                    ]
                                ),
                                '4yo' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 9,
                                        'runs' => 88,
                                        'profit' => '-10.50000000000000',
                                    ]
                                ),
                            ]
                        ),
                        '84857' => \Api\Row\RaceCards\Stats::createFromArray(
                            [
                                'jockey_uid' => 84857,
                                'jockey_name' => 'Luke Morris',
                                'overall' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'jockey_uid' => 84857,
                                        'wins' => 7,
                                        'runs' => 58,
                                        'profit' => -17.5,
                                        'wins_2yo' => 2,
                                        'runs_2yo' => 14,
                                        'profit_2yo' => '-8.37500000000000',
                                        'wins_3yo' => 4,
                                        'runs_3yo' => 32,
                                        'profit_3yo' => '-10.12500000000000',
                                        'wins_4yo' => 1,
                                        'runs_4yo' => 12,
                                        'profit_4yo' => '1.00000000000000',
                                    ]
                                ),
                                'last_14_days' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'jockey_uid' => 84857,
                                        'wins' => 5,
                                        'runs' => 61,
                                        'profit' => -42.875,
                                    ]
                                ),
                                '2yo' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 2,
                                        'runs' => 14,
                                        'profit' => '-8.37500000000000',
                                    ]
                                ),
                                '3yo' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 4,
                                        'runs' => 32,
                                        'profit' => '-10.12500000000000',
                                    ]
                                ),
                                '4yo' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 1,
                                        'runs' => 12,
                                        'profit' => '1.00000000000000',
                                    ]
                                ),
                            ]
                        )
                    ],
                    'horse' => [
                        '436302' => \Api\Row\RaceCards\Stats::createFromArray(
                            [
                                'horse_uid' => 436302,
                                'horse_name' => 'Southern Seas',
                                'country_origin_code' => 'GB',
                                'going' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 0,
                                        'runs' => 0,
                                        'profit' => 0,
                                    ]
                                ),
                                'distance' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'horse_uid' => 436302,
                                        'runs' => 1,
                                        'wins' => 0,
                                    ]
                                ),
                                'course' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'horse_uid' => 436302,
                                        'runs' => 1,
                                        'wins' => 0,
                                    ]
                                ),
                            ]
                        ),
                        '874973' => \Api\Row\RaceCards\Stats::createFromArray(
                            [
                                'horse_uid' => 874973,
                                'horse_name' => 'Cartwright',
                                'country_origin_code' => 'GB',
                                'going' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 0,
                                        'runs' => 0,
                                        'profit' => 0,
                                    ]
                                ),
                                'distance' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 0,
                                        'runs' => 0,
                                        'profit' => 0,
                                    ]
                                ),
                                'course' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 0,
                                        'runs' => 0,
                                        'profit' => 0,
                                    ]
                                ),
                            ]
                        )
                    ]
                ]
            ],
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 614944
                    ]
                ),
                [
                    'trainer' => [
                        '35' => \Api\Row\RaceCards\Stats::createFromArray(
                            [
                                'trainer_uid' => 35,
                                'trainer_name' => 'J R Jenkins',
                                'overall' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'trainer_uid' => 35,
                                        'wins' => 0,
                                        'runs' => 5,
                                        'profit' => -5,
                                        'wins_chase' => 0,
                                        'runs_chase' => 0,
                                        'profit_chase' => '0.00000000000000',
                                        'wins_hurdle' => 0,
                                        'runs_hurdle' => 5,
                                        'profit_hurdle' => '-5.00000000000000',
                                        'wins_nhf' => 0,
                                        'runs_nhf' => 0,
                                        'profit_nhf' => '0.00000000000000',
                                    ]
                                ),
                                'last_14_days' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'trainer_uid' => 35,
                                        'wins' => 0,
                                        'runs' => 3,
                                        'profit' => -3,
                                    ]
                                ),
                                'chase' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 0,
                                        'runs' => 0,
                                        'profit' => '0.00000000000000',
                                    ]
                                ),
                                'hurdle' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 0,
                                        'runs' => 5,
                                        'profit' => '-5.00000000000000',
                                    ]
                                ),
                                'nhf' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 0,
                                        'runs' => 0,
                                        'profit' => '0.00000000000000',
                                    ]
                                ),
                            ]
                        ),
                        '135' => \Api\Row\RaceCards\Stats::createFromArray(
                            [
                                'trainer_uid' => 135,
                                'trainer_name' => 'Philip Hobbs',
                                'overall' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'trainer_uid' => 135,
                                        'wins' => 11,
                                        'runs' => 90,
                                        'profit' => -37.911999999999999,
                                        'wins_chase' => 6,
                                        'runs_chase' => 36,
                                        'profit_chase' => '4.44600000000000',
                                        'wins_hurdle' => 5,
                                        'runs_hurdle' => 46,
                                        'profit_hurdle' => '-34.35800000000000',
                                        'wins_nhf' => 0,
                                        'runs_nhf' => 8,
                                        'profit_nhf' => '-8.00000000000000',
                                    ]
                                ),
                                'last_14_days' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'trainer_uid' => 135,
                                        'wins' => 8,
                                        'runs' => 29,
                                        'profit' => 0.76600000000000001,
                                    ]
                                ),
                                'chase' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 6,
                                        'runs' => 36,
                                        'profit' => '4.44600000000000',
                                    ]
                                ),
                                'hurdle' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 5,
                                        'runs' => 46,
                                        'profit' => '-34.35800000000000',
                                    ]
                                ),
                                'nhf' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 0,
                                        'runs' => 8,
                                        'profit' => '-8.00000000000000',
                                    ]
                                ),
                            ]
                        )
                    ],
                    'jockey' => [
                        '12290' => \Api\Row\RaceCards\Stats::createFromArray(
                            [
                                'jockey_uid' => 12290,
                                'jockey_name' => 'Richard Johnson',
                                'overall' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'jockey_uid' => 12290,
                                        'wins' => 19,
                                        'runs' => 104,
                                        'profit' => -18.670000000000002,
                                        'wins_chase' => 7,
                                        'runs_chase' => 46,
                                        'profit_chase' => '-13.34600000000000',
                                        'wins_hurdle' => 12,
                                        'runs_hurdle' => 54,
                                        'profit_hurdle' => '-1.32400000000000',
                                        'wins_nhf' => 0,
                                        'runs_nhf' => 4,
                                        'profit_nhf' => '-4.00000000000000',
                                    ]
                                ),
                                'last_14_days' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'jockey_uid' => 12290,
                                        'wins' => 20,
                                        'runs' => 63,
                                        'profit' => 10.6289999999999996,
                                    ]
                                ),
                                'chase' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 7,
                                        'runs' => 46,
                                        'profit' => '-13.34600000000000',
                                    ]
                                ),
                                'hurdle' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 12,
                                        'runs' => 54,
                                        'profit' => '-1.32400000000000',
                                    ]
                                ),
                                'nhf' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 0,
                                        'runs' => 4,
                                        'profit' => '-4.00000000000000',
                                    ]
                                ),
                            ]
                        ),
                        '14447' => \Api\Row\RaceCards\Stats::createFromArray(
                            [
                                'jockey_uid' => 14447,
                                'jockey_name' => 'Barry Geraghty',
                                'overall' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'jockey_uid' => 14447,
                                        'wins' => 40,
                                        'runs' => 133,
                                        'profit' => 17.75,
                                        'wins_chase' => 13,
                                        'runs_chase' => 52,
                                        'profit_chase' => '-9.98600000000000',
                                        'wins_hurdle' => 21,
                                        'runs_hurdle' => 72,
                                        'profit_hurdle' => '14.88800000000000',
                                        'wins_nhf' => 6,
                                        'runs_nhf' => 9,
                                        'profit_nhf' => '12.84800000000000',
                                    ]
                                ),
                                'last_14_days' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'jockey_uid' => 14447,
                                        'wins' => 4,
                                        'runs' => 36,
                                        'profit' => -22.091000000000001,
                                    ]
                                ),
                                'chase' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 13,
                                        'runs' => 52,
                                        'profit' => '-9.98600000000000',
                                    ]
                                ),
                                'hurdle' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 21,
                                        'runs' => 72,
                                        'profit' => '14.88800000000000',
                                    ]
                                ),
                                'nhf' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'wins' => 6,
                                        'runs' => 9,
                                        'profit' => '12.84800000000000',
                                    ]
                                ),
                            ]
                        )
                    ],
                    'horse' => [
                        '836091' => \Api\Row\RaceCards\Stats::createFromArray(
                            [
                                'horse_uid' => 836091,
                                'horse_name' => 'Top Set',
                                'country_origin_code' => 'GB',
                                'going' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'horse_uid' => 836091,
                                        'runs' => 2,
                                        'wins' => 0,
                                    ]
                                ),
                                'distance' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'horse_uid' => 836091,
                                        'runs' => 2,
                                        'wins' => 0,
                                    ]
                                ),
                                'course' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'horse_uid' => 836091,
                                        'runs' => 1,
                                        'wins' => 0,
                                    ]
                                ),
                            ]
                        ),
                        '872816' => \Api\Row\RaceCards\Stats::createFromArray(
                            [
                                'horse_uid' => 872816,
                                'horse_name' => 'Lettheriverrundry',
                                'country_origin_code' => 'GB',
                                'going' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'horse_uid' => 872816,
                                        'runs' => 2,
                                        'wins' => 0,
                                    ]
                                ),
                                'distance' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'horse_uid' => 872816,
                                        'runs' => 3,
                                        'wins' => 1,
                                    ]
                                ),
                                'course' => \Api\Row\RaceCards\Stats::createFromArray(
                                    [
                                        'horse_uid' => 872816,
                                        'runs' => 0,
                                        'wins' => 0,
                                    ]
                                ),
                            ]
                        )
                    ],
                ]
            ],

        ];
    }


    /**
     * @dataProvider providerTestGetUpcoming
     *
     * @param \Api\Input\Request\Horses\RaceCards\Upcoming $request
     * @param array $expectedResult
     */
    public function testGetUpcoming(\Api\Input\Request\Horses\RaceCards\Upcoming $request, $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($raceCards->getUpcomingRaces($request))
        );
    }

    /**
     * @return array
     */
    public function providerTestGetUpcoming()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Upcoming([3]),
                [
                    0 => RaceInstance::createFromArray(
                        [
                            'course_uid' => 93,
                            'course_name' => 'WINDSOR',
                            'race_instance_uid' => 634885,
                            'race_datetime' => 'Oct  5 2015  1:50PM',
                        ]
                    ),
                    1 => RaceInstance::createFromArray(
                        [
                            'course_uid' => 46,
                            'course_name' => 'PONTEFRACT',
                            'race_instance_uid' => 634878,
                            'race_datetime' => 'Oct  5 2015  2:00PM',
                        ]
                    ),
                    2 => RaceInstance::createFromArray(
                        [
                            'course_uid' => 35,
                            'course_name' => 'MARKET RASEN',
                            'race_instance_uid' => 634992,
                            'race_datetime' => 'Oct  5 2015  2:10PM',
                        ]
                    )
                ]
            ]
        ];
    }

    /**
     * @param string $raceDate
     * @param bool $isFullList
     * @param array $mapValues
     * @param Meeting[] $expectedResult
     *
     * @dataProvider providerTestGetList
     */
    public function testGetList($raceDate, $isFullList, array $mapValues, array $expectedResult)
    {
        $raceCards = $this->getMockBuilder(RaceCards::class)
            ->setMethods(['getDateTime'])
            ->disableOriginalConstructor()
            ->getMock();
        $raceCards->expects($this->any())->method('getDateTime')->willReturnMap($mapValues);

        $this->assertEquals(
            $expectedResult,
            $raceCards->getList($raceDate, $isFullList)
        );
    }

    /**
     * @return array
     */
    public function providerTestGetList()
    {
        return [
            [
                '2017-02-17',
                false,
                [
                    ['now', new \DateTime('2017-11-27 17:30:00')],
                    [RaceCards::DATE_TIME_TOMORROW, new \DateTime('2017-11-28 17:30:00')],
                    [RaceCards::DATE_TIME_TODAY_READINESS, new \DateTime('2017-11-27 18:30:00')],
                    [RaceCards::DATE_TIME_FOR_BOXING_INTERVAL, new \DateTime('2017-12-26')],
                    [RaceCards::DATE_TIME_BOXING_DATE_START, new \DateTime('2017-12-23 6:30PM')],
                    [RaceCards::DATE_TIME_BOXING_DATE_END, new \DateTime('2017-12-25 6:30PM')],
                ],
                [
                    18 => Meeting::createFromArray(
                        [
                            'meeting_type' => 'jumps',
                            'course_uid' => 18,
                            'rp_meeting_order' => null,
                            'mixed_course_uid' => null,
                            'course_name' => 'FAKENHAM',
                            'course_style_name' => 'Fakenham',
                            'rp_abbrev_3' => 'FAK',
                            'country_code' => 'GB',
                            'course_type_code' => 'P',
                            'race_date' => '2017-02-17',
                            'has_finished_race' => 0,
                            'abandoned' => 0,
                            'going_desc' => null,
                            'stalls_position' => null,
                            'pre_going_desc' => 'GOOD TO SOFT',
                            'pre_weather_desc' => '(Partly cloudy)',
                            'foreign' => 0,
                            'meeting_number' => 3,
                            'digital_colour' => 3,
                            'digital_order' => null,
                            'rails' => null,
                            'aw_surface_type' => null,
                            'races' => [
                                0 => RaceInstance::createFromArray(
                                    [
                                        'course_uid' => 18,
                                        'replaced_aw' => null,
                                        'race_instance_uid' => 667651,
                                        'race_datetime' => 'Feb 17 2017  1:30PM',
                                        'race_instance_title' => 'Racing To School Riders',
                                        'race_type_code' => 'H',
                                        'distance_yard' => 3523,
                                        'rp_ages_allowed_desc' => '4yo+',
                                        'race_status_code' => 'O',
                                        'mnemonic' => 'FAK',
                                        'rp_abbrev_3' => 'FAK',
                                        'race_selection_type' => null,
                                        'satelite_tv_txt' => 'ATR',
                                        'terrestrial_tv_txt' => ' ',
                                        'count_runners' => 8,
                                        'declared_runners' => 8,
                                        'no_of_runners' => 8,
                                        'spotlight_tipped_horse_name' => 'Akula',
                                        'country_code' => 'GB',
                                        'local_meeting_race_datetime' => 'Feb 17 2017  1:30PM',
                                        'hours_difference' => 0,
                                        'is_fast_result' => 0,
                                        'race_class' => '5',
                                        'is_worldwide_stake' => 0,
                                        'is_scoop6_race' => 0,
                                        'surface' => 'Turf',
                                        'early_closing_race_yn' => null,
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => null,
                                        'prize' => 3898.8000000000002,
                                        'straight_round_jubilee_code' => null,
                                        'duplicate_race' => 'N',
                                        'rp_confirmed' => null,
                                        'official_rating_band_desc' => '0-100',
                                        'short_day_desc' => null,
                                        'free_to_air_yn' => 'n',
                                    ]
                                ),
                                1 => RaceInstance::createFromArray(
                                    [
                                        'course_uid' => 18,
                                        'replaced_aw' => null,
                                        'race_instance_uid' => 667649,
                                        'race_datetime' => 'Feb 17 2017  2:00PM',
                                        'race_instance_title' => 'Your Cheltenham Guide At attheraces.com',
                                        'race_type_code' => 'C',
                                        'distance_yard' => 4664,
                                        'rp_ages_allowed_desc' => '5yo+',
                                        'race_status_code' => 'O',
                                        'mnemonic' => 'FAK',
                                        'rp_abbrev_3' => 'FAK',
                                        'race_selection_type' => null,
                                        'satelite_tv_txt' => 'ATR',
                                        'terrestrial_tv_txt' => ' ',
                                        'count_runners' => 5,
                                        'declared_runners' => 5,
                                        'no_of_runners' => 5,
                                        'spotlight_tipped_horse_name' => 'Omessa Has',
                                        'country_code' => 'GB',
                                        'local_meeting_race_datetime' => 'Feb 17 2017  2:00PM',
                                        'hours_difference' => 0,
                                        'is_fast_result' => 0,
                                        'race_class' => '4',
                                        'is_worldwide_stake' => 0,
                                        'is_scoop6_race' => 0,
                                        'surface' => 'Turf',
                                        'early_closing_race_yn' => null,
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => null,
                                        'prize' => 5198.3999999999996,
                                        'straight_round_jubilee_code' => null,
                                        'duplicate_race' => 'N',
                                        'rp_confirmed' => null,
                                        'official_rating_band_desc' => null,
                                        'short_day_desc' => null,
                                        'free_to_air_yn' => 'n',
                                    ]
                                ),
                                2 => RaceInstance::createFromArray(
                                    [
                                        'course_uid' => 18,
                                        'replaced_aw' => null,
                                        'race_instance_uid' => 667648,
                                        'race_datetime' => 'Feb 17 2017  2:30PM',
                                        'race_instance_title' => 'Fakenham EBF "National Hunt" Novices\' (Qualifier)',
                                        'race_type_code' => 'H',
                                        'distance_yard' => 4401,
                                        'rp_ages_allowed_desc' => '4-7yo',
                                        'race_status_code' => 'O',
                                        'mnemonic' => 'FAK',
                                        'rp_abbrev_3' => 'FAK',
                                        'race_selection_type' => null,
                                        'satelite_tv_txt' => 'ATR',
                                        'terrestrial_tv_txt' => ' ',
                                        'count_runners' => 6,
                                        'declared_runners' => 6,
                                        'no_of_runners' => 6,
                                        'spotlight_tipped_horse_name' => 'Stowaway Magic',
                                        'country_code' => 'GB',
                                        'local_meeting_race_datetime' => 'Feb 17 2017  2:30PM',
                                        'hours_difference' => 0,
                                        'is_fast_result' => 0,
                                        'race_class' => '3',
                                        'is_worldwide_stake' => 0,
                                        'is_scoop6_race' => 0,
                                        'surface' => 'Turf',
                                        'early_closing_race_yn' => null,
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => null,
                                        'prize' => 6498,
                                        'straight_round_jubilee_code' => null,
                                        'duplicate_race' => 'N',
                                        'rp_confirmed' => null,
                                        'official_rating_band_desc' => null,
                                        'short_day_desc' => null,
                                        'free_to_air_yn' => 'n',
                                    ]
                                ),
                                3 => RaceInstance::createFromArray(
                                    [
                                        'course_uid' => 18,
                                        'replaced_aw' => null,
                                        'race_instance_uid' => 667647,
                                        'race_datetime' => 'Feb 17 2017  3:00PM',
                                        'race_instance_title' => 'Tim Barclay Memorial Handicap Chase',
                                        'race_type_code' => 'C',
                                        'distance_yard' => 4664,
                                        'rp_ages_allowed_desc' => '5yo+',
                                        'race_status_code' => 'O',
                                        'mnemonic' => 'FAK',
                                        'rp_abbrev_3' => 'FAK',
                                        'race_selection_type' => null,
                                        'satelite_tv_txt' => 'ATR',
                                        'terrestrial_tv_txt' => ' ',
                                        'count_runners' => 6,
                                        'declared_runners' => 6,
                                        'no_of_runners' => 6,
                                        'spotlight_tipped_horse_name' => 'A Tail Of Intrigue',
                                        'country_code' => 'GB',
                                        'local_meeting_race_datetime' => 'Feb 17 2017  3:00PM',
                                        'hours_difference' => 0,
                                        'is_fast_result' => 0,
                                        'race_class' => '3',
                                        'is_worldwide_stake' => 0,
                                        'is_scoop6_race' => 0,
                                        'surface' => 'Turf',
                                        'early_closing_race_yn' => null,
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => null,
                                        'prize' => 7797.6000000000004,
                                        'straight_round_jubilee_code' => null,
                                        'duplicate_race' => 'N',
                                        'rp_confirmed' => null,
                                        'official_rating_band_desc' => '0-125',
                                        'short_day_desc' => null,
                                        'free_to_air_yn' => 'n',
                                    ]
                                ),
                                4 => RaceInstance::createFromArray(
                                    [
                                        'course_uid' => 18,
                                        'replaced_aw' => null,
                                        'race_instance_uid' => 667650,
                                        'race_datetime' => 'Feb 17 2017  3:35PM',
                                        'race_instance_title' => 'Download The At The Races App Novices\' Handicap',
                                        'race_type_code' => 'H',
                                        'distance_yard' => 5155,
                                        'rp_ages_allowed_desc' => '4yo+',
                                        'race_status_code' => 'O',
                                        'mnemonic' => 'FAK',
                                        'rp_abbrev_3' => 'FAK',
                                        'race_selection_type' => null,
                                        'satelite_tv_txt' => 'ATR',
                                        'terrestrial_tv_txt' => ' ',
                                        'count_runners' => 8,
                                        'declared_runners' => 8,
                                        'no_of_runners' => 8,
                                        'spotlight_tipped_horse_name' => 'Barney From Tyanee',
                                        'country_code' => 'GB',
                                        'local_meeting_race_datetime' => 'Feb 17 2017  3:35PM',
                                        'hours_difference' => 0,
                                        'is_fast_result' => 0,
                                        'race_class' => '4',
                                        'is_worldwide_stake' => 0,
                                        'is_scoop6_race' => 0,
                                        'surface' => 'Turf',
                                        'early_closing_race_yn' => null,
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => null,
                                        'prize' => 4548.6000000000004,
                                        'straight_round_jubilee_code' => null,
                                        'duplicate_race' => 'N',
                                        'rp_confirmed' => null,
                                        'official_rating_band_desc' => '0-115',
                                        'short_day_desc' => null,
                                        'free_to_air_yn' => 'y',
                                    ]
                                ),
                            ],
                            'cards_order' => 1,
                            'course_race_type_code' => 'C',
                            'max_prize' => 7797.6000000000004,
                            'course_straight_round_jubilee_code' => null,
                            'complete_card' => false,
                            'early_complete_card' => true,
                            'totalPrizeMoney' => 0,
                            'eveningMeeting' => -1,
                            'racesItv' => 0,
                            'containsNotFinishedRaces' => -1,
                            'rp_position' => 1,
                            'raceGroups' => [],
                            'raceClasses' => ['3', '3', '4', '4', '5']
                        ]
                    ),
                    181 => Meeting::createFromArray(
                        [
                            'meeting_type' => 'jumps',
                            'course_uid' => 181,
                            'rp_meeting_order' => 1,
                            'mixed_course_uid' => null,
                            'course_name' => 'FAKENHAM',
                            'course_style_name' => 'Fakenham',
                            'rp_abbrev_3' => 'FAK',
                            'country_code' => 'GB',
                            'course_type_code' => 'J',
                            'race_date' => '2017-02-17',
                            'has_finished_race' => 0,
                            'abandoned' => 0,
                            'going_desc' => null,
                            'stalls_position' => null,
                            'pre_going_desc' => 'GOOD TO SOFT',
                            'pre_weather_desc' => '(Partly cloudy)',
                            'foreign' => 0,
                            'meeting_number' => 3,
                            'digital_colour' => 3,
                            'digital_order' => null,
                            'rails' => null,
                            'aw_surface_type' => null,
                            'races' => [
                                0 => RaceInstance::createFromArray(
                                    [
                                        'course_uid' => 181,
                                        'replaced_aw' => null,
                                        'race_instance_uid' => 667651,
                                        'race_datetime' => 'Feb 17 2017  1:30PM',
                                        'race_instance_title' => 'Download The At The Races App Novices\' Handicap',
                                        'race_type_code' => 'H',
                                        'distance_yard' => 5155,
                                        'rp_ages_allowed_desc' => '4yo+',
                                        'race_status_code' => 'O',
                                        'mnemonic' => 'FAK',
                                        'rp_abbrev_3' => 'FAK',
                                        'race_selection_type' => null,
                                        'satelite_tv_txt' => 'ATR',
                                        'terrestrial_tv_txt' => ' ',
                                        'count_runners' => 8,
                                        'declared_runners' => 8,
                                        'no_of_runners' => 8,
                                        'spotlight_tipped_horse_name' => 'Barney From Tyanee',
                                        'country_code' => 'GB',
                                        'local_meeting_race_datetime' => 'Feb 17 2017  3:35PM',
                                        'hours_difference' => 0,
                                        'is_fast_result' => 0,
                                        'race_class' => '4',
                                        'is_worldwide_stake' => 0,
                                        'is_scoop6_race' => 0,
                                        'surface' => 'Turf',
                                        'early_closing_race_yn' => null,
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => null,
                                        'prize' => 4548.6000000000004,
                                        'straight_round_jubilee_code' => null,
                                        'duplicate_race' => 'N',
                                        'rp_confirmed' => null,
                                        'official_rating_band_desc' => '0-115',
                                        'short_day_desc' => null,
                                        'free_to_air_yn' => 'y',
                                    ]
                                )
                            ],
                            'cards_order' => 2,
                            'course_race_type_code' => 'H',
                            'max_prize' => 4548.6,
                            'course_straight_round_jubilee_code' => null,
                            'complete_card' => false,
                            'early_complete_card' => true,
                            'totalPrizeMoney' => 0,
                            'eveningMeeting' => -1,
                            'racesItv' => 0,
                            'containsNotFinishedRaces' => -1,
                            'rp_position' => 1,
                            'raceGroups' => [],
                            'raceClasses' => ['4']
                        ]
                    )
                ],
            ],
            [
                '2017-02-17',
                true,
                [
                    ['now', new \DateTime('2017-11-27 17:30:00')],
                    [RaceCards::DATE_TIME_TOMORROW, new \DateTime('2017-11-28 17:30:00')],
                    [RaceCards::DATE_TIME_TODAY_READINESS, new \DateTime('2017-11-27 18:30:00')],
                    [RaceCards::DATE_TIME_FOR_BOXING_INTERVAL, new \DateTime('2017-12-26')],
                    [RaceCards::DATE_TIME_BOXING_DATE_START, new \DateTime('2017-12-23 6:30PM')],
                    [RaceCards::DATE_TIME_BOXING_DATE_END, new \DateTime('2017-12-25 6:30PM')],
                ],
                [
                    19 => Meeting::createFromArray(
                        [
                            'meeting_type' => 'jumps',
                            'course_uid' => 19,
                            'rp_meeting_order' => 1,
                            'mixed_course_uid' => null,
                            'course_name' => 'FAKENHAM',
                            'course_style_name' => 'Fakenham',
                            'rp_abbrev_3' => 'FAK',
                            'country_code' => 'GB',
                            'course_type_code' => 'J',
                            'race_date' => '2017-02-17',
                            'has_finished_race' => 0,
                            'abandoned' => 0,
                            'going_desc' => null,
                            'stalls_position' => null,
                            'pre_going_desc' => 'GOOD TO SOFT',
                            'pre_weather_desc' => '(Partly cloudy)',
                            'foreign' => 0,
                            'meeting_number' => 3,
                            'digital_colour' => 3,
                            'digital_order' => null,
                            'rails' => null,
                            'aw_surface_type' => null,
                            'races' => [
                                0 => RaceInstance::createFromArray(
                                    [
                                        'course_uid' => 19,
                                        'replaced_aw' => null,
                                        'race_instance_uid' => 667651,
                                        'race_datetime' => 'Feb 17 2017  1:30PM',
                                        'race_instance_title' => 'Racing To School Riders',
                                        'race_type_code' => 'H',
                                        'distance_yard' => 3523,
                                        'rp_ages_allowed_desc' => '4yo+',
                                        'race_status_code' => 'O',
                                        'mnemonic' => 'FAK',
                                        'rp_abbrev_3' => 'FAK',
                                        'race_selection_type' => null,
                                        'satelite_tv_txt' => 'ATR',
                                        'terrestrial_tv_txt' => ' ',
                                        'count_runners' => 8,
                                        'declared_runners' => 8,
                                        'no_of_runners' => 8,
                                        'spotlight_tipped_horse_name' => 'Akula',
                                        'country_code' => 'GB',
                                        'local_meeting_race_datetime' => 'Feb 17 2017  1:30PM',
                                        'hours_difference' => 0,
                                        'is_fast_result' => 0,
                                        'race_class' => '5',
                                        'is_worldwide_stake' => 0,
                                        'is_scoop6_race' => 0,
                                        'surface' => 'Turf',
                                        'early_closing_race_yn' => null,
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => null,
                                        'prize' => 3898.8000000000002,
                                        'straight_round_jubilee_code' => null,
                                        'duplicate_race' => 'N',
                                        'rp_confirmed' => null,
                                        'official_rating_band_desc' => '0-100',
                                        'short_day_desc' => null,
                                        'free_to_air_yn' => 'n',
                                    ]
                                ),
                                1 => RaceInstance::createFromArray(
                                    [
                                        'course_uid' => 19,
                                        'replaced_aw' => null,
                                        'race_instance_uid' => 667649,
                                        'race_datetime' => 'Feb 17 2017  2:00PM',
                                        'race_instance_title' => 'Your Cheltenham Guide At attheraces.com',
                                        'race_type_code' => 'C',
                                        'distance_yard' => 4664,
                                        'rp_ages_allowed_desc' => '5yo+',
                                        'race_status_code' => 'O',
                                        'mnemonic' => 'FAK',
                                        'rp_abbrev_3' => 'FAK',
                                        'race_selection_type' => null,
                                        'satelite_tv_txt' => 'ATR',
                                        'terrestrial_tv_txt' => ' ',
                                        'count_runners' => 5,
                                        'declared_runners' => 5,
                                        'no_of_runners' => 5,
                                        'spotlight_tipped_horse_name' => 'Omessa Has',
                                        'country_code' => 'GB',
                                        'local_meeting_race_datetime' => 'Feb 17 2017  2:00PM',
                                        'hours_difference' => 0,
                                        'is_fast_result' => 0,
                                        'race_class' => '4',
                                        'is_worldwide_stake' => 0,
                                        'is_scoop6_race' => 0,
                                        'surface' => 'Turf',
                                        'early_closing_race_yn' => null,
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => null,
                                        'prize' => 5198.3999999999996,
                                        'straight_round_jubilee_code' => null,
                                        'duplicate_race' => 'N',
                                        'rp_confirmed' => null,
                                        'official_rating_band_desc' => null,
                                        'short_day_desc' => null,
                                        'free_to_air_yn' => 'n',
                                    ]
                                )
                            ],
                            'cards_order' => 1,
                            'course_race_type_code' => 'C',
                            'max_prize' => 5198.3999999999996,
                            'course_straight_round_jubilee_code' => null,
                            'complete_card' => false,
                            'early_complete_card' => true,
                            'totalPrizeMoney' => 0,
                            'eveningMeeting' => -1,
                            'racesItv' => 0,
                            'containsNotFinishedRaces' => -1,
                            'rp_position' => 1,
                            'raceGroups' => [],
                            'raceClasses' => ['4', '5']
                        ]
                    ),
                ],
            ],
            [
                '2017-12-26',
                false,
                [
                    ['now', new \DateTime('2017-11-27 17:30:00')],
                    [RaceCards::DATE_TIME_TOMORROW, new \DateTime('2017-11-28 17:30:00')],
                    [RaceCards::DATE_TIME_TODAY_READINESS, new \DateTime('2017-11-27 18:30:00')],
                    [RaceCards::DATE_TIME_FOR_BOXING_INTERVAL, new \DateTime('2017-12-26')],
                    [RaceCards::DATE_TIME_BOXING_DATE_START, new \DateTime('2017-12-23 6:30PM')],
                    [RaceCards::DATE_TIME_BOXING_DATE_END, new \DateTime('2017-12-25 6:30PM')],
                ],
                [
                    19 => Meeting::createFromArray(
                        [
                            'meeting_type' => 'jumps',
                            'course_uid' => 19,
                            'rp_meeting_order' => 1,
                            'mixed_course_uid' => null,
                            'course_name' => 'FAKENHAM',
                            'course_style_name' => 'Fakenham',
                            'rp_abbrev_3' => 'FAK',
                            'country_code' => 'GB',
                            'course_type_code' => 'J',
                            'race_date' => '2017-12-26',
                            'has_finished_race' => 0,
                            'abandoned' => 0,
                            'going_desc' => null,
                            'stalls_position' => null,
                            'pre_going_desc' => 'GOOD TO SOFT',
                            'pre_weather_desc' => '(Partly cloudy)',
                            'foreign' => 0,
                            'meeting_number' => 3,
                            'digital_colour' => 3,
                            'digital_order' => null,
                            'rails' => null,
                            'aw_surface_type' => null,
                            'races' => [
                                0 => RaceInstance::createFromArray(
                                    [
                                        'course_uid' => 19,
                                        'replaced_aw' => null,
                                        'race_instance_uid' => 667651,
                                        'race_datetime' => 'Dec 26 2017  1:30PM',
                                        'race_instance_title' => 'Racing To School Riders',
                                        'race_type_code' => 'H',
                                        'distance_yard' => 3523,
                                        'rp_ages_allowed_desc' => '4yo+',
                                        'race_status_code' => 'O',
                                        'mnemonic' => 'FAK',
                                        'rp_abbrev_3' => 'FAK',
                                        'race_selection_type' => null,
                                        'satelite_tv_txt' => 'ATR',
                                        'terrestrial_tv_txt' => ' ',
                                        'count_runners' => 8,
                                        'declared_runners' => 8,
                                        'no_of_runners' => 8,
                                        'spotlight_tipped_horse_name' => 'Akula',
                                        'country_code' => 'GB',
                                        'local_meeting_race_datetime' => 'Dec 26 2017  1:30PM',
                                        'hours_difference' => 0,
                                        'is_fast_result' => 0,
                                        'race_class' => '5',
                                        'is_worldwide_stake' => 0,
                                        'is_scoop6_race' => 0,
                                        'surface' => 'Turf',
                                        'early_closing_race_yn' => null,
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => null,
                                        'prize' => 3898.8000000000002,
                                        'straight_round_jubilee_code' => null,
                                        'duplicate_race' => 'N',
                                        'rp_confirmed' => null,
                                        'official_rating_band_desc' => '0-100',
                                        'short_day_desc' => null,
                                        'free_to_air_yn' => 'n',
                                    ]
                                ),
                                1 => RaceInstance::createFromArray(
                                    [
                                        'course_uid' => 19,
                                        'replaced_aw' => null,
                                        'race_instance_uid' => 667649,
                                        'race_datetime' => 'Dec 26 2017  2:00PM',
                                        'race_instance_title' => 'Your Cheltenham Guide At attheraces.com',
                                        'race_type_code' => 'C',
                                        'distance_yard' => 4664,
                                        'rp_ages_allowed_desc' => '5yo+',
                                        'race_status_code' => 'O',
                                        'mnemonic' => 'FAK',
                                        'rp_abbrev_3' => 'FAK',
                                        'race_selection_type' => null,
                                        'satelite_tv_txt' => 'ATR',
                                        'terrestrial_tv_txt' => ' ',
                                        'count_runners' => 5,
                                        'declared_runners' => 5,
                                        'no_of_runners' => 5,
                                        'spotlight_tipped_horse_name' => 'Omessa Has',
                                        'country_code' => 'GB',
                                        'local_meeting_race_datetime' => 'Dec 26 2017  2:00PM',
                                        'hours_difference' => 0,
                                        'is_fast_result' => 0,
                                        'race_class' => '4',
                                        'is_worldwide_stake' => 0,
                                        'is_scoop6_race' => 0,
                                        'surface' => 'Turf',
                                        'early_closing_race_yn' => null,
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => null,
                                        'prize' => 5198.3999999999996,
                                        'straight_round_jubilee_code' => null,
                                        'duplicate_race' => 'N',
                                        'rp_confirmed' => null,
                                        'official_rating_band_desc' => null,
                                        'short_day_desc' => null,
                                        'free_to_air_yn' => 'n',
                                    ]
                                )
                            ],
                            'cards_order' => 1,
                            'course_race_type_code' => 'C',
                            'max_prize' => 5198.3999999999996,
                            'course_straight_round_jubilee_code' => null,
                            'complete_card' => false,
                            'early_complete_card' => true,
                            'totalPrizeMoney' => 0,
                            'eveningMeeting' => -1,
                            'racesItv' => 0,
                            'containsNotFinishedRaces' => -1,
                            'rp_position' => 1,
                            'raceGroups' => [],
                            'raceClasses' => ['4', '5']
                        ]
                    ),
                ],
            ],
            [
                '2017-12-26',
                false,
                [
                    ['now', new \DateTime('2017-12-24 17:30:00')],
                    [RaceCards::DATE_TIME_TOMORROW, new \DateTime('2017-12-25 17:30:00')],
                    [RaceCards::DATE_TIME_TODAY_READINESS, new \DateTime('2017-12-24 18:30:00')],
                    [RaceCards::DATE_TIME_FOR_BOXING_INTERVAL, new \DateTime('2017-12-26')],
                    [RaceCards::DATE_TIME_BOXING_DATE_START, new \DateTime('2017-12-23 6:30PM')],
                    [RaceCards::DATE_TIME_BOXING_DATE_END, new \DateTime('2017-12-25 6:30PM')],
                ],
                [
                    19 => Meeting::createFromArray(
                        [
                            'meeting_type' => 'jumps',
                            'course_uid' => 19,
                            'rp_meeting_order' => 1,
                            'mixed_course_uid' => null,
                            'course_name' => 'FAKENHAM',
                            'course_style_name' => 'Fakenham',
                            'rp_abbrev_3' => 'FAK',
                            'country_code' => 'GB',
                            'course_type_code' => 'J',
                            'race_date' => '2017-12-26',
                            'has_finished_race' => 0,
                            'abandoned' => 0,
                            'going_desc' => null,
                            'stalls_position' => null,
                            'pre_going_desc' => 'GOOD TO SOFT',
                            'pre_weather_desc' => '(Partly cloudy)',
                            'foreign' => 0,
                            'meeting_number' => 3,
                            'digital_colour' => 3,
                            'digital_order' => null,
                            'rails' => null,
                            'aw_surface_type' => null,
                            'races' => [
                                0 => RaceInstance::createFromArray(
                                    [
                                        'course_uid' => 19,
                                        'replaced_aw' => null,
                                        'race_instance_uid' => 667651,
                                        'race_datetime' => 'Dec 26 2017  1:30PM',
                                        'race_instance_title' => 'Racing To School Riders',
                                        'race_type_code' => 'H',
                                        'distance_yard' => 3523,
                                        'rp_ages_allowed_desc' => '4yo+',
                                        'race_status_code' => 'O',
                                        'mnemonic' => 'FAK',
                                        'rp_abbrev_3' => 'FAK',
                                        'race_selection_type' => null,
                                        'satelite_tv_txt' => 'ATR',
                                        'terrestrial_tv_txt' => ' ',
                                        'count_runners' => 8,
                                        'declared_runners' => 8,
                                        'no_of_runners' => 8,
                                        'spotlight_tipped_horse_name' => 'Akula',
                                        'country_code' => 'GB',
                                        'local_meeting_race_datetime' => 'Dec 26 2017  1:30PM',
                                        'hours_difference' => 0,
                                        'is_fast_result' => 0,
                                        'race_class' => '5',
                                        'is_worldwide_stake' => 0,
                                        'is_scoop6_race' => 0,
                                        'surface' => 'Turf',
                                        'early_closing_race_yn' => null,
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => null,
                                        'prize' => 3898.8000000000002,
                                        'straight_round_jubilee_code' => null,
                                        'duplicate_race' => 'N',
                                        'rp_confirmed' => null,
                                        'official_rating_band_desc' => '0-100',
                                        'short_day_desc' => null,
                                        'free_to_air_yn' => 'n',
                                    ]
                                ),
                                1 => RaceInstance::createFromArray(
                                    [
                                        'course_uid' => 19,
                                        'replaced_aw' => null,
                                        'race_instance_uid' => 667649,
                                        'race_datetime' => 'Dec 26 2017  2:00PM',
                                        'race_instance_title' => 'Your Cheltenham Guide At attheraces.com',
                                        'race_type_code' => 'C',
                                        'distance_yard' => 4664,
                                        'rp_ages_allowed_desc' => '5yo+',
                                        'race_status_code' => 'O',
                                        'mnemonic' => 'FAK',
                                        'rp_abbrev_3' => 'FAK',
                                        'race_selection_type' => null,
                                        'satelite_tv_txt' => 'ATR',
                                        'terrestrial_tv_txt' => ' ',
                                        'count_runners' => 5,
                                        'declared_runners' => 5,
                                        'no_of_runners' => 5,
                                        'spotlight_tipped_horse_name' => 'Omessa Has',
                                        'country_code' => 'GB',
                                        'local_meeting_race_datetime' => 'Dec 26 2017  2:00PM',
                                        'hours_difference' => 0,
                                        'is_fast_result' => 0,
                                        'race_class' => '4',
                                        'is_worldwide_stake' => 0,
                                        'is_scoop6_race' => 0,
                                        'surface' => 'Turf',
                                        'early_closing_race_yn' => null,
                                        'perform_race_uid_atr' => null,
                                        'perform_race_uid_ruk' => null,
                                        'prize' => 5198.3999999999996,
                                        'straight_round_jubilee_code' => null,
                                        'duplicate_race' => 'N',
                                        'rp_confirmed' => null,
                                        'official_rating_band_desc' => null,
                                        'short_day_desc' => null,
                                        'free_to_air_yn' => 'n',
                                    ]
                                )
                            ],
                            'cards_order' => 1,
                            'course_race_type_code' => 'C',
                            'max_prize' => 5198.3999999999996,
                            'course_straight_round_jubilee_code' => null,
                            'complete_card' => true,
                            'early_complete_card' => true,
                            'totalPrizeMoney' => 0,
                            'eveningMeeting' => -1,
                            'racesItv' => 0,
                            'containsNotFinishedRaces' => -1,
                            'rp_position' => 1,
                            'raceGroups' => [],
                            'raceClasses' => ['4', '5']
                        ]
                    ),
                ],
            ],
        ];
    }


    /**
     * @dataProvider providerTestGetRunnersIndex
     */
    public function testGetRunnersIndex($request, $raceDate, $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $this->assertEquals(
            $expectedResult,
            $raceCards->getRunnersIndex($raceDate)
        );
    }

    /**
     * @return array
     */
    public function providerTestGetRunnersIndex()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 612436
                    ]
                ),
                '2014-11-05',
                (Object)[
                    'runners' => [
                        0 => General::createFromArray(
                            [
                                'style_name' => 'Aaranyow',
                                'runners_index_outcome' => '6th',
                                'odds_desc' => '25/1',
                                'course_uid' => 40,
                                'rp_abbrev_3' => 'NOT',
                                'course_name' => 'NOTTINGHAM',
                                'course_style_name' => 'Nottingham',
                                'jockey_uid' => 86607,
                                'jockey_style_name' => 'Toby Atkinson',
                                'owner_uid' => 146768,
                                'owner_style_name' => 'Prima Racing Partnership',
                                'race_datetime' => 'Nov  5 2014  2:50PM',
                                'race_instance_uid' => 612436,
                                'race_status_code' => 'R',
                                'ten_to_follow' => null,
                                'horse_uid' => 783142,
                            ]
                        ),
                        1 => General::createFromArray(
                            [
                                'style_name' => 'Abrahams Blessing',
                                'runners_index_outcome' => '13th',
                                'odds_desc' => '16/1',
                                'course_uid' => 1138,
                                'rp_abbrev_3' => 'DUN',
                                'course_name' => 'DUNDALK (A.W)',
                                'course_style_name' => 'Dundalk (A.W)',
                                'jockey_uid' => 82458,
                                'jockey_style_name' => 'Rory Cleary',
                                'owner_uid' => 193585,
                                'owner_style_name' => 'Gerard Mulligan',
                                'race_datetime' => 'Nov  5 2014  9:15PM',
                                'race_instance_uid' => 613583,
                                'race_status_code' => 'R',
                                'ten_to_follow' => null,
                                'horse_uid' => 785235,
                            ]
                        ),
                        2 => General::createFromArray(
                            [
                                'style_name' => 'Acapulco Bay',
                                'runners_index_outcome' => '4th',
                                'odds_desc' => '10/1',
                                'course_uid' => 12,
                                'rp_abbrev_3' => 'CHP',
                                'course_name' => 'CHEPSTOW',
                                'course_style_name' => 'Chepstow',
                                'jockey_uid' => 89721,
                                'jockey_style_name' => 'Robert Williams',
                                'owner_uid' => 127065,
                                'owner_style_name' => 'J Parfitt',
                                'race_datetime' => 'Nov  5 2014  3:15PM',
                                'race_instance_uid' => 612466,
                                'race_status_code' => 'R',
                                'ten_to_follow' => null,
                                'horse_uid' => 664838,
                            ]
                        ),
                        3 => General::createFromArray(
                            [
                                'style_name' => 'Affectionate Lady',
                                'runners_index_outcome' => '10th',
                                'odds_desc' => '16/1',
                                'course_uid' => 1138,
                                'rp_abbrev_3' => 'DUN',
                                'course_name' => 'DUNDALK (A.W)',
                                'course_style_name' => 'Dundalk (A.W)',
                                'jockey_uid' => 89571,
                                'jockey_style_name' => 'Leigh Roche',
                                'owner_uid' => 172722,
                                'owner_style_name' => 'Mrs Amanda McCreery',
                                'race_datetime' => 'Nov  5 2014  8:45PM',
                                'race_instance_uid' => 613582,
                                'race_status_code' => 'R',
                                'ten_to_follow' => null,
                                'horse_uid' => 863039,
                            ]
                        ),
                        4 => General::createFromArray(
                            [
                                'style_name' => 'Affinia Fifty',
                                'runners_index_outcome' => '11th',
                                'odds_desc' => '16/1',
                                'course_uid' => 1138,
                                'rp_abbrev_3' => 'DUN',
                                'course_name' => 'DUNDALK (A.W)',
                                'course_style_name' => 'Dundalk (A.W)',
                                'jockey_uid' => 3572,
                                'jockey_style_name' => 'N G McCullagh',
                                'owner_uid' => 205465,
                                'owner_style_name' => 'Fenian Reilly',
                                'race_datetime' => 'Nov  5 2014  7:45PM',
                                'race_instance_uid' => 613580,
                                'race_status_code' => 'R',
                                'ten_to_follow' => null,
                                'horse_uid' => 818695,
                            ]
                        ),
                    ],
                    'non_runners' => [
                        0 => General::createFromArray(
                            [
                                'style_name' => 'All Yours',
                                'rp_abbrev_3' => 'WAR',
                                'course_uid' => 85,
                                'course_name' => 'WARWICK',
                                'course_style_name' => 'Warwick',
                                'jockey_uid' => null,
                                'jockey_style_name' => null,
                                'owner_uid' => 180919,
                                'owner_style_name' => 'Potensis Limited',
                                'race_datetime' => 'Nov  5 2014  2:00PM',
                                'race_instance_uid' => 612421,
                                'ten_to_follow' => null,
                                'horse_uid' => 860089,
                                'race_status_code' => 'R',
                            ]
                        ),
                        1 => General::createFromArray(
                            [
                                'style_name' => 'Bold Duke',
                                'rp_abbrev_3' => 'NOT',
                                'course_uid' => 40,
                                'course_name' => 'NOTTINGHAM',
                                'course_style_name' => 'Nottingham',
                                'jockey_uid' => 85003,
                                'jockey_style_name' => 'Danny Burton',
                                'owner_uid' => 7159,
                                'owner_style_name' => 'E G Bevan',
                                'race_datetime' => 'Nov  5 2014  4:00PM',
                                'race_instance_uid' => 612437,
                                'ten_to_follow' => null,
                                'horse_uid' => 798329,
                                'race_status_code' => 'R',
                            ]
                        ),
                        2 => General::createFromArray(
                            [
                                'style_name' => 'Crosse Fire',
                                'rp_abbrev_3' => 'NOT',
                                'course_uid' => 40,
                                'course_name' => 'NOTTINGHAM',
                                'course_style_name' => 'Nottingham',
                                'jockey_uid' => 82605,
                                'jockey_style_name' => 'Frederik Tylicki',
                                'owner_uid' => 220328,
                                'owner_style_name' => 'Chappell, Cope, Dixon',
                                'race_datetime' => 'Nov  5 2014 12:20PM',
                                'race_instance_uid' => 612412,
                                'ten_to_follow' => null,
                                'horse_uid' => 861789,
                                'race_status_code' => 'R',
                            ]
                        ),
                        3 => General::createFromArray(
                            [
                                'style_name' => 'Even Stevens',
                                'rp_abbrev_3' => 'NOT',
                                'course_uid' => 40,
                                'course_name' => 'NOTTINGHAM',
                                'course_style_name' => 'Nottingham',
                                'jockey_uid' => 82605,
                                'jockey_style_name' => 'Frederik Tylicki',
                                'owner_uid' => 54787,
                                'owner_style_name' => 'Paul J Dixon',
                                'race_datetime' => 'Nov  5 2014  2:20PM',
                                'race_instance_uid' => 612416,
                                'ten_to_follow' => null,
                                'horse_uid' => 306252,
                                'race_status_code' => 'R',
                            ]
                        ),
                        4 => General::createFromArray(
                            [
                                'style_name' => 'How About It',
                                'rp_abbrev_3' => 'CHP',
                                'course_uid' => 12,
                                'course_name' => 'CHEPSTOW',
                                'course_style_name' => 'Chepstow',
                                'jockey_uid' => 9482,
                                'jockey_style_name' => 'A P McCoy',
                                'owner_uid' => 194138,
                                'owner_style_name' => 'Carl Hinchy',
                                'race_datetime' => 'Nov  5 2014  1:40PM',
                                'race_instance_uid' => 612449,
                                'ten_to_follow' => null,
                                'horse_uid' => 858397,
                                'race_status_code' => 'R',
                            ]
                        ),
                    ]
                ]
            ]
        ];
    }


    /**
     * @dataProvider providerTestGetStableToursDatabase
     *
     * @param string $searchBy
     * @param string $searchTerm
     * @param \DateTime $limitedDate
     * @param array $expectedResult
     */
    public function testGetStableToursDatabase(
        $searchBy,
        $searchTerm,
        \DateTime $limitedDate,
        array $expectedResult
    ) {
        $raceCards = $this->getMockBuilder(RaceCards::class)
            ->setMethods(['getLimitedDate'])
            ->disableOriginalConstructor()
            ->getMock();
        $raceCards->expects($this->any())
            ->method('getLimitedDate')
            ->willReturn($limitedDate);
        $this->assertEquals(
            $expectedResult,
            $raceCards->getStableToursDatabase($searchBy, $searchTerm)
        );
    }

    /**
     * @return array
     */
    public function providerTestGetStableToursDatabase()
    {
        return [
            [
                null,
                null,
                new \DateTime('01-11-2017'),
                [
                    0 =>
                        General::createFromArray(
                            [
                                'race_instance_uid' => 674239,
                                'race_datetime' => 'Apr 25 2017  4:55PM',
                                'race_status_code' => 'O',
                                'course_style_name' => 'Punchestown',
                                'course_name' => 'PUNCHESTOWN',
                                'course_uid' => 195,
                                'horse_uid' => 847824,
                                'horse_style_name' => 'Miles To Memphis',
                                'horse_country_origin_code' => 'IRE',
                                'notes' => 'He went down as one of our big disappointments last season. He was a very good bumper horse and did the job well on his hurdling debut at Fontwell, but he didn�t go on. He�s had a long break, we�ve tinkered with a few things and he�s moving better than he has ever done. He�ll go down the handicap route over hurdles. - 04/11/2015.',
                                'trainer_uid' => 12900,
                                'trainer_style_name' => 'Mrs Denise Foster',
                            ]
                        ),
                    1 =>
                        General::createFromArray(
                            [
                                'race_instance_uid' => 674239,
                                'race_datetime' => 'Apr 25 2017  4:55PM',
                                'race_status_code' => 'O',
                                'course_style_name' => 'Punchestown',
                                'course_name' => 'PUNCHESTOWN',
                                'course_uid' => 195,
                                'horse_uid' => 901793,
                                'horse_style_name' => 'Clara Sorrento',
                                'horse_country_origin_code' => 'FR',
                                'notes' => 'I like him. We will go back and try and win a bumper with him and he jumps well so he is not one to write off. I don�t think he ran his race at Tipperary - 27/10/2016.',
                                'trainer_uid' => 4446,
                                'trainer_style_name' => 'Noel Meade',
                            ]
                        ),
                ]
            ],
            [
                'horse',
                'Realt',
                new \DateTime('01-11-2017'),
                [
                    0 =>
                        General::createFromArray(
                            [
                                'horse_uid' => 726035,
                                'horse_style_name' => 'Realt Mor',
                                'horse_country_origin_code' => 'IRE',
                                'notes' => 'A former Grade 1 winner who�s had his fair share of problems. There�s a veterans� chase at Aintree in a few weeks and we are going to aim him at that. I still think he�ll pay his way this winter. - 19/10/2016',
                                'trainer_uid' => 18145,
                                'trainer_style_name' => 'Gordon Elliott',
                                'race_instance_uid' => null,
                                'race_datetime' => null,
                                'race_status_code' => null,
                                'course_style_name' => null,
                                'course_name' => null,
                                'course_uid' => null,
                            ]
                        ),
                    1 =>
                        General::createFromArray(
                            [
                                'horse_uid' => 855936,
                                'horse_style_name' => 'Realtra',
                                'horse_country_origin_code' => 'IRE',
                                'notes' => 'She ran poorly both times in Dubai and I can�t really explain why but she�s training really well and will run in the fillies� and mares� race on Good Friday. If I could forget Dubai she�d have a big chance at Lingfield. - 11/04/2017',
                                'trainer_uid' => 24890,
                                'trainer_style_name' => 'Roger Varian',
                                'race_instance_uid' => 598352,
                                'race_datetime' => 'Apr 16 2014  1:55PM',
                                'race_status_code' => 'R',
                                'course_style_name' => 'Beverley',
                                'course_name' => 'BEVERLEY',
                                'course_uid' => 6,
                            ]
                        ),
                ]
            ],
            [
                'trainer',
                'Gallagher',
                new \DateTime('01-11-2017'),
                [
                    0 =>
                        General::createFromArray(
                            [
                                'horse_uid' => 901699,
                                'horse_style_name' => 'September Stars',
                                'horse_country_origin_code' => 'IRE',
                                'notes' => 'First time out you could see all the way down the back and round the top bend she was pitching in the ground, and she went on three out and just paddled the last half-furlong and got caught. But we still think she\'s a nice filly and I\'ll find a 1m2f maiden for her. 26/04/2016',
                                'trainer_uid' => 13924,
                                'trainer_style_name' => 'Patrick Gallagher',
                                'race_instance_uid' => null,
                                'race_datetime' => null,
                                'race_status_code' => null,
                                'course_style_name' => null,
                                'course_name' => null,
                                'course_uid' => null,
                            ]
                        ),
                    1 =>
                        General::createFromArray(
                            [
                                'horse_uid' => 901699,
                                'horse_style_name' => 'September Stars',
                                'horse_country_origin_code' => 'IRE',
                                'notes' => 'She�s a really genuine filly who flourished this summer. She opened her account in a Windsor handicap in July and won with such authority that I ran her back there with a 6lb penalty when she was even more impressive. I stepped her up to Group 3 company for the Atalanta Stakes at Sandown last month but things didn�t work out for her there. My job will be to get some black type for her this autumn and she could run in the Rosemary Stakes at Newmarket on Friday - 21/09/2016.',
                                'trainer_uid' => 13924,
                                'trainer_style_name' => 'Patrick Gallagher',
                                'race_instance_uid' => null,
                                'race_datetime' => null,
                                'race_status_code' => null,
                                'course_style_name' => null,
                                'course_name' => null,
                                'course_uid' => null,
                            ]
                        ),
                    2 =>
                        General::createFromArray(
                            [
                                'horse_uid' => 1022959,
                                'horse_style_name' => 'Tiburtina',
                                'horse_country_origin_code' => 'IRE',
                                'notes' => 'She ran really well to finish fifth, beaten just a couple of lengths, on her debut at Kempton this month. I know Ralph Beckett is very sweet on the winner, Sibilance, and other trainers said nice things about their fillies, so I think it was a strong maiden and the form will work out. She travelled well but hung fire and ran green at the end. She�ll improve a lot for that and is ready to go again. We�ll find her a nice 6f maiden. - 22/06/2016.',
                                'trainer_uid' => 13924,
                                'trainer_style_name' => 'Patrick Gallagher',
                                'race_instance_uid' => null,
                                'race_datetime' => null,
                                'race_status_code' => null,
                                'course_style_name' => null,
                                'course_name' => null,
                                'course_uid' => null,
                            ]
                        ),
                ]
            ],
        ];
    }

    /**
     * @param int $raceId
     * @param int $limit
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetForm
     *
     * @throws \Api\Exception\NotFound
     */
    public function testGetForm($request, $limit, array $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $actualResults = $raceCards->getForm($limit, true);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($actualResults)
        );
    }

    /**
     * @return array
     */
    public function providerTestGetForm()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 635909
                    ]
                ),
                1,
                [
                    822332 => (Object)[
                        'horse_uid' => 822332,
                        'races' => [
                            630056 => RaceInstance::createFromArray(
                                [
                                    'race_instance_uid' => 630056,
                                    'race_datetime' => 'Jul 19 2015  2:40PM',
                                    'course_uid' => 67,
                                    'course_style_name' => 'Stratford',
                                    'course_country_code' => 'GB',
                                    'race_instance_title' => 'Amber Security Novices\' Hurdle',
                                    'race_type_code' => 'H',
                                    'course_rp_abbrev_3' => 'STR',
                                    'course_code' => 'STRT',
                                    'course_comments' => 'left-handed, sharp, flat track',
                                    'going_type_services_desc' => 'GF',
                                    'prize_sterling' => 3898.8000000000002,
                                    'distance_yard' => 3590,
                                    'actual_race_class' => '4',
                                    'rp_ages_allowed_desc' => '4yo+',
                                    'race_group_code' => '0',
                                    'race_group_desc' => 'Unknown',
                                    'weight_carried_lbs' => 159,
                                    'race_outcome_desc' => '1st',
                                    'race_outcome_form_char' => '1',
                                    'race_output_order' => 1,
                                    'race_outcome_position' => 1,
                                    'race_outcome_code' => '1  ',
                                    'orig_race_output_order' => 1,
                                    'no_of_runners' => null,
                                    'going_type_code' => 'GF',
                                    'no_of_runners_calculated' => 9,
                                    'rp_close_up_comment' => 'chased clear leader in fast early race, closed to lead before 5th, 10 lengths ahead after 2 out, easily increased advantage and hard held from last, impressive',
                                    'rp_horse_head_gear_code' => null,
                                    'first_time_yn' => null,
                                    'odds_desc' => '4/9F',
                                    'odds_value' => 0.44400000000000001,
                                    'horse_uid' => 822332,
                                    'jockey_style_name' => 'Noel Fehily',
                                    'aka_style_name' => 'N Fehily',
                                    'jockey_jockey_uid' => 77061,
                                    'official_rating_ran_off' => 0,
                                    'rp_topspeed' => 103,
                                    'rp_postmark' => 136,
                                    'dtw_rp_distance_desc' => '22',
                                    'dtw_sum_distance_value' => 22,
                                    'dtw_count_horse_race' => 0,
                                    'dtw_total_distance_value' => 91,
                                    'rp_betting_movements' => 'op 2/5 tchd 4/7',
                                    'disqualification_uid' => null,
                                    'disqualification_desc' => null,
                                    'other_horse' => null,
                                    'video_detail' => null,
                                    'next_run' =>
                                        RaceInstance::createFromArray(
                                            [
                                                'form_race_instance_uid' => 673767,
                                                'first_3_wins' => 1,
                                                'first_3_placed' => 0,
                                                'first_3_unplaced' => 0,
                                                'other_wins' => 0,
                                                'other_placed' => 2,
                                                'other_unplaced' => 10,
                                                'hot_race' => 0,
                                                'cold_race' => 0,
                                                'first_three' => (Object)[
                                                    'wins' => 1,
                                                    'placed' => 0,
                                                    'unplaced' => 0,
                                                ],
                                                'other' => (Object)[
                                                    'wins' => 0,
                                                    'placed' => 2,
                                                    'unplaced' => 10,
                                                ],
                                                'average_race' => 1,
                                            ]
                                        ),
                                ]
                            )
                        ]
                    ]
                ]
            ],
        ];
    }

    /**
     * @param int $raceUid
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetQuotes
     */
    public function testQuotes($request, $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($raceCards->getQuotes())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetQuotes()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 646609
                    ]
                ),
                [
                    General::createFromArray(
                        [
                            'horse_uid' => 873425,
                            'horse_name' => 'WELSH SHADOW',
                            'race_instance_uid' => 646609,
                            'race_datetime' => 'Apr 15 2016  2:00PM',
                            'course_name' => 'AYR',
                            'course_style_name' => 'Ayr',
                            'distance_yard' => 4500,
                            'race_instance_title' => 'West Sound Novices\' Hurdle',
                            'notes' => '\\bWelsh Shadow\\p is going to make a nice chaser so he\'ll probably go novice chasing next season. We will see what his owner wants to do but he could start off in the brush hurdle race at Haydock - Dan Skelton, trainer.',
                            'quotes' => null,
                            'key_quote_yn' => null,
                            'expire_on' => null,
                        ]
                    ),
                    General::createFromArray(
                        [
                            'horse_uid' => 857859,
                            'horse_name' => 'JETSTREAM JACK',
                            'race_instance_uid' => 642814,
                            'race_datetime' => 'Feb  8 2016  2:00PM',
                            'course_name' => 'MUSSELBURGH',
                            'course_style_name' => 'Musselburgh',
                            'distance_yard' => 4261,
                            'race_instance_title' => 'totequadpot Four Places In Four Races Novices\' Hurdle',
                            'notes' => '\\bJetstream Jack\\p has done well to give 7lbs to the runner-up as that was a decent horse on the Flat. We were a bit worried that he might get done for toe but he was idling on the run-in and found a bit more when the other came at him. He should make a chaser in time but we will give him an entry for the Martin Pipe Hurdle at Cheltenham - Gordon Elliot, trainer.',
                            'quotes' => null,
                            'key_quote_yn' => null,
                            'expire_on' => null,
                        ]
                    )
                ]
            ]
        ];
    }

    /**
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetBigRaces
     */
    public function testBigRaces($request, $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($raceCards->getBigRaces())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetBigRaces()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\Index(
                    [],
                    [
                        'raceId' => 612436
                    ]
                ),
                [
                    0 => General::createFromArray(
                        [
                            'zenithOfficial' => 90.833333330000002,
                            'course_uid' => 2,
                            'course_name' => 'ASCOT',
                            'course_style_name' => 'Ascot',
                            'rp_abbrev_3' => 'ASC',
                            'country_code' => 'GB ',
                            'race_instance_uid' => 631886,
                            'race_datetime' => 'Oct 17 2015 12:45PM',
                            'race_instance_title' => 'Qipco British Champions Long Distance Cup (Group 2)',
                            'distance_yard' => 3520,
                            'race_type_code' => 'F',
                            'race_status_code' => '4',
                            'going_type_code' => 'S',
                            'rp_going_type_desc' => 'SOFT',
                            'race_class' => '1',
                            "rp_ages_allowed_desc" => "3yo+"
                        ]
                    ),
                    1 => General::createFromArray(
                        [
                            'zenithOfficial' => 90.833333330000002,
                            'course_uid' => 2,
                            'course_name' => 'ASCOT',
                            'course_style_name' => 'Ascot',
                            'rp_abbrev_3' => 'ASC',
                            'country_code' => 'GB ',
                            'race_instance_uid' => 631884,
                            'race_datetime' => 'Oct 17 2015  1:20PM',
                            'race_instance_title' => 'Qipco British Champions Sprint Stakes (Group 1)',
                            'distance_yard' => 1320,
                            'race_type_code' => 'F',
                            'race_status_code' => '4',
                            'going_type_code' => 'GS',
                            'rp_going_type_desc' => 'GD-SFT',
                            'race_class' => '1',
                            "rp_ages_allowed_desc" => "3yo+"
                        ]
                    ),
                    2 => General::createFromArray(
                        [
                            'zenithOfficial' => 90.833333330000002,
                            'course_uid' => 2,
                            'course_name' => 'ASCOT',
                            'course_style_name' => 'Ascot',
                            'rp_abbrev_3' => 'ASC',
                            'country_code' => 'GB ',
                            'race_instance_uid' => 631885,
                            'race_datetime' => 'Oct 17 2015  1:55PM',
                            'race_instance_title' => 'Qipco British Champions Fillies & Mares Stakes (Group 1) (Fillies & Mares)',
                            'distance_yard' => 2640,
                            'race_type_code' => 'F',
                            'race_status_code' => '4',
                            'going_type_code' => 'S',
                            'rp_going_type_desc' => 'SOFT',
                            'race_class' => '1',
                            "rp_ages_allowed_desc" => "3yo+"
                        ]
                    ),
                ]
            ]
        ];
    }

    /**
     * @param \Api\Input\Request\Horses\RaceCards\NextRace $request
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetNextRace
     */
    public function testNextRace(\Api\Input\Request\Horses\RaceCards\NextRace $request, $expectedResult)
    {
        $raceCards = new RaceCards($request);
        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($raceCards->getNextRace($request))
        );
    }

    /**
     * @return array
     */
    public function providerTestGetNextRace()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\NextRace(),
                General::createFromArray(
                    [
                        'race_instance_uid' => 635435,
                        'race_datetime' => 'Oct 15 2015  1:50PM',
                        'course_name' => 'UTTOXETER',
                        'course_style_name' => 'Uttoxeter',
                        'country_code' => 'GB',
                        'course_uid' => 84,
                    ]
                )
            ]
        ];
    }

    /**
     * @dataProvider providerTestGetBettingForecast
     *
     * @param \Api\Input\Request\Horses\RaceCards\Runners $request
     * @param array $expectedResult
     */
    public function testGetBettingForecast(
        \Api\Input\Request\Horses\RaceCards\BettingForecast $request,
        array $expectedResult
    ) {
        $raceCards = new RaceCards($request);

        $this->assertJsonStringEqualsJsonString(
            json_encode($expectedResult),
            json_encode($raceCards->getBettingForecast())
        );
    }

    /**
     * @return array
     */
    public function providerTestGetBettingForecast()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\BettingForecast(
                    [],
                    ['raceId' => 652709]
                ),
                [
                    843009 => \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_uid' => 843009,
                            'horse_name' => 'Glance Of Doon',
                            'country_origin_code' => 'IRE',
                            'start_number' => 1,
                            'forecast_odds_value' => 16,
                            'forecast_odds_desc' => '16/1',
                        ]
                    ),
                    885087 => \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_uid' => 885087,
                            'horse_name' => 'Whizzzey Rascal',
                            'country_origin_code' => 'IRE',
                            'start_number' => 2,
                            'forecast_odds_value' => 8,
                            'forecast_odds_desc' => '8/1',
                        ]
                    ),
                    917796 => \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_uid' => 917796,
                            'horse_name' => 'Bach Along',
                            'country_origin_code' => 'IRE',
                            'start_number' => 3,
                            'forecast_odds_value' => 50,
                            'forecast_odds_desc' => '50/1',
                        ]
                    ),
                    856407 => \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_uid' => 856407,
                            'horse_name' => 'Definite Lily',
                            'country_origin_code' => 'IRE',
                            'start_number' => 4,
                            'forecast_odds_value' => 25,
                            'forecast_odds_desc' => '25/1',
                        ]
                    ),
                    850779 => \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_uid' => 850779,
                            'horse_name' => 'Genesta',
                            'country_origin_code' => 'IRE',
                            'start_number' => 5,
                            'forecast_odds_value' => 4,
                            'forecast_odds_desc' => '4/1',
                        ]
                    ),
                    912852 => \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_uid' => 912852,
                            'horse_name' => 'Keepbackitoldya',
                            'country_origin_code' => 'IRE',
                            'start_number' => 6,
                            'forecast_odds_value' => 66,
                            'forecast_odds_desc' => '66/1',
                        ]
                    ),
                    876180 => \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_uid' => 876180,
                            'horse_name' => 'Legal Proceedings',
                            'country_origin_code' => 'IRE',
                            'start_number' => 7,
                            'forecast_odds_value' => 50,
                            'forecast_odds_desc' => '50/1',
                        ]
                    ),
                    1025063 => \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_uid' => 1025063,
                            'horse_name' => 'Little King Rocket',
                            'country_origin_code' => 'IRE',
                            'start_number' => 8,
                            'forecast_odds_value' => 16,
                            'forecast_odds_desc' => '16/1',
                        ]
                    ),
                    863439 => \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_uid' => 863439,
                            'horse_name' => 'Molly\'s Diamond',
                            'country_origin_code' => 'IRE',
                            'start_number' => 9,
                            'forecast_odds_value' => 66,
                            'forecast_odds_desc' => '66/1',
                        ]
                    ),
                    897248 => \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_uid' => 897248,
                            'horse_name' => 'Muthaza',
                            'country_origin_code' => 'FR',
                            'start_number' => 10,
                            'forecast_odds_value' => 0.40000000000000002,
                            'forecast_odds_desc' => '2/5',
                        ]
                    ),
                    859407 => \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_uid' => 859407,
                            'horse_name' => 'Putrakin',
                            'country_origin_code' => 'IRE',
                            'start_number' => 11,
                            'forecast_odds_value' => 33,
                            'forecast_odds_desc' => '33/1',
                        ]
                    ),
                    837196 => \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_uid' => 837196,
                            'horse_name' => 'Rosetub',
                            'country_origin_code' => 'IRE',
                            'start_number' => 12,
                            'forecast_odds_value' => 33,
                            'forecast_odds_desc' => '33/1',
                        ]
                    ),
                    894628 => \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_uid' => 894628,
                            'horse_name' => 'Shanklys Dawn',
                            'country_origin_code' => 'IRE',
                            'start_number' => 13,
                            'forecast_odds_value' => 20,
                            'forecast_odds_desc' => '20/1',
                        ]
                    ),
                    861928 => \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_uid' => 861928,
                            'horse_name' => 'Suremillie',
                            'country_origin_code' => 'IRE',
                            'start_number' => 14,
                            'forecast_odds_value' => 66,
                            'forecast_odds_desc' => '66/1',
                        ]
                    ),
                    997710 => \Api\Row\Results\Horse::createFromArray(
                        [
                            'horse_uid' => 997710,
                            'horse_name' => 'Carrig Lily',
                            'country_origin_code' => 'IRE',
                            'start_number' => 15,
                            'forecast_odds_value' => 66,
                            'forecast_odds_desc' => '66/1',
                        ]
                    ),
                ],
            ]
        ];
    }

    /**
     * @dataProvider providerTestGetNapsTable
     *
     * @param \Api\Input\Request\Horses\RaceCards\NapsTable $request
     * @param array $expectedResult
     */
    public function testGetNapsTable(\Api\Input\Request\Horses\RaceCards\NapsTable $request, array $expectedResult)
    {
        $raceCards = new RaceCards($request);

        $this->assertEquals(
            $expectedResult,
            $raceCards->getNapsTable($request)
        );
    }

    /**
     * @return array
     */
    public function providerTestGetNapsTable()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\NapsTable(),
                [
                    General::createFromArray(
                        [
                            "horse_style_name" => "Yukon Delta",
                            "country_origin_code" => "IRE",
                            "horse_uid" => 781174,
                            "nap_time" => "Nov  4 2016  1 => 00PM",
                            "course" => "Font",
                            "newspaper" => "Daily Telegraph",
                            "tipster" => "Marlborough",
                            "level_stake" => 14.85,
                            "naps_count" => 2,
                            "race_instance_uid" => 660604,
                            "course_uid" => 20,
                            "course_name" => "Fontwell",
                            "owner_uid" => 16345,
                            "rp_owner_choice" => "a",
                            "naps_table_outcome" => null,
                            "odds_desc" => null
                        ]
                    ),
                    General::createFromArray(
                        [
                            "horse_style_name" => "Kitchapoly",
                            "country_origin_code" => "FR",
                            "horse_uid" => 832413,
                            "nap_time" => "Nov  4 2016  3 => 45PM",
                            "course" => "Wwck",
                            "newspaper" => "Sunday Mail",
                            "tipster" => "Rockavon",
                            "level_stake" => 12.5,
                            "naps_count" => 2,
                            "race_instance_uid" => 660616,
                            "course_uid" => 85,
                            "course_name" => "Warwick",
                            "owner_uid" => 199331,
                            "rp_owner_choice" => "a",
                            "naps_table_outcome" => null,
                            "odds_desc" => null
                        ]
                    ),
                    General::createFromArray(
                        [
                            "horse_style_name" => "David Cricket",
                            "country_origin_code" => "GB",
                            "horse_uid" => 1003411,
                            "nap_time" => "Nov  4 2016  3 => 55PM",
                            "course" => "Font",
                            "newspaper" => "Yorkshire Post",
                            "tipster" => "The Duke",
                            "level_stake" => 6.58,
                            "naps_count" => 2,
                            "race_instance_uid" => 660606,
                            "course_uid" => 20,
                            "course_name" => "Fontwell",
                            "owner_uid" => 110420,
                            "rp_owner_choice" => "a",
                            "naps_table_outcome" => null,
                            "odds_desc" => null
                        ]
                    ),
                    General::createFromArray(
                        [
                            "horse_style_name" => "Peny Arcade",
                            "country_origin_code" => "GB",
                            "horse_uid" => 1039831,
                            "nap_time" => "Nov  4 2016  4 => 20PM",
                            "course" => "Newc",
                            "newspaper" => "Glasgow Evening Times",
                            "tipster" => "Jeffrey Ross",
                            "level_stake" => 6.42,
                            "naps_count" => 1,
                            "race_instance_uid" => 660699,
                            "course_uid" => 1353,
                            "course_name" => "Newcastle (A.W)",
                            "owner_uid" => 91027,
                            "rp_owner_choice" => "a",
                            "naps_table_outcome" => "1st",
                            "odds_desc" => '10/1'
                        ]
                    ),
                    General::createFromArray(
                        [
                            "horse_style_name" => "Meandmyshadow",
                            "country_origin_code" => "GB",
                            "horse_uid" => 755781,
                            "nap_time" => "Nov  4 2016  7 => 20PM",
                            "course" => "Newc",
                            "newspaper" => "Racing Post",
                            "tipster" => "Postdata",
                            "level_stake" => 6.38,
                            "naps_count" => 2,
                            "race_instance_uid" => 660695,
                            "course_uid" => 1353,
                            "course_name" => "Newcastle (A.W)",
                            "owner_uid" => 118022,
                            "rp_owner_choice" => "a",
                            "naps_table_outcome" => "1st",
                            "odds_desc" => '10/1'
                        ]
                    ),
                    General::createFromArray(
                        [
                            "horse_style_name" => "Miss Van Gogh",
                            "country_origin_code" => "GB",
                            "horse_uid" => 855820,
                            "nap_time" => "Nov  4 2016  6 => 20PM",
                            "course" => "Newc",
                            "newspaper" => "The Sun On Sunday",
                            "tipster" => "Sirius",
                            "level_stake" => 5.75,
                            "naps_count" => 1,
                            "race_instance_uid" => 660694,
                            "course_uid" => 1353,
                            "course_name" => "Newcastle (A.W)",
                            "owner_uid" => 217149,
                            "rp_owner_choice" => "a",
                            "naps_table_outcome" => "1st",
                            "odds_desc" => '10/1'
                        ]
                    ),
                ]
            ]
        ];
    }

    /**
     * @dataProvider providerTestGetTopNaps
     *
     * @param \Api\Input\Request\Horses\RaceCards\TopNaps $request
     * @param array $expectedResult
     */
    public function testGetTopNaps(\Api\Input\Request\Horses\RaceCards\TopNaps $request, array $expectedResult)
    {
        $raceCards = new RaceCards($request);

        $this->assertEquals($expectedResult, $raceCards->getTopNaps($request));
    }

    /**
     * @return array
     */
    public function providerTestGetTopNaps()
    {
        return [
            [
                new \Api\Input\Request\Horses\RaceCards\TopNaps(),
                [
                    1048725 => General::createFromArray(
                        [
                            'horse_uid' => 1048725,
                            'horse_style_name' => 'Ghayyar',
                            'horse_name' => 'GHAYYAR',
                            'race_datetime' => 'Mar 21 2017  2:40PM',
                            'race_instance_uid' => 659609,
                            'race_instance_title' => 'Racing UK HD Nursery Handicap',
                            'course_uid' => 38,
                            'course_style_name' => 'Newmarket',
                            'owner_uid' => 217366,
                            'owner_name' => 'AL SHAQAB RACING',
                            'owner_style_name' => 'Al Shaqab Racing',
                            'owner_choice' => 'a',
                            'trainer_uid' => 28787,
                            'trainer_style_name' => 'Richard Hannon',
                            'trainer_name' => 'RICHARD HANNON',
                            'jockey_uid' => 2277,
                            'jockey_style_name' => 'Frankie Dettori',
                            'jockey_name' => 'FRANKIE DETTORI',
                            'naps_count' => 3,
                        ]
                    ),
                ]
            ]
        ];
    }
}
