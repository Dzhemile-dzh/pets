<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/17/2014
 * Time: 11:03 AM
 */
namespace Api\Output\Mapper\RaceCards\OfficialRating;

class AnnualHigh extends \Api\Output\Mapper\HorsesMapper
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
            '(setNullIfZero)rp_topspeed' => 'rp_topspeed',
            'official_rating_ran_off' => 'official_rating_ran_off',
            'race_type_code' => 'race_type_code',
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_title' => 'race_instance_title',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'rp_close_up_comment' => 'rp_close_up_comment',
            'race_outcome_code' => 'race_outcome_code',
            'services_desc' => 'services_desc',
            'race_group_code' => 'race_group_code',
            'no_runners' => 'no_runners',
        ];
    }
}
