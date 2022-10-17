<?php

namespace Api\Output\Mapper\Signposts;

class HotJockeys extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'jockey_uid' => 'jockey_uid',
            'jockey_name' => 'jockey_name',
            'wins_14' => 'wins',
            'runs_14' => 'runs',
            'percentage' => 'percentage',
            'entries' => 'entries'
        ];
    }
}
