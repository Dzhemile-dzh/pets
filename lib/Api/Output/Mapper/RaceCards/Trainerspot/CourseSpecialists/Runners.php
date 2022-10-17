<?php

namespace Api\Output\Mapper\RaceCards\Trainerspot\CourseSpecialists;

/**
 * Class Runners
 *
 * @package Api\Output\Mapper\RaceCards\Trainerspot\CourseSpecialists
 */
class Runners extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_style_name' => 'horse_name',
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
        ];
    }
}
