<?php

namespace Api\Output\Mapper\RaceMeetings;

use Api\Output\Mapper\HorsesMapper;

/**
 * Class JockeyChanges
 *
 * @package Api\Output\Mapper\RaceMeetings\JockeyChanges
 */
class JockeyChanges extends HorsesMapper
{

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            'races' => 'races'
        ];
    }
}
