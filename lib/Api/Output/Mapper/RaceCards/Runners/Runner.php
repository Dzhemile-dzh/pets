<?php

namespace Api\Output\Mapper\RaceCards\Runners;

use Api\Methods\TenToFollowHorse;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * Class Runner
 *
 * @package Api\Output\Mapper\RaceCards\Runners
 */
class Runner extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Row\Methods\GetDistanceInFurlong;
    use LegacyDecorators;
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
            '(setNullIfZero)owner_uid' => 'owner_uid',
            'owner_name' => 'owner_name',
            'breeder_uid' => 'breeder_uid',
            'style_name' => 'breeder_name',
            'eliminator_no' => 'eliminator_no',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'rp_horse_head_gear_code' => 'rp_horse_head_gear_code',
            '(dbYNFlagToBoolean)first_time_yn' => 'first_time',
            '(dbYNFlagToBoolean)is_wind_surgery_first_time' => 'wind_surgery_first_time',
            '(dbYNFlagToBoolean)going_winner' => 'going_winner',
            '(dbYNFlagToBoolean)is_wind_surgery_second_time' => 'wind_surgery_second_time',
            '(dbYNFlagToBoolean)is_jockey_first_time' => 'jockey_first_time',
            '(setNullIfZero)extra_weight_lbs' => 'extra_weight_lbs',
            'horse_age' => 'horse_age',
            '(dateISO8601)horse_date_of_birth' => 'horse_date_of_birth',
            '(setNullIfZero)weight_carried_lbs' => 'weight_carried_lbs',
            'official_rating' => 'official_rating',
            'official_rating_today' => 'official_rating_today',
            '(dbYNFlagToBoolean)handicap_first_time' => 'handicap_first_time',
            '(setNullIfZero)jockey_uid' => 'jockey_uid',
            'jockey_name' => 'jockey_name',
            'aka_style_name' => 'short_jockey_name',
            '(setNullIfZero)weight_allowance_lbs' => 'weight_allowance_lbs',
            '(setNullIfZero)trainer_uid' => 'trainer_id',
            'trainer_stylename' => 'trainer_stylename',
            'short_trainer_name' => 'short_trainer_name',
            'trainer_rtf' => 'trainer_rtf',
            '(trim)trainer_country_code' => 'trainer_country_code',
            '(setNullIfZero)rp_topspeed' => 'rp_topspeed',
            '(setNullIfZero)rp_postmark' => 'rp_postmark',
            '(dbYNFlagToBoolean)rp_postmark_improver' => 'rp_postmark_improver',
            '(setNullIfZero)unadjusted_rp_postmark' => 'unadjusted_rp_postmark',
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
            'first_season_sire_id' => 'first_season_sire_id',
            'dam_id' => 'dam_id',
            'dam_name' => 'dam_name',
            'dam_country' => 'dam_country',
            'damsire_id' => 'damsire_id',
            'damsire_name' => 'damsire_name',
            'damsire_country' => 'damsire_country',
            'longSpotlight' => 'spotlight',
            'diomed' => 'diomed',
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
            'forecast_odds_value' => 'forecast_odds_value',
            'forecast_odds_desc' => 'forecast_odds_desc',
            '(forecastOddsStyle)forecast_odds_desc' => 'forecast_odds_style',
            'course_and_distance_wins' => 'course_and_distance_wins',
            'course_wins' => 'course_wins',
            'distance_wins' => 'distance_wins',
            'lh_weight_carried_lbs' => 'lh_weight_carried_lbs',
            'out_of_handicap' => 'out_of_handicap',
            'future_rating_difference' => 'future_rating_difference',
            'running_conditions' => 'running_conditions',
            'country_origin_code' => 'country_origin_code',
            '(getSilkImagePath)' => 'silk_image_path',
            '(boolval)gelding_first_time' => 'gelding_first_time',
            'wfa_adjustment' => 'wfa_adjustment',
            'owner_group_uid' => 'owner_group_uid',
            'official_rating_horse' => 'official_rating_horse',
            'slow_ground_flat_wins' => 'slow_ground_flat_wins',
            'slow_ground_jumps_wins' => 'slow_ground_jumps_wins',
            'fast_ground_wins' => 'fast_ground_wins',
            'jockey_last_14_days' => 'jockey_last_14_days'
        ];
    }
}
