<?php

namespace Api\Output\Mapper\RaceMeetings\Signposts;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class TravelersCheck
 *
 * @package Api\Output\Mapper\RaceMeetings\Signposts
 */
class TravelersCheck extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_style_name',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'trainer_style_name' => 'trainer_style_name',
            'course_uid' => 'course_uid',
            'trainer_location' => 'trainer_location',
            'miles' => 'miles',
            'trainer_uid' => 'trainer_uid',
            'horse_country_origin_code' => 'horse_country_origin_code',
            '(trim)course_country_code' => 'course_country_code'
        ];
    }
}
