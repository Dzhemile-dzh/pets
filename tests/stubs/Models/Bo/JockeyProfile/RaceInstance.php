<?php

namespace Tests\Stubs\Models\Bo\JockeyProfile;

use Tests\Stubs\Models\RaceInstance as Model;
use Tests\Stubs\Models\StubDataGetter;
use Api\Row\RaceInstance as RiRow;

class RaceInstance extends Model
{
    use StubDataGetter;

    /**
     * @param int $jockeyUid
     *
     * @return array
     */
    public function getLast14Days($jockeyUid)
    {
        $data = [
            80136 => array(
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
                    )),
            ),
        ];

        return $data[$jockeyUid];
    }

    /**
     * @param int $jockeyUid
     *
     * @return array
     */
    public function getSinceAWin($jockeyUid)
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
     * @param int $jockeyUid
     *
     * @return array
     */
    public function getBookedRides($jockeyUid)
    {
        return [
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
        ];
    }

    public function getBigRaceWins($jockeyUid)
    {

        $rtn = [
            80136 => array(
                668478 =>
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
                    )),
                646612 =>
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
                    )),
            ),
        ];

        return isset($rtn[$jockeyUid]) ? $rtn[$jockeyUid] : null;
    }
}
