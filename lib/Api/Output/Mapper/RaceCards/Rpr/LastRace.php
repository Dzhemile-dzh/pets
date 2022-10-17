<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/17/2014
 * Time: 11:03 AM
 */
namespace Api\Output\Mapper\RaceCards\Rpr;

class LastRace extends RprMapper
{
    use \Api\Row\Methods\GetDistanceInFurlong;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_type_code' => 'race_type_code',
            '(setNullIfZero)rp_postmark' => 'rp_postmark',
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)course_name' => 'course_style_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'race_outcome_code' => 'race_outcome_code',
            'services_desc' => 'services_desc',
            'rp_tops' => 'rp_topspeed',
            'rp_close_up_comment' => 'rp_close_up_comment',
            'calc_no_runners' => 'calc_no_runners',
            'race_group_code'=>'race_group_code',
            '(getAdjustedRpPostmark)adjustment,rp_postmark' => 'adjusted_rp_postmark'
        ];
    }
}
