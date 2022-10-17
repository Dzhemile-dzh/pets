<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Profile\Trainer\Horses;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 *
 * @package Tests\Controllers\Horses\Profile\Trainer\Horses
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/profile/trainer/32276/horses/2016/GB/flat/aw';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\TrainerProfile\RaceInstance:481 ->getHorses()
            'f2bf8a358c42c0e9b126194890aae12c' => [
                [
                    'races_number' => 3,
                    'place_1st_number' => 0,
                    'win_prize' => 0.0,
                    'total_prize' => 10104.5,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 0.0,
                    'net_total_prize_money' => 10104.5,
                    'stake' => -3.0,
                    'rpr' => 93,
                    'horse_uid' => 864930,
                    'horse_style_name' => 'Chevallier',
                    'country_origin_code' => 'GB',
                    'max_race_instance_uid' => 663187,
                    'owner_uid' => 242118,
                    'owner_style_name' => 'The Chevallier Partnership',
                    'owner_ptp_type_code' => 'N',
                ],
                [
                    'races_number' => 6,
                    'place_1st_number' => 2,
                    'win_prize' => 6145.55,
                    'total_prize' => 9521.32,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 6145.55,
                    'net_total_prize_money' => 9521.32,
                    'stake' => 0.0,
                    'rpr' => 85,
                    'horse_uid' => 875027,
                    'horse_style_name' => 'Ride The Lightning',
                    'country_origin_code' => 'GB',
                    'max_race_instance_uid' => 664953,
                    'owner_uid' => 242120,
                    'owner_style_name' => 'The Ride The Lightning Partnership',
                    'owner_ptp_type_code' => 'N',
                ],
                [
                    'races_number' => 2,
                    'place_1st_number' => 1,
                    'win_prize' => 3881.4,
                    'total_prize' => 4121.9,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 3881.4,
                    'net_total_prize_money' => 4121.9,
                    'stake' => 6.0,
                    'rpr' => 76,
                    'horse_uid' => 1141216,
                    'horse_style_name' => 'Alkashaaf',
                    'country_origin_code' => 'USA',
                    'max_race_instance_uid' => 665099,
                    'owner_uid' => 243817,
                    'owner_style_name' => 'A M B Watson',
                    'owner_ptp_type_code' => 'N',
                ],
                [
                    'races_number' => 2,
                    'place_1st_number' => 1,
                    'win_prize' => 3234.5,
                    'total_prize' => 3667.4,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 3234.5,
                    'net_total_prize_money' => 3667.4,
                    'stake' => 7.0,
                    'rpr' => 73,
                    'horse_uid' => 1139468,
                    'horse_style_name' => 'Plead',
                    'country_origin_code' => 'GB',
                    'max_race_instance_uid' => 664975,
                    'owner_uid' => 213745,
                    'owner_style_name' => 'C R Hirst',
                    'owner_ptp_type_code' => 'N',
                ],
                [
                    'races_number' => 1,
                    'place_1st_number' => 0,
                    'win_prize' => 0.0,
                    'total_prize' => 0.0,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 0.0,
                    'net_total_prize_money' => 0.0,
                    'stake' => -1.0,
                    'rpr' => 67,
                    'horse_uid' => 902514,
                    'horse_style_name' => 'Ebony N Ivory',
                    'country_origin_code' => 'GB',
                    'max_race_instance_uid' => 661182,
                    'owner_uid' => 242119,
                    'owner_style_name' => 'The Ebony N Ivory Partnership',
                    'owner_ptp_type_code' => 'N',
                ],
                [
                    'races_number' => 1,
                    'place_1st_number' => 0,
                    'win_prize' => 0.0,
                    'total_prize' => 0.0,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 0.0,
                    'net_total_prize_money' => 0.0,
                    'stake' => -1.0,
                    'rpr' => 65,
                    'horse_uid' => 1156888,
                    'horse_style_name' => 'Erinyes',
                    'country_origin_code' => 'IRE',
                    'max_race_instance_uid' => 660406,
                    'owner_uid' => 211024,
                    'owner_style_name' => 'Al Asayl Bloodstock Ltd',
                    'owner_ptp_type_code' => 'N',
                ],
                [
                    'races_number' => 4,
                    'place_1st_number' => 0,
                    'win_prize' => 0.0,
                    'total_prize' => 0.0,
                    'euro_win_prize' => 0.0,
                    'euro_total_prize' => 0.0,
                    'net_win_prize_money' => 0.0,
                    'net_total_prize_money' => 0.0,
                    'stake' => -4.0,
                    'rpr' => 63,
                    'horse_uid' => 1035506,
                    'horse_style_name' => 'Texas Katie',
                    'country_origin_code' => 'GB',
                    'max_race_instance_uid' => 664021,
                    'owner_uid' => 243982,
                    'owner_style_name' => 'Anne Abel Smith & Partner',
                    'owner_ptp_type_code' => 'N',
                ],
            ],
        ];
    }
}
