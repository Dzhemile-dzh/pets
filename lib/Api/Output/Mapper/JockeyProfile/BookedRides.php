<?php
namespace Api\Output\Mapper\JockeyProfile;

use Api\Output\Mapper\HorsesMapper;
use Api\Methods\RemoveDotFromAwCourse;

class BookedRides extends HorsesMapper
{
    use RemoveDotFromAwCourse;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_uid',
            '(intval)race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            'course_type_code' => 'course_type_code',
            'course_uid' => 'course_uid',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            'race_instance_title' => 'race_instance_title',
            'race_status_code' => 'race_status_code',
            '(fixAroHorseName)horse_style_name,country_origin_code' => 'horse_name',
            'horse_uid' => 'horse_uid',
            'running_conditions' => 'running_conditions',
            'race_type_code' => 'race_type_code',
            'race_type_desc' => 'race_type_desc'
        ];
    }
}
