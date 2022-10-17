<?php

namespace Api\Output\Mapper\Races;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class OneTwoThree
 * @package Api\Output\Mapper\Races
 */
class OneTwoThree extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_uid' => 'raceId',
            'runners' => 'runners',
        ];
    }
}