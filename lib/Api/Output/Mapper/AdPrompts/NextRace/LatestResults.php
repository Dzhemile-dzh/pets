<?php

namespace Api\Output\Mapper\AdPrompts\NextRace;

/**
 * Class LatestResults
 * @package Api\Output\Mapper\AdPrompts\NextRace
 */
class LatestResults extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            'fast_race_instance_uid' => 'fast_race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_name' => 'course_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            '(stringToFloat)tote_win_money' => 'tote_win_money',
            '(stringToFloat)dual_forecast' => 'dual_forecast',
            '(stringToFloat)csf' => 'csf',
            '(stringToFloat)tricast' => 'tricast',
            'placepot' => 'placepot',
            'favorite' => 'favourite',
            'no_of_runners' => 'no_of_runners',
            'non_runners' => 'non_runners',
            'miscellaneous' => 'miscellaneous',
            'horses' => 'horses',
        ];
    }
}
