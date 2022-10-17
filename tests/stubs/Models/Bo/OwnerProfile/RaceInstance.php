<?php
/**
 * Created by PhpStorm.
 * User: Kateryna_Vozniuk
 * Date: 2/11/2015
 * Time: 1:57 PM
 */

namespace Tests\Stubs\Models\Bo\OwnerProfile;

use Tests\Stubs\Models\RaceInstance as Model;
use Tests\Stubs\Models\StubDataGetter;
use Api\Row\RaceInstance as RiRow;
use Api\Row\OwnerProfile\Owner as OwnerRow;

class RaceInstance extends Model
{
    use StubDataGetter;

    public function getBigRaceWins($jockeyUid)
    {

        $rtn = [
            11234 => array(
                669615 =>
                    RiRow::createFromArray(array(
                        'race_date' => 'Feb 26 2017  4:20PM',
                        'rp_abbrev_3' => 'NAA',
                        'country' => 'IRE',
                        'distance_yard' => 3520,
                        'race_instance_uid' => 669615,
                        'race_instance_title' => 'We Show All Live Racing Chase (Grade 3)',
                        'course_name' => 'NAAS',
                        'course_style_name' => 'Naas',
                        'trainer_short_name' => 'H De Bromhead',
                        'trainer_ptp_type_code' => 'N',
                        'prize_sterling' => 24358.970000000001,
                        'prize_euro' => 28500,
                        'days_diff' => 235,
                        'race_outcome_code' => '1',
                        'race_outcome_position' => 1,
                        'disq_desc' => null,
                        'horse_style_name' => 'Alisier D\'Irlande',
                        'country_origin_code' => 'FR',
                        'horse_uid' => 857888,
                        'trainer_style_name' => 'Henry De Bromhead',
                        'trainer_uid' => 1249,
                        'race_type_code' => 'C',
                        'race_group_desc' => 'Grade 3',
                        'race_group_code' => '9',
                        'course_uid' => 192,
                        'course_type_code' => 'B',
                    )),
                667040 =>
                    RiRow::createFromArray(array(
                        'race_date' => 'Jan 29 2017  2:30PM',
                        'rp_abbrev_3' => 'LEO',
                        'country' => 'IRE',
                        'distance_yard' => 3740,
                        'race_instance_uid' => 667040,
                        'race_instance_title' => 'Frank Ward Solicitors Arkle Novice Chase (Grade 1)',
                        'course_name' => 'LEOPARDSTOWN',
                        'course_style_name' => 'Leopardstown',
                        'trainer_short_name' => 'H De Bromhead',
                        'trainer_ptp_type_code' => 'N',
                        'prize_sterling' => 46153.849999999999,
                        'prize_euro' => 54000,
                        'days_diff' => 263,
                        'race_outcome_code' => '1',
                        'race_outcome_position' => 1,
                        'disq_desc' => null,
                        'horse_style_name' => 'Some Plan',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 847746,
                        'trainer_style_name' => 'Henry De Bromhead',
                        'trainer_uid' => 1249,
                        'race_type_code' => 'C',
                        'race_group_desc' => 'Grade 1',
                        'race_group_code' => '7',
                        'course_uid' => 187,
                        'course_type_code' => 'B',
                    )),
            ),
        ];

        return isset($rtn[$jockeyUid]) ? $rtn[$jockeyUid] : null;
    }

