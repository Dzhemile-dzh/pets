<?php

namespace Api\Output\Mapper\RaceCards\Trainerspot\RaceTrace;

/**
 * Class Course
 *
 * @package Api\Output\Mapper\RaceCards\Trainerspot\RaceTrace
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
            'trainers' => 'trainers'
        ];
    }
}
