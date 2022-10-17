<?php

namespace Api\Output\Mapper\Bloodstock\Stallion;

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
            '(getRaceDescriptionForForm)' => 'race_description',
            'race_status_code' => 'race_status_code',
            'actual_race_class' => 'actual_race_class',
            '(roundNullable)prize_sterling,2' => 'prize_sterling',
            'no_of_runners' => 'no_of_runners',
            '(getDistanceInFurlong)' => 'distance_furlong',
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            'course_uid' => 'course_uid',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)style_name,country_origin_code' => 'horse_name',
            'country_origin_code' => 'horse_country_code',
            'horse_age' => 'horse_age',
            'dam_country_origin_code' => 'dam_country_code',
            'dam_horse_uid' => 'dam_uid',
            '(fixAroHorseName)dam_style_name,dam_country_origin_code' => 'dam_name',
        ];
    }
}
