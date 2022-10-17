<?php

namespace Api\Output\Mapper\Results\ResultsDate;

/**
 * Class Runner
 * @package Api\Output\Mapper\Results\ResultsDate
 */
class Runner extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            'race_status_code' => 'race_status_code',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,country_origin_code' => 'horse_name',
            'saddle_cloth_no' => 'saddle_cloth_no',
            'saddle_cloth_letter' => 'saddle_cloth_letter',
            'race_outcome_code' => 'race_outcome_code',
            'race_outcome_desc' => 'race_outcome_desc',
            'race_outcome_position' => 'race_outcome_position',
            '(dbYNFlagToBoolean)race_outcome_joint_yn' => 'race_outcome_joint',
            'race_output_order' => 'race_output_order',
            'disqualification_uid' => 'disqualification_uid',
            'jockey_uid' => 'jockey_uid',
            'jockey_style_name' => 'jockey_name',
            'trainer_uid' => 'trainer_uid',
            'trainer_style_name' => 'trainer_name',
            'owner_style_name' => 'owner_name',
            'owner_uid' => 'owner_uid',
            'rp_owner_choice' => 'rp_owner_choice',
            '(getPngSilkImage)' => 'silk_image_png',
            'breeder_style_name' => 'breeder_name',
            'rp_distance_desc' => 'rp_distance_desc',
            'dtw_sum_distance_value' => 'distance_to_winner',
            'odds_desc' => 'odds_desc',
            '(boolval)fav_2nd' => '2nd_fav',
            '(boolval)joint_2nd_fav' => 'joint_2nd_fav',
            'odds_value' => 'odds_value',
            '(isFirstTimeHeadgear)' => 'first_time_headgear',
            'rp_newspaper_output_desc' => 'rp_newspaper_output_desc',

            'sire_uid' => 'sire.horse_uid',
            '(fixAroHorseName)horse_sire_style_name,horse_sire_country' => 'sire.horse_name',
            'horse_sire_country' => 'sire.horse_country_origin_code',
            'sire_avg_flat_wdp' => 'sire.avg_flat_win_dist_of_progeny',
            'sire_avg_jump_wdp' => 'sire.avg_jump_win_dist_of_progeny',

            'dam_uid' => 'dam.horse_uid',
            '(fixAroHorseName)horse_dam_style_name,horse_dam_country' => 'dam.horse_name',
            'horse_dam_country' => 'dam.horse_country_origin_code',

            'horse_dam_sire_horse_uid' => 'dam.sire.horse_uid',
            '(fixAroHorseName)horse_dam_sire_style_name,dam_sire_country_origin_code' => 'dam.sire.horse_name',
            'dam_sire_country_origin_code' => 'dam.sire.horse_country_origin_code',
            'dam_sire_avg_flat_wdp' => 'dam.sire.avg_flat_win_dist_of_progeny',
            'dam_sire_avg_jump_wdp' => 'dam.sire.avg_jump_win_dist_of_progeny',
            'dam_sire_sire_uid' => 'dam.sire.sire_uid',
            'dam_sire_dam_uid' => 'dam.sire.dam_uid',
            '(getSilkImagePath)' => 'silk_image_path',
            '(dbYNFlagToBoolean)each_way_placed' => 'each_way_placed'
        ];
    }
}
