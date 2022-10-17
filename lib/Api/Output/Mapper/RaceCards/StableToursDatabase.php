<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\RaceCards;

class StableToursDatabase extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;

    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_status_code' => 'race_status_code',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_style_name',
            'horse_country_origin_code' => 'horse_country_origin_code',
            '(fixApostropheSymbol)notes' => 'notes',
            'trainer_uid' => 'trainer_uid',
            'trainer_style_name' => 'trainer_style_name',
            '(stringToURLkey)course_name' => 'course_key',
            'course_uid' => 'course_uid',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name'
        ];
    }
}