    /**
     * @param $ownerId
     *
     * @return array
     */
    public function getEntries($ownerId)
    {
        return [
            (Object)[
                "race_instance_uid" => 598046,
                "race_datetime" => "Mar 11 2015  3:20PM",
                "course_name" => "CHELTENHAM",
                "course_style_name" => "Cheltenham",
                "race_instance_title" => "Betway Queen Mother Champion Chase Grade 1",
                "race_status_code" => "C",
                "horse_name" => "Finian's Rainbow",
                "horse_uid" => 702302,
                "course_uid" => 28,
                "coures_type_code" => "N",
                'running_conditions' => null,
            ],
            (Object)[
                "race_instance_uid" => 614837,
                "race_datetime" => "Mar 12 2015  2:40PM",
                "course_name" => "CHELTENHAM",
                "course_style_name" => "Cheltenham",
                "race_instance_title" => "Ryanair Chase (Registered As The Festival Trophy Steeple Chase) Grade 1",
                "race_status_code" => "C",
                "horse_name" => "Finian's Rainbow",
                "horse_uid" => 702302,
                "course_uid" => 195,
                "coures_type_code" => "N",
                'running_conditions' => null,
            ],
            (Object)[
                "race_instance_uid" => 598076,
                "race_datetime" => "Mar 12 2015  3:20PM",
                "course_name" => "CHELTENHAM",
                "course_style_name" => "Cheltenham",
                "race_instance_title" => "Ladbrokes World Hurdle Grade 1",
                "race_status_code" => "C",
                "horse_name" => "Beat That",
                "horse_uid" => 830217,
                "course_uid" => 195,
                "coures_type_code" => "N",
                'running_conditions' => null,
            ],
            (Object)[
                "race_instance_uid" => 592366,
                "race_datetime" => "Jun  6 2015  4:00PM",
                "course_name" => "EPSOM",
                "course_style_name" => "Epsom",
                "race_instance_title" => "Investec Derby (Group 1) (Entire Colts & Fillies)",
                "race_status_code" => "C",
                "horse_name" => "Sleight Of Hand",
                "horse_uid" => 851295,
                "course_uid" => 195,
                "coures_type_code" => "N",
                'running_conditions' => null,
            ]
        ];
    }

    /**
     * @param int $ownerUid
     *
     * @return array
     */
    public function getLast14Days($ownerUid)
    {
        $data = [
            11234 => array(
                684474 =>
                    RiRow::createFromArray(array(
                        'race_instance_uid' => 684474,
                        'race_datetime' => 'Oct 14 2017  3:35PM',
                        'course_uid' => 12,
                        'race_instance_title' => 'Paul Ferguson\'s Jumpers To Follow Hurdle (A Limited Handicap)',
                        'race_type_code' => 'H',
                        'distance_yard' => 3531,
                        'horse_uid' => 890420,
                        'horse_style_name' => 'Champagne City',
                        'horse_country_origin_code' => 'GB',
                        'weight_carried_lbs' => 152,
                        'rp_betting_movements' => 'tchd 15/2',
                        'course_rp_abbrev_3' => 'CHP',
                        'course_rp_abbrev_4' => 'Chep',
                        'course_name' => 'CHEPSTOW',
                        'course_style_name' => 'Chepstow',
                        'course_type_code' => 'B',
                        'course_code' => 'CHEP',
                        'first_time_yn' => null,
                        'rp_postmark_difference' => -18,
                        'race_outcome_code' => '7',
                        'odds_value' => 7,
                        'trainer_short_name' => 'T George',
                        'trainer_ptp_type_code' => 'N',
                        'going_type_services_desc' => 'GS',
                        'prize_sterling' => 12996,
                        'prize_euro' => 0,
                        'race_outcome_position' => 7,
                        'no_of_runners' => 10,
                        'rp_close_up_comment' => 'badly hampered 1st, behind, effort on outside and in touch before 5th, weakened next',
                        'rp_horse_head_gear_code' => null,
                        'odds_desc' => '7/1',
                        'trainer_uid' => 8036,
                        'trainer_style_name' => 'Tom George',
                        'rp_postmark' => 107,
                        'rp_pre_postmark' => 125,
                        'actual_race_class' => '2',
                        'rp_ages_allowed_desc' => '4yo',
                        'race_group_code' => 'H',
                        'race_group_desc' => 'Handicap',
                        'race_output_order' => 7,
                        'orig_race_output_order' => 7,
                        'dtw_rp_distance_desc' => null,
                        'dtw_sum_distance_value' => 35,
                        'dtw_count_horse_race' => 0,
                        'dtw_total_distance_value' => 38.75,
                    )),
                686289 =>
                    RiRow::createFromArray(array(
                        'race_instance_uid' => 686289,
                        'race_datetime' => 'Oct 13 2017  2:50PM',
                        'course_uid' => 179,
                        'race_instance_title' => 'I.N.H. Stallion Owners EBF Maiden Hurdle',
                        'race_type_code' => 'H',
                        'distance_yard' => 4950,
                        'horse_uid' => 978937,
                        'horse_style_name' => 'Whispering Affair',
                        'horse_country_origin_code' => 'GB',
                        'weight_carried_lbs' => 151,
                        'rp_betting_movements' => null,
                        'course_rp_abbrev_3' => 'DPT',
                        'course_rp_abbrev_4' => 'Dpat',
                        'course_name' => 'DOWNPATRICK',
                        'course_style_name' => 'Downpatrick',
                        'course_type_code' => 'B',
                        'course_code' => 'DOWN',
                        'first_time_yn' => null,
                        'rp_postmark_difference' => 6,
                        'race_outcome_code' => '2',
                        'odds_value' => 25,
                        'trainer_short_name' => 'S Crawford',
                        'trainer_ptp_type_code' => 'N',
                        'going_type_services_desc' => 'Y',
                        'prize_sterling' => 7478.6300000000001,
                        'prize_euro' => 8750,
                        'race_outcome_position' => 2,
                        'no_of_runners' => 9,
                        'rp_close_up_comment' => 'close up early until soon settled behind leaders, disputed close 4th 4 out, pushed along into 2nd after 2 out and no impression on easy winner before last, kept on well run-in',
                        'rp_horse_head_gear_code' => null,
                        'odds_desc' => '25/1',
                        'trainer_uid' => 16596,
                        'trainer_style_name' => 'S R B Crawford',
                        'rp_postmark' => 109,
                        'rp_pre_postmark' => 103,
                        'actual_race_class' => null,
                        'rp_ages_allowed_desc' => '5yo+',
                        'race_group_code' => '0',
                        'race_group_desc' => 'Unknown',
                        'race_output_order' => 2,
                        'orig_race_output_order' => 2,
                        'dtw_rp_distance_desc' => '3',
                        'dtw_sum_distance_value' => 3,
                        'dtw_count_horse_race' => 0,
                        'dtw_total_distance_value' => 121.25,
                    )),
            )
        ];
        return $data[$ownerUid];
    }

