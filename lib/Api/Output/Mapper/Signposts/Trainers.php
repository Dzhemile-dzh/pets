<?php

namespace Api\Output\Mapper\Signposts;

class Trainers extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            'd7_wins' => 'wins',
            'd7_runs' => 'runs',
            'd7_perc' => 'percentage',
            'entries' => 'entries'
        ];
    }
}
