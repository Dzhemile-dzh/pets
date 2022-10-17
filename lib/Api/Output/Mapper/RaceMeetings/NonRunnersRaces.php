<?php
namespace Api\Output\Mapper\RaceMeetings;

use Api\Output\Mapper\HorsesMapper;

class NonRunnersRaces extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_uid' => 'race_instance_uid',
            'race_instance_title' => 'race_instance_name',
            'horses' => 'horses',
        ];
    }
}
