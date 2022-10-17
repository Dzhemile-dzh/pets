<?php

namespace Api\Output\Mapper\RaceCards\Trainerspot\RaceTrace;

/**
 * Class Stats
 *
 * @package Api\Output\Mapper\RaceCards\Trainerspot\RaceTrace
 */
class Stats extends \Api\Output\Mapper\HorsesMapper
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
