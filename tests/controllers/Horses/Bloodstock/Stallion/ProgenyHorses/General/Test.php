<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Bloodstock\Stallion\ProgenyHorses\General;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;
use \Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyHorses;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Bloodstock\Stallion\ProgenyHorses\General
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/bloodstock/stallion/531769/progeny-horses';
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
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenySeason:45 ->getFirstLastProgenyRaceDatetime()
            '209486d31066476871a5858697f9460a' => [
                [
                    'first_race' => '2005-05-27 16:00:00',
                    'last_race' => '2018-05-24 14:05:00',
                ],
            ],
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenySeason:71 ->getAppropriateSeasons()
            'b0fdb430ba9213422408b4006e35537f' => [
                [
                    'season_start_date' => '2005-01-01 00:00:00',
                    'season_end_date' => '2005-12-31 23:58:00',
                    'season_type_code' => 'F',
                ],
                [
                    'season_start_date' => '2005-04-24 00:00:00',
                    'season_end_date' => '2006-04-29 23:59:00',
                    'season_type_code' => 'J',
                ],
            ],
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenySeason:71 ->getAppropriateSeasons()
            '14be7d4f33c48efad7e54ceca777ee92' => [
                [
                    'season_start_date' => '2018-01-01 00:00:00',
                    'season_end_date' => '2018-12-31 23:59:00',
                    'season_type_code' => 'F',
                ],
                [
                    'season_start_date' => '2018-04-29 00:00:00',
                    'season_end_date' => '2019-04-27 23:59:00',
                    'season_type_code' => 'I',
                ],
                [
                    'season_start_date' => '2018-04-29 00:00:00',
                    'season_end_date' => '2019-04-27 23:59:00',
                    'season_type_code' => 'J',
                ],
            ],
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenySeason:128 ->getDefaultProgenyRaceType()
            'de8616d402c36a2a405e3b51d4a718bb' => [
                [
                    'flat' => 12266,
                    'jumps' => 2740,
                ],
            ],
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyHorses:243 ->getProgenyHorses()
            'b7e091a08b523f34fc4b0003dae24627' => [
            ],
            //Api\DataProvider\Bo\Bloodstock\Stallion\ProgenyHorses:283 ->getProgenyHorses()
            '1022d7c31b142dd786e2f3d55827e107' => [
                [
                    'horse_uid' => 657246,
                    'style_name' => 'Inchmahome',
                    'horse_sex_code' => 'M',
                    'horse_date_of_birth' => '2006-02-12 00:00:00',
                    'horse_age' => 16,
                    'country_origin_code' => 'GB',
                    'runs' => 6,
                    'wins' => 1,
                    'places' => 0,
                    'total_prize_money' => 2590.8,
                    'dam_sire_uid' => 301383,
                    'dam_sire_style_name' => 'Lomond',
                    'dam_sire_country_origin_code' => 'USA',
                    'rp_postmark' => 67,
                    'best_or' => 66,
                ],
                [
                    'horse_uid' => 646234,
                    'style_name' => 'Starship',
                    'horse_sex_code' => 'M',
                    'horse_date_of_birth' => '2006-02-12 00:00:00',
                    'horse_age' => 16,
                    'country_origin_code' => 'IRE',
                    'runs' => 7,
                    'wins' => 3,
                    'places' => 1,
                    'total_prize_money' => 12837.74,
                    'dam_sire_uid' => 300903,
                    'dam_sire_style_name' => 'General Assembly',
                    'dam_sire_country_origin_code' => 'USA',
                    'rp_postmark' => 85,
                    'best_or' => 82,
                ]
            ],
            //Api\Mvc\DataProvider\TemporaryTable:85 ->dropTemporaryTable()
            '70ccb2daf31243f4720f49de5fa7d01f' => [
            ],
        ];
    }
}
