<?php

namespace Api\Output\Mapper\Signposts;

class HotTrainers extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            'wins_14' => 'wins',
            'runs_14' => 'runs',
            'percentage' => 'percentage',
            'entries' => 'entries',
        ];
    }
}
