<?php

namespace Api\Output\Mapper\Tipping\Success;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class WinningTip
 *
 * @package Api\Output\Mapper\Tipping\Success
 */
class WinningTip extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            "race_instance_uid" => "race_instance_uid",
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_name' => 'course_name',
            'odds_desc' => 'odds_desc',
            'odds_value' => 'odds_value',
            'tipster_name' => 'tipster_name',
            'tipster_type' => 'tipster_type',
        ];
    }
}
