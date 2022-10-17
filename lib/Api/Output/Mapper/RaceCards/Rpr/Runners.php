<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/17/2014
 * Time: 11:03 AM
 */
namespace Api\Output\Mapper\RaceCards\Rpr;

class Runners extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(fixAroHorseName)style_name,country_origin_code' => 'style_name',
            '(setNullIfZero)weight_carried_lbs'=>'weight_carried_lbs',
            'horse_uid'=>'horse_uid',
            'rp_tops_old'=>'rp_tops_old',
            'rp_topspeed'=>'rp_topspeed',
            '(setNullIfZero)rp_postmark'=>'rp_postmark',
            'rp_pm_chars'=>'rp_pm_chars',
            'adjustment'=>'adjustment',
            '(dbYNFlagToBoolean)rpr_selections'=>'rpr_selections',
            'last_12_months'=>'last_12_months',
            'going'=>'going',
            'distance'=>'distance',
            'course'=>'course',
            'last_races'=>'last_races'
        ];
    }
}
