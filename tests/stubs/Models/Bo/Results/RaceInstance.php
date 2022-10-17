<?php

namespace Tests\Stubs\Models\Bo\Results;

use \Phalcon\Mvc\Model\Row\General as GeneralRow;
use Api\Row\RaceInstance as RiRow;

/**
 * Class RaceInstance
 *
 * @package Tests\Stubs\Models\Bo\Results
 */
class RaceInstance extends \Tests\Stubs\Models\RaceInstance
{

    /**
     * @param int $raceId
     *
     * @return \Phalcon\Mvc\ModelInterface
     */
    public function getStatistic($raceId)
    {
        return GeneralRow::createFromArray(
            [
                (object)[


                    'zenithOfficial' => 90.833333330000002,
                    'race_instance_uid' => 582658,
                    'winners_time_secs' => 57.579999999999998,
                    'diff_to_standard_time_sec' => null,
                    'total_sp' => '10.023809523809500',
                    'course_uid' => 1017,
                    'no_of_runners' => 11,
                    'no_of_runners_calculated' => 11,
                    'average_time_sec' => null,
                    'odds_value' => 1,
                    'total_sp' => null,
                    'country_code' => 'PER',
                ]
            ]
        );
    }


    /**
     * @param int $raceId
     *
     * @return \Phalcon\Mvc\ModelInterface
     */
    public function getOddsValue($raceId)
    {
        return GeneralRow::createFromArray(
            [
                'zenithOfficial' => 90.83333333,
                'dayCode' => 'D',
                'nightCode' => 'N',
                'odds_value' => 5.0,
            ]
        );
    }


    /**
     * @param array $raceId
     *
     * @return \Phalcon\Mvc\Model\Row
     */
    public function getTote(array $raceId)
    {

        $data = [
            '582658' => [
                582658 => GeneralRow::createFromArray(
                    [
                        'tote_deadheat_text' => 'PARI-MUTUEL: WIN (all including 3 pen stakes): 31.50; PLACE (1-2): 13.80, 13.50; SF (including 2 pen stake): 98.00',
                        'tote_win_money' => null,
                        'tote_place_1_money' => null,
                        'tote_place_2_money' => null,
                        'tote_place_3_money' => null,
                        'tote_place_4_money' => null,
                        'tote_dual_forecast_money' => null,
                        'computer_strght_frcst_money' => null,
                        'tricast_money' => null,
                        'tote_trio_money' => null,
                        'trio_text' => ' ',
                        'jackpot_text' => null,
                        'placepot_text' => null,
                        'quadpot_text' => null,
                        'rule4_text' => null,
                        'selling_details_text' => null,
                        'days_diff' => 4902,
                        'country_code' => 'PER',
                        'race_comments' => null,
                        'race_status_code' => 'R',
                        'race_instance_uid' => 582658,
                        'scoop6_dividend' => null,
                    ]
                )
            ],
            '536417' => [
                536417 =>
                    GeneralRow::createFromArray([
                        'race_instance_uid' => 536417,
                        'race_status_code' => 'R',
                        'course_country_code' => 'GB ',
                        'days_diff' => 4217,
                        'race_comments' => 'After a stewards\' inquiry, the placings remained unaltered.',
                        'tote_deadheat_text' => null,
                        'tote_win_money' => 4.0999999999999996,
                        'tote_place_1_money' => 1.8,
                        'tote_place_2_money' => 1.2,
                        'tote_place_3_money' => null,
                        'tote_place_4_money' => null,
                        'tote_dual_forecast_money' => 6.4000000000000004,
                        'computer_strght_frcst_money' => 8.6799999999999997,
                        'tricast_money' => null,
                        'tote_trio_money' => null,
                        'trio_text' => null,
                        'jackpot_text' => null,
                        'placepot_text' => null,
                        'quadpot_text' => null,
                        'rule4_text' => null,
                        'selling_details_text' => null,
                        'scoop6_dividend' => null,
                    ]),
            ],
            '688527' => [
                688527 =>
                    GeneralRow::createFromArray([
                        'race_instance_uid' => 688527,
                        'race_status_code' => 'R',
                        'course_country_code' => 'GB ',
                        'days_diff' => 6520,
                        'race_comments' => null,
                        'tote_deadheat_text' => null,
                        'tote_win_money' => 1.3999999999999999,
                        'tote_place_1_money' => 1.02,
                        'tote_place_2_money' => 2.5,
                        'tote_place_3_money' => 8.5999999999999996,
                        'tote_place_4_money' => null,
                        'tote_dual_forecast_money' => 6.7000000000000002,
                        'computer_strght_frcst_money' => 5.4699999999999998,
                        'tricast_money' => null,
                        'tote_trio_money' => 139.09999999999999,
                        'trio_text' => null,
                        'jackpot_text' => null,
                        'placepot_text' => '�27.40 to a �1 stake. Pool: �51,934.50 - 1,380.01 winning units',
                        'quadpot_text' => '�9.20 to a �1 stake. Pool: �8,209.73 - 655.04 winning units',
                        'rule4_text' => null,
                        'selling_details_text' => null,
                        'scoop6_dividend' => null,
                    ]),
            ]

        ];

        return $data[implode(',', $raceId)];
    }

