<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Profile\Trainer\StatisticalSummary;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Profile\Trainer\StatisticalSummary
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/profile/trainer/32276/statistical-summary/GB/flat/aw';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\TrainerProfile\RaceInstance:580 ->getStatisticalSummary()
            '44a5a97c61b0f3191c6e2eae87635893' => [
                [
                    'season_start_date' => '2016-01-01 00:00:00',
                    'season_end_date' => '2016-12-31 23:59:00',
                    'races_number' => 19,
                    'place_1st_number' => 4,
                    'place_2nd_number' => 3,
                    'place_3rd_number' => 4,
                    'place_4th_number' => 1,
                    'win_prize' => 13261.45,
                    'total_prize' => 27415.12,
                    'net_win_prize_money' => 13261.45,
                    'net_total_prize_money' => 27415.12,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'stake' => 4.0,
                ],
                [
                    'season_start_date' => '2017-01-01 00:00:00',
                    'season_end_date' => '2017-12-31 23:59:00',
                    'races_number' => 154,
                    'place_1st_number' => 35,
                    'place_2nd_number' => 19,
                    'place_3rd_number' => 17,
                    'place_4th_number' => 13,
                    'win_prize' => 183889.46,
                    'total_prize' => 287313.91,
                    'net_win_prize_money' => 183889.46,
                    'net_total_prize_money' => 287313.91,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'stake' => 10.106,
                ],
                [
                    'season_start_date' => '2018-01-01 00:00:00',
                    'season_end_date' => '2018-12-31 23:59:00',
                    'races_number' => 116,
                    'place_1st_number' => 26,
                    'place_2nd_number' => 18,
                    'place_3rd_number' => 22,
                    'place_4th_number' => 15,
                    'win_prize' => 232059.56,
                    'total_prize' => 291961.49,
                    'net_win_prize_money' => 232059.56,
                    'net_total_prize_money' => 291961.49,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'stake' => 4.839,
                ],
            ],
        ];
    }
}
