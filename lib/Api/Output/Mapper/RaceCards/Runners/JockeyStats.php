<?php

namespace Api\Output\Mapper\RaceCards\Runners;

/**
 * Class JockeyStats
 * @package Api\Output\Mapper\RaceCards\Runners
 */
class JockeyStats extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'wins' => 'wins',
            'runs' => 'runs',
            '(GetPercent)wins,runs' => 'percent'
        ];
    }
}