    /**
     * @param integer $raceId
     *
     * @return object
     */
    public function getRaceInfo($raceId)
    {
        $data = [
            582658 => GeneralRow::createFromArray(
                array(
                    'course_uid' => 1017,
                    'race_instance_title' => 'Premio America (Group 2) (3yo+) (Dirt)',
                    'race_datetime' => 'Jun 23 2013  9:40PM',
                    'race_start_datetime' => 'Jun 23 2013 12:00AM',
                    'race_type_code' => 'X',
                    'race_group_desc' => 'Group 2',
                    'distance_yard' => 1100,
                    'rp_omitted_fences' => 0,
                    'rp_analysis' => null,
                    'course_name' => 'MONTERRICO',
                    'course_style_name' => 'Monterrico',
                    'country_code' => 'PER',
                    'official_rating_band_desc' => null,
                    'straight_round_jubilee_code' => null,
                    'straight_round_jubilee_desc' => null,
                    'rp_straight_round_jubilee_desc' => null,
                    'going_type_desc' => 'Standard',
                    'going_type_code' => 'SD',
                    'meeting_name' => null,
                    'meeting_date' => 'Jun 23 2013 12:00AM',
                    'going_desc' => 'DIRT: STANDARD; TURF: GOOD',
                    'stalls_position' => null,
                    'misc_text' => null,
                    'weather_cond' => null,
                    'rails' => null,
                    'wind' => null,
                    'meeting_abandoned' => 'N',
                    'abandoned_reason' => null,
                    'jackpot_text' => null,
                    'placepot_text' => null,
                    'quadpot_text' => null,
                    'no_of_fences' => null,
                    'rp_ages_allowed_desc' => '3yo+',
                    'eyecatcher_horse_uid' => null,
                    'eyecatcher_style_name' => null,
                    'eyecatcher_country_code' => null,
                    'eyecatcher_notes' => null,
                    'star_performer_horse_uid' => null,
                    'star_performer_style_name' => null,
                    'star_performer_country_code' => null,
                    'star_performer_notes' => null,
                    'race_comments' => null,
                    'start_flag_yn' => ' ',
                    'race_status_code' => 'R',
                    'race_instance_uid' => 582658,
                    'tote_deadheat_text' => 'PARI-MUTUEL: WIN (all including 3 pen stakes): 31.50; PLACE (1-2): 13.80, 13.50; SF (including 2 pen stake): 98.00',
                    'tote_win_money' => null,
                    'tote_place_1_money' => null,
                    'tote_place_2_money' => null,
                    'tote_place_3_money' => null,
                    'tote_place_4_money' => null,
                    'tote_dual_forecast_money' => null,
                    'computer_strght_frcst_money' => null,
                    'tricast_money' => null,
                    'tote_trio_money' => null,
                    'trio_text' => ' ',
                    'rule4_text' => null,
                    'selling_details_text' => null,
                    'country_desc' => 'Peru',
                    'race_surface' => null,
                    'aw_surface_type' => null,
                    'race_attrib_desc' => null,
                    'number_of_fences' => null,
                    'dist_number_of_fences' => null,

                )
            ),
            599697 => GeneralRow::createFromArray(array(
                'course_uid' => 12,
                'race_instance_title' => 'Unibet Offering 5 Places In National Novices\' Hurdle (Div II)',
                'race_datetime' => 'Apr  5 2014  1:55PM',
                'race_start_datetime' => 'Apr  5 2014  1:55PM',
                'race_type_code' => 'H',
                'race_group_desc' => 'Unknown',
                'distance_yard' => 3531,
                'rp_omitted_fences' => null,
                'rp_analysis' => 'This looked the weaker of the two divisions, especially once the 119-rated Bodega became a non-runner. The overall time was quicker, thanks to a strong early pace.\\n
\\b SUCH A LEGEND\\p, second on his previous two outings over hurdles, benefited from a patient ride and was given plenty of time to reel in the leaders on ground that was reportedly softer than ideal. He looks very much a chaser in the making, as could be seen in the way he jumped his hurdles, so it is not surprising that connections are thinking of sending him over fences next month, where he should continue to improve.\\n
\\b Rock On Rocky\\p ran well at a huge price on his hurdling debut over C&D last month, and improved on that effort. He led around the final turn and struck for home early in the straight, and kept on once headed at the last.\\n
\\b Storm Of Swords\\p made it a line of three going to the last but, not for the first time, did not keep on that well. He got warm beforehand and looked uncomfortable on the track so there were excuses.\\n
\\b Reillys Daughter\\p pulled her way into an early lead, as she had over C&D last month, but this time her run petered out before they left the back straight.   [Sandra Noble]\\n
\\bQUOTES\\p: Kim Bailey\'s assistant Matt Nicholls: \\b Such A Legend\\p would have preferred better ground and with that in mind there is very chance that he will go chasing after May 1st and carry on over the spring and summer.',
                'course_name' => 'CHEPSTOW',
                'course_style_name' => 'Chepstow',
                'country_code' => 'GB',
                'official_rating_band_desc' => null,
                'straight_round_jubilee_code' => null,
                'straight_round_jubilee_desc' => null,
                'rp_straight_round_jubilee_desc' => null,
                'going_type_desc' => 'Good To Soft',
                'going_type_code' => 'GS',
                'meeting_name' => null,
                'meeting_date' => 'Apr  5 2014 12:00AM',
                'going_desc' => 'GOOD TO SOFT (Soft in places) changing to SOFT after Race 4 (3.05)',
                'stalls_position' => null,
                'misc_text' => null,
                'weather_cond' => 'overcast, rain threatening',
                'rails' => null,
                'wind' => 'light, half against',
                'meeting_abandoned' => 'N',
                'abandoned_reason' => null,
                'jackpot_text' => null,
                'placepot_text' => '�104.60 to a �1 stake. Pool of �64968.99 - 453.17 winning tickets.',
                'quadpot_text' => '�149.60 to a �1 stake. Pool of �3740.20 - 18.50 winning tickets.',
                'no_of_fences' => 8,
                'rp_ages_allowed_desc' => '4yo+',
                'eyecatcher_horse_uid' => null,
                'eyecatcher_style_name' => null,
                'eyecatcher_country_code' => null,
                'eyecatcher_notes' => null,
                'star_performer_horse_uid' => null,
                'star_performer_style_name' => null,
                'star_performer_country_code' => null,
                'star_performer_notes' => null,
                'race_comments' => null,
                'start_flag_yn' => 'N',
                'race_status_code' => 'R',
                'race_instance_uid' => 599697,
                'tote_deadheat_text' => null,
                'tote_win_money' => 1.5,
                'tote_place_1_money' => 1.02,
                'tote_place_2_money' => 3,
                'tote_place_3_money' => 1.1000000000000001,
                'tote_place_4_money' => null,
                'tote_dual_forecast_money' => 12.300000000000001,
                'computer_strght_frcst_money' => 12.02,
                'tricast_money' => null,
                'tote_trio_money' => 13.300000000000001,
                'trio_text' => null,
                'rule4_text' => null,
                'selling_details_text' => null,
                'country_desc' => 'Great Britain',
                'race_surface' => null,
                'aw_surface_type' => null,
                'race_attrib_desc' => null,
                'number_of_fences' => null,
                'dist_number_of_fences' => null,
            )),

        ];

        return $data[$raceId];
    }


