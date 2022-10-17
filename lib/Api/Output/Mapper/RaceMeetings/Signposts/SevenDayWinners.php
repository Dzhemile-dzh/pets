<?php

namespace Api\Output\Mapper\RaceMeetings\Signposts;

use Api\Output\Mapper\HorsesMapper;
use Api\Methods\RemoveDotFromAwCourse;

/**
 * Class SevenDayWinners
 *
 * @package Api\Output\Mapper\RaceMeetings\Signposts
 */
class SevenDayWinners extends HorsesMapper
{
    use RemoveDotFromAwCourse;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            'course_uid' => 'course_uid',
            'race_instance_uid' => 'race_instance_uid',
            'race_instance_title' => 'race_instance_title',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_style_name',
            'horse_country_origin_code' => 'horse_country_origin_code',
            '(trim)course_country_code' => 'course_country_code',
            'upcoming_race' => 'upcoming_race',
        ];
    }
}
