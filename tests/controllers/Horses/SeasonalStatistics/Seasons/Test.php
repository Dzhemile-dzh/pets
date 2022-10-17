<?php

declare(strict_types=1);

namespace Test\Controllers\Horses\SeasonalStatistics\Seasons;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Test\Controllers\Horses\SeasonalStatistics\Seasons
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/seasonal-statistics/seasons-available?activeSeasons=1';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\SeasonalStatistics\Season:165 ->getSeasonsAvailable()
            '1549d1dba890453bb9a0d2584fe21462' => [
                [
                    'season_uid' => 549,
                    'season_type_code' => 'J',
                    'season_start_date' => '2018-04-29 00:00:00',
                    'season_end_date' => '2019-04-27 23:59:00',
                    'season_desc' => 'NH 2018-2019',
                    'is_active' => 'Y',
                    'flat_or_jump_flag' => 'J',
                ],
                [
                    'season_uid' => 550,
                    'season_type_code' => 'I',
                    'season_start_date' => '2018-04-29 00:00:00',
                    'season_end_date' => '2019-04-27 23:59:00',
                    'season_desc' => 'Irish Jumps 2018-2019',
                    'is_active' => 'Y',
                    'flat_or_jump_flag' => 'J',
                ],
                [
                    'season_uid' => 524,
                    'season_type_code' => 'F',
                    'season_start_date' => '2018-01-01 00:00:00',
                    'season_end_date' => '2018-12-31 23:59:00',
                    'season_desc' => 'Flat 2018',
                    'is_active' => 'Y',
                    'flat_or_jump_flag' => 'F',
                ],
                [
                    'season_uid' => 546,
                    'season_type_code' => 'L',
                    'season_start_date' => '2018-01-01 00:00:00',
                    'season_end_date' => '2018-12-31 23:59:00',
                    'season_desc' => 'GB Flat Trainer Title 2018',
                    'is_active' => 'Y',
                    'flat_or_jump_flag' => 'F',
                ],
                [
                    'season_uid' => 544,
                    'season_type_code' => 'T',
                    'season_start_date' => '2018-03-24 00:00:00',
                    'season_end_date' => '2018-11-10 23:59:00',
                    'season_desc' => 'Turf 2018',
                    'is_active' => 'Y',
                    'flat_or_jump_flag' => 'F',
                ],
                [
                    'season_uid' => 541,
                    'season_type_code' => 'E',
                    'season_start_date' => '2018-03-25 00:00:00',
                    'season_end_date' => '2018-11-04 23:59:00',
                    'season_desc' => 'Irish Flat 2018',
                    'is_active' => 'Y',
                    'flat_or_jump_flag' => 'F',
                ],
                [
                    'season_uid' => 542,
                    'season_type_code' => 'M',
                    'season_start_date' => '2018-03-25 00:00:00',
                    'season_end_date' => '2018-11-04 23:59:00',
                    'season_desc' => 'Irish Flat Jockey Title 2018',
                    'is_active' => 'Y',
                    'flat_or_jump_flag' => 'F',
                ],
                [
                    'season_uid' => 543,
                    'season_type_code' => 'N',
                    'season_start_date' => '2018-03-25 00:00:00',
                    'season_end_date' => '2018-11-04 23:59:00',
                    'season_desc' => 'Irish Flat Trainer Title 2018',
                    'is_active' => 'Y',
                    'flat_or_jump_flag' => 'F',
                ],
                [
                    'season_uid' => 540,
                    'season_type_code' => 'K',
                    'season_start_date' => '2018-05-05 00:00:00',
                    'season_end_date' => '2018-10-20 17:30:00',
                    'season_desc' => 'GB Flat Jockey Title 2018',
                    'is_active' => 'Y',
                    'flat_or_jump_flag' => 'F',
                ],
                [
                    'season_uid' => 537,
                    'season_type_code' => 'H',
                    'season_start_date' => '2017-09-03 00:00:00',
                    'season_end_date' => '2018-07-15 23:59:00',
                    'season_desc' => 'Hong Kong 2017-2018',
                    'is_active' => 'Y',
                    'flat_or_jump_flag' => 'F',
                ],
            ],
            //Api\Mvc\DataProvider\TemporaryTable:85 ->dropTemporaryTable()
            'e03b10673a484a9fb90442c15bf74170' => [],
            'c8767c5cb230e3ef39ddbb7447c0e268' => [],
        ];
    }
}
