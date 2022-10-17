<?php

namespace Api\Output\Mapper\RaceCards\Trainerspot\JockeyBookings;

/**
 * Class Course
 *
 * @package Api\Output\Mapper\RaceCards\Trainerspot\JockeyBookings
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
            'jockey_bookings' => 'jockey_bookings'
        ];
    }
}
