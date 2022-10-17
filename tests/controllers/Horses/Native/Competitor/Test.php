<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Native\Competitor;

use UnitTestsComponents\ApiRouteTest\Xml as ApiRouteTestPrototype;

/**
 * @package Tests\Controllers\Horses\Native\Results\Competitor
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/native/competitor/1748791/711716';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Native\Cards\FullCard\Data ->getDaysSinceLastRun()
            '9dca425847546a96ecec4fded1bccf39' => [
                [
                    'horse_uid' => 1748791,
                    'race_type_code' => 'F',
                    'days_since_run' => 21,
                ]
            ],
            //Api\DataProvider\Bo\Native\Results\FullResult:22 ->getData()
            'eab27b7ff6805162d430d491de172484' => [
                [
                    1
                ],
            ],
            //Api\DataProvider\Bo\Native\Results\FullResult:22 ->getData()
            '337e80e7e00b48377ff38e8cca665c76' => [
                [
                    1
                ],
            ],
            //Api\DataProvider\Bo\Native\Results\FullResult:22 ->getData()
            '0a42c3588c5d79cda9a334ec4572e00c' => [
                [
                    1
                ],
            ],
            //Api\DataProvider\Bo\Native\Results\FullResult:22 ->getData()
            '1d31399daf441539f1e667fa3eb4fd8c' => [
                [
                    'course_name' => 'NEWMARKET'
                ],
            ],
            //Api\DataProvider\Bo\Native\Results\FullResult:22 ->getData()
            'c87bc52e69c13f5b6f95dbee3190e547' => [
                [
                    'trainer_uid' => 7978,
                    'trainer_name' => 'A P `Brien',
                    'race_instance_uid' => 711716,
                    'course_country' => 'GB',
                    'owner_uid' => 243775,
                    'owner_name' => 'Flaxman Stables/Mrs Magnier/Tabor/Smith',
                    'race_status_code' => '4',
                    'race_type_code' => 'F',
                    'race_datetime' => '2018-10-13 13:50:00',
                    'course_uid' => 38,
                    'distance_yard' => 2200,
                    'non_runner' => null,
                    'race_type' => 'flat',
                    'competitor_id' => 1748791,
                    'competitor_name' => 'Circus Maximus',
                    'competitor_horse_sex_code' => 'C',
                    'horse_country_code' => 'IRE',
                    'competitor_horse_colour_code' => 'b',
                    'horse_date_of_birth' => '2016-02-08 00:00:00',
                    'horse_date_of_death' => null,
                    'competitor_horse_age' => 2,
                    'furlong' => '10',
                    'saddle_cloth_no' => '1',
                    'days_since_run' => 21,
                    'course_wins' => null,
                    'distance_wins' => null,
                    'course_and_distance_wins' => null,
                    'beaten_favourite' => 'N',
                    'tips_qty' => null,
                    'reserve' => null,
                    'jp_style_name' => "jack",
                    'jp_jockey_uid' => null,
                    'j_style_name' => null,
                    'j_jockey_uid' => null,
                    'rp_postmark' => 93,
                    'rp_topspeed' => null,
                    'raceOR' => null,
                    'earnings' => 0,
                    'race_group_uid' => 2,
                    'breeder_name' => 'Flaxman Stables Ireland Ltd',
                    'rp_form_text' => 'First foal; dam 1m winner (inc AW/Group 2; RPR 115), out of 1m4f AW winner closely related to US 1m1f Grade 1 winners La Gueriere and Honor In War',
                    'horse_name' => 'GALILEO',
                    'country_origin_code' => 'IRE',
                    'sire_name' => 'Galileo',
                    'sire_country_origin_code' => 'IRE',
                    'sire_avg_flat_win_dist_of_progeny' => '11.2',
                    'dam_name' => 'Duntle',
                    'dam_country_origin_code' => 'IRE',
                    'dam_sire_name' => 'Danehill Dancer',
                    'dam_sire_country_origin_code' => 'IRE',
                    'dam_sire_avg_flat_win_dist_of_progeny' => '8.4',
                    'comment' => null,
                    'extra_weight_lbs' => null,
                    'weight_carried_lbs' => 0
                ],
            ],
            //provider/DataProvider/Bo/Native/Competitor/CompetitorDetails:347 ->createTmpRaceClassTable()
            'de4287801a1bc4fe81b3f91093fc04e2' => [

            ],
            //Api\DataProvider\Bo\Native\Results\FullResult:22 ->getData()
            '89e47b25bf39eb1472ad9d4f31d3a775' => [
                [
                    'distance_yard' => '1760',
                    'course_uid' => '184'
                ],
            ],
            //Api\DataProvider\Bo\Native\Results\FullResult:22 ->getData()
            '07c479efd3e6b0e8aaae093aeda08337' => [
                [
                    'horse_uid' => '1748791',
                    'course_uid' => '184'
                ],
            ],
            '578515441d7b161d52582861cc1d7ebe' => [
                [
                    'horse_uid' => 1748791,
                ]
            ],
            '4834b57aa9c5cca04a8808c846ff99a6' => [
                [
                    'trainer_uid' => 7978,
                    'wins' => 16,
                    'runs' => 70,
                    'profit' => 2.386
                ]
            ],
            '159bcf0e22ec1b2332e7fdac7dcd9b98' => [
                [
                    'race_status_code' => '4'
                ]
            ],
            '37c76c124f531b1a7ac0c1b2874ac440' => [
                [
                    'c' => 1,
                    'horse_uid' => 1748791
                ]
            ],
            '8a4eb5071dedf32147b16e10940d8072' => [
                [
                    'race_instance_uid' => 711716,
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
            '6f364125cf98c77326e1da5c325aec63' => [
                [
                    'horse_uid' => 1748748,
                    'race_instance_uid' => 711716,
                    'weight_carried_lbs' => 128,
                    'age' => 2
                ]
            ],
            'be280b0d588fc94c288ae6c4d6b8fe02' => [
                [
                    'age' => 2
                ]
            ],
            'd2c27701e857e2e1c5a5e8f6726e9e9d' => [
                [
                    'horse_uid' => 1748748,
                    'weight_carried_lbs' => 128,
                    'race_instance_uid' => 711716,
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
            'db66c685523b290550a0aa399ba2b3c1' => [
                [
                    'race_type_code' => 'F',
                    'race_count' => 2,
                    'rpr' => 81,
                    'ts' => 52,
                    'win' => 1,
                    'second_places' => 0,
                    'best_or' => 0,
                    'earnings' => 8994.6903
                ],
                [
                    'race_type_code' => 'S',
                    'race_count' => 0,
                    'rpr' => null,
                    'ts' => null,
                    'win' => 0,
                    'second_places' => 0,
                    'best_or' => 0,
                    'earnings' => 0.0000
                ],
                [
                    'race_type_code' => 'A',
                    'race_count' => 2,
                    'rpr' => null,
                    'ts' => null,
                    'win' => 1,
                    'second_places' => 0,
                    'best_or' => 0,
                    'earnings' => 8994.6903
                ],
            ],
            '260e2bfe331560cb90f5059ca2f23919' => [
                [
                    'race_instance_uid' => 712187,
                    'race_datetime' => '2018-09-22 14:05:00',
                    'race_type_code' => 'F',
                    'rp_abbrev_3' => 'GOW',
                    'weight_carried_lbs' => 131,
                    'distance_yard' => 1760,
                    'country_code' => 'GB',
                    'going_type_code' => 'Hy',
                    'official_rating_ran_off' => 0,
                    'final_race_outcome_uid' => 1,
                    'no_of_runners' => 16,
                    'odds_desc' => '8/13F',
                    'rp_postmark' => 81,
                    'rp_topspeed' => null,
                    'raceOR' => null,
                    'earnings' => 1000,
                    'race_group_uid' => 2,
                    'race_outcome_code' => 1,
                    'no_of_runners_calculated' => 16,
                    'actual_race_class' => null,
                ],
                [
                    'race_instance_uid' => 710138,
                    'race_datetime' => '2018-08-26 13:35:00',
                    'race_type_code' => 'F',
                    'rp_abbrev_3' => 'CUR',
                    'weight_carried_lbs' => 131,
                    'distance_yard' => 1540,
                    'country_code' => 'GB',
                    'going_type_code' => 'Y',
                    'official_rating_ran_off' => 0,
                    'final_race_outcome_uid' => 5,
                    'no_of_runners' => 23,
                    'odds_desc' => '5/1F',
                    'rp_postmark' => 72,
                    'rp_topspeed' => 80,
                    'raceOR' => 50,
                    'earnings' => 200,
                    'race_group_uid' => 2,
                    'race_outcome_code' => 'DSQ',
                    'no_of_runners_calculated' => 23,
                    'actual_race_class' => null,
                ],
                [
                    'race_instance_uid' => 123456,
                    'race_datetime' => '2018-08-26 13:35:00',
                    'race_type_code' => 'F',
                    'rp_abbrev_3' => 'CUR',
                    'weight_carried_lbs' => 131,
                    'distance_yard' => 1540,
                    'country_code' => 'GB',
                    'going_type_code' => 'Y',
                    'official_rating_ran_off' => 0,
                    'final_race_outcome_uid' => 5,
                    'no_of_runners' => 23,
                    'odds_desc' => '5/1F',
                    'rp_postmark' => null,
                    'rp_topspeed' => null,
                    'raceOR' => null,
                    'earnings' => 0,
                    'race_group_uid' => 2,
                    'race_outcome_code' => 5,
                    'no_of_runners_calculated' => 23,
                    'actual_race_class' => null,
                ]
            ],
            //provider/DataProvider/Bo/Native/Competitor/CompetitorDetails:372 -> dropTmpTable()
            'caed9e55797b0a167232003720a48a94'=> [

            ],
            //DataProvider/Bo/Rpr.php:143
            'e2ba7fb6b6224c02359a67daafdb03e8' => [

            ],
            //Api\DataProvider\Bo\Rpr:109 ->createTemporaryTable()
            'a13a4ffc65321664a102fbe429eab33b' => [
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            '859d4384cb3226e1fd8fe6414851a34a' => [
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            '5f260f5396cf8de1d3c55f04f9cf43f3' => [
            ],
            //Models\RaceInstance:2564 ->createHorsesIdTmpTableByRace()
            '726f48e6fe86e5da394ca6d6c28f4f0b' => [
            ],
            //Models\RaceInstance:2646 ->createHorsePtpGbIdTmpTable()
            '025178cdda95b5b5c5c67a53a9ba220b' => [
            ],
            //Models\Horse:3769 ->getHorsesAttributes()
            'f4b0aec2f3f503d2c208b43d1ddaf26e' => [

                [
                    'horse_uid' => 703330,
                    'race_instance_uid' => 711716,
                    'weight_carried_lbs' => 128,
                    'age' => 2
                ]
            ],
            //Models\3769:2646 ->getRunnersIds
            'e9a37a4f3e02a8bc457c98cd0a34e3e2' => [
                [
                    'horse_uid' => 1748691
                ],
                [
                    'horse_uid' => 703330
                ],
            ],
            //Models\Bo\Rpr:859 ->calculateRpr()
            '728450e64bc5171735401a5dff8b1baf' => [
            ],
            //Models\RaceInstance:2491 ->getPtpGbHorses()
            'f89ec997de033f8016cce3b54e1dad74' => [
            ],
            //Models\RaceInstance:1968 ->getFormOrWinsOrMyRatings()
            'ecf0ea82208ae6312588f134ff24673b' => [
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
            'ea05874be9dd17459b054b911bca9ce8' => [
                [
                    'race_instance_uid' => 700024,
                    'horse_uid' => 1796168,
                    'dtw_rp_distance_desc' => null,
                    'dtw_sum_distance_value' => 2.8,
                    'dtw_count_horse_race' => null,
                    'dtw_total_distance_value' => 13.6,
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
            '02fbcc912594da4bca35bed231c094ba' => [
                [
                    'form_race_instance_uid' => 697403,
                    'first_3_wins' => 1,
                    'first_3_placed' => 1,
                    'first_3_unplaced' => 0,
                    'other_wins' => 1,
                    'other_placed' => 2,
                    'other_unplaced' => 2,
                    'hot_race' => 1,
                    'cold_race' => 0,
                ],
            ],
            //Models\RaceInstance:4295 ->deleteTable()
            '40f233f668a22f2d18077b1571c1d1ca' => [
            ],
            //Models\RaceInstance:2203 ->deleteTable()
            'cd0054113fce59c32dde894b93c9af33' => [
            ],
            //Api\DataProvider\Bo\VideoProviders:113 ->getDetails()
            'da3f611f0304369201cff8fe9f3630ce' => [
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
            '5931ff95a1b0511bb4b135d15f759b48' => [

            ],
            //Api\Row\Methods\GetHorseAge
            '419bea4c352b958d6ce8d8201af1e562' => [
                [
                    'date' => '2018-01-02 08:03:58.057'
                ]
            ],
            //models/Bo/RaceCards/RaceInstance.php:3953 -> getHorsesTopspeed()
            '472a26d41218b29fd10bfe1ac84485a3' => [

            ]
        ];
    }
}