    /**
     * @param string $date
     */
    public function getRaceListByDate($date)
    {
        $data = [
            '2011-08-08' => [
                0 =>
                    RiRow::createFromArray([
                        'race_instance_uid' => 536417,
                        'race_datetime' => 'Aug  8 2011  2:00PM',
                        'race_instance_title' => 'Fizztival At Lingfield Park 13th August Handicap (Turf)',
                        'alt_race_title' => null,
                        'formbook_yn' => 'Y',
                        'going_type_code' => 'S',
                        'race_class' => '5',
                        'aw_surface_type' => null,
                        'race_type_code' => 'F',
                        'r_dist' => 3588,
                        'rp_ages_allowed_desc' => '4yo+',
                        'r_status' => 'R',
                        'crs_id' => 31,
                        'mixed_crs_id' => null,
                        'course_name' => 'LINGFIELD',
                        'course_style_name' => 'Lingfield',
                        'mnemonic' => 'LIN',
                        'replaced_aw' => null,
                        'abandoned' => 0,
                        'rp_abbrev_3' => 'LIN',
                        'course_country' => 'GB',
                        'course_type_code' => 'B',
                        'graphic_name' => null,
                        'graphic_height' => null,
                        'rp_flat_course_comment' => 'left-handed, sharp track',
                        'rp_jump_course_comment' => 'left-handed, sharp, undulating track',
                        'going_desc' => 'Turf course - SOFT (7.6); All-Weather - STANDARD',
                        'weather_cond' => 'bright spells, showers',
                        'additional_ordering' => 1,
                        'no_of_runners' => null,
                        'no_of_runners_calculated' => 5,
                        'stalls_position' => 'Turf: 1m 3f 106yds - Outside; Remainder - Inside; All-Weather: 5f - Outside; Remainder - Inside',
                        'prize' => 2385.9499999999998,
                        'totes' => null,
                        'winner_time' => 221.61000000000001,
                        'diff_to_standard_time_sec' => 14.109999999999999,
                        'scoop' => null,
                        'race_group_desc' => 'Handicap',
                        'race_group_code' => 'H',
                        'is_gb_or_ire' => 1,
                        'has_details' => 0,
                        'rp_omitted_fences' => null,
                        'no_of_fences' => null,
                        'straight_round_jubilee_code' => null,
                        'straight_round_jubilee_desc' => null,
                        'rp_straight_round_jubilee_desc' => null,
                        'is_worldwide_stake' => 0,
                        'eyecatcher_horse_uid' => null,
                        'eyecatcher_style_name' => null,
                        'eyecatcher_country_code' => null,
                        'eyecatcher_notes' => null,
                        'star_performer_horse_uid' => null,
                        'star_performer_style_name' => null,
                        'star_performer_country_code' => null,
                        'star_performer_notes' => null,
                        'fast_race_instance_uid' => null,
                        'official_rating_band_desc' => '0-75',
                        'country_desc' => 'Great Britain',
                        'wind' => 'fresh, half against',
                        'rp_analysis' => 'A moderate staying contest run at a fair pace.\\n
\\bMORAR\\p had conditions to suit and stayed on best after being ridden with patience, although her chance was helped by Harry Bentley giving \\bMohanad\\p a really poor ride. The runner-up\'s jockey was caught out when the winner swept by early in the straight to very much get first run, and then in the closing stages Bentley continually tried to squeeze through an almost not-existent gap between his main rival and the rail.\\n
The winner didn\'t make things easy on the second, edging left, and she had to survive a stewards\' enquiry.\\n
Mohanad was 6lb higher than when winning over C&D under this rider last time.\\n
There was a long way back to \\bSinbad The Sailor\\p, who had won over hurdles since last seen on the Flat. Returning from over two months off, he had a visor back on but probably found the ground too soft.\\n
\\bTobernea\\p should have been suited by conditions but he continues out of form.\\n
\\bAlbeed\\p, fitted with blinkers for the first time, was reported to have run too free. \\b[RW]\\p\\n
\\bQUOTES\\p: Laura Mongan, trainer of \\bMorar\\p: "It\'s nice to win on the Flat with her. She is not too big but will go jumping again now and loves soft ground."',
                        'going_type_desc' => 'Soft',
                        'rp_admission_prices' => 'see www.lingfieldpark.co.uk/ or tel 01342 834800',
                        'total_sp' => '109.915694698408500',
                    ]),
            ],
            '1977-07-07' => null,
            '2017-11-27' => [
                0 =>
                    RiRow::createFromArray([
                        'race_instance_uid' => 688527,
                        'race_datetime' => 'Nov 27 2017 12:35PM',
                        'race_instance_title' => 'Placepot Quadpot Two Bets One Slip Maiden Hurdle',
                        'alt_race_title' => null,
                        'formbook_yn' => 'Y',
                        'going_type_code' => 'GS',
                        'race_class' => '4',
                        'aw_surface_type' => null,
                        'race_type_code' => 'H',
                        'r_dist' => 3469,
                        'rp_ages_allowed_desc' => '4yo+',
                        'r_status' => 'R',
                        'crs_id' => 34,
                        'mixed_crs_id' => null,
                        'course_name' => 'LUDLOW',
                        'course_style_name' => 'Ludlow',
                        'mnemonic' => 'LUD',
                        'replaced_aw' => null,
                        'abandoned' => 0,
                        'rp_abbrev_3' => 'LUD',
                        'course_country' => 'GB',
                        'course_type_code' => 'J',
                        'graphic_name' => 'ludmapj.eps',
                        'graphic_height' => 112,
                        'rp_flat_course_comment' => null,
                        'rp_jump_course_comment' => 'right-handed, sharp track',
                        'going_desc' => 'GOOD TO SOFT (Good in places on Chase course; soft in places on Hurdle course; 6.2)',
                        'weather_cond' => 'Overcast',
                        'additional_ordering' => 1,
                        'no_of_runners' => null,
                        'no_of_runners_calculated' => 16,
                        'stalls_position' => ' ',
                        'prize' => 4548.6000000000004,
                        'totes' => null,
                        'winner_time' => 236.09999999999999,
                        'diff_to_standard_time_sec' => 18.100000000000001,
                        'scoop' => null,
                        'race_group_desc' => 'Unknown',
                        'race_group_code' => '0',
                        'is_gb_or_ire' => 1,
                        'has_details' => 1,
                        'rp_omitted_fences' => null,
                        'no_of_fences' => 9,
                        'straight_round_jubilee_code' => null,
                        'straight_round_jubilee_desc' => null,
                        'rp_straight_round_jubilee_desc' => null,
                        'is_worldwide_stake' => 0,
                        'eyecatcher_horse_uid' => 1461645,
                        'eyecatcher_style_name' => 'Way Out West',
                        'eyecatcher_country_code' => 'IRE',
                        'eyecatcher_notes' => '\\b(12.35)\\p kept on steadily in the opening maiden hurdle',
                        'star_performer_horse_uid' => null,
                        'star_performer_style_name' => null,
                        'star_performer_country_code' => null,
                        'star_performer_notes' => null,
                        'fast_race_instance_uid' => null,
                        'official_rating_band_desc' => null,
                        'country_desc' => 'Great Britain',
                        'wind' => 'Light against',
                        'rp_analysis' => 'All rails on the inside line so no change to advertised race distances. After riding in the first, which took 18.1sec longer than standard, Alan Johns called the ground "soft" and Ben Poste thought it was "soft, good to soft in places." A few winners should emerge from this maiden  hurdle, in which the first three finished clear. The winner can rate higher and the sixth helps set the level.  \\n \\bNEW TO THIS TOWN\\p was a useful bumper horse for Jessica Harrington but his first season over hurdles didn\'t go according to plan, albeit he was highly tried at times. He seemed unsuited by the drop back to 2m on this sharp track and needed rousting along at times, but still proved good enough to make a winning start for Colin Tizzard. Judging by his build he\'ll make a chaser.\\n \\bAwake At Midnight\\p is another embryonic chaser, but this was a very encouraging start to his hurdling career after 11 months off. He was just about in front when getting in too tight to the second-last and loses nothing in defeat.\\n \\bShalakar\\p was affected when one of the leaders ran out at the fourth, making a mistake himself and his rider appearing to briefly lose an iron. In the circumstances this was a good run, and certainly an improvement on his Ffos Las debut on softer ground. He\'s raced keenly on both starts over hurdles.\\n \\bEnglish Pale\\p, like the winner formerly with Jessica Harrington, ran creditably in first-time cheekpieces (has worn a hood). Another who seemed to find this a little sharp, he was reported to have broken a blood vessel.\\n \\bWay Out West\\p, quite a keen type, was fitted with a hood and tongue tie for the first time. Keeping on steadily and nearly grabbing fourth, he may get further than this and looks one to keep an eye on.\\n \\bSt John\'s\\p came in for market support for a yard which won a division of this race last year, but faded from the second-last.\\n \\bLissycasey\\p, who was runner-up in an Irish point in the spring, showed some ability on this second start under rules.\\n \\bEau De Nile\\p was reported to have finished lame.\\n \\bThe Major\\p, a dual 1m2f winner for Michael Bell in the summer, had been keen both on the way down and in the race. The saddle slipped and he ducked out through the wings at the fourth, giving Micheal Nolan a nasty fall.\\n \\bMay Mist\\p was still in front when the loose horse carried her on to the chase track turning for home. [Richard Lowther]\\n \\bQUOTES\\p It was sharp enough for \\bNew To This Town\\p and in the end he\'s done it well. He\'s got plenty of ability and it is good to get his confidence back. We\'ll look for another little race over two and a half with a penalty - Joe Tizzard, assistant trainer. \\n ',
                        'going_type_desc' => 'Good To Soft',
                        'rp_admission_prices' => 'see http://ludlow.thejockeyclub.co.uk/ or tel 01584 856221',
                        'total_sp' => '129.258154404623000',
                    ]),
            ]
        ];

        return $data[$date];
    }

