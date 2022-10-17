<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\RaceCards\Topspeed;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\RaceCards\Topspeed
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/racecards/topspeed/695164/2018-03-22';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\RaceCards\PreHorseRace:66 ->getTopspeedHorses()
            '1d9cb9ae902980b31684b476cdc2ceb7' => [
                [
                    'horse_style_name' => 'Swendab',
                    'horse_country_origin_code' => 'IRE',
                    'weight_carried_lbs' => 133,
                    'race_status_code' => 'R',
                    'race_type_code' => 'X',
                    'horse_uid' => 758627,
                    'horse_age' => 10,
                    'rp_topspeed_old' => null,
                    'rp_topspeed' => 64,
                    'rp_postmark' => 78,
                    'rp_pm_chars' => null,
                    'race_datetime' => '2018-03-22 14:10:00',
                    'adjustment' => null,
                    'wfa_allow' => 19,
                    'topspeed_wfa_allow' => 14,
                    'country_code' => 'GB ',
                    'course_name' => 'WOLVERHAMPTON (A.W)',
                    'course_uid' => 513,
                    'rp_going_type_desc' => 'STAND',
                    'distance_yard' => 1121,
                    'race_group_code' => 'H',
                    'extra_weight_lbs' => 0,
                    'trainer_uid' => 12,
                    'race_instance_uid' => 695164,
                ]
            ],
            //Models\Bo\RaceCards\HorseRace:91 ->getTopspeedLastYear()
            'ed622039a2296c5cfcce23408b270991' => [
                [
                    'horse_uid' => 758627,
                    'rp_postmark' => 72,
                    'rp_topspeed' => -1,
                    'course_uid' => 1083,
                    'course_name' => 'CHELMSFORD (A.W)',
                    'course_style_name' => 'Chelmsford (A.W)',
                    'rp_abbrev_4' => 'chlm',
                    'race_instance_uid' => 682605,
                    'race_datetime' => '2017-09-07 20:40:00',
                    'race_type_code' => 'X',
                    'race_instance_title' => 'Bet toteWIN At betfred.com Handicap',
                    'distance_yard' => 1320,
                    'rp_close_up_comment' => 'chased leaders, soon steadied to track leaders and travelled strongly, not clear run over 2f out until ridden and headway to chase leader just over 1f out, stayed on under pressure to lead last stride',
                    'race_outcome_code' => '1  ',
                    'services_desc' => 'St    ',
                    'race_group_code' => 'H',
                    'no_runners' => 12,
                ]
            ],
            //Models\Bo\RaceCards\HorseRace:173 ->getTopspeedGoing()
            'fc789b729780740599dfd25446ecc3b2' => [
                [
                    'horse_uid' => 758627,
                    'rp_postmark' => 69,
                    'rp_topspeed' => 61,
                    'course_uid' => 513,
                    'course_name' => 'WOLVERHAMPTON (A.W)',
                    'course_style_name' => 'Wolverhampton (A.W)',
                    'course_region' => 'GB & IRE',
                    'rp_abbrev_4' => 'wolv',
                    'race_instance_uid' => 563989,
                    'race_datetime' => '2012-10-12 19:15:00',
                    'race_type_code' => 'X',
                    'race_instance_title' => '32Red.com Handicap',
                    'distance_yard' => 1316,
                    'rp_close_up_comment' => 'mid-division, driven along halfway, stayed on under pressure inside final furlong, never nearer',
                    'race_outcome_code' => '5  ',
                    'services_desc' => 'St    ',
                    'race_group_code' => 'H',
                    'no_runners' => 13,
                ]
            ],
            //Models\Bo\RaceCards\HorseRace:258 ->getTopspeedDistance()
            '5d73ad72a61b31e9e0ea38ef08b33a2c' => [
                [
                    'horse_uid' => 758627,
                    'rp_postmark' => 78,
                    'rp_topspeed' => 78,
                    'course_uid' => 93,
                    'course_name' => 'WINDSOR',
                    'course_style_name' => 'Windsor',
                    'rp_abbrev_4' => 'wind',
                    'race_instance_uid' => 536822,
                    'race_datetime' => '2011-08-15 20:10:00',
                    'race_type_code' => 'F',
                    'race_instance_title' => 'Mr & Mrs Kleyns 30th Wedding Anniversary Handicap',
                    'distance_yard' => 1121,
                    'rp_close_up_comment' => 'led or disputed throughout and raced in centre, joined over 1f out, driven to assert inside final furlong',
                    'race_outcome_code' => '1  ',
                    'services_desc' => 'GF    ',
                    'race_group_code' => 'H',
                    'no_runners' => 12,
                ]
            ],
            //Models\Bo\RaceCards\HorseRace:352 ->getTopspeedCourse()
            'ab2f7f941ff83542293cdb8d13e615b8' => [
                [
                    'horse_uid' => 758627,
                    'rp_postmark' => 69,
                    'rp_topspeed' => 61,
                    'course_uid' => 513,
                    'course_name' => 'WOLVERHAMPTON (A.W)',
                    'course_style_name' => 'Wolverhampton (A.W)',
                    'rp_abbrev_4' => 'wolv',
                    'race_instance_uid' => 563989,
                    'race_datetime' => '2012-10-12 19:15:00',
                    'race_type_code' => 'X',
                    'race_instance_title' => '32Red.com Handicap',
                    'distance_yard' => 1316,
                    'rp_close_up_comment' => 'mid-division, driven along halfway, stayed on under pressure inside final furlong, never nearer',
                    'race_outcome_code' => '5  ',
                    'services_desc' => 'St    ',
                    'race_group_code' => 'H',
                    'no_runners' => 13,
                ]
            ],
            //Models\Bo\RaceCards\HorseRace:426 ->getLast6HorseRacesTopspeeds()
            '245225d941af9c0ebe8e92328ba8fe32' => [
                [
                    'race_instance_uid' => 694242,
                    'race_datetime' => '2018-03-10 13:30:00',
                    'rp_topspeed' => 65,
                    'race_type_code' => 'X',
                    'course_uid' => 513,
                    'course_name' => 'WOLVERHAMPTON (A.W)',
                    'course_style_name' => 'Wolverhampton (A.W)',
                    'rp_abbrev_4' => 'wolv',
                    'distance_yard' => 1121,
                    'services_desc' => 'St    ',
                    'race_outcome_position' => 2,
                    'race_outcome_code' => '2  ',
                    'rp_postmark' => 69,
                    'rp_close_up_comment' => 'always prominent, shaken up to chase winner over 1f out, ridden and edged left inside final furlong, stayed on',
                    'race_group_code' => null,
                    'no_runners' => 6,
                ]
            ],

            //Models\Bo\RaceCards\RaceInstance:3935 ->getRaceAdditionalData()
            '7335c6a359bb835b03046935faecd62e' => [
                [
                    'race_status_code' => 'O',
                ],
            ],
            //Models\Bo\RaceCards\RaceInstance:4028 ->getRaceAdditionalData()
            '5969d1d4d00391fdf2d5d409f99f6d22' => [
                [
                    'race_instance_uid' => 695164,
                    'distance_yard' => 1121,
                    'race_datetime' => '2018-03-22 14:10:00',
                    'race_type_code' => 'X',
                    'race_group_code' => 'H',
                    'country_code' => 'GB ',
                    'min_weight' => 119,
                    'race_status_code' => 'R',
                    'weight_adjustment' => 140,
                    'min_age' => 4,
                    'max_age' => 10,
                    'top_age' => 0,
                    'furlong' => 5.0,
                ],
            ],
            //Models\Bo\RaceCards\TipsterSelection:75 ->getTopspeedSelection()
            '5fe16f8f900d25eec093866059c0b10c' => [
                [
                    'style_name' => 'Newstead Abbey',
                    'country_origin_code' => 'GB',
                    'horse_uid' => 810178,
                    'selection_type_uid' => 1,
                ],
            ],
            //provider/DataProvider/Bo/Rpr.php -> getRprStatistics()
            '49d86233f0fdb35c3da8755de3c361d0' => [

            ],
            //models/Bo/RaceCards/RaceInstance.php:3953 -> getHorsesTopspeed()
            'cb7b85f7c1c9c33be23c7b8eb1d8cc47' => [

            ]
        ];
    }
}
