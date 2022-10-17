<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/17/2014
 * Time: 11:03 AM
 */
namespace Api\Output\Mapper\RaceCards\Rpr;

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
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)course_name'=>'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(stringToURLkey)course_name' => 'course_key',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(dateISO8601)race_datetime'=>'race_datetime',
            'race_status_code'=>'race_status_code',
            'race_type_code'=>'race_type_code',
            '(trim)country_code'=>'country_code',
            'rp_going_type_desc'=>'rp_going_type_desc',
            'distance_yard'=>'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'race_group_code'=>'race_group_code',
        ];
    }
}
