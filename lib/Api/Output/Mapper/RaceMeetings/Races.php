<?php

namespace Api\Output\Mapper\RaceMeetings;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class Races
 *
 * @package Api\Output\Mapper\RaceMeetings\Races
 */
class Races extends HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_title' => 'race_instance_title',
            'distance_yard' => 'distance_yard',
            '(trim)ri_going_type_code' => 'going_type_code',
            'ri_going_type_desc' => 'going_type_desc',
            'previous_goings' => 'previous_goings'
        ];
    }
}
