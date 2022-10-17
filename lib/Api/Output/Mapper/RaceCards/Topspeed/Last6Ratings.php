<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\RaceCards\Topspeed;

class Last6Ratings extends TopspeedMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Row\Methods\GetDistanceInFurlong;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            '(nullIfLessThanZero)rp_topspeed' => 'rp_topspeed',
            'race_type_code' => 'race_type_code',
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            'rp_abbrev_4' => 'rp_abbrev_4',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            '(trim)services_desc' => 'services_desc',
            'race_outcome_position' => 'race_outcome_position',
            '(trim)race_outcome_code' => 'race_outcome_code',
            '(setNullIfZero)rp_postmark' => 'rp_postmark',
            'rp_close_up_comment' => 'rp_close_up_comment',
            '(trim)race_group_code' => 'race_group_code',
            'no_runners' => 'no_runners',
            '(getAdjustedRpTopspeed)adjustment,rp_topspeed' => 'adjusted_rp_topspeed'
        ];
    }
}
