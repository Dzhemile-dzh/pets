<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\Results;

use Api\Output\Mapper\Methods\LegacyDecorators;

class Result extends \Api\Output\Mapper\HorsesMapper
{
    use LegacyDecorators;

    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_style_name',
            'horse_country_origin_code' => 'horse_country_origin_code',
            'horse_age' => 'horse_age',
            '(getHorseSex)' => 'horse_sex_code',
            'horse_colour_code' => 'horse_colour_code',
            'saddle_cloth_no' => 'saddle_cloth_no',
            'draw' => 'draw',
            'rp_horse_head_gear_code' => 'horse_head_gear',
            '(isFirstTimeHeadgear)' => 'first_time_headgear',
            '(dbYNFlagToBoolean)is_wind_surgery_first_time' => 'wind_surgery_first_time',
            '(dbYNFlagToBoolean)is_wind_surgery_second_time' => 'wind_surgery_second_time',
            'weight_carried_lbs' => 'weight_carried_lbs',
            'extra_weight_lbs' => 'extra_weight_lbs',
            'over_weight_lbs' => 'over_weight_lbs',
            'out_of_handicap_lbs' => 'out_of_handicap_lbs',
            'final_race_outcome_position' => 'race_outcome_position',
            'final_race_outcome_code' => 'race_outcome_code',
            'final_race_outcome_desc' => 'race_outcome_desc',
            '(dbYNFlagToBoolean)final_race_outcome_joint_yn' => 'race_outcome_joint',
            'orig_race_output_order' => 'race_output_order',
            'disqualification_uid' => 'disqualification_uid',
            'race_outcome_uid' => 'race_outcome_uid',
            'final_race_outcome_uid' => 'final_race_outcome_uid',
            'starting_price_odds_uid' => 'starting_price_odds_uid',
            '(trim)rp_betting_movements' => 'rp_betting_movements',
            'odds_desc' => 'odds_desc',
            '(boolval)fav_1st' => '1st_fav',
            '(boolval)joint_1st_fav' => 'joint_1st_fav',
            '(boolval)fav_2nd' => '2nd_fav',
            '(boolval)joint_2nd_fav' => 'joint_2nd_fav',
            'rp_distance_desc' => 'rp_distance_desc',
            '(roundToTwoDecimalPoints)dtw_sum_distance_value' => 'distance_to_winner',
            'dist_to_horse_in_front_uid' => 'dist_to_horse_in_front_uid',
            'distance_to_winner_uid' => 'distance_to_winner_uid',
            'official_rating_ran_off' => 'official_rating_ran_off',
            'jockey_uid' => 'jockey_uid',
            'jockey_style_name' => 'jockey_style_name',
            'jockey_aka_style_name' => 'jockey_aka_style_name',
            'weight_allowance_lbs' => 'weight_allowance_lbs',
            'trainer_uid' => 'trainer_uid',
            'trainer_style_name' => 'trainer_style_name',
            'trainer_mirror_name' => 'trainer_mirror_name',
            'owner_uid' => 'owner_uid',
            'owner_style_name' => 'owner_style_name',
            'rp_owner_choice' => 'rp_owner_choice',
            '(getPngSilkImage)' => 'silk_image_png',
            'breeder_style_name' => 'breeder_style_name',
            '(prepareComment)rp_close_up_comment,notes' => 'rp_close_up_comment',
            'rp_postmark' => 'rp_postmark',
            '(getTopSpeed)' => 'rp_topspeed',
            'rp_ages_allowed_desc' => 'ages_allowed_desc',
            'rp_newspaper_output_desc' => 'rp_newspaper_output_desc',
            'sire_uid' => 'sire.horse_uid',
            '(fixAroHorseName)horse_sire_style_name,horse_sire_country' => 'sire.horse_name',
            'horse_sire_country' => 'sire.horse_country_origin_code',
            'first_season_sire_id' => 'sire.first_season_sire_id',
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
            'next_race' => 'next_race',
            'prev_race' => 'prev_race',
            '(getSilkImagePath)' => 'silk_image_path',
            'wfa_adjustment' => 'wfa_adjustment',
            'owner_group_uid' => 'owner_group_uid',
        ];
    }

    private function prepareComment($rpComment, $note)
    {
        if (!is_null($note)) {
            $rpComment .= ' (' . $note . ')';
        }
        return $rpComment;
    }
}
