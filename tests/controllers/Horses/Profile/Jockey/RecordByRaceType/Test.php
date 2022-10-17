<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Profile\Jockey\RecordByRaceType;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Profile\Jockey\RecordByRaceType
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/profile/jockey/81166/record-by-race-type/GB/flat/2016/2016';
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
            '70fcba7bc591306fe790a0579da16a8e' => [
                [
                    'endDate' => '2016-12-31 23:59:00',
                ],
            ],
            //Api\DataProvider\Bo\Profile\RecordByRaceType:179 ->retrieveResult()
            '02cec39173e473e6b84c4fc6cd257f09' => [
            ],
            //Api\DataProvider\Bo\Profile\RecordByRaceType:180 ->retrieveResult()
            '8d56828547aa3df330e642a3066578a7' => [
            ],
            //Api\DataProvider\Bo\Profile\RecordByRaceType:182 ->retrieveResult()
            'd4340a57d8acd7ce9016e7d8994c0f89' => [
                [
                    'group_name' => '2YO AW',
                    'best_rp_postmark' => 90,
                    'best_horse_uid' => 987828,
                    'best_horse_name' => 'Poet\'s Society',
                    'best_horse_country_origin_code' => 'GB',
                    'placed' => 9,
                    'horses' => 36,
                    'winners' => 3,
                    'total_horses' => 370,
                    'total_winners' => 54,
                    'races_number' => 41,
                    'place_1st_number' => 3,
                    'place_2nd_number' => 5,
                    'place_3rd_number' => 5,
                    'place_4th_number' => 5,
                    'win_prize' => 13908.35,
                    'total_prize' => 24236.13,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 13908.35,
                    'net_total_prize_money' => 24236.13,
                    'stake' => -10.0,
                ],
                [
                    'group_name' => '2YO TURF',
                    'best_rp_postmark' => 83,
                    'best_horse_uid' => 1017340,
                    'best_horse_name' => 'La Casa Tarifa',
                    'best_horse_country_origin_code' => 'IRE',
                    'placed' => 12,
                    'horses' => 54,
                    'winners' => 7,
                    'total_horses' => 370,
                    'total_winners' => 54,
                    'races_number' => 72,
                    'place_1st_number' => 7,
                    'place_2nd_number' => 3,
                    'place_3rd_number' => 11,
                    'place_4th_number' => 9,
                    'win_prize' => 134026.22,
                    'total_prize' => 180586.09,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 134026.22,
                    'net_total_prize_money' => 180586.09,
                    'stake' => 4.0,
                ],
                [
                    'group_name' => '3YO AW',
                    'best_rp_postmark' => 94,
                    'best_horse_uid' => 891919,
                    'best_horse_name' => 'Mithqaal',
                    'best_horse_country_origin_code' => 'USA',
                    'placed' => 13,
                    'horses' => 50,
                    'winners' => 5,
                    'total_horses' => 370,
                    'total_winners' => 54,
                    'races_number' => 67,
                    'place_1st_number' => 5,
                    'place_2nd_number' => 10,
                    'place_3rd_number' => 5,
                    'place_4th_number' => 8,
                    'win_prize' => 23544.9,
                    'total_prize' => 42900.61,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 23544.9,
                    'net_total_prize_money' => 42900.61,
                    'stake' => -42.417,
                ],
                [
                    'group_name' => '3YO TURF',
                    'best_rp_postmark' => 98,
                    'best_horse_uid' => 964971,
                    'best_horse_name' => 'Knights Table',
                    'best_horse_country_origin_code' => 'GB',
                    'placed' => 21,
                    'horses' => 83,
                    'winners' => 11,
                    'total_horses' => 370,
                    'total_winners' => 54,
                    'races_number' => 131,
                    'place_1st_number' => 12,
                    'place_2nd_number' => 13,
                    'place_3rd_number' => 9,
                    'place_4th_number' => 18,
                    'win_prize' => 44959.55,
                    'total_prize' => 86096.8,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 44959.55,
                    'net_total_prize_money' => 86096.8,
                    'stake' => 83.0,
                ],
                [
                    'group_name' => '4YO+ AW',
                    'best_rp_postmark' => 101,
                    'best_horse_uid' => 816116,
                    'best_horse_name' => 'Luv U Whatever',
                    'best_horse_country_origin_code' => 'GB',
                    'placed' => 28,
                    'horses' => 94,
                    'winners' => 18,
                    'total_horses' => 370,
                    'total_winners' => 54,
                    'races_number' => 161,
                    'place_1st_number' => 18,
                    'place_2nd_number' => 15,
                    'place_3rd_number' => 15,
                    'place_4th_number' => 16,
                    'win_prize' => 100546.71,
                    'total_prize' => 150695.26,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 100546.71,
                    'net_total_prize_money' => 150695.26,
                    'stake' => -56.0,
                ],
                [
                    'group_name' => '4YO+ TURF',
                    'best_rp_postmark' => 109,
                    'best_horse_uid' => 784805,
                    'best_horse_name' => 'Sovereign Debt',
                    'best_horse_country_origin_code' => 'IRE',
                    'placed' => 24,
                    'horses' => 118,
                    'winners' => 12,
                    'total_horses' => 370,
                    'total_winners' => 54,
                    'races_number' => 199,
                    'place_1st_number' => 13,
                    'place_2nd_number' => 11,
                    'place_3rd_number' => 17,
                    'place_4th_number' => 17,
                    'win_prize' => 79669.29,
                    'total_prize' => 133653.71,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 79669.29,
                    'net_total_prize_money' => 133653.71,
                    'stake' => -77.0,
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
            'seasonStartDate' => '2016-01-01 00:00:00',
            'seasonEndDate' => '2016-12-31 23:59:00'
        ];
    }
}
