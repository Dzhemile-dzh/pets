<?php

namespace Api\Output\Mapper\SeasonalStatistics;

class OwnerTopTrainer extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'trainer_uid' => 'trainer_uid',
            'trainer_style_name' => 'trainer_style_name',
            'mirror_name' => 'trainer_short_name',
            'wins' => 'wins',
            'runs' => 'runs',
            '(getPercent)wins,runs' => 'percent_wins_runs',
        ];
    }
}
