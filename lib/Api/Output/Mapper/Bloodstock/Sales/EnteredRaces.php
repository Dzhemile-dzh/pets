<?php
namespace Api\Output\Mapper\Bloodstock\Sales;

class EnteredRaces extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
        ];
    }
}
