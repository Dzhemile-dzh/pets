<?php

namespace Api\Result\Signposts;

class CourseTrainers extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'courses' => '\Api\Output\Mapper\Signposts\CoursesTrainers',
            'courses.trainers' => '\Api\Output\Mapper\Signposts\Trainers',
            'courses.trainers.entries' => '\Api\Output\Mapper\Signposts\Entry',
        ];
    }
}
