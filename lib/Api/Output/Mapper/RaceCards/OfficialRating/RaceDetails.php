<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 08/26/2015
 * Time: 12:03 AM
 */
namespace Api\Output\Mapper\RaceCards\OfficialRating;

class RaceDetails extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(dateISO8601)race_datetime' => 'race_date',
            'race_type_code' => 'race_type_code',
            'race_status_code' => 'race_status_code',
            'race_group_code' => 'race_group_code',
        ];
    }
}
