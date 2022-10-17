<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Profile\Trainer\RecordByRaceType;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Profile\Trainer\RecordByRaceType
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/profile/trainer/32385/record-by-race-type/GB/flat/2011/2016';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\Selectors\Database:40 ->getSeasonDateBegin()
            'f3128a56b9cecd34be8a1570bd00b115' => [
                [
                    'startDate' => '2011-01-01 00:00:00',
                ],
            ],
            //Models\Bo\Selectors\Database:97 ->getSeasonDateEnd()
            '70fcba7bc591306fe790a0579da16a8e' => [
                [
                    'endDate' => '2016-12-31 23:59:00',
                ],
            ],
            //Api\DataProvider\Bo\Profile\RecordByRaceType:187 ->createTmpTableRecordByRaceType()
            'ca9cfda0ac1b72f6eb2e9c7a669f2373' => [
            ],
            //Api\DataProvider\Bo\Profile\RecordByRaceType:254 ->createTmpTableBestRpr()
            '8d56828547aa3df330e642a3066578a7' => [
            ],
            //Api\DataProvider\Bo\Profile\RecordByRaceType:111 ->retrieveResult()
            'd4340a57d8acd7ce9016e7d8994c0f89' => [
                [
                    'group_name' => '3YO TURF',
                    'best_rp_postmark' => 96,
                    'best_horse_uid' => 900745,
                    'best_horse_name' => 'Michele Strogoff',
                    'best_horse_country_origin_code' => 'GB',
                    'placed' => 3,
                    'horses' => 4,
                    'winners' => 1,
                    'total_horses' => 24,
                    'total_winners' => 8,
                    'races_number' => 7,
                    'place_1st_number' => 1,
                    'place_2nd_number' => 0,
                    'place_3rd_number' => 3,
                    'place_4th_number' => 0,
                    'win_prize' => 3234.5,
                    'total_prize' => 6219.8,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 3234.5,
                    'net_total_prize_money' => 6219.8,
                    'stake' => -2.0,
                ],
                [
                    'group_name' => '4YO+ TURF',
                    'best_rp_postmark' => 106,
                    'best_horse_uid' => 801044,
                    'best_horse_name' => 'Caspian Prince',
                    'best_horse_country_origin_code' => 'IRE',
                    'placed' => 1,
                    'horses' => 7,
                    'winners' => 3,
                    'total_horses' => 24,
                    'total_winners' => 8,
                    'races_number' => 14,
                    'place_1st_number' => 3,
                    'place_2nd_number' => 1,
                    'place_3rd_number' => 0,
                    'place_4th_number' => 0,
                    'win_prize' => 31190.4,
                    'total_prize' => 33333.15,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 31190.4,
                    'net_total_prize_money' => 33333.15,
                    'stake' => 27.25,
                ],
                [
                    'group_name' => '2YO AW',
                    'best_rp_postmark' => 82,
                    'best_horse_uid' => 1001887,
                    'best_horse_name' => 'Harome',
                    'best_horse_country_origin_code' => 'IRE',
                    'placed' => 1,
                    'horses' => 2,
                    'winners' => 0,
                    'total_horses' => 24,
                    'total_winners' => 8,
                    'races_number' => 4,
                    'place_1st_number' => 0,
                    'place_2nd_number' => 1,
                    'place_3rd_number' => 0,
                    'place_4th_number' => 0,
                    'win_prize' => 0.0,
                    'total_prize' => 2695.0,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 0.0,
                    'net_total_prize_money' => 2695.0,
                    'stake' => -4.0,
                ],
                [
                    'group_name' => '2YO TURF',
                    'best_rp_postmark' => 72,
                    'best_horse_uid' => 1001887,
                    'best_horse_name' => 'Harome',
                    'best_horse_country_origin_code' => 'IRE',
                    'placed' => 0,
                    'horses' => 2,
                    'winners' => 0,
                    'total_horses' => 24,
                    'total_winners' => 8,
                    'races_number' => 3,
                    'place_1st_number' => 0,
                    'place_2nd_number' => 0,
                    'place_3rd_number' => 0,
                    'place_4th_number' => 0,
                    'win_prize' => 0.0,
                    'total_prize' => 0.0,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 0.0,
                    'net_total_prize_money' => 0.0,
                    'stake' => -3.0,
                ],
                [
                    'group_name' => '4YO+ AW',
                    'best_rp_postmark' => 104,
                    'best_horse_uid' => 801044,
                    'best_horse_name' => 'Caspian Prince',
                    'best_horse_country_origin_code' => 'IRE',
                    'placed' => 7,
                    'horses' => 11,
                    'winners' => 1,
                    'total_horses' => 24,
                    'total_winners' => 8,
                    'races_number' => 31,
                    'place_1st_number' => 1,
                    'place_2nd_number' => 4,
                    'place_3rd_number' => 2,
                    'place_4th_number' => 4,
                    'win_prize' => 7561.2,
                    'total_prize' => 18576.4,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 7561.2,
                    'net_total_prize_money' => 18576.4,
                    'stake' => -10.0,
                ],
                [
                    'group_name' => '3YO AW',
                    'best_rp_postmark' => 94,
                    'best_horse_uid' => 900745,
                    'best_horse_name' => 'Michele Strogoff',
                    'best_horse_country_origin_code' => 'GB',
                    'placed' => 4,
                    'horses' => 8,
                    'winners' => 3,
                    'total_horses' => 24,
                    'total_winners' => 8,
                    'races_number' => 21,
                    'place_1st_number' => 3,
                    'place_2nd_number' => 4,
                    'place_3rd_number' => 0,
                    'place_4th_number' => 1,
                    'win_prize' => 8733.15,
                    'total_prize' => 12239.4,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 8733.15,
                    'net_total_prize_money' => 12239.4,
                    'stake' => -9.625,
                ],
            ],
            //Api\Mvc\DataProvider\TemporaryTable:85 ->dropTemporaryTable()
            '7cdfb63bbcc333b6510ba30e8aebf31f' => [
            ],
            //Api\Mvc\DataProvider\TemporaryTable:85 ->dropTemporaryTable()
            '69242e1606a780d7a47dd83edb5badc8' => [
            ],
        ];
    }

    /**
     * @return array
     */
    public function getReplacement(): array
    {
        return [
            'seasonStartDate' => '2011-01-01 00:00:00',
            'seasonEndDate' => '2016-12-31 23:59:00'
        ];
    }
}