    /**
     * @param $date
     *
     * @return array
     */
    public function getFastResultsByDate($date)
    {

        $data = [
            '2011-08-08' => [
                537772 => [
                    'race_instance_uid' => 537772,
                    'race_date' => '2011-08-08T17:50:00+01:00',
                    'course_name' => null,
                    'course_country' => null,
                    'fast_race_instance_uid' => null,
                    'fast_crs_name' => null,
                    'runners_count' => null,
                    'tote_win_money' => null,
                    'dual_forecast' => null,
                    'csf' => null,
                    'tricast' => null,
                    'placepot' => null,
                    'miscellaneous' => null,
                    'r_outcome_pos' => null,
                    'horse_style_name' => null,
                    'starting_price odds_desc' => null
                ]
            ],
            '1977-07-07' => null,
            '2015-05-08' => null
        ];

        return $data[$date];
    }

    /**
     * @return int
     */
    public function getNextRaceId($raceId)
    {
        $data = [
            582658 => 582659,
            616028 => 616029,
            616029 => 616030,
            537772 => null,
            537773 => 537774,
            537774 => 537775

        ];

        return $data[$raceId];
    }

    /**
     * @return int
     */
    public function getPrevRaceId($raceId)
    {
        $data = [
            537772 => null,
            537773 => 537772,
            537774 => 537773,
            582658 => null
        ];

        return $data[$raceId];
    }

    /**
     * @return int
     */
    public function getFirstRaceId($raceId)
    {
        $data = [
            582658 => 582658,
        ];

        return $data[$raceId];
    }

    /**
     * @return int
     */
    public function getLastRaceId($raceId)
    {
        $data = [
            582658 => 582661,
        ];

        return $data[$raceId];
    }

