<?php

namespace Api\Output\Mapper\RaceCards\Trainerspot;

class Season extends \Api\Output\Mapper\HorsesMapper
{
    use \RP\Util\Math\GetPercent;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'wins' => 'wins',
            'runs' => 'runs',
            '(getPercent)wins,runs' => 'percent',
            '(roundNullable)stake,2' => 'profit'
        ];
    }
}
