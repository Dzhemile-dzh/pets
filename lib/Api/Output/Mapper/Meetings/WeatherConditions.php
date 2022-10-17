<?php

namespace Api\Output\Mapper\Meetings;

use Api\Methods\GetIntFromYNFlag;
use Api\Row\Methods\GetGoingDescription;
use Api\Methods\RemoveDotFromAwCourse;
use Api\Output\Mapper\HorsesMapper;

/**
 * Class WeatherConditions
 *
 * @package Api\Output\Mapper\Meetings
 */
class WeatherConditions extends HorsesMapper
{
    use GetGoingDescription;
    use GetIntFromYNFlag;
    use RemoveDotFromAwCourse;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_uid' => 'course_uid',
            '(dateISO8601)meeting_date' => 'race_date',
            '(dbYNFlagToInt)meeting_abandoned' => 'abandoned',
            '(trim)country_code' => 'country_code',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            'course_type_code' => 'course_type_code',
            'meeting_type' => 'meeting_type',
            '(getGoingDescription)has_finished_race,going_desc,pre_going_desc' => 'pre_going_desc',
            'pre_weather_desc' => 'pre_weather_desc',
            'weather_details' => 'weather_details'
        ];
    }
}
