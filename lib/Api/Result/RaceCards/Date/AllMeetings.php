<?php

namespace Api\Result\RaceCards\Date;

use Api\Result\Json as Result;

/**
 * Class AllMeetings
 *
 * @package Api\Result\RaceCards\Date
 */
class AllMeetings extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'all_meetings' => 'Api\Output\Mapper\RaceCards\Date\AllMeetings',
            'all_meetings.races' => 'Api\Output\Mapper\RaceCards\Date\Races',
        ];
    }
}
