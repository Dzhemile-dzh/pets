<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Bloodstock\Stallion\ProgenyHorses\WithParams;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;
use \Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyHorses;

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
        return '/horses/bloodstock/stallion/531769/progeny-horses/flat/2016/2017/5?age=3&number=2';
    }

    /**
     * @inheritdoc
     */
    public function tearDown()
    {
        ProgenyHorses::clear();
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\Selectors\Database:40 ->getSeasonDateBegin()
            '4ad21d5c39915a80b910c90eb63d50b7' => [
                [
                    'startDate' => '2016-01-01 00:00:00',
                ],
            ],
            //Models\Bo\Selectors\Database:97 ->getSeasonDateEnd()
            '868a3f19c21e54495c46302433121387' => [
                [
                    'endDate' => '2017-12-31 23:59:00',
                ],
            ],
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyHorses:243 ->getProgenyHorses()
            'c52a3435383eb39210782a8733ee7e3c' => [
            ],
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyHorses:283 ->getProgenyHorses()
            'aadf64d84e0e3251a509e2853799cada' => [
                [
                    'horse_uid' => 1017308,
                    'style_name' => 'Butterflies',
                    'horse_sex_code' => 'F',
                    'horse_age' => 3,
                    'horse_date_of_birth' => '2006-02-12 00:00:00',
                    'country_origin_code' => 'IRE',
                    'runs' => 10,
                    'wins' => 1,
                    'places' => 3,
                    'total_prize_money' => 26968.1059,
                    'dam_sire_uid' => 13903,
                    'dam_sire_style_name' => 'Rahy',
                    'dam_sire_country_origin_code' => 'USA',
                    'rp_postmark' => 99,
                    'best_or' => 99,
                ],
                [
                    'horse_uid' => 1212999,
                    'style_name' => 'Inconceivable',
                    'horse_sex_code' => 'F',
                    'horse_age' => 3,
                    'horse_date_of_birth' => '2006-02-12 00:00:00',
                    'country_origin_code' => 'IRE',
                    'runs' => 8,
                    'wins' => 0,
                    'places' => 7,
                    'total_prize_money' => 6230.8,
                    'dam_sire_uid' => 302250,
                    'dam_sire_style_name' => 'Shirley Heights',
                    'dam_sire_country_origin_code' => 'GB',
                    'rp_postmark' => 81,
                    'best_or' => 77,
                ],
                [
                    'horse_uid' => 1025020,
                    'style_name' => 'Wild Irish Rose',
                    'horse_sex_code' => 'F',
                    'horse_age' => 3,
                    'horse_date_of_birth' => '2006-02-12 00:00:00',
                    'country_origin_code' => 'IRE',
                    'runs' => 15,
                    'wins' => 2,
                    'places' => 3,
                    'total_prize_money' => 51685.1924,
                    'dam_sire_uid' => 49087,
                    'dam_sire_style_name' => 'Royal Academy',
                    'dam_sire_country_origin_code' => 'USA',
                    'rp_postmark' => 104,
                    'best_or' => 102,
                ]
            ],
            //Api\Mvc\DataProvider\TemporaryTable:85 ->dropTemporaryTable()
            '70ccb2daf31243f4720f49de5fa7d01f' => [
            ],
        ];
    }
}
