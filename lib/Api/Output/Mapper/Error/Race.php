<?php

namespace Api\Output\Mapper\Error;

/**
 * Class Race
 *
 * @package Api\Output\Mapper
 */
class Race extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'id',
            'race_status_code' => 'race_status',
            '(trim)country_code' => 'country',
        ];
    }
}
