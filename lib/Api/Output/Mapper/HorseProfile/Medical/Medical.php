<?php

namespace Api\Output\Mapper\HorseProfile\Medical;

class Medical extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'medical_type' => 'medical_type',
            '(dateISO8601)medical_date' => 'medical_date',
        ];
    }
}
