<?php

namespace Api\Output\Mapper\RaceCards\Trainerspot\CourseSpecialists;

/**
 * Class CourseSpecialists
 *
 * @package Api\Output\Mapper\RaceCards\Trainerspot\CourseSpecialists
 */
class CourseSpecialists extends \Api\Output\Mapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'description' => 'description',
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            'current_season' => 'current_season',
            'last_5_season' => 'last_5_season',
            'runners' => 'runners',
        ];
    }
}
