<?php

namespace Api\Output\Mapper\RaceCards\StandardRunners;

use Api\Methods\TenToFollowHorse;

/**
 * Class Runner
 *
 * @package Api\Output\Mapper\RaceCards\StandardRunners
 */
class Runner extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Row\Methods\GetDistanceInFurlong;
    use TenToFollowHorse;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'saddle_cloth_no' => 'start_number',
            'draw' => 'draw',
            'race_type_code' => 'race_type_code',
            'race_status_code' => 'race_status_code',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'track_code' => 'track_code',
            'course_uid' => 'course_uid',
            'straight_round_jubilee_code' => 'straight_round_jubilee_code',
            'owner_uid' => 'owner_uid',
            'owner_name' => 'owner_name',
            'eliminator_no' => 'eliminator_no',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'rp_horse_head_gear_code' => 'rp_horse_head_gear_code',
            '(dbYNFlagToBoolean)first_time_yn' => 'first_time',
            '(dbYNFlagToBoolean)is_wind_surgery_first_time' => 'wind_surgery_first_time',
            '(dbYNFlagToBoolean)is_wind_surgery_second_time' => 'wind_surgery_second_time',
            '(setNullIfZero)extra_weight_lbs' => 'extra_weight_lbs',
            'horse_age' => 'horse_age',
            '(setNullIfZero)weight_carried_lbs' => 'weight_carried_lbs',
            'official_rating' => 'official_rating',
            'official_rating_today' => 'official_rating_today',
            'jockey_uid' => 'jockey_uid',
            'jockey_name' => 'jockey_name',
            '(setNullIfZero)weight_allowance_lbs' => 'weight_allowance_lbs',
            'trainer_uid' => 'trainer_id',
            'trainer_stylename' => 'trainer_stylename',
            'trainer_rtf' => 'trainer_rtf',
            '(trim)trainer_country_code' => 'trainer_country_code',
            '(setNullIfZero)rp_topspeed' => 'rp_topspeed',
            '(setNullIfZero)rp_postmark' => 'rp_postmark',
            'rp_owner_choice' => 'rp_owner_choice',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner',
            '(dbYNFlagToBoolean)irish_reserve_yn' => 'irish_reserve',
            'allowance' => 'allowance',
            'extra_weight' => 'extra_weight',
            'horse_colour_code' => 'horse_colour_code',
            'horse_sex_code' => 'horse_sex_code',
            'sire_id' => 'sire_id',
            'sire_name' => 'sire_name',
            'sire_country' => 'sire_country',
            'dam_id' => 'dam_id',
            'dam_name' => 'dam_name',
            'dam_country' => 'dam_country',
            'damsire_id' => 'damsire_id',
            'damsire_name' => 'damsire_name',
            'damsire_country' => 'damsire_country',
            'figures' => 'figures',
            'figures_calculated' => 'figures_calculated',
            '(getPngSilkImage)' => 'silk_image_png',
            'days_since_last_run' => 'days_since_last_run',
            'days_since_last_run_flat' => 'days_since_last_run_flat',
            'days_since_last_run_jumps' => 'days_since_last_run_jumps',
            'days_since_last_run_ptp' => 'days_since_last_run_ptp',
            'new_trainer_races_count' => 'new_trainer_races_count',
            'selection_cnt' => 'selection_cnt',
            '(isTenToFollowHorse)ten_to_follow_horse,reasoning,race_type_code' => 'ten_to_follow_horse',
            '(dbYNFlagToBoolean)plus10_horse' => 'plus10_horse',
            '(dbYNFlagToBoolean)yearling_bonus_horse' => 'yearling_bonus_horse',
            '(dbYNFlagToBoolean)beaten_favourite' => 'beaten_favourite',
            'course_and_distance_wins' => 'course_and_distance_wins',
            'course_wins' => 'course_wins',
            'distance_wins' => 'distance_wins',
            'lh_weight_carried_lbs' => 'lh_weight_carried_lbs',
            'out_of_handicap' => 'out_of_handicap',
            'running_conditions' => 'running_conditions',
            'country_origin_code' => 'country_origin_code',
            '(getSilkImagePath)' => 'silk_image_path',
            '(boolval)gelding_first_time' => 'gelding_first_time',
            'wfa_adjustment' => 'wfa_adjustment'
        ];
    }
}
