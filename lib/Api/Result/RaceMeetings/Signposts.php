<?php

namespace Api\Result\RaceMeetings;

use Api\Result\Json as Result;

/**
 * Class Signposts
 *
 * @package Api\Result\RaceMeetings
 */
class Signposts extends Result
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'signposts.travelers_check' => '\Api\Output\Mapper\RaceMeetings\Signposts\TravelersCheck',
            'signposts.first_time_blinkers' => '\Api\Output\Mapper\RaceMeetings\Signposts\FirstTimeBlinkers',
            'signposts.seven_day_winners' => '\Api\Output\Mapper\RaceMeetings\Signposts\SevenDayWinners',
            'signposts.seven_day_winners.upcoming_race'
                => '\Api\Output\Mapper\RaceMeetings\Signposts\SevenDayWinners\UpcomingRace',
        ];
    }
}
