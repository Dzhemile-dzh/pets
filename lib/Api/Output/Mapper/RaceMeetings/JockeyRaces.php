<?php

namespace Api\Output\Mapper\RaceMeetings;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class JockeyRaces
 *
 * @package Api\Output\Mapper\RaceMeetings\JockeyRaces
 */
class JockeyRaces extends HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'horses' => 'horses'
        ];
    }
}
