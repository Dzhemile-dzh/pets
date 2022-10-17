<?php

namespace Api\Result\JockeyProfile;

/**
 * Class Standard
 *
 * @package Api\Result\JockeyProfile
 */
class Standard extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'profile' => '\Api\Output\Mapper\JockeyProfile\Standard',
            'profile.jockey_last_14_days' => '\Api\Output\Mapper\JockeyProfile\WinsRuns',
            'profile.since_a_win.flat' => '\Api\Output\Mapper\JockeyProfile\SinceAWin',
            'profile.since_a_win.jumps' => '\Api\Output\Mapper\JockeyProfile\SinceAWin',
        ];
    }
}
