<?php

namespace Tests\Stubs\Models\Bo\TrainerProfile;

use \Phalcon\Mvc\Model\Row\General as GeneralRow;

class HorseRace extends \Tests\Stubs\Models\HorseRace
{
    /**
     * @param $trainerUid
     *
     * @return static
     */
    public function getRunningToForm($trainerUid)
    {
        if (is_array($trainerUid)) {
            $trainerUid = current($trainerUid);
        }

        $data = [
            28624 => [
                28624 => [
                    'races' =>
                        [
                            GeneralRow::createFromArray(
                                [
                                    'race_instance_uid' => 637785,
                                    'race_datetime' => 'Nov 20 2015  1:30PM',
                                    'race_outcome_position' => 4,
                                    'race_outcome_form_char' => '4',
                                    'rp_postmark' => 131,
                                    'rp_pre_postmark' => 135,
                                    'race_distance' => 4135,
                                    'dist_to_winner' => 12.5,
                                    'race_group_uid' => 0,
                                    'runners' => 4,
                                ]
                            ),
                            GeneralRow::createFromArray(
                                [
                                    'race_instance_uid' => 637789,
                                    'race_datetime' => 'Nov 20 2015  3:50PM',
                                    'race_outcome_position' => 4,
                                    'race_outcome_form_char' => '4',
                                    'rp_postmark' => 140,
                                    'rp_pre_postmark' => 144,
                                    'race_distance' => 3452,
                                    'dist_to_winner' => 13,
                                    'race_group_uid' => 6,
                                    'runners' => 11,
                                ]
                            ),
                            GeneralRow::createFromArray(
                                [
                                    'race_instance_uid' => 637265,
                                    'race_datetime' => 'Nov 21 2015  2:25PM',
                                    'race_outcome_position' => 0,
                                    'race_outcome_form_char' => 'P',
                                    'rp_postmark' => 0,
                                    'rp_pre_postmark' => 143,
                                    'race_distance' => 5017,
                                    'dist_to_winner' => 0,
                                    'race_group_uid' => 13,
                                    'runners' => 16,
                                ]
                            ),
                            GeneralRow::createFromArray(
                                [
                                    'race_instance_uid' => 637806,
                                    'race_datetime' => 'Nov 21 2015  2:40PM',
                                    'race_outcome_position' => 4,
                                    'race_outcome_form_char' => '4',
                                    'rp_postmark' => 147,
                                    'rp_pre_postmark' => 152,
                                    'race_distance' => 4238,
                                    'dist_to_winner' => 5,
                                    'race_group_uid' => 8,
                                    'runners' => 6,
                                ]
                            ),
                            GeneralRow::createFromArray(
                                [
                                    'race_instance_uid' => 637819,
                                    'race_datetime' => 'Nov 21 2015  3:25PM',
                                    'race_outcome_position' => 1,
                                    'race_outcome_form_char' => '1',
                                    'rp_postmark' => 125,
                                    'rp_pre_postmark' => 115,
                                    'race_distance' => 3008,
                                    'dist_to_winner' => 0,
                                    'race_group_uid' => 0,
                                    'runners' => 10,
                                ]
                            ),
                            GeneralRow::createFromArray(
                                [
                                    'race_instance_uid' => 638205,
                                    'race_datetime' => 'Nov 23 2015  1:35PM',
                                    'race_outcome_position' => 2,
                                    'race_outcome_form_char' => '2',
                                    'rp_postmark' => 141,
                                    'rp_pre_postmark' => 141,
                                    'race_distance' => 3520,
                                    'dist_to_winner' => 19,
                                    'race_group_uid' => 0,
                                    'runners' => 5,
                                ]
                            ),
                            GeneralRow::createFromArray(
                                [
                                    'race_instance_uid' => 638212,
                                    'race_datetime' => 'Nov 23 2015  2:20PM',
                                    'race_outcome_position' => 5,
                                    'race_outcome_form_char' => '5',
                                    'rp_postmark' => 119,
                                    'rp_pre_postmark' => 123,
                                    'race_distance' => 3512,
                                    'dist_to_winner' => 26.75,
                                    'race_group_uid' => 6,
                                    'runners' => 9,
                                ]
                            ),
                            GeneralRow::createFromArray(
                                [
                                    'race_instance_uid' => 637736,
                                    'race_datetime' => 'Nov 28 2015  2:05PM',
                                    'race_outcome_position' => 4,
                                    'race_outcome_form_char' => '4',
                                    'rp_postmark' => 138,
                                    'rp_pre_postmark' => 158,
                                    'race_distance' => 3618,
                                    'dist_to_winner' => 26.25,
                                    'race_group_uid' => 7,
                                    'runners' => 7,
                                ]
                            ),
                            GeneralRow::createFromArray(
                                [
                                    'race_instance_uid' => 638287,
                                    'race_datetime' => 'Nov 28 2015  2:25PM',
                                    'race_outcome_position' => 4,
                                    'race_outcome_form_char' => '4',
                                    'rp_postmark' => 149,
                                    'rp_pre_postmark' => 152,
                                    'race_distance' => 5332,
                                    'dist_to_winner' => 7,
                                    'race_group_uid' => 8,
                                    'runners' => 5,
                                ]
                            ),
                            GeneralRow::createFromArray(
                                [
                                    'race_instance_uid' => 638280,
                                    'race_datetime' => 'Nov 28 2015  2:30PM',
                                    'race_outcome_position' => 1,
                                    'race_outcome_form_char' => '1',
                                    'rp_postmark' => 132,
                                    'rp_pre_postmark' => 132,
                                    'race_distance' => 4300,
                                    'dist_to_winner' => 0,
                                    'race_group_uid' => 6,
                                    'runners' => 9,
                                ]
                            ),
                            GeneralRow::createFromArray(
                                [
                                    'race_instance_uid' => 638719,
                                    'race_datetime' => 'Dec  2 2015  1:20PM',
                                    'race_outcome_position' => 1,
                                    'race_outcome_form_char' => '1',
                                    'rp_postmark' => 116,
                                    'rp_pre_postmark' => 0,
                                    'race_distance' => 3456,
                                    'dist_to_winner' => 0,
                                    'race_group_uid' => 0,
                                    'runners' => 9,
                                ]
                            ),
                            GeneralRow::createFromArray(
                                [
                                    'race_instance_uid' => 638737,
                                    'race_datetime' => 'Dec  3 2015 12:05PM',
                                    'race_outcome_position' => 1,
                                    'race_outcome_form_char' => '1',
                                    'rp_postmark' => 113,
                                    'rp_pre_postmark' => 0,
                                    'race_distance' => 3668,
                                    'dist_to_winner' => 0,
                                    'race_group_uid' => 0,
                                    'runners' => 9,
                                ]
                            ),
                        ]

                ]
            ],
            373 => [
                373 => [
                    'races' => [
                        GeneralRow::createFromArray([
                            'race_instance_uid' => 686322,
                            'race_datetime' => 'Nov  7 2017 12:50PM',
                            'race_outcome_position' => 2,
                            'race_outcome_form_char' => '2',
                            'rp_postmark' => 53,
                            'rp_pre_postmark' => 56,
                            'race_distance' => 1759,
                            'dist_to_winner' => 3.25,
                            'race_group_uid' => 0,
                            'runners' => 8,
                        ]),
                        GeneralRow::createFromArray([
                            'race_instance_uid' => 686325,
                            'race_datetime' => 'Nov  8 2017  2:50PM',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => '6',
                            'rp_postmark' => 69,
                            'rp_pre_postmark' => 77,
                            'race_distance' => 1108,
                            'dist_to_winner' => 4.25,
                            'race_group_uid' => 6,
                            'runners' => 10,
                        ]),
                        GeneralRow::createFromArray([
                            'race_instance_uid' => 687295,
                            'race_datetime' => 'Nov 15 2017  4:15PM',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => '6',
                            'rp_postmark' => 39,
                            'rp_pre_postmark' => 60,
                            'race_distance' => 1554,
                            'dist_to_winner' => 13.75,
                            'race_group_uid' => 0,
                            'runners' => 10,
                        ]),
                        GeneralRow::createFromArray([
                            'race_instance_uid' => 687299,
                            'race_datetime' => 'Nov 15 2017  4:45PM',
                            'race_outcome_position' => 9,
                            'race_outcome_form_char' => '9',
                            'rp_postmark' => 23,
                            'rp_pre_postmark' => 49,
                            'race_distance' => 1100,
                            'dist_to_winner' => 9.75,
                            'race_group_uid' => 6,
                            'runners' => 12,
                        ]),
                        GeneralRow::createFromArray([
                            'race_instance_uid' => 687297,
                            'race_datetime' => 'Nov 15 2017  5:45PM',
                            'race_outcome_position' => 1,
                            'race_outcome_form_char' => '1',
                            'rp_postmark' => 81,
                            'rp_pre_postmark' => 53,
                            'race_distance' => 1765,
                            'dist_to_winner' => 0,
                            'race_group_uid' => 0,
                            'runners' => 6,
                        ]),
                        GeneralRow::createFromArray([
                            'race_instance_uid' => 687303,
                            'race_datetime' => 'Nov 16 2017  1:15PM',
                            'race_outcome_position' => 7,
                            'race_outcome_form_char' => '7',
                            'rp_postmark' => 6,
                            'rp_pre_postmark' => 63,
                            'race_distance' => 1554,
                            'dist_to_winner' => 22.5,
                            'race_group_uid' => 0,
                            'runners' => 8,
                        ]),
                        GeneralRow::createFromArray([
                            'race_instance_uid' => 687329,
                            'race_datetime' => 'Nov 18 2017  3:15PM',
                            'race_outcome_position' => 2,
                            'race_outcome_form_char' => '2',
                            'rp_postmark' => 106,
                            'rp_pre_postmark' => 111,
                            'race_distance' => 1321,
                            'dist_to_winner' => 1.5,
                            'race_group_uid' => 4,
                            'runners' => 10,
                        ]),
                        GeneralRow::createFromArray([
                            'race_instance_uid' => 689605,
                            'race_datetime' => 'Nov 18 2017  7:45PM',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => '6',
                            'rp_postmark' => 59,
                            'rp_pre_postmark' => 36,
                            'race_distance' => 1340,
                            'dist_to_winner' => 6.25,
                            'race_group_uid' => 0,
                            'runners' => 11,
                        ]),
                    ]
                ]
            ],
            5863 => [
                5863 => [
                    'races' => [
                        GeneralRow::createFromArray([
                            'race_instance_uid' => 686328,
                            'race_datetime' => 'Nov  8 2017  1:05PM',
                            'race_outcome_position' => 9,
                            'race_outcome_form_char' => '9',
                            'rp_postmark' => 57,
                            'rp_pre_postmark' => 0,
                            'race_distance' => 1835,
                            'dist_to_winner' => 13.75,
                            'race_group_uid' => 0,
                            'runners' => 14,
                        ]),
                        GeneralRow::createFromArray([
                            'race_instance_uid' => 688836,
                            'race_datetime' => 'Nov  8 2017  1:40PM',
                            'race_outcome_position' => 4,
                            'race_outcome_form_char' => '4',
                            'rp_postmark' => 70,
                            'rp_pre_postmark' => 66,
                            'race_distance' => 1835,
                            'dist_to_winner' => 2.75,
                            'race_group_uid' => 0,
                            'runners' => 14,
                        ]),
                        GeneralRow::createFromArray([
                            'race_instance_uid' => 686479,
                            'race_datetime' => 'Nov  9 2017  5:45PM',
                            'race_outcome_position' => 6,
                            'race_outcome_form_char' => '6',
                            'rp_postmark' => 57,
                            'rp_pre_postmark' => 76,
                            'race_distance' => 1320,
                            'dist_to_winner' => 7,
                            'race_group_uid' => 6,
                            'runners' => 9,
                        ]),
                        GeneralRow::createFromArray([
                            'race_instance_uid' => 687336,
                            'race_datetime' => 'Nov 18 2017  7:15PM',
                            'race_outcome_position' => 3,
                            'race_outcome_form_char' => '3',
                            'rp_postmark' => 58,
                            'rp_pre_postmark' => 0,
                            'race_distance' => 1340,
                            'dist_to_winner' => 5.25,
                            'race_group_uid' => 0,
                            'runners' => 11,
                        ]),
                        GeneralRow::createFromArray([
                            'race_instance_uid' => 689605,
                            'race_datetime' => 'Nov 18 2017  7:45PM',
                            'race_outcome_position' => 1,
                            'race_outcome_form_char' => '1',
                            'rp_postmark' => 78,
                            'rp_pre_postmark' => 71,
                            'race_distance' => 1340,
                            'dist_to_winner' => 0,
                            'race_group_uid' => 0,
                            'runners' => 11,
                        ]),
                        GeneralRow::createFromArray([
                            'race_instance_uid' => 689653,
                            'race_datetime' => 'Nov 20 2017  4:00PM',
                            'race_outcome_position' => 3,
                            'race_outcome_form_char' => '3',
                            'rp_postmark' => 0,
                            'rp_pre_postmark' => 76,
                            'race_distance' => 1340,
                            'dist_to_winner' => 0,
                            'race_group_uid' => 6,
                            'runners' => 13,
                        ]),
                    ]
                ]

            ],
        ];
        return $data[$trainerUid];
    }
}
