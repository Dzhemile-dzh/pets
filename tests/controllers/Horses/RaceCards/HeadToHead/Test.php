<?php
declare(strict_types=1);

namespace Tests\Controllers\Horses\RaceCards\HeadToHead;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\RaceCards\Runners
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/racecards/734972/head-to-head';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //models/Bo/RaceCards/RaceInstance.php -> getRaceRunners()
            '0d54eb4ab03b0620c9cab0567934bea6' => [
                [
                    'horse_uid' => 1856912,
                    'horse_number' => 1
                ],
                [
                    'horse_uid' => 893876,
                    'horse_number' => 2
                ],
                [
                    'horse_uid' => 1111,
                    'horse_number' => 3
                ],
                [
                    'horse_uid' => 2222,
                    'horse_number' => 4
                ],
                [
                    'horse_uid' => 4444,
                    'horse_number' => 5
                ]
            ],
            //provider/DataProvider/Bo/HeadToHead/HeadToHead.php -> getData()
            '012077e4f262c592bc8eac07720d57cb' => [
                [
                    'race_instance_uid' => 734063,
                    'race_datetime' => '2019-07-20 14:30:00.000',
                    'course_name' => 'STRATFORD',
                    'course_style_name' =>  'Stratford',
                    'course_uid' => 67,
                    'race_type_code' => 'H',
                    'no_of_runners' => 10,
                    'going_type_desc' => 'Good To Soft',
                    'distance_yard' => 3786,

                    'horse_style_name' => 'Goodgollymissjolly',
                    'horse_uid' => 1856912,
                    'horse_country_origin_code' =>  'IRE',
                    'horse_sex_code' => 'M',
                    'race_outcome_code' => '3',
                    'odds_desc' => '28/1',
                    'odds_value' => 28,
                    'saddle_cloth_no' => 4,
                    'official_rating_ran_off' => 42,
                    'rp_postmark' => 42,
                    'jockey_style_name' => 'Bryony Frost',
                    'weight_allowance_lbs' => 0,
                    'trainer_style_name' => 'Jimmy'
                ],
                [
                    'race_instance_uid' => 734063,
                    'race_datetime' => '2019-07-20 14:30:00.000',
                    'course_name' => 'STRATFORD',
                    'course_style_name' =>  'Stratford',
                    'course_uid' => 67,
                    'race_type_code' => 'H',
                    'no_of_runners' => 10,
                    'going_type_desc' => 'Good To Soft',
                    'distance_yard' => 3786,

                    'horse_style_name' => 'Annieareyouok',
                    'horse_uid' => 893876,
                    'horse_country_origin_code' => 'IRE',
                    'horse_sex_code' => 'M',
                    'race_outcome_code' => '1',
                    'odds_desc' => '28/1',
                    'odds_value' => 28,
                    'saddle_cloth_no' => 4,
                    'official_rating_ran_off' => 42,
                    'rp_postmark' => 42,
                    'jockey_style_name' => 'Jason',
                    'weight_allowance_lbs' => 0,
                    'trainer_style_name' => 'Lady'
                ]
            ],
            //models/HorseRace.php -> getHorsesForm()
            'c94a3f870df913383d0d9c76690982cd' => [
                [
                    'horse_uid' => 893876,
                    'race_instance_uid' => 693335,
                    'race_datetime' => '2018-02-23 18:15:00',
                    'race_type_code' => 'X',
                    'race_outcome_position' => 10,
                    'race_outcome_form_char' => '0',
                ],
                [
                    'horse_uid' => 893876,
                    'race_instance_uid' => 691625,
                    'race_datetime' => '2018-01-18 21:00:00',
                    'race_type_code' => 'X',
                    'race_outcome_position' => 1,
                    'race_outcome_form_char' => '1',
                ],
                [
                    'horse_uid' => 893876,
                    'race_instance_uid' => 691108,
                    'race_datetime' => '2018-01-11 20:00:00',
                    'race_type_code' => 'X',
                    'race_outcome_position' => 2,
                    'race_outcome_form_char' => '2',
                ],
            ],
            //models/HorseRace.php -> getHorsesForm()
            'f36daf60a021eb8d41ce47ff6ecee50c' => [
                [
                    'horse_uid' => 1856912,
                    'race_instance_uid' => 693335,
                    'race_datetime' => '2018-02-23 18:15:00',
                    'race_type_code' => 'B',
                    'race_outcome_position' => 11,
                    'race_outcome_form_char' => '0',
                ],
                [
                    'horse_uid' => 1856912,
                    'race_instance_uid' => 691625,
                    'race_datetime' => '2018-01-18 21:00:00',
                    'race_type_code' => 'B',
                    'race_outcome_position' => 2,
                    'race_outcome_form_char' => '2',
                ],
                [
                    'horse_uid' => 1856912,
                    'race_instance_uid' => 691108,
                    'race_datetime' => '2018-01-11 20:00:00',
                    'race_type_code' => 'B',
                    'race_outcome_position' => 5,
                    'race_outcome_form_char' => '5',
                ],
            ],
            //models/Season.php -> getLastNumberSeasons()
            'cec5a488f050bf2e35b9e099df0760c3' => [
                [
                    'season_start_date' => '2019-01-01 00:00:00'
                ]
            ],
            //models/Season.php -> getLastNumberSeasons()
            '0337b7228f50a0e822504daa59d22332' => [
                [
                    'season_start_date' => '2019-01-01 00:00:00'
                ]
            ],
            //provider/DataProvider/Bo/HeadToHead/HeadToHead.php -> getStatistics()
            '8897c3667411113871e06051bddc511a' => [
                [
                    'horse_uid' => 1856912,
                    'starts' => 5,
                    'wins' => 2,
                    'seconds' => 1,
                    'thirds' => 0,
                    'net_total_prize' => 3214,
                    'rp_topspeed' => 20,
                    'rp_postmark' => 30,
                    'stake' => 163,
                    'flat_figures_calculated' => null,
                    'jumps_figures_calculated' => null
                ],
                [
                    'horse_uid' => 893876,
                    'starts' => 3,
                    'wins' => 0,
                    'seconds' => 1,
                    'thirds' => 0,
                    'net_total_prize' => 32,
                    'rp_topspeed' => 80,
                    'rp_postmark' => 30,
                    'stake' => 0,
                    'flat_figures_calculated' => null,
                    'jumps_figures_calculated' => null
                ]
            ],
            //provider/DataProvider/Bo/HeadToHead/HeadToHead.php -> getEntries()
            '02a55e3dce94858d1919dd0f0553cadc' => [
                [
                    'race_instance_uid' => 734063,
                    'race_datetime' => '2019-07-20 14:30:00.000',
                    'course_name' => 'STRATFORD',
                    'course_style_name' =>  'Stratford',
                    'race_instance_title' => 'title',
                    'race_status_code' => 'O',
                    'race_type_code' => 'H',
                    'distance_yard' => 3786,

                    'horse_style_name' => 'Goodgollymissjolly',
                    'horse_uid' => 1856912,
                    'saddle_cloth_no' => 4,
                    'jockey_style_name' => 'Bryony Frost',
                ],
                [
                    'race_instance_uid' => 734063,
                    'race_datetime' => '2019-07-20 14:30:00.000',
                    'course_name' => 'STRATFORD',
                    'course_style_name' =>  'Stratford',
                    'race_instance_title' => 'title',
                    'race_status_code' => 'O',
                    'race_type_code' => 'H',
                    'distance_yard' => 3786,

                    'horse_style_name' => 'Annieareyouok',
                    'horse_uid' => 893876,
                    'saddle_cloth_no' => 4,
                    'jockey_style_name' => 'Mark',
                ],
            ]

        ];
    }
    /**
     * @return array
     */
    public function getReplacement(): array
    {
        return [
            'season_start_date' => '2019-01-01 00:00:00'
        ];
    }
}
