<?php

namespace Api\Output\Mapper\RaceMeetings;

class Favourites extends \Api\Output\Mapper\HorsesMapper
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
            '(getStake)' => 'stake',
            '(getPercent)wins,runs' => 'percentage',
        ];
    }
}
