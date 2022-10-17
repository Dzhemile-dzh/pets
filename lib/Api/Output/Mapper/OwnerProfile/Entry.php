<?php
/**
 * Created by PhpStorm.
 * User: Kateryna_Vozniuk
 * Date: 2/10/2015
 * Time: 4:52 PM
 */

namespace Api\Output\Mapper\OwnerProfile;

use Api\Methods\RemoveDotFromAwCourse;

class Entry extends \Api\Output\Mapper\HorsesMapper
{
    use RemoveDotFromAwCourse;

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
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            'race_instance_title' => 'race_instance_title',
            'race_status_code' => 'race_status_code',
            'running_conditions' => 'running_conditions',
        ];
    }
}
