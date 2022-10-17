<?php

namespace Api\Output\Mapper\HorseProfile\Medical;

class Horse extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_name' => 'horse_name',
            'medical_info' => 'medical_info'
        ];
    }
}
