<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Profile\Owner\RecordByRaceType;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Profile\Owner\RecordByRaceType
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/profile/owner/199331/record-by-race-type/GB/flat/2015/2015';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\Selectors\Database:40 ->getSeasonDateBegin()
            'd93d6605c6263e6f22e6935092c7606d' => [
                [
                    'startDate' => '2015-01-01 00:00:00',
                ],
            ],
            //Models\Bo\Selectors\Database:97 ->getSeasonDateEnd()
            'e3c3aeac401f1dfba4adbc618075affc' => [
                [
                    'endDate' => '2015-12-31 23:59:00',
                ],
            ],
            //Api\DataProvider\Bo\Profile\RecordByRaceType:179 ->retrieveResult()
            'c48c156d8e03f8bf92a440ee6936ba35' => [
            ],
            //Api\DataProvider\Bo\Profile\RecordByRaceType:180 ->retrieveResult()
            '8d56828547aa3df330e642a3066578a7' => [
            ],
            //Api\DataProvider\Bo\Profile\RecordByRaceType:182 ->retrieveResult()
            'd4340a57d8acd7ce9016e7d8994c0f89' => [
                [
                    'group_name' => '3YO TURF',
                    'best_rp_postmark' => 105,
                    'best_horse_uid' => 863455,
                    'best_horse_name' => 'My Dream Boat',
                    'best_horse_country_origin_code' => 'IRE',
                    'placed' => 6,
                    'horses' => 3,
                    'winners' => 1,
                    'total_horses' => 7,
                    'total_winners' => 2,
                    'races_number' => 12,
                    'place_1st_number' => 2,
                    'place_2nd_number' => 5,
                    'place_3rd_number' => 1,
                    'place_4th_number' => 1,
                    'win_prize' => 35815.02,
                    'total_prize' => 46539.92,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 35815.02,
                    'net_total_prize_money' => 46539.92,
                    'stake' => 31.0,
                ],
                [
                    'group_name' => '2YO TURF',
                    'best_rp_postmark' => 63,
                    'best_horse_uid' => 902507,
                    'best_horse_name' => 'He\'s My Cracker',
                    'best_horse_country_origin_code' => 'GB',
                    'placed' => 0,
                    'horses' => 1,
                    'winners' => 0,
                    'total_horses' => 7,
                    'total_winners' => 2,
                    'races_number' => 1,
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
                    'stake' => -1.0,
                ],
                [
                    'group_name' => '4YO+ TURF',
                    'best_rp_postmark' => 72,
                    'best_horse_uid' => 849221,
                    'best_horse_name' => 'Amirli',
                    'best_horse_country_origin_code' => 'IRE',
                    'placed' => 0,
                    'horses' => 1,
                    'winners' => 0,
                    'total_horses' => 7,
                    'total_winners' => 2,
                    'races_number' => 2,
                    'place_1st_number' => 0,
                    'place_2nd_number' => 0,
                    'place_3rd_number' => 1,
                    'place_4th_number' => 1,
                    'win_prize' => 0.0,
                    'total_prize' => 697.45,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 0.0,
                    'net_total_prize_money' => 697.45,
                    'stake' => -2.0,
                ],
                [
                    'group_name' => '3YO AW',
                    'best_rp_postmark' => 77,
                    'best_horse_uid' => 862901,
                    'best_horse_name' => 'You\'re My Cracker',
                    'best_horse_country_origin_code' => 'GB',
                    'placed' => 1,
                    'horses' => 1,
                    'winners' => 0,
                    'total_horses' => 7,
                    'total_winners' => 2,
                    'races_number' => 2,
                    'place_1st_number' => 0,
                    'place_2nd_number' => 1,
                    'place_3rd_number' => 0,
                    'place_4th_number' => 1,
                    'win_prize' => 0.0,
                    'total_prize' => 1082.7,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 0.0,
                    'net_total_prize_money' => 1082.7,
                    'stake' => -2.0,
                ],
                [
                    'group_name' => '2YO AW',
                    'best_rp_postmark' => 78,
                    'best_horse_uid' => 905418,
                    'best_horse_name' => 'Go On Go On Go On',
                    'best_horse_country_origin_code' => 'GB',
                    'placed' => 2,
                    'horses' => 2,
                    'winners' => 1,
                    'total_horses' => 7,
                    'total_winners' => 2,
                    'races_number' => 4,
                    'place_1st_number' => 1,
                    'place_2nd_number' => 2,
                    'place_3rd_number' => 0,
                    'place_4th_number' => 0,
                    'win_prize' => 3363.88,
                    'total_prize' => 5308.13,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 3363.88,
                    'net_total_prize_money' => 5308.13,
                    'stake' => -1.0,
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
            'seasonStartDate' => '2015-01-01 00:00:00',
            'seasonEndDate' => '2015-12-31 23:59:00'
        ];
    }
}
