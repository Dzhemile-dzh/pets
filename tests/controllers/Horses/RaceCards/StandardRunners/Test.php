<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\RaceCards\StandardRunners;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\RaceCards\StandardRunners
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/racecards/standard-runners/698857';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\RaceCards\RaceInstance:4153 ->checkRaceAbandoned()
            'ef272989e7aeb0546974db45a00360ad' => [
                [
                    'race_status_code' => 'R',
                ],
            ],
            //Models\Bo\RaceCards\RaceInstance:83 ->getRaceInstance()
            'ecea052ff78e6e20d23f1442f80a19f8' => [
                [
                    'race_id' => 698857,
                    'race_type_code' => 'C',
                    'race_datetime' => '2018-04-10 14:40:00',
                    'race_status_code' => 'R',
                    'distance_yard' => 4594,
                    'race_group_code' => 'H',
                    'course_uid' => 24,
                    'rp_abbrev_3' => 'HER',
                    'country_code' => 'GB',
                    'course_name' => 'HEREFORD',
                    'course_style_name' => 'Hereford',
                    'going_type_code' => 'HY',
                    'going_type_desc' => 'Heavy',
                    'declared_runners' => 18,
                    'no_of_runners' => 18,
                    'rp_tv_text' => 'ATR',
                ]
            ],
            //Models\Bo\RaceCards\Runners:275 ->createTmpTableMain()
            '694de50696fc5143b1928940092d621f' => [

            ],
            //Models\Bo\RaceCards\Runners:514 ->getRunners()
            '71cbc348099584b9d04f196109755aab' => [
                [
                    'saddle_cloth_no' => 1,
                    'draw' => 0,
                    'race_type_code' => 'C',
                    'race_status_code' => 'R',
                    'distance_yard' => 4594,
                    'track_code' => null,
                    'course_uid' => 24,
                    'course_country_code' => 'GB ',
                    'straight_round_jubilee_code' => null,
                    'owner_uid' => 19131,
                    'owner_name' => 'C J Haughey',
                    'eliminator_no' => 0,
                    'horse_uid' => 832660,
                    'horse_name' => 'Wood Pigeon',
                    'country_origin_code' => 'IRE',
                    'race_instance_uid' => 698857,
                    'race_datetime' => '2018-04-10 14:40:00',
                    'rp_horse_head_gear_code' => 'p',
                    'first_time_yn' => 'N',
                    'extra_weight_lbs' => 0,
                    'horse_age' => 9,
                    'weight_carried_lbs' => 166,
                    'official_rating' => 103,
                    'official_rating_today' => null,
                    'jockey_uid' => 12290,
                    'jockey_name' => 'Richard Johnson',
                    'weight_allowance_lbs' => null,
                    'trainer_uid' => 33553,
                    'trainer_stylename' => 'Olly Murphy',
                    'trainer_search_name' => 'O Murphy',
                    'trainer_ptp_type_code' => 'N',
                    'trainer_country_code' => 'GB',
                    'rp_postmark' => 111,
                    'rp_topspeed' => 89,
                    'unadjusted_rp_postmark' => 104,
                    'rp_owner_choice' => 'a',
                    'non_runner' => null,
                    'irish_reserve_yn' => 'N',
                    'allowance' => null,
                    'extra_weight' => null,
                    'horse_colour_code' => 'B',
                    'horse_sex_code' => 'G',
                    'sire_id' => 96595,
                    'sire_name' => 'Presenting',
                    'sire_country' => 'GB',
                    'first_season_sire_id' => null,
                    'dam_id' => 524740,
                    'dam_name' => 'Come In Moscow',
                    'dam_country' => 'IRE',
                    'damsire_id' => 301761,
                    'damsire_name' => 'Over The River',
                    'damsire_country' => 'FR',
                    'spotlight' => 'Very up and down but runner-up in two of his last three starts (2m3f/2m5f) and thereabouts once more despite looking on a tough enough mark.',
                    'diomed' => 'On a tough enough mark but has finished runner-up in two of his last three starts.',
                    'figures' => '62265-6',
                    'figures_calculated' => null,
                    'new_trainer_races_count' => null,
                    'ten_to_follow_horse' => null,
                    'reasoning' => null,
                    'plus10_horse' => 'N',
                    'yearling_bonus_horse' => 'N',
                    'lh_weight_carried_lbs' => null,
                    'out_of_handicap' => null,
                    'beaten_favourite' => 'N',
                    'forecast_odds_value' => 2.5,
                    'forecast_odds_desc' => '5/2',
                    'course_and_distance_wins' => 0,
                    'course_wins' => 0,
                    'distance_wins' => 0,
                    'running_conditions' => null,
                    'date_gelded' => null,
                    'gelding_first_time' => 0,
                    'rp_postmark_improver' => 'N',
                    'wfa_adjustment' => null,
                    'owner_group_uid' => null,
                    'race_group_uid' => 6,
                    'early_closing_race_yn' => null,
                    'is_wind_surgery_first_time' => 'N',
                    'selection_cnt' => null,
                    'is_wind_surgery_second_time' => 'N',
                    'is_jockey_first_time' => 'N',
                    'official_rating_horse' => null,
                    'current_official_rating' => null,
                    'handicap_first_time' => 'N',
                    'going_winner' => 'Y',
                    'race_group_code' => 'H',
                    'horse_date_of_birth' => '2009-05-02 00:00:00',
                    'jockey_wins' => 9,
                    'jockey_runs' => 51,
                    'jockey_last_14_days' => null,
                ],
                [
                    'saddle_cloth_no' => 2,
                    'draw' => 0,
                    'race_type_code' => 'F',
                    'race_status_code' => 'R',
                    'distance_yard' => 4594,
                    'track_code' => null,
                    'course_uid' => 24,
                    'course_country_code' => 'GB ',
                    'straight_round_jubilee_code' => null,
                    'owner_uid' => 57197,
                    'owner_name' => 'Miss V M Williams',
                    'eliminator_no' => 0,
                    'horse_uid' => 833010,
                    'horse_name' => 'One Style',
                    'country_origin_code' => 'FR',
                    'race_instance_uid' => 698857,
                    'race_datetime' => '2018-04-10 14:40:00',
                    'rp_horse_head_gear_code' => null,
                    'first_time_yn' => null,
                    'extra_weight_lbs' => 0,
                    'horse_age' => 3,
                    'weight_carried_lbs' => 166,
                    'official_rating' => 103,
                    'official_rating_today' => null,
                    'jockey_uid' => 92270,
                    'jockey_name' => 'Charlie Deutsch',
                    'weight_allowance_lbs' => 0,
                    'trainer_uid' => 9746,
                    'trainer_stylename' => 'Venetia Williams',
                    'trainer_search_name' => 'Miss V Williams',
                    'trainer_ptp_type_code' => 'N',
                    'trainer_country_code' => 'GB',
                    'rp_postmark' => 107,
                    'rp_topspeed' => 95,
                    'unadjusted_rp_postmark' => 94,
                    'rp_owner_choice' => 'a',
                    'non_runner' => null,
                    'irish_reserve_yn' => 'N',
                    'allowance' => null,
                    'extra_weight' => null,
                    'horse_colour_code' => 'B',
                    'horse_sex_code' => 'G',
                    'sire_id' => 94325,
                    'sire_name' => 'Desert Style',
                    'sire_country' => 'IRE',
                    'first_season_sire_id' => null,
                    'dam_id' => 833014,
                    'dam_name' => 'Arieta',
                    'dam_country' => 'FR',
                    'damsire_id' => 63077,
                    'damsire_name' => 'Pistolet Bleu',
                    'damsire_country' => 'IRE',
                    'spotlight' => 'Probably needed the run after a long absence on British chase debut at Chepstow (2m3f, heavy) and built on that to be an 11l third of six over 1m7f at Southwell, where the drop in trip looked against him; 0-20 overall but a player.',
                    'diomed' => '1m7f too sharp a test when third at Southwell and is expected to find something on that.',
                    'figures' => null,
                    'figures_calculated' => null,
                    'new_trainer_races_count' => null,
                    'ten_to_follow_horse' => 833010,
                    'reasoning' => 'F',
                    'plus10_horse' => 'N',
                    'yearling_bonus_horse' => 'N',
                    'lh_weight_carried_lbs' => null,
                    'out_of_handicap' => null,
                    'beaten_favourite' => 'N',
                    'forecast_odds_value' => 2.25,
                    'forecast_odds_desc' => '9/4',
                    'course_and_distance_wins' => 0,
                    'course_wins' => 0,
                    'distance_wins' => 0,
                    'running_conditions' => null,
                    'selection_cnt' => null,
                    'date_gelded' => null,
                    'gelding_first_time' => 0,
                    'rp_postmark_improver' => 'N',
                    'wfa_adjustment' => null,
                    'owner_group_uid' => null,
                    'race_group_uid' => 6,
                    'early_closing_race_yn' => null,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                    'is_jockey_first_time' => 'N',
                    'official_rating_horse' => null,
                    'current_official_rating' => null,
                    'handicap_first_time' => 'N',
                    'going_winner' => 'Y',
                    'race_group_code' => 'H',
                    'horse_date_of_birth' => '2010-03-09 00:00:00',
                    'jockey_wins' => 0,
                    'jockey_runs' => 7,
                    'jockey_last_14_days' => null,
                ]
            ],
            //Models\Bo\RaceCards\Runners:508 ->createTmpTableHorseRaces()
            '22297cbc555068e433c7d569f676651c' => [
            ],
            //Models\Bo\RaceCards\Runners:466 ->getJockeyStatistics()
            'e2e83cc5a15e8979f024e9177276abe1' => [
                [
                    'jockey_uid' => 92270,
                    'jockey_runs' => 1,
                    'jockey_wins' => 1
                ]
            ],
            //Models\Bo\RaceCards\Runners:547 ->createTmpTableLastSurgery()
            'af64981bb085e581470168b9913a08b4' => [
            ],
            //Models\Bo\RaceCards\Runners:583 ->countRacesAfterSurgery()
            'ea07916079682d71a5734a314ac8c54f' => [
                [
                    'race_count' => 1,
                    'horse_uid' => 1266767,
                    'information_receipt_date' => '2017-04-19 15:35:00'
                ]
            ],
            //Models\Bo\RaceCards\Runners:630 ->dropTmpTable()
            'f268da9b3574e32b5a7f04bb65cb9fb7' => [
            ],
            //Models\Bo\RaceCards\Runners:630 ->dropTmpTable()
            'cd641fb1ce0c4e46718f19304c6edcfb' => [
            ],
            //Models\Bo\RaceCards\Runners:639 ->getWfaPerAges()
            '36ab0f955ebddbb25bbe5b7f84b50c24' => [
                [
                    'weight_allowance_lbs' => 41,
                    'age' => 2,
                    'distance_furlongs' => 5,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 10,
                    'age' => 3,
                    'distance_furlongs' => 5,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 11,
                    'age' => 3,
                    'distance_furlongs' => 6,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 13,
                    'age' => 3,
                    'distance_furlongs' => 7,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 14,
                    'age' => 3,
                    'distance_furlongs' => 8,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 15,
                    'age' => 3,
                    'distance_furlongs' => 9,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 17,
                    'age' => 3,
                    'distance_furlongs' => 10,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 19,
                    'age' => 3,
                    'distance_furlongs' => 11,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 20,
                    'age' => 3,
                    'distance_furlongs' => 12,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 21,
                    'age' => 3,
                    'distance_furlongs' => 13,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 22,
                    'age' => 3,
                    'distance_furlongs' => 14,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 1,
                    'age' => 4,
                    'distance_furlongs' => 14,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 23,
                    'age' => 3,
                    'distance_furlongs' => 15,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 1,
                    'age' => 4,
                    'distance_furlongs' => 15,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 24,
                    'age' => 3,
                    'distance_furlongs' => 16,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 2,
                    'age' => 4,
                    'distance_furlongs' => 16,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 26,
                    'age' => 3,
                    'distance_furlongs' => 18,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 2,
                    'age' => 4,
                    'distance_furlongs' => 18,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 28,
                    'age' => 3,
                    'distance_furlongs' => 20,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 3,
                    'age' => 4,
                    'distance_furlongs' => 20,
                    'race_type_code' => 'F'
                ],
                [
                    'weight_allowance_lbs' => 5,
                    'age' => 4,
                    'distance_furlongs' => 16,
                    'race_type_code' => 'H'
                ],
                [
                    'weight_allowance_lbs' => 6,
                    'age' => 4,
                    'distance_furlongs' => 20,
                    'race_type_code' => 'H'
                ],
                [
                    'weight_allowance_lbs' => 7,
                    'age' => 4,
                    'distance_furlongs' => 24,
                    'race_type_code' => 'H'
                ]
            ],
            //Models\Bo\RaceCards\Runners:696 ->getHorseYearlingAndPlus10()
            'fe2daf88c8349ce150da7dcc6aae1592' => [
                [
                    'horse_uid' => 832660,
                    'yearling_bonus_horse' => 1,
                    'plus10_horse' => 0
                ]
            ],
            //Models\Bo\RaceCards\Runners:736 ->getGoingWinner()
            '98e9b9de2ce7a13edab3e5501d4beb06' => [
                [
                    'horse_uid' => 832660,
                    'winner_count' => 1
                ]

            ],
            //Models\Bo\RaceCards\Runners:630 ->dropTmpTable()
            '9ee438da8697301551276b894669ab4c' => [
            ],
            //Models\Bo\RaceCards\Runners:772 ->getBeatenFavourites()
            'bc4f9c7b9af349b0ec78eee7a4403c62' => [
                [
                    'horse_uid' => 832660,
                ],
            ],
            //Models\Bo\RaceCards\Runners:772 ->getBeatenFavourites()
            '0f1431ac8c7ba0b366ffdfa3885f1141' => [
                [
                    'horse_uid' => 832660,
                ],
            ],
            //Models\Bo\RaceCards\Runners:713 ->getHorseForms()
            '5ba029e5a97a506c99b4cb79355fb428' => [
                [
                    'horse_uid' => 832660,
                    'distance_yard' => 4664,
                    'straight_round_jubilee_code' => null,
                    'track_code' => null,
                    'course_uid' => 18,
                    'race_type_code' => 'C',
                    'country_code' => 'GB ',
                ]
            ],
            //Models\Bo\RaceCards\Horse:600 ->getLongHandicapPerRaces()
            'a25f7cb1a3d8c90488ec616d1d302115' => [
            ],
            //Models\Bo\RaceCards\Runners:600 ->getGeldingFirstTimeRunners()
            '9ce1307dd21b316f5cbbea5f84b3a4a7' => [
            ],
            //Models\Bo\RaceCards\Runners:929 ->getPreviousTrainers()
            '9e0db574bb3ae762b186cdb61543647a' => [
                [
                    'horse_uid' => 832660,
                    'trainer_uid' => 5715,
                    'trainer_change_date' => '2017-10-24 00:00:00',
                    'trainer_search_name' => 'Anabel Murphy',
                    'trainer_ptp_type_code' => 'N',
                ],
                [
                    'horse_uid' => 833010,
                    'trainer_uid' => 5592,
                    'trainer_change_date' => '2016-01-06 13:52:00',
                    'trainer_search_name' => 'J De Balanda',
                    'trainer_ptp_type_code' => 'N',
                ]
            ],
            //Models\Bo\TrainerProfile\HorseRace:64 ->getRunningToForm()
            '292c87f20c7def067782c2eb6cb9bd93' => [
                [
                    'horse_uid' => 32154,
                    'trainer_uid' => 33553,
                    'race_instance_uid' => 699223,
                    'race_datetime' => '2018-05-10 17:15:00',
                    'race_outcome_position' => 1,
                    'race_outcome_form_char' => '1',
                    'rp_postmark' => 107,
                    'rp_pre_postmark' => 0,
                    'race_distance' => 3471,
                    'dist_to_winner' => 0.0,
                    'race_group_uid' => 0,
                    'runners' => 8,
                ],
                [
                    'horse_uid' => 32154,
                    'trainer_uid' => 33553,
                    'race_instance_uid' => 699243,
                    'race_datetime' => '2018-05-11 14:40:00',
                    'race_outcome_position' => 3,
                    'race_outcome_form_char' => '3',
                    'rp_postmark' => 97,
                    'rp_pre_postmark' => 101,
                    'race_distance' => 3668,
                    'dist_to_winner' => 0.75,
                    'race_group_uid' => 6,
                    'runners' => 12,
                ],
                [
                    'horse_uid' => 32154,
                    'trainer_uid' => 9746,
                    'race_instance_uid' => 699882,
                    'race_datetime' => '2018-05-17 14:00:00',
                    'race_outcome_position' => 1,
                    'race_outcome_form_char' => '1',
                    'rp_postmark' => 116,
                    'rp_pre_postmark' => 121,
                    'race_distance' => 3567,
                    'dist_to_winner' => 0.0,
                    'race_group_uid' => 0,
                    'runners' => 13,
                ]
            ],
            //Models\Season:128 ->getLastNumberSeasons()
            '93dbb00e470c58af71689d9787ab6f79' => [
                [
                    'season_start_date' => '2017-04-30 00:00:00',
                ],
                [
                    'season_start_date' => '2016-04-24 00:00:00',
                ],
                [
                    'season_start_date' => '2015-04-26 00:00:00',
                ],
                [
                    'season_start_date' => '2014-04-27 00:00:00',
                ],
                [
                    'season_start_date' => '2013-04-28 00:00:00',
                ],
            ],
            //Models\Season:128 ->getLastNumberSeasons()
            'aa608f44bcd7e3f63c0f12be861144b5' => [
                [
                    'season_start_date' => '2017-04-30 00:00:00',
                ],
                [
                    'season_start_date' => '2016-04-24 00:00:00',
                ],
                [
                    'season_start_date' => '2015-04-26 00:00:00',
                ],
                [
                    'season_start_date' => '2014-04-27 00:00:00',
                ],
                [
                    'season_start_date' => '2013-04-28 00:00:00',
                ],
            ],
            //Models\HorseRace:274 ->getHorsesForm()
            '0e6a7998228420fe6ae43a3dd94d8569' => [
                [
                    'horse_uid' => 832660,
                    'race_instance_uid' => 694598,
                    'race_datetime' => '2018-03-16 17:10:00',
                    'race_type_code' => 'C',
                    'race_outcome_position' => 2,
                    'race_outcome_form_char' => '2',
                ]
            ],
            //Models\Bo\RaceCards\Runners:660 ->getDaysSinceLastRun()
            '12a529d604280f1d92c236a9aaa0ec79' => [
                [
                    'horse_uid' => 832660,
                    'race_type_code' => 'ptp',
                    'days_since_run' => 1136,
                ],
                [
                    'horse_uid' => 832660,
                    'race_type_code' => 'jumps',
                    'days_since_run' => 0,
                ],
                [
                    'horse_uid' => 833010,
                    'race_type_code' => 'flat',
                    'days_since_run' => 1971,
                ],
                [
                    'horse_uid' => 833010,
                    'race_type_code' => 'jumps',
                    'days_since_run' => -12,
                ],
            ],
            //Models\Bo\RaceCards\RaceInstance:83 ->getRaceInstance()
            'bbaafaf81cfe555d3dae8f463d5a6e9d' => [
                [
                    'race_id' => 698857,
                    'race_type_code' => 'C',
                    'race_datetime' => '2018-04-10 14:40:00',
                    'race_status_code' => 'R',
                    'distance_yard' => 4594,
                    'race_group_code' => 'H',
                    'course_uid' => 24,
                    'rp_abbrev_3' => 'HER',
                    'country_code' => 'GB',
                    'course_name' => 'HEREFORD',
                    'course_style_name' => 'Hereford',
                    'going_type_code' => 'HY',
                    'going_type_desc' => 'Heavy',
                    'declared_runners' => 18,
                    'no_of_runners' => 18,
                    'rp_tv_text' => 'ATR',
                ],
                [
                    'race_id' => 698857,
                    'race_type_code' => 'C',
                    'race_datetime' => '2018-04-10 14:40:00',
                    'race_status_code' => 'R',
                    'distance_yard' => 4594,
                    'race_group_code' => 'H',
                    'course_uid' => 24,
                    'rp_abbrev_3' => 'HER',
                    'country_code' => 'GB',
                    'course_name' => 'HEREFORD',
                    'course_style_name' => 'Hereford',
                    'going_type_code' => 'HY',
                    'going_type_desc' => 'Heavy',
                    'declared_runners' => 18,
                    'no_of_runners' => 18,
                    'rp_tv_text' => 'ATR',
                ],
                [
                    'race_id' => 698857,
                    'race_type_code' => 'C',
                    'race_datetime' => '2018-04-10 14:40:00',
                    'race_status_code' => 'R',
                    'distance_yard' => 4594,
                    'race_group_code' => 'H',
                    'course_uid' => 24,
                    'rp_abbrev_3' => 'HER',
                    'country_code' => 'GB',
                    'course_name' => 'HEREFORD',
                    'course_style_name' => 'Hereford',
                    'going_type_code' => 'HY',
                    'going_type_desc' => 'Heavy',
                    'declared_runners' => null,
                    'no_of_runners' => null,
                    'rp_tv_text' => 'ATR',
                ],
                [
                    'race_id' => 698857,
                    'race_type_code' => 'C',
                    'race_datetime' => '2018-04-10 14:40:00',
                    'race_status_code' => 'R',
                    'distance_yard' => 4594,
                    'race_group_code' => 'H',
                    'course_uid' => 24,
                    'rp_abbrev_3' => 'HER',
                    'country_code' => 'GB',
                    'course_name' => 'HEREFORD',
                    'course_style_name' => 'Hereford',
                    'going_type_code' => 'HY',
                    'going_type_desc' => 'Heavy',
                    'declared_runners' => 5,
                    'no_of_runners' => 5,
                    'rp_tv_text' => 'ATR',
                ],
            ],
            //Models\Bo\RaceCards\RaceInstance:1469 ->getSelectionsCount()
            'f306e5b15af017a9d18a8b030c35239b' => [
                [
                    'horse_uid' => 833010,
                    'selection_count' => 1
                ],
                [
                    'horse_uid' => 832660,
                    'selection_count' => 1,
                ],
            ],
            //Models\Bo\RaceCards\RaceInstance:4024 ->getRaceAdditionalData()
            '33ac76ea06e4aa59f98a3ab0fb917356' => [
                [
                    'race_status_code' => 'O',
                ],
            ],
            //Models\Bo\RaceCards\RaceInstance:4119 ->getRaceAdditionalData()
            'a17f14da27c561909d7361034aec20fe' => [
                [
                    'race_instance_uid' => 698857,
                    'distance_yard' => 4594,
                    'race_datetime' => '2018-04-10 14:40:00',
                    'race_type_code' => 'C',
                    'race_group_code' => 'H',
                    'country_code' => 'GB ',
                    'min_weight' => 140,
                    'race_status_code' => 'R',
                    'weight_adjustment' => 168,
                    'min_age' => 7,
                    'max_age' => 9,
                    'top_age' => 0,
                    'furlong' => 20.0,
                ],
            ],
            //Models\Bo\RaceCards\Runners:835 ->getHorseForms()
            'a20861ae875e30b3783a53543f4bf5e6' => [
            ],
            //Models\Bo\RaceCards\Runners:835 ->fetchImproverData()
            'f88f8bf8942cd295108eac442de96334' => [
                [
                    'horse_uid' => 832660,
                    'date_diff' => 68,
                    'race_type_code' => 'C',
                    'rp_postmark' => 109,
                ]
            ],
            //Models\Bo\RaceCards\Runners:890 ->getGoingPerformance()
            'ad74766f8b3ba2b324e81914a519d51e' => [
                [
                    'horse_uid' => 832660,
                    'slow_ground_flat_wins' => 0,
                    'slow_ground_jumps_wins' => 1,
                    'fast_ground_wins' => 0,
                ],
                [
                    'horse_uid' => 833010,
                    'slow_ground_flat_wins' => 0,
                    'slow_ground_jumps_wins' => 1,
                    'fast_ground_wins' => 0,
                ]
            ],
            //Models\Bo\RaceCards\Runners:920 ->getHorseOwnerGroups()
            'c397672edac6a8c94c919ae1b037daec' => [
            ],
            //Models\Bo\RaceCards\Runners:529 ->getFirstSeasonSire()
            'a5b256f18dc2f093e1bc989db46de68f' => [
            ],

            //provider/DataProvider/Bo/Rpr.php -> getRprStatistics()
            '0d32a1ce29cacf3e6924ba0e8722b204' => [

            ],
            //models/Bo/RaceCards/RaceInstance.php:3953 -> getHorsesTopspeed()
            '021e307f401533867ecb305b02cb3a44' => [

            ]
        ];
    }
}
