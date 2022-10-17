<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\RaceMeetings;

use Api\Methods\TenToFollowHorse;

class RunnersIndex extends \Api\Output\Mapper\HorsesMapper
{
    use TenToFollowHorse;

    protected function getMap()
    {
        return [
            'group_name' => 'group_name',
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            'horse_uid' => 'horse_uid',
            'position' => 'position',
            'starting_price' => 'starting_price',
            '(isTenToFollowHorse)ten_to_follow_horse,reasoning,race_type_code' => 'ten_to_follow_horse',
            'course_name' => 'course_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            'course_abbrev' => 'course_abbrev',
            'course_uid' => 'course_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_uid' => 'race_instance_uid',
            'race_status_code' => 'race_status_code',
        ];
    }
}
