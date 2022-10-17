<?php

namespace Api\Output\Mapper\RaceCards\Trainerspot\CourseSpecialists;

/**
 * Class Course
 *
 * @package Api\Output\Mapper\RaceCards\Trainerspot\CourseSpecialists
 */
class Course extends \Api\Output\Mapper
{
    use \Api\Methods\RemoveDotFromAwCourse;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)course_name' => 'course_name',
            'course_specialists' => 'course_specialists'
        ];
    }
}
