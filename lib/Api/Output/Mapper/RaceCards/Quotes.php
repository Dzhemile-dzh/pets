<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\RaceCards;

class Quotes extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Row\Methods\GetDistanceInFurlong;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_title' => 'race_instance_title',
            'distance_yard' => 'distance',
            '(getDistanceInFurlong)distance_yard' => 'distance_furlong_rounded',
            'course_name' => 'course_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(stringToURLkey)course_name' => 'course_key',
            'notes' => 'quote',
            'quotes' => 'pre_horse_race_quotes.quote',
            '(dbYNFlagToBoolean)key_quote_yn' => 'pre_horse_race_quotes.key_quote',
            '(dateISO8601)expire_on' => 'pre_horse_race_quotes.expire_on',
        ];
    }
}
