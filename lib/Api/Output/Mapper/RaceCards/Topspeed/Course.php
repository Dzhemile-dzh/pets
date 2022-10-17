<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/17/2014
 * Time: 11:03 AM
 */
namespace Api\Output\Mapper\RaceCards\Topspeed;

class Course extends TopspeedMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Row\Methods\GetDistanceInFurlong;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(setNullIfZero)rp_postmark' => 'rp_postmark',
            '(nullIfLessThanZero)rp_topspeed' => 'rp_topspeed',
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            'rp_abbrev_4' => 'rp_abbrev_4',
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_type_code' => 'race_type_code',
            'race_instance_title' => 'race_instance_title',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'rp_close_up_comment' => 'rp_close_up_comment',
            '(trim)race_outcome_code' => 'race_outcome_code',
            '(trim)services_desc' => 'services_desc',
            '(trim)race_group_code' => 'race_group_code',
            'no_runners' => 'no_runners',
            '(getAdjustedRpTopspeed)adjustment,rp_topspeed' => 'adjusted_rp_topspeed'
        ];
    }
}
