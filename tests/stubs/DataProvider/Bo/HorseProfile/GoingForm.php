<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/25/2016
 * Time: 11:28 AM
 */

namespace Tests\Stubs\DataProvider\Bo\HorseProfile;

class GoingForm extends \Api\DataProvider\Bo\HorseProfile\GoingForm
{
    /**
     * @param array $horseIds
     *
     * @return array
     */
    public function getGoingForm(array $horseIds, $prefix)
    {
        $key = implode('_', $horseIds);

        $res = [
            '868993' => [
                0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 12,
                        'wins' => 2,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 61,
                        'rp_topspeed' => 51,
                        'race_type_code' => 'F',
                    ]
                ),
                1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 12,
                        'wins' => 2,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 0,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 65,
                        'rp_topspeed' => 35,
                        'race_type_code' => 'F',
                    ]
                ),
                2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 1,
                        'wins' => 0,
                        'going_group' => 'heavy_soft',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 45,
                        'rp_topspeed' => 0,
                        'race_type_code' => 'F',
                    ]
                ),
                3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 3,
                        'wins' => 0,
                        'going_group' => 'good',
                        'race_outcome_position' => 8,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 37,
                        'rp_topspeed' => -1,
                        'race_type_code' => 'F',
                    ]
                ),
                4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 12,
                        'wins' => 2,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 0,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 35,
                        'rp_topspeed' => 3,
                        'race_type_code' => 'F',
                    ]
                ),
                5 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 3,
                        'wins' => 0,
                        'going_group' => 'good',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 50,
                        'rp_topspeed' => 9,
                        'race_type_code' => 'F',
                    ]
                ),
                6 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 12,
                        'wins' => 2,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 27,
                        'rp_topspeed' => 6,
                        'race_type_code' => 'F',
                    ]
                ),
                7 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 12,
                        'wins' => 2,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 53,
                        'rp_topspeed' => 45,
                        'race_type_code' => 'F',
                    ]
                ),
                8 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 12,
                        'wins' => 2,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 57,
                        'rp_topspeed' => 29,
                        'race_type_code' => 'F',
                    ]
                ),
                9 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 12,
                        'wins' => 2,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 62,
                        'rp_topspeed' => 30,
                        'race_type_code' => 'F',
                    ]
                ),
                10 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 3,
                        'wins' => 0,
                        'going_group' => 'good_to_soft',
                        'race_outcome_position' => 10,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 8,
                        'rp_topspeed' => -1,
                        'race_type_code' => 'F',
                    ]
                ),
                11 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 12,
                        'wins' => 2,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 75,
                        'rp_topspeed' => 60,
                        'race_type_code' => 'F',
                    ]
                ),
                12 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 3,
                        'wins' => 0,
                        'going_group' => 'good_to_soft',
                        'race_outcome_position' => 8,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 63,
                        'rp_topspeed' => 19,
                        'race_type_code' => 'F',
                    ]
                ),
                13 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 12,
                        'wins' => 2,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 77,
                        'rp_topspeed' => 59,
                        'race_type_code' => 'F',
                    ]
                ),
                14 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 12,
                        'wins' => 2,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 69,
                        'rp_topspeed' => 65,
                        'race_type_code' => 'F',
                    ]
                ),
                15 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 3,
                        'wins' => 0,
                        'going_group' => 'good',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 69,
                        'rp_topspeed' => 61,
                        'race_type_code' => 'F',
                    ]
                ),
                16 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 12,
                        'wins' => 2,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 70,
                        'rp_topspeed' => 32,
                        'race_type_code' => 'F',
                    ]
                ),
                17 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 12,
                        'wins' => 2,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 59,
                        'rp_topspeed' => 35,
                        'race_type_code' => 'F',
                    ]
                ),
                18 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 868993,
                        'runs' => 3,
                        'wins' => 0,
                        'going_group' => 'good_to_soft',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 61,
                        'rp_topspeed' => 49,
                        'race_type_code' => 'F',
                    ]
                ),
            ],
            '856426_823159' => [
                0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 7,
                        'wins' => 0,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 8,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 52,
                        'rp_topspeed' => 28,
                        'race_type_code' => 'F',
                    ]
                ),
                1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 6,
                        'wins' => 0,
                        'going_group' => 'good_to_soft',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 27,
                        'rp_topspeed' => 14,
                        'race_type_code' => 'F',
                    ]
                ),
                2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 7,
                        'wins' => 0,
                        'going_group' => 'good',
                        'race_outcome_position' => 14,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 0,
                        'rp_topspeed' => -1,
                        'race_type_code' => 'F',
                    ]
                ),
                3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 7,
                        'wins' => 0,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 52,
                        'rp_topspeed' => null,
                        'race_type_code' => 'F',
                    ]
                ),
                4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 1,
                        'wins' => 0,
                        'going_group' => 'firm',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 50,
                        'rp_topspeed' => 24,
                        'race_type_code' => 'F',
                    ]
                ),
                5 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 7,
                        'wins' => 0,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 49,
                        'rp_topspeed' => 34,
                        'race_type_code' => 'F',
                    ]
                ),
                6 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 4,
                        'wins' => 0,
                        'going_group' => 'heavy_soft',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 55,
                        'rp_topspeed' => 50,
                        'race_type_code' => 'F',
                    ]
                ),
                7 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 7,
                        'wins' => 0,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 47,
                        'rp_topspeed' => 19,
                        'race_type_code' => 'F',
                    ]
                ),
                8 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 6,
                        'wins' => 0,
                        'going_group' => 'good_to_soft',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 54,
                        'rp_topspeed' => 50,
                        'race_type_code' => 'F',
                    ]
                ),
                9 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 6,
                        'wins' => 0,
                        'going_group' => 'good_to_soft',
                        'race_outcome_position' => 9,
                        'race_outcome_form_char' => 'U',
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 40,
                        'rp_topspeed' => 28,
                        'race_type_code' => 'F',
                    ]
                ),
                10 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 6,
                        'wins' => 0,
                        'going_group' => 'good_to_soft',
                        'race_outcome_position' => 8,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 33,
                        'rp_topspeed' => -1,
                        'race_type_code' => 'F',
                    ]
                ),
                11 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 7,
                        'wins' => 0,
                        'going_group' => 'good',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 59,
                        'rp_topspeed' => 54,
                        'race_type_code' => 'F',
                    ]
                ),
                12 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 7,
                        'wins' => 0,
                        'going_group' => 'good',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 42,
                        'rp_topspeed' => 29,
                        'race_type_code' => 'F',
                    ]
                ),
                13 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 7,
                        'wins' => 0,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 8,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 48,
                        'rp_topspeed' => 37,
                        'race_type_code' => 'F',
                    ]
                ),
                14 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 4,
                        'wins' => 0,
                        'going_group' => 'heavy_soft',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 54,
                        'rp_topspeed' => 40,
                        'race_type_code' => 'F',
                    ]
                ),
                15 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 4,
                        'wins' => 0,
                        'going_group' => 'heavy_soft',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 40,
                        'rp_topspeed' => 30,
                        'race_type_code' => 'F',
                    ]
                ),
                16 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 7,
                        'wins' => 0,
                        'going_group' => 'good',
                        'race_outcome_position' => 14,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 9,
                        'rp_topspeed' => -1,
                        'race_type_code' => 'F',
                    ]
                ),
                17 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 6,
                        'wins' => 0,
                        'going_group' => 'good_to_soft',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 56,
                        'rp_topspeed' => 20,
                        'race_type_code' => 'F',
                    ]
                ),
                18 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 7,
                        'wins' => 0,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 46,
                        'rp_topspeed' => 9,
                        'race_type_code' => 'F',
                    ]
                ),
                19 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 7,
                        'wins' => 0,
                        'going_group' => 'good',
                        'race_outcome_position' => 10,
                        'race_outcome_form_char' => 'U',
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 43,
                        'rp_topspeed' => 32,
                        'race_type_code' => 'F',
                    ]
                ),
                20 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 7,
                        'wins' => 0,
                        'going_group' => 'good',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 37,
                        'rp_topspeed' => 15,
                        'race_type_code' => 'F',
                    ]
                ),
                21 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 6,
                        'wins' => 0,
                        'going_group' => 'good_to_soft',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 46,
                        'rp_topspeed' => 21,
                        'race_type_code' => 'F',
                    ]
                ),
                22 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 4,
                        'wins' => 0,
                        'going_group' => 'heavy_soft',
                        'race_outcome_position' => 8,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 31,
                        'rp_topspeed' => 0,
                        'race_type_code' => 'F',
                    ]
                ),
                23 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 7,
                        'wins' => 0,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 51,
                        'rp_topspeed' => 42,
                        'race_type_code' => 'F',
                    ]
                ),
                24 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 823159,
                        'runs' => 7,
                        'wins' => 0,
                        'going_group' => 'good',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 51,
                        'rp_topspeed' => 16,
                        'race_type_code' => 'F',
                    ]
                ),
                25 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 856426,
                        'runs' => 5,
                        'wins' => 2,
                        'going_group' => 'heavy_soft',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 88,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                    ]
                ),
                26 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 856426,
                        'runs' => 5,
                        'wins' => 2,
                        'going_group' => 'heavy_soft',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 80,
                        'rp_topspeed' => 9,
                        'race_type_code' => 'B',
                    ]
                ),
                27 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 856426,
                        'runs' => 5,
                        'wins' => 2,
                        'going_group' => 'heavy_soft',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 68,
                        'rp_topspeed' => -1,
                        'race_type_code' => 'B',
                    ]
                ),
                28 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 856426,
                        'runs' => 5,
                        'wins' => 2,
                        'going_group' => 'heavy_soft',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 112,
                        'rp_topspeed' => 11,
                        'race_type_code' => 'H',
                    ]
                ),
                29 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 856426,
                        'runs' => 5,
                        'wins' => 2,
                        'going_group' => 'heavy_soft',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 43,
                        'rp_topspeed' => -1,
                        'race_type_code' => 'H',
                    ]
                ),
                30 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 856426,
                        'runs' => 2,
                        'wins' => 0,
                        'going_group' => 'good',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 115,
                        'rp_topspeed' => 41,
                        'race_type_code' => 'H',
                    ]
                ),
                31 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 856426,
                        'runs' => 2,
                        'wins' => 0,
                        'going_group' => 'good',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 98,
                        'rp_topspeed' => 65,
                        'race_type_code' => 'C',
                    ]
                ),
            ],
            '1_2_3' => [],
            '3_16510_42149_47186_48914_48965_50427_50576_55444_56758' => [
                0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 3,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 8,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => null,
                        'rp_topspeed' => -1,
                        'race_type_code' => 'F',
                    ]
                ),
                1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 1,
                        'going_group' => 'good',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => null,
                        'rp_topspeed' => -1,
                        'race_type_code' => 'F',
                    ]
                ),
                2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 1,
                        'going_group' => 'good',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => null,
                        'rp_topspeed' => -1,
                        'race_type_code' => 'F',
                    ]
                ),
                3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 2,
                        'wins' => 0,
                        'going_group' => 'good_to_soft',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 68,
                        'rp_topspeed' => -1,
                        'race_type_code' => 'F',
                    ]
                ),
                4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 1,
                        'going_group' => 'good',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 80,
                        'rp_topspeed' => 81,
                        'race_type_code' => 'F',
                    ]
                ),
                5 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 2,
                        'wins' => 0,
                        'going_group' => 'good_to_soft',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 87,
                        'rp_topspeed' => 91,
                        'race_type_code' => 'F',
                    ]
                ),
                6 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 3,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 79,
                        'rp_topspeed' => 79,
                        'race_type_code' => 'F',
                    ]
                ),
                7 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 3,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 92,
                        'rp_topspeed' => 84,
                        'race_type_code' => 'F',
                    ]
                ),
                8 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 1,
                        'going_group' => 'good',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 118,
                        'rp_topspeed' => 116,
                        'race_type_code' => 'F',
                    ]
                ),
                9 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 3,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 118,
                        'rp_topspeed' => 86,
                        'race_type_code' => 'F',
                    ]
                ),
                10 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 2,
                        'wins' => 0,
                        'going_group' => 'heavy_soft',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 106,
                        'rp_topspeed' => -1,
                        'race_type_code' => 'F',
                    ]
                ),
                11 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 3,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 117,
                        'rp_topspeed' => 104,
                        'race_type_code' => 'F',
                    ]
                ),
                12 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 3,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 108,
                        'rp_topspeed' => 67,
                        'race_type_code' => 'F',
                    ]
                ),
                13 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 3,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 120,
                        'rp_topspeed' => 101,
                        'race_type_code' => 'F',
                    ]
                ),
                14 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 3,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 122,
                        'rp_topspeed' => 104,
                        'race_type_code' => 'F',
                    ]
                ),
                15 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 3,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 120,
                        'rp_topspeed' => 112,
                        'race_type_code' => 'F',
                    ]
                ),
                16 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 1,
                        'going_group' => 'good',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 121,
                        'rp_topspeed' => 108,
                        'race_type_code' => 'F',
                    ]
                ),
                17 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 1,
                        'going_group' => 'good',
                        'race_outcome_position' => 10,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => null,
                        'rp_topspeed' => 36,
                        'race_type_code' => 'F',
                    ]
                ),
                18 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 3,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 110,
                        'rp_topspeed' => 101,
                        'race_type_code' => 'F',
                    ]
                ),
                19 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 1,
                        'going_group' => 'good',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 121,
                        'rp_topspeed' => 89,
                        'race_type_code' => 'F',
                    ]
                ),
                20 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 1,
                        'going_group' => 'good',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 117,
                        'rp_topspeed' => 96,
                        'race_type_code' => 'F',
                    ]
                ),
                21 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 1,
                        'going_group' => 'good',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 112,
                        'rp_topspeed' => 79,
                        'race_type_code' => 'F',
                    ]
                ),
                22 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 1,
                        'going_group' => 'good',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 119,
                        'rp_topspeed' => 110,
                        'race_type_code' => 'F',
                    ]
                ),
                23 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 1,
                        'going_group' => 'good',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 124,
                        'rp_topspeed' => 77,
                        'race_type_code' => 'F',
                    ]
                ),
                24 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 3,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 9,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 115,
                        'rp_topspeed' => 79,
                        'race_type_code' => 'F',
                    ]
                ),
                25 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 1,
                        'going_group' => 'good',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 117,
                        'rp_topspeed' => 110,
                        'race_type_code' => 'F',
                    ]
                ),
                26 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 3,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 119,
                        'rp_topspeed' => 102,
                        'race_type_code' => 'F',
                    ]
                ),
                27 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 2,
                        'wins' => 0,
                        'going_group' => 'heavy_soft',
                        'race_outcome_position' => 9,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 114,
                        'rp_topspeed' => 95,
                        'race_type_code' => 'F',
                    ]
                ),
                28 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 3,
                        'going_group' => 'good_to_firm',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 109,
                        'rp_topspeed' => 97,
                        'race_type_code' => 'F',
                    ]
                ),
                29 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 3,
                        'runs' => 13,
                        'wins' => 1,
                        'going_group' => 'good',
                        'race_outcome_position' => 10,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => null,
                        'rp_topspeed' => 80,
                        'race_type_code' => 'F',
                    ]
                ),
            ],
            '919889_928591_803906' => [
                0 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 67,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                1 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 82,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                2 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 85,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                3 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 85,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                4 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 74,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                5 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 67,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                6 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 98,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                7 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 85,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                8 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 99,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                9 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 94,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                10 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 9,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 32,
                            'rp_topspeed' => 3,
                            'race_type_code' => 'C',
                        ]
                    ),
                11 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 96,
                            'rp_topspeed' => 44,
                            'race_type_code' => 'C',
                        ]
                    ),
                12 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 8,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 59,
                            'rp_topspeed' => -1,
                            'race_type_code' => 'C',
                        ]
                    ),
                13 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 80,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                14 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 92,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                15 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 94,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                16 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 95,
                            'rp_topspeed' => 85,
                            'race_type_code' => 'C',
                        ]
                    ),
                17 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 92,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                18 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 1,
                            'wins' => 0,
                            'going_group' => 'good_to_soft',
                            'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 90,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                19 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 71,
                            'rp_topspeed' => 20,
                            'race_type_code' => 'C',
                        ]
                    ),
                20 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 803906,
                            'runs' => 20,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => null,
                            'rp_topspeed' => null,
                            'race_type_code' => 'H',
                        ]
                    ),
                21 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 919889,
                            'runs' => 4,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 115,
                            'rp_topspeed' => 90,
                            'race_type_code' => 'B',
                        ]
                    ),
                22 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 919889,
                            'runs' => 4,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 111,
                            'rp_topspeed' => 86,
                            'race_type_code' => 'H',
                        ]
                    ),
                23 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 919889,
                            'runs' => 4,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 126,
                            'rp_topspeed' => 75,
                            'race_type_code' => 'H',
                        ]
                    ),
                24 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 919889,
                            'runs' => 4,
                            'wins' => 2,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => null,
                            'rp_topspeed' => null,
                            'race_type_code' => 'H',
                        ]
                    ),
                25 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 928591,
                            'runs' => 3,
                            'wins' => 1,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 76,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                26 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 928591,
                            'runs' => 3,
                            'wins' => 1,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 86,
                            'rp_topspeed' => null,
                            'race_type_code' => 'P',
                        ]
                    ),
                27 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 928591,
                            'runs' => 1,
                            'wins' => 0,
                            'going_group' => 'good_to_soft',
                            'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 115,
                            'rp_topspeed' => 61,
                            'race_type_code' => 'H',
                        ]
                    ),
                28 =>
                    \Phalcon\Mvc\Model\Row\General::createFromArray(
                        [
                            'horse_uid' => 928591,
                            'runs' => 3,
                            'wins' => 1,
                            'going_group' => 'heavy_soft',
                            'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                            'rp_postmark' => 92,
                            'rp_topspeed' => 77,
                            'race_type_code' => 'H',
                        ]
                    ),
            ],
            '919889_928591_803906_902730_934021_883895_1284539' => [
                0 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 9,
                        'wins' => 1,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 67,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 11,
                        'wins' => 1,
                        'going_group' => 'soft',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 82,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 11,
                        'wins' => 1,
                        'going_group' => 'soft',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 85,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 11,
                        'wins' => 1,
                        'going_group' => 'soft',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 85,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                4 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 9,
                        'wins' => 1,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 74,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                5 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 11,
                        'wins' => 1,
                        'going_group' => 'soft',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 67,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                6 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 11,
                        'wins' => 1,
                        'going_group' => 'soft',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 98,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                7 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 9,
                        'wins' => 1,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 85,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                8 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 9,
                        'wins' => 1,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 99,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                9 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 9,
                        'wins' => 1,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 94,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                10 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 11,
                        'wins' => 1,
                        'going_group' => 'soft',
                        'race_outcome_position' => 9,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 32,
                        'rp_topspeed' => 3,
                        'race_type_code' => 'C',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                11 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 11,
                        'wins' => 1,
                        'going_group' => 'soft',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 96,
                        'rp_topspeed' => 44,
                        'race_type_code' => 'C',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                12 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 11,
                        'wins' => 1,
                        'going_group' => 'soft',
                        'race_outcome_position' => 8,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 59,
                        'rp_topspeed' => -1,
                        'race_type_code' => 'C',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                13 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 11,
                        'wins' => 1,
                        'going_group' => 'soft',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 80,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                14 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 9,
                        'wins' => 1,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 92,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                15 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 9,
                        'wins' => 1,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 94,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                16 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 11,
                        'wins' => 1,
                        'going_group' => 'soft',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 95,
                        'rp_topspeed' => 85,
                        'race_type_code' => 'C',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                17 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 9,
                        'wins' => 1,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 92,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                18 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 1,
                        'wins' => 0,
                        'going_group' => 'good_to_soft',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 90,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                19 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 11,
                        'wins' => 1,
                        'going_group' => 'soft',
                        'race_outcome_position' => 5,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 71,
                        'rp_topspeed' => 20,
                        'race_type_code' => 'C',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                20 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 803906,
                        'runs' => 9,
                        'wins' => 1,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 71,
                        'rp_topspeed' => -1,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 616599,
                        'race_datetime' => 'Dec 26 2014  1:00PM',
                        'course_uid' => 180,
                        'course_name' => 'DOWN ROYAL',
                        'rp_abbrev_3' => 'DRO',
                        'distance_yard' => 4400,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                21 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 883895,
                        'runs' => 3,
                        'wins' => 0,
                        'going_group' => 'soft',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 74,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 668097,
                        'race_datetime' => 'Feb 25 2017  3:55PM',
                        'course_uid' => 37,
                        'course_name' => 'NEWCASTLE',
                        'rp_abbrev_3' => 'NCS',
                        'distance_yard' => 5350,
                        'weight_carried_lbs' => 159,
                        'no_of_runners' => null,
                    ]
                ),
                22 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 883895,
                        'runs' => 1,
                        'wins' => 1,
                        'going_group' => 'good_to_soft',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 81,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 668097,
                        'race_datetime' => 'Feb 25 2017  3:55PM',
                        'course_uid' => 37,
                        'course_name' => 'NEWCASTLE',
                        'rp_abbrev_3' => 'NCS',
                        'distance_yard' => 5350,
                        'weight_carried_lbs' => 159,
                        'no_of_runners' => null,
                    ]
                ),
                23 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 883895,
                        'runs' => 1,
                        'wins' => 1,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 112,
                        'rp_topspeed' => 27,
                        'race_type_code' => 'B',
                        'race_instance_uid' => 668097,
                        'race_datetime' => 'Feb 25 2017  3:55PM',
                        'course_uid' => 37,
                        'course_name' => 'NEWCASTLE',
                        'rp_abbrev_3' => 'NCS',
                        'distance_yard' => 5350,
                        'weight_carried_lbs' => 159,
                        'no_of_runners' => null,
                    ]
                ),
                24 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 883895,
                        'runs' => 2,
                        'wins' => 0,
                        'going_group' => 'good',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 103,
                        'rp_topspeed' => 45,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 668097,
                        'race_datetime' => 'Feb 25 2017  3:55PM',
                        'course_uid' => 37,
                        'course_name' => 'NEWCASTLE',
                        'rp_abbrev_3' => 'NCS',
                        'distance_yard' => 5350,
                        'weight_carried_lbs' => 159,
                        'no_of_runners' => null,
                    ]
                ),
                25 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 883895,
                        'runs' => 2,
                        'wins' => 0,
                        'going_group' => 'good',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 92,
                        'rp_topspeed' => 70,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 668097,
                        'race_datetime' => 'Feb 25 2017  3:55PM',
                        'course_uid' => 37,
                        'course_name' => 'NEWCASTLE',
                        'rp_abbrev_3' => 'NCS',
                        'distance_yard' => 5350,
                        'weight_carried_lbs' => 159,
                        'no_of_runners' => null,
                    ]
                ),
                26 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 883895,
                        'runs' => 3,
                        'wins' => 0,
                        'going_group' => 'soft',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 98,
                        'rp_topspeed' => 65,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 668097,
                        'race_datetime' => 'Feb 25 2017  3:55PM',
                        'course_uid' => 37,
                        'course_name' => 'NEWCASTLE',
                        'rp_abbrev_3' => 'NCS',
                        'distance_yard' => 5350,
                        'weight_carried_lbs' => 159,
                        'no_of_runners' => null,
                    ]
                ),
                27 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 883895,
                        'runs' => 3,
                        'wins' => 0,
                        'going_group' => 'soft',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 103,
                        'rp_topspeed' => 42,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 668097,
                        'race_datetime' => 'Feb 25 2017  3:55PM',
                        'course_uid' => 37,
                        'course_name' => 'NEWCASTLE',
                        'rp_abbrev_3' => 'NCS',
                        'distance_yard' => 5350,
                        'weight_carried_lbs' => 159,
                        'no_of_runners' => null,
                    ]
                ),
                28 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 902730,
                        'runs' => 1,
                        'wins' => 0,
                        'going_group' => 'good_to_soft',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 74,
                        'rp_topspeed' => null,
                        'race_type_code' => 'B',
                        'race_instance_uid' => 641662,
                        'race_datetime' => 'Jan 19 2016  1:25PM',
                        'course_uid' => 3,
                        'course_name' => 'AYR',
                        'rp_abbrev_3' => 'AYR',
                        'distance_yard' => 4500,
                        'weight_carried_lbs' => 154,
                        'no_of_runners' => null,
                    ]
                ),
                29 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 902730,
                        'runs' => 4,
                        'wins' => 0,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 7,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 69,
                        'rp_topspeed' => 21,
                        'race_type_code' => 'B',
                        'race_instance_uid' => 641662,
                        'race_datetime' => 'Jan 19 2016  1:25PM',
                        'course_uid' => 3,
                        'course_name' => 'AYR',
                        'rp_abbrev_3' => 'AYR',
                        'distance_yard' => 4500,
                        'weight_carried_lbs' => 154,
                        'no_of_runners' => null,
                    ]
                ),
                30 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 902730,
                        'runs' => 4,
                        'wins' => 0,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 101,
                        'rp_topspeed' => 32,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 641662,
                        'race_datetime' => 'Jan 19 2016  1:25PM',
                        'course_uid' => 3,
                        'course_name' => 'AYR',
                        'rp_abbrev_3' => 'AYR',
                        'distance_yard' => 4500,
                        'weight_carried_lbs' => 154,
                        'no_of_runners' => null,
                    ]
                ),
                31 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 902730,
                        'runs' => 1,
                        'wins' => 0,
                        'going_group' => 'soft',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 65,
                        'rp_topspeed' => 33,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 641662,
                        'race_datetime' => 'Jan 19 2016  1:25PM',
                        'course_uid' => 3,
                        'course_name' => 'AYR',
                        'rp_abbrev_3' => 'AYR',
                        'distance_yard' => 4500,
                        'weight_carried_lbs' => 154,
                        'no_of_runners' => null,
                    ]
                ),
                32 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 902730,
                        'runs' => 4,
                        'wins' => 0,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 53,
                        'rp_topspeed' => 8,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 641662,
                        'race_datetime' => 'Jan 19 2016  1:25PM',
                        'course_uid' => 3,
                        'course_name' => 'AYR',
                        'rp_abbrev_3' => 'AYR',
                        'distance_yard' => 4500,
                        'weight_carried_lbs' => 154,
                        'no_of_runners' => null,
                    ]
                ),
                33 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 902730,
                        'runs' => 4,
                        'wins' => 0,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 62,
                        'rp_topspeed' => -1,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 641662,
                        'race_datetime' => 'Jan 19 2016  1:25PM',
                        'course_uid' => 3,
                        'course_name' => 'AYR',
                        'rp_abbrev_3' => 'AYR',
                        'distance_yard' => 4500,
                        'weight_carried_lbs' => 154,
                        'no_of_runners' => null,
                    ]
                ),
                34 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 919889,
                        'runs' => 2,
                        'wins' => 2,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 115,
                        'rp_topspeed' => 90,
                        'race_type_code' => 'B',
                        'race_instance_uid' => 666102,
                        'race_datetime' => 'Dec 21 2016  12:50PM',
                        'course_uid' => 1212,
                        'course_name' => 'FFOS LAS',
                        'rp_abbrev_3' => 'Ffo',
                        'distance_yard' => 4812,
                        'weight_carried_lbs' => 160,
                        'no_of_runners' => null,
                    ]
                ),
                35 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 919889,
                        'runs' => 2,
                        'wins' => 0,
                        'going_group' => 'soft',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 117,
                        'rp_topspeed' => 86,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 666102,
                        'race_datetime' => 'Dec 21 2016  12:50PM',
                        'course_uid' => 1212,
                        'course_name' => 'FFOS LAS',
                        'rp_abbrev_3' => 'Ffo',
                        'distance_yard' => 4812,
                        'weight_carried_lbs' => 160,
                        'no_of_runners' => null,
                    ]
                ),
                36 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 919889,
                        'runs' => 2,
                        'wins' => 0,
                        'going_group' => 'soft',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 126,
                        'rp_topspeed' => 75,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 666102,
                        'race_datetime' => 'Dec 21 2016  12:50PM',
                        'course_uid' => 1212,
                        'course_name' => 'FFOS LAS',
                        'rp_abbrev_3' => 'Ffo',
                        'distance_yard' => 4812,
                        'weight_carried_lbs' => 160,
                        'no_of_runners' => null,
                    ]
                ),
                37 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 919889,
                        'runs' => 2,
                        'wins' => 2,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 121,
                        'rp_topspeed' => 24,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 666102,
                        'race_datetime' => 'Jan 17 2017  1:45PM',
                        'course_uid' => 3,
                        'course_name' => 'AYR',
                        'rp_abbrev_3' => 'AYR',
                        'distance_yard' => 5350,
                        'weight_carried_lbs' => 160,
                        'no_of_runners' => null,
                    ]
                ),
                38 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 928591,
                        'runs' => 2,
                        'wins' => 1,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 76,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 660160,
                        'race_datetime' => 'Oct 30 2016  1:00PM',
                        'course_uid' => 8,
                        'course_name' => 'CARLISLE',
                        'rp_abbrev_3' => 'CRL',
                        'distance_yard' => 4408,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                39 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 928591,
                        'runs' => 2,
                        'wins' => 1,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 86,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 660160,
                        'race_datetime' => 'Oct 30 2016  1:00PM',
                        'course_uid' => 8,
                        'course_name' => 'CARLISLE',
                        'rp_abbrev_3' => 'CRL',
                        'distance_yard' => 4408,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                40 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 928591,
                        'runs' => 1,
                        'wins' => 0,
                        'going_group' => 'good_to_soft',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 115,
                        'rp_topspeed' => 61,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 660160,
                        'race_datetime' => 'Oct 30 2016  1:00PM',
                        'course_uid' => 8,
                        'course_name' => 'CARLISLE',
                        'rp_abbrev_3' => 'CRL',
                        'distance_yard' => 4408,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                41 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 928591,
                        'runs' => 1,
                        'wins' => 0,
                        'going_group' => 'soft',
                        'race_outcome_position' => 3,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 92,
                        'rp_topspeed' => 77,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 660160,
                        'race_datetime' => 'Oct 30 2016  1:00PM',
                        'course_uid' => 8,
                        'course_name' => 'CARLISLE',
                        'rp_abbrev_3' => 'CRL',
                        'distance_yard' => 4408,
                        'weight_carried_lbs' => 152,
                        'no_of_runners' => null,
                    ]
                ),
                42 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 934021,
                        'runs' => 3,
                        'wins' => 1,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 6,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 50,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 648378,
                        'race_datetime' => 'May 06 2017  1:50PM',
                        'course_uid' => 3,
                        'course_name' => 'MARKET RASEN',
                        'rp_abbrev_3' => 'MAR',
                        'distance_yard' => 4539,
                        'race_type_code' => 'H',
                        'weight_carried_lbs' => 152,
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'no_of_runners' => null,
                    ]
                ),
                43 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 934021,
                        'runs' => 3,
                        'wins' => 1,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 1,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 88,
                        'rp_topspeed' => null,
                        'race_type_code' => 'P',
                        'race_instance_uid' => 648378,
                        'race_datetime' => 'May 06 2017  1:50PM',
                        'course_uid' => 3,
                        'course_name' => 'MARKET RASEN',
                        'rp_abbrev_3' => 'MAR',
                        'distance_yard' => 4539,
                        'race_type_code' => 'H',
                        'weight_carried_lbs' => 152,
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'no_of_runners' => null,
                    ]
                ),
                44 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 934021,
                        'runs' => 1,
                        'wins' => 0,
                        'going_group' => 'good',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 106,
                        'rp_topspeed' => 26,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 648378,
                        'race_datetime' => 'May 06 2017  1:50PM',
                        'course_uid' => 3,
                        'course_name' => 'MARKET RASEN',
                        'rp_abbrev_3' => 'MAR',
                        'distance_yard' => 4539,
                        'race_type_code' => 'H',
                        'weight_carried_lbs' => 152,
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'no_of_runners' => null,
                    ]
                ),
                45 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 934021,
                        'runs' => 1,
                        'wins' => 0,
                        'going_group' => 'soft',
                        'race_outcome_position' => 4,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 108,
                        'rp_topspeed' => 68,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 666102,
                        'race_datetime' => 'Dec 15 2016  3:10PM',
                        'course_uid' => 14,
                        'course_name' => 'EXETER',
                        'rp_abbrev_3' => 'EXE',
                        'distance_yard' => 5085,
                        'weight_carried_lbs' => 154,
                        'no_of_runners' => null,
                    ]
                ),
                46 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                    [
                        'horse_uid' => 934021,
                        'runs' => 3,
                        'wins' => 1,
                        'going_group' => 'heavy',
                        'race_outcome_position' => 2,
                        'race_outcome_form_char' => 'U',
                        'rp_postmark' => 109,
                        'rp_topspeed' => 18,
                        'race_type_code' => 'H',
                        'race_instance_uid' => 666102,
                        'race_datetime' => 'Jan 17 2017  1:45PM',
                        'course_uid' => 3,
                        'course_name' => 'AYR',
                        'rp_abbrev_3' => 'AYR',
                        'distance_yard' => 5350,
                        'weight_carried_lbs' => 160,
                        'no_of_runners' => null,
                    ]
                ),
            ],
        ];
        
        return $res[$key];
    }
}
