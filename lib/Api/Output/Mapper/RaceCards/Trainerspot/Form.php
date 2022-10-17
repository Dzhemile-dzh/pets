<?php

namespace Api\Output\Mapper\RaceCards\Trainerspot;

/**
 * Class Form
 *
 * @package Api\Output\Mapper\RaceCards\Trainerspot
 */
class Form extends \Api\Output\Mapper\HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'trainer_uid' => 'trainer_uid',
            'trainer_style_name' => 'trainer_style_name',
            'runs' => 'runs',
            'wins' => 'wins',
            'running_to_form' => 'running_to_form',
            '(getPercent)wins,runs' => 'win_percent',
            'last14_days_fin_pos' => 'last14_days_fin_pos'
        ];
    }
}
