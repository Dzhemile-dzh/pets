<?php

namespace Api\Result\RaceMeetings;

use Api\Result\Json as Result;

/**
 * Class JockeyChanges
 *
 * @package Api\Result\RaceMeetings
 */
class JockeyChanges extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'jockey_changes' => '\Api\Output\Mapper\RaceMeetings\JockeyChanges',
            'jockey_changes.races' => '\Api\Output\Mapper\RaceMeetings\JockeyRaces',
            'jockey_changes.races.horses' => '\Api\Output\Mapper\RaceMeetings\JockeyHorses',
            'jockey_changes.races.horses.previous_jockeys' => '\Api\Output\Mapper\RaceMeetings\PreviousJockeys',
        ];
    }
}
