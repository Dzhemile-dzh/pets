<?php

namespace Api\Result\TrainerProfile;

/**
 * Class Standard
 *
 * @package Api\Result\TrainerProfile
 */
class Standard extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'profile' => '\Api\Output\Mapper\TrainerProfile\Standard',
            'profile.trainer_last_14_days' => '\Api\Output\Mapper\TrainerProfile\WinsRuns',
            'profile.since_a_win.flat' => '\Api\Output\Mapper\TrainerProfile\SinceAWin',
            'profile.since_a_win.jumps' => '\Api\Output\Mapper\TrainerProfile\SinceAWin',
        ];
    }
}
