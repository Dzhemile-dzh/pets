<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/17/2014
 * Time: 11:03 AM
 */
namespace Api\Output\Mapper\RaceCards\Rpr;

class Distance extends RprMapper
{
    use \Api\Row\Methods\GetDistanceInFurlong;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(setNullIfZero)rp_postmark' => 'rp_postmark',
            'rp_topspeed' => 'rp_topspeed',
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)style_name' => 'course_style_name',
            '(stringToURLkey)style_name' => 'course_key',
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_type_code' => 'race_type_code',
            'race_instance_title' => 'race_instance_title',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'rp_close_up_comment' => 'rp_close_up_comment',
            'race_outcome_code' => 'race_outcome_code',
            'services_desc' => 'services_desc',
            'no_runners' => 'no_runners',
            '(getAdjustedRpPostmark)adjustment,rp_postmark' => 'adjusted_rp_postmark'
        ];
    }
}
