<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Races\Favourites;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\Races
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/races/favourites?date=2030-01-01';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //\Bo\races\favourites\303 ->getDateRaces()
            '34c3c80d451743a4930f6e06c62298ed' => [
                'races' => [
                    'race_instance_uid' => 763077,
                ],
                [
                    'race_instance_uid' => 763333,
                ],
            ],
            //\Bo\racecards\runners\303 ->createTmpTableMain()
            '518f419b3c01d27b546965cd28dce50d' => [],

            //\Bo\racecards\runners\43 ->getRunners()
            '71cbc348099584b9d04f196109755aab' => [
                // ensure we grab the correct horse with lowest odds
                [
                    'race_instance_uid' => 763077,
                    'horse_uid' => 3098705,
                    'race_type_code' => 'O',
                    'uid' => 3098705,
                    'saddle_cloth_no' => 3,
                    'non_runner' => null,
                    'draw' => 0,
                    'trainer_uid' => 32276,
                    'trainer_style_name' => 'Archie Watson',
                    'owner_uid' => 90186,
                    'owner_name' => 'Stephen Curran',
                    'jockey_uid' => 5555,
                    'jockey_name' => 'Tom Jackson',
                    'allowance' => 0,
                    'horse_name' => 'Secret Handsheikh',
                    'country_origin_code' => 'GB',
                    'forecast_odds_value' => 10,
                ],
                [
                    'race_instance_uid' => 763077,
                    'horse_uid' => 999999,
                    'uid' => 999999,
                    'race_type_code' => 'O',
                    'non_runner' => null,
                    'saddle_cloth_no' => 2,
                    'draw' => 0,
                    'trainer_uid' => 999999,
                    'trainer_style_name' => 'Jack Nick',
                    'owner_uid' => 999999,
                    'owner_name' => 'Adrian Wintle',
                    'jockey_uid' => 999999,
                    'jockey_name' => 'Jerry Smith',
                    'allowance' => 0,
                    'horse_name' => 'Hello Dude',
                    'country_origin_code' => 'GB',
                    'forecast_odds_value' => null
                ],
                [
                    'race_instance_uid' => 763077,
                    'race_type_code' => 'O',
                    'non_runner' => null,
                    'horse_uid' => 888888,
                    'uid' => 888888,
                    'saddle_cloth_no' => 1,
                    'draw' => 0,
                    'trainer_uid' => 888888,
                    'trainer_style_name' => 'Abdul G',
                    'owner_uid' => 888888,
                    'owner_name' => 'Adrian Wintle',
                    'jockey_uid' => 888888,
                    'jockey_name' => 'Matt Damon',
                    'allowance' => 0,
                    'horse_name' => 'George The One',
                    'country_origin_code' => 'IRE',
                    'forecast_odds_value' => 15,
                ],
                // check if we grab the correct horse when 2 horses have same odds
                [
                    'race_instance_uid' => 111111,
                    'race_type_code' => 'O',
                    'horse_uid' => 777777,
                    'uid' => 777777,
                    'non_runner' => null,
                    'saddle_cloth_no' => 1,
                    'draw' => 0,
                    'trainer_uid' => 777777,
                    'trainer_style_name' => 'A',
                    'owner_uid' => 777777,
                    'owner_name' => 'A',
                    'jockey_uid' => 777777,
                    'jockey_name' => 'A',
                    'allowance' => 0,
                    'horse_name' => 'A',
                    'country_origin_code' => 'IRE',
                    'forecast_odds_value' => 10,
                ],
                [
                    'race_instance_uid' => 111111,
                    'race_type_code' => 'O',
                    'horse_uid' => 666666,
                    'uid' => 666666,
                    'non_runner' => null,
                    'saddle_cloth_no' => 2,
                    'draw' => 0,
                    'trainer_uid' => 666666,
                    'trainer_style_name' => 'B',
                    'owner_uid' => 188161,
                    'owner_name' => 'Adrian Wintle',
                    'jockey_uid' => 666666,
                    'jockey_name' => 'B',
                    'allowance' => 0,
                    'horse_name' => 'B',
                    'country_origin_code' => 'IRE',
                    'forecast_odds_value' => 9,
                ],
                [

                    'race_instance_uid' => 111111,
                    'race_type_code' => 'O',
                    'horse_uid' => 555555,
                    'uid' => 555555,
                    'non_runner' => null,
                    'saddle_cloth_no' => 3,
                    'draw' => 0,
                    'trainer_uid' => 555555,
                    'trainer_style_name' => 'C',
                    'owner_uid' => 555555,
                    'owner_name' => 'C',
                    'jockey_uid' => 555555,
                    'jockey_name' => 'C',
                    'allowance' => 0,
                    'horse_name' => 'C',
                    'country_origin_code' => 'IRE',
                    'forecast_odds_value' => 9,
                ],
                // check we are omitting raves with race_Type_code "P"
                [
                    'race_instance_uid' => 222222,
                    'race_type_code' => 'P',
                    'horse_uid' => 555555,
                    'uid' => 555555,
                    'non_runner' => null,
                    'saddle_cloth_no' => 3,
                    'draw' => 0,
                    'trainer_uid' => 555555,
                    'trainer_style_name' => 'C',
                    'owner_uid' => 555555,
                    'owner_name' => 'C',
                    'jockey_uid' => 555555,
                    'jockey_name' => 'C',
                    'allowance' => 0,
                    'horse_name' => 'C',
                    'country_origin_code' => 'IRE',
                    'forecast_odds_value' => 9,
                ]
            ],

            //\Bo\racecards\runners\288 ->dropTempTable()
            'cd641fb1ce0c4e46718f19304c6edcfb' => []
        ];
    }
}
