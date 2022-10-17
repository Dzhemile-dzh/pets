<?php

namespace Api\Output\Mapper\RaceCards\Trainerspot\JockeyBookings;

/**
 * Class Runners
 *
 * @package Api\Output\Mapper\RaceCards\Trainerspot\JockeyBookings
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
            '(dateISO8601)race_datetime' => 'race_datetime',
        ];
    }
}
