<?php

namespace Api\Output\Mapper\RacecardsResults;

use Api\Output\Mapper\HorsesMapper;
use Api\Output\Mapper\Methods\LegacyDecorators;

/**
 * Class Runners
 * @package Api\Output\Mapper\RacecardsResults
 */
class Runners extends HorsesMapper
{
    use LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(convertToString)uid' => 'uid',
            'saddle_cloth_no' => 'saddleClothNumber',
            '(convertToString)days_since_last_run' => 'daysSinceLastRun',
            '(convertToString)days_since_last_run_flat' => 'daysSinceLastRunFlat',
            '(convertToString)days_since_last_run_jumps' => 'daysSinceLastRunJumps',
            '(convertToString)days_since_last_run_ptp' => 'daysSinceLastRunPTP',
            'draw' => 'draw',
            '(getSilkImagePath)' => 'silkURL',
            'irish_reserve_yn' => 'isReserve',
            'figures' => 'formFiguresString',
            'figures_calculated' => 'formFigures',
            'rp_topspeed_pre' => 'topspeedRating.preRace',
            'rp_topspeed_post' => 'topspeedRating.postRace',
            'rp_postmark_pre' => 'racingPostRating.preRace',
            'rp_postmark_post' => 'racingPostRating.postRace',
            'current_official_rating' => 'rating.official',
            'official_rating_ran_off' => 'rating.officialRanOff',
            'odds_desc' => 'startingPrice.fractional',
            'favourite_bool' => 'startingPrice.favourite',
            'favourite_flag' => 'startingPrice.favouriteType',
            'position' => 'position',
            '(setNullIfZero)weight_carried_lbs' => 'weightCarried.lbs',
            'weight_carried_kg' => 'weightCarried.kg',
            'dtw_sum_distance_value' => 'distanceFromWinner.lengths',
            'dth_distance_value' => 'distanceFromHorseInFront.lengths',
            '(setNullIfZero)expected_weight_carried_lbs' => 'expectedWeightCarried.lbs',
            'expected_weight_carried_kg' => 'expectedWeightCarried.kg',
            'over_weight_lbs' => 'weightOver.lbs',
            'over_weight_kg' => 'weightOver.kg',
            'extra_weight_lbs' => 'weightExtra.lbs',
            'extra_weight_kg' => 'weightExtra.kg',
            'non_runner' => 'isNonRunner',
            '(convertToString)trainer_uid' => 'trainer.uid',
            'trainer_style_name' => 'trainer.name',
            '(convertToString)trainer_rtf' => 'trainer.runnersToForm',
            'new_trainer_races_count' => 'trainer.newTrainerRacesCount',
            '(convertToString)jockey_uid' => 'jockey.uid',
            'jockey_style_name' => 'jockey.name',
            '(setNullIfZero)weight_allowance_lbs' => 'jockey.weightAllowance.lbs',
            'weight_allowance_kg' => 'jockey.weightAllowance.kg',
            '(convertToString)horse_uid' => 'horse.uid',
            '(strtoupper)horse_name' => 'horse.name.full',
            'horse_name' => 'horse.name.style',
            'horse_age' => 'horse.age',
            'horse_sex_desc' => 'horse.sex',
            'gelding_first_time' => 'horse.firstTimeGelding',
            'horse_country_origin_code' => 'horse.originCountryCode',
            'horse_colour_desc' => 'horse.colour',
            '(convertToString)dam_uid' => 'horse.dam.uid',
            'horse_dam_style_name' => 'horse.dam.name',
            'horse_dam_country' => 'horse.dam.originCountryCode',
            '(convertToString)sire_uid' => 'horse.sire.uid',
            'horse_sire_style_name' => 'horse.sire.name',
            'horse_sire_country' => 'horse.sire.originCountryCode',
            '(convertToString)owner_uid' => 'horse.owner.uid',
            'owner_style_name' => 'horse.owner.name',
            'horse_head_gear_desc' => 'headgear.description',
            '(dbYNtoBool)first_time_yn' => 'headgear.firstTime',
            '(dbYNFlagToBoolean)is_wind_surgery_first_time' => 'windOp.firstTimeWindOp',
            '(dbYNFlagToBoolean)is_wind_surgery_second_time' => 'windOp.secondTimeWindOp',
            '(trimAndNullifyString)longSpotlight' => 'comments.longSpotlight',
            '(trimAndNullifyString)shortSpotlight' => 'comments.spotlight',
            '(trimAndNullifyString)rp_close_up_comment' => 'comments.closeUp',
            'selection_cnt' => 'numberTips',
            'tips' => 'tippedBy',
            'premium_tips' => 'premiumTips',
            'beaten_favourite' => 'labels.beatenFavourite',
            'course_winner' => 'labels.courseWinner',
            'distance_winner' => 'labels.distanceWinner',
            'course_distance_winner' => 'labels.courseDistanceWinner'
        ];
    }
}