    public function getDividends($date, array $courseIDs)
    {
        $data = [
            '2011-08-08' => [
                'races' => [
                    31 => [
                        0 =>
                            GeneralRow::createFromArray([
                                'course_uid' => 31,
                                'race_instance_uid' => 536420,
                                'race_datetime' => 'Aug  8 2011  3:30PM',
                                'race_type_code' => 'F',
                                'flat_or_jumps' => 'F',
                                'race_double' => 6,
                                'race_win_dist' => 0.20000000000000001,
                                'finishing_horses' => 5,
                                'dht' => 0,
                                'horses_run' => 8,
                                'non_runners' => 3,
                                'race_sp' => 16,
                                'race_sp_count' => 1,
                                'race_favs_pos' => 2,
                                'race_favs_count' => 1,
                            ]),
                        1 =>
                            GeneralRow::createFromArray([
                                'course_uid' => 31,
                                'race_instance_uid' => 536418,
                                'race_datetime' => 'Aug  8 2011  2:30PM',
                                'race_type_code' => 'F',
                                'flat_or_jumps' => 'F',
                                'race_double' => 6,
                                'race_win_dist' => 2.25,
                                'finishing_horses' => 6,
                                'dht' => 0,
                                'horses_run' => 6,
                                'non_runners' => 0,
                                'race_sp' => 4,
                                'race_sp_count' => 1,
                                'race_favs_pos' => 2,
                                'race_favs_count' => 1,
                            ]),
                        2 =>
                            GeneralRow::createFromArray([
                                'course_uid' => 31,
                                'race_instance_uid' => 536419,
                                'race_datetime' => 'Aug  8 2011  3:00PM',
                                'race_type_code' => 'F',
                                'flat_or_jumps' => 'F',
                                'race_double' => 3,
                                'race_win_dist' => 3.25,
                                'finishing_horses' => 3,
                                'dht' => 0,
                                'horses_run' => 4,
                                'non_runners' => 1,
                                'race_sp' => 6.5,
                                'race_sp_count' => 1,
                                'race_favs_pos' => null,
                                'race_favs_count' => 0,
                            ]),
                        3 =>
                            GeneralRow::createFromArray([
                                'course_uid' => 31,
                                'race_instance_uid' => 536417,
                                'race_datetime' => 'Aug  8 2011  2:00PM',
                                'race_type_code' => 'F',
                                'flat_or_jumps' => 'F',
                                'race_double' => 2,
                                'race_win_dist' => 1.25,
                                'finishing_horses' => 4,
                                'dht' => 0,
                                'horses_run' => 5,
                                'non_runners' => 1,
                                'race_sp' => 3.2999999999999998,
                                'race_sp_count' => 1,
                                'race_favs_pos' => 2,
                                'race_favs_count' => 1,
                            ]),
                    ],
                ],
                'meeting' =>
                    [
                        31 =>
                            [
                                0 =>
                                    GeneralRow::createFromArray([
                                        'course_uid' => 31,
                                        'betting_man' => 'ALEC BAKER',
                                        'analysis_man' => 'RON WOOD',
                                        'close_up_man' => 'STEVE PAYNE',
                                    ]),
                            ],
                    ],
            ],
            (new \DateTime())->format('Y-m-d') => [
                'races' => [
                    175 => [
                        0 => (Object)[
                            'course_uid' => 175,
                            'race_instance_uid' => 537777,
                            'race_datetime' => 'Aug  8 2011  8:50PM',
                            'race_type_code' => 'H',
                            'flat_or_jumps' => 'F',
                            'race_double' => 1,
                            'race_win_dist' => 13,
                            'finishing_horses' => 13,
                            'dht' => 0,
                            'horses_run' => 13,
                            'non_runners' => 0,
                            'race_sp' => 4.5,
                            'race_sp_count' => 1,
                            'race_favs_pos' => 3,
                            'race_favs_count' => 1,
                        ],
                        1 => (Object)[
                            'course_uid' => 175,
                            'race_instance_uid' => 537778,
                            'race_datetime' => 'Aug  8 2011  8:20PM',
                            'race_type_code' => 'H',
                            'flat_or_jumps' => 'J',
                            'race_double' => 3,
                            'race_win_dist' => 35.5,
                            'finishing_horses' => 16,
                            'dht' => 0,
                            'horses_run' => 16,
                            'non_runners' => 0,
                            'race_sp' => 56,
                            'race_sp_count' => 1,
                            'race_favs_pos' => 7,
                            'race_favs_count' => 1,
                        ],
                        2 => (Object)[
                            'course_uid' => 175,
                            'race_instance_uid' => 537776,
                            'race_datetime' => 'Aug  8 2011  7:50PM',
                            'race_type_code' => 'H',
                            'flat_or_jumps' => 'J',
                            'race_double' => 4,
                            'race_win_dist' => 3,
                            'finishing_horses' => 2,
                            'dht' => 0,
                            'horses_run' => 4,
                            'non_runners' => 2,
                            'race_sp' => 1.3,
                            'race_sp_count' => 1,
                            'race_favs_pos' => 62,
                            'race_favs_count' => 1,
                        ],
                        3 => (Object)[
                            'course_uid' => 175,
                            'race_instance_uid' => 537775,
                            'race_datetime' => 'Aug  8 2011  7:20PM',
                            'race_type_code' => 'H',
                            'flat_or_jumps' => 'J',
                            'race_double' => 3,
                            'race_win_dist' => 4.5,
                            'finishing_horses' => 13,
                            'dht' => 0,
                            'horses_run' => 13,
                            'non_runners' => 0,
                            'race_sp' => 8,
                            'race_sp_count' => 1,
                            'race_favs_pos' => 1,
                            'race_favs_count' => 2,
                        ],
                        4 => (Object)[
                            'course_uid' => 175,
                            'race_instance_uid' => 537774,
                            'race_datetime' => 'Aug  8 2011  6:50PM',
                            'race_type_code' => 'F',
                            'flat_or_jumps' => 'F',
                            'race_double' => 3,
                            'race_win_dist' => 6,
                            'finishing_horses' => 11,
                            'dht' => 0,
                            'horses_run' => 15,
                            'non_runners' => 4,
                            'race_sp' => 4.5,
                            'race_sp_count' => 1,
                            'race_favs_pos' => 2,
                            'race_favs_count' => 2,
                        ],
                        5 => (Object)[
                            'course_uid' => 175,
                            'race_instance_uid' => 537773,
                            'race_datetime' => 'Aug  8 2011  6:20PM',
                            'race_type_code' => 'F',
                            'flat_or_jumps' => 'F',
                            'race_double' => 2,
                            'race_win_dist' => 2.5,
                            'finishing_horses' => 7,
                            'dht' => 0,
                            'horses_run' => 8,
                            'non_runners' => 1,
                            'race_sp' => 2.2999999999999998,
                            'race_sp_count' => 1,
                            'race_favs_pos' => 3,
                            'race_favs_count' => 2,
                        ],
                        6 => (Object)[
                            'course_uid' => 175,
                            'race_instance_uid' => 537772,
                            'race_datetime' => 'Aug  8 2011  5:50PM',
                            'race_type_code' => 'F',
                            'flat_or_jumps' => 'F',
                            'race_double' => 7,
                            'race_win_dist' => 1.25,
                            'finishing_horses' => 12,
                            'dht' => 0,
                            'horses_run' => 14,
                            'non_runners' => 2,
                            'race_sp' => 14,
                            'race_sp_count' => 1,
                            'race_favs_pos' => 1,
                            'race_favs_count' => 3,
                        ],
                    ]
                ],
                'meeting' => [
                    31 => [
                        0 => [
                            'course_uid' => 31,
                            'betting_man' => 'ALEC BAKER',
                            'analysis_man' => 'RON WOOD',
                            'close_up_man' => 'STEVE PAYNE',
                        ],
                        1 => [
                            'course_uid' => 31,
                            'betting_man' => 'ALEC BAKER',
                            'analysis_man' => 'RON WOOD',
                            'close_up_man' => null,
                        ],
                    ],
                    80 => [
                        0 => [
                            'course_uid' => 80,
                            'betting_man' => 'GARY TRISCONI',
                            'analysis_man' => 'MARK BROWN',
                            'close_up_man' => 'WALTER GLYNN',
                        ],
                    ],
                    93 => [
                        0 => [
                            'course_uid' => 93,
                            'betting_man' => 'ALAN GODDARD',
                            'analysis_man' => 'DAVID ORTON',
                            'close_up_man' => 'JONATHAN NEESOM',
                        ],
                    ],
                    175 => [
                        0 => [
                            'course_uid' => 175,
                            'betting_man' => 'IRS',
                            'analysis_man' => 'TONY O\'HEHIR',
                            'close_up_man' => 'IRS',
                        ],
                    ],
                    252 => [
                        0 => [
                            'course_uid' => 252,
                            'betting_man' => null,
                            'analysis_man' => null,
                            'close_up_man' => null,
                        ],
                    ],
                    513 => [
                        0 => [
                            'course_uid' => 513,
                            'betting_man' => 'PETER HEAVEN',
                            'analysis_man' => 'DAVID BELLINGHAM',
                            'close_up_man' => 'COLIN ROBERTS',
                        ],
                    ],
                ],
            ],
            '2013-06-23' => [
                'races' => [
                    1017 => [
                        0 => GeneralRow::createFromArray(
                            [
                                'course_uid' => 1017,
                                'race_instance_uid' => 582661,
                                'race_datetime' => 'Jun 23 2013 11:15PM',
                                'race_type_code' => 'X',
                                'flat_or_jumps' => 'F',
                                'race_double' => 1,
                                'race_win_dist' => 0.5,
                                'finishing_horses' => 2,
                                'dht' => 0,
                                'horses_run' => 13,
                                'non_runners' => 1,
                                'race_sp' => 7.0999999999999996,
                                'race_sp_count' => 1,
                                'race_favs_pos' => null,
                                'race_favs_count' => 0,
                            ]
                        ),
                        1 => GeneralRow::createFromArray(
                            [
                                'course_uid' => 1017,
                                'race_instance_uid' => 582660,
                                'race_datetime' => 'Jun 23 2013 10:45PM',
                                'race_type_code' => 'F',
                                'flat_or_jumps' => 'F',
                                'race_double' => 8,
                                'race_win_dist' => 1.5,
                                'finishing_horses' => 2,
                                'dht' => 0,
                                'horses_run' => 14,
                                'non_runners' => 0,
                                'race_sp' => 6.7999999999999998,
                                'race_sp_count' => 1,
                                'race_favs_pos' => null,
                                'race_favs_count' => 0,
                            ]
                        ),
                        2 => GeneralRow::createFromArray(
                            [
                                'course_uid' => 1017,
                                'race_instance_uid' => 582659,
                                'race_datetime' => 'Jun 23 2013 10:10PM',
                                'race_type_code' => 'X',
                                'flat_or_jumps' => 'F',
                                'race_double' => 5,
                                'race_win_dist' => 0,
                                'finishing_horses' => 2,
                                'dht' => 2,
                                'horses_run' => 9,
                                'non_runners' => 0,
                                'race_sp' => 2.1000000000000001,
                                'race_sp_count' => 1,
                                'race_favs_pos' => null,
                                'race_favs_count' => 0,
                            ]
                        ),
                        3 => GeneralRow::createFromArray(
                            [
                                'course_uid' => 1017,
                                'race_instance_uid' => 582658,
                                'race_datetime' => 'Jun 23 2013  9:40PM',
                                'race_type_code' => 'X',
                                'flat_or_jumps' => 'F',
                                'race_double' => 10,
                                'race_win_dist' => 1.25,
                                'finishing_horses' => 2,
                                'dht' => 0,
                                'horses_run' => 12,
                                'non_runners' => 4,
                                'race_sp' => 9.5,
                                'race_sp_count' => 1,
                                'race_favs_pos' => null,
                                'race_favs_count' => 0,
                            ]
                        ),
                    ],
                ],
                'meeting' => [
                    1017 => [
                        0 => GeneralRow::createFromArray(
                            [
                                'course_uid' => 1017,
                                'betting_man' => null,
                                'analysis_man' => null,
                                'close_up_man' => null,
                            ]
                        ),
                    ],
                ],
            ],
            '2014-04-05' => [
                'races' => [
                    12 => [
                        0 => GeneralRow::createFromArray(
                            [
                                'course_uid' => 12,
                                'race_instance_uid' => 597480,
                                'race_datetime' => 'Apr  5 2014  5:55PM',
                                'race_type_code' => 'B',
                                'flat_or_jumps' => 'J',
                                'race_double' => 13,
                                'race_win_dist' => 4.5,
                                'finishing_horses' => 2,
                                'dht' => 0,
                                'horses_run' => 11,
                                'non_runners' => 2,
                                'race_sp' => 12,
                                'race_sp_count' => 1,
                                'race_favs_pos' => 2,
                                'race_favs_count' => 1,
                            ]
                        ),
                        1 => GeneralRow::createFromArray(
                            [
                                'course_uid' => 12,
                                'race_instance_uid' => 597479,
                                'race_datetime' => 'Apr  5 2014  5:25PM',
                                'race_type_code' => 'C',
                                'flat_or_jumps' => 'J',
                                'race_double' => 7,
                                'race_win_dist' => 9,
                                'finishing_horses' => 2,
                                'dht' => 0,
                                'horses_run' => 9,
                                'non_runners' => 0,
                                'race_sp' => 3,
                                'race_sp_count' => 1,
                                'race_favs_pos' => 4,
                                'race_favs_count' => 1,
                            ]
                        ),
                        2 => GeneralRow::createFromArray(
                            [
                                'course_uid' => 12,
                                'race_instance_uid' => 597478,
                                'race_datetime' => 'Apr  5 2014  4:50PM',
                                'race_type_code' => 'H',
                                'flat_or_jumps' => 'J',
                                'race_double' => 7,
                                'race_win_dist' => 0.5,
                                'finishing_horses' => 2,
                                'dht' => 0,
                                'horses_run' => 13,
                                'non_runners' => 1,
                                'race_sp' => 20,
                                'race_sp_count' => 1,
                                'race_favs_pos' => 6,
                                'race_favs_count' => 1,
                            ]
                        ),
                        3 => GeneralRow::createFromArray(
                            [
                                'course_uid' => 12,
                                'race_instance_uid' => 597477,
                                'race_datetime' => 'Apr  5 2014  3:45PM',
                                'race_type_code' => 'C',
                                'flat_or_jumps' => 'J',
                                'race_double' => 6,
                                'race_win_dist' => 9,
                                'finishing_horses' => 2,
                                'dht' => 0,
                                'horses_run' => 6,
                                'non_runners' => 2,
                                'race_sp' => 2.5,
                                'race_sp_count' => 1,
                                'race_favs_pos' => 1,
                                'race_favs_count' => 1,
                            ]
                        ),
                        4 => GeneralRow::createFromArray(
                            [
                                'course_uid' => 12,
                                'race_instance_uid' => 597476,
                                'race_datetime' => 'Apr  5 2014  3:05PM',
                                'race_type_code' => 'H',
                                'flat_or_jumps' => 'J',
                                'race_double' => 2,
                                'race_win_dist' => 1.25,
                                'finishing_horses' => 2,
                                'dht' => 0,
                                'horses_run' => 15,
                                'non_runners' => 1,
                                'race_sp' => 2.5,
                                'race_sp_count' => 1,
                                'race_favs_pos' => 1,
                                'race_favs_count' => 1,
                            ]
                        ),
                        5 => GeneralRow::createFromArray(
                            [
                                'course_uid' => 12,
                                'race_instance_uid' => 597475,
                                'race_datetime' => 'Apr  5 2014  2:30PM',
                                'race_type_code' => 'C',
                                'flat_or_jumps' => 'J',
                                'race_double' => 7,
                                'race_win_dist' => 23,
                                'finishing_horses' => 2,
                                'dht' => 0,
                                'horses_run' => 9,
                                'non_runners' => 0,
                                'race_sp' => 22,
                                'race_sp_count' => 1,
                                'race_favs_pos' => 2,
                                'race_favs_count' => 1,
                            ]
                        ),
                        6 => GeneralRow::createFromArray(
                            [
                                'course_uid' => 12,
                                'race_instance_uid' => 599697,
                                'race_datetime' => 'Apr  5 2014  1:55PM',
                                'race_type_code' => 'H',
                                'flat_or_jumps' => 'J',
                                'race_double' => 7,
                                'race_win_dist' => 1.5,
                                'finishing_horses' => 2,
                                'dht' => 0,
                                'horses_run' => 9,
                                'non_runners' => 1,
                                'race_sp' => 0.59999999999999998,
                                'race_sp_count' => 1,
                                'race_favs_pos' => 1,
                                'race_favs_count' => 1,
                            ]
                        ),
                        7 => GeneralRow::createFromArray(
                            [
                                'course_uid' => 12,
                                'race_instance_uid' => 597474,
                                'race_datetime' => 'Apr  5 2014  1:20PM',
                                'race_type_code' => 'H',
                                'flat_or_jumps' => 'J',
                                'race_double' => 1,
                                'race_win_dist' => 3.5,
                                'finishing_horses' => 2,
                                'dht' => 0,
                                'horses_run' => 10,
                                'non_runners' => 0,
                                'race_sp' => 1.5,
                                'race_sp_count' => 1,
                                'race_favs_pos' => 1,
                                'race_favs_count' => 1,
                            ]
                        ),
                    ],
                ],
                'meeting' => [
                    12 => [
                        0 => GeneralRow::createFromArray(
                            [
                                'course_uid' => 12,
                                'betting_man' => 'ALEC BAKER & SIS',
                                'analysis_man' => 'SANDRA NOBLE',
                                'close_up_man' => 'STEVE PAYNE',
                            ]
                        ),
                    ],
                ],
            ],
            '2015-05-08' => [
                'races' => [
                    -99 => [
                        0 => GeneralRow::createFromArray(
                            [
                                'course_uid' => -99,
                                'race_instance_uid' => 1,
                                'race_datetime' => 'Aug  8 2011  8:50PM',
                                'race_type_code' => 'H',
                                'flat_or_jumps' => 'F',
                                'race_double' => 1,
                                'race_win_dist' => 13,
                                'finishing_horses' => 2,
                                'dht' => 0,
                                'horses_run' => 13,
                                'non_runners' => 0,
                                'race_sp' => 4.5,
                                'race_sp_count' => 1,
                                'race_favs_pos' => 3,
                                'race_favs_count' => 1,
                            ]
                        ),
                        1 => GeneralRow::createFromArray(
                            [
                                'course_uid' => -99,
                                'race_instance_uid' => 2,
                                'race_datetime' => 'Aug  8 2011  8:20PM',
                                'race_type_code' => 'H',
                                'flat_or_jumps' => 'J',
                                'race_double' => 3,
                                'race_win_dist' => 35.5,
                                'finishing_horses' => 2,
                                'dht' => 0,
                                'horses_run' => 16,
                                'non_runners' => 0,
                                'race_sp' => 56,
                                'race_sp_count' => 1,
                                'race_favs_pos' => 7,
                                'race_favs_count' => 1,
                            ]
                        ),
                    ],
                ],
                'meeting' => [
                    -99 => [
                        0 => GeneralRow::createFromArray(
                            [
                                'course_uid' => -99,
                                'betting_man' => 'ALEC BAKER & SIS',
                                'analysis_man' => 'SANDRA NOBLE',
                                'close_up_man' => 'STEVE PAYNE',
                            ]
                        ),
                    ],
                ],
            ],
            '2017-11-27' => [
                'races' => [
                    34 =>
                        [
                            0 =>
                                GeneralRow::createFromArray([
                                    'course_uid' => 34,
                                    'race_instance_uid' => 688522,
                                    'race_datetime' => 'Nov 27 2017  2:15PM',
                                    'race_type_code' => 'C',
                                    'flat_or_jumps' => 'J',
                                    'race_double' => 1,
                                    'race_win_dist' => 5,
                                    'finishing_horses' => 2,
                                    'dht' => 0,
                                    'horses_run' => 8,
                                    'non_runners' => 0,
                                    'race_sp' => 1.8999999999999999,
                                    'race_sp_count' => 1,
                                    'race_favs_pos' => 1,
                                    'race_favs_count' => 1,
                                ]),
                            1 =>
                                GeneralRow::createFromArray([
                                    'course_uid' => 34,
                                    'race_instance_uid' => 688523,
                                    'race_datetime' => 'Nov 27 2017  3:20PM',
                                    'race_type_code' => 'C',
                                    'flat_or_jumps' => 'J',
                                    'race_double' => 3,
                                    'race_win_dist' => 1.5,
                                    'finishing_horses' => 2,
                                    'dht' => 0,
                                    'horses_run' => 7,
                                    'non_runners' => 1,
                                    'race_sp' => 3.5,
                                    'race_sp_count' => 1,
                                    'race_favs_pos' => 3,
                                    'race_favs_count' => 1,
                                ]),
                            2 =>
                                GeneralRow::createFromArray([
                                    'course_uid' => 34,
                                    'race_instance_uid' => 688527,
                                    'race_datetime' => 'Nov 27 2017 12:35PM',
                                    'race_type_code' => 'H',
                                    'flat_or_jumps' => 'J',
                                    'race_double' => 7,
                                    'race_win_dist' => 2.25,
                                    'finishing_horses' => 2,
                                    'dht' => 0,
                                    'horses_run' => 16,
                                    'non_runners' => 0,
                                    'race_sp' => 0.59999999999999998,
                                    'race_sp_count' => 1,
                                    'race_favs_pos' => 1,
                                    'race_favs_count' => 1,
                                ]),
                            3 =>
                                GeneralRow::createFromArray([
                                    'course_uid' => 34,
                                    'race_instance_uid' => 688524,
                                    'race_datetime' => 'Nov 27 2017  1:05PM',
                                    'race_type_code' => 'C',
                                    'flat_or_jumps' => 'J',
                                    'race_double' => 5,
                                    'race_win_dist' => 53,
                                    'finishing_horses' => 2,
                                    'dht' => 0,
                                    'horses_run' => 7,
                                    'non_runners' => 0,
                                    'race_sp' => 1,
                                    'race_sp_count' => 1,
                                    'race_favs_pos' => 1,
                                    'race_favs_count' => 1,
                                ]),
                            4 =>
                                GeneralRow::createFromArray([
                                    'course_uid' => 34,
                                    'race_instance_uid' => 688526,
                                    'race_datetime' => 'Nov 27 2017  1:40PM',
                                    'race_type_code' => 'H',
                                    'flat_or_jumps' => 'J',
                                    'race_double' => 1,
                                    'race_win_dist' => 8,
                                    'finishing_horses' => 2,
                                    'dht' => 0,
                                    'horses_run' => 8,
                                    'non_runners' => 0,
                                    'race_sp' => 1.6000000000000001,
                                    'race_sp_count' => 1,
                                    'race_favs_pos' => 3,
                                    'race_favs_count' => 1,
                                ]),
                            5 =>
                                GeneralRow::createFromArray([
                                    'course_uid' => 34,
                                    'race_instance_uid' => 688528,
                                    'race_datetime' => 'Nov 27 2017  3:50PM',
                                    'race_type_code' => 'H',
                                    'flat_or_jumps' => 'J',
                                    'race_double' => 1,
                                    'race_win_dist' => 17,
                                    'finishing_horses' => 2,
                                    'dht' => 0,
                                    'horses_run' => 5,
                                    'non_runners' => 0,
                                    'race_sp' => 1.1000000000000001,
                                    'race_sp_count' => 1,
                                    'race_favs_pos' => 1,
                                    'race_favs_count' => 1,
                                ]),
                            6 =>
                                GeneralRow::createFromArray([
                                    'course_uid' => 34,
                                    'race_instance_uid' => 688525,
                                    'race_datetime' => 'Nov 27 2017  2:45PM',
                                    'race_type_code' => 'H',
                                    'flat_or_jumps' => 'J',
                                    'race_double' => 8,
                                    'race_win_dist' => 0.20000000000000001,
                                    'finishing_horses' => 2,
                                    'dht' => 0,
                                    'horses_run' => 8,
                                    'non_runners' => 0,
                                    'race_sp' => 3.5,
                                    'race_sp_count' => 1,
                                    'race_favs_pos' => 1,
                                    'race_favs_count' => 1,
                                ]),
                        ],
                ],
                'meeting' => [
                    34 =>
                        [
                            0 =>
                                GeneralRow::createFromArray([
                                    'course_uid' => 34,
                                    'betting_man' => 'PETER HEAVEN & TURFTV',
                                    'analysis_man' => 'RICHARD LOWTHER',
                                    'close_up_man' => 'COLIN ROBERTS',
                                ]),
                        ],
                ],
            ]
        ];

        return $data[$date];
    }