    /**
     * @param int $ownerUid
     *
     * @return array
     */
    public function getSinceAWin($ownerUid)
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
     * @param \Api\Input\Request\Horses\Profile\Owner\Results $request
     *
     * @return array
     */
    public function getResults(\Api\Input\Request\Horses\Profile\Owner\Results $request)
    {
        return
            array(
                649705 =>
                    OwnerRow::createFromArray(array(
                        'race_datetime' => 'Apr 25 2016  4:50PM',
                        'rp_abbrev_3' => 'AYR',
                        'country_code' => 'GB ',
                        'distance_yard' => 1760,
                        'race_instance_uid' => 649705,
                        'race_instance_title' => 'Conference And Events At Ayr Racecourse Handicap (Div II)',
                        'course_style_name' => 'Ayr',
                        'trainer_short_name' => 'A Whillans',
                        'trainer_ptp_type_code' => 'N',
                        'horse_style_name' => 'Galilee Chapel',
                        'country_origin_code' => 'IRE',
                        'horse_uid' => 784622,
                        'prize_sterling' => 0,
                        'prize_euro' => 0,
                        'days_diff' => 547,
                        'race_outcome_code' => '9',
                        'race_outcome_position' => 9,
                        'disq_desc' => null,
                        'trainer_style_name' => 'Alistair Whillans',
                        'trainer_uid' => 4180,
                        'race_type_code' => 'F',
                        'race_group_desc' => 'Handicap',
                        'race_group_code' => 'H',
                        'course_uid' => 3,
                        'course_type_code' => 'B',
                    )),
                647800 =>
                    OwnerRow::createFromArray(array(
                        'race_datetime' => 'May  1 2016  5:05PM',
                        'rp_abbrev_3' => 'HAM',
                        'country_code' => 'GB ',
                        'distance_yard' => 1828,
                        'race_instance_uid' => 647800,
                        'race_instance_title' => 'Jordan Electrics Handicap',
                        'course_style_name' => 'Hamilton',
                        'trainer_short_name' => 'A Whillans',
                        'trainer_ptp_type_code' => 'N',
                        'horse_style_name' => 'Gun Case',
                        'country_origin_code' => 'GB',
                        'horse_uid' => 866896,
                        'prize_sterling' => 0,
                        'prize_euro' => 0,
                        'days_diff' => 541,
                        'race_outcome_code' => '9',
                        'race_outcome_position' => 9,
                        'disq_desc' => null,
                        'trainer_style_name' => 'Alistair Whillans',
                        'trainer_uid' => 4180,
                        'race_type_code' => 'F',
                        'race_group_desc' => 'Handicap',
                        'race_group_code' => 'H',
                        'course_uid' => 22,
                        'course_type_code' => 'F',
                    )),
            );
    }
}
