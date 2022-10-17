<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Results\Date;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Results\Date
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/results/date/2018-03-02';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\Results\RaceInstance:253 ->getRaceListByDate()
            '2f84d400db2d37f33cd8e1370058f5ce' => [
                [
                    'race_instance_uid' => 695416,
                    'race_datetime' => '2018-03-02 13:45:00',
                    'race_instance_title' => 'Back Or Lay On Betdaq "Jumpers\' Bumper" National Hunt Flat Race',
                    'alt_race_title' => null,
                    'formbook_yn' => 'Y',
                    'going_type_code' => 'SS',
                    'race_class' => null,
                    'aw_surface_type' => null,
                    'race_type_code' => 'W',
                    'r_dist' => 3520,
                    'rp_ages_allowed_desc' => '4yo+',
                    'r_status' => 'R',
                    'crs_id' => 394,
                    'mixed_crs_id' => null,
                    'course_name' => 'SOUTHWELL (A.W)',
                    'course_style_name' => 'Southwell (A.W)',
                    'course_region' => 'GB & IRE',
                    'mnemonic' => 'SOW',
                    'replaced_aw' => null,
                    'abandoned' => 0,
                    'rp_abbrev_3' => 'STH',
                    'course_country' => 'GB',
                    'course_type_code' => 'X',
                    'graphic_name' => null,
                    'graphic_height' => null,
                    'rp_flat_course_comment' => 'left-handed, sharp track',
                    'rp_jump_course_comment' => null,
                    'going_desc' => 'FIBRESAND: STANDARD TO SLOW',
                    'weather_cond' => 'Fine',
                    'additional_ordering' => 1,
                    'no_of_runners' => null,
                    'no_of_runners_calculated' => 4,
                    'stalls_position' => ' ',
                    'prize' => 3328.5,
                    'pool_prize_sterling' => 35123.90,
                    'totes' => null,
                    'winner_time' => 237.1,
                    'diff_to_standard_time_sec' => null,
                    'scoop' => null,
                    'race_group_desc' => 'Unknown',
                    'race_group_code' => '0',
                    'is_gb_or_ire' => 1,
                    'has_details' => 0,
                    'rp_omitted_fences' => null,
                    'no_of_fences' => null,
                    'straight_round_jubilee_code' => null,
                    'straight_round_jubilee_desc' => null,
                    'rp_straight_round_jubilee_desc' => null,
                    'is_worldwide_stake' => 1,
                    'eyecatcher_horse_uid' => null,
                    'eyecatcher_style_name' => null,
                    'eyecatcher_country_code' => null,
                    'eyecatcher_notes' => null,
                    'star_performer_horse_uid' => null,
                    'star_performer_style_name' => null,
                    'star_performer_country_code' => null,
                    'star_performer_notes' => null,
                    'fast_race_instance_uid' => null,
                    'official_rating_band_desc' => null,
                    'country_desc' => 'Great Britain',
                    'wind' => 'fairly strong half against',
                    'rp_analysis' => 'This quickly arranged fixture beat the snowy weather, but there were numerous non-runners due to travelling difficulties. The Fibresand was riding slower than usual and they raced into a headwind too. This opening event was for 4yos and up which had run in at least two hurdles and which are currently eligible for novice hurdles.\\n \\bSWASHBUCKLE\\p whipped round as the flag fell, but quickly recovered and his rider set out to make plenty of use of this thorough stayer. He faced a stiff challenge from the runner-up and pulled out sufficient in the end. His trainer feels he\'s quite well handicapped over hurdles.\\n \\bShine Baby Shine\\p, previously 2-2 over C&D on the Flat, was the first of these to come under pressure but responded to hold every chance. The winner is rated 25lb her superior on the level.\\n \\bHaulani\\p, who had blinkers back on, was the last of the three off the bridle but didn\'t pick up. He probably found this too much of a test of stamina.\\n \\bInvestigation\\p, who had been playing up at the start, refused to go after the winner had stood still in front of him at flagfall. He was deemed by the stewards to have been a runner. [Richard Lowther]\\n \\bQUOTES\\p \\bSwashbuckle\\p wasn\'t doing a whole lot in front. He was hanging fire a bit, but he was always going to stay. It\'s difficult to go a right gallop in races like this - Donald McCain, trainer. \\n ',
                    'going_type_desc' => 'Standard To Slow',
                    'rp_admission_prices' => 'see www.southwell-racecourse.co.uk/ or phone 01636 814481',
                    'total_sp' => null,
                    'rp_tv_text' => 'SKY'
                ],
                [
                    'race_instance_uid' => 783437,
                    'race_datetime' => '2018-03-02 12:45:00',
                    'race_instance_title' => 'Wathba Stallions Cup Maiden Stakes',
                    'alt_race_title' => null,
                    'formbook_yn' => null,
                    'going_type_code' => 'SS',
                    'race_class' => null,
                    'aw_surface_type' => null,
                    'race_type_code' => 'W',
                    'r_dist' => 3520,
                    'rp_ages_allowed_desc' => '4yo+',
                    'r_status' => 'R',
                    'crs_id' => 1330,
                    'mixed_crs_id' => null,
                    'course_name' => 'WOLVERHAMPTON (A.W) (GB)',
                    'course_style_name' => 'Wolverhampton (AW) (GB)',
                    'course_region' => 'Asia',
                    'mnemonic' => 'WWW',
                    'replaced_aw' => null,
                    'abandoned' => 0,
                    'rp_abbrev_3' => 'WvA',
                    'course_country' => 'ARO',
                    'course_type_code' => 'X',
                    'graphic_name' => null,
                    'graphic_height' => null,
                    'rp_flat_course_comment' => null,
                    'rp_jump_course_comment' => null,
                    'going_desc' => 'TAPETA: STANDARD',
                    'weather_cond' => null,
                    'additional_ordering' => 1,
                    'no_of_runners' => 9,
                    'no_of_runners_calculated' => 10,
                    'stalls_position' => ' ',
                    'prize' => 2000,
                    'pool_prize_sterling' => 35123.90,
                    'totes' => null,
                    'winner_time' => 100.56,
                    'diff_to_standard_time_sec' => null,
                    'scoop' => null,
                    'race_group_desc' => 'Unknown',
                    'race_group_code' => '0',
                    'is_gb_or_ire' => 0,
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
                    'official_rating_band_desc' => null,
                    'country_desc' => 'Arabia',
                    'wind' => 'fairly strong half against',
                    'rp_analysis' => null,
                    'going_type_desc' => 'Standard',
                    'rp_admission_prices' => null,
                    'total_sp' => null,
                    'rp_tv_text' => null
                ]
            ],
            //Models\Bo\Results\RaceInstance:415 ->getRaceListByDate()
            '1e607150b422520f63ef90801bc4adb6' => [
                [
                    'race_instance_uid' => 695416,
                    'stake' => 1.4325
                ]
            ],
            //Models\Bo\Results\RaceInstance:415 ->getRaceListByDate()
            '925c6728b3920f7e847d614f56bf6fc0' => [
                [
                    'race_instance_uid' => 695416,
                    'race_attrib_desc' => 'Surface',
                    'race_attrib_uid' => 403,
                    'race_attrib_code' => 'code'
                ]
            ],
            //Api\DataProvider\Bo\VideoProviders:31 ->getDetails() DROP TABLE #tmp_race_ids
            'fabddb1710b03508361534ea456ae438' => [
            ],
            //Api\DataProvider\Bo\VideoProviders:31 ->getDetails() SELECT INTO #tmp_race_ids
            'e592c2f58afbee117cbc5db71c919bc6' => [
            ],
            //Api\DataProvider\Bo\VideoProviders:31 ->getDetails() Main statement
            '10beaaaa61612758c43257e79f9dda01' => [
                [
                    'race_instance_uid' => 695416,
                    'ptv_video_id' => 289088,
                    'video_provider' => 'ATR',
                    'stream_url' => null,
                    'complete_race_uid' => 248,
                    'complete_race_start' => 0,
                    'complete_race_end' => 1,
                    'finish_race_uid' => 248,
                    'finish_race_start' => 0,
                    'finish_race_end' => 1,
                ]
            ],
            //Models\Bo\Results\RaceInstance:150 ->getTote()
            '2e0b9e87af7df665dd516be9a598781c' => [
                [
                    'race_instance_uid' => 695416,
                    'race_status_code' => 'R',
                    'course_country_code' => 'GB ',
                    'days_diff' => 6615,
                    'race_comments' => null,
                    'tote_deadheat_text' => null,
                    'tote_win_money' => 3.0,
                    'tote_place_1_money' => null,
                    'tote_place_2_money' => null,
                    'tote_place_3_money' => null,
                    'tote_place_4_money' => null,
                    'tote_dual_forecast_money' => 8.0,
                    'computer_strght_frcst_money' => 6.0,
                    'tricast_money' => null,
                    'tote_trio_money' => 10.2,
                    'trio_text' => null,
                    'jackpot_text' => '£449.40 to a £1 stake. Pool: £10,413.76 - 23.17 winning units.',
                    'placepot_text' => '£47.10 to a £1 stake. Pool: £86,806.50 - 1,344.35 winning units.',
                    'quadpot_text' => '£10.30 to a £1 stake. Pool: £7,871.22 - 564.97 winning units.',
                    'rule4_text' => null,
                    'selling_details_text' => null,
                    'scoop6_dividend' => null,
                ]
            ],
            //Models\Bo\Results\RaceInstance:150 ->getTote()
            '8da4a5e2c100622f206f46c5c147df1c' => [
                [
                    'race_instance_uid' => 695416,
                    'scoop6_dividend' => 'Scoop6 dividend'
                ]
            ],
            //Models\Bo\Results\HorseRace:359 ->getResultsDateRunners()
            '2adc1e529ebe8526d55609ce6e9f5930' => [
                [
                    'horse_uid' => 1018540,
                    'race_instance_uid' => 695416,
                    'race_status_code' => 'R',
                    'race_outcome_desc' => '1st',
                    'race_outcome_code' => '1',
                    'race_outcome_position' => 1,
                    'race_outcome_joint_yn' => 'N',
                    'race_output_order' => 1,
                    'orig_race_output_order' => 1,
                    'jockey_uid' => 81409,
                    'jockey_style_name' => 'Brian Hughes',
                    'odds_desc' => '5/2',
                    'odds_value' => 2.5,
                    'favourite_flag' => null,
                    'trainer_uid' => 15674,
                    'trainer_style_name' => 'Donald McCain',
                    'owner_style_name' => 'Matthew Taylor',
                    'rp_owner_choice' => 'a',
                    'owner_uid' => 184279,
                    'disqualification_uid' => null,
                    'rp_distance_desc' => null,
                    'dth_distance_value' => null,
                    'first_time_yn' => 'N',
                    'dtw_sum_distance_value' => null,
                    'saddle_cloth_no' => 3,
                    'saddle_cloth_letter' => null,
                    'horse_style_name' => 'Swashbuckle',
                    'country_origin_code' => 'GB',
                    'breeder_style_name' => 'Kingsclere Stud',
                    'rp_newspaper_output_desc' => 'b',
                    'sire_uid' => 49191,
                    'dam_uid' => 716257,
                    'sire_avg_flat_wdp' => 9.1,
                    'sire_avg_jump_wdp' => 22.6,
                    'horse_sire_country' => 'GB',
                    'horse_sire_style_name' => 'Dashing Blade',
                    'horse_dam_country' => 'GB',
                    'horse_dam_style_name' => 'Inhibition',
                    'horse_dam_sire_style_name' => 'Nayef',
                    'horse_dam_sire_horse_uid' => 522845,
                    'dam_sire_sire_uid' => 304579,
                    'dam_sire_dam_uid' => 415950,
                    'dam_sire_country_origin_code' => 'USA',
                    'dam_sire_avg_flat_wdp' => 9.1,
                    'dam_sire_avg_jump_wdp' => 22.6,
                    'joint_2nd_fav' => 0,
                    'fav_2nd' => 0,
                    'each_way_placed' => 'N',
                ],
                [
                    'horse_uid' => 1488100,
                    'race_instance_uid' => 695416,
                    'race_status_code' => 'R',
                    'race_outcome_desc' => '2nd',
                    'race_outcome_code' => '2',
                    'race_outcome_position' => 2,
                    'race_outcome_joint_yn' => 'N',
                    'race_output_order' => 2,
                    'orig_race_output_order' => 2,
                    'jockey_uid' => 85680,
                    'jockey_style_name' => 'Adam Nicol',
                    'odds_desc' => '6/5F',
                    'odds_value' => 1.2,
                    'favourite_flag' => 'F',
                    'trainer_uid' => 18875,
                    'trainer_style_name' => 'Philip Kirby',
                    'owner_style_name' => 'David Gray & P Kirby',
                    'rp_owner_choice' => 'a',
                    'owner_uid' => 251385,
                    'disqualification_uid' => null,
                    'rp_distance_desc' => '1',
                    'dth_distance_value' => 1.0,
                    'first_time_yn' => 'N',
                    'dtw_sum_distance_value' => 1.0,
                    'saddle_cloth_no' => 7,
                    'saddle_cloth_letter' => null,
                    'horse_style_name' => 'Shine Baby Shine',
                    'country_origin_code' => 'GB',
                    'breeder_style_name' => 'Horizon Bloodstock Limited',
                    'rp_newspaper_output_desc' => 'b',
                    'sire_uid' => 685231,
                    'dam_uid' => 537416,
                    'sire_avg_flat_wdp' => 8.7,
                    'sire_avg_jump_wdp' => null,
                    'horse_sire_country' => 'GB',
                    'horse_sire_style_name' => 'Aqlaam',
                    'horse_dam_country' => 'USA',
                    'horse_dam_style_name' => 'Rosewood Belle',
                    'horse_dam_sire_style_name' => 'Woodman',
                    'horse_dam_sire_horse_uid' => 303747,
                    'dam_sire_sire_uid' => 301599,
                    'dam_sire_dam_uid' => 429407,
                    'dam_sire_country_origin_code' => 'USA',
                    'dam_sire_avg_flat_wdp' => 8.7,
                    'dam_sire_avg_jump_wdp' => null,
                    'joint_2nd_fav' => 0,
                    'fav_2nd' => 0,
                    'each_way_placed' => 'N',
                ]
            ],
            //Models\Bo\Results\RaceInstanceTote:27 ->getRuleFourByRaceId()
            '0fa56d4a41ee5862783d17e3ca9b184a' => [
                [
                    'race_instance_uid' => 695416,
                    'rule4_text' => null,
                ]
            ],
            //Models\Bo\Results\Horse:65 ->getNonRunners()
            '64925252f895c69860cd4f24943649e7' => [
                [
                    'race_instance_uid' => 695416,
                    'horse_uid' => 868799,
                    'horse_name' => 'Magic Dancer',
                    'horse_country_origin_code' => 'GB',
                    'horse_age' => 6,
                    'sire_name' => 'The Factor',
                    'sire_country' => 'USA',
                    'first_season_sire_id' => null,
                    'rp_close_up_comment' => 'travel problems',
                    'weight_carried_lbs' => 158,
                    'jockey_style_name' => null,
                    'trainer_style_name' => 'Kerry Lee',
                    'owner_group_uid' => null,
                ],
                [
                    'race_instance_uid' => 695416,
                    'horse_uid' => 1380982,
                    'horse_name' => 'Ortenzia',
                    'horse_country_origin_code' => 'IRE',
                    'horse_age' => 4,
                    'sire_name' => 'The Factor',
                    'sire_country' => 'USA',
                    'first_season_sire_id' => null,
                    'rp_close_up_comment' => 'travel problems',
                    'weight_carried_lbs' => 143,
                    'jockey_style_name' => null,
                    'trainer_style_name' => 'Charlie Longsdon',
                    'owner_group_uid' => null,
                ]
            ],
            //Models\Bo\Results\HorseRace:494 ->getHorseOwnerGroups()
            '709cbb3da59be4c1f77edfa3f36a4db1' => [
                [
                    'horse_uid' => 1353019,
                    'owner_group_uid' => 5,
                    'to_follow_uid' => null
                ],
            ],
            //Models\CourseDirections:39 ->getCourseDirectionsByCourseId()
            'e2bf49ac3557361172e48250ad5ecd85' => [
                [
                    'course_uid' => 394,
                    'direction_type_code' => 'R',
                    'direction' => '3m SE of town at Rolleston, A617 from Newark/Mansfield, A612 from Nottingham.',
                ],
                [
                    'course_uid' => 394,
                    'direction_type_code' => 'T',
                    'direction' => 'Adjoining course, Rolleston Stn (Nottingham - Newark line).',
                ],
            ],
            //Models\Bo\Results\RaceInstance:819 ->getDividends()
            '396d3dc4d41de676608065746e273cb3' => [
                [
                    'course_uid' => 394,
                    'race_instance_uid' => 695416,
                    'race_datetime' => '2018-03-02 13:45:00',
                    'race_type_code' => 'W',
                    'flat_or_jumps' => 'J',
                    'race_double' => 3,
                    'race_win_dist' => 1.0,
                    'dht' => 0,
                    'horses_run' => 4,
                    'finishing_horses' => 2,
                    'non_runners' => 3,
                    'race_sp' => 2.5,
                    'race_sp_count' => 1,
                    'race_favs_pos' => 2,
                    'race_favs_count' => 1,
                ],
                [
                    'course_uid' => 394,
                    'race_instance_uid' => 559595,
                    'race_datetime' => '2018-03-02 15:45:00',
                    'race_type_code' => 'W',
                    'flat_or_jumps' => 'J',
                    'race_double' => null,
                    'race_win_dist' => 9.0,
                    'dht' => 0,
                    'horses_run' => 4,
                    'non_runners' => 3,
                    'finishing_horses' => 2,
                    'race_sp' => 0,
                    'race_sp_count' => 1,
                    'race_favs_pos' => 2,
                    'race_favs_count' => null,
                ],
                // case where the race was a walkover race (only 1 horse entered and finished) so the winning_distance will be 30
                [
                    'course_uid' => 394,
                    'race_instance_uid' => 559595,
                    'race_datetime' => '2018-03-02 15:45:00',
                    'race_type_code' => 'W',
                    'flat_or_jumps' => 'J',
                    'race_double' => null,
                    'race_win_dist' => 1,
                    'dht' => 0,
                    'horses_run' => 4,
                    'non_runners' => 1,
                    'finishing_horses' => 1,
                    'race_sp' => 0,
                    'race_sp_count' => 1,
                    'race_favs_pos' => 2,
                    'race_favs_count' => null,
                ]
            ],
            //Models\Bo\Results\RaceInstance:840 ->getDividends()
            'c14a7284cafa4b3ca32edab6adb53d54' => [
                [
                    'course_uid' => 206,
                    'betting_man' => ' ',
                    'analysis_man' => ' ',
                    'close_up_man' => ' ',
                ],
                [
                    'course_uid' => 299,
                    'betting_man' => null,
                    'analysis_man' => null,
                    'close_up_man' => null,
                ],
                [
                    'course_uid' => 394,
                    'betting_man' => 'GARY TRISCONI & SIS',
                    'analysis_man' => 'RICHARD LOWTHER',
                    'close_up_man' => 'ANDREW SHERET',
                ],
                [
                    'course_uid' => 482,
                    'betting_man' => null,
                    'analysis_man' => null,
                    'close_up_man' => null,
                ],
                [
                    'course_uid' => 1141,
                    'betting_man' => null,
                    'analysis_man' => null,
                    'close_up_man' => null,
                ],
                [
                    'course_uid' => 1303,
                    'betting_man' => null,
                    'analysis_man' => null,
                    'close_up_man' => null,
                ],
            ],
        ];
    }
}
