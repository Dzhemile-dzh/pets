<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Bloodstock\Stallion\ProgenyResults\WithParams;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;
use \Api\DataProvider\Bo\Bloodstock\Stallion\Stallion;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Bloodstock\Stallion\ProgenyHorses\WithParams
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/bloodstock/stallion/734508/progeny-results/2017/2018/GB/jumps?month=1';
    }

    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        Stallion::clear();
    }
    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyResults:66 ->getProgenyResults()
            '17119f86f2d54b245b029f4a0b2e7779' => [
            ],
            //Models\Bo\Selectors\Database:184 ->getOneSeasonData()
            'eccd10dcaa98ecb7e7bb95e56ce8aa67' => [
                [
                    'seasonDateBegin' => '2017-04-30 00:00:00',
                    'seasonDateEnd' => '2018-04-29 23:59:00',
                ],
            ],
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyResults:129 ->getProgenyResults()
            '46ac746cab4185efe0871b853538e4d8' => [
                [
                    'horse_uid' => 1273384,
                    'country_origin_code' => 'FR',
                    'style_name' => 'Sommervieu',
                    'rp_postmark' => 18,
                    'rp_topspeed' => -1,
                    'official_rating_ran_off' => 120,
                    'race_instance_uid' => 691733,
                    'race_datetime' => '2018-01-27 12:55:00',
                    'race_instance_title' => 'grandnational.fans Handicap Hurdle',
                    'distance_yard' => 4268,
                    'race_type_code' => 'H',
                    'going_type_code' => 'S',
                    'no_of_runners' => null,
                    'race_group_desc' => 'Handicap',
                    'race_group_code' => 'H',
                    'race_outcome_position' => 13,
                    'race_outcome_code' => '13 ',
                    'country_code' => 'GB ',
                    'course_uid' => 15,
                    'course_name' => 'Doncaster',
                    'prize_money' => 4093.74,
                    'prize_money_euro' => 4625.9262,
                    'actual_race_class' => '4',
                    'no_of_runners_calculated' => 14,
                    'rp_ages_allowed_desc' => '4yo+',
                    'course_rp_abbrev_3' => 'DON',
                    'course_region' => 'GB & IRE'
                ],
                [
                    'horse_uid' => 1273384,
                    'country_origin_code' => 'FR',
                    'style_name' => 'Sommervieu',
                    'rp_postmark' => 92,
                    'rp_topspeed' => 16,
                    'official_rating_ran_off' => 0,
                    'race_instance_uid' => 690603,
                    'race_datetime' => '2018-01-03 13:20:00',
                    'race_instance_title' => 'Best Wishes For 2018 Juvenile Hurdle',
                    'distance_yard' => 3469,
                    'race_type_code' => 'H',
                    'going_type_code' => 'S',
                    'no_of_runners' => null,
                    'race_group_desc' => 'Unknown',
                    'race_group_code' => '0',
                    'race_outcome_position' => 4,
                    'race_outcome_code' => '4  ',
                    'country_code' => 'GB ',
                    'course_uid' => 34,
                    'course_name' => 'Ludlow',
                    'prize_money' => 4938.48,
                    'prize_money_euro' => 5580.4824,
                    'actual_race_class' => '4',
                    'no_of_runners_calculated' => 6,
                    'rp_ages_allowed_desc' => '4yo',
                    'course_rp_abbrev_3' => 'LUD',
                    'course_region' => 'GB & IRE'
                ],
            ],
            //Models\Bo\Selectors\Database:184 ->getOneSeasonData()
            'eccd10dcaa98ecb7e7bb95e56ce8aa67' => [
                [
                    'seasonDateBegin' => '2017-04-30 00:00:00',
                    'seasonDateEnd' => '2018-04-29 23:59:00',
                ],
            ],
            //Models\Bo\Selectors\Database:184 ->getOneSeasonData()
            'eccd10dcaa98ecb7e7bb95e56ce8aa67' => [
                [
                    'seasonDateBegin' => '2017-04-30 00:00:00',
                    'seasonDateEnd' => '2018-04-29 23:59:00',
                ],
            ],
            //Api\Mvc\DataProvider\TemporaryTable:85 ->dropTemporaryTable()
            '52c86dce42960ce6b09e3745c847f1b6' => [
            ],
        ];
    }
}
