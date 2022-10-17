<?php

namespace Api\Result\Signposts;

class HotTrainers extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'hot_trainers' => '\Api\Output\Mapper\Signposts\HotTrainers',
            'hot_trainers.entries' => '\Api\Output\Mapper\Signposts\Entries'
        ];
    }
}
