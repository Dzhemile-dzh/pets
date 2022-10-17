<?php
namespace Api\Result\RaceMeetings;

use Api\Result\Json as Result;

class NonRunners extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'non_runners' => '\Api\Output\Mapper\RaceMeetings\NonRunners',
            'non_runners.races' => '\Api\Output\Mapper\RaceMeetings\NonRunnersRaces',
            'non_runners.races.horses' => '\Api\Output\Mapper\RaceMeetings\NonRunnersHorses',
        ];
    }
}
