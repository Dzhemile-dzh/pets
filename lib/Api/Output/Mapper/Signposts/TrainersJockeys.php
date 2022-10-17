<?php

namespace Api\Output\Mapper\Signposts;

class TrainersJockeys extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            'jockey_uid' => 'jockey_uid',
            'jockey_name' => 'jockey_name',
            't_percent' => 'trainer_percentage',
            'j_percent' => 'jockey_percentage',
            'percent' => 'percentage',
            'entries' => 'entries'
        ];
    }
}
