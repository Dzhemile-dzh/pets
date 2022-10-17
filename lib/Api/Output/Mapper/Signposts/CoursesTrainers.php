<?php

namespace Api\Output\Mapper\Signposts;

class CoursesTrainers extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)course_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(trim)country_code' => 'course_country_code',
            'trainers' => 'trainers',
        ];
    }
}