    /**
     * @param \Api\Input\Request\Horses\Results\Search $request
     *
     * @return array
     */
    public function getSearchResult(
        \Api\Input\Request\Horses\Results\Search $request
    ) {
        return [
            0 => GeneralRow::createFromArray(
                array(
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
                )
            ),
            1 => GeneralRow::createFromArray(
                array(
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
                )
            ),
            2 => GeneralRow::createFromArray(
                array(
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
                )
            ),
        ];
    }

    /**
     * @param int $raceId
     *
     * @return array
     */
    public function getDbi($raceId)
    {
        return [
            'sp' => array(
                0 => GeneralRow::createFromArray(
                    array(
                        'horse_uid' => 889903,
                        'draw' => 5,
                        'position' => 1,
                        'percent' => 30.769
                    )
                ),
                1 => GeneralRow::createFromArray(
                    array(
                        'horse_uid' => 891383,
                        'draw' => 8,
                        'position' => 2,
                        'percent' => 11.111
                    )
                ),
                2 => GeneralRow::createFromArray(
                    array(
                        'horse_uid' => 891150,
                        'draw' => 7,
                        'position' => 3,
                        'percent' => 14.285
                    )
                ),
                3 => GeneralRow::createFromArray(
                    array(
                        'horse_uid' => 891149,
                        'draw' => 3,
                        'position' => 4,
                        'percent' => 12.5
                    )
                ),
                4 => GeneralRow::createFromArray(
                    array(
                        'horse_uid' => 892546,
                        'draw' => 2,
                        'position' => 5,
                        'percent' => 7.692
                    )
                ),
                5 => GeneralRow::createFromArray(
                    array(
                        'horse_uid' => 888757,
                        'draw' => 1,
                        'position' => 6,
                        'percent' => 28.571
                    )
                ),
                6 => GeneralRow::createFromArray(
                    array(
                        'horse_uid' => 886608,
                        'draw' => 9,
                        'position' => 7,
                        'percent' => 4.347
                    )
                ),
                7 => GeneralRow::createFromArray(
                    array(
                        'horse_uid' => 891169,
                        'draw' => 4,
                        'position' => 8,
                        'percent' => 5.882,
                    )
                ),
                8 => GeneralRow::createFromArray(
                    array(
                        'horse_uid' => 883703,
                        'draw' => 6,
                        'position' => 9,
                        'percent' => 0.99
                    )
                ),
            ),
            'attributes' => array(
                'lowInit' => 3,
                'highInit' => 6,
                'low' => 3,
                'high' => 6,
                'runnersCnt' => 9
            )
        ];
    }

