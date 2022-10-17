<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Bloodstock\Stallion\DamSireProgenyHorses\WithParams;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;
use \Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyHorses;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Bloodstock\Stallion\DamSireProgenyHorses\WithParams
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/bloodstock/stallion/531769/dam-sire-progeny-horses/flat/2017/2018/5?age=4%2B';
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
            '5eafd4ebe0c4a0cb23d83ddee4abb7e5' => [
                [
                    'startDate' => '2017-01-01 00:00:00',
                ],
            ],
            //Models\Bo\Selectors\Database:97 ->getSeasonDateEnd()
            'fc70f4b2bf8c3146734511cf649c9503' => [
                [
                    'endDate' => '2018-12-31 23:59:00',
                ],
            ],
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyHorses:243 ->getProgenyHorses()
            '6683cbe2c5cb6f3bd903912ed6c341e0' => [
            ],
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyHorses:283 ->getProgenyHorses()
            '128bc1af1c2455cd66858aad99bdfc32' => [
                [
                    'horse_uid' => 998306,
                    'style_name' => 'Asaas',
                    'horse_sex_code' => 'G',
                    'horse_age' => 4,
                    'country_origin_code' => 'USA',
                    'runs' => 4,
                    'wins' => 1,
                    'places' => 2,
                    'total_prize_money' => 4924.5,
                    'sire_uid' => 476627,
                    'sire_style_name' => 'Distorted Humor',
                    'sire_country_origin_code' => 'USA',
                    'dam_sire_uid' => 531769,
                    'dam_sire_style_name' => 'Galileo',
                    'dam_sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 86,
                    'best_or' => 81,
                ],
                [
                    'horse_uid' => 964697,
                    'style_name' => 'Whosyourhousemate',
                    'horse_sex_code' => 'G',
                    'horse_age' => 4,
                    'country_origin_code' => 'GB',
                    'runs' => 6,
                    'wins' => 2,
                    'places' => 3,
                    'total_prize_money' => 13775.38,
                    'sire_uid' => 448003,
                    'sire_style_name' => 'Bahamian Bounty',
                    'sire_country_origin_code' => 'GB',
                    'dam_sire_uid' => 531769,
                    'dam_sire_style_name' => 'Galileo',
                    'dam_sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 86,
                    'best_or' => 82,
                ],
                [
                    'horse_uid' => 840753,
                    'style_name' => 'Starlit Cantata',
                    'horse_sex_code' => 'M',
                    'horse_age' => 7,
                    'country_origin_code' => 'GB',
                    'runs' => 1,
                    'wins' => 0,
                    'places' => 0,
                    'total_prize_money' => null,
                    'sire_uid' => 596219,
                    'sire_style_name' => 'Oratorio',
                    'sire_country_origin_code' => 'IRE',
                    'dam_sire_uid' => 531769,
                    'dam_sire_style_name' => 'Galileo',
                    'dam_sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 76,
                    'best_or' => 77,
                ],
                [
                    'horse_uid' => 1774333,
                    'style_name' => 'Wicket',
                    'horse_sex_code' => 'G',
                    'horse_age' => 4,
                    'country_origin_code' => 'GB',
                    'runs' => 5,
                    'wins' => 0,
                    'places' => 0,
                    'total_prize_money' => null,
                    'sire_uid' => 503875,
                    'sire_style_name' => 'Dansili',
                    'sire_country_origin_code' => 'GB',
                    'dam_sire_uid' => 531769,
                    'dam_sire_style_name' => 'Galileo',
                    'dam_sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 51,
                    'best_or' => 54,
                ],
                [
                    'horse_uid' => 864623,
                    'style_name' => 'Solar Flair',
                    'horse_sex_code' => 'G',
                    'horse_age' => 6,
                    'country_origin_code' => 'GB',
                    'runs' => 10,
                    'wins' => 1,
                    'places' => 1,
                    'total_prize_money' => 18178.1,
                    'sire_uid' => 692355,
                    'sire_style_name' => 'Equiano',
                    'sire_country_origin_code' => 'FR',
                    'dam_sire_uid' => 531769,
                    'dam_sire_style_name' => 'Galileo',
                    'dam_sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 108,
                    'best_or' => 104,
                ],
                [
                    'horse_uid' => 1047702,
                    'style_name' => 'Epsom Secret',
                    'horse_sex_code' => 'F',
                    'horse_age' => 4,
                    'country_origin_code' => 'GB',
                    'runs' => 11,
                    'wins' => 1,
                    'places' => 4,
                    'total_prize_money' => 5510.75,
                    'sire_uid' => 661629,
                    'sire_style_name' => 'Sakhee\'s Secret',
                    'sire_country_origin_code' => 'GB',
                    'dam_sire_uid' => 531769,
                    'dam_sire_style_name' => 'Galileo',
                    'dam_sire_country_origin_code' => 'IRE',
                    'rp_postmark' => 61,
                    'best_or' => 59,
                ],
            ],
            //Api\Mvc\DataProvider\TemporaryTable:85 ->dropTemporaryTable()
            '70ccb2daf31243f4720f49de5fa7d01f' => [
            ],
        ];
    }
}
