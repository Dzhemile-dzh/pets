<?php

declare(strict_types=1);

namespace Tests\Controllers\Horses\Races\OneTwoThreeById;

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
        return '/horses/races/769558/one-two-three';
    }

    /**
     * @return array
     */
    public function getPseudoPdoData(): array
    {
        return [
            //\Bo\Races\:326 ->getRaceDateRunnersById()
            'e95ac36f753b4f0be24598ee06294f57' => [
                [
                    'race_instance_uid' => 769558,
                    'race_status_code' => "R",
                    'race_type_code' => "X",
                    'race_outcome_code' => "1",
                    'race_outcome_desc' => "1st",
                    'race_outcome_position' => 1,
                    'race_outcome_joint_yn' => "N",
                    'race_output_order' => 1,
                    'race_outcome_uid' => 1,
                    'orig_race_output_order' => 1,
                    'horse_uid' => 3164298,
                    'weight_allowance_lbs' => 0,
                    'rp_owner_choice' => "a",
                    'disqualification_uid' => null,
                    'jockey_uid' => 80421,
                    'jockey_style_name' => "Stevie Donohoe",
                    'odds_desc' => "6/1",
                    'favourite_flag' => null,
                    'odds_value' => 6.0,
                    'trainer_uid' => 28913,
                    'trainer_style_name' => "Charlie Fellowes",
                    'owner_style_name' => "D R J King",
                    'owner_uid' => 254202,
                    'course_uid' => 1353,
                    'rp_distance_desc' => null,
                    'distance_desc' => null,
                    'dth_distance_value' => null,
                    'first_time_yn' => "N",
                    'dtw_sum_distance_value' => null,
                    'saddle_cloth_no' => 13,
                    'saddle_cloth_letter' => null,
                    'draw' => 5,
                    'horse_style_name' => "Vadream",
                    'horse_name' => "VADREAM",
                    'country_origin_code' => "GB",
                    'breeder_style_name' => "Crispin Estates Ltd",
                    'rp_newspaper_output_desc' => "b",
                    'sire_uid' => 860893,
                    'dam_uid' => 845707,
                    'sire_avg_flat_wdp' => 6.6,
                    'sire_avg_jump_wdp' => null,
                    'horse_sire_country' => "AUS",
                    'horse_sire_style_name' => "Brazen Beau",
                    'horse_dam_country' => "IRE",
                    'horse_dam_style_name' => "Her Honour",
                    'horse_dam_sire_style_name' => "Shamardal",
                    'horse_dam_sire_horse_uid' => 602045,
                    'dam_sire_sire_uid' => 513047,
                    'dam_sire_dam_uid' => 448926,
                    'dam_sire_country_origin_code' => "USA",
                    'dam_sire_avg_flat_wdp' => 6.6,
                    'dam_sire_avg_jump_wdp' => null,
                    'joint_2nd_fav' => 0,
                    'fav_2nd' => 0,
                    'each_way_placed' => "N",
                ]
            ],
            'bb1fd7281b271f4523518a171d0e2f75' => [
                [
                    'race_attrib_desc' => "2yo",
                    'race_attrib_code' => "Age",
                    'race_attrib_uid'  => 1,
                    'race_instance_uid' => 769558,
                ]
            ]
        ];
    }
}