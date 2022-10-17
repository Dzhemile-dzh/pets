<?php

namespace Api\Result\OwnerProfile;

class Index extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'profile' => '\Api\Output\Mapper\OwnerProfile\Index',
            'profile.owner_last_14_days' => '\Api\Output\Mapper\OwnerProfile\WinsRuns',
            'profile.since_a_win.flat' => '\Api\Output\Mapper\OwnerProfile\SinceAWin',
            'profile.since_a_win.jumps' => '\Api\Output\Mapper\OwnerProfile\SinceAWin',
            'big_race_wins' => '\Api\Output\Mapper\OwnerProfile\BigRaceWins',
            'big_race_wins.video_detail' => '\Api\Output\Mapper\OwnerProfile\VideoDetail',
            'last_14_days' => '\Api\Output\Mapper\OwnerProfile\Last14Days',
            'last_14_days.video_detail' => '\Api\Output\Mapper\OwnerProfile\VideoDetail',
            'entries' => '\Api\Output\Mapper\OwnerProfile\Entry',
            'record_by_race_type' => '\Api\Output\Mapper\OwnerProfile\RecordByRaceType',
            'statistical_summary' => '\Api\Output\Mapper\OwnerProfile\StatisticalSummary',
        ];
    }
}
