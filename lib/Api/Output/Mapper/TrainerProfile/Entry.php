<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\TrainerProfile;

class Entry extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            'course_uid' => 'course_uid',
            'course_type_code' => 'course_type_code',
            '(prepareToDiffusion)course_style_name' => 'diffusion_course_name',
            '(stringToURLkey)course_style_name' => 'course_key',
            'race_instance_title' => 'race_instance_title',
            'race_status_code' => 'race_status_code',
            'race_group_uid' => 'race_group_uid',
            'race_group_desc' => 'race_group_desc',
            'running_conditions' => 'running_conditions',
            'race_type_code' => 'race_type_code',
            'race_type_desc' => 'race_type_desc'
        ];
    }
}
