<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Native\Cards\Form;

use UnitTestsComponents\ApiRouteTest\Xml as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Native\Cards\Predictor\Race
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/native/cards/703330/form';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Native\Cards\FullCard\Data:88 ->getRace()
            '88be622f5a53420567ac62e15f348671' => [
                [
                    'race_instance_uid' => 703330,
                    'race_datetime' => '2018-06-19 15:05:00',
                    'race_status_code' => 'R',
                    'race_instance_title' => 'Coventry Stakes (Group 2)',
                    'bookmaker' => 'William Hill',
                    'rp_ages_allowed_desc' => '2yo',
                    'race_class' => '1',
                    'distance_yard' => 1320,
                    'rp_tv_text' => 'ITV',
                    'perform_race'=>false,
                    'going_type_desc' => 'Good To Firm',
                    'course_uid' => 2,
                    'course_name' => 'ASCOT',
                    'course_style_name' => 'Ascot',
                    'country_code' => 'GB',
                    'race_type_code' => 'F',
                    'race_type_desc' => 'Flat Turf',
                    'race_group_desc' => 'Group 2',
                    'going_type_code' => 'GF',
                    'race_group_code' => '2',
                ],
            ],
            //Api\DataProvider\Bo\Native\Cards\FullCard\Data:287 ->getPrizes()
            '7a642129188d4b5beef5eaa813783164' => [
                [
                    'position_no' => 1,
                    'position_template' => 'prizePos%d',
                    'prize_template' => '%.2f',
                    'prize_sterling' => 85065.0,
                    'prize_euro' => null,
                ],
            ],
            //Api\DataProvider\Bo\Native\Cards\FullCard\Data:126 ->getBetOffers()
            'aedce4545f19a6f3c84c39c3ade85567' => [
                [
                    'synopsis' => ' ',
                    'story' => ' ',
                    'race_attrib_uid' => 449,
                ],
            ],
            //Api\DataProvider\Bo\Native\Cards\FullCard\Data:256 ->getRunners()
            'b053a0ff04154443dabe9545cb3a7d2d' => [
                [
                    'saddle_cloth_no' => 1,
                    'draw' => 1,
                    'owner_uid' => 264106,
                    'horse_uid' => 1969796,
                    'race_type_code' => 'F',
                    'race_datetime' => '2018-06-19 15:05:00',
                    'course_uid' => 2,
                    'distance_yard' => 1320,
                    'race_instance_uid' => 703330,
                    'course_country_code' => 'GB ',
                    'track_code' => null,
                    'straight_round_jubilee_code' => null,
                    'race_group_uid' => 2,
                    'horse_name' => 'Advertise',
                    'country_origin_code' => 'GB',
                    'rp_horse_head_gear_code' => null,
                    'horse_age' => 2,
                    'weight_carried_lbs' => 127,
                    'official_rating' => null,
                    'jockey_uid' => 92728,
                    'jockey_name' => 'Oisin Murphy',
                    'trainer_uid' => 4528,
                    'trainer_stylename' => 'Martyn Meade',
                    'rp_topspeed' => 81,
                    'rp_postmark' => 104,
                    'num_topspeed_best_rating' => 104,
                    'rp_owner_choice' => 'a',
                    'non_runner' => null,
                    'doubtful_runner' => null,
                    'irb_flat_form_string' => null,
                    'irish_reserve_yn' => 'N',
                    'allowance' => null,
                    'horse_sex_code' => 'C',
                    'horse_sex_desc' => 'colt',
                    'spotlight' => 'Beat a few of today\'s rivals in Newbury maiden (6f, good to firm) on debut, running on to lead well inside the final furlong; one of several once-raced winners who are open to any amount of improvement.',
                    'diomed' => 'Beat a few of today\'s rivals in Newbury maiden on debut; open to progress',
                    'figures' => null,
                    'figures_calculated' => null,
                    'beaten_favourite' => 'N',
                    'course_and_distance_wins' => 0,
                    'course_wins' => 0,
                    'distance_wins' => 0,
                    'tips_qty' => 2,
                    'days_since_last_run' => null

                ],
                [
                    'saddle_cloth_no' => 1,
                    'draw' => 1,
                    'owner_uid' => 264106,
                    'horse_uid' => 1234567,
                    'race_type_code' => 'F',
                    'race_datetime' => '2018-06-19 15:05:00',
                    'course_uid' => 2,
                    'race_instance_uid' => 703330,
                    'distance_yard' => 1320,
                    'course_country_code' => 'GB ',
                    'track_code' => null,
                    'straight_round_jubilee_code' => null,
                    'race_group_uid' => 2,
                    'horse_name' => 'Advertise',
                    'country_origin_code' => 'GB',
                    'rp_horse_head_gear_code' => null,
                    'horse_age' => 2,
                    'weight_carried_lbs' => 127,
                    'official_rating' => null,
                    'jockey_uid' => 92728,
                    'jockey_name' => 'Oisin Murphy',
                    'trainer_uid' => 4528,
                    'trainer_stylename' => 'Martyn Meade',
                    'rp_topspeed' => 81,
                    'num_topspeed_best_rating' => 104,
                    // we expect this null to be converted to mdash
                    'rp_postmark' => null,
                    'rp_owner_choice' => 'a',
                    'non_runner' => null,
                    'doubtful_runner' => null,
                    'irb_flat_form_string' => '123456789',
                    'irish_reserve_yn' => 'N',
                    'allowance' => null,
                    'horse_sex_code' => 'C',
                    'horse_sex_desc' => 'colt',
                    'spotlight' => 'Beat a few of today\'s rivals in Newbury maiden (6f, good to firm) on debut, running on to lead well inside the final furlong; one of several once-raced winners who are open to any amount of improvement.',
                    'diomed' => 'Beat a few of today\'s rivals in Newbury maiden on debut; open to progress',
                    'figures' => null,
                    'figures_calculated' => null,
                    'beaten_favourite' => 'N',
                    'course_and_distance_wins' => 0,
                    'course_wins' => 0,
                    'distance_wins' => 0,
                    'tips_qty' => 2,
                    'days_since_last_run' => null
                ],
            ],
            //Models\Bo\RaceCards\Runners:772 ->getBeatenFavourites()
            '6a556fd27db340b14c9707cf83023f63' => [
            ],
            //Models\Bo\RaceCards\Runners:772 ->getBeatenFavourites()
            '06a42ce549b9ac56263e5bf3b4b7cd2d' => [
            ],
            //Models\Bo\RaceCards\Runners:713 ->getHorseForms()
            '6fa15a27d37dfec81331138409c4c1e6' => [
                [
                    'horse_uid' => 1969796,
                    'distance_yard' => 1100,
                    'straight_round_jubilee_code' => null,
                    'track_code' => null,
                    'course_uid' => 1353,
                    'race_type_code' => 'F',
                    'country_code' => 'GB ',
                ],
                [
                    'horse_uid' => 1234567,
                    'distance_yard' => 1100,
                    'straight_round_jubilee_code' => null,
                    'track_code' => null,
                    'course_uid' => 1353,
                    'race_type_code' => 'F',
                    'country_code' => 'GB ',
                ]
            ],
            //Models\Season:128 ->getLastNumberSeasons()
            'a374304235db956a14ac0abc9fa33b63' => [
                [
                    'season_start_date' => '2018-01-01 00:00:00',
                ],
            ],
            //Models\HorseRace:274 ->getHorsesForm()
            // Here we have added 6 form instances relating to horse_uid = 1234567 to be able to fetch
            // the latest 6 form characters so that we can display the form field for this horse.
            '061079df3a4e22613fd8e7655d4bb012' => [
                [
                    'horse_uid' => 1969796,
                    'race_instance_uid' => 702164,
                    'race_datetime' => '2018-06-10 13:45:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => 1,
                    'race_outcome_form_char' => '1',
                ],
                [
                    'horse_uid' => 1234567,
                    'race_instance_uid' => 702164,
                    'race_datetime' => '2018-06-10 13:45:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => 1,
                    'race_outcome_form_char' => '1',
                ],
                [
                    'horse_uid' => 1234567,
                    'race_instance_uid' => 702164,
                    'race_datetime' => '2018-06-10 13:45:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => 3,
                    'race_outcome_form_char' => '3',
                ],
                [
                    'horse_uid' => 1234567,
                    'race_instance_uid' => 702164,
                    'race_datetime' => '2018-06-10 13:45:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => 2,
                    'race_outcome_form_char' => '2',
                ],
                [
                    'horse_uid' => 1234567,
                    'race_instance_uid' => 702164,
                    'race_datetime' => '2018-06-10 13:45:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => 6,
                    'race_outcome_form_char' => '6',
                ],
                [
                    'horse_uid' => 1234567,
                    'race_instance_uid' => 702164,
                    'race_datetime' => '2018-06-10 13:45:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => 4,
                    'race_outcome_form_char' => '4',
                ],
                [
                    'horse_uid' => 1234567,
                    'race_instance_uid' => 702164,
                    'race_datetime' => '2018-06-10 13:45:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => null,
                    'race_outcome_form_char' => '-',
                ]
            ],
            //Api\DataProvider\Bo\Native\Cards\FullCard\Data ->getDaysSinceLastRun()
            'bd3676e852042d65b92c0e9888a8f3ee' => [
                [
                    'horse_uid' => 1969796,
                    'race_type_code' => 'B',
                    'days_since_run' => 12,
                ],
                [
                    'horse_uid' => 1234567,
                    'race_type_code' => 'F',
                    'days_since_run' => 32,
                ]
            ],
            //Models\RaceInstance:4004 ->getRaceAdditionalData()
            '2b7db64e3daa572fa09099e1d99500e3' => [
                [
                    'race_status_code' => '4'
                ]
            ],
            //Models\RaceInstance:4033 ->getRaceAdditionalData()
            '2baea0dcb40383d277200231274549b1' => [
                [
                    'race_instance_uid' => 703330,
                    'distance_yard' => 2200,
                    'race_datetime' => '2018-10-13 13:50:00',
                    'race_type_code' => 'F',
                    'race_group_code' => '4',
                    'country_code' => 'GB',
                    'min_weight' => null,
                    'race_status_code' => '4',
                    'weight_adjustment' => 140,
                    'min_age' => 2,
                    'max_age' => 2,
                    'top_age' => 0,
                    'furlong' => 10.0000
                ]
            ],
            //Api\DataProvider\Bo\Rpr:109 ->createTemporaryTable()
            'a13a4ffc65321664a102fbe429eab33b' => [
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            '962765cf8636a987403a272880dc4d2e' => [
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            '5f260f5396cf8de1d3c55f04f9cf43f3' => [
            ],
            //Models\RaceInstance:2564 ->createHorsesIdTmpTableByRace()
            '7098b38d95123536d6031b521b507dc4' => [
            ],
            //Models\RaceInstance:2646 ->createHorsePtpGbIdTmpTable()
            '025178cdda95b5b5c5c67a53a9ba220b' => [
            ],
            //Models\3769:2646 ->getHorsesAttributes()
            '11df76a7213c9ea9732fa59e81859046' => [
                [
                    'horse_uid' => 1748691,
                    'race_instance_uid' => 705751,
                    'weight_carried_lbs' => 128,
                    'age' => 2
                ]
            ],
            //Models\Horse:3769 ->getHorsesAttributes()
            '11df76a7213c9ea9732fa59e81859046' => [

                [
                    'horse_uid' => 703330,
                    'race_instance_uid' => 705751,
                    'weight_carried_lbs' => 128,
                    'age' => 2
                ]
            ],
            //Models\Horse:3769 ->getHorsesAttributes()
            'be280b0d588fc94c288ae6c4d6b8fe02' => [
                [
                    'age' => 2
                ]
            ],
            'f4b0aec2f3f503d2c208b43d1ddaf26e' => [
                [
                    'horse_uid' => 703330,
                    'weight_carried_lbs' => 128,
                    'race_instance_uid' => 703330,
                    'age' => 2,
                    'rp_postmark' => 0,
                    'rp_topspeed' => 0,
                    'wfage' => 2,
                    'adjusted_age' => 2,
                    'force_deduct_wfa' => 0,
                    'wfa_control_flag' => 0,
                    'wfa_flat' => 0,
                    'wfa_jump' => 0,
                ]
            ],
            ////Models\3769:2646 ->getRunnersIds
            'e9a37a4f3e02a8bc457c98cd0a34e3e2' => [
                [
                    'horse_uid' => 1748691
                ],
                [
                    'horse_uid' => 703330
                ],
            ],
            //Models\Bo\Rpr:859 ->calculateRpr()
            '22d683a14447da6f2c71b18c0ea91c40' => [
            ],
            //Models\RaceInstance:2491 ->getPtpGbHorses()
            'f89ec997de033f8016cce3b54e1dad74' => [
            ],
            //Models\RaceInstance:1968 ->getFormOrWinsOrMyRatings()
            '41c5352cbcf6f2d9c1835b20a8bfdf5a' => [
                [
                    'race_instance_uid' => 705751,
                    'race_group_uid' => 0,
                    'race_datetime' => '2018-07-5 14:55:00',
                    'local_meeting_race_datetime' => '2018-07-5 14:55:00', // the date should be padded with 0 if less than 10
                    'hours_difference' => 0,
                    'course_uid' => 49,
                    'course_name' => 'RIPON',
                    'course_style_name' => 'Ripon',
                    'country_code' => 'GB ',
                    'course_type_code' => 'F',
                    'race_instance_title' => 'British Stallion Studs EBF Novice Stakes (Plus 10 Race)',
                    'race_type_code' => 'F',
                    'course_code' => 'RIPO',
                    'course_rp_abbrev_3' => 'RIP',
                    'course_rp_abbrev_4' => 'Ripn',
                    'weight_allowance_lbs' => 0,
                    'course_comments' => 'right-handed, fairly sharp track',
                    'going_type_services_desc' => 'Gd',
                    'prize_sterling' => 5175.2,
                    'prize_euro' => 0.0,
                    'distance_yard' => 1210, // we need to produce 5.5 furlongs in order to test how we print halfs
                    'actual_race_class' => '4',
                    'rp_ages_allowed_desc' => '2yo',
                    'race_group_code' => '0',
                    'race_group_desc' => 'Unknown',
                    'weight_carried_lbs' => 134,
                    'race_outcome_desc' => '2nd',
                    'race_outcome_form_char' => '2',
                    'race_output_order' => 2,
                    'race_outcome_position' => 2,
                    'race_outcome_code' => 'PU',
                    'orig_race_output_order' => 2,
                    'no_of_runners' => null,
                    'going_type_code' => 'G',
                    'no_of_runners_calculated' => 9,
                    'rp_close_up_comment' => 'chased leaders, ridden over 2f out, went 2nd inside final furlong, kept on but not reach winner',
                    'notes' => null,
                    'rp_horse_head_gear_code' => null,
                    'first_time_yn' => null,
                    'odds_desc' => '100/30',
                    'odds_value' => 3.333,
                    'horse_uid' => 1969796,
                    'jockey_style_name' => 'Tom Queally',
                    'aka_style_name' => 'T Queally',
                    'jockey_jockey_uid' => 78935,
                    'jockey_ptp_type_code' => 'N',
                    'official_rating_ran_off' => 82,
                    'rp_topspeed' => 65,
                    'rp_postmark' => 80,
                    'rp_betting_movements' => 'tchd 3/1 and tchd 7/2',
                    'disqualification_uid' => null,
                    'disqualification_desc' => null,
                    'rp_straight_round_jubilee_desc' => null,
                    'other_horse' => null,
                    'race_tactics' => null,
                    'next_run' => null,
                    'draw' => 6,
                    'dtw_rp_distance_desc' => null,
                    'dtw_sum_distance_value' => null,
                    'dtw_count_horse_race' => null,
                    'dtw_total_distance_value' => null,
                    'non_runner' => 'N',
                ],
                [
                    'race_instance_uid' => 705751,
                    'race_group_uid' => 0,
                    'race_datetime' => '2018-07-21 14:55:00',
                    'local_meeting_race_datetime' => '2018-07-21 14:55:00',
                    'hours_difference' => 0,
                    'course_uid' => 49,
                    'course_name' => 'RIPON',
                    'course_style_name' => 'Ripon',
                    'country_code' => 'GB ',
                    'course_type_code' => 'F',
                    'race_instance_title' => 'British Stallion Studs EBF Novice Stakes (Plus 10 Race)',
                    'race_type_code' => 'F',
                    'course_code' => 'RIPO',
                    'course_rp_abbrev_3' => 'RIP',
                    'course_rp_abbrev_4' => 'Ripn',
                    'weight_allowance_lbs' => 0,
                    'course_comments' => 'right-handed, fairly sharp track',
                    'going_type_services_desc' => 'Gd',
                    'prize_sterling' => 5175.2,
                    'prize_euro' => 0.0,
                    'distance_yard' => 1100,
                    'actual_race_class' => '4',
                    'rp_ages_allowed_desc' => '2yo',
                    'race_group_code' => '0',
                    'race_group_desc' => 'Unknown',
                    'weight_carried_lbs' => 134,
                    'race_outcome_desc' => '2nd',
                    'race_outcome_form_char' => '2',
                    'race_output_order' => 2,
                    'race_outcome_position' => 2,
                    'race_outcome_code' => '2',
                    'orig_race_output_order' => 2,
                    'no_of_runners' => null,
                    'going_type_code' => 'G',
                    'no_of_runners_calculated' => 9,
                    'rp_close_up_comment' => 'chased leaders, ridden over 2f out, went 2nd inside final furlong, kept on but not reach winner',
                    'notes' => null,
                    'rp_horse_head_gear_code' => null,
                    'first_time_yn' => null,
                    'odds_desc' => '100/30',
                    'odds_value' => 3.333,
                    'horse_uid' => 1234567,
                    'jockey_style_name' => 'Tom Queally',
                    'aka_style_name' => 'T Queally',
                    'jockey_jockey_uid' => 78935,
                    'jockey_ptp_type_code' => 'N',
                    'official_rating_ran_off' => 82,
                    'rp_topspeed' => 65,
                    // we expect this 0 to be converted to mdash
                    'rp_postmark' => 0,
                    'rp_betting_movements' => 'tchd 3/1 and tchd 7/2',
                    'disqualification_uid' => null,
                    'disqualification_desc' => null,
                    'rp_straight_round_jubilee_desc' => null,
                    'other_horse' => null,
                    'race_tactics' => null,
                    'next_run' => null,
                    'draw' => 6,
                    'dtw_rp_distance_desc' => null,
                    'dtw_sum_distance_value' => null,
                    'dtw_count_horse_race' => null,
                    'dtw_total_distance_value' => null,
                    'non_runner' => 'N',
                ]
            ],
            //Models\RaceInstance:2155 ->joinDistanceWinnersDataToForm()
            'c830687cacd9aee40f3bebb86ff97f7c' => [
                [
                    'race_instance_uid' => 700024,
                    'horse_uid' => 1796168,
                    'dtw_rp_distance_desc' => null,
                    'dtw_sum_distance_value' => 2.8,
                    'dtw_count_horse_race' => null,
                    'dtw_total_distance_value' => 13.6,
                    'dth_distance_value' => 13.6,
                ],
            ],
            //Models\RaceInstance:2025 ->joinOtherHorseDataToForm()
            'f889b0f1950cb487ea02dab97e28c3b5' => [
                [
                    'style_name' => 'Emaraaty Ana',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 1748691,
                    'weight_carried_lbs' => 128,
                    'race_instance_uid' => 698537,
                    'race_outcome_position' => 1,
                ],
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            'a25a53f882b3d4c4646b510023d3c355' => [
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            '585f330d3f92b71f3471cf966d4919af' => [
            ],
            //Models\RaceInstance:2270 ->prepareNextRunTmpTables()
            'c5ca20dbf0f160a2cfb1df6a42103e0f' => [
            ],
            //Models\RaceInstance:2390 ->getNextRun()
            'd367c24e7598953ff72237bcd9b623da' => [
                [
                    'form_race_instance_uid' => 697403,
                    'first_3_wins' => 1,
                    'first_3_placed' => 1,
                    'first_3_unplaced' => 0,
                    'other_wins' => 1,
                    'other_placed' => 2,
                    'other_unplaced' => 2,
                    'other_total' => 0,
                    'hot_race' => 1,
                    'cold_race' => 0,
                    'first_3_total' => 0,
                    'form_total_runners' => 0,

                ],
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            '859d4384cb3226e1fd8fe6414851a34a' => [
            ],
            //Models\RaceInstance:4295 ->deleteTable()
            '40f233f668a22f2d18077b1571c1d1ca' => [
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            'cd0054113fce59c32dde894b93c9af33' => [
            ],
            //Api\DataProvider\Bo\VideoProviders:31 ->getDetails() DROP TABLE #tmp_race_ids
            'fabddb1710b03508361534ea456ae438' => [
            ],
            //Api\DataProvider\Bo\VideoProviders:31 ->getDetails() SELECT INTO #tmp_race_ids
            'de0ac756af8cc5aa705da555ec5cadb3' => [
            ],
            //Api\DataProvider\Bo\VideoProviders:31 ->getDetails() Main statement
            '10beaaaa61612758c43257e79f9dda01' => [
                [
                    'race_instance_uid' => 697403,
                    'ptv_video_id' => 1376429,
                    'video_provider' => 'RUK',
                    'stream_url' => null,
                    'complete_race_uid' => 2777724,
                    'complete_race_start' => 354,
                    'complete_race_end' => 568,
                    'finish_race_uid' => 2777725,
                    'finish_race_start' => 378,
                    'finish_race_end' => 433,
                ],
            ],
            //Models\Bo\Selectors\Database ->getTipsQuantity()
            '5bc099032b270ddbcfa3ed9fd2e7031a' => [

            ],
            //models/Bo/RaceCards/RaceInstance.php:3987
            'db053478b31bc5a48d6c8359ec885f53' => [

            ],
            //models/Bo/RaceCards/RaceInstance.php:3987 ->getHorsesTopspeed
            '3026d910b359ce360a0e677e7f80dea1' => [

            ]
        ];
    }
}
