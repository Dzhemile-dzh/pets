<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/30/2016
 * Time: 4:45 PM
 */

namespace Api\Output\Mapper\GoingToSuit;

use \Api\Row\Methods\GetDistanceInFurlong;

class Race extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use GetDistanceInFurlong;
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            'race_instance_title' => 'race_instance_title',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'going_type_code' => 'going_type_code',
            '(trim)country_code' => 'country_code',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'race_type_code' => 'race_type_code',
            'going_type_desc' => 'going_type_desc',
            'race_status_code' => 'race_status_code',
            'race_group_code' => 'race_group_code',
            'race_group_desc' => 'race_group_desc',
            'perform_race_uid_atr' => 'perform_race_uid_atr',
            'perform_race_uid_ruk' => 'perform_race_uid_ruk',
            'no_of_runners' => 'no_of_runners',
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            'declared_runners' => 'declared_runners',
            'horses' => 'horses',
        ];
    }
}
