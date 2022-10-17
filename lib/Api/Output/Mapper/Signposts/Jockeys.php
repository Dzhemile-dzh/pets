<?php

namespace Api\Output\Mapper\Signposts;

class Jockeys extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'jockey_uid' => 'jockey_uid',
            'jockey_name' => 'jockey_name',
            'd7_wins' => 'wins',
            'd7_runs' => 'runs',
            'd7_perc' => 'percentage',
            'entries' => 'entries'
        ];
    }
}
