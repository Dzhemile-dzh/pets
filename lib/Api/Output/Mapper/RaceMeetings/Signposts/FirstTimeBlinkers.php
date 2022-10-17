<?php

namespace Api\Output\Mapper\RaceMeetings\Signposts;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class FirstTimeBlinkers
 *
 * @package Api\Output\Mapper\RaceMeetings\Signposts
 */
class FirstTimeBlinkers extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_style_name',
            'horse_country_origin_code' => 'horse_country_origin_code',
            'horse_uid' => 'horse_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            '(trim)course_country_code' => 'course_country_code',
        ];
    }
}
