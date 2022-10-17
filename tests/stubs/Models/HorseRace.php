<?php

namespace Tests\Stubs\Models;

use \Phalcon\Mvc\Model\Row\General as GeneralRow;

class HorseRace extends \Models\HorseRace
{
    use StubDataGetter;

    protected static $_stubData = [
        'horseRaces' => [
            [
                'race_instance_uid' => 608774,
                'horse_uid' => 867979,
                'jockey_uid' => 13317,
                'race_outcome_uid' => 5,
                'final_race_outcome_uid' => 5,
                'dist_to_horse_in_front_uid' => 6,
                'distance_to_winner_uid' => 111,
                'disqualification_uid' => null,
                'stop_watch_rating' => null,
                'weight_carried_lbs' => 131,
                'weight_allowance_lbs' => 0,
                'over_weight_lbs' => 0,
                'extra_weight_lbs' => 0,
                'out_of_handicap_lbs' => 0,
                'horse_head_gear_uid' => null,
                'official_rating_ran_off' => 0,
                'form_rating_chars' => null,
                'form_rating_number' => null,
                'point_to_point_rating' => null,
                'starting_price_odds_uid' => 20,
                'opening_odds_uid' => null,
                'touched_odds_uid' => null,
                'and_odds_uid' => null,
                'draw' => 3,
                'saddle_cloth_no' => 2,
                'saddle_cloth_letter' => null,
                'rp_postmark' => 70,
                'rp_pre_postmark' => 0,
                'rp_pm_chars' => null,
                'rp_topspeed' => 59,
                'forecast_sp_uid' => null,
                'rp_in_places' => null,
                'rp_betting_movements' => null,
                'trainer_uid' => 25628,
                'owner_uid' => 1859,
                'ptp_allowance_lbs' => null,
                'rp_owner_choice' => 'a',
                'subscription_list' => null,
                'rf_form_rt' => null,
                'rf_form_rt_char' => null,
                'rf_speed_rt' => null,
                'rf_speed_rt_char' => null
            ],
            [
                'race_instance_uid' => 609758,
                'horse_uid' => 867979,
                'jockey_uid' => 13317,
                'race_outcome_uid' => 5,
                'final_race_outcome_uid' => 5,
                'dist_to_horse_in_front_uid' => 6,
                'distance_to_winner_uid' => 36,
                'disqualification_uid' => null,
                'stop_watch_rating' => null,
                'weight_carried_lbs' => 131,
                'weight_allowance_lbs' => 0,
                'over_weight_lbs' => 0,
                'extra_weight_lbs' => 0,
                'out_of_handicap_lbs' => 0,
                'horse_head_gear_uid' => null,
                'official_rating_ran_off' => 0,
                'form_rating_chars' => null,
                'form_rating_number' => null,
                'point_to_point_rating' => null,
                'starting_price_odds_uid' => 42,
                'opening_odds_uid' => 17,
                'touched_odds_uid' => 16,
                'and_odds_uid' => null,
                'draw' => 7,
                'saddle_cloth_no' => 1,
                'saddle_cloth_letter' => null,
                'rp_postmark' => 68,
                'rp_pre_postmark' => 71,
                'rp_pm_chars' => null,
                'rp_topspeed' => null,
                'forecast_sp_uid' => null,
                'rp_in_places' => null,
                'rp_betting_movements' => 'op 7/1 tchd 8/1',
                'trainer_uid' => 25628,
                'owner_uid' => 1859,
                'ptp_allowance_lbs' => null,
                'rp_owner_choice' => null,
                'subscription_list' => null,
                'rf_form_rt' => null,
                'rf_form_rt_char' => null,
                'rf_speed_rt' => null,
                'rf_speed_rt_char' => null
            ],
            [
                'race_instance_uid' => 610274,
                'horse_uid' => 867979,
                'jockey_uid' => 76957,
                'race_outcome_uid' => 7,
                'final_race_outcome_uid' => 7,
                'dist_to_horse_in_front_uid' => 9,
                'distance_to_winner_uid' => 656,
                'disqualification_uid' => null,
                'stop_watch_rating' => null,
                'weight_carried_lbs' => 131,
                'weight_allowance_lbs' => 0,
                'over_weight_lbs' => 0,
                'extra_weight_lbs' => 0,
                'out_of_handicap_lbs' => 0,
                'horse_head_gear_uid' => null,
                'official_rating_ran_off' => 0,
                'form_rating_chars' => null,
                'form_rating_number' => null,
                'point_to_point_rating' => null,
                'starting_price_odds_uid' => 1,
                'opening_odds_uid' => 20,
                'touched_odds_uid' => null,
                'and_odds_uid' => null,
                'draw' => 2,
                'saddle_cloth_no' => 1,
                'saddle_cloth_letter' => null,
                'rp_postmark' => 49,
                'rp_pre_postmark' => 71,
                'rp_pm_chars' => null,
                'rp_topspeed' => 13,
                'forecast_sp_uid' => null,
                'rp_in_places' => null,
                'rp_betting_movements' => 'op 16/1',
                'trainer_uid' => 25628,
                'owner_uid' => 1859,
                'ptp_allowance_lbs' => null,
                'rp_owner_choice' => null,
                'subscription_list' => null,
                'rf_form_rt' => null,
                'rf_form_rt_char' => null,
                'rf_speed_rt' => null,
                'rf_speed_rt_char' => null
            ]
        ]
    ];

