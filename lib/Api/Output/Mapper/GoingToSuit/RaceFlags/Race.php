<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 5/3/2017
 * Time: 1:44 PM
 */

namespace Api\Output\Mapper\GoingToSuit\RaceFlags;

class Race extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'going_type_code' => 'going_type_code',
            'going_type_desc' => 'going_type_desc',
            'race_type_code' => 'race_type_code',
            'horses' => 'horses'
        ];
    }
}
