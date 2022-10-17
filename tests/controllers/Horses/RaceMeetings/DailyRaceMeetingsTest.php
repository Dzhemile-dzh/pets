<?php
namespace Controllers\Horses\RaceMeetings;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

class DailyRaceMeetingsTest extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/race-meetings/2019-04-15';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\RaceMeetings\DailyRaceMeetings:259 ->createTmpTableMain()
            'aa405dfc71d9ca7975b86050c37e423e' => [],
            //Api\DataProvider\Bo\RaceMeetings\DailyRaceMeetings:308 ->createTmpTableSurface()
            '64e58cc577603b0d237f6485a13488ea' => [],
            //Api\DataProvider\Bo\RaceMeetings\DailyRaceMeetings:23 ->getDailyMeetings()
            '7642667ad1a09483b3cb4b181ae110bf' => [
                [
                    'course_uid' => 5412,
                    'meeting_date' => '2019-04-15',
                    'meeting_abandoned' => 'N',
                    'formbook_yn' => 'Y',
                    'race_group_uid' => 1,
                    'race_class' => null,
                    'course_type_code' => 'J',
                    'aw_surface_type' => null,
                    'cards_order' => null,
                    'complete_card' => null,
                    'country_code' => 'GB',
                    'course_name' => 'PONTEFRACT',
                    'course_style_name' => 'Pontefract',
                    'course_region' => 'GB & IRE',
                    'course_teaser_suffix' => null,
                    'rails' => ' ',
                    'rp_abbrev_3' => 'PON',
                    'rp_meeting_order' => null,
                    'stalls_position' => '5f & 6f - Centre; Round course - Inside',
                    'digital_colour' => 3,
                    'straight_round_jubilee_code' => null,
                    'digital_order' => null,
                    'early_complete_card' => null,
                    'has_finished_race' => 0,
                    'meeting_number' => 0,
                    'mixed_course_uid' => null,
                    'pre_going_desc' => 'Good',
                    'going_desc' => 'Good',
                    'weight_adjustment' => 6,
                    'pre_weather_desc' => null,
                    'race_instance_uid' => 728040,
                    'min_weight' => null,
                    'count_runners' => null,
                    'race_country_code' => 'IND',
                    'declared_runners' => 8,
                    'distance_yard' => 1540,
                    'duplicate_race' => null,
                    'early_closing_race_yn' => 'Y',
                    'race_status_code' => '0',
                    'no_of_runners' => 12,
                    'fast_result' => 0,
                    'free_to_air' => false,
                    'hours_difference' => 3,
                    'race_datetime' => '2018-04-19 15:35:00',
                    'official_rating_band_desc' => null,
                    'perform_race_uid_atr' => null,
                    'perform_race_uid_ruk' => null,
                    'race_attrib_desc' => 'Te',
                    'race_attrib_code' => 'Class',
                    'race_group_code' => 5,
                    'race_instance_title' => 'Sims Park Cup (Handicap) (4yo+) (Turf)',
                    'race_selection_type' => null,
                    'race_type_code' => 'F',
                    'race_rp_abbrev' => 'Oot',
                    'rp_ages_allowed_desc' => '3yo+',
                    'rp_confirmed' => 0,
                    'rp_tv_text' => 'ASdfasd asdfag asdf',
                    'scoop6_race' => false,
                    'verdict' => 'ASdgasdfa gads faga fd sdaf asdf ',
                    'straight_round_jubilee_code_race' => 'F',
                    'prize' => 1234000,
                    'race_group_desc' => 'F',
                    'race_runners' => null,
                    'pool_prize_sterling' => 12007.30
                ]
            ],
            //models/RaceInstance.php:2188 ->deleteTable()
            'd7441638c610581ebcce632e72dfe275' => [
            ],
            //models/RaceInstance.php:2188 ->deleteTable()
            '1a6bdb834ccaee2028ed55da7f36eb76' => [
            ],
            //Models\Bo\RaceCards\Runners:275 ->createTmpTableMain()
            'c62d80d6e0d092a570013e1c07c04755' => [
            ],
            //Models\Bo\RaceCards\Runners:37 ->getRunners()
            '71cbc348099584b9d04f196109755aab' => [
                [
                    'saddle_cloth_no' => 1,
                    'draw' => 2,
                    'race_type_code' => 'F',
                    'race_status_code' => 'R',
                    'distance_yard' => 1760,
                    'star_rating' => 5,
                    'track_code' => null,
                    'course_uid' => 5412,
                    'course_country_code' => 'GB ',
                    'straight_round_jubilee_code' => 'W',
                    'owner_uid' => 252497,
                    'owner_name' => 'HH Sheikha Al Jalila Racing',
                    'eliminator_no' => 0,
                    'horse_uid' => 1266767,
                    'horse_name' => 'Glorious Journey',
                    'country_origin_code' => 'GB',
                    'race_instance_uid' => 728040,
                    'race_datetime' => '2018-04-19 15:35:00',
                    'rp_horse_head_gear_code' => 'p',
                    'first_time_yn' => 'Y',
                    'extra_weight_lbs' => 0,
                    'horse_age' => 3,
                    'weight_carried_lbs' => 126,
                    'official_rating' => null,
                    'official_rating_today' => null,
                    'jockey_uid' => 6901,
                    'jockey_name' => 'James Doyle',
                    'weight_allowance_lbs' => 0,
                    'trainer_uid' => 28338,
                    'trainer_stylename' => 'Charlie Appleby',
                    'trainer_search_name' => 'C Appleby',
                    'trainer_ptp_type_code' => 'N',
                    'trainer_country_code' => 'GB',
                    'rp_postmark' => 122,
                    'rp_topspeed' => 98,
                    'unadjusted_rp_postmark' => 103,
                    'num_topspeed_best_rating' => 98,
                    'rp_owner_choice' => 'a',
                    'non_runner' => null,
                    'irish_reserve_yn' => 'N',
                    'allowance' => null,
                    'extra_weight' => null,
                    'horse_colour_code' => 'B',
                    'horse_sex_code' => 'C',
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
                    'longSpotlight' => 'Very well bred colt who won a 6f maiden on the July course on debut last June before making all to take 7f Group 3 at Saint-Cloud in September in only other start; needs another step up form-wise but has done all that\'s been asked of him so far and is totally unexposed; cheekpieces on now.',
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
                    'forecast_odds_desc' => '9/2',
                    'course_and_distance_wins' => 0,
                    'course_wins' => 0,
                    'distance_wins' => 0,
                    'running_conditions' => null,
                    'date_gelded' => null,
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
                    'race_group_code' => '3',
                    'selection_cnt' => 0,
                    'horse_date_of_birth' => '2015-02-09 00:00:00',
                    'jockey_last_14_days' => null,
                ],
                [
                    'saddle_cloth_no' => 2,
                    'selection_cnt' => 0,
                    'draw' => 1,
                    'race_type_code' => 'F',
                    'race_status_code' => 'R',
                    'distance_yard' => 1760,
                    'track_code' => null,
                    'course_uid' => 5412,
                    'star_rating' => 5,
                    'course_country_code' => 'GB ',
                    'straight_round_jubilee_code' => 'W',
                    'owner_uid' => 164283,
                    'owner_name' => 'P Makin',
                    'eliminator_no' => 0,
                    'horse_uid' => 1495055,
                    'horse_name' => 'Just Brilliant',
                    'country_origin_code' => 'IRE',
                    'race_instance_uid' => 728040,
                    'race_datetime' => '2018-04-19 15:35:00',
                    'rp_horse_head_gear_code' => null,
                    'first_time_yn' => null,
                    'extra_weight_lbs' => 0,
                    'horse_age' => 3,
                    'weight_carried_lbs' => 126,
                    'official_rating' => null,
                    'official_rating_today' => null,
                    'jockey_uid' => 13689,
                    'jockey_name' => 'Jamie Spencer',
                    'weight_allowance_lbs' => 0,
                    'trainer_uid' => 5333,
                    'trainer_stylename' => 'Peter Chapple-Hyam',
                    'trainer_search_name' => 'P Chapple-Hyam',
                    'trainer_ptp_type_code' => 'N',
                    'trainer_country_code' => 'GB',
                    'rp_postmark' => 98,
                    'rp_topspeed' => 75,
                    'unadjusted_rp_postmark' => 102,
                    'num_topspeed_best_rating' => 98,
                    'rp_owner_choice' => 'a',
                    'non_runner' => null,
                    'irish_reserve_yn' => 'N',
                    'allowance' => null,
                    'extra_weight' => null,
                    'horse_colour_code' => 'B',
                    'horse_sex_code' => 'C',
                    'sire_id' => 740981,
                    'sire_name' => 'Lope De Vega',
                    'sire_country' => 'IRE',
                    'first_season_sire_id' => null,
                    'dam_id' => 683509,
                    'dam_name' => 'Mauresmo',
                    'dam_country' => 'IRE',
                    'damsire_id' => 60857,
                    'damsire_name' => 'Marju',
                    'damsire_country' => 'IRE',
                    'longSpotlight' => '150,000gns yearling; half-brother to the yard\'s Racing Post Trophy winner Marcel; promising start when making all to take C&D novice last October but in much deeper on just his second start now.',
                    'diomed' => 'Promising start when making all to take C&D novice last October but in much deeper',
                    'figures' => null,
                    'figures_calculated' => null,
                    'new_trainer_races_count' => null,
                    'ten_to_follow_horse' => null,
                    'reasoning' => null,
                    'plus10_horse' => 'N',
                    'yearling_bonus_horse' => 'N',
                    'lh_weight_carried_lbs' => null,
                    'out_of_handicap' => null,
                    'beaten_favourite' => 'N',
                    'forecast_odds_value' => 20.0,
                    'forecast_odds_desc' => '20/1',
                    'course_and_distance_wins' => 0,
                    'course_wins' => 0,
                    'distance_wins' => 0,
                    'running_conditions' => null,
                    'date_gelded' => null,
                    'gelding_first_time' => 0,
                    'rp_postmark_improver' => 'N',
                    'wfa_adjustment' => null,
                    'owner_group_uid' => null,
                    'race_group_uid' => 3,
                    'early_closing_race_yn' => null,
                    'is_wind_surgery_first_time' => 'N',
                    'is_wind_surgery_second_time' => 'N',
                    'is_jockey_first_time' => 'Y',
                    'official_rating_horse' => null,
                    'handicap_first_time' => 'N',
                    'race_group_code' => '3',
                    'horse_date_of_birth' => '2015-02-27 00:00:00',
                    'jockey_last_14_days' => null,
                ]
            ],
            //Models\Bo\RaceCards\Runners:508 ->createTmpTableHorseRaces()
            '22297cbc555068e433c7d569f676651c' => [
            ],
            //Models\Bo\RaceCards\Runners:466 ->getJockeyStatistics()
            '9de1767a21585af2f1962cd88d4651f8' => [
                [
                    'jockey_uid' => 13689,
                    'jockey_runs' => 1,
                    'jockey_wins' => 1
                ]
            ],
            //Models\Bo\RaceCards\Runners:547 ->createTmpTableLastSurgery()
            '4cc21cc9dcdecfc727101cb8d4e79662' => [
            ],
            //Models\Bo\RaceCards\Runners:583 ->countRacesAfterSurgery()
            'ea07916079682d71a5734a314ac8c54f' => [
                [
                    'race_count' => 1,
                    'horse_uid' => 1266767,
                    'information_receipt_date' => '2017-04-19 15:35:00'
                ]
            ],

            //Models\Bo\RaceCards\Runners:551 ->createTmpTableLastSurgery
            'af64981bb085e581470168b9913a08b4' => [
            ],

            //Models\Bo\RaceCards\Runners:630 ->dropTmpTable()
            'f268da9b3574e32b5a7f04bb65cb9fb7' => [
            ],
            //Models\Bo\RaceCards\Runners:639 ->getWfaPerAges()
            '4bc28248010149ea5280b72a8f230399' => [
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
                    'horse_uid' => 1266767,
                    'yearling_bonus_horse' => 1,
                    'plus10_horse' => 0
                ]
            ],
            //Models\Bo\RaceCards\Runners:736 ->getGoingWinner()
            '98e9b9de2ce7a13edab3e5501d4beb06' => [
                [
                    'horse_uid' => 1266767,
                    'winner_count' => 1
                ]

            ],
            //Models\Bo\RaceCards\Runners:630 ->dropTmpTable()
            '9ee438da8697301551276b894669ab4c' => [
            ],
            //Models\Bo\RaceCards\Runners:630 ->dropTmpTable()
            'cd641fb1ce0c4e46718f19304c6edcfb' => [
            ],
            //Models\Bo\RaceCards\Runners:772 ->getBeatenFavourites()
            '77ccd6f348cc5ef1c14c598db4c6eb07' => [
            ],
            //Models\Bo\RaceCards\Runners:772 ->getBeatenFavourites()
            '3bee5d1869fcf9e1b19fe1824b671397' => [
            ],
            //Models\Bo\RaceCards\Runners:713 ->getHorseForms()
            '01b75ad148330cef6dfbeccd561f49a4' => [
                [
                    'horse_uid' => 1266767,
                    'distance_yard' => 1320,
                    'straight_round_jubilee_code' => 'Y',
                    'track_code' => null,
                    'course_uid' => 5412,
                    'race_type_code' => 'F',
                    'country_code' => 'GB ',
                ],
                [
                    'horse_uid' => 1266767,
                    'distance_yard' => 1540,
                    'straight_round_jubilee_code' => null,
                    'track_code' => null,
                    'course_uid' => 5412,
                    'race_type_code' => 'F',
                    'country_code' => 'FR ',
                ],
                [
                    'horse_uid' => 1495055,
                    'distance_yard' => 1760,
                    'straight_round_jubilee_code' => 'W',
                    'track_code' => null,
                    'course_uid' => 5412,
                    'race_type_code' => 'F',
                    'country_code' => 'GB ',
                ]
            ],
            //Models\Bo\RaceCards\Runners:600 ->getGeldingFirstTimeRunners()
            '174df170cfb0f386d13dc97dea86cbb6' => [
            ],
            //Models\Bo\RaceCards\Runners:929 ->getPreviousTrainers()
            'a28f266feccc5a42a37a66d64752b519' => [
            ],
            //Models\Bo\TrainerProfile\HorseRace:64 ->getRunningToForm()
            'b84e28f1cb31c9361e8dcd9c59ab09ca' => [
                [
                    'horse_uid' => 32154,
                    'trainer_uid' => 15234,
                    'race_instance_uid' => 728040,
                    'race_datetime' => '2018-05-10 16:15:00',
                    'race_outcome_position' => 1,
                    'race_outcome_form_char' => '1',
                    'rp_postmark' => 129,
                    'rp_pre_postmark' => 122,
                    'race_distance' => 4317,
                    'dist_to_winner' => 0.0,
                    'race_group_uid' => 6,
                    'runners' => 14,
                ],
                [
                    'horse_uid' => 32154,
                    'trainer_uid' => 152345,
                    'race_instance_uid' => 728040,
                    'race_datetime' => '2018-05-14 18:30:00',
                    'race_outcome_position' => 6,
                    'race_outcome_form_char' => '6',
                    'rp_postmark' => 88,
                    'rp_pre_postmark' => 112,
                    'race_distance' => 3451,
                    'dist_to_winner' => 28.25,
                    'race_group_uid' => 6,
                    'runners' => 6,
                ],
            ],
            //Models\Bo\RaceCards\Runners:1112 ->getBeatenFavourites()
            '15ef27d0ce37f539976dd01e96f406ef' => [
                [
                    'horse_uid' => 1495055
                ]
            ],
            //Models\Bo\RaceCards\Horse:1112 ->getLongHandicapPerRaces()
            '1ec8c5418a9f513a38033850c91cbbc3' => [
            ],
            //Models\Bo\RaceCards\Runners:600 ->getGeldingFirstTimeRunners()
            '899298754c51be3044e47b3d65e4d69d' => [
            ],
            //Models\Bo\TrainerProfile\HorseRace:64 ->getRunningToForm()
            'e1635968c8148d1e1806f0bc092d79c6' => [
                [
                    'trainer_uid' => 15232,
                    'race_instance_uid' => 728040,
                    'race_datetime' => '2018-05-10 18:10:00',
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
                    'trainer_uid' => 152387,
                    'race_instance_uid' => 728040,
                    'race_datetime' => '2018-05-10 20:40:00',
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
            //Models\Season:128 ->getLastNumberSeasons()
            '311caac5fe55878dd12152cc7c6499a9' => [
                [
                    'season_start_date' => '2018-01-01 00:00:00',
                ],
                [
                    'season_start_date' => '2017-01-01 00:00:00',
                ],
                [
                    'season_start_date' => '2016-01-01 00:00:00',
                ],
                [
                    'season_start_date' => '2015-01-01 00:00:00',
                ],
                [
                    'season_start_date' => '2014-01-01 00:00:00',
                ],
            ],
            //Models\HorseRace:274 ->getHorsesForm()
            'f8d060760e91eae578f9437ae7b7dd6e' => [
                [
                    'horse_uid' => 1495055,
                    'race_instance_uid' => 728040,
                    'race_datetime' => '2017-10-07 15:15:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => 1,
                    'race_outcome_form_char' => '1',
                ],
                [
                    'horse_uid' => 1266767,
                    'race_instance_uid' => 728040,
                    'race_datetime' => '2017-09-08 13:10:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => 1,
                    'race_outcome_form_char' => '1',
                ],
                [
                    'horse_uid' => 1266767,
                    'race_instance_uid' => 728040,
                    'race_datetime' => '2017-06-10 13:25:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => 1,
                    'race_outcome_form_char' => '1',
                ]
            ],
            //Models\Bo\RaceCards\Runners:660 ->getDaysSinceLastRun()
            '4cf74124ae44746d0743048e040a1192' => [
                [
                    'horse_uid' => 1266767,
                    'race_type_code' => 'flat',
                    'days_since_run' => -18,
                ],
                [
                    'horse_uid' => 1495055,
                    'race_type_code' => 'flat',
                    'days_since_run' => 0,
                ]
            ],
            //Models\Bo\RaceCards\RaceInstance:83 ->getRaceInstance()
            'beb59e1910d3c89b96d8423f44b0dd0c' => [
                [
                    'race_id' => 697411,
                    'race_type_code' => 'F',
                    'race_datetime' => '2018-04-19 15:35:00',
                    'race_status_code' => 'R',
                    'distance_yard' => 1760,
                    'race_group_code' => '3',
                    'course_uid' => 5412,
                    'rp_abbrev_3' => 'NMK',
                    'country_code' => 'GB',
                    'course_name' => 'NEWMARKET',
                    'course_style_name' => 'Newmarket',
                    'course_region' => 'GB & IRE',
                    'going_type_code' => 'G ',
                    'going_type_desc' => 'Good',
                    'declared_runners' => 10,
                    'no_of_runners' => 10,
                    'rp_tv_text' => 'ITV4',
                ]
            ],
            //Models\Bo\RaceCards\RaceInstance:4024 ->getRaceAdditionalData()
            '896df11de68c091de007cc3c4677828c' => [
                [
                    'race_status_code' => 'O',
                ],
            ],
            //Models\Bo\RaceCards\RaceInstance:4119 ->getRaceAdditionalData()
            '0add947ebb3f2e62a37ce42eb31809f2' => [
                [
                    'race_instance_uid' => 728040,
                    'distance_yard' => 1760,
                    'race_datetime' => '2018-04-19 15:35:00',
                    'race_type_code' => 'F',
                    'race_group_code' => '3',
                    'country_code' => 'GB ',
                    'min_weight' => null,
                    'race_status_code' => 'R',
                    'weight_adjustment' => 140,
                    'min_age' => 3,
                    'max_age' => 3,
                    'top_age' => 0,
                    'furlong' => 8.0,
                ],
            ],
            //Models\Bo\RaceCards\Runners:835 ->fetchImproverData()
            '2deb93451577d82e84b804357a3a637f' => [
                [
                    'horse_uid' => 1266767,
                    'date_diff' => 257,
                    'race_type_code' => 'F',
                    'rp_postmark' => 108,
                ],
                [
                    'horse_uid' => 1266767,
                    'date_diff' => 347,
                    'race_type_code' => 'F',
                    'rp_postmark' => 82,
                ],
                [
                    'horse_uid' => 1495055,
                    'date_diff' => 228,
                    'race_type_code' => 'F',
                    'rp_postmark' => 78,
                ],
            ],
            //Models\Bo\RaceCards\Runners:890 ->getGoingPerformance()
            '2230066e96ac22c0fd78783aa37d102a' => [
                [
                    'horse_uid' => 1266767,
                    'slow_ground_flat_wins' => 0,
                    'slow_ground_jumps_wins' => 0,
                    'fast_ground_wins' => 0,
                ],
                [
                    'horse_uid' => 1495055,
                    'slow_ground_flat_wins' => 0,
                    'slow_ground_jumps_wins' => 0,
                    'fast_ground_wins' => 0,
                ]
            ],
            //Models\Bo\RaceCards\Runners:560 ->getHorseOwnerGroups()
            'd3b21a80f301f2e273af9201a15b8437' => [
                [
                    'horse_uid' => 1266767,
                    'owner_group_uid' => 5,
                ],
                [
                    'horse_uid' => 1266767,
                    'owner_group_uid' => 31,
                ]
            ],
            //Models\Bo\RaceCards\Runners:529 ->getFirstSeasonSire()
            '1a07c5545d2ab6c57b680143d85e654c' => [
                [
                    'horse_uid' => 1266767,
                    'to_follow_uid' => 79
                ],
                [
                    'horse_uid' => 1266767,
                    'to_follow_uid' => 79
                ],
                [
                    'horse_uid' => 1495055,
                    'to_follow_uid' => 79
                ]
            ],

            //Models\Bo\RaceCards\Runners:1330 ->getSelectionsCount()
            'b01583144ae9f902fa1132b5dfa31ca8' => [
                [
                    'selection_count' => 12,
                    'horse_uid' => 1495055
                ]
            ],

            //Models\Bo\RaceCards\RaceInstance:4040 ->getRaceAdditionalData()
            '14cf67234c637a7005200d1ac5bc8026' => [
                [
                    'race_status_code' => 'R'
                ]
            ],

            //Models\Bo\RaceCards\RaceInstance:4080 ->getRaceAdditionalData()
            'c334ba55be405794c56e67f7fa42abec' => [
                [
                    'race_instance_uid' => 728040,
                    'distance_yard' => '',
                    'race_datetime' => '2018-04-19 15:35:00',
                    'race_type_code' => 'X',
                    'race_group_code' => '',
                    'country_code' => '',
                    'min_weight' => '',
                    'race_status_code' => 'R',
                    'weight_adjustment' => '',
                    'min_age' => '',
                    'max_age' => '',
                    'top_age' => '',
                    'furlong' => ''
                ]
            ],

            // Api\DataProvider\Bo\Rpr:113 ->createTemporaryTable()
            'c5571e846cfbe225bbde5dd0d88ab14e' => [
            ],

            //Models\Bo\RaceCards\Runners:630 ->dropTmpTable()
            '859d4384cb3226e1fd8fe6414851a34a' => [
            ],

            //Api\DataProvider\Bo\Rpr:156 ->calculateRpr
            '0018545e2686a264d78fa0257522b845' => [
                [
                    'horse_uid' => 1495055,
                    'current_official_turf_rating' => 5,
                    'current_official_aw_rating' => 3,
                    'rpr_trainer_rt' => 15,
                    'rpr_trainer' => 3,
                    'rpr_last_5_runs_200' => 15,
                    'rpr_last_6_runs_200' => 5,
                    'rpr_last_10_runs_400_same_rt' => 3,
                    'rpr_last_10_runs_400' => 3,
                    'rpr_max_400' => 6
                ]
            ],

            //Models\Bo\RaceCards\RaceInstance:3774 ->getHorsesAttributes
            '659b411e903f0585400173d0d2d38955' => [
            ],

            //Models\Bo\RaceCards\RaceInstance:3805 ->getHorsesAttributes
            'be280b0d588fc94c288ae6c4d6b8fe02' => [
                [
                    'age' => 5
                ]
            ],

            //Models\Bo\RaceCards\RaceInstance:3857 ->getHorsesAttributes
            '8a0a8eb31ebc50fde894c966b0e71ad6' => [
                [
                    'horse_uid' => '',
                    'weight_carried_lbs' => '',
                    'age' => '',
                    'rp_postmark' => 0,
                    'rp_topspeed' => 0,
                    'wfage' => 3,
                    'adjusted_age' => 5,
                    'force_deduct_wfa' => 1,
                    'wfa_control_flag' => 2,
                    'wfa_flat' => 45
                ]
            ],

            //Models\Bo\RaceCards\Runners:630 ->dropTmpTable()
            '40f233f668a22f2d18077b1571c1d1ca' => [
            ],

            //\Models\Bo\RaceCards\Runners:1171 ->fetchImproverData
            'af8d95768fb9d051c9cb9a437d2e099f' => [
                [
                    'horse_uid' => 62135,
                    'date_diff' => 3,
                    'race_type_code' => 'X',
                    'rp_postmark' => 5
                ]
            ],

            //\Models\Bo\RaceCards\Runners:825 ->getHorseOwnerGroups
            '57f159b661b66c1156bcdbf7a816f1c0' => [
                [
                    'horse_uid' => 61234,
                    'owner_group_uid' => 3211
                ]
            ],

            //\Models\Bo\RaceCards\RaceInstance:2593 ->checkFastResults
            'c76cb382f0cc2e634f93de11b6447950' => [
                [
                    'race_instance_uid' => 728040,
                    'fast_race_instance_uid' => 728040
                ]
            ],

            //\Api\DataProvider\Bo\RaceMeetings\DailyRaceMeetings:241 ->getNoOfRunnersPerRace
            'd8663a5560e141e2d425662e5b5e7041' => [
                [
                    'race_instance_uid' => 728040,
                    'runners_count' => 5,
                    'no_of_runners' => 12
                ]
            ],

            //\Api\DataProvider\Bo\RaceMeetings\DailyRaceMeetings:282 ->getPerformRace
            'bd8e4e23f4a8ee0db7ed45d954664ece' => [
                [
                    'max_performance' => 5,
                    'race_instance_uid' => 728040,
                    'atr' => 2
                ]
            ],

            //\Api\DataProvider\Bo\RaceMeetings\DailyRaceMeetings:282 ->getRacesAttributes
            '86fd763295366af400c596404111c436' => [

            ],
            //Models\Bo\RaceCards\Runners:630 ->dropTmpTable()
            'aed69d4a13835058c6f56e98799c726b' => [

            ],

            //provider/DataProvider/Bo/Rpr.php -> getRprStatistics()
            '2f6eedfc077b52c30ef80f84e266ccd2' => [

            ],
            //models/Bo/RaceCards/RaceInstance.php:3953 -> getHorsesTopspeed()
            'a87abb658d796b3606931da086842476' => [

            ]
        ];
    }
}
