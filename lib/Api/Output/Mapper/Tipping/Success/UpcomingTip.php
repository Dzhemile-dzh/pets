<?php

namespace Api\Output\Mapper\Tipping\Success;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class UpcomingTip
 *
 * @package Api\Output\Mapper\Tipping\Success
 */
class UpcomingTip extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            'saddle_cloth_no' => 'start_number',
            "race_instance_uid" => "race_instance_uid",
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_name' => 'course_name',
            'diffusion_course_name' => 'diffusion_course_name',
            'tipster_name' => 'tipster_name',
            'tipster_type' => 'tipster_type',
            'spotlight_tip_verdict' => 'spotlight_tip_verdict',
        ];
    }
}
