<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\DrawAnalyser;

use \Api\Row\Methods\GetDistanceInFurlong;

class Race extends \Api\Output\Mapper\HorsesMapper
{
    use GetDistanceInFurlong;

    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            'no_of_runners' => 'runners',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'going_type_code' => 'going_type_code',
            '(dateISO8601)race_datetime' => 'race_time',
            'course_name' => 'course_name',
            '(stringToURLkey)course_name' => 'course_key',
            'going_type_desc' => 'going',
            'significance_text_summary' => 'advantage',
            '(getTimeBeforeUpdate)' => 'time_before_update',
            'min_rounded_length' => 'min_rounded_length',
            'max_rounded_length' => 'max_rounded_length',
            'min_rounded_lbs' => 'min_rounded_lbs',
            'max_rounded_lbs' => 'max_rounded_lbs',
            'min_rounded_going' => 'min_rounded_going',
            'max_rounded_going' => 'max_rounded_going',
            '(prepareDiffusionDate)race_datetime' => 'diffusion_race_date',
            '(prepareDiffusionEventName)race_datetime' => 'diffusion_event_name',
            '(prepareToDiffusion)course_name' => 'diffusion_competition_name',        ];
    }
}