    /**
     * @param int $horseUid
     *
     * @return array
     */
    public function getByHorseUid($horseUid)
    {
        $result = [];

        foreach (self::getStubData('horseRaces') as $horseRace) {
            if ($horseRace['horse_uid'] == $horseUid) {
                $row = new \Api\Row\HorseRace();

                foreach ($horseRace as $name => $value) {
                    $row->{$name} = $value;
                }

                $result[] = $row;
            }
        }

        return $result;
    }

    public function getHorsesForm(
        array $horsesIds,
        array $raceTypeCodes,
        $raceDate = null
    ) {
        $data = [
            '95a40a662490422b48f63882bebf58c7' => [
                839210 => [
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 839210,
                            'race_instance_uid' => 627960,
                            'race_datetime' => 'Jun 20 2015 2:45PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 1,
                            'race_outcome_form_char' => '1',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 839210,
                            'race_instance_uid' => 627372,
                            'race_datetime' => 'Jun 14 2015 2:00PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 1,
                            'race_outcome_form_char' => '1',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 839210,
                            'race_instance_uid' => 626538,
                            'race_datetime' => 'Jun 6 2015 2:30PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 1,
                            'race_outcome_form_char' => '1',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 839210,
                            'race_instance_uid' => 624433,
                            'race_datetime' => 'May 16 2015 5:45PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 3,
                            'race_outcome_form_char' => '3',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 839210,
                            'race_instance_uid' => 621261,
                            'race_datetime' => 'Apr 11 2015 5:50PM',
                            'race_type_code' => 'X',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => '6',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 839210,
                            'race_instance_uid' => 619247,
                            'race_datetime' => 'Mar 11 2015 5:50PM',
                            'race_type_code' => 'X',
                            'race_outcome_position' => 2,
                            'race_outcome_form_char' => '2',
                        )
                    ),
                ],
                814810 => [
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 814810,
                            'race_instance_uid' => 627357,
                            'race_datetime' => 'Jun 13 2015 5:10PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 1,
                            'race_outcome_form_char' => '1',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 814810,
                            'race_instance_uid' => 626449,
                            'race_datetime' => 'Jun 2 2015 6:20PM',
                            'race_type_code' => 'X',
                            'race_outcome_position' => 2,
                            'race_outcome_form_char' => '2',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 814810,
                            'race_instance_uid' => 625150,
                            'race_datetime' => 'May 22 2015 6:40PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 4,
                            'race_outcome_form_char' => '4',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 814810,
                            'race_instance_uid' => 625041,
                            'race_datetime' => 'May 18 2015 3:30PM',
                            'race_type_code' => 'X',
                            'race_outcome_position' => 9,
                            'race_outcome_form_char' => '0',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 814810,
                            'race_instance_uid' => 624348,
                            'race_datetime' => 'May 11 2015 5:10PM',
                            'race_type_code' => 'X',
                            'race_outcome_position' => 1,
                            'race_outcome_form_char' => '1',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 814810,
                            'race_instance_uid' => 619643,
                            'race_datetime' => 'Mar 19 2015 2:10PM',
                            'race_type_code' => 'X',
                            'race_outcome_position' => 9,
                            'race_outcome_form_char' => '0',
                        )
                    ),

                ],
                801933 => [
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 801933,
                            'race_instance_uid' => 626532,
                            'race_datetime' => 'Jun 5 2015 6:10PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 10,
                            'race_outcome_form_char' => '0',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 801933,
                            'race_instance_uid' => 620176,
                            'race_datetime' => 'Mar 29 2015 5:30PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 15,
                            'race_outcome_form_char' => '0',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 801933,
                            'race_instance_uid' => 608735,
                            'race_datetime' => 'Sep 4 2014 5:10PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 9,
                            'race_outcome_form_char' => '0',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 801933,
                            'race_instance_uid' => 606518,
                            'race_datetime' => 'Aug 3 2014 2:10PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 2,
                            'race_outcome_form_char' => '2',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 801933,
                            'race_instance_uid' => 605676,
                            'race_datetime' => 'Jul 19 2014 9:00PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 4,
                            'race_outcome_form_char' => '4',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 801933,
                            'race_instance_uid' => 600574,
                            'race_datetime' => 'May 12 2014 2:00PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => '5',
                        )
                    ),
                ],
            ],
            'bfc49c5b24d6373a57c19263eb41f399' => [

                103 => [
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 103,
                            'race_instance_uid' => 96436,
                            'race_datetime' => 'Jul 24 1989  4:45PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 7,
                            'race_outcome_form_char' => '0',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 103,
                            'race_instance_uid' => 95716,
                            'race_datetime' => 'Jun 26 1989  6:45PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 14,
                            'race_outcome_form_char' => '0',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 103,
                            'race_instance_uid' => 93929,
                            'race_datetime' => 'Oct 18 1988  2:45PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 9,
                            'race_outcome_form_char' => '0',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 103,
                            'race_instance_uid' => 93805,
                            'race_datetime' => 'Oct 11 1988  4:15PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 8,
                            'race_outcome_form_char' => '0',
                        )
                    ),
                    GeneralRow::createFromArray(
                        array(
                            'horse_uid' => 103,
                            'race_instance_uid' => 93431,
                            'race_datetime' => 'Sep 19 1988  2:00PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => '6',
                        )
                    ),

                ]
            ],
            '2483383d0c0b60b4e17c3f0da7562279' => [],
            '021ba8c815a1a19781759443ebb14fdc' => [],
            '8452463da1ddfa5bf7a27c61a829336e' => [],
            '121f5efacee645b8ad1ed0493f7c7f87' => [
                889897 => [
                    0 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 889897,
                            'race_instance_uid' => 669570,
                            'race_datetime' => 'Feb 25 2017  2:55PM',
                            'race_type_code' => 'X',
                            'race_outcome_position' => 3,
                            'race_outcome_form_char' => '3',
                        ]
                    ),
                    1 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 889897,
                            'race_instance_uid' => 667553,
                            'race_datetime' => 'Jan 20 2017 10:30AM',
                            'race_type_code' => 'X',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => '5',
                        ]
                    ),
                    2 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 889897,
                            'race_instance_uid' => 666803,
                            'race_datetime' => 'Jan  6 2017 11:45AM',
                            'race_type_code' => 'X',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => '5',
                        ]
                    ),
                    3 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 889897,
                            'race_instance_uid' => 665623,
                            'race_datetime' => 'Dec 15 2016  4:15PM',
                            'race_type_code' => 'X',
                            'race_outcome_position' => 14,
                            'race_outcome_form_char' => '0',
                        ]
                    ),
                    4 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 889897,
                            'race_instance_uid' => 653988,
                            'race_datetime' => 'Jul 14 2016  2:50PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 5,
                            'race_outcome_form_char' => '5',
                        ]
                    ),
                    5 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 889897,
                            'race_instance_uid' => 651268,
                            'race_datetime' => 'Jun  8 2016  3:40PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => '6',
                        ]
                    ),
                    6 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 889897,
                            'race_instance_uid' => 648242,
                            'race_datetime' => 'May  6 2016  8:10PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 3,
                            'race_outcome_form_char' => '3',
                        ]
                    ),
                    7 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 889897,
                            'race_instance_uid' => 647705,
                            'race_datetime' => 'Apr 27 2016  5:05PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 2,
                            'race_outcome_form_char' => '2',
                        ]
                    ),
                    8 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 889897,
                            'race_instance_uid' => 645969,
                            'race_datetime' => 'Apr  4 2016  4:50PM',
                            'race_type_code' => 'X',
                            'race_outcome_position' => 4,
                            'race_outcome_form_char' => '4',
                        ]
                    ),
                    9 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 889897,
                            'race_instance_uid' => 633741,
                            'race_datetime' => 'Sep 18 2015  2:30PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 11,
                            'race_outcome_form_char' => '0',
                        ]
                    ),
                    10 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 889897,
                            'race_instance_uid' => 631749,
                            'race_datetime' => 'Aug 12 2015  2:50PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 3,
                            'race_outcome_form_char' => '3',
                        ]
                    ),
                    11 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 889897,
                            'race_instance_uid' => 629480,
                            'race_datetime' => 'Jul 11 2015  4:55PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 7,
                            'race_outcome_form_char' => '0',
                        ]
                    ),
                    12 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 889897,
                            'race_instance_uid' => 626545,
                            'race_datetime' => 'Jun  6 2015  2:35PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 7,
                            'race_outcome_form_char' => '0',
                        ]
                    ),
                    13 => GeneralRow::createFromArray(
                        [
                            'horse_uid' => 889897,
                            'race_instance_uid' => 625145,
                            'race_datetime' => 'May 22 2015  2:30PM',
                            'race_type_code' => 'F',
                            'race_outcome_position' => 1,
                            'race_outcome_form_char' => '1',
                        ]
                    ),
                ],
            ],
            '5c456711bbf0ade357dc4046a8b45342' => [
                1314524 => [
                    0 => GeneralRow::createFromArray([
                        'horse_uid' => 1314524,
                        'race_instance_uid' => 687297,
                        'race_datetime' => 'Nov 15 2017  5:45PM',
                        'race_type_code' => 'X',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => '1',
                    ]),
                    1 => GeneralRow::createFromArray([
                        'horse_uid' => 1314524,
                        'race_instance_uid' => 688335,
                        'race_datetime' => 'Nov  1 2017  1:00PM',
                        'race_type_code' => 'F',
                        'race_outcome_position' => 8,
                        'race_outcome_form_char' => '0',
                    ]),
                ],
                1692228 => [
                    0 => GeneralRow::createFromArray([
                        'horse_uid' => 1692228,
                        'race_instance_uid' => 686328,
                        'race_datetime' => 'Nov  8 2017  1:05PM',
                        'race_type_code' => 'F',
                        'race_outcome_position' => 9,
                        'race_outcome_form_char' => '0',
                    ]),
                ],
            ],

        ];
        $key = md5(serialize([$horsesIds, $raceTypeCodes, $raceDate]));
        return $data[$key];
    }

    public function getStatsLast14Days(?int $trainerId, string $type)
    {
        $data = [
            '14013' => \Api\Row\WinsRuns::createFromArray([
                'runs' => 5,
                'wins' => 1,
            ]),
            '28624' => \Api\Row\WinsRuns::createFromArray([
                'runs' => 6,
                'wins' => 1,
            ]),
        ];
        return $data[$trainerId];
    }

    public function getOwnerStatsLast14Days($ownerId)
    {
        $data = [
            '8295' => \Api\Row\WinsRuns::createFromArray([
                'runs' => 5,
                'wins' => 1,
            ])
        ];
        return $data[$ownerId];
    }

    public function getJockeyStatsLast14Days($jockeyId)
    {
        $data = [
            '80136' => \Api\Row\WinsRuns::createFromArray([
                'runs' => 5,
                'wins' => 1,
            ])
        ];
        return $data[$jockeyId];
    }
}
