<?php

namespace Api\Output\Mapper\RaceMeetings;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\Mapper\Methods\LegacyDecorators;
use Api\Bo\Traits\FinalRaceCheck;

/**
 * Class DailyRunners
 *
 * @package Api\Output\Mapper\RaceMeetings\DailyRunners
 */
class DailyRunners extends HorsesMapper
{
    use \Api\Row\Methods\GetDistanceInFurlong;
    use LegacyDecorators;
    use FinalRaceCheck;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            'horse_age' => 'horse_age',
            'horse_colour_code' => 'horse_colour_code',
            '(dateISO8601)horse_date_of_birth' => 'horse_date_of_birth',
            'horse_sex_code' => 'horse_sex_code',
            'allowance' => 'allowance',
            '(dbYNFlagToBoolean)beaten_favourite' => 'beaten_favourite',
            'country_origin_code' => 'country_origin_code',
            'course_and_distance_wins' => 'course_and_distance_wins',
            'course_wins' => 'course_wins',
            'dam_country' => 'dam_country',
            'dam_id' => 'dam_id',
            'dam_name' => 'dam_name',
            'damsire_country' => 'damsire_country',
            'damsire_id' => 'damsire_id',
            'damsire_name' => 'damsire_name',
            'days_since_last_run' => 'days_since_last_run',
            'days_since_last_run_flat' => 'days_since_last_run_flat',
            'days_since_last_run_jumps' => 'days_since_last_run_jumps',
            'days_since_last_run_ptp' => 'days_since_last_run_ptp',
            'diomed' => 'diomed',
            '(getDistanceInFurlong)distance_yard' => 'distance_furlong_rounded',
            'distance_wins' => 'distance_wins',
            'distance_yard' => 'distance_yard',
            'draw' => 'draw',
            'eliminator_no' => 'eliminator_no',
            'extra_weight' => 'extra_weight',
            '(setNullIfZero)extra_weight_lbs' => 'extra_weight_lbs',
            'fast_ground_wins' => 'fast_ground_wins',
            'figures' => 'figures',
            'figures_calculated' => 'figures_calculated',
            '(getFirstSixElements)figures_calculated,figures' => 'form_figures',
            'first_season_sire_id' => 'first_season_sire_id',
            '(dbYNFlagToBoolean)first_time_yn' => 'first_time',
            'forecast_odds_desc' => 'forecast_odds_desc',
            '(forecastOddsStyle)forecast_odds_desc' => 'forecast_odds_style',
            'forecast_odds_value' => 'forecast_odds_value',
            '(boolval)gelding_first_time' => 'gelding_first_time',
            '(dbYNFlagToBoolean)going_winner' => 'going_winner',
            '(dbYNFlagToBoolean)handicap_first_time' => 'handicap_first_time',
            '(dbYNFlagToBoolean)irish_reserve_yn' => 'irish_reserve',
            '(dbYNFlagToBoolean)is_jockey_first_time' => 'jockey_first_time',
            'jockey_last_14_days' => 'jockey_last_14_days',
            'jockey_name' => 'jockey_name',
            '(setNullIfZero)jockey_uid' => 'jockey_uid',
            'lh_weight_carried_lbs' => 'lh_weight_carried_lbs',
            'new_trainer_races_count' => 'new_trainer_races_count',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner',
            'official_rating' => 'official_rating',
            'official_rating_horse' => 'official_rating_horse',
            'official_rating_today' => 'official_rating_today',
            'out_of_handicap' => 'out_of_handicap',
            'owner_group_uid' => 'owner_group_uid',
            'owner_name' => 'owner_name',
            '(setNullIfZero)owner_uid' => 'owner_uid',
            '(dbYNFlagToBoolean)plus10_horse' => 'plus10_horse',
            'rp_horse_head_gear_code' => 'rp_horse_head_gear_code',
            'rp_owner_choice' => 'rp_owner_choice',
            '(setNullIfZero)rp_postmark' => 'rp_postmark',
            '(dbYNFlagToBoolean)rp_postmark_improver' => 'rp_postmark_improver',
            '(getRpTopSpeed)num_topspeed_best_rating,rp_topspeed,race_datetime,race_status_code' => 'rp_topspeed',
            'running_conditions' => 'running_conditions',
            '(getSilkImagePath)' => 'silk_image_path',
            '(getPngSilkImage)' => 'silk_image_png',
            'sire_country' => 'sire_country',
            'sire_id' => 'sire_id',
            'sire_name' => 'sire_name',
            'slow_ground_flat_wins' => 'slow_ground_flat_wins',
            'slow_ground_jumps_wins' => 'slow_ground_jumps_wins',
            'longSpotlight' => 'spotlight',
            '(strval)star_rating' => 'star_rating',
            'saddle_cloth_no' => 'start_number',
            'straight_round_jubilee_code' => 'straight_round_jubilee_code',
            'selection_cnt' => 'num_tips',
            '(trim)trainer_country_code' => 'trainer_country_code',
            '(setNullIfZero)trainer_uid' => 'trainer_id',
            'trainer_rtf' => 'trainer_rtf',
            'trainer_stylename' => 'trainer_stylename',
            '(setNullIfZero)weight_allowance_lbs' => 'weight_allowance_lbs',
            '(setNullIfZero)weight_carried_lbs' => 'weight_carried_lbs',
            'wfa_adjustment' => 'wfa_adjustment',
            '(dbYNFlagToBoolean)is_wind_surgery_first_time' => 'wind_surgery_first_time',
            '(dbYNFlagToBoolean)is_wind_surgery_second_time' => 'wind_surgery_second_time',
            '(dbYNFlagToBoolean)yearling_bonus_horse' => 'yearling_bonus_horse'
        ];
    }

    /**
     * @param $num_topspeed_best_rating
     * @param $rp_topspeed
     * @param $raceDatetime
     * @param $raceStatusCode
     * @return mixed
     * @throws \Exception
     */
    public function getRpTopSpeed($num_topspeed_best_rating, $rp_topspeed, $raceDatetime, $raceStatusCode)
    {
        $topSpeed = $rp_topspeed;
        if ($this->checkIsFinalRaceByFields($raceDatetime, $raceStatusCode)) {
            $topSpeed = $num_topspeed_best_rating;
        }

        return $topSpeed > 0 ? $topSpeed : null;
    }
}
