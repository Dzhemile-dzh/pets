<?php

namespace Api\Result\Signposts;

class CourseJockeys extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'courses' => '\Api\Output\Mapper\Signposts\CoursesJockeys',
            'courses.jockeys' => '\Api\Output\Mapper\Signposts\Jockeys',
            'courses.jockeys.entries' => '\Api\Output\Mapper\Signposts\Entry',
        ];
    }
}
