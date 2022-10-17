<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Profile\Overview;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\Profile\Overview
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/profile/horse/595255/overview';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //Models\Bo\HorseProfile\Horse:197 ->getHorseDataForProfile()
            'c2efd32ca1592b925963bc1dbb77fc56' => [
                [
                    'horse_date_of_birth' => '2000-06-05 00:00:00',
                    'horse_date_of_death' => null,
                    'country_origin_code' => 'GB',
                    'sire_uid' => 99848,
                    'dam_uid' => 74783,
                    'style_name' => 'Chita\'s Flight',
                    'horse_colour_code' => 'GR',
                    'horse_sex_code' => 'M',
                    'date_gelded' => null,
                    'sire_horse_name' => 'Busy Flight',
                    'sire_country_origin_code' => 'GB',
                    'dam_horse_name' => 'Chita\'s Cone',
                    'dam_country_origin_code' => 'GB',
                    'dam_sire_horse_name' => 'Celtic Cone',
                    'sires_sire_uid' => 301848,
                    'sires_sire_name' => 'Pharly',
                    'avg_flat_win_dist' => null,
                    'sire_avg_flat_win_dist' => null,
                    'dam_sire_avg_flat_win_dist' => 9.7,
                    'owner_name' => 'I M Ham',
                    'owner_search_name' => 'HAM',
                    'owner_ptp_type_code' => 'N',
                    'owner_uid' => 54591,
                    'trainer_name' => 'Philip Hobbs',
                    'trainer_uid' => 135,
                    'trainer_location' => 'Withycombe, Somerset',
                    'trainer_search_name' => 'HOBBS',
                    'trainer_ptp_type_code' => 'N',
                    'breeder_name' => 'I M Ham',
                    'horse_uid' => 595255,
                    'dam_sire_country_origin_code' => 'GB',
                    'dam_status' => 1,
                    'dam_sire_uid' => 300424,
                    'sire_status' => 0,
                    'horse_sex' => 'mare',
                    'horse_colour' => 'gr',
                    'sire_comment' => null,
                    's_total_win_dist_of_progeny' => 3,
                    's_total_no_of_wins' => 5,
                    'shs_total_win_dist_of_progeny' => 2,
                    'shs_total_no_of_wins' => 10,
                    'shds_total_win_dist_of_progeny' => 6,
                    'shds_total_no_of_wins' => 4,
                    'total_earnings_of_progeny' => 3,
                    'total_no_of_horses' => 5,
                    'total_earnings' => 4,
                    'total_runners' => 9,
                    'weatherbys_uid' => null,
                    'weatherbys_api_uid' => null,
                    'owner_group_uid' => null,
                ],
            ],
            //Models\Bo\HorseProfile\Horse:224 ->getToFollow()
            '69f75bdf08085f7a8597837dea74ebe5' => [
            ],
            //Models\Bo\HorseProfile\PreHorseRace:41 ->getTips()
            '4cdff3f3a4c712e1f2efde3a177dae1a' => [
            ],
            //Models\Bo\HorseProfile\PreHorseRace:93 ->getComments()
            'adb546d57c897c5fd413ecf66cae4c2b' => [
            ],
            //Models\HorseRace:406 ->getStatsLast14Days()
            '85ef95ba9763acb6f06d512ae65c6054' => [
                [
                    'runs' => 16,
                    'wins' => 1,
                ],
            ],
            //Models\Bo\HorseProfile\HorseRace:216 ->getPreviousTrainers()
            '652f0e93105ba837a769b9c571c81cfd' => [
                [
                    'trainer_uid' => 6538,
                    'trainer_change_date' => '2007-12-22 13:33:00',
                    'trainer_style_name' => 'R M Treloggen',
                    'trainer_search_name' => 'R Treloggen',
                    'trainer_ptp_type_code' => 'N',
                ],
                [
                    'trainer_uid' => 18179,
                    'trainer_change_date' => '2007-03-26 13:53:00',
                    'trainer_style_name' => 'Ron Treloggen',
                    'trainer_search_name' => 'R Treloggen',
                    'trainer_ptp_type_code' => 'G',
                ],
                [
                    'trainer_uid' => 6538,
                    'trainer_change_date' => '2007-03-16 14:20:00',
                    'trainer_style_name' => 'R M Treloggen',
                    'trainer_search_name' => 'R Treloggen',
                    'trainer_ptp_type_code' => 'N',
                ],
                [
                    'trainer_uid' => 18179,
                    'trainer_change_date' => '2007-02-08 13:13:00',
                    'trainer_style_name' => 'Ron Treloggen',
                    'trainer_search_name' => 'R Treloggen',
                    'trainer_ptp_type_code' => 'G',
                ],
                [
                    'trainer_uid' => 15630,
                    'trainer_change_date' => '2006-03-17 16:00:00',
                    'trainer_style_name' => 'Simon Burrough',
                    'trainer_search_name' => 'S Burrough',
                    'trainer_ptp_type_code' => 'N',
                ],
            ],
            //Models\Bo\HorseProfile\HorseRace:255 ->getPreviousOwners()
            '1308b51b9814a5ec7585c59766b662d0' => [
                [
                    'owner_uid' => 111040,
                    'owner_change_date' => '2007-12-22 13:33:00',
                    'owner_style_name' => 'R M Treloggen',
                    'owner_search_name' => 'TRELOGGEN',
                    'owner_ptp_type_code' => 'G',
                ],
                [
                    'owner_uid' => 155642,
                    'owner_change_date' => '2007-04-30 09:13:00',
                    'owner_style_name' => 'Bramwell Racing Partnership',
                    'owner_search_name' => 'BRAMWELL RACING PARTNERSHIP',
                    'owner_ptp_type_code' => 'N',
                ],
                [
                    'owner_uid' => 155642,
                    'owner_change_date' => '2007-04-23 09:08:00',
                    'owner_style_name' => 'Bramwell Racing Partnership',
                    'owner_search_name' => 'BRAMWELL RACING PARTNERSHIP',
                    'owner_ptp_type_code' => 'N',
                ],
                [
                    'owner_uid' => 111040,
                    'owner_change_date' => '2007-04-22 12:06:00',
                    'owner_style_name' => 'R M Treloggen',
                    'owner_search_name' => 'TRELOGGEN',
                    'owner_ptp_type_code' => 'G',
                ],
                [
                    'owner_uid' => 111040,
                    'owner_change_date' => '2007-04-06 13:45:00',
                    'owner_style_name' => 'R M Treloggen',
                    'owner_search_name' => 'TRELOGGEN',
                    'owner_ptp_type_code' => 'G',
                ],
            ],
            //Models\Bo\HorseProfile\Horse:297 ->getStudFee()
            'd96bc3a08dc37051bb6e0be896b7f74e' => [
            ],
            //Models\Bo\HorseProfile\RaceInstance:98 ->getEntries()
            '2f3353756f477616611f332a0a128b59' => [
            ],
            //Models\Bo\HorseProfile\RaceInstance:359 ->getNotes()
            '62aab23e27ef8cd3a46ab606d0e01deb' => [
            ],
            //Models\Bo\HorseProfile\RaceInstance:393 ->getStableTourQuotes()
            '2cd85d7dac40edf4dc1ff5299858580a' => [
            ],
            //Api\Row\Methods\GetHorseAge
            '419bea4c352b958d6ce8d8201af1e562' => [
                [
                    'date' => '2018-01-02 08:03:58.057'
                ]
            ]
        ];
    }
}
