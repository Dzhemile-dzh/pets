<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\RacecardsResults\PreRaceTest;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\RacecardsResults\PreRaceTest
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/racecards-results/98765';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\RacecardsResults:37->getRaceStatusCode()
            'f3e8702505e5bc93efa5d12e738a0989' => [
                [
                    'race_status_code' => 'O'
                ]
            ],
            //Models\Bo\RaceCards\RaceInstance:832 ->getRaceCard()
            '5f104682e428547375791a373de3555b' => [
                [
                    'race_instance_title' => 'PitchSupplies.ie Apprentice Handicap',
                    'rp_ages_allowed_desc' => '3yo+',
                    'race_instance_uid' => 98765,
                    'race_class' => '5',
                    'pool_prize_sterling' => 98765,
                    'official_rating_band_desc' => '0-100',
                    'race_datetime' => '2030-08-21 16:10:00',
                    'local_meeting_race_datetime' => '2030-08-21 16:10:00',
                    'hours_difference' => 4,
                    'three_yo_min_weight_lbs' => null,
                    'four_yo_min_weight_lbs' => null,
                    'minimum_weight_lbs' => 140,
                    'declared_runners' => 10,
                    'race_condition_desc' => 'race_condition_desc goes here as a long string',
                    'no_of_runners' => 10,
                    'distance_yard' => 3902,
                    'rp_tv_text' => 'ATR',
                    'going_type_desc' => 'Good',
                    'rp_penalties' => 'after May 26th, each hurdle won 7lb',
                    'course_uid' => 185,
                    'mixed_course_uid' => null,
                    'course_name' => 'KILLARNEY',
                    'course_style_name' => 'Killarney',
                    'course_region' => 'GB & IRE',
                    'rp_horse_types' => '4yo+ fillies & mares Rated 0-100 (also open to such horses rated 101 and 102 - see Standard Conditions)',
                    'rp_weights' => '',
                    'allowances' => 'riders who, prior to June 2nd, 2018, have not ridden more than 20 winners under any Rules of Racing 3lb; 10 such winners 5lb; 5 such winners 7lb; riders riding for their own stable allowed, in addition 3lb',
                    'entry_fee' => 22,
                    'extra_fee' => null,
                    'country_code' => 'GB ',
                    'foreign' => 0,
                    'rp_stakes' => 6321.0,
                    'rp_ag_indicator' => 'G',
                    'weights_raised_lbs' => 1,
                    'rp_auction_min' => null,
                    'rp_claim_min' => null,
                    'rp_confirmed' => null,
                    'race_status_code' => 'O',
                    'race_type_code' => 'F',
                    'race_group_desc' => 'Handicap',
                    'going_type_code' => 'G',
                    'no_of_fences' => 9,
                    'no_of_entries' => 16,
                    'rp_stalls_position' => ' ',
                    'stage' => null,
                    'forfeit_number' => null,
                    'forfeit_value' => null,
                    'race_group_code' => 'H',
                    'safety_factor_number' => 16,
                    'early_closing_race_yn' => null,
                    'reopened_yn' => 'N',
                    'division_preference' => null,
                    'prev_year_datetime' => '2018-06-05 14:15:00',
                    'prev_runners' => 20,
                    'prev_horse_name' => 'Red Balloons',
                    'prev_draw' => null,
                    'prev_trainer' => 'Richard Fahey',
                    'prev_horse_age' => 2,
                    'prev_weight_carried' => 118,
                    'prev_odds' => '33/1',
                    'prev_jockey' => 'Barry McHugh',
                    'prev_w_allowance' => null,
                    'prev_rating' => 'RPR87',
                    'highest_official_rating' => null,
                    'scoop6_race' => 'N',
                    'lucky7_race' => 'N',
                    'jackpot_race' => 'N',
                    'william_hill_offer_race' => 'N',
                    'ladbrokes_offer_race' => 'N',
                    'perform_race_uid_atr' => 328345,
                    'perform_race_uid_ruk' => null,
                    'livestream_uid' => null,
                    'lookup_uid' => 11,
                    'int_1' => 123,
                    'aw_surface_type' => null,
                    'stalls_position_desc' => null,
                    'straight_round_jubilee_code' => null,
                    'live_tab' => 'Y',
                    'claiming_race' => 'N',
                    'selling_race' => 'N',
                    'plus10_race' => 'N',
                    'race_number' => 1,
                    'weight_allowance_lbs' => 1,
                    'ages_allowed_uid' => 21,
                    'weather_details' => '(Showers)',
                    'beatenFavourite' => false
                ],
            ],
            //Models\Bo\RaceCards\Runners:37 ->getRunners()
            'a58de841ca2db072f0bd1bf32e73b551' => [
                [
                    'saddle_cloth_no' => 1,
                    'draw' => 2,
                    'race_type_code' => 'F',
                    'race_status_code' => 'O',
                    'distance_yard' => 1760,
                    'track_code' => null,
                    'course_uid' => 38,
                    'course_country_code' => 'GB ',
                    'straight_round_jubilee_code' => 'W',
                    'owner_uid' => 252497,
                    'owner_name' => 'HH Sheikha Al Jalila Racing',
                    'breeder_uid' => 1025493,
                    'style_name' => "John Cullinan",
                    'eliminator_no' => 0,
                    'horse_uid' => 12345,
                    'horse_name' => 'Glorious Journey',
                    'country_origin_code' => 'GB',
                    'race_instance_uid' => 98765,
                    'race_datetime' => '2018-06-05 14:15:00',
                    'rp_horse_head_gear_code' => 'p',
                    'first_time_yn' => 'Y',
                    'extra_weight_lbs' => 0,
                    'horse_age' => 3,
                    'weight_carried_lbs' => 126,
                    'official_rating' => 131,
                    'jockey_uid' => 6901,
                    'jockey_name' => 'James Doyle',
                    'aka_style_name' => 'J Doyle',
                    'weight_allowance_lbs' => 0,
                    'trainer_uid' => 98765,
                    'trainer_style_name' => 'Charlie Appleby',
                    'short_trainer_name' => 'C Appleby',
                    'trainer_search_name' => 'C Appleby',
                    'trainer_ptp_type_code' => 'N',
                    'trainer_country_code' => 'IRE',
                    'rp_postmark' => 122,
                    'rp_topspeed' => -22,
                    'unadjusted_rp_postmark' => 102,
                    'rp_owner_choice' => 'a',
                    'non_runner' => null,
                    'irish_reserve_yn' => 'N',
                    'allowance' => null,
                    'extra_weight' => null,
                    'horse_colour_code' => 'B',
                    'horse_sex_code' => 'F',
                    'horse_sex_desc' => 'filly',
                    'horse_colour_desc' => 'Brown',
                    'sire_id' => 589690,
                    'sire_name' => 'Dubawi',
                    'sire_country' => 'IRE',
                    'first_season_sire_id' => null,
                    'dam_id' => 789750,
                    'dam_name' => 'Fallen For You',
                    'dam_country' => 'GB',
                    'damsire_id' => 503875,
                    'damsire_name' => 'Dansili',
                    'damsire_country' => 'GB',
                    'horse_head_gear_desc' => 'blinkers, tongue strap',
                    'longSpotlight' => 'Very well bred colt who won a 6f maiden on the July course on debut last June before making all to take 7f Group 3 at Saint-Cloud in September in only other start; needs another step up form-wise but has done all that\'s been asked of him so far and is totally unexposed; cheekpieces on now.',
                    'shortSpotlight' => null,
                    'diomed' => '2 from 2, including French Group 3; cheekpieces now',
                    'figures' => '11-4',
                    'figures_calculated' => null,
                    'new_trainer_races_count' => null,
                    'ten_to_follow_horse' => null,
                    'reasoning' => null,
                    'plus10_horse' => 'N',
                    'yearling_bonus_horse' => 'N',
                    'lh_weight_carried_lbs' => null,
                    'out_of_handicap' => null,
                    'beaten_favourite' => 'N',
                    'forecast_odds_value' => 4.5,
                    'selection_cnt' => null,
                    'forecast_odds_desc' => '9/2',
                    'course_and_distance_wins' => 0,
                    'course_wins' => 1,
                    'distance_wins' => 0,
                    'running_conditions' => null,
                    'date_gelded' => '2020-08-21 16:10:00',
                    'gelding_first_time' => 0,
                    'rp_postmark_improver' => 'N',
                    'wfa_adjustment' => null,
                    'owner_group_uid' => null,
                    'race_group_uid' => 3,
                    'early_closing_race_yn' => null,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                    'is_jockey_first_time' => 'N',
                    'official_rating_horse' => null,
                    'handicap_first_time' => 'N',
                    'race_group_code' => 'H',
                    'horse_date_of_birth' => '2015-02-09 00:00:00',
                    'jockey_last_14_days' => null,
                    'current_official_rating' => 131,
                    'official_rating_ran_off' => 955
                ]
            ],

            //Models\Bo\RaceCards\RaceInstance:83 ->getRaceInstance()
            'd74d7c379cdd5ceb02d87badd86614d5' => [
                [
                    'race_id' => 764898,
                    'race_type_code' => 'F',
                    'race_datetime' => '2018-04-19 15:35:00',
                    'race_status_code' => 'O',
                    'distance_yard' => 1760,
                    'race_group_code' => 'H',
                    'course_uid' => 38,
                    'rp_abbrev_3' => 'NMK',
                    'country_code' => 'GB',
                    'course_name' => 'NEWMARKET',
                    'course_style_name' => 'Newmarket',
                    'going_type_code' => 'G ',
                    'going_type_desc' => 'Good',
                    'declared_runners' => 10,
                    'no_of_runners' => 10,
                    'rp_tv_text' => 'ITV4',
                ]
            ],
            //Models\Bo\RaceCards\RaceInstance:993 ->fetchVerdict()
            'c815cf7d486e01f6dd43658e23f614d2' => [
                [
                    'race_instance_uid' => 98765,
                    'race_datetime' => '2018-04-19 15:35:00',
                    'rp_verdict' => 'some verdict text goes here',
                    'pre_race_instance_comments' => '\\bBaronial Pride\\p and \\bConstant\\p are interesting newcomers but Group 1 entry \\bSENSE OF BELONGING\\p looks the one to beat.',
                    'key_stats_str' => 'Owner Sheikh Hamdan bin Mohammed Al Maktoum has had 5 winners from 16 runners in the last fortnight (<b>Yellow Fire</b>)',
                    'horse_uid' => 12345,
                    'horse_style_name' => 'Yellow Fire',
                    'horse_country_origin_code' => 'IRE',
                    'course_uid' => 22,
                    'course_country_code' => 'GB',
                    'course_style_name' => 'Hamilton',
                    'owner_uid' => 59472,
                    'rp_owner_choice' => 'a',
                    'saddle_cloth_no' => 4,
                    'non_runner' => null,
                ],
            ],
            //Api\DataProvider\Bo\RaceCards:832 ->getRaceAttributes()
            '43ce2876677b56b4b91443e5647928be' => [
                [
                    'race_attrib_desc' => "Category Desc",
                    'race_attrib_code' => 'Category',
                    'race_attrib_uid' => 55,
                    'race_instance_uid' => 98765
                ],
                [
                    'race_attrib_desc' => "5",
                    'race_attrib_code' => 'Class_subset',
                    'race_attrib_uid' => 55,
                    'race_instance_uid' => 98765
                ],
                [
                    'race_attrib_desc' => "Cheese",
                    'race_attrib_code' => 'Surface',
                    'race_attrib_uid' => 75,
                    'race_instance_uid' => 98765
                ]
            ],
            //Models\Horse:3769 ->getHorsesAttributes()
            '96c5658401855687ba4dea75a1fc6944' => [
                [
                    'age' => 2
                ]

            ],
            //Models\Horse:3769 ->getHorsesAttributes()
            'be280b0d588fc94c288ae6c4d6b8fe02' => [
            ],
            //Models\Horse:3769 ->getHorsesAttributes()
            '3ef656291485d1771948c54290bec7d9' => [
            ],
            //Models\RaceInstancePrize:228 ->getForRaceInstanceId()
            'fe65f1304903ad14318ded88328fc4d2' => [
                [
                    'position_no' => 1,
                    'prize_sterling' => 3119.04,
                    'prize_euro' => 5000,
                    'prize_usd' => 4210.7,
                ],
                [
                    'position_no' => 2,
                    'prize_sterling' => 915.84,
                    'prize_euro' => null,
                    'prize_usd' => 1236.38,
                ],
                [
                    'position_no' => 3,
                    'prize_sterling' => 457.92,
                    'prize_euro' => null,
                    'prize_usd' => 618.19,
                ],
                [
                    'position_no' => 4,
                    'prize_sterling' => 350.0,
                    'prize_euro' => null,
                    'prize_usd' => 472.5,
                ]
            ],
            //Models\Bo\RaceCards\Runners:321 ->getTipsterData()
            'ce2a7365169567793d813ea5b296634f' => [
                [
                    'newspaper_name' => 'Daily Mail',
                    'newspaper_uid' => 2,
                    'horse_uid' => 12345,
                    'selection_type' => 'NAP',
                    'tipster_name' => ''
                ],
                [
                    'newspaper_name' => 'Daily Trouble',
                    'newspaper_uid' => 3,
                    'horse_uid' => 12345,
                    'selection_type' => 'NB',
                    'tipster_name' => ''
                ],
                [
                    'newspaper_name' => 'Maily Daily',
                    'newspaper_uid' => 1,
                    'horse_uid' => 12345,
                    'selection_type' => 'NB',
                    'tipster_name' => ''
                ]
            ],
            //Models\Bo\RaceCards\Runners:328 ->getPremiumTipsterData()
            '5bec51ed68617115760a97c9999ba96d' => [
                [
                    // A premium tipster with a newspaper id that should see it use the tipster name instead of newspaper_name
                    'newspaper_name' => 'RP Tipping',
                    'newspaper_uid' => 85,
                    'horse_uid' => 12345,
                    'selection_type' => '',
                    'tipster_name' => 'Tom Collins'
                ],
                [
                    // A premium tipster that should use its newspaper name
                    'newspaper_name' => 'SIGNPOSTS SWEETSPOTS',
                    'newspaper_uid' => 131,
                    'horse_uid' => 12345,
                    'selection_type' => '',
                    'tipster_name' => 'Sweetspots'
                ]
            ],
            //Models\Bo\RaceCards\Runners:466 ->getJockeyStatistics()
            '088e38b67d9e3dab652c66769abf1577' => [
                [
                    'jockey_uid' => 13689,
                    'jockey_runs' => 1,
                    'jockey_wins' => 1
                ]
            ],
            //Models/Bo/RaceCards/Runners:444 ->getWfaPerAges()
            '1bada406f3fa1716a2598cf7604a5d4e' => [
                [
                    'weight_allowance_lbs' => 10,
                    'age' => 2,
                    'distance_furlongs' => 5,
                    'race_type_code' => 'F'
                ]
            ],
            //Models\Bo\RaceCards\Runners:736 ->getGoingWinner()
            '98e9b9de2ce7a13edab3e5501d4beb06' => [
                [
                    'horse_uid' => 12345,
                    'winner_count' => 1
                ]

            ],
            //Models\Bo\RaceCards\Runners:696 ->getHorseYearlingAndPlus10()
            'fe2daf88c8349ce150da7dcc6aae1592' => [
                [
                    'horse_uid' => 12345,
                    'yearling_bonus_horse' => 1,
                    'plus10_horse' => 0
                ]
            ],
            //Models\Bo\TrainerProfile\HorseRace:64 ->getRunningToForm()
            'a100683ec1ba57728f6114377c8164e9' => [
                [
                    'trainer_uid' => 98765,
                    'horse_uid' => 12345,
                    'race_instance_uid' => 98765,
                    'race_datetime' => '2018-04-19 15:35:00',
                    'race_outcome_position' => 7,
                    'race_outcome_form_char' => '7',
                    'rp_postmark' => 53,
                    'rp_pre_postmark' => 52,
                    'race_distance' => 1540,
                    'dist_to_winner' => 10.75,
                    'race_group_uid' => 0,
                    'runners' => 11,
                ],
                [
                    'trainer_uid' => 98765,
                    'horse_uid' => 12345,
                    'race_instance_uid' => 98765,
                    'race_datetime' => '2018-04-19 15:35:00',
                    'race_outcome_position' => 4,
                    'race_outcome_form_char' => '4',
                    'rp_postmark' => 61,
                    'rp_pre_postmark' => 68,
                    'race_distance' => 2926,
                    'dist_to_winner' => 15.25,
                    'race_group_uid' => 0,
                    'runners' => 6,
                ],
            ],
            //Models\HorseRace:274 ->getHorsesForm()
            '3ff589ebf6c8e4b68a3bc9b7c6f51bf8' => [
                [
                    'horse_uid' => 12345,
                    'race_instance_uid' => 686108,
                    'race_datetime' => '2029-10-07 15:15:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => 1,
                    'race_outcome_form_char' => '1',
                ],
                [
                    'horse_uid' => 12345,
                    'race_instance_uid' => 684182,
                    'race_datetime' => '2029-09-08 13:10:00',
                    'race_type_code' => 'X',
                    'race_outcome_position' => 2,
                    'race_outcome_form_char' => '1',
                ],
                [
                    'horse_uid' => 12345,
                    'race_instance_uid' => 676064,
                    'race_datetime' => '2029-06-10 13:25:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => 3,
                    'race_outcome_form_char' => '1',
                ],
                [
                    'horse_uid' => 12345,
                    'race_instance_uid' => 676264,
                    'race_datetime' => '2029-02-10 13:25:00',
                    'race_type_code' => 'C',
                    'race_outcome_position' => 5,
                    'race_outcome_form_char' => '1',
                ],
                [
                    'horse_uid' => 12345,
                    'race_instance_uid' => 68615508,
                    'race_datetime' => '2028-10-07 15:15:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => 1,
                    'race_outcome_form_char' => '1',
                ],
                [
                    'horse_uid' => 12345,
                    'race_instance_uid' => 68413382,
                    'race_datetime' => '2028-09-08 13:10:00',
                    'race_type_code' => 'X',
                    'race_outcome_position' => 2,
                    'race_outcome_form_char' => '1',
                ],
                [
                    'horse_uid' => 12345,
                    'race_instance_uid' => 6762264,
                    'race_datetime' => '2028-06-10 13:25:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => 3,
                    'race_outcome_form_char' => '1',
                ]
            ],
            //Models\Bo\RaceCards\RaceInstance:3935 ->getRaceAdditionalData()
            'db0cd25b926b13dfdee03559d257f8c8' => [
                [
                    'race_instance_uid' => 98765,
                    'distance_yard' => 4594,
                    'race_datetime' => '2018-04-10 14:40:00',
                    'race_type_code' => 'F',
                    'race_group_code' => 'H',
                    'country_code' => 'GB ',
                    'min_weight' => 140,
                    'race_status_code' => 'O',
                    'weight_adjustment' => 168,
                    'min_age' => 7,
                    'max_age' => 9,
                    'top_age' => 0,
                    'furlong' => 20.0,
                ],
            ],
            //Models\Bo\RaceCards\Runners:1330 ->getSelectionsCount()
            '25a161dd80d91b7882ec7681be35033c' => [
                [
                    'selection_count' => 12,
                    'horse_uid' => 12345
                ]
            ],
            //Api\DataProvider\Bo\Native\Cards\FullCard\Data ->getDaysSinceLastRun()
            '927b9e6c8ce863e3fab32473938d2255' => [
                [
                    'horse_uid' => 12345,
                    'race_type_code' => 'flat',
                    'days_since_run' => 18,
                ]
            ],
            //Models\Bo\RaceCards\Runners:929 ->getPreviousTrainers()
            'f84e62b879219190ad098cd4bc14c39b' => [
            ],
            //Models\Bo\RaceCards\Runners:929 ->getPreviousTrainers()
            '661a88abcf50b91bf722fa9043d362e3' => [
            ],
            //Models\Bo\RaceCards\Runners:929 ->getPreviousTrainers()
            '1253fbc89d270c3fff7c17486f1161be' => [
                [
                'season_start_date' => '2018-01-01 00:00:00',
                ]
            ],

            //\Models\Bo\RaceCards\Runners:1171 ->fetchImproverData
            '0384457173f1eef16dca0cdb85707a87' => [
                [
                    'horse_uid' => 12345,
                    'date_diff' => 3,
                    'race_type_code' => 'F',
                    'rp_postmark' => 5
                ]
            ],
            //\Models\Bo\RaceCards\Runners:920 ->getHorseOwnerGroups
            '26472cecd65a9723e4866fe36f59955b' => [
                [
                    'horse_uid' => 12345,
                    'owner_group_uid' => 3211
                ]
            ],

            //Models\Bo\RaceCards\Runners:890 ->getGoingPerformance()
            '84de44dfefb76b039eef250da1a88370' => [
                [
                    'horse_uid' => 12345,
                    'slow_ground_flat_wins' => 0,
                    'slow_ground_jumps_wins' => 0,
                    'fast_ground_wins' => 0,
                ],
                [
                    'horse_uid' => 12345,
                    'slow_ground_flat_wins' => 0,
                    'slow_ground_jumps_wins' => 0,
                    'fast_ground_wins' => 0,
                ]
            ],
            //Models\Bo\RaceCards\Runners:529 ->getFirstSeasonSire()
            '3ca7199e5c6df1b1516a19832f6fcc7f' => [
            ],

            //provider/DataProvider/Bo/Rpr.php -> getRprStatistics()
            '6a2b643b32454ff574e4f318d2097885' => [
            ],
            //models/Bo/RaceCards/RaceInstance.php:3953 -> getHorsesTopspeed()
            '9bc3cd6fed220169ba9446b642f062a0' => [
            ],
            //Models\Bo\RaceCards\Runners:600 ->getGeldingFirstTimeRunners()
            '72397f6165e202320f6cf3817fe0c337' => [
                [
                    'horse_uid' => 12345
                ]
            ],
            //Models\Bo\RaceCards\Horse:1112 ->getLongHandicapPerRaces()
            '67a3e540324d15d4802f1f7c10f2c1f6' => [
                [
                    'race_instance_uid' => 98765,
                    'horse_uid' => 12345,
                    'style_name' => 'Glorious Journey',
                    'country_origin_code' => 'GB',
                    'weight_carried_lbs' => 125,
                    'weights_raised_lbs' => 0,
                    'extra_weight_lbs' => 0,
                    'saddle_cloth_no' => 1,
                    'horse_age' => 3,
                    'minimum_weight_lbs' => 140,
                    'three_yo_min_weight_lbs' => 140
                ]
            ],
            //Models\Bo\RaceCards\Runners:772 ->getBeatenFavourites()
            'a591c7d12043126806e5b6c954a187d2' => [
            ],
            //Models\Bo\RaceCards\Runners:772 ->getBeatenFavourites()
            '8dd9e5211f1940a7df036d8f704960a8' => [
            ],
            //Models\Bo\RaceCards\Runners:835 ->getHorseForms()
            '984011d843cc5b13aa50c62b40102740' => [
            ],
            //Models\Bo\RaceCards\Runners:508 ->createTmpTableHorseRaces()
            '22297cbc555068e433c7d569f676651c' => [

            ],
            //Models\Bo\RaceCards\Runners:551 ->createTmpTableLastSurgery
            'af64981bb085e581470168b9913a08b4' => [
            ],
            //Models/Bo/RaceCards/Runners:434 ->countRacesAfterSurgery()
            'ea07916079682d71a5734a314ac8c54f' => [
            ],
            //\Bo\racecards\runners\303 ->createTmpTableMain()
            '8cb61f333c716dc2b37d9670d2fcd5cf' => [
            ],

            //Models\Bo\RaceCards\Runners/->DROP tmpHorseRaces
            '9ee438da8697301551276b894669ab4c' => [
            ],
            ///Models/Bo/RaceCards/Runners->DROP tmpLastSurgery
            'f268da9b3574e32b5a7f04bb65cb9fb7' => [
            ],
            ///Models/Bo/RaceCards->DROP tmp table
            'cd641fb1ce0c4e46718f19304c6edcfb' => [
            ],
            ///Models/Bo/RaceCards->DROP tmp table race_horses
            '40f233f668a22f2d18077b1571c1d1ca' => [
            ],
            //Api\DataProvider\Bo\TmpTable ->dropTmpTable()
            'c8767c5cb230e3ef39ddbb7447c0e268' => [
            ],
            ///Models\Bo\RaceCards\Runners:1469 ->getTipsterData()
            '5758b10c09bf45af9dce639a0af4c96d' => [
            ],
            ///Models\Bo\RaceCards\Runners:1515 ->getPremiumTipsterData()
            'bd7595c698d75e64ccc77ec4668691af' => [
            ],
        ];
    }
}
