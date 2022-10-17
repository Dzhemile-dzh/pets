<?php

namespace Api\Output\Mapper\CourseProfile;

/**
 * Class Profile
 *
 * @package Api\Output\Mapper\CourseProfile
 */
class Standard extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(removeDotFromAwCourse)course_style_name' => 'course_name',
            '(getCourseContinent)country_code' => 'course_region',
            'country_code' => 'course_country_code',
            'course_type_code' => 'course_type_code',
            'course_clerk' => 'course_clerk',
            'course_tel' => 'course_tel',
            'course_scales_clerk' => 'course_scales_clerk',
            'course_judge' => 'course_judge',
            'course_stewards' => 'course_stewards',
            'course_starters' => 'course_starters',
        ];
    }
}
