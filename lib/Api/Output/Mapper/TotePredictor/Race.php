<?php

namespace Api\Output\Mapper\TotePredictor;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class Race
 *
 * @package Api\Output\Mapper\TotePredictor
 */
class Race extends HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_id',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_title' => 'race_title',
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            'race_type_code' => 'race_type_code',
            'declared_runners' => 'declared_runners',
            'actual_runners' => 'actual_runners',
            'runners' => 'runners',
        ];
    }
}
