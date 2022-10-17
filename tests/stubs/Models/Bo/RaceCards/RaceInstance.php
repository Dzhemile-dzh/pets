<?php

namespace Tests\Stubs\Models\Bo\RaceCards;

use \Api\Row\RaceInstance as RiRow;
use \Phalcon\Mvc\Model\Row\General;
use Api\Row\RaceCards\Stats;
use \Api\Row\RaceCards\Selections;

/**
 * Class RaceInstance
 *
 * @package Tests\Stubs\Models\Bo\RaceCards
 */
class RaceInstance extends \Tests\Stubs\Models\RaceInstance
{

    public function getPublishTime()
    {
       return (object)['race_content_publish_time' => 'Jul  2 2016  6:55PM',];
    }

    /**
     * @param int $raceInstanceUid
     *
     * @return \Phalcon\Mvc\ModelInterface
     */
    public function getRaceInstance($raceInstanceUid)
    {
        $data = [
            655010 => [
                'race_type_code' => 'H',
                'race_datetime' => 'Jul  2 2016  6:55PM',
                'race_status_code' => 'O',
                'race_group_code' => 'H',
                'course_uid' => 176,
                'rp_abbrev_3' => 'BEL',
                'country_code' => 'IRE',
                'going_type_code' => 'Y',
                'distance_yard' => 4400,
                'course_name' => 'BELLEWSTOWN',
                'course_uid1' => 176,
                'course_style_name' => 'Bellewstown',
                'going_type_code2' => 'Y ',
                'declared_runners' => 22,
                'no_of_runners' => 22,
                'going_type_desc' => 'Standard',
                'rp_tv_text' => 'ATR',
            ],
            614973 => [
                'race_type_code' => 'F',
                'race_datetime' => 'Dec 17 2014  5:40PM',
                'race_status_code' => 'O',
                'race_group_code' => '0',
                'course_uid' => 47,
                'rp_abbrev_3' => 'RED',
                'country_code' => 'GB',
                'going_type_code' => 'S',
                'distance_yard' => 1540,
            ],
            614944 => [
                'race_type_code' => 'C',
                'race_datetime' => 'Dec 17 2014  2:25PM',
                'race_status_code' => 'R',
                'race_group_code' => 'H',
                'course_uid' => 34,
                'rp_abbrev_3' => 'LUD',
                'country_code' => 'GB',
                'going_type_code' => 'GS',
                'distance_yard' => 5280,
            ],
            632531 => [
                'race_type_code' => 'F',
                'race_datetime' => 'Aug 26 2015  5:35PM',
                'race_status_code' => 'O',
                'race_group_code' => 'H',
                'course_uid' => 5,
                'rp_abbrev_3' => 'BAT',
                'country_code' => 'GB',
                'going_type_code' => 'GS',
                'distance_yard' => 1261,
            ],
            636281 => [
                'race_type_code' => 'F',
                'race_datetime' => 'Jun 25 2015  6:10PM',
                'race_status_code' => 'O',
                'race_group_code' => 'H',
                'course_uid' => 22,
                'rp_abbrev_3' => 'HAM',
                'country_code' => 'GB',
                'going_type_code' => 'G',
                'distance_yard' => 2869,
            ],
            637256 => [
                'race_type_code' => 'F',
                'race_datetime' => 'Jun 25 2015  6:10PM',
                'race_status_code' => 'O',
                'race_group_code' => 'H',
                'course_uid' => 22,
                'rp_abbrev_3' => 'HAM',
                'country_code' => 'GB',
                'going_type_code' => 'G',
                'distance_yard' => 2869,
            ],
            661043 => [
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
            ],
            671235 => [
                'race_type_code' => 'X',
                'race_datetime' => 'Apr 14 2017  1:40PM',
                'race_status_code' => 'O',
                'distance_yard' => 1541,
                'race_group_code' => 'H',
                'course_uid' => 393,
                'rp_abbrev_3' => 'LIN',
                'country_code' => 'GB',
                'course_name' => 'LINGFIELD (A.W)',
                'course_style_name' => 'Lingfield (A.W)',
                'going_type_code' => 'SD',
                'going_type_desc' => 'Standard',
                'declared_runners' => 40,
                'no_of_runners' => 40,
                'distance_yard1' => 1541,
                'rp_tv_text' => 'ATR',
            ],
            670447 => [
                'race_type_code' => 'X',
                'race_datetime' => 'Mar  9 2017  6:00PM',
                'race_status_code' => 'R',
                'distance_yard' => 1760,
                'race_group_code' => 'H',
                'course_uid' => 1231,
                'rp_abbrev_3' => 'Mey',
                'country_code' => 'UAE',
                'course_name' => 'MEYDAN',
                'course_style_name' => 'Meydan',
                'going_type_code' => 'FT',
                'going_type_desc' => 'Fast',
                'declared_runners' => 15,
                'no_of_runners' => 15,
                'distance_yard1' => 1760,
                'rp_tv_text' => 'AR/RU',
            ],
            671692 => [
                'race_type_code' => 'C',
                'race_datetime' => 'Apr 21 2017  3:50PM',
                'race_status_code' => 'O',
                'distance_yard' => 4510,
                'race_group_code' => 'H',
                'course_uid' => 3,
                'rp_abbrev_3' => 'AYR',
                'country_code' => 'GB',
                'course_name' => 'AYR',
                'course_style_name' => 'Ayr',
                'going_type_code' => 'GS',
                'going_type_desc' => 'Good To Soft',
                'declared_runners' => 29,
                'no_of_runners' => 29,
                'distance_yard1' => 4510,
                'rp_tv_text' => 'RUK',
            ],
            688111 => [
                'race_type_code' => 'X',
                'race_datetime' => 'Nov 23 2017  6:30PM',
                'race_status_code' => '4',
                'distance_yard' => 1760,
                'race_group_code' => '0',
                'course_uid' => 1083,
                'rp_abbrev_3' => 'Cfd',
                'country_code' => 'GB',
                'course_name' => 'CHELMSFORD (A.W)',
                'course_style_name' => 'Chelmsford (A.W)',
                'going_type_code' => 'SD',
                'going_type_desc' => 'Standard',
                'declared_runners' => 25,
                'no_of_runners' => 25,
                'distance_yard1' => 1760,
                'rp_tv_text' => 'ATR',
            ],
            1 => [],
        ];

        return empty($data[$raceInstanceUid]) ? null : RiRow::createFromArray($data[$raceInstanceUid]);
    }

