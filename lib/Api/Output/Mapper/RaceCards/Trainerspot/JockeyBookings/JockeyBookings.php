<?php

namespace Api\Output\Mapper\RaceCards\Trainerspot\JockeyBookings;

/**
 * Class JockeyBookings
 *
 * @package Api\Output\Mapper\RaceCards\Trainerspot\JockeyBookings
 */
class JockeyBookings extends \Api\Output\Mapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'jockey_uid' => 'jockey_uid',
            'jockey_name' => 'jockey_name',
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            'current_course_season' => 'current_course_season',
            'current_season' => 'current_season',
            'course_5_season' => 'course_5_season',
            'last_5_season' => 'last_5_season',
            'runners' => 'runners',
        ];
    }
}
