<?php

namespace Tests\Stubs\Models\Bo\TrainerProfile;

use Tests\Stubs\Models\StubDataGetter;
use Api\Row\RaceInstance as RiRow;

class RaceInstance extends \Tests\Stubs\Models\RaceInstance
{
    use StubDataGetter;

    /**
     * @param $trainerUid
     *
     * @return mixed
     */

    public function getBigRaceWins($trainerUid)
    {

        $rtn = [
            9036 => array(
                654428 =>
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
                    )),
                650030 =>
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
                    )),
            ),
        ];

        return isset($rtn[$trainerUid]) ? $rtn[$trainerUid] : null;
    }

    /**
     * @param $trainerId
     *
     * @return array
     */
    public function getLast14Days($trainerId)
    {
        $data = [
            9036 => array(
                684818 =>
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
                    )),
                687359 =>
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
                    )),
            )
        ];

        return $data[$trainerId];
    }

    /**
     * @param int $trainerId
     *
     * @return array
     */
    public function getSinceAWin($trainerId)
    {
        return [
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
        ];
    }

    /**
     * @param StatisticalSummary $request
     *
     * @return mixed
     */
    public function getStatisticalSummary($request)
    {
        $data = [
            'IRE_jumps__14006' => array(
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
            ),
            'GB_flat_turf_26099' => array(
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
        ];

        return $data[self::getRequestKey($request)];
    }

    /**
     * @param $trainerId
     *
     * @return array
     */
    public function getEntries($trainerId)
    {
        return [
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
        ];
    }

    /**
     * @return array
     */
    public function getResults()
    {
        return array(
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
                )),
        );
    }
}