    /**
     * @param array             $trainerIds
     * @param string            $startDate
     * @param array             $raceTypeCode
     * @param int               $courseId
     * @param string            $rpAbbrev3
     * @param \Models\Selectors $selectors
     *
     * @return \Phalcon\Mvc\Model\Resultset\General
     */
    public function getTrainerStatisticsOverall(
        array $trainerIds,
        $startDate,
        array $raceTypeCode,
        $courseId,
        $rpAbbrev3,
        $selectors
    ) {
        $data = [
            'b25d3a2082354b3367754f0bf26dd711' => [
                5372 => Stats::createFromArray(
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
                67 => Stats::createFromArray(
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
            ],
            'e700b29ac5e0ab6ec67a610b453762f7' => [
                35 => Stats::createFromArray(
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
                135 => Stats::createFromArray(
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
            ],
        ];

        $args = func_get_args();
        $args = array_shift($args);

        return $data[md5(serialize($args))];
    }

    /**
     * @param array  $trainerIds
     * @param string $startDate
     * @param array  $raceTypeCode
     *
     * @return \Phalcon\Mvc\Model\Resultset\General
     */
    public function getTrainerStatisticsLast14Days(
        $trainerIds,
        $startDate,
        array $raceTypeCode
    ) {
        $data = [
            '6a30957c15b4977344cdd609fc432122' => [
                5372 => Stats::createFromArray(
                    [
                        'trainer_uid' => 5372,
                        'wins' => 0,
                        'runs' => 7,
                        'profit' => -7,
                    ]
                )
                ,
                67 => Stats::createFromArray(
                    [
                        'trainer_uid' => 67,
                        'wins' => 1,
                        'runs' => 18,
                        'profit' => -15,
                    ]
                ),
            ],
            '21fae47997106781a18e4c9b5390bd60' => [
                35 => Stats::createFromArray(
                    [
                        'trainer_uid' => 35,
                        'wins' => 0,
                        'runs' => 3,
                        'profit' => -3,
                    ]
                )
                ,
                135 => Stats::createFromArray(
                    [
                        'trainer_uid' => 135,
                        'wins' => 8,
                        'runs' => 29,
                        'profit' => 0.76600000000000001,
                    ]
                ),
            ],
        ];
        $key = md5(serialize($trainerIds) . serialize($raceTypeCode));

        return $data[$key];
    }


    /**
     * @param array             $jockeyIds
     * @param string            $startDate
     * @param array             $raceTypeCode
     * @param int               $courseId
     * @param string            $rpAbbrev3
     * @param \Models\Selectors $selectors
     *
     * @return \Phalcon\Mvc\Model\Resultset\General
     */
    public function getJockeyStatisticsOverall(
        array $jockeyIds,
        $startDate,
        array $raceTypeCode,
        $courseId,
        $rpAbbrev3,
        $selectors
    ) {
        $data = [
            '8905908b5f80647ce42582c247fd8d6e' => [
                76872 => Stats::createFromArray(
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
                84857 => Stats::createFromArray(
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
            ],
            '2c3310a723f868e4289055b33fd8de66' => [
                12290 => Stats::createFromArray(
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
                )
                ,
                14447 => Stats::createFromArray(
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
            ],
        ];

        $args = func_get_args();
        $args = array_shift($args);

        return $data[md5(serialize($args))];
    }

    /**
     * @param array  $jockeyIds
     * @param string $startDate
     * @param array  $raceTypeCode
     *
     * @return \Phalcon\Mvc\Model\Resultset\General
     */
    public function getJockeyStatisticsLast14Days(
        array $jockeyIds,
        $startDate,
        array $raceTypeCode
    ) {
        $data = [
            '1562001939406953d83e907027925e90' => [
                76872 => Stats::createFromArray(
                    [
                        'jockey_uid' => 76872,
                        'wins' => 0,
                        'runs' => 3,
                        'profit' => -3,
                    ]
                ),
                84857 => Stats::createFromArray(
                    [
                        'jockey_uid' => 84857,
                        'wins' => 5,
                        'runs' => 61,
                        'profit' => -42.875,
                    ]
                ),
            ],
            '78f19a917230cbfac8a946db70fb04a3' => [
                12290 => Stats::createFromArray(
                    [
                        'jockey_uid' => 12290,
                        'wins' => 20,
                        'runs' => 63,
                        'profit' => 10.629,
                    ]
                ),
                14447 => Stats::createFromArray(
                    [
                        'jockey_uid' => 14447,
                        'wins' => 4,
                        'runs' => 36,
                        'profit' => -22.091000000000001,
                    ]
                ),
            ],
        ];
        $key = md5(serialize($jockeyIds) . serialize($raceTypeCode));

        return $data[$key];
    }


    /**
     * @param int    $horseIds
     * @param string $startDate
     * @param array  $raceTypeCode
     * @param string $goingTypeCode
     *
     * @return \Phalcon\Mvc\Model\Resultset\General
     */
    public function getHorseStatisticsByGoingType(
        $horseIds,
        $startDate,
        array $raceTypeCode,
        $goingTypeCode
    ) {
        $data = [
            '4b8fb4a04a775dac11005817f1d97aa3' => [
                881328 => Stats::createFromArray(
                    [
                        'horse_uid' => 881328,
                        'runs' => 1,
                        'wins' => 0,
                    ]
                ),
            ],
            'f3b82e00fab0ae32da99c6805f2ca9c7' => [
                836091 => Stats::createFromArray(
                    [
                        'horse_uid' => 836091,
                        'runs' => 2,
                        'wins' => 0,
                    ]
                )
                ,
                872816 => Stats::createFromArray(
                    [
                        'horse_uid' => 872816,
                        'runs' => 2,
                        'wins' => 0,
                    ]
                ),
            ],
        ];
        $key = md5(serialize(func_get_args()));

        return $data[$key];
    }

    /**
     * @param int    $horseIds
     * @param string $startDate
     * @param array  $raceTypeCode
     * @param int    $minDistance
     * @param int    $maxDistance
     *
     * @return \Phalcon\Mvc\Model\Resultset\General
     */
    public function getHorseStatisticsByDistance(
        $horseIds,
        $startDate,
        array $raceTypeCode,
        $minDistance,
        $maxDistance
    ) {
        $data = [
            '7e708f700cf9a37fefba025f3df1e816' => [
                436302 => Stats::createFromArray(
                    [
                        'horse_uid' => 436302,
                        'runs' => 1,
                        'wins' => 0,
                    ]
                ),
                899755 => Stats::createFromArray(
                    [
                        'horse_uid' => 899755,
                        'runs' => 1,
                        'wins' => 0,
                    ]
                ),
            ],
            '73e5523e88930d7f4639de91b2e4068c' => [
                836091 => Stats::createFromArray(
                    [
                        'horse_uid' => 836091,
                        'runs' => 2,
                        'wins' => 0,
                    ]
                )
                ,
                872816 => Stats::createFromArray(
                    [
                        'horse_uid' => 872816,
                        'runs' => 3,
                        'wins' => 1,
                    ]
                ),
            ],
        ];
        $key = md5(serialize(func_get_args()));

        return $data[$key];
    }

    /**
     * @param int    $horseIds
     * @param string $startDate
     * @param array  $raceTypeCode
     * @param int    $courseId
     *
     * @return \Phalcon\Mvc\Model\Resultset\General
     */
    public function getHorseStatisticsByCourse(
        $horseIds,
        $startDate,
        array $raceTypeCode,
        $courseId
    ) {
        $data = [
            'c24e009989c9dd04ead90af04cc6237e' => [
                881328 => Stats::createFromArray(
                    [
                        'horse_uid' => 881328,
                        'runs' => 1,
                        'wins' => 0,
                    ]
                ),
                436302 => Stats::createFromArray(
                    [
                        'horse_uid' => 436302,
                        'runs' => 1,
                        'wins' => 0,
                    ]
                ),
            ],
            '968eff9585256e5e666252b2299ca38f' => [
                836091 => Stats::createFromArray(
                    [
                        'horse_uid' => 836091,
                        'runs' => 1,
                        'wins' => 0,
                    ]
                ),
                872816 => Stats::createFromArray(
                    [
                        'horse_uid' => 872816,
                        'runs' => 0,
                        'wins' => 0,
                    ]
                ),
            ],
        ];
        $key = md5(serialize(func_get_args()));

        return $data[$key];
    }


    /**
     * @param $raceId
     *
     * @return RiRow
     */
    public function getRaceCard($raceId)
    {

        return RiRow::createFromArray(
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
                'highest_official_rating' => null,
                'scoop6_race' => 'N',
                'jackpot_race' => 'N',
                'william_hill_offer_race' => 'N',
                'ladbrokes_offer_race' => 'N',
                'perform_race_uid_atr' => 111773,
                'perform_race_uid_ruk' => null,
                'aw_surface_type' => null,
                'stalls_position_desc' => null,
                'straight_round_jubilee_code' => null,
                'live_tab' => 'Y',
                'claiming_race' => 'Y',
                'selling_race' => 'N',
                'plus10_race' => 'Y',
                'weight_for_age' => null,
            ]
        );
    }

    public function getForfeits()
    {
        return [
            0 => General::createFromArray(
                [
                    'stage' => 2,
                    'forfeit_number' => 58,
                    'forfeit_value' => 310,
                ]
            ),
            1 => General::createFromArray(
                [
                    'stage' => 1,
                    'forfeit_number' => 57,
                    'forfeit_value' => 250,
                ]
            ),
        ];
    }

    public function getClaimingPrices()
    {
        return [
            0 => General::createFromArray(
                [
                    'horse_name' => 'Kilcascan',
                    'horse_uid' => 702076,
                    'start_number' => 1,
                    'prize_sterling' => 0,
                    'prize_euro' => null,
                    'vat_indicator' => null,
                    'claiming_text' => null,
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
                    'claiming_text' => null,
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
                    'claiming_text' => null,
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
                    'claiming_text' => null,
                ]
            ),
        ];
    }

    public function getOtherDeclaration()
    {
        return [
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
        ];
    }

    public function getHighestOfficialRating($raceId)
    {
        return [
            General::createFromArray(
                [
                    'horse_uid' => 867395,
                    'horse_name' => 'Azzuri',
                    'official_rating' => 80,
                    'weight_carried_lbs' => 119,
                ]
            ),
            General::createFromArray(
                [
                    'horse_uid' => 737133,
                    'horse_name' => 'Valmina',
                    'official_rating' => 79,
                    'weight_carried_lbs' => 119,
                ]
            ),
        ];
    }

    /**
     * @param int $raceId
     *
     * @return RiRow
     */
    public function fetchVerdict($raceId)
    {
        $data = [
            644232 => RiRow::createFromArray(
                [
                    'race_instance_uid' => 644232,
                    'race_datetime' => 'Mar 11 2016  6:45PM',
                    'rp_verdict' => 'This is not a strong race for the grade and \\bBERRAHRI\\p might be the ...',
                    'pre_race_instance_comments' => 'This is not a strong race for the grade and \\bBERRAHRI\\p...',
                    'key_stats_str' => 'Joey Haynes (' . PHP_EOL
                        . '<b>Caledonia Laird</b>) is showing a profit of &pound;45.00 this season',
                    'horse_uid' => 834606,
                    'horse_style_name' => 'Caledonia Laird',
                    'course_uid' => 1083,
                    'course_country_code' => 'GB',
                    'course_style_name' => 'Chelmsford (A.W)',
                    'owner_uid' => 115568,
                    'rp_owner_choice' => 'a',
                    'saddle_cloth_no' => 1,
                    'non_runner' => 'N',
                ]
            ),
        ];

        return isset($data[$raceId]) ? $data[$raceId] : null;
    }

    /**
     * @param int $raceId
     *
     * @return RiRow
     */
    public function fetchPostPointerVerdict($raceId)
    {
        $data = [
            644232 => RiRow::createFromArray(
                [
                    'race_instance_uid' => 644232,
                    'race_datetime' => 'Mar 11 2016  6:45PM',
                    'rp_verdict' => 'This is not a strong race for the grade and \\bBERRAHRI\\p might be the ...',
                    'pre_race_instance_comments' => 'This is not a strong race for the grade and \\bBERRAHRI\\p...',
                    'key_stats_str' => 'Joey Haynes (' . PHP_EOL
                        . '<b>Caledonia Laird</b>) is showing a profit of &pound;45.00 this season',
                    'horse_uid' => 834606,
                    'horse_style_name' => 'Caledonia Laird',
                    'course_uid' => 1083,
                    'course_country_code' => 'GB',
                    'course_style_name' => 'Chelmsford (A.W)',
                    'owner_uid' => 115568,
                    'rp_owner_choice' => 'a',
                    'saddle_cloth_no' => 1,
                    'non_runner' => 'N',
                ]
            ),
        ];

        return isset($data[$raceId]) ? $data[$raceId] : null;
    }

    public function getTipsterVerdicts($raceId)
    {
        $data = [
            647699 => [
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
            ],

        ];

        return (array_key_exists($raceId, $data)) ? $data[$raceId] : null;
    }

    /**
     * @param $raceId
     *
     * @return RiRow
     */
    public function getComments($raceId)
    {

        return RiRow::createFromArray(
            [
                General::createFromArray(
                    [
                        "horse_name" => "Al Guwair",
                        "horse_id" => 836648,
                        "spotlight" => "Prominent in market when in the frame in C&D maidens on first two...",
                        "race_datetime" => "Dec 17 2014 12:30PM",
                        "alt_silk_code" => null,
                        "saddle_cloth_no" => 6,
                        "diomed" => "Lightly raced but has plenty to prove and find relegated to a seller.",
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
                        "diomed" => "May not have handled Fibresand last time but needs to bounce back with...",
                    ]
                ),
            ]
        );
    }

    /**
     * @param $raceId
     *
     * @return  array
     */
    public function getSelections($raceId)
    {
        $data = [
            '661043' => [
                1 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'SPOTLIGHT',
                        'newspaper_uid' => 1,
                        'sort_order' => 1,
                        'horse_name' => 'Encapsulated',
                        'country_origin_code' => 'GB',
                        'horse_uid' => 837207,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 34088,
                        'selection_type' => 'NB',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'aa',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => 'aa',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 73,
                        'non_runner' => null,
                    ]
                ),
                2 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'RP Ratings',
                        'newspaper_uid' => 2,
                        'sort_order' => 2,
                        'horse_name' => 'Harry Holland',
                        'country_origin_code' => 'GB',
                        'horse_uid' => 933300,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 198826,
                        'selection_type' => 'NAP',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'a',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => 'a',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 74,
                        'non_runner' => null,
                    ]
                ),
                3 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'TOPSPEED',
                        'newspaper_uid' => 3,
                        'sort_order' => 3,
                        'horse_name' => 'City Of Angkor Wat',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 839201,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 160300,
                        'selection_type' => 'NAP',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'a',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => 'a',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 71,
                        'non_runner' => null,
                    ]
                ),
            ],
            '668655' => [
                1 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'SPOTLIGHT',
                        'newspaper_uid' => 1,
                        'sort_order' => 1,
                        'horse_name' => 'Jack The Laird',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 886899,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 227287,
                        'selection_type' => 'TIP',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'a',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => 'aa',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 75,
                        'non_runner' => null,
                    ]
                ),
                2 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'RP Ratings',
                        'newspaper_uid' => 2,
                        'sort_order' => 2,
                        'horse_name' => 'Jack The Laird',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 886899,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 227287,
                        'selection_type' => 'TIP',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'a',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => 'aa',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 75,
                        'non_runner' => null,
                    ]
                ),
                3 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'TOPSPEED',
                        'newspaper_uid' => 3,
                        'sort_order' => 3,
                        'horse_name' => 'Mighty Zip',
                        'country_origin_code' => 'USA',
                        'horse_uid' => 865698,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 166856,
                        'selection_type' => 'TIP',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'a',
                        'draw_output' => 'a',
                        'ability_output' => 'aaa',
                        'recent_form_output' => 'X',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 71,
                        'non_runner' => null,
                    ]
                ),
                4 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'POSTDATA',
                        'newspaper_uid' => 4,
                        'sort_order' => 4,
                        'horse_name' => 'Jack The Laird',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 886899,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 227287,
                        'selection_type' => 'TIP',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'a',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => 'aa',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 75,
                        'non_runner' => null,
                    ]
                ),
                17 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'NEWMARKET',
                        'newspaper_uid' => 17,
                        'sort_order' => 6,
                        'horse_name' => 'Strictly Carter',
                        'country_origin_code' => 'GB',
                        'horse_uid' => 888757,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 2973,
                        'selection_type' => 'TIP',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'a',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => '?',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 70,
                        'non_runner' => null,
                    ]
                ),
                6 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'THE NORTH',
                        'newspaper_uid' => 6,
                        'sort_order' => 7,
                        'horse_name' => 'Indian Pursuit',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 881315,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 26024,
                        'selection_type' => 'TIP',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => '?',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => '?',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 74,
                        'non_runner' => null,
                    ]
                ),
                8 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'The Times',
                        'newspaper_uid' => 8,
                        'sort_order' => 10,
                        'horse_name' => 'Jack The Laird',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 886899,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 227287,
                        'selection_type' => 'NB',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'a',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => 'aa',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 75,
                        'non_runner' => null,
                    ]
                ),
                9 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'Telegraph',
                        'newspaper_uid' => 9,
                        'sort_order' => 11,
                        'horse_name' => 'Binky Blue',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 857800,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 236437,
                        'selection_type' => 'TIP',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'aa',
                        'draw_output' => '-',
                        'ability_output' => 'aa',
                        'recent_form_output' => 'aa',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 73,
                        'non_runner' => null,
                    ]
                ),
                10 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'The Guardian',
                        'newspaper_uid' => 10,
                        'sort_order' => 12,
                        'horse_name' => 'Jack The Laird',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 886899,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 227287,
                        'selection_type' => 'NB',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'a',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => 'aa',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 75,
                        'non_runner' => null,
                    ]
                ),
                12 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'Daily Mail',
                        'newspaper_uid' => 12,
                        'sort_order' => 13,
                        'horse_name' => 'Jack The Laird',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 886899,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 227287,
                        'selection_type' => 'TIP',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'a',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => 'aa',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 75,
                        'non_runner' => null,
                    ]
                ),
                57 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'Daily Express',
                        'newspaper_uid' => 57,
                        'sort_order' => 14,
                        'horse_name' => 'Jack The Laird',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 886899,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 227287,
                        'selection_type' => 'TIP',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'a',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => 'aa',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 75,
                        'non_runner' => null,
                    ]
                ),
                14 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'Daily Mirror',
                        'newspaper_uid' => 14,
                        'sort_order' => 15,
                        'horse_name' => 'Jack The Laird',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 886899,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 227287,
                        'selection_type' => 'TIP',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'a',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => 'aa',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 75,
                        'non_runner' => null,
                    ]
                ),
                15 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 2,
                        'newspaper_name' => 'The Sun',
                        'newspaper_uid' => 15,
                        'sort_order' => 16,
                        'horse_name' => 'Diamond Vine',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 759025,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 169034,
                        'selection_type' => 'TIP',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'aa',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => 'a',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 69,
                        'non_runner' => null,
                    ]
                ),
                16 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 2,
                        'newspaper_name' => 'The Star',
                        'newspaper_uid' => 16,
                        'sort_order' => 17,
                        'horse_name' => 'Jack The Laird',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 886899,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 227287,
                        'selection_type' => 'NAP',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'a',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => 'aa',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 75,
                        'non_runner' => null,
                    ]
                ),
                40 => Selections::createFromArray(
                    [
                        'selection_type_uid' => 3,
                        'newspaper_name' => 'Daily Record',
                        'newspaper_uid' => 40,
                        'sort_order' => 18,
                        'horse_name' => 'Jack The Laird',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 886899,
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 227287,
                        'selection_type' => 'TIP',
                        'selection_cnt' => -1,
                        'nap_today_count' => null,
                        'rpr_nap' => 0,
                        'going_output' => 'a',
                        'distance_output' => 'a',
                        'course_output' => 'a',
                        'draw_output' => 'a',
                        'ability_output' => 'aa',
                        'recent_form_output' => 'aa',
                        'trainer_form_output' => 'aa',
                        'rp_postmark' => 75,
                        'non_runner' => null,
                    ]
                ),
            ],
            '671692' => [
                1 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'SPOTLIGHT',
                            'newspaper_uid' => 1,
                            'sort_order' => 1,
                            'horse_name' => 'Calipto',
                            'country_origin_code' => 'FR',
                            'horse_uid' => 845090,
                            'saddle_cloth_no' => 5,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 181256,
                            'selection_type' => 'NAP',
                            'selection_cnt' => -1,
                            'nap_today_count' => 3,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => '?',
                            'course_output' => '?',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => 'a',
                            'rp_postmark' => 158,
                            'non_runner' => null,
                        ]
                    ),
                2 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'RP Ratings',
                            'newspaper_uid' => 2,
                            'sort_order' => 2,
                            'horse_name' => 'Calipto',
                            'country_origin_code' => 'FR',
                            'horse_uid' => 845090,
                            'saddle_cloth_no' => 5,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 181256,
                            'selection_type' => 'TIP',
                            'selection_cnt' => -1,
                            'nap_today_count' => 3,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => '?',
                            'course_output' => '?',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => 'a',
                            'rp_postmark' => 158,
                            'non_runner' => null,
                        ]
                    ),
                3 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'TOPSPEED',
                            'newspaper_uid' => 3,
                            'sort_order' => 3,
                            'horse_name' => 'Theinval',
                            'country_origin_code' => 'FR',
                            'horse_uid' => 832408,
                            'saddle_cloth_no' => 1,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 130080,
                            'selection_type' => 'TIP',
                            'selection_cnt' => -1,
                            'nap_today_count' => null,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => 'a',
                            'course_output' => '?',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => 'aa',
                            'rp_postmark' => 156,
                            'non_runner' => null,
                        ]
                    ),
                4 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'POSTDATA',
                            'newspaper_uid' => 4,
                            'sort_order' => 4,
                            'horse_name' => 'Theinval',
                            'country_origin_code' => 'FR',
                            'horse_uid' => 832408,
                            'saddle_cloth_no' => 1,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 130080,
                            'selection_type' => 'TIP',
                            'selection_cnt' => -1,
                            'nap_today_count' => null,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => 'a',
                            'course_output' => '?',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => 'aa',
                            'rp_postmark' => 156,
                            'non_runner' => null,
                        ]
                    ),
                5 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'LAMBOURN',
                            'newspaper_uid' => 5,
                            'sort_order' => 5,
                            'horse_name' => 'Theinval',
                            'country_origin_code' => 'FR',
                            'horse_uid' => 832408,
                            'saddle_cloth_no' => 1,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 130080,
                            'selection_type' => 'TIP',
                            'selection_cnt' => -1,
                            'nap_today_count' => null,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => 'a',
                            'course_output' => '?',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => 'aa',
                            'rp_postmark' => 156,
                            'non_runner' => null,
                        ]
                    ),
                6 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'THE NORTH',
                            'newspaper_uid' => 6,
                            'sort_order' => 7,
                            'horse_name' => 'Katgary',
                            'country_origin_code' => 'FR',
                            'horse_uid' => 849455,
                            'saddle_cloth_no' => 4,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 215844,
                            'selection_type' => 'NAP',
                            'selection_cnt' => -1,
                            'nap_today_count' => null,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => 'a',
                            'course_output' => '?',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => '?',
                            'rp_postmark' => 155,
                            'non_runner' => null,
                        ]
                    ),
                70 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'WEST COUNTRY',
                            'newspaper_uid' => 70,
                            'sort_order' => 9,
                            'horse_name' => 'Warriors Tale',
                            'country_origin_code' => 'GB',
                            'horse_uid' => 848199,
                            'saddle_cloth_no' => 2,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 198532,
                            'selection_type' => 'TIP',
                            'selection_cnt' => -1,
                            'nap_today_count' => null,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => 'a',
                            'course_output' => 'a',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => 'a',
                            'rp_postmark' => 155,
                            'non_runner' => null,
                        ]
                    ),
                8 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'The Times',
                            'newspaper_uid' => 8,
                            'sort_order' => 10,
                            'horse_name' => 'Calipto',
                            'country_origin_code' => 'FR',
                            'horse_uid' => 845090,
                            'saddle_cloth_no' => 5,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 181256,
                            'selection_type' => 'TIP',
                            'selection_cnt' => -1,
                            'nap_today_count' => 3,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => '?',
                            'course_output' => '?',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => 'a',
                            'rp_postmark' => 158,
                            'non_runner' => null,
                        ]
                    ),
                9 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'Telegraph',
                            'newspaper_uid' => 9,
                            'sort_order' => 11,
                            'horse_name' => 'Katgary',
                            'country_origin_code' => 'FR',
                            'horse_uid' => 849455,
                            'saddle_cloth_no' => 4,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 215844,
                            'selection_type' => 'TIP',
                            'selection_cnt' => -1,
                            'nap_today_count' => null,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => 'a',
                            'course_output' => '?',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => '?',
                            'rp_postmark' => 155,
                            'non_runner' => null,
                        ]
                    ),
                10 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'The Guardian',
                            'newspaper_uid' => 10,
                            'sort_order' => 12,
                            'horse_name' => 'Calipto',
                            'country_origin_code' => 'FR',
                            'horse_uid' => 845090,
                            'saddle_cloth_no' => 5,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 181256,
                            'selection_type' => 'TIP',
                            'selection_cnt' => -1,
                            'nap_today_count' => 3,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => '?',
                            'course_output' => '?',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => 'a',
                            'rp_postmark' => 158,
                            'non_runner' => null,
                        ]
                    ),
                12 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'Daily Mail',
                            'newspaper_uid' => 12,
                            'sort_order' => 13,
                            'horse_name' => 'Calipto',
                            'country_origin_code' => 'FR',
                            'horse_uid' => 845090,
                            'saddle_cloth_no' => 5,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 181256,
                            'selection_type' => 'NAP',
                            'selection_cnt' => -1,
                            'nap_today_count' => 3,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => '?',
                            'course_output' => '?',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => 'a',
                            'rp_postmark' => 158,
                            'non_runner' => null,
                        ]
                    ),
                57 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'Daily Express',
                            'newspaper_uid' => 57,
                            'sort_order' => 14,
                            'horse_name' => 'Warriors Tale',
                            'country_origin_code' => 'GB',
                            'horse_uid' => 848199,
                            'saddle_cloth_no' => 2,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 198532,
                            'selection_type' => 'TIP',
                            'selection_cnt' => -1,
                            'nap_today_count' => null,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => 'a',
                            'course_output' => 'a',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => 'a',
                            'rp_postmark' => 155,
                            'non_runner' => null,
                        ]
                    ),
                14 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'Daily Mirror',
                            'newspaper_uid' => 14,
                            'sort_order' => 15,
                            'horse_name' => 'Katgary',
                            'country_origin_code' => 'FR',
                            'horse_uid' => 849455,
                            'saddle_cloth_no' => 4,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 215844,
                            'selection_type' => 'TIP',
                            'selection_cnt' => -1,
                            'nap_today_count' => null,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => 'a',
                            'course_output' => '?',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => '?',
                            'rp_postmark' => 155,
                            'non_runner' => null,
                        ]
                    ),
                15 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'The Sun',
                            'newspaper_uid' => 15,
                            'sort_order' => 16,
                            'horse_name' => 'Warriors Tale',
                            'country_origin_code' => 'GB',
                            'horse_uid' => 848199,
                            'saddle_cloth_no' => 2,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 198532,
                            'selection_type' => 'TIP',
                            'selection_cnt' => -1,
                            'nap_today_count' => null,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => 'a',
                            'course_output' => 'a',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => 'a',
                            'rp_postmark' => 155,
                            'non_runner' => null,
                        ]
                    ),
                16 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'The Star',
                            'newspaper_uid' => 16,
                            'sort_order' => 17,
                            'horse_name' => 'Katgary',
                            'country_origin_code' => 'FR',
                            'horse_uid' => 849455,
                            'saddle_cloth_no' => 4,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 215844,
                            'selection_type' => 'TIP',
                            'selection_cnt' => -1,
                            'nap_today_count' => null,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => 'a',
                            'course_output' => '?',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => '?',
                            'rp_postmark' => 155,
                            'non_runner' => null,
                        ]
                    ),
                40 =>
                    Selections::createFromArray(
                        [
                            'selection_type_uid' => 3,
                            'newspaper_name' => 'Daily Record',
                            'newspaper_uid' => 40,
                            'sort_order' => 18,
                            'horse_name' => 'Warriors Tale',
                            'country_origin_code' => 'GB',
                            'horse_uid' => 848199,
                            'saddle_cloth_no' => 2,
                            'rp_owner_choice' => 'a',
                            'owner_uid' => 198532,
                            'selection_type' => 'TIP',
                            'selection_cnt' => -1,
                            'nap_today_count' => null,
                            'rpr_nap' => 0,
                            'going_output' => 'a',
                            'distance_output' => 'a',
                            'course_output' => 'a',
                            'draw_output' => '-',
                            'ability_output' => 'aa',
                            'recent_form_output' => 'aa',
                            'trainer_form_output' => 'a',
                            'rp_postmark' => 155,
                            'non_runner' => null,
                        ]
                    ),
            ],
        ];

        return isset($data[$raceId]) ? $data[$raceId] : [];
    }

    /**
     * @param $date
     *
     * @return  array
     */
    public function getTopSelections($date)
    {
        $data = [
            '2016-09-30' => [
                Selections::createFromArray(
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
                ),
            ],
        ];

        return isset($data[$date]) ? $data[$date] : [];
    }

    public function getAnnual($horseUid, $raceType, $isMin = false)
    {
        $data = [
            "855795,862903,737133,false" => [
                "855795" => null,
                "862903" => General::createFromArray(
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
                "737133" => General::createFromArray(
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
            ],
            "855795,862903,737133,true" => [
                "855795" => null,
                "862903" => General::createFromArray(
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
                "737133" => General::createFromArray(
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
            ],
        ];

        $result = null;
        $key = implode(',', $horseUid) . "," . (($isMin) ? 'true' : 'false');
        if (isset($data[$key])) {
            $result = $data[$key];
        }

        return $result;
    }

    public function getLifetime($horseUid, $raceType, $isMin = false)
    {

        $data = [
            '855795,862903,737133,false' => [
                "855795" => null,
                "862903" => General::createFromArray(
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
                "737133" => General::createFromArray(
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
            ],
            "855795,862903,737133,true" => [
                "855795" => null,
                "862903" => General::createFromArray(
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
                "737133" => General::createFromArray(
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
            ],
        ];

        $key = implode(',', $horseUid) . "," . (($isMin) ? 'true' : 'false');
        if (isset($data[$key])) {
            return $data[$key];
        }
    }

    public function getOfficialRatingLastRaces(
        $horseId,
        $raceDate,
        $race_type_code,
        $adjustment,
        $limit
    ) {
        $data = [
            "855795" => [
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
            "862903" => [
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
            "737133" => [
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
        ];

        if (isset($data[$horseId])) {
            return $data[$horseId];
        }
    }

    public function getOfficialRating($raceId)
    {
        $data = [
            1 => [],
            632531 => [
                855795 => General::createFromArray(
                    [
                        'horse_uid' => 855795,
                        'horse_name' => 'Secret Spirit',
                        'weight_carried_lbs' => 130,
                        'extra_weight' => null,
                        'official_rating' => 72,
                        'official_rating_today' => null,
                        'adjustment' => 7,
                        'jockey_id' => 92728,
                        'last_races' => null,
                        'lifetime_high' => null,
                        'lifetime_low' => null,
                        'annual_high' => null,
                        'annual_low' => null,
                        'current_official_rating' => 0,
                        'saddle_cloth_no' => 7,
                        'lh_weight_carried_lbs' => null,
                        'out_of_handicap' => null,
                    ]
                ),
                862903 => General::createFromArray(
                    [
                        'horse_uid' => 862903,
                        'horse_name' => 'Honcho',
                        'weight_carried_lbs' => 124,
                        'extra_weight' => null,
                        'official_rating' => 66,
                        'official_rating_today' => null,
                        'adjustment' => 13,
                        'jockey_id' => 86013,
                        'last_races' => null,
                        'lifetime_high' => null,
                        'lifetime_low' => null,
                        'annual_high' => null,
                        'annual_low' => null,
                        'current_official_rating' => 0,
                        'saddle_cloth_no' => 8,
                        'lh_weight_carried_lbs' => null,
                        'out_of_handicap' => null,
                    ]
                ),
                737133 => General::createFromArray(
                    [
                        'horse_uid' => 737133,
                        'horse_name' => 'Valmina',
                        'weight_carried_lbs' => 117,
                        'extra_weight' => null,
                        'official_rating' => 56,
                        'official_rating_today' => null,
                        'adjustment' => 23,
                        'jockey_id' => 93947,
                        'last_races' => null,
                        'lifetime_high' => null,
                        'lifetime_low' => null,
                        'annual_high' => null,
                        'annual_low' => null,
                        'current_official_rating' => 0,
                        'saddle_cloth_no' => 9,
                        'lh_weight_carried_lbs' => null,
                        'out_of_handicap' => null,
                    ]
                ),
            ],

        ];

        return $data[$raceId];
    }

    public function getRunnersIndexByDate($date)
    {
        return [
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
        ];
    }

    public function getNonRunnersIndexByDate($date)
    {
        return [
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
        ];
    }

    public function getRprRatingData($raceUid)
    {
        return [
            870882 => RiRow::createFromArray(
                [
                    'style_name' => 'Laurence',
                    'weight_carried_lbs' => 133,
                    'race_status_code' => 'R',
                    'race_type_code' => 'F',
                    'horse_uid' => 870882,
                    'rp_tops_old' => 0,
                    'rp_tops' => 82,
                    'rp_postmark' => 96,
                    'rp_pm_chars' => 'X',
                    'last_12_months' => null,
                    'going' => null,
                    'distance' => null,
                    'course' => null,
                    'race_datetime' => 'Jun  1 2015  3:20PM',
                    'adjustment' => null,
                    'country_code' => 'GB ',
                    'course_uid' => 30,
                    'course_name' => 'LEICESTER',
                    'rp_going_type_desc' => 'GD-FM',
                    'distance_yard' => 2198,
                    'last_races' => null,
                    "race_group_code" => 'H',
                    'rpr_selections' => false,
                ]
            ),
        ];
    }

    public function getRprLast12Month($horseUids, $raceType)
    {
        return [
            870882 => General::createFromArray(
                [
                    'horse_uid' => 870882,
                    'rp_postmark' => 88,
                    'rp_topspeed' => 53,
                    'course_uid' => 30,
                    'crs_name' => 'Leicester',
                    'race_instance_uid' => 626415,
                    'race_datetime' => 'Jun  1 2015  3:20PM',
                    'race_type_code' => 'F',
                    'race_instance_title' => 'At The Races Virgin 534 Handicap',
                    'distance_yard' => 2198,
                    'rp_close_up_comment' => 'chased leader until over 7f out, remained handy, ridden and not clear run over 1f out, stayed on same pace inside final furlong',
                    'race_outcome_code' => '2',
                    'services_desc' => 'GF',
                    'no_runners' => 8,
                ]
            ),
        ];
    }

    public function getRprGoing($horseUids, $raceType, $goingTypeDesc)
    {
        return [
            870882 => General::createFromArray(
                [
                    'horse_uid' => 870882,
                    'rp_postmark' => 88,
                    'rp_topspeed' => 53,
                    'course_uid' => 30,
                    'crs_name' => 'Leicester',
                    'race_instance_uid' => 626415,
                    'race_datetime' => 'Jun  1 2015  3:20PM',
                    'race_type_code' => 'F',
                    'race_instance_title' => 'At The Races Virgin 534 Handicap',
                    'distance_yard' => 2198,
                    'rp_close_up_comment' => 'chased leader until over 7f out, remained handy, ridden and not clear run over 1f out, stayed on same pace inside final furlong',
                    'race_outcome_code' => '2',
                    'services_desc' => 'GF',
                    'no_runners' => 8,
                ]
            ),
        ];
    }

    /**
     * @param array $horseUids
     * @param array $raceTypeCodes
     * @param int   $distanceFrom
     * @param int   $distanceTo
     *
     * @return array
     */
    public function getRprDistance(array $horseUids, array $raceTypeCodes, $distanceFrom, $distanceTo)
    {
        return [
            870882 => RiRow::createFromArray(
                [
                    'horse_uid' => 870882,
                    'rp_postmark' => 88,
                    'rp_topspeed' => 53,
                    'course_uid' => 30,
                    'style_name' => 'Leicester',
                    'race_instance_uid' => 626415,
                    'race_datetime' => 'Jun  1 2015  3:20PM',
                    'race_type_code' => 'F',
                    'race_instance_title' => 'At The Races Virgin 534 Handicap',
                    'distance_yard' => 2198,
                    'rp_close_up_comment' => 'chased leader until over 7f out, remained handy, ridden and not clear run over 1f out, stayed on same pace inside final furlong',
                    'race_outcome_code' => '2',
                    'services_desc' => 'GF',
                    'no_runners' => 8,
                ]
            ),
        ];
    }

    public function getRprCourse($horseUids, $raceType, $course)
    {
        return [
            870882 => General::createFromArray(
                [
                    'horse_uid' => 870882,
                    'rp_postmark' => 88,
                    'rp_topspeed' => 53,
                    'course_uid' => 30,
                    'crs_name' => 'Leicester',
                    'race_instance_uid' => 626415,
                    'race_datetime' => 'Jun  1 2015  3:20PM',
                    'race_type_code' => 'F',
                    'race_instance_title' => 'At The Races Virgin 534 Handicap',
                    'distance_yard' => 2198,
                    'rp_close_up_comment' => 'chased leader until over 7f out, remained handy, ridden and not clear run over 1f out, stayed on same pace inside final furlong',
                    'race_outcome_code' => '2',
                    'services_desc' => 'GF',
                    'no_runners' => 8,
                ]
            ),
        ];
    }

    public function getRprLastRaces($horseUid, $raceDate, $raceType)
    {
        $data = [
            870882 => [
                0 => General::createFromArray(
                    [
                        'race_instance_uid' => 624450,
                        'race_datetime' => 'May 16 2015  4:00PM',
                        'race_type_code' => 'F',
                        'rp_postmark' => 97,
                        'course_uid' => 38,
                        'course_name' => 'NEWMARKET',
                        'distance_yard' => 1760,
                        'services_desc' => 'GF',
                        'race_outcome_code' => '1',
                        'rp_tops' => 75,
                        'rp_close_up_comment' => 'chased leaders, shaken up over 2f out, ran on under pressure to lead well inside final furlong',
                        'calc_no_runners' => 10,
                        "race_group_code" => 'H',
                    ]
                ),
                1 => General::createFromArray(
                    [
                        'race_instance_uid' => 624595,
                        'race_datetime' => 'Apr 18 2015  5:10PM',
                        'race_type_code' => 'F',
                        'rp_postmark' => 91,
                        'course_uid' => 36,
                        'course_name' => 'NEWBURY',
                        'distance_yard' => 1760,
                        'services_desc' => 'GF',
                        'race_outcome_code' => '3',
                        'rp_tops' => 72,
                        'rp_close_up_comment' => 'chased leaders, ridden and effort 2f out, driven over 1f out, kept on same pace inside final furlong',
                        'calc_no_runners' => 13,
                        "race_group_code" => 'H',
                    ]
                ),
                2 => General::createFromArray(
                    [
                        'race_instance_uid' => 613857,
                        'race_datetime' => 'Nov  5 2014  1:20PM',
                        'race_type_code' => 'F',
                        'rp_postmark' => 79,
                        'course_uid' => 40,
                        'course_name' => 'NOTTINGHAM',
                        'distance_yard' => 1835,
                        'services_desc' => 'GS',
                        'race_outcome_code' => '3',
                        'rp_tops' => 55,
                        'rp_close_up_comment' => 'held up, headway over 3f out, ridden along to chase leaders 2f out, kept on same pace under pressure final furlong',
                        'calc_no_runners' => 17,
                        "race_group_code" => 'H',
                    ]
                ),
                3 => General::createFromArray(
                    [
                        'race_instance_uid' => 611090,
                        'race_datetime' => 'Oct 15 2014  1:40PM',
                        'race_type_code' => 'F',
                        'rp_postmark' => 76,
                        'course_uid' => 40,
                        'course_name' => 'NOTTINGHAM',
                        'distance_yard' => 1835,
                        'services_desc' => 'Sft',
                        'race_outcome_code' => '3',
                        'rp_tops' => 41,
                        'rp_close_up_comment' => 'held up in touch, headway on outer well over 2f out, ridden to chase leading pair over 1f out, soon one pace',
                        'calc_no_runners' => 7,
                        "race_group_code" => 'H',
                    ]
                ),
            ],

        ];

        if (isset($data[$horseUid])) {
            return $data[$horseUid];
        }
    }

    /**
     * @param string $raceDate
     *
     * @return array
     */
    public function checkFastResults($raceDate)
    {
        return [
            612446 => [
                'race_instance_uid' => 612446,
                'fast_race_instance_uid' => 612446,
            ],
        ];
    }

    /**
     * @param string $raceDate
     * @param bool   $isFullList
     *
     * @return mixed|null
     */
    public function getMeetingByDate($raceDate, $isFullList)
    {
        $data = [
            '2017-02-17_0' => [
                18 => \Api\Row\Meeting::createFromArray(
                    [
                        'meeting_type' => null,
                        'course_uid' => 18,
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
                        'races' => null,
                        'cards_order' => null,
                    ]
                ),
                181 => \Api\Row\Meeting::createFromArray(
                    [
                        'meeting_type' => null,
                        'course_uid' => 181,
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
                        'races' => null,
                        'cards_order' => null,
                    ]
                ),
            ],
            '2017-02-17_1' => [
                19 => \Api\Row\Meeting::createFromArray(
                    [
                        'meeting_type' => null,
                        'course_uid' => 19,
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
                        'races' => null,
                        'cards_order' => null,
                    ]
                ),
            ],
            '2017-12-26_0' => [
                19 => \Api\Row\Meeting::createFromArray(
                    [
                        'meeting_type' => null,
                        'course_uid' => 19,
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
                        'races' => null,
                        'cards_order' => null,
                    ]
                ),
            ],
        ];

        return isset($data[$raceDate . '_' . (int)$isFullList]) ? $data[$raceDate . '_' . (int)$isFullList] : null;
    }

    /**
     * @param string $raceDate
     * @param bool   $isFullList
     *
     * @return mixed|null
     */
    public function getRacesListByDate($raceDate, $isFullList)
    {
        $data = [
            '2017-02-17_0' => [
                0 => RiRow::createFromArray(
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
                        'free_to_air_yn' => 'n',
                    ]
                ),
                1 => RiRow::createFromArray(
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
                        'free_to_air_yn' => 'n',
                    ]
                ),
                2 => RiRow::createFromArray(
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
                        'free_to_air_yn' => 'n',
                    ]
                ),
                3 => RiRow::createFromArray(
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
                        'free_to_air_yn' => 'n',
                    ]
                ),
                4 => RiRow::createFromArray(
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
                        'free_to_air_yn' => 'y',
                    ]
                ),
                5 => RiRow::createFromArray(
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
                        'free_to_air_yn' => 'y',
                    ]
                ),
            ],
            '2017-02-17_1' => [
                0 => RiRow::createFromArray(
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
                        'free_to_air_yn' => 'n',
                    ]
                ),
                1 => RiRow::createFromArray(
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
                        'free_to_air_yn' => 'n',
                    ]
                ),
            ],
            '2017-12-26_0' => [
                0 => \Api\Row\RaceInstance::createFromArray(
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
                        'free_to_air_yn' => 'n',
                    ]
                ),
                1 => \Api\Row\RaceInstance::createFromArray(
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
                        'free_to_air_yn' => 'n',
                    ]
                ),
            ],
        ];

        return isset($data[$raceDate . '_' . (int)$isFullList]) ? $data[$raceDate . '_' . (int)$isFullList] : null;
    }

    public function getRunnersIds()
    {
        $raceId = $this->getRaceId();
        $data = [
            635909 => [822332],
        ];
        if (!empty($data[$raceId])) {
            return $data[$raceId];
        } else {
            return [];
        }
    }

    /**
     * @param array    $horseUids
     * @param int      $raceId
     * @param int|null $limit
     *
     * @return array
     */
    public function getForm(array $horseUids, $raceId, $limit)
    {
        $data = [
            822332 => [
                822332 => (Object)[
                    'horse_uid' => 822332,
                    'races' => [
                        630056 => RiRow::createFromArray(
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
                                'next_run' =>
                                    RiRow::createFromArray([
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
                                    ]),
                            ]
                        ),
                        627430 => RiRow::createFromArray(
                            [
                                'race_instance_uid' => 627430,
                                'race_datetime' => 'Jun 13 2015  2:25PM',
                                'course_uid' => 25,
                                'course_style_name' => 'Hexham',
                                'course_country_code' => 'GB',
                                'race_instance_title' => 'Andy Calvert Celebration Novices\' Hurdle',
                                'race_type_code' => 'H',
                                'course_rp_abbrev_3' => 'HEX',
                                'course_code' => 'HEXH',
                                'course_comments' => 'left-handed, undulating, testing track with easy fences',
                                'going_type_services_desc' => 'Gd',
                                'prize_sterling' => 5817.3999999999996,
                                'distance_yard' => 3568,
                                'actual_race_class' => '3',
                                'rp_ages_allowed_desc' => '4yo+',
                                'race_group_code' => '0',
                                'race_group_desc' => 'Unknown',
                                'weight_carried_lbs' => 154,
                                'race_outcome_desc' => '1st',
                                'race_outcome_form_char' => '1',
                                'race_output_order' => 1,
                                'race_outcome_position' => 1,
                                'race_outcome_code' => '1  ',
                                'orig_race_output_order' => 1,
                                'no_of_runners' => null,
                                'going_type_code' => 'G',
                                'no_of_runners_calculated' => 11,
                                'rp_close_up_comment' => 'midfield, in touch after 3rd, steady headway to track leader going well before 2 out, led approaching last, pushed clear',
                                'rp_horse_head_gear_code' => null,
                                'first_time_yn' => null,
                                'odds_desc' => '2/1F',
                                'odds_value' => 2,
                                'horse_uid' => 822332,
                                'jockey_style_name' => 'Aidan Coleman',
                                'aka_style_name' => 'A Coleman',
                                'jockey_jockey_uid' => 86032,
                                'official_rating_ran_off' => 0,
                                'rp_topspeed' => 75,
                                'rp_postmark' => 138,
                                'ptv_video_id' => 221334,
                                'video_provider' => 'ATR',
                                'dtw_rp_distance_desc' => '13',
                                'dtw_sum_distance_value' => 13,
                                'dtw_count_horse_race' => 0,
                                'dtw_total_distance_value' => 203.19999999999999,
                                'rp_betting_movements' => 'tchd 15/8 and 9/4',
                                'disqualification_uid' => null,
                                'disqualification_desc' => null,
                                'other_horse' => null,
                                'next_run' =>
                                    RiRow::createFromArray([
                                        'form_race_instance_uid' => 673767,
                                        'first_3_wins' => 1,
                                        'first_3_placed' => 0,
                                        'first_3_unplaced' => 0,
                                        'other_wins' => 0,
                                        'other_placed' => 2,
                                        'other_unplaced' => 10,
                                        'hot_race' => 1,
                                        'cold_race' => 0,
                                        'first_three' => (Object)[
                                            'wins' => 2,
                                            'placed' => 3,
                                            'unplaced' => 3,
                                        ],
                                        'other' => (Object)[
                                            'wins' => 0,
                                            'placed' => 2,
                                            'unplaced' => 10,
                                        ],
                                        'average_race' => 0,
                                    ]),
                            ]
                        ),
                        611610 => RiRow::createFromArray(
                            [
                                'race_instance_uid' => 611610,
                                'race_datetime' => 'Oct 25 2014  2:20PM',
                                'course_uid' => 36,
                                'course_style_name' => 'Newbury',
                                'course_country_code' => 'GB',
                                'race_instance_title' => 'Worthington\'s Burlison Inns Stakes (Registered as The St Simon Stakes) (Group 3)',
                                'race_type_code' => 'F',
                                'course_rp_abbrev_3' => 'NBY',
                                'course_code' => 'NWBY',
                                'course_comments' => 'left-handed, galloping track',
                                'going_type_services_desc' => 'Sft',
                                'prize_sterling' => 34026,
                                'distance_yard' => 2645,
                                'actual_race_class' => '1',
                                'rp_ages_allowed_desc' => '3yo+',
                                'race_group_code' => '3',
                                'race_group_desc' => 'Group 3',
                                'weight_carried_lbs' => 130,
                                'race_outcome_desc' => '7th',
                                'race_outcome_form_char' => '0',
                                'race_output_order' => 7,
                                'race_outcome_position' => 7,
                                'race_outcome_code' => '7  ',
                                'orig_race_output_order' => 7,
                                'no_of_runners' => null,
                                'going_type_code' => 'S',
                                'no_of_runners_calculated' => 8,
                                'rp_close_up_comment' => 'chased leaders, disputed 2nd 7f out until 5f out, weakened well over 2f out',
                                'rp_horse_head_gear_code' => null,
                                'first_time_yn' => null,
                                'odds_desc' => '14/1',
                                'odds_value' => 14,
                                'horse_uid' => 822332,
                                'jockey_style_name' => 'Adam Kirby',
                                'aka_style_name' => 'A Kirby',
                                'jockey_jockey_uid' => 83607,
                                'official_rating_ran_off' => 103,
                                'rp_topspeed' => 35,
                                'rp_postmark' => 61,
                                'ptv_video_id' => 221334,
                                'video_provider' => 'ATR',
                                'dtw_rp_distance_desc' => '9',
                                'dtw_sum_distance_value' => 35.25,
                                'dtw_count_horse_race' => 0,
                                'dtw_total_distance_value' => 42.25,
                                'rp_betting_movements' => 'op 12/1',
                                'disqualification_uid' => null,
                                'disqualification_desc' => null,
                                'other_horse' => null,
                                'next_run' => null,
                            ]
                        ),
                    ],
                ],
            ],
        ];

        $key = implode(' ', $horseUids);
        if (!empty($data[$key])) {
            $result = [];
            $cnt = 1;
            if (!is_null($limit) || $limit > 0) {
                foreach ($data[$key][$key]->races as $id => $race) {
                    $result[$id] = $race;
                    if (++$cnt > $limit) {
                        break;
                    }
                }
                $data[$key][$key]->races = $result;
            }

            return $data[$key];
        } else {
            return [];
        }
    }

    /**
     * @param $raceId
     *
     * @return array
     */
    public function getQuotes($raceId)
    {
        return [
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
            ),
        ];
    }

    /**
     * @param $raceId
     *
     * @return array
     */
    public function getStatsData($raceId)
    {
        $data = [
            614973 => [
                'trainers' => [
                    5372 => General::createFromArray(
                        [
                            'horse_uid' => 436302,
                            'horse_name' => 'Southern Seas',
                            'trainer_uid' => 5372,
                            'trainer_name' => 'Ann Duffield',
                            'jockey_uid' => 76872,
                            'jockey_name' => 'P J McDonald',
                        ]
                    ),
                    67 => General::createFromArray(
                        [
                            'horse_uid' => 874973,
                            'horse_name' => 'Cartwright',
                            'trainer_uid' => 67,
                            'trainer_name' => 'Sir Mark Prescott Bt',
                            'jockey_uid' => 84857,
                            'jockey_name' => 'Luke Morris',
                        ]
                    ),
                ],
                'jockeys' => [
                    76872 => General::createFromArray(
                        [
                            'horse_uid' => 436302,
                            'horse_name' => 'Southern Seas',
                            'trainer_uid' => 5372,
                            'trainer_name' => 'Ann Duffield',
                            'jockey_uid' => 76872,
                            'jockey_name' => 'P J McDonald',
                        ]
                    ),
                    84857 => General::createFromArray(
                        [
                            'horse_uid' => 874973,
                            'horse_name' => 'Cartwright',
                            'trainer_uid' => 67,
                            'trainer_name' => 'Sir Mark Prescott Bt',
                            'jockey_uid' => 84857,
                            'jockey_name' => 'Luke Morris',
                        ]
                    ),
                ],
                'horses' => [
                    436302 => General::createFromArray(
                        [
                            'horse_uid' => 436302,
                            'horse_name' => 'Southern Seas',
                            'country_origin_code' => 'GB',
                            'trainer_uid' => 5372,
                            'trainer_name' => 'Ann Duffield',
                            'jockey_uid' => 76872,
                            'jockey_name' => 'P J McDonald',
                        ]
                    ),
                    874973 => General::createFromArray(
                        [
                            'horse_uid' => 874973,
                            'horse_name' => 'Cartwright',
                            'country_origin_code' => 'GB',
                            'trainer_uid' => 67,
                            'trainer_name' => 'Sir Mark Prescott Bt',
                            'jockey_uid' => 84857,
                            'jockey_name' => 'Luke Morris',
                        ]
                    ),
                ],
            ],
            614944 => [
                'trainers' => [
                    35 => General::createFromArray(
                        [
                            'horse_uid' => 850593,
                            'horse_name' => 'Galuppi',
                            'trainer_uid' => 35,
                            'trainer_name' => 'J R Jenkins',
                            'jockey_uid' => 88023,
                            'jockey_name' => 'Sam Twiston-Davies',
                        ]
                    ),
                    135 => General::createFromArray(
                        [
                            'horse_uid' => 903217,
                            'horse_name' => 'Imperial Presence',
                            'trainer_uid' => 135,
                            'trainer_name' => 'Philip Hobbs',
                            'jockey_uid' => 12290,
                            'jockey_name' => 'Richard Johnson',
                        ]
                    ),
                ],
                'jockeys' => [
                    14447 => General::createFromArray(
                        [
                            'horse_uid' => 872816,
                            'horse_name' => 'Lettheriverrundry',
                            'trainer_uid' => 14365,
                            'trainer_name' => 'Brendan Powell',
                            'jockey_uid' => 14447,
                            'jockey_name' => 'Barry Geraghty',
                        ]
                    ),
                    12290 => General::createFromArray(
                        [
                            'horse_uid' => 850942,
                            'horse_name' => 'Poetic License',
                            'trainer_uid' => 67,
                            'trainer_name' => 'Sir Mark Prescott Bt',
                            'jockey_uid' => 12290,
                            'jockey_name' => 'Richard Johnson',
                        ]
                    ),
                ],
                'horses' => [
                    836091 => General::createFromArray(
                        [
                            'horse_uid' => 836091,
                            'horse_name' => 'Top Set',
                            'country_origin_code' => 'GB',
                            'trainer_uid' => 7873,
                            'trainer_name' => 'Richard Phillips',
                            'jockey_uid' => 88476,
                            'jockey_name' => 'Daniel Hiskett',
                        ]
                    ),
                    872816 => General::createFromArray(
                        [
                            'horse_uid' => 872816,
                            'horse_name' => 'Lettheriverrundry',
                            'country_origin_code' => 'GB',
                            'trainer_uid' => 14365,
                            'trainer_name' => 'Brendan Powell',
                            'jockey_uid' => 14447,
                            'jockey_name' => 'Barry Geraghty',
                        ]
                    ),
                ],
            ],
        ];

        return (isset($data[$raceId])) ? $data[$raceId] : null;
    }

    public function getUpcomingRaces()
    {
        return [
            0 => RiRow::createFromArray(
                [
                    'course_uid' => 93,
                    'course_name' => 'WINDSOR',
                    'race_instance_uid' => 634885,
                    'race_datetime' => 'Oct  5 2015  1:50PM',
                ]
            ),
            1 => RiRow::createFromArray(
                [
                    'course_uid' => 46,
                    'course_name' => 'PONTEFRACT',
                    'race_instance_uid' => 634878,
                    'race_datetime' => 'Oct  5 2015  2:00PM',
                ]
            ),
            2 => RiRow::createFromArray(
                [
                    'course_uid' => 35,
                    'course_name' => 'MARKET RASEN',
                    'race_instance_uid' => 634992,
                    'race_datetime' => 'Oct  5 2015  2:10PM',
                ]
            ),
        ];
    }

    public function getBigRaces()
    {
        return
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
                        "rp_ages_allowed_desc" => "3yo+",
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
                        "rp_ages_allowed_desc" => "3yo+",
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
                        "rp_ages_allowed_desc" => "3yo+",
                    ]
                ),
            ];
    }

    /**
     * @param bool $isExcludePTP
     *
     * @return General
     */
    public function getNextRace($isExcludePTP)
    {
        return General::createFromArray(
            [
                'race_instance_uid' => 635435,
                'race_datetime' => 'Oct 15 2015  1:50PM',
                'course_name' => 'UTTOXETER',
                'course_style_name' => 'Uttoxeter',
                'country_code' => 'GB',
                'course_uid' => 84,
            ]
        );
    }

    public function getRaceAdditionalData($raceId)
    {
        $data = [
            637256 => General::createFromArray(
                [
                    'race_instance_uid' => 637256,
                    'race_datetime' => date("Y-m-d ") . '12:00',
                    'furlong' => 23,
                    'race_type_code' => 'F',
                    'min_weight' => 140,
                    'max_age' => 12,
                    'min_age' => 7,
                    'race_status_code' => '4',
                    'weight_adjustment' => 140,
                    'top_age' => 11,
                ]
            ),
            617651 => General::createFromArray(
                [
                    'race_instance_uid' => 617651,
                    'race_datetime' => date("Y-m-d ") . '12:00',
                    'furlong' => 23,
                    'race_type_code' => 'F',
                    'min_weight' => 140,
                    'max_age' => 12,
                    'min_age' => 7,
                    'race_status_code' => '4',
                    'weight_adjustment' => 140,
                    'top_age' => 11,
                ]
            ),
            670447 => General::createFromArray(
                [
                    'race_instance_uid' => 670447,
                    'race_datetime' => 'Mar  9 2017  6:00PM',
                    'race_type_code' => 'X',
                    'race_group_code' => 'H',
                    'min_weight' => null,
                    'race_status_code' => 'R',
                    'weight_adjustment' => 140,
                    'min_age' => 4,
                    'max_age' => 10,
                    'top_age' => 0,
                    'furlong' => 8,
                ]
            ),
            688111 => General::createFromArray([
                'race_instance_uid' => 688111,
                'race_datetime' => 'Nov 23 2017  6:30PM',
                'race_type_code' => 'X',
                'race_group_code' => '0',
                'min_weight' => null,
                'race_status_code' => '4',
                'weight_adjustment' => 140,
                'min_age' => 2,
                'max_age' => 2,
                'top_age' => 0,
                'furlong' => 8,
            ]),
            616420 => General::createFromArray(
                [
                    'race_instance_uid' => 637256,
                    'race_datetime' => date("Y-m-d ") . '12:00',
                    'furlong' => 23,
                    'race_type_code' => 'F',
                    'min_weight' => 140,
                    'max_age' => 12,
                    'min_age' => 7,
                    'race_status_code' => '4',
                    'weight_adjustment' => 140,
                    'top_age' => 11,
                ]
            ),
        ];

        return $data[$raceId];
    }

    public function getHorsesAttributes($race)
    {
        $data = [
            0 => General::createFromArray(
                [
                    'horse_uid' => 839210,
                    'race_instance_uid' => 636830,
                    'race_datetime' => '11/5/2015 2:55:00.000 PM',
                    'race_type_code' => 'H',
                    'age' => 4,
                    'weight_carried_lbs' => 154,
                    'adjustment' => 168,
                    'allowance' => null,
                    'rp_postmark' => 94,
                    'rp_topspeed' => 82,
                    'wfa_control_flag' => 2,
                    'force_deduct_wfa' => 0,
                    'adjusted_age' => 8,
                    'wfa_flat' => 3,
                    'wfa_jump' => 5,
                ]
            ),
            1 => General::createFromArray(
                [
                    'horse_uid' => 811858,
                    'race_instance_uid' => 617651,
                    'race_datetime' => date("Y-m-d ") . '12:00', //'11/5/2015 2:55:00.000 PM',
                    'race_type_code' => 'H',
                    'age' => 4,
                    'weight_carried_lbs' => 154,
                    'adjustment' => 168,
                    'allowance' => null,
                    'rp_postmark' => 94,
                    'rp_topspeed' => 82,
                    'wfa_control_flag' => 2,
                    'force_deduct_wfa' => 0,
                    'adjusted_age' => 8,
                    'wfa_flat' => 3,
                    'wfa_jump' => 11,
                ]
            ),
            2 => General::createFromArray(
                [
                    'horse_uid' => 735305,
                    'race_instance_uid' => 617651,
                    'race_datetime' => date("Y-m-d ") . '12:00', //'11/5/2015 2:55:00.000 PM',
                    'race_type_code' => 'H',
                    'age' => 4,
                    'weight_carried_lbs' => 154,
                    'adjustment' => 168,
                    'allowance' => null,
                    'rp_postmark' => 94,
                    'rp_topspeed' => 82,
                    'wfa_control_flag' => 2,
                    'force_deduct_wfa' => 0,
                    'adjusted_age' => 8,
                    'wfa_flat' => 8,
                    'wfa_jump' => 5,
                ]
            ),
            688111 => [
                1266744 =>
                    General::createFromArray([
                        'horse_uid' => 1266744,
                        'weight_carried_lbs' => 128,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1314524 =>
                    General::createFromArray([
                        'horse_uid' => 1314524,
                        'weight_carried_lbs' => 134,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1500671 =>
                    General::createFromArray([
                        'horse_uid' => 1500671,
                        'weight_carried_lbs' => 128,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1540370 =>
                    General::createFromArray([
                        'horse_uid' => 1540370,
                        'weight_carried_lbs' => 123,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1578953 =>
                    General::createFromArray([
                        'horse_uid' => 1578953,
                        'weight_carried_lbs' => 128,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1592907 =>
                    General::createFromArray([
                        'horse_uid' => 1592907,
                        'weight_carried_lbs' => 123,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1630943 =>
                    General::createFromArray([
                        'horse_uid' => 1630943,
                        'weight_carried_lbs' => 123,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1632783 =>
                    General::createFromArray([
                        'horse_uid' => 1632783,
                        'weight_carried_lbs' => 0,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1636586 =>
                    General::createFromArray([
                        'horse_uid' => 1636586,
                        'weight_carried_lbs' => 128,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1659623 =>
                    General::createFromArray([
                        'horse_uid' => 1659623,
                        'weight_carried_lbs' => 123,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1662717 =>
                    General::createFromArray([
                        'horse_uid' => 1662717,
                        'weight_carried_lbs' => 128,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1676734 =>
                    General::createFromArray([
                        'horse_uid' => 1676734,
                        'weight_carried_lbs' => 123,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1692210 =>
                    General::createFromArray([
                        'horse_uid' => 1692210,
                        'weight_carried_lbs' => 123,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1692228 =>
                    General::createFromArray([
                        'horse_uid' => 1692228,
                        'weight_carried_lbs' => 128,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1692230 =>
                    General::createFromArray([
                        'horse_uid' => 1692230,
                        'weight_carried_lbs' => 128,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1692231 =>
                    General::createFromArray([
                        'horse_uid' => 1692231,
                        'weight_carried_lbs' => 128,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1702104 =>
                    General::createFromArray([
                        'horse_uid' => 1702104,
                        'weight_carried_lbs' => 128,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1709938 =>
                    General::createFromArray([
                        'horse_uid' => 1709938,
                        'weight_carried_lbs' => 128,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1709940 =>
                    General::createFromArray([
                        'horse_uid' => 1709940,
                        'weight_carried_lbs' => 123,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1711253 =>
                    General::createFromArray([
                        'horse_uid' => 1711253,
                        'weight_carried_lbs' => 128,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1711258 =>
                    General::createFromArray([
                        'horse_uid' => 1711258,
                        'weight_carried_lbs' => 128,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1711264 =>
                    General::createFromArray([
                        'horse_uid' => 1711264,
                        'weight_carried_lbs' => 128,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1711267 =>
                    General::createFromArray([
                        'horse_uid' => 1711267,
                        'weight_carried_lbs' => 123,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1714362 =>
                    General::createFromArray([
                        'horse_uid' => 1714362,
                        'weight_carried_lbs' => 0,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
                1714363 =>
                    General::createFromArray([
                        'horse_uid' => 1714363,
                        'weight_carried_lbs' => 123,
                        'age' => 2,
                        'rp_postmark' => 0,
                        'rp_topspeed' => 0,
                        'wfage' => 2,
                        'adjusted_age' => 2,
                        'force_deduct_wfa' => 0,
                        'wfa_control_flag' => 0,
                        'wfa_flat' => 22,
                        'wfa_jump' => 0,
                    ]),
            ],
            637256 => [
                0 => General::createFromArray(
                    [
                        'horse_uid' => 839210,
                        'race_instance_uid' => 636830,
                        'race_datetime' => '11/5/2015 2:55:00.000 PM',
                        'race_type_code' => 'H',
                        'age' => 4,
                        'weight_carried_lbs' => 154,
                        'adjustment' => 168,
                        'allowance' => null,
                        'rp_postmark' => 94,
                        'rp_topspeed' => 82,
                        'wfa_control_flag' => 2,
                        'force_deduct_wfa' => 0,
                        'adjusted_age' => 8,
                        'wfa_flat' => 3,
                        'wfa_jump' => 5,
                    ]
                ),
                1 => General::createFromArray(
                    [
                        'horse_uid' => 811858,
                        'race_instance_uid' => 617651,
                        'race_datetime' => date("Y-m-d ") . '12:00',
                        'race_type_code' => 'H',
                        'age' => 4,
                        'weight_carried_lbs' => 154,
                        'adjustment' => 168,
                        'allowance' => null,
                        'rp_postmark' => 94,
                        'rp_topspeed' => 82,
                        'wfa_control_flag' => 2,
                        'force_deduct_wfa' => 0,
                        'adjusted_age' => 8,
                        'wfa_flat' => 3,
                        'wfa_jump' => 11,
                    ]
                ),
                2 => General::createFromArray(
                    [
                        'horse_uid' => 735305,
                        'race_instance_uid' => 617651,
                        'race_datetime' => date("Y-m-d ") . '12:00',
                        'race_type_code' => 'H',
                        'age' => 4,
                        'weight_carried_lbs' => 154,
                        'adjustment' => 168,
                        'allowance' => null,
                        'rp_postmark' => 94,
                        'rp_topspeed' => 82,
                        'wfa_control_flag' => 2,
                        'force_deduct_wfa' => 0,
                        'adjusted_age' => 8,
                        'wfa_flat' => 8,
                        'wfa_jump' => 5,
                    ]
                ),
            ],
            617651 => [
                0 => General::createFromArray(
                    [
                        'horse_uid' => 839210,
                        'race_instance_uid' => 636830,
                        'race_datetime' => '11/5/2015 2:55:00.000 PM',
                        'race_type_code' => 'H',
                        'age' => 4,
                        'weight_carried_lbs' => 154,
                        'adjustment' => 168,
                        'allowance' => null,
                        'rp_postmark' => 94,
                        'rp_topspeed' => 82,
                        'wfa_control_flag' => 2,
                        'force_deduct_wfa' => 0,
                        'adjusted_age' => 8,
                        'wfa_flat' => 3,
                        'wfa_jump' => 5,
                    ]
                ),
                1 => General::createFromArray(
                    [
                        'horse_uid' => 811858,
                        'race_instance_uid' => 617651,
                        'race_datetime' => date("Y-m-d ") . '12:00',
                        'race_type_code' => 'H',
                        'age' => 4,
                        'weight_carried_lbs' => 154,
                        'adjustment' => 168,
                        'allowance' => null,
                        'rp_postmark' => 94,
                        'rp_topspeed' => 82,
                        'wfa_control_flag' => 2,
                        'force_deduct_wfa' => 0,
                        'adjusted_age' => 8,
                        'wfa_flat' => 3,
                        'wfa_jump' => 11,
                    ]
                ),
                2 => General::createFromArray(
                    [
                        'horse_uid' => 735305,
                        'race_instance_uid' => 617651,
                        'race_datetime' => date("Y-m-d ") . '12:00',
                        'race_type_code' => 'H',
                        'age' => 4,
                        'weight_carried_lbs' => 154,
                        'adjustment' => 168,
                        'allowance' => null,
                        'rp_postmark' => 94,
                        'rp_topspeed' => 82,
                        'wfa_control_flag' => 2,
                        'force_deduct_wfa' => 0,
                        'adjusted_age' => 8,
                        'wfa_flat' => 8,
                        'wfa_jump' => 5,
                    ]
                ),
            ],
            616420 => [
                0 => General::createFromArray(
                    [
                        'horse_uid' => 839210,
                        'race_instance_uid' => 636830,
                        'race_datetime' => '11/5/2015 2:55:00.000 PM',
                        'race_type_code' => 'H',
                        'age' => 4,
                        'weight_carried_lbs' => 154,
                        'adjustment' => 168,
                        'allowance' => null,
                        'rp_postmark' => 94,
                        'rp_topspeed' => 82,
                        'wfa_control_flag' => 2,
                        'force_deduct_wfa' => 0,
                        'adjusted_age' => 8,
                        'wfa_flat' => 3,
                        'wfa_jump' => 5,
                    ]
                ),
                1 => General::createFromArray(
                    [
                        'horse_uid' => 811858,
                        'race_instance_uid' => 617651,
                        'race_datetime' => date("Y-m-d ") . '12:00',
                        'race_type_code' => 'H',
                        'age' => 4,
                        'weight_carried_lbs' => 154,
                        'adjustment' => 168,
                        'allowance' => null,
                        'rp_postmark' => 94,
                        'rp_topspeed' => 82,
                        'wfa_control_flag' => 2,
                        'force_deduct_wfa' => 0,
                        'adjusted_age' => 8,
                        'wfa_flat' => 3,
                        'wfa_jump' => 11,
                    ]
                ),
                2 => General::createFromArray(
                    [
                        'horse_uid' => 735305,
                        'race_instance_uid' => 617651,
                        'race_datetime' => date("Y-m-d ") . '12:00',
                        'race_type_code' => 'H',
                        'age' => 4,
                        'weight_carried_lbs' => 154,
                        'adjustment' => 168,
                        'allowance' => null,
                        'rp_postmark' => 94,
                        'rp_topspeed' => 82,
                        'wfa_control_flag' => 2,
                        'force_deduct_wfa' => 0,
                        'adjusted_age' => 8,
                        'wfa_flat' => 8,
                        'wfa_jump' => 5,
                    ]
                ),
            ],
        ];

        return $data[$race->race_instance_uid];
    }

    public function getWfa()
    {
        return 0;
    }

    public function checkRaceAbandoned($raceId)
    {
        return false;
    }

    public function getBettingForecast($raceId)
    {
        $arr = [
            652709 => [
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
        ];

        return (isset($arr[$raceId])) ? $arr[$raceId] : null;
    }

    public function getNapsTable()
    {
        return [
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
        ];
    }

    public function getTopNaps()
    {
        return [
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
        ];
    }

    /**
     * @param $race
     * @param $horses
     *
     * @return array
     */
    public function getHorsesRpr($race, $horses)
    {
        $data = [
            617651 => [
                839210 => [
                    0 => General::createFromArray(
                        [
                            'horse_uid' => 839210,
                            'rp_postmark' => 33,
                            'race_type_code' => 'F',
                        ]
                    ),
                ],
                811858 => [
                    0 => General::createFromArray(
                        [
                            'horse_uid' => 811858,
                            'rp_postmark' => 33,
                            'race_type_code' => 'F',
                        ]
                    ),
                ],
                735305 => [
                    0 => General::createFromArray(
                        [
                            'horse_uid' => 735305,
                            'rp_postmark' => 33,
                            'race_type_code' => 'J',
                        ]
                    ),
                ],
            ],
            637256 => [
                839210 => [
                    0 => General::createFromArray(
                        [
                            'horse_uid' => 839210,
                            'rp_postmark' => 33,
                            'race_type_code' => 'F',
                        ]
                    ),
                ],
                811858 => [
                    0 => General::createFromArray(
                        [
                            'horse_uid' => 811858,
                            'rp_postmark' => 33,
                            'race_type_code' => 'F',
                        ]
                    ),
                ],
                735305 => [
                    0 => General::createFromArray(
                        [
                            'horse_uid' => 735305,
                            'rp_postmark' => 33,
                            'race_type_code' => 'J',
                        ]
                    ),
                ],
            ],
            688111 => [
                1266744 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1266744,
                            'rp_postmark' => 67,
                            'race_type_code' => 'F',
                        ]),
                    1 =>
                        General::createFromArray([
                            'horse_uid' => 1266744,
                            'rp_postmark' => 68,
                            'race_type_code' => 'F',
                        ]),
                ],
                1314524 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1314524,
                            'rp_postmark' => 53,
                            'race_type_code' => 'F',
                        ]),
                    1 =>
                        General::createFromArray([
                            'horse_uid' => 1314524,
                            'rp_postmark' => 81,
                            'race_type_code' => 'X',
                        ]),
                ],
                1500671 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1500671,
                            'rp_postmark' => 60,
                            'race_type_code' => 'F',
                        ]),
                    1 =>
                        General::createFromArray([
                            'horse_uid' => 1500671,
                            'rp_postmark' => 61,
                            'race_type_code' => 'F',
                        ]),
                ],
                1540370 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1540370,
                            'rp_postmark' => 56,
                            'race_type_code' => 'F',
                        ]),
                    1 =>
                        General::createFromArray([
                            'horse_uid' => 1540370,
                            'rp_postmark' => 37,
                            'race_type_code' => 'F',
                        ]),
                ],
                1578953 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1578953,
                            'rp_postmark' => 73,
                            'race_type_code' => 'F',
                        ]),
                    1 =>
                        General::createFromArray([
                            'horse_uid' => 1578953,
                            'rp_postmark' => 70,
                            'race_type_code' => 'F',
                        ]),
                    2 =>
                        General::createFromArray([
                            'horse_uid' => 1578953,
                            'rp_postmark' => 62,
                            'race_type_code' => 'F',
                        ]),
                    3 =>
                        General::createFromArray([
                            'horse_uid' => 1578953,
                            'rp_postmark' => 42,
                            'race_type_code' => 'F',
                        ]),
                    4 =>
                        General::createFromArray([
                            'horse_uid' => 1578953,
                            'rp_postmark' => 65,
                            'race_type_code' => 'F',
                        ]),
                    5 =>
                        General::createFromArray([
                            'horse_uid' => 1578953,
                            'rp_postmark' => 64,
                            'race_type_code' => 'X',
                        ]),
                ],
                1592907 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1592907,
                            'rp_postmark' => 0,
                            'race_type_code' => 'F',
                        ]),
                    1 =>
                        General::createFromArray([
                            'horse_uid' => 1592907,
                            'rp_postmark' => 69,
                            'race_type_code' => 'X',
                        ]),
                ],
                1630943 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1630943,
                            'rp_postmark' => 73,
                            'race_type_code' => 'F',
                        ]),
                    1 =>
                        General::createFromArray([
                            'horse_uid' => 1630943,
                            'rp_postmark' => 69,
                            'race_type_code' => 'F',
                        ]),
                ],
                1632783 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1632783,
                            'rp_postmark' => 71,
                            'race_type_code' => 'F',
                        ]),
                    1 =>
                        General::createFromArray([
                            'horse_uid' => 1632783,
                            'rp_postmark' => 44,
                            'race_type_code' => 'F',
                        ]),
                ],
                1636586 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1636586,
                            'rp_postmark' => 54,
                            'race_type_code' => 'F',
                        ]),
                    1 =>
                        General::createFromArray([
                            'horse_uid' => 1636586,
                            'rp_postmark' => 65,
                            'race_type_code' => 'X',
                        ]),
                ],
                1659623 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1659623,
                            'rp_postmark' => 60,
                            'race_type_code' => 'X',
                        ]),
                    1 =>
                        General::createFromArray([
                            'horse_uid' => 1659623,
                            'rp_postmark' => 54,
                            'race_type_code' => 'X',
                        ]),
                ],
                1662717 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1662717,
                            'rp_postmark' => 66,
                            'race_type_code' => 'F',
                        ]),
                    1 =>
                        General::createFromArray([
                            'horse_uid' => 1662717,
                            'rp_postmark' => 66,
                            'race_type_code' => 'F',
                        ]),
                ],
                1676734 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1676734,
                            'rp_postmark' => 50,
                            'race_type_code' => 'F',
                        ]),
                ],
                1692210 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1692210,
                            'rp_postmark' => 53,
                            'race_type_code' => 'X',
                        ]),
                ],
                1692228 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1692228,
                            'rp_postmark' => 57,
                            'race_type_code' => 'F',
                        ]),
                ],
                1692230 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1692230,
                            'rp_postmark' => 66,
                            'race_type_code' => 'F',
                        ]),
                ],
                1692231 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1692231,
                            'rp_postmark' => 63,
                            'race_type_code' => 'F',
                        ]),
                ],
                1702104 => [
                    0 =>
                        General::createFromArray([
                            'horse_uid' => 1702104,
                            'rp_postmark' => 72,
                            'race_type_code' => 'X',
                        ]),
                ],
            ]
        ];
        return $data[$race->race_instance_uid];
    }

    /**
     * @param $race
     * @param $horses
     *
     * @return array
     */
    public function getHorsesTopspeed($race, $horses)
    {
        $data = [
            617651 => [
                839210 => General::createFromArray(
                    [
                        'horse_uid' => 839210,
                        'rp_topspeed' => 33,
                    ]
                ),
                811858 => General::createFromArray(
                    [
                        'horse_uid' => 811858,
                        'rp_topspeed' => 33,
                    ]
                ),
                735305 => General::createFromArray(
                    [
                        'horse_uid' => 735305,
                        'rp_topspeed' => 33,
                    ]
                ),
            ],
            637256 => [
                839210 => General::createFromArray(
                    [
                        'horse_uid' => 839210,
                        'rp_topspeed' => 33,
                    ]
                ),
                811858 => General::createFromArray(
                    [
                        'horse_uid' => 811858,
                        'rp_topspeed' => 33,
                    ]
                ),
                735305 => General::createFromArray(
                    [
                        'horse_uid' => 735305,
                        'rp_topspeed' => 33,
                    ]
                ),
            ],
            688111 => [
                1314524 =>
                    General::createFromArray([
                        'horse_uid' => 1314524,
                        'rp_topspeed' => 74,
                    ]),
                1578953 =>
                    General::createFromArray([
                        'horse_uid' => 1578953,
                        'rp_topspeed' => 16,
                    ]),
                1592907 =>
                    General::createFromArray([
                        'horse_uid' => 1592907,
                        'rp_topspeed' => 61,
                    ]),
                1636586 =>
                    General::createFromArray([
                        'horse_uid' => 1636586,
                        'rp_topspeed' => 57,
                    ]),
                1659623 =>
                    General::createFromArray([
                        'horse_uid' => 1659623,
                        'rp_topspeed' => 27,
                    ]),
                1692210 =>
                    General::createFromArray([
                        'horse_uid' => 1692210,
                        'rp_topspeed' => 42,
                    ]),
                1702104 =>
                    General::createFromArray([
                        'horse_uid' => 1702104,
                        'rp_topspeed' => 45,
                    ]),
            ]
        ];
        return $data[$race->race_instance_uid];
    }
}
