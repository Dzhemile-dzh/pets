<?php

namespace Tests\Stubs\Models\Bo\HorseProfile;

use Api\Row\RaceInstance as RiRow;

class RaceInstance extends \Tests\Stubs\Models\Horse
{
    private $raceId;
    private $horseId;

    /**
     * @return mixed
     */
    protected function getRaceId()
    {
        return $this->raceId;
    }

    /**
     * @param int $raceId
     */
    protected function setRaceId($raceId)
    {
        $this->raceId = $raceId;
    }

    /**
     * @return mixed
     */
    protected function getHorseId()
    {
        return $this->horseId;
    }

    /**
     * @param int $horseId
     */
    protected function setHorseId($horseId)
    {
        $this->horseId = $horseId;
    }

    /**
     * @return array
     */
    public function getForm()
    {
        $horseUid = $this->getHorseId();
        $data = [
            895387 => [
                895387 => (Object)[
                    'horse_uid' => 895387,
                    'races' => [
                        630427 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                            [
                                'zenithOfficial' => 90.833333330000002,
                                'race_instance_uid' => 630427,
                                'race_datetime' => 'Jul 25 2015  5:30PM',
                                'course_uid' => 31,
                                'course_name' => 'LINGFIELD',
                                'course_style_name' => 'Lingfield',
                                'country_code' => 'GB ',
                                'course_type_code' => 'N',
                                'race_instance_title' => 'titanbet.co.uk Maiden Auction Stakes',
                                'race_type_code' => 'F',
                                'course_rp_abbrev_3' => 'LIN',
                                'course_rp_abbrev_4' => 'STH',
                                'course_code' => 'LINW',
                                'course_comments' => 'left-handed, sharp track',
                                'going_type_services_desc' => 'GS',
                                'prize_sterling' => 3040.4299999999998,
                                'prize_euro' => 0,
                                'distance_yard' => 1100,
                                'actual_race_class' => '5',
                                'rp_ages_allowed_desc' => '2yo',
                                'race_group_code' => '0',
                                'race_group_desc' => 'Unknown',
                                'weight_carried_lbs' => 127,
                                'race_outcome_desc' => '4th',
                                'race_outcome_form_char' => '4',
                                'race_output_order' => 4,
                                'race_outcome_position' => 4,
                                'race_outcome_code' => '4  ',
                                'orig_race_output_order' => 4,
                                'no_of_runners' => null,
                                'going_type_code' => 'GS',
                                'no_of_runners_calculated' => 7,
                                'rp_close_up_comment' => 'outpaced in last, progress over 1f out, stayed on inside final furlong, nearest finish',
                                'rp_horse_head_gear_code' => null,
                                'first_time_yn' => null,
                                'odds_desc' => '6/1',
                                'odds_value' => 6,
                                'horse_uid' => 895387,
                                'jockey_style_name' => 'Martin Dwyer',
                                'aka_style_name' => 'Martin Dwyer',
                                'jockey_jockey_uid' => 11255,
                                'jockey_ptp_type_code' => 'N',
                                'official_rating_ran_off' => 0,
                                'rp_topspeed' => 63,
                                'rp_postmark' => 63,
                                'ptv_video_id' => 221334,
                                'video_provider' => 'ATR',
                                'dtw_rp_distance_desc' => '4',
                                'dtw_sum_distance_value' => 6,
                                'dtw_count_horse_race' => 0,
                                'dtw_total_distance_value' => 9,
                                'rp_betting_movements' => 'op 7/1 tchd 11/2',
                                'disqualification_uid' => null,
                                'disqualification_desc' => null,
                                'rp_straight_round_jubilee_desc' => null,
                                'weight_allowance_lbs' => 8,
                                'draw' => 0,
                                'other_horse' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'zenithOfficial' => 90.833333330000002,
                                        'style_name' => 'Jakaby Jade',
                                        'horse_uid' => 893261,
                                        'weight_carried_lbs' => 120,
                                        'race_instance_uid' => 630427,
                                        'race_outcome_position' => 1,
                                    ]
                                ),
                                'race_tactics' => \Phalcon\Mvc\Model\Row\General::createFromArray(
                                    [
                                        'actual' => [
                                            'runner_attrib_type' => 'Early',
                                            'runner_attrib_description' => 'Prominent',
                                        ],
                                        'predicted' => [
                                            'runner_attrib_type' => null,
                                            'runner_attrib_description' => null
                                        ]
                                    ]
                                ),
                            ]
                        ),
                    ],
                ]
            ],
            867979 => [
                867979 => (Object)array(
                    'horse_uid' => 867979,
                    'races' =>
                        array(
                            659318 =>
                                RiRow::createFromArray(array(
                                    'race_instance_uid' => 659318,
                                    'race_group_uid' => 6,
                                    'race_datetime' => 'Oct 11 2016  9:15PM',
                                    'course_uid' => 513,
                                    'course_name' => 'WOLVERHAMPTON (A.W)',
                                    'course_style_name' => 'Wolverhampton (A.W)',
                                    'country_code' => 'GB ',
                                    'course_type_code' => 'X',
                                    'race_instance_title' => 'NTM Russia Handicap',
                                    'race_type_code' => 'X',
                                    'course_code' => 'WOLW',
                                    'course_rp_abbrev_3' => 'WOL',
                                    'course_rp_abbrev_4' => 'Wolv',
                                    'course_code1' => 'WOLW',
                                    'weight_allowance_lbs' => 0,
                                    'course_comments' => 'left-handed 7 1/2f oval.',
                                    'going_type_services_desc' => 'St',
                                    'prize_sterling' => 2264.1500000000001,
                                    'prize_euro' => 0,
                                    'distance_yard' => 2691,
                                    'actual_race_class' => '7',
                                    'rp_ages_allowed_desc' => '3yo+',
                                    'race_group_code' => 'H',
                                    'race_group_desc' => 'Handicap',
                                    'weight_carried_lbs' => 132,
                                    'race_outcome_desc' => '1st',
                                    'race_outcome_form_char' => '1',
                                    'race_output_order' => 1,
                                    'race_outcome_position' => 1,
                                    'race_outcome_code' => '1',
                                    'orig_race_output_order' => 1,
                                    'no_of_runners' => null,
                                    'going_type_code' => 'SD',
                                    'no_of_runners_calculated' => 11,
                                    'rp_close_up_comment' => 'held up in touch in midfield, effort 2f out, headway under pressure to challenge just inside final furlong, led 75yds out, ridden out',
                                    'rp_horse_head_gear_code' => null,
                                    'first_time_yn' => null,
                                    'odds_desc' => '7/2',
                                    'odds_value' => 3.5,
                                    'horse_uid' => 867979,
                                    'jockey_style_name' => 'Silvestre De Sousa',
                                    'aka_style_name' => 'S De Sousa',
                                    'jockey_jockey_uid' => 83746,
                                    'jockey_ptp_type_code' => 'N',
                                    'official_rating_ran_off' => 49,
                                    'rp_topspeed' => 35,
                                    'rp_postmark' => 56,
                                    'video_id' => 151586,
                                    'dtw_rp_distance_desc' => null,
                                    'dtw_sum_distance_value' => 1,
                                    'dtw_count_horse_race' => 0,
                                    'dtw_total_distance_value' => 13.75,
                                    'rp_betting_movements' => 'op 9/2',
                                    'disqualification_uid' => null,
                                    'disqualification_desc' => null,
                                    'rp_straight_round_jubilee_desc' => null,
                                    'other_horse' =>
                                        RiRow::createFromArray(array(
                                            'style_name' => 'Mrs Burbidge',
                                            'country_origin_code' => 'GB',
                                            'horse_uid' => 853947,
                                            'weight_carried_lbs' => 132,
                                            'race_instance_uid' => 659318,
                                            'race_outcome_position' => 2,
                                        )),
                                    'race_tactics' => null,
                                    'next_run' =>
                                        RiRow::createFromArray(array(
                                            'form_race_instance_uid' => 659318,
                                            'first_3_wins' => 0,
                                            'first_3_placed' => 1,
                                            'first_3_unplaced' => 2,
                                            'other_wins' => 0,
                                            'other_placed' => 0,
                                            'other_unplaced' => 5,
                                            'hot_race' => 0,
                                            'cold_race' => 1,
                                            'first_three' =>
                                                (Object)array(
                                                    'wins' => 0,
                                                    'placed' => 1,
                                                    'unplaced' => 2,
                                                ),
                                            'other' =>
                                                (Object)array(
                                                    'wins' => 0,
                                                    'placed' => 0,
                                                    'unplaced' => 5,
                                                ),
                                            'average_race' => 0,
                                        )),
                                    'draw' => 5,
                                    'non_runner' => 'N',
                                )),
                        ),
                ),
            ]
        ];

        return (isset($data[$horseUid]) ? $data[$horseUid] : null);
    }

    public function getRaceTactics()
    {
        return array(
            659318 => (
            (Object)[
                'race_instance_uid' => 659318,
                'horse_uid' => 867979,
                'predicted_yn' => 'N',
                'runner_attrib_type' => 'Early',
                'runner_attrib_description' => 'Hold-Up',
            ]
            ),
        );
    }

    /**
     * @return array
     */
    public function getWins()
    {
        return $this->getForm();
    }

    /**
     *
     * @return array
     */
    public function getMyRatings()
    {
        return $this->getForm();
    }

    /**
     * @param int    $horseUid
     * @param string $raceType
     *
     * @return array
     */
    public function getStatistics($horseUid, $raceType)
    {
        return [
            'course' => [
                array(
                    0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'course_name' => 'EPSOM',
                            'course_uid' => 17,
                            'course_style_name' => 'Epsom',
                            'course_type_code' => 'N',
                            'course_comment' => 'left-handed, sharp track (very sharp up to 1m)',
                            'starts_number' => 1,
                            'place_1st_number' => 1,
                            'place_2nd_number' => 0,
                            'place_3rd_number' => 0,
                            'win_prize' => 813221.40000000002,
                            'total_prize' => 813221.40000000002,
                            "euro_win_prize" => 0,
                            "euro_total_prize" => 0,
                            'best_rp_topspeed' => 116,
                            'best_rp_postmark' => 127,
                            'net_total_prize' => 100.4,
                            'net_win_prize' => 100.4,
                        )
                    ),
                    1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'course_name' => 'NEWMARKET',
                            'course_uid' => 38,
                            'course_style_name' => 'Newmarket',
                            'course_type_code' => 'N',
                            'course_comment' => 'right-handed, galloping track',
                            'starts_number' => 1,
                            'place_1st_number' => 1,
                            'place_2nd_number' => 0,
                            'place_3rd_number' => 0,
                            'win_prize' => 20982.700000000001,
                            'total_prize' => 20982.700000000001,
                            "euro_win_prize" => 0,
                            "euro_total_prize" => 0,
                            'best_rp_topspeed' => 87,
                            'best_rp_postmark' => 111,
                            'net_total_prize' => 100.4,
                            'net_win_prize' => 100.4,
                        )
                    ),
                )
            ],
            'distance' => [
                array(
                    0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'distance_yard' => 1835,
                            'starts_number' => 1,
                            'place_1st_number' => 1,
                            'place_2nd_number' => 0,
                            'place_3rd_number' => 0,
                            'win_prize' => 6469,
                            'total_prize' => 6469,
                            "euro_win_prize" => 0,
                            "euro_total_prize" => 0,
                            'best_rp_topspeed' => 74,
                            'best_rp_postmark' => 86,
                            'net_total_prize' => 100.4,
                            'net_win_prize' => 100.4,
                        )
                    ),
                    1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'distance_yard' => 1980,
                            'starts_number' => 1,
                            'place_1st_number' => 1,
                            'place_2nd_number' => 0,
                            'place_3rd_number' => 0,
                            'win_prize' => 20982.700000000001,
                            'total_prize' => 20982.700000000001,
                            "euro_win_prize" => 0,
                            "euro_total_prize" => 0,
                            'best_rp_topspeed' => 87,
                            'best_rp_postmark' => 111,
                            'net_total_prize' => 100.4,
                            'net_win_prize' => 100.4,
                        )
                    ),
                )
            ],
            'going' => [
                array(
                    0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'going_type_desc' => 'Good',
                            'starts_number' => 1,
                            'place_1st_number' => 1,
                            'place_2nd_number' => 0,
                            'place_3rd_number' => 0,
                            'win_prize' => 90736,
                            'total_prize' => 90736,
                            "euro_win_prize" => 0,
                            "euro_total_prize" => 0,
                            'best_rp_topspeed' => 110,
                            'best_rp_postmark' => 123,
                            'net_total_prize' => 100.4,
                            'net_win_prize' => 100.4,
                        )
                    ),
                )
            ],
            'month' => [
                array(
                    0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_datetime_month' => 4,
                            'month_name' => 'April',
                            'starts_number' => 1,
                            'place_1st_number' => 1,
                            'place_2nd_number' => 0,
                            'place_3rd_number' => 0,
                            'win_prize' => 20982.700000000001,
                            'total_prize' => 20982.700000000001,
                            "euro_win_prize" => 0,
                            "euro_total_prize" => 0,
                            'best_rp_topspeed' => 87,
                            'best_rp_postmark' => 111,
                            'net_total_prize' => 100.4,
                            'net_win_prize' => 100.4,
                        )
                    ),
                    1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'race_datetime_month' => 5,
                            'month_name' => 'May',
                            'starts_number' => 1,
                            'place_1st_number' => 1,
                            'place_2nd_number' => 0,
                            'place_3rd_number' => 0,
                            'win_prize' => 90736,
                            'total_prize' => 90736,
                            "euro_win_prize" => 0,
                            "euro_total_prize" => 0,
                            'best_rp_topspeed' => 110,
                            'best_rp_postmark' => 123,
                            'net_total_prize' => 100.4,
                            'net_win_prize' => 100.4,
                        )
                    ),
                )
            ],
            'jockey' => [
                array(
                    0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'jockey_style_name' => 'Frankie Dettori',
                            'jockey_uid' => 2277,
                            'jockey_short_name' => 'L Dettori',
                            'jockey_ptp_type_code' => 'N',
                            'starts_number' => 3,
                            'place_1st_number' => 3,
                            'place_2nd_number' => 0,
                            'place_3rd_number' => 0,
                            'win_prize' => 1089399.1000000001,
                            'total_prize' => 1089399.1000000001,
                            "euro_win_prize" => 0,
                            "euro_total_prize" => 0,
                            'best_rp_topspeed' => 116,
                            'best_rp_postmark' => 132,
                            'net_total_prize' => 100.4,
                            'net_win_prize' => 100.4,
                        )
                    ),
                    1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'jockey_style_name' => 'William Buick',
                            'jockey_uid' => 85793,
                            'jockey_short_name' => 'W Buick',
                            'jockey_ptp_type_code' => 'N',
                            'starts_number' => 2,
                            'place_1st_number' => 2,
                            'place_2nd_number' => 0,
                            'place_3rd_number' => 0,
                            'win_prize' => 97205,
                            'total_prize' => 97205,
                            "euro_win_prize" => 0,
                            "euro_total_prize" => 0,
                            'best_rp_topspeed' => 110,
                            'best_rp_postmark' => 123,
                            'net_total_prize' => 100.4,
                            'net_win_prize' => 100.4,
                        )
                    ),
                )
            ],
            'class' => [
                array(
                    0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'actual_race_class' => '1',
                            'starts_number' => 4,
                            'place_1st_number' => 4,
                            'place_2nd_number' => 0,
                            'place_3rd_number' => 0,
                            'win_prize' => 1180135.1000000001,
                            'total_prize' => 1180135.1000000001,
                            "euro_win_prize" => 0,
                            "euro_total_prize" => 0,
                            'best_rp_topspeed' => 116,
                            'best_rp_postmark' => 132,
                            'net_total_prize' => 100.4,
                            'net_win_prize' => 100.4,
                        )
                    ),
                    1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                        array(
                            'actual_race_class' => '4',
                            'starts_number' => 1,
                            'place_1st_number' => 1,
                            'place_2nd_number' => 0,
                            'place_3rd_number' => 0,
                            'win_prize' => 6469,
                            'total_prize' => 6469,
                            "euro_win_prize" => 0,
                            "euro_total_prize" => 0,
                            'best_rp_topspeed' => 74,
                            'best_rp_postmark' => 86,
                            'net_total_prize' => 100.4,
                            'net_win_prize' => 100.4,
                        )
                    ),
                )
            ],
        ];
    }

    /**
     * @param $horseUid
     *
     * @return array
     */
    public function getEntries($horseUid)
    {
        return [
            (Object)[
                "race_instance_uid" => 592366,
                "race_datetime" => "Jun 6 2015 4:00PM",
                "course_name" => "EPSOM",
                "course_uid" => 10,
                "course_style_name" => "Epsom",
                'course_type_code' => 'N',
                "race_instance_title" => "Investec Derby (Group 1) (Entire Colts & Fillies)",
                "race_status_code" => "O",
                'distance_yard' => 1313,
                'saddle_cloth_no' => 9,
                'rp_postmark' => 67,
                'jockey_uid' => 84894,
                'jockey_style_name' => 'Simon Pearce',
                'jockey_ptp_type_code' => 'N',
                'running_conditions' => null,
                'rp_owner_choice' => null,
                'owner_uid' => 221409,
                'num_overnight_races' => 0
            ]
        ];
    }

    /**
     * @param int $horseUid
     *
     * @return array
     */
    public function getNotes($horseUid)
    {
        $data = [
            513120 => [
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 513120,
                        'horse_name' => 'BEST LIGHT',
                        'horse_style_name' => 'Best Light',
                        'race_id' => 284562,
                        'race_date' => 'Aug  4 2000  3:20PM',
                        'distance_furlong' => 7,
                        'course_uid' => 6,
                        'course_name' => 'GOODWOOD',
                        'course_style_name' => 'Goodwood',
                        'course_type_code' => 'N',
                        'distance' => 1540,
                        'race_title' => 'Theo Fennell Lennox Stakes Class A (Group 3)',
                        'going_type_code' => 'G',
                        'rp_postmark' => null,
                        'notes' => 'Although the colt\'s cuts are thankfully minor ones, it wouldn\'t have been fair to run him. It\'s a shame because he had a number of options, and this was the one we fancied the most. - David Elsworth',

                    ]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 513120,
                        'horse_name' => 'BEST LIGHT',
                        'horse_style_name' => 'Best Light',
                        'race_id' => 272163,
                        'race_date' => 'Oct  1 1999  3:05PM',
                        'distance_furlong' => 7,
                        'course_uid' => 6,
                        'course_name' => 'NEWMARKET (JULY)',
                        'course_style_name' => 'Newmarket (July)',
                        'course_type_code' => 'N',
                        'distance' => 1540,
                        'race_title' => 'Somerville Tattersall Stakes Class A (Listed Race)',
                        'going_type_code' => 'GS',
                        'rp_postmark' => 107,
                        'notes' => 'Well balanced and a beautiful mover - David Elsworth, who reckons he will make a middle-distance performer in due course, but has already backed him for the 2,000 Guineas, that will be on the agenda first, all being well.',

                    ]
                ),
                \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 513120,
                        'horse_name' => 'BEST LIGHT',
                        'horse_style_name' => 'Best Light',
                        'race_id' => 271686,
                        'race_date' => 'Sep 19 1999  3:45PM',
                        'distance_furlong' => 7,
                        'course_uid' => 5,
                        'course_name' => 'NEWBURY',
                        'course_style_name' => 'Newbury',
                        'course_type_code' => 'N',
                        'distance' => 1540,
                        'race_title' => 'Dubai Airport Free Zone Maiden Stakes Class D',
                        'going_type_code' => 'GS',
                        'rp_postmark' => 97,
                        'notes' => 'We\'ve always thought the world of him and I should think the colt (Port Vila) he was third behind at Kempton is very good. Our horse just didn\'t have the know how to go and win there, but he had it today - David Elsworth',
                    ]
                ),
            ]
        ];

        return $data[$horseUid];
    }

    /**
     * @return array
     */
    public function getPtpGbHorses()
    {
        $horseUid = $this->getHorseId();

        if (is_int($horseUid)) {
            $horseUid = [$horseUid];
        }
        $data = [
            '895387' => [],
            '628399' => [628399]
        ];

        $key = implode('.', $horseUid);

        return (isset($data[$key]) ? $data[$key] : []);
    }

    /**
     * @param int $horseUid
     *
     * @return array
     */
    public function getStableTourQuotes($horseUid)
    {
        $today = (new \DateTime())->format('d/m/Y');

        return [
            \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    "horse_uid" => 737210,
                    "horse_name" => "Simenon",
                    "notes" => "Has done well for us on the Flat and over hurdles. - " . $today
                ]
            )
        ];
    }

    public function checkFastResults($raceDate)
    {
        return array();
    }

    /**
     * @param int $raceId
     * @param int $horseId
     * @param bool $isResults
     */
    public function createHorsesIdTables($raceId, $horseId = 0, $isResults = false)
    {
        if ($raceId > 0) {
            $this->setRaceId($raceId);
        } elseif ($horseId > 0) {
            $this->setHorseId($horseId);
        }
    }

    /**
     * Drop horsesUids tmp table
     *
     */
    public function dropHorsesUidsTmpTables()
    {
    }
}
