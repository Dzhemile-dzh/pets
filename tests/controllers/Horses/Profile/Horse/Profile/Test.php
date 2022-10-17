<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Profile\Horse\Profile;

use UnitTestsComponents\ApiRouteTest\Json as ApiRouteTestPrototype;

/**
 * Class Test
 * @package Tests\Controllers\Horses\Profile\Horse\Profile
 */
class Test extends ApiRouteTestPrototype
{
    /**
     * @return string
     */
    public function getRoute(): string
    {
        return '/horses/profile/horse/595255';
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
                    'avg_win_distance' => null,
                    'sire_avg_win_distance' => 17.10909090909091,
                    'dam_sire_avg_win_distance' => 15.064935064935066,
                    'avg_earnings_index' => null,
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
            '755a6c6b4a6e2f5f94c638c046d2367a' => [
            ],
            //Models\HorseRace:313 ->getTrainerStatsLast14Days()
            'b4c4d3eb82f74b52a9a5e02ff562f278' => [
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
            '6d05673f4090b6dae40192787eb24892' => [
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
