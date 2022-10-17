<?php
namespace Api\Output\Mapper\StakesData;

use Api\Output\Mapper\HorsesMapper;

class Trainer extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'wins' => 'wins',
            'runs' => 'runs',
            '(getPercent)wins,runs' => 'percent',
            '(getStake)' => 'stake',
        ];
    }
}
