<?php

namespace Api\Result\RaceMeetings;

use Api\Result\Json as Result;

/**
 * Class DailyRaceMeetings
 *
 * @package Api\Result\RaceMeetings
 */
class DailyRaceMeetings extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'meetings' => '\Api\Output\Mapper\RaceMeetings\DailyRaceMeetings',
            'meetings.races' => '\Api\Output\Mapper\RaceMeetings\DailyRaces',
            'meetings.races.race_runners' => '\Api\Output\Mapper\RaceMeetings\DailyRunners',
            'meetings.races.race_runners.figures_calculated' => 'Api\Output\Mapper\RaceCards\Runners\Figures',
            'meetings.races.race_runners.jockey_last_14_days' => 'Api\Output\Mapper\RaceCards\Runners\JockeyStats',
        ];
    }
}
