<?php

namespace Api\Output\Mapper\RaceCards\Topspeed;

class Runners extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_style_name',
            '(setNullIfZero)weight_carried_lbs' => 'weight_carried_lbs',
            'horse_uid' => 'horse_uid',
            'rp_topspeed_old' => 'rp_topspeed_old',
            '(nullIfLessThanZero)rp_topspeed' => 'rp_topspeed',
            '(setNullIfZero)rp_postmark' => 'rp_postmark',
            'rp_pm_chars' => 'rp_pm_chars',
            'adjustment' => 'adjustment',
            'best_topspeed' => 'best_topspeed',
            'last6ratings' => 'last6ratings'
        ];
    }
}
