<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 10/13/2015
 * Time: 12:10 PM
 */

namespace Api\Output\Mapper\RaceCards;

class BigRaces extends \Api\Output\Mapper\HorsesMapper
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
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(stringToURLkey)course_name' => 'course_key',
            'rp_abbrev_3' => 'course_rp_abbrev_3',
            'country_code' => 'country_code',
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_title' => 'race_title',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'race_class' => 'race_class',
            'race_type_code' => 'race_type_code',
            'race_status_code' => 'race_status_code',
            '(trim)going_type_code' => 'going_type_code',
            'rp_going_type_desc' => 'rp_going_type_desc',
            'rp_ages_allowed_desc' => 'rp_ages_allowed_desc'
        ];
    }
}
