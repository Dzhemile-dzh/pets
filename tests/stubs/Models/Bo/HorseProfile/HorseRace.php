<?php

namespace Tests\Stubs\Models\Bo\HorseProfile;

class HorseRace extends \Tests\Stubs\Models\HorseRace
{
    /**
     * @param $horseId
     *
     * @return array
     * @throws \Phalcon\Mvc\Model\Exception
     */
    public function getHorseRacesForPlacings($horseId)
    {
        $data = [
            103 => [
                \Api\Row\HorseRace::createFromArray(
                    [
                        'race_outcome_position' => 7,
                        'race_outcome_form_char' => '0',
                        'race_type_code' => 'F',
                        'race_datetime' => 'Jul 24 1989  4:45PM',
                        'disqualification_desc' => null,
                        'season_start_date' => 'Jan  1 1989 12:00AM',
                    ]
                ),
                \Api\Row\HorseRace::createFromArray(
                    [
                        'race_outcome_position' => 14,
                        'race_outcome_form_char' => '0',
                        'race_type_code' => 'F',
                        'race_datetime' => 'Jun 26 1989  6:45PM',
                        'disqualification_desc' => null,
                        'season_start_date' => 'Jan  1 1989 12:00AM',
                    ]
                ),
                \Api\Row\HorseRace::createFromArray(
                    [
                        'race_outcome_position' => 9,
                        'race_outcome_form_char' => "0",
                        'race_type_code' => "F",
                        'race_datetime' => "Oct 18 1988  2:45PM",
                        'disqualification_desc' => null,
                        'season_start_date' => "Jan  1 1988 12:00AM",
                    ]
                ),
                \Api\Row\HorseRace::createFromArray(
                    [
                        'race_outcome_position' => 8,
                        'race_outcome_form_char' => "0",
                        'race_type_code' => "F",
                        'race_datetime' => "Oct 11 1988  4:15PM",
                        'disqualification_desc' => null,
                        'season_start_date' => "Jan  1 1988 12:00AM",
                    ]
                ),
                \Api\Row\HorseRace::createFromArray(
                    [
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => "6",
                        'race_type_code' => "F",
                        'race_datetime' => "Sep 19 1988  2:00PM",
                        'disqualification_desc' => null,
                        'season_start_date' => "Jan  1 1988 12:00AM",
                    ]
                ),
            ],
            685141 => [
                \Api\Row\HorseRace::createFromArray(
                    [
                        'race_outcome_position' => 10,
                        'race_outcome_form_char' => '0',
                        'race_type_code' => 'X',
                        'race_datetime' => 'Nov 22 2009 10:02PM',
                        'disqualification_desc' => null,
                        'season_start_date' => 'Jan  1 2009 12:00AM',
                    ]
                ),
                \Api\Row\HorseRace::createFromArray(
                    [
                        'race_outcome_position' => 9,
                        'race_outcome_form_char' => '0',
                        'race_type_code' => 'F',
                        'race_datetime' => 'Oct  4 2008 11:07AM',
                        'disqualification_desc' => null,
                        'season_start_date' => 'Jan  1 2008 12:00AM',
                    ]
                ),
                \Api\Row\HorseRace::createFromArray(
                    [
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => '5',
                        'race_type_code' => 'X',
                        'race_datetime' => 'Aug 28 2008 11:07AM',
                        'disqualification_desc' => null,
                        'season_start_date' => 'Jan  1 2008 12:00AM',
                    ]
                ),
                \Api\Row\HorseRace::createFromArray(
                    [
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => '3',
                        'race_type_code' => 'X',
                        'race_datetime' => 'Aug  1 2008 10:07AM',
                        'disqualification_desc' => null,
                        'season_start_date' => 'Jan  1 2008 12:00AM',
                    ]
                ),
                \Api\Row\HorseRace::createFromArray(
                    [
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => '5',
                        'race_type_code' => 'F',
                        'race_datetime' => 'Apr 23 2008 11:07AM',
                        'disqualification_desc' => null,
                        'season_start_date' => 'Jan  1 2008 12:00AM',
                    ]
                ),
                \Api\Row\HorseRace::createFromArray(
                    [
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => '5',
                        'race_type_code' => 'X',
                        'race_datetime' => 'Feb 24 2008 11:07AM',
                        'disqualification_desc' => null,
                        'season_start_date' => 'Jan  1 2008 12:00AM',
                    ]
                ),
                \Api\Row\HorseRace::createFromArray(
                    [
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => '6',
                        'race_type_code' => 'F',
                        'race_datetime' => 'Jan 19 2008 10:07AM',
                        'disqualification_desc' => null,
                        'season_start_date' => 'Jan  1 2008 12:00AM',
                    ]
                ),
                \Api\Row\HorseRace::createFromArray(
                    [
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => '2',
                        'race_type_code' => 'X',
                        'race_datetime' => 'Dec 29 2007 12:07AM',
                        'disqualification_desc' => null,
                        'season_start_date' => 'Jan  1 2007 12:00AM',
                    ]
                ),
                \Api\Row\HorseRace::createFromArray(
                    [
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => '3',
                        'race_type_code' => 'F',
                        'race_datetime' => 'Jul  1 2007  9:07AM',
                        'disqualification_desc' => null,
                        'season_start_date' => 'Jan  1 2007 12:00AM',
                    ]
                ),
            ]
        ];

        return $data[$horseId];
    }

