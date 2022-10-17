<?php

namespace Api\Output\Mapper\Results;

class Search extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
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
            '(trim)country_code' => 'country_code',
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(stringToURLkey)course_name' => 'course_key',
        ];
    }
}
