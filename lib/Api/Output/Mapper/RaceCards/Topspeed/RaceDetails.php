<?php

namespace Api\Output\Mapper\RaceCards\Topspeed;

class RaceDetails extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Row\Methods\GetDistanceInFurlong;
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_status_code'=>'race_status_code',
            'race_type_code'=>'race_type_code',
            'race_group_code'=>'race_group_code',
            '(dateISO8601)race_datetime'=>'race_datetime',
            '(trim)country_code'=>'country_code',
            '(getCourseContinent)country_code' => 'course_region',
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)course_name'=>'course_style_name',
            '(stringToURLkey)course_name' => 'course_key',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            'rp_going_type_desc'=>'rp_going_type_desc',
            '(trim)race_group_code' => 'race_group_code',
            'distance_yard'=>'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
        ];
    }
}
