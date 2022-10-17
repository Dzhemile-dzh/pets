<?php

namespace Api\Result\Signposts;

class TrainersJockeys extends \Api\Result\Json
{
    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'trainers_jockeys' => '\Api\Output\Mapper\Signposts\TrainersJockeys',
            'trainers_jockeys.entries' => '\Api\Output\Mapper\Signposts\Entries'
        ];
    }
}