    public function getWinningTimes(
        \Api\Input\Request\Horses\Results\WinningTimes $request
    ) {
        return [
            0 => GeneralRow::createFromArray(
                array(
                    'race_instance_uid' => 636316,
                    'race_type_code' => 'H',
                    'winners_time_secs' => 299,
                    'rp_going_correction' => -16,
                    'distance_yard' => 4303,
                    'race_datetime' => 'Oct 27 2015  1:55PM',
                    'standard_time' => 264,
                    'rp_going_type_desc' => 'GOOD',
                    'rp_topspeed' => 49,
                    'rp_postmark' => 105,
                    'horse_style_name' => 'Murray Mount',
                    'horse_uid' => 854146,
                    'time_comparison' => 35,
                    'winners_time_secs_per_furlong' => null,
                    'time_comparison_per_furlong' => null,
                    'rp_going_correction_desc' => null,
                )
            ),
            1 => GeneralRow::createFromArray(
                array(
                    'race_instance_uid' => 636317,
                    'race_type_code' => 'C',
                    'winners_time_secs' => 302.89999999999998,
                    'rp_going_correction' => -8,
                    'distance_yard' => 4472,
                    'race_datetime' => 'Oct 27 2015  2:30PM',
                    'standard_time' => 289,
                    'rp_going_type_desc' => 'GOOD',
                    'rp_topspeed' => 101,
                    'rp_postmark' => 140,
                    'horse_style_name' => 'Coologue',
                    'horse_uid' => 859050,
                    'time_comparison' => 13.9,
                    'winners_time_secs_per_furlong' => null,
                    'time_comparison_per_furlong' => null,
                    'rp_going_correction_desc' => null,
                )
            ),
            2 => GeneralRow::createFromArray(
                array(
                    'race_instance_uid' => 636318,
                    'race_type_code' => 'H',
                    'winners_time_secs' => 257.89999999999998,
                    'rp_going_correction' => -16,
                    'distance_yard' => 3665,
                    'race_datetime' => 'Oct 27 2015  3:00PM',
                    'standard_time' => 228,
                    'rp_going_type_desc' => 'GOOD',
                    'rp_topspeed' => 36,
                    'rp_postmark' => 104,
                    'horse_style_name' => 'Lady Yeats',
                    'horse_uid' => 838609,
                    'time_comparison' => 29.899999999999999,
                    'winners_time_secs_per_furlong' => null,
                    'time_comparison_per_furlong' => null,
                    'rp_going_correction_desc' => null,
                )
            ),
            3 => GeneralRow::createFromArray(
                array(
                    'race_instance_uid' => 636319,
                    'race_type_code' => 'C',
                    'winners_time_secs' => 265.69999999999999,
                    'rp_going_correction' => -8,
                    'distance_yard' => 3817,
                    'race_datetime' => 'Oct 27 2015  3:30PM',
                    'standard_time' => 245,
                    'rp_going_type_desc' => 'GOOD',
                    'rp_topspeed' => 66,
                    'rp_postmark' => 125,
                    'horse_style_name' => 'Gee Hi',
                    'horse_uid' => 755233,
                    'time_comparison' => 20.699999999999999,
                    'winners_time_secs_per_furlong' => null,
                    'time_comparison_per_furlong' => null,
                    'rp_going_correction_desc' => null,
                )
            ),
            4 => GeneralRow::createFromArray(
                array(
                    'race_instance_uid' => 636320,
                    'race_type_code' => 'H',
                    'winners_time_secs' => 358.10000000000002,
                    'rp_going_correction' => -16,
                    'distance_yard' => 5092,
                    'race_datetime' => 'Oct 27 2015  4:00PM',
                    'standard_time' => 320,
                    'rp_going_type_desc' => 'GOOD',
                    'rp_topspeed' => 66,
                    'rp_postmark' => 125,
                    'horse_style_name' => 'Georgie Lad',
                    'horse_uid' => 809404,
                    'time_comparison' => 38.100000000000001,
                    'winners_time_secs_per_furlong' => null,
                    'time_comparison_per_furlong' => null,
                    'rp_going_correction_desc' => null,
                )
            ),
            5 => GeneralRow::createFromArray(
                array(
                    'race_instance_uid' => 636321,
                    'race_type_code' => 'B',
                    'winners_time_secs' => 246.30000000000001,
                    'rp_going_correction' => -16,
                    'distance_yard' => 3665,
                    'race_datetime' => 'Oct 27 2015  4:30PM',
                    'standard_time' => 220,
                    'rp_going_type_desc' => 'GOOD',
                    'rp_topspeed' => 65,
                    'rp_postmark' => 112,
                    'horse_style_name' => 'Criq Rock',
                    'horse_uid' => 868918,
                    'time_comparison' => 26.300000000000001,
                    'winners_time_secs_per_furlong' => null,
                    'time_comparison_per_furlong' => null,
                    'rp_going_correction_desc' => null,
                )
            )
        ];
    }

    /**
     * @param array $form
     * @param array $raceIds
     *
     * @return array
     */
    public function getNextRun(array $form, array $raceIds)
    {
        return [
            '582658' => [
                \Api\Row\RaceInstance::createFromArray(
                    array(
                        'form_race_instance_uid' => 673767,
                        'first_3_wins' => 1,
                        'first_3_placed' => 0,
                        'first_3_unplaced' => 0,
                        'other_wins' => 0,
                        'other_placed' => 2,
                        'other_unplaced' => 10,
                        'hot_race' => 0,
                        'cold_race' => 0,
                        'first_three' =>
                            (Object)array(
                                'wins' => 1,
                                'placed' => 0,
                                'unplaced' => 0,
                            ),
                        'other' =>
                            (Object)array(
                                'wins' => 0,
                                'placed' => 2,
                                'unplaced' => 10,
                            ),
                        'average_race' => 1,
                    )
                )
            ]
        ];
    }
}
