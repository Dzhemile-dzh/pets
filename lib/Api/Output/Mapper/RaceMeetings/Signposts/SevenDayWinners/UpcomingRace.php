<?php

namespace Api\Output\Mapper\RaceMeetings\Signposts\SevenDayWinners;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class UpcomingRace
 *
 * @package Api\Output\Mapper\RaceMeetings\Signposts\SevenDayWinners
 */
class UpcomingRace extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
        ];
    }
}
