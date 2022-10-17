<?php

namespace Api\Output\Mapper\RaceCards\Trainerspot\RaceTrace;

/**
 * Class Trainers
 *
 * @package Api\Output\Mapper\RaceCards\Trainerspot\RaceTrace
 */
class Trainers extends \Api\Output\Mapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'stats' => 'stats',
            'past_performance' => 'past_performance',
            'today_runners' => 'today_runners'
        ];
    }
}
