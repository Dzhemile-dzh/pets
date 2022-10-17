<?php

namespace Api\Result\JockeyProfile;

/**
 * Class Index
 *
 * @package Api\Result\JockeyProfile
 */
class Index extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'profile' => '\Api\Output\Mapper\JockeyProfile\Index',
            'profile.jockey_last_14_days' => '\Api\Output\Mapper\JockeyProfile\WinsRuns',
            'profile.since_a_win.flat' => '\Api\Output\Mapper\JockeyProfile\SinceAWin',
            'profile.since_a_win.jumps' => '\Api\Output\Mapper\JockeyProfile\SinceAWin',
            'big_race_wins' => '\Api\Output\Mapper\JockeyProfile\BigRaceWins',
            'big_race_wins.video_detail' => '\Api\Output\Mapper\JockeyProfile\VideoDetail',
            'last_14_days' => '\Api\Output\Mapper\JockeyProfile\Last14Days',
            'last_14_days.video_detail' => '\Api\Output\Mapper\JockeyProfile\VideoDetail',
            'booked_rides' => '\Api\Output\Mapper\JockeyProfile\BookedRides',
            'record_by_race_type' => '\Api\Output\Mapper\JockeyProfile\RecordByRaceType',
            'statistical_summary' => '\Api\Output\Mapper\JockeyProfile\StatisticalSummary',
            'season_info' => '\Api\Output\Mapper\SeasonInfo\SeasonInfo',
        ];
    }
}
