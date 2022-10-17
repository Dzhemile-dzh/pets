<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/17/2014
 * Time: 11:03 AM
 */
namespace Api\Output\Mapper\RaceCards\OfficialRating;

class Runners extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            '(setNullIfZero)weight_carried_lbs' => 'weight_carried_lbs',
            'extra_weight' => 'extra_weight',
            'official_rating' => 'official_rating',
            'official_rating_today' => 'official_rating_today',
            'adjustment' => 'adjustment',
            'jockey_id' => 'jockey_id',
            'saddle_cloth_no' => 'saddle_cloth_no',
            'last_races' => 'last_races',
            'lifetime_high' => 'lifetime_high',
            'lifetime_low' => 'lifetime_low',
            'annual_high' => 'annual_high',
            'annual_low' => 'annual_low',
            'future_rating_difference' => 'future_rating_difference',
            'lh_weight_carried_lbs' => 'lh_weight_carried_lbs',
            'out_of_handicap' => 'out_of_handicap',
        ];
    }
}
