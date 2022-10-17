<?php

namespace Api\Output\Mapper\RaceCards\Date;

use Api\Output\Mapper\HorsesMapper;

/**
 * @package Api\Output\Mapper\RaceCards\Date
 */
class Races extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_status_code' => 'race_status_code'
        ];
    }
}