    /**
     * @param $jockeyUid
     *
     * @return static
     */
    public function getJockeyStatsLast14Days($jockeyUid)
    {
        return \Phalcon\Mvc\Model\Row\General::createFromArray(
            [
                'runs' => 4,
                'wins' => 0,
            ]
        );
    }

    /**
     * @param $horseId
     *
     * @return array
     */
    public function getPreviousTrainers($horseId)
    {
        return [
            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    "trainer_uid" => 25628,
                    "trainer_change_date" => "2015-06-13T13:12:00+01:00",
                    "trainer_style_name" => "Charles Hills",
                    "search_name" => "Charles Hills",
                    "ptp_type_code" => "G"
                ]
            ),
            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    "trainer_uid" => 20045,
                    "trainer_change_date" => "2015-01-08T13:12:00+00:00",
                    "trainer_style_name" => "Ruth Carr",
                    "search_name" => "Ruth Carr",
                    "ptp_type_code" => "N"
                ]
            ),
        ];
    }

    /**
     * @param $horseId
     *
     * @return array
     */
    public function getPreviousOwners($horseId)
    {
        return array(
            0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    "owner_uid" => 118633,
                    "owner_change_date" => "2010-04-13T13:38:00+01:00",
                    "owner_style_name" => "Mrs Heather de Bromhead",
                    "search_name" => "Mrs Heather de Bromhead",
                    "ptp_type_code" => "N"
                ]
            ),
            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    "owner_uid" => 170865,
                    "owner_change_date" => "2009-12-17T13:18:00+00:00",
                    "owner_style_name" => "Ms H Debromhead",
                    "search_name" => "Ms H Debromhead",
                    "ptp_type_code" => "I"
                ]
            )
        );
    }

    /**
     * Get races for generating form figures.
     *
     * @param array $horsesIds
     * @param array $raceTypeCodes
     * @param       $raceDate
     *
     * @return array
     */
    public function getHorsesForm(array $horsesIds, array $raceTypeCodes, $raceDate = null)
    {
        $data = [
            'bfc49c5b24d6373a57c19263eb41f399' => array(
                103 =>
                    array(
                        0 =>
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'horse_uid' => 103,
                                    'race_instance_uid' => 96436,
                                    'race_datetime' => 'Jul 24 1989  4:45PM',
                                    'race_type_code' => 'F',
                                    'race_outcome_position' => 7,
                                    'race_outcome_form_char' => '0',
                                )
                            ),
                        1 =>
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'horse_uid' => 103,
                                    'race_instance_uid' => 95716,
                                    'race_datetime' => 'Jun 26 1989  6:45PM',
                                    'race_type_code' => 'F',
                                    'race_outcome_position' => 14,
                                    'race_outcome_form_char' => '0',
                                )
                            ),
                        2 =>
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'horse_uid' => 103,
                                    'race_instance_uid' => 93929,
                                    'race_datetime' => 'Oct 18 1988  2:45PM',
                                    'race_type_code' => 'F',
                                    'race_outcome_position' => 9,
                                    'race_outcome_form_char' => '0',
                                )
                            ),
                        3 =>
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'horse_uid' => 103,
                                    'race_instance_uid' => 93805,
                                    'race_datetime' => 'Oct 11 1988  4:15PM',
                                    'race_type_code' => 'F',
                                    'race_outcome_position' => 8,
                                    'race_outcome_form_char' => '0',
                                )
                            ),
                        4 =>
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'horse_uid' => 103,
                                    'race_instance_uid' => 93431,
                                    'race_datetime' => 'Sep 19 1988  2:00PM',
                                    'race_type_code' => 'F',
                                    'race_outcome_position' => 6,
                                    'race_outcome_form_char' => '6',
                                )
                            ),
                    ),
            ),
            '2483383d0c0b60b4e17c3f0da7562279' => array(),
            '8452463da1ddfa5bf7a27c61a829336e' => array(
                685141 =>
                    array(
                        0 =>
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'horse_uid' => 685141,
                                    'race_instance_uid' => 495456,
                                    'race_datetime' => 'Nov 22 2009 10:02PM',
                                    'race_type_code' => 'X',
                                    'race_outcome_position' => 10,
                                    'race_outcome_form_char' => '0',
                                )
                            ),
                        1 =>
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'horse_uid' => 685141,
                                    'race_instance_uid' => 467515,
                                    'race_datetime' => 'Oct  4 2008 11:07AM',
                                    'race_type_code' => 'F',
                                    'race_outcome_position' => 9,
                                    'race_outcome_form_char' => '0',
                                )
                            ),
                        2 =>
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'horse_uid' => 685141,
                                    'race_instance_uid' => 465468,
                                    'race_datetime' => 'Aug 28 2008 11:07AM',
                                    'race_type_code' => 'X',
                                    'race_outcome_position' => 5,
                                    'race_outcome_form_char' => '5',
                                )
                            ),
                        3 =>
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'horse_uid' => 685141,
                                    'race_instance_uid' => 468483,
                                    'race_datetime' => 'Aug  1 2008 10:07AM',
                                    'race_type_code' => 'X',
                                    'race_outcome_position' => 3,
                                    'race_outcome_form_char' => '3',
                                )
                            ),
                        4 =>
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'horse_uid' => 685141,
                                    'race_instance_uid' => 456862,
                                    'race_datetime' => 'Apr 23 2008 11:07AM',
                                    'race_type_code' => 'F',
                                    'race_outcome_position' => 5,
                                    'race_outcome_form_char' => '5',
                                )
                            ),
                        5 =>
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'horse_uid' => 685141,
                                    'race_instance_uid' => 451070,
                                    'race_datetime' => 'Feb 24 2008 11:07AM',
                                    'race_type_code' => 'X',
                                    'race_outcome_position' => 5,
                                    'race_outcome_form_char' => '5',
                                )
                            ),
                        6 =>
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'horse_uid' => 685141,
                                    'race_instance_uid' => 853736,
                                    'race_datetime' => 'Jan 19 2008 10:07AM',
                                    'race_type_code' => 'F',
                                    'race_outcome_position' => 6,
                                    'race_outcome_form_char' => '6',
                                )
                            ),
                        7 =>
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'horse_uid' => 685141,
                                    'race_instance_uid' => 447554,
                                    'race_datetime' => 'Dec 29 2007 12:07AM',
                                    'race_type_code' => 'X',
                                    'race_outcome_position' => 2,
                                    'race_outcome_form_char' => '2',
                                )
                            ),
                        8 =>
                            \Phalcon\Mvc\Model\Row\General::createFromArray(
                                array(
                                    'horse_uid' => 685141,
                                    'race_instance_uid' => 439524,
                                    'race_datetime' => 'Jul  1 2007  9:07AM',
                                    'race_type_code' => 'F',
                                    'race_outcome_position' => 3,
                                    'race_outcome_form_char' => '3',
                                )
                            ),
                    ),
            ),
            '021ba8c815a1a19781759443ebb14fdc' => array(),

        ];
        $key = md5(serialize([$horsesIds, $raceTypeCodes, $raceDate]));
        return $data[$key];
    }
}
