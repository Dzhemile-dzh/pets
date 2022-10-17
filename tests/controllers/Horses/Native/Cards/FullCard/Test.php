<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Native\Cards\FullCard;

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
        return '/horses/native/cards/703330/full-card';
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
                    'perform_race' => false,
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
                [
                    'position_no' => 2,
                    'position_template' => 'prizePos%d',
                    'prize_template' => '%.2f',
                    'prize_sterling' => 32250.0,
                    'prize_euro' => null,
                ],
                [
                    'position_no' => 3,
                    'position_template' => 'prizePos%d',
                    'prize_template' => '%.2f',
                    'prize_sterling' => 16140.0,
                    'prize_euro' => null,
                ],
                [
                    'position_no' => 4,
                    'position_template' => 'prizePos%d',
                    'prize_template' => '%.2f',
                    'prize_sterling' => 8040.0,
                    'prize_euro' => null,
                ],
                [
                    'position_no' => 5,
                    'position_template' => 'prizePos%d',
                    'prize_template' => '%.2f',
                    'prize_sterling' => 4035.0,
                    'prize_euro' => null,
                ],
                [
                    'position_no' => 6,
                    'position_template' => 'prizePos%d',
                    'prize_template' => '%.2f',
                    'prize_sterling' => 2025.0,
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
                [
                    'synopsis' => 'Coral offer: Money back if beaten by a length',
                    'story' => 'asd',
                    'race_attrib_uid' => 484,
                ],
            ],
            //Api\DataProvider\Bo\Native\Cards\FullCard\Data:256 ->getRunners()
            'b053a0ff04154443dabe9545cb3a7d2d' => [
                [
                    'saddle_cloth_no' => 1,
                    'draw' => 1,
                    'owner_uid' => 264106,
                    'horse_uid' => 1969796,
                    'race_instance_uid' => 703330,
                    'race_type_code' => 'F',
                    'race_datetime' => '2018-06-19 15:05:00',
                    'course_uid' => 2,
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
                    'num_topspeed_best_rating' => 81,
                    'rp_postmark' => 104,
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
                    'tips_qty' => 0,
                    'days_since_last_run' => null

                ],
                [
                    'saddle_cloth_no' => 3,
                    'draw' => 2,
                    'owner_uid' => 264300,
                    'horse_uid' => 7654321,
                    'race_instance_uid' => 703330,
                    'race_type_code' => 'F',
                    'race_datetime' => '2018-06-19 15:05:00',
                    'course_uid' => 2,
                    'distance_yard' => 1320,
                    'course_country_code' => 'GB ',
                    'track_code' => null,
                    'straight_round_jubilee_code' => null,
                    'race_group_uid' => 2,
                    'horse_name' => 'Jack Jones',
                    'country_origin_code' => 'GB',
                    'rp_horse_head_gear_code' => null,
                    'horse_age' => 2,
                    'weight_carried_lbs' => 127,
                    'official_rating' => null,
                    'jockey_uid' => 92728,
                    'jockey_name' => 'Elizabeth Taylor',
                    'trainer_uid' => 4528,
                    'trainer_stylename' => 'Zavkushti',
                    'rp_topspeed' => 81,
                    'num_topspeed_best_rating' => 81,
                    'rp_postmark' => 104,
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
                    'tips_qty' => 0,
                    'days_since_last_run' => null

                ],
                [
                    'saddle_cloth_no' => 13,
                    'draw' => 3,
                    'owner_uid' => 264300,
                    'horse_uid' => 1111111,
                    'race_instance_uid' => 703330,
                    'race_type_code' => 'F',
                    'race_datetime' => '2018-06-19 15:05:00',
                    'course_uid' => 2,
                    'distance_yard' => 1320,
                    'course_country_code' => 'GB ',
                    'track_code' => null,
                    'straight_round_jubilee_code' => null,
                    'race_group_uid' => 2,
                    'horse_name' => 'James Brown',
                    'country_origin_code' => 'GB',
                    'rp_horse_head_gear_code' => null,
                    'horse_age' => 2,
                    'weight_carried_lbs' => 127,
                    'official_rating' => null,
                    'jockey_uid' => 92728,
                    'jockey_name' => 'Lissy Swift',
                    'trainer_uid' => 4528,
                    'trainer_stylename' => 'Za tuka',
                    'rp_topspeed' => 81,
                    'num_topspeed_best_rating' => 81,
                    'rp_postmark' => 104,
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
                    'tips_qty' => 0,
                    'days_since_last_run' => null
                ],
            ],
            //Models\Bo\RaceCards\Runners:772 ->getBeatenFavourites()
            '138cdc51591292aa1d0547691e2a1a28' => [
                [
                    'horse_uid' => 1969796,
                ],
                [
                    'horse_uid' => 7654321,
                ],
                [
                    'horse_uid' => 1111111,
                ],
            ],
            //Models\Bo\RaceCards\Runners:772 ->getBeatenFavourites()
            '913142b1eb0fe1a0ba4e1b933dbbb897' => [
                [
                    'horse_uid' => 1969796,
                ],
                [
                    'horse_uid' => 7654321,
                ],
                [
                    'horse_uid' => 1111111,
                ],
            ],
            //Models\Bo\Selectors\Database ->getTipsQuantity()
            'ac9b913192bc0f9be459c0c9d8ed4262' => [
                [
                    'c' => 2,
                    'horse_uid' => 1969796,
                ],
                [
                    'c' => 3,
                    'horse_uid' => 7654321,
                ],
                [
                    'c' => 1,
                    'horse_uid' => 7654321,
                ]
            ],
            //Models\Bo\RaceCards\Runners:713 ->getHorseForms()
            '5de0c01875c36682111bf9e06f7c2145' => [
               [
                    'horse_uid' => 1969796,
                    'distance_yard' => 1320,
                    'straight_round_jubilee_code' => null,
                    'track_code' => null,
                    'course_uid' => 36,
                    'race_type_code' => 'F',
                    'country_code' => 'GB ',
               ],
               [
                    'horse_uid' => 7654321,
                    'distance_yard' => 1320,
                    'straight_round_jubilee_code' => null,
                    'track_code' => null,
                    'course_uid' => 36,
                    'race_type_code' => 'F',
                    'country_code' => 'GB ',
                ],
               [
                    'horse_uid' => 1111111,
                    'distance_yard' => 1320,
                    'straight_round_jubilee_code' => null,
                    'track_code' => null,
                    'course_uid' => 36,
                    'race_type_code' => 'F',
                    'country_code' => 'GB ',
                ]
            ],
            //Models\Season:128 ->getLastNumberSeasons()
            'a374304235db956a14ac0abc9fa33b63' => [
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
            // Models\HorseRace:274 ->getHorsesForm()
            // Here we have added 6 form instances relating to horse_uid = 1111111 to be able to fetch
            // the latest 6 form characters so that we can display the form field for this horse.
            '5681e6dc6e5bbd587c681ad6054fba9c' => [
                [
                    'horse_uid' => 1969796,
                    'race_instance_uid' => 700024,
                    'race_datetime' => '2018-05-18 13:30:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => 1,
                    'race_outcome_form_char' => '1',
                ],
                [
                    'horse_uid' => 7654321,
                    'race_instance_uid' => 700024,
                    'race_datetime' => '2018-05-18 13:30:00',
                    'race_type_code' => 'F',
                    'race_outcome_position' => 3,
                    'race_outcome_form_char' => '1',
                ],
                [
                    'horse_uid' => 1111111,
                    'race_instance_uid' => 700024,
                    'race_datetime' => '2018-05-18 13:30:00',
                    'race_type_code' => 'B',
                    'race_outcome_position' => 1,
                    'race_outcome_form_char' => '1',
                ],
                [
                    'horse_uid' => 1111111,
                    'race_instance_uid' => 700024,
                    'race_datetime' => '2018-05-18 13:30:00',
                    'race_type_code' => 'B',
                    'race_outcome_position' => 4,
                    'race_outcome_form_char' => '4',
                ],
                [
                    'horse_uid' => 1111111,
                    'race_instance_uid' => 700024,
                    'race_datetime' => '2018-05-18 13:30:00',
                    'race_type_code' => 'B',
                    'race_outcome_position' => null,
                    'race_outcome_form_char' => '-',
                ],
                [
                    'horse_uid' => 1111111,
                    'race_instance_uid' => 700024,
                    'race_datetime' => '2018-05-18 13:30:00',
                    'race_type_code' => 'B',
                    'race_outcome_position' => 6,
                    'race_outcome_form_char' => '6',
                ],
                [
                    'horse_uid' => 1111111,
                    'race_instance_uid' => 700024,
                    'race_datetime' => '2018-05-18 13:30:00',
                    'race_type_code' => 'B',
                    'race_outcome_position' => 5,
                    'race_outcome_form_char' => '5',
                ],
                [
                    'horse_uid' => 1111111,
                    'race_instance_uid' => 700024,
                    'race_datetime' => '2018-05-18 13:30:00',
                    'race_type_code' => 'B',
                    'race_outcome_position' => null,
                    'race_outcome_form_char' => '-',
                ],
            ],
            //Api\DataProvider\Bo\Native\Cards\FullCard\Data ->getDaysSinceLastRun()
            'f89a7d45728db1fa10eed43d6f86db34' => [
                [
                    'horse_uid' => 1969796,
                    'race_type_code' => 'F',
                    'days_since_run' => 23,
                ],
                [
                    'horse_uid' => 7654321,
                    'race_type_code' => 'B',
                    'days_since_run' => 23,
                ],
                [
                    'horse_uid' => 1111111,
                    'race_type_code' => 'F',
                    'days_since_run' => 44,
                ],
                [
                    'horse_uid' => 1111111,
                    'race_type_code' => 'B',
                    'days_since_run' => 13,
                ]
            ],
            //Models\RaceInstance:4004 ->getRaceAdditionalData()
            '2b7db64e3daa572fa09099e1d99500e3' => [
                [
                    'race_status_code' => '4'
                ]
            ],
            //Models\RaceInstance:4004 ->getRaceAdditionalData()
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
            '6d40fe8c0b4722b52ce0dd03938ac6b0' => [
            ],
            //Api\DataProvider\Bo\Rpr:182 ->createTemporaryTable()
            'd1287145ab83be9c650b9311b2f3afb8' => [
            ],
            //Api\DataProvider\Bo\Rpr:182 ->createTemporaryTable()
            '1107b28d1e4ae353083658662868cbd5' => [
            ],
            //Bo/RaceCards/RaceInstance.php:3769 ->getHorsesAttributes()
            '11df76a7213c9ea9732fa59e81859046' => [
                [
                    'horse_uid' => 1969796,
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
            //Bo/RaceCards/RaceInstance.php:3940 -> getHorsesAttributes()
            'f4b0aec2f3f503d2c208b43d1ddaf26e' => [

                [
                    'horse_uid' => 1969796,
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
            //models/Bo/RaceCards/RaceInstance.php:4295 -> dropTempTable()
            '40f233f668a22f2d18077b1571c1d1ca' => [

            ],
            //models/Bo/RaceCards/RaceInstance.php:3953 -> getHorsesTopspeed()
            'fbacec8af1bb8592aeb5256e68272054' => [

            ]

        ];
    }
}
