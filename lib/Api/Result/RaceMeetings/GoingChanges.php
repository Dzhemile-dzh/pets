<?php

namespace Api\Result\RaceMeetings;

use Api\Result\Json as Result;

/**
 * Class GoingChanges
 *
 * @package Api\Result\RaceMeetings
 */
class GoingChanges extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'going_changes' => '\Api\Output\Mapper\RaceMeetings\GoingChanges',
            'going_changes.races' => '\Api\Output\Mapper\RaceMeetings\Races',
            'going_changes.races.previous_goings' => '\Api\Output\Mapper\RaceMeetings\PreviousGoings',
        ];
    }
}
