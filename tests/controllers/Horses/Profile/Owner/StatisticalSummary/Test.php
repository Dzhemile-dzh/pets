<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Owner\StatisticalSummary;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Owner\StatisticalSummary
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/profile/owner/199331/statistical-summary/GB/flat/turf';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\OwnerProfile\RaceInstance:531 ->createTempCore()
            '6e8fd15c299f911c04cf69de30e87b82' => [
            ],
            //Models\Bo\OwnerProfile\RaceInstance:590 ->createTempCore()
            'c1b466b34b012ff322079ce5077e2c39' => [
            ],
            //Models\Bo\OwnerProfile\RaceInstance:599 ->createTempBestRpr()
            '5b20fa7b33f52919fa678a8eaa849f27' => [
            ],
            //Models\Bo\OwnerProfile\RaceInstance:633 ->createTempBestRpr()
            'c6b363da6f72562e210d418627b9382c' => [
            ],
            //Models\Bo\OwnerProfile\RaceInstance:645 ->createTempStat()
            '607921d8dddafb6d9c622609f3967f36' => [
            ],
            //Models\Bo\OwnerProfile\RaceInstance:710 ->createTempStat()
            '1d0103f1e351b33b7664149f3a1d7f54' => [
            ],
            //Models\Bo\OwnerProfile\RaceInstance:491 ->getStatisticalSummary()
            'd3b7b5532f32055d6ef340980dd1ceda' => [
                [
                    'group_date' => '2018-2018',
                    'season_start_date' => '2018-01-01 00:00:00',
                    'season_end_date' => '2018-12-31 23:59:00',
                    'races_number' => 7,
                    'placed' => 2,
                    'place_1st_number' => 1,
                    'place_2nd_number' => 1,
                    'place_3rd_number' => 0,
                    'place_4th_number' => 1,
                    'win_prize' => 9056.6,
                    'total_prize' => 11339.04,
                    'net_win_prize_money' => 9056.6,
                    'net_total_prize_money' => 11339.04,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'stake' => 4.0,
                    'rp_postmark' => 88,
                    'horse_uid' => 872527,
                    'horse_name' => 'Keep In Line',
                ],
                [
                    'group_date' => '2017-2017',
                    'season_start_date' => '2017-01-01 00:00:00',
                    'season_end_date' => '2017-12-31 23:59:00',
                    'races_number' => 115,
                    'placed' => 48,
                    'place_1st_number' => 23,
                    'place_2nd_number' => 15,
                    'place_3rd_number' => 12,
                    'place_4th_number' => 13,
                    'win_prize' => 130731.88,
                    'total_prize' => 224660.91,
                    'net_win_prize_money' => 130731.88,
                    'net_total_prize_money' => 224660.91,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'stake' => 0.417,
                    'rp_postmark' => 116,
                    'horse_uid' => 863455,
                    'horse_name' => 'My Dream Boat',
                ],
                [
                    'group_date' => '2016-2016',
                    'season_start_date' => '2016-01-01 00:00:00',
                    'season_end_date' => '2016-12-31 23:59:00',
                    'races_number' => 75,
                    'placed' => 32,
                    'place_1st_number' => 18,
                    'place_2nd_number' => 6,
                    'place_3rd_number' => 11,
                    'place_4th_number' => 5,
                    'win_prize' => 564781.44,
                    'total_prize' => 665018.9,
                    'net_win_prize_money' => 564781.44,
                    'net_total_prize_money' => 665018.9,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'stake' => 43.571,
                    'rp_postmark' => 122,
                    'horse_uid' => 863455,
                    'horse_name' => 'My Dream Boat',
                ],
                [
                    'group_date' => '2015-2015',
                    'season_start_date' => '2015-01-01 00:00:00',
                    'season_end_date' => '2015-12-31 23:59:00',
                    'races_number' => 15,
                    'placed' => 8,
                    'place_1st_number' => 2,
                    'place_2nd_number' => 5,
                    'place_3rd_number' => 2,
                    'place_4th_number' => 2,
                    'win_prize' => 35815.02,
                    'total_prize' => 47237.37,
                    'net_win_prize_money' => 35815.02,
                    'net_total_prize_money' => 47237.37,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'stake' => 28.0,
                    'rp_postmark' => 105,
                    'horse_uid' => 863455,
                    'horse_name' => 'My Dream Boat',
                ],
                [
                    'group_date' => '2014-2014',
                    'season_start_date' => '2014-01-01 00:00:00',
                    'season_end_date' => '2014-12-31 23:59:00',
                    'races_number' => 18,
                    'placed' => 6,
                    'place_1st_number' => 1,
                    'place_2nd_number' => 4,
                    'place_3rd_number' => 3,
                    'place_4th_number' => 2,
                    'win_prize' => 2385.95,
                    'total_prize' => 8520.6,
                    'net_win_prize_money' => 2385.95,
                    'net_total_prize_money' => 8520.6,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'stake' => -15.25,
                    'rp_postmark' => 88,
                    'horse_uid' => 793525,
                    'horse_name' => 'Gabrial The Great',
                ],
                [
                    'group_date' => '2012-2012',
                    'season_start_date' => '2012-01-01 00:00:00',
                    'season_end_date' => '2012-12-31 23:59:00',
                    'races_number' => 1,
                    'placed' => 1,
                    'place_1st_number' => 1,
                    'place_2nd_number' => 0,
                    'place_3rd_number' => 0,
                    'place_4th_number' => 0,
                    'win_prize' => 14177.25,
                    'total_prize' => 14177.25,
                    'net_win_prize_money' => 14177.25,
                    'net_total_prize_money' => 14177.25,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'stake' => 3.333,
                    'rp_postmark' => 99,
                    'horse_uid' => 716877,
                    'horse_name' => 'Absinthe',
                ],
            ],
            //Models\Bo\OwnerProfile\RaceInstance:504 ->getStatisticalSummary()
            '6e8fd15c299f911c04cf69de30e87b82' => [
            ],
            //Models\Bo\OwnerProfile\RaceInstance:510 ->getStatisticalSummary()
            '5b20fa7b33f52919fa678a8eaa849f27' => [
            ],
            //Models\Bo\OwnerProfile\RaceInstance:516 ->getStatisticalSummary()
            '607921d8dddafb6d9c622609f3967f36' => [
            ],
        ];
    }
}
