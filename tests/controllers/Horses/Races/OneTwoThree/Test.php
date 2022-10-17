<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Races\OneTwoThree;

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
        return '/horses/races/one-two-three?date=2030-01-01';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //\Bo\Races\:140 ->getRaceDateRunners()
            '19c3f7095e03b82560ca93053db2045c' => [
                    [
                        'horse_uid' => 1018540,
                        'race_instance_uid' => 695416,
                        'race_status_code' => 'R',
                        'race_outcome_desc' => '1st',
                        'race_outcome_code' => '1',
                        'race_outcome_position' => 1,
                        'race_outcome_joint_yn' => 'N',
                        'race_output_order' => 1,
                        'race_outcome_uid' => 1,
                        'final_race_outcome_uid' => 1,
                        'orig_race_output_order' => 1,
                        'draw' => 14,
                        'weight_allowance_lbs' => 0,
                        'jockey_uid' => 81409,
                        'jockey_style_name' => 'Brian Hughes',
                        'odds_desc' => '5/2',
                        'odds_value' => 2.5,
                        'favourite_flag' => null,
                        'trainer_uid' => 15674,
                        'trainer_style_name' => 'Donald McCain',
                        'owner_style_name' => 'Matthew Taylor',
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 184279,
                        'disqualification_uid' => null,
                        'rp_distance_desc' => null,
                        'dth_distance_value' => null,
                        'first_time_yn' => 'N',
                        'dtw_sum_distance_value' => null,
                        'saddle_cloth_no' => 3,
                        'saddle_cloth_letter' => null,
                        'horse_style_name' => 'Swashbuckle',
                        'horse_name' => 'SWASHBUCKLE',
                        'country_origin_code' => 'GB',
                        'breeder_style_name' => 'Kingsclere Stud',
                        'rp_newspaper_output_desc' => 'b',
                        'sire_uid' => 49191,
                        'dam_uid' => 716257,
                        'sire_avg_flat_wdp' => 9.1,
                        'sire_avg_jump_wdp' => 22.6,
                        'horse_sire_country' => 'GB',
                        'horse_sire_style_name' => 'Dashing Blade',
                        'horse_dam_country' => 'GB',
                        'horse_dam_style_name' => 'Inhibition',
                        'horse_dam_sire_style_name' => 'Nayef',
                        'horse_dam_sire_horse_uid' => 522845,
                        'dam_sire_sire_uid' => 304579,
                        'dam_sire_dam_uid' => 415950,
                        'dam_sire_country_origin_code' => 'USA',
                        'dam_sire_avg_flat_wdp' => 9.1,
                        'dam_sire_avg_jump_wdp' => 22.6,
                        'joint_2nd_fav' => 0,
                        'fav_2nd' => 0,
                        'each_way_placed' => 'N',
                    ],
                    [
                        'horse_uid' => 1488100,
                        'race_instance_uid' => 695416,
                        'race_status_code' => 'R',
                        'race_outcome_desc' => '2nd',
                        'race_outcome_code' => '2',
                        'race_outcome_position' => 2,
                        'race_outcome_uid' => 2,
                        'final_race_outcome_uid' => 2,
                        'weight_allowance_lbs' => 0,
                        'draw' => 1,
                        'race_outcome_joint_yn' => 'N',
                        'race_output_order' => 2,
                        'orig_race_output_order' => 2,
                        'jockey_uid' => 85680,
                        'jockey_style_name' => 'Adam Nicol',
                        'odds_desc' => '6/5F',
                        'odds_value' => 1.2,
                        'favourite_flag' => 'F',
                        'trainer_uid' => 18875,
                        'trainer_style_name' => 'Philip Kirby',
                        'owner_style_name' => 'David Gray & P Kirby',
                        'rp_owner_choice' => 'a',
                        'owner_uid' => 251385,
                        'disqualification_uid' => null,
                        'rp_distance_desc' => '1',
                        'dth_distance_value' => 1.0,
                        'first_time_yn' => 'N',
                        'dtw_sum_distance_value' => 1.0,
                        'saddle_cloth_no' => 7,
                        'saddle_cloth_letter' => null,
                        'horse_style_name' => 'Shine Baby Shine',
                        'horse_name' => 'SHINE BABY SHINE',
                        'country_origin_code' => 'GB',
                        'breeder_style_name' => 'Horizon Bloodstock Limited',
                        'rp_newspaper_output_desc' => 'b',
                        'sire_uid' => 685231,
                        'dam_uid' => 537416,
                        'sire_avg_flat_wdp' => 8.7,
                        'sire_avg_jump_wdp' => null,
                        'horse_sire_country' => 'GB',
                        'horse_sire_style_name' => 'Aqlaam',
                        'horse_dam_country' => 'USA',
                        'horse_dam_style_name' => 'Rosewood Belle',
                        'horse_dam_sire_style_name' => 'Woodman',
                        'horse_dam_sire_horse_uid' => 303747,
                        'dam_sire_sire_uid' => 301599,
                        'dam_sire_dam_uid' => 429407,
                        'dam_sire_country_origin_code' => 'USA',
                        'dam_sire_avg_flat_wdp' => 8.7,
                        'dam_sire_avg_jump_wdp' => null,
                        'joint_2nd_fav' => 0,
                        'fav_2nd' => 0,
                        'each_way_placed' => 'N',
                    ]
            ],
            //\Bo\Races:158 ->getRaceAttributes()
            '51408989c72cf8bfd96c249c2eee35ea' => [
                [
                    'race_attrib_desc' => "5",
                    'race_attrib_code' => 'Class_subset',
                    'race_attrib_uid'  => 85,
                    'race_instance_uid' => 1018540
                ]
            ],
            //Api\DataProvider\Bo\Meetings\ ->Tmp()
            'e6a74f273fe1abeb0114a7aadde407f6' => [
            ]
        ];
    }
}
