<?php

namespace Api\Result\OwnerProfile;

/**
 * Class Standard
 *
 * @package Api\Result\OwnerProfile
 */
class Standard extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'profile' => '\Api\Output\Mapper\OwnerProfile\Standard',
            'profile.owner_last_14_days' => '\Api\Output\Mapper\OwnerProfile\WinsRuns',
            'profile.since_a_win.flat' => '\Api\Output\Mapper\OwnerProfile\SinceAWin',
            'profile.since_a_win.jumps' => '\Api\Output\Mapper\OwnerProfile\SinceAWin',
        ];
    }
}
