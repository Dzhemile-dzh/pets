<?php

namespace Api\Output\Mapper\Bloodstock\Dam;

/**
 * Class ProgenyEntries
 *
 * @package Api\Output\Mapper\Bloodstock\Dam
 */
class ProgenyEntries extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'distance_yard' => 'distance_yard',
            'race_instance_title' => 'race_instance_title',
            'race_status_code' => 'race_status_code',
            '(roundNullable)prize_sterling,2' => 'prize_sterling',
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            'course_uid' => 'course_uid',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            'rp_going_type_desc' => 'rp_going_type_desc',
            'no_of_runners' => 'no_of_runners',
            '(trim)style_name' => 'horse_name',
            '(fixAroHorseName)style_name,country_origin_code' => 'style_name',
            'horse_uid' => 'horse_uid',
            '(getDistanceInFurlong)' => 'distance_furlong',
        ];
    }
}
