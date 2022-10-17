<?php

namespace Api\Output\Mapper\RacecardsResults;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class RaceInfo
 * @package Api\Output\Mapper\RacecardsResults
 */
class Position extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'pos_official' => 'official',
            'pos_original' => 'original',
            'pos_deadheat' => 'deadheat',
            'pos_dnf' => 'didNotFinish',
            'pos_dnf_status' => 'didNotFinishStatus',
            'pos_disqualified' => 'disqualified',
            'pos_disq_status' => 'disqualifiedStatus',
        ];
    }
}