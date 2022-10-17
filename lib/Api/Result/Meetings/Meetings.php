<?php

namespace Api\Result\Meetings;

use Api\Result\Json as Result;

/**
 * Class Meetings
 * @package Api\Result\Meetings
 */
class Meetings extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'meetings'       => 'Api\Output\Mapper\Meetings\Meetings',
            'meetings.races' => 'Api\Output\Mapper\Meetings\Races',
            'meetings.races.bettingReturns' => 'Api\Output\Mapper\Meetings\BettingReturns',
            'meetings.races.replayDetails' => 'Api\Output\Mapper\Meetings\ReplayDetails'
        ];
    }
}
