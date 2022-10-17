<?php

namespace Api\Output\Mapper\RaceCards;

class TopDraw extends \Api\Output\Mapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'no_of_runners' => 'declared_runners',
            'distance' => 'distance',
            'going_type_code' => 'going',
            'stalls' => 'stalls',
            'low_final' => 'low',
            'low_wins' => 'low_wins',
            'mid_final' => 'mid',
            'mid_wins' => 'mid_wins',
            'high_final' => 'high',
            'high_wins' => 'high_wins',
            'races' => 'races',
        ];
    }
}
