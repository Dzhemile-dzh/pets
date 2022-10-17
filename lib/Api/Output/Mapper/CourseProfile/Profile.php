<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 1/25/2016
 * Time: 12:20 PM
 */

namespace Api\Output\Mapper\CourseProfile;

class Profile extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            'course_clerk' => 'course_clerk',
            'course_tel' => 'course_tel',
            'course_scales_clerk' => 'course_scales_clerk',
            'course_judge' => 'course_judge',
            'course_stewards' => 'course_stewards',
            'course_starters' => 'course_starters',
            'course_type_code' => 'course_type_code',
            'country_code' => 'course_country_code',
        ];
    }
}
