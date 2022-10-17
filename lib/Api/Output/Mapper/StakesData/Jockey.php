<?php
namespace Api\Output\Mapper\StakesData;

use Api\Output\Mapper\HorsesMapper;

class Jockey extends HorsesMapper
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
