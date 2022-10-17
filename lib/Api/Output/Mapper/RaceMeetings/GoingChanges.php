<?php

namespace Api\Output\Mapper\RaceMeetings;

use Api\Output\Mapper;
use Api\Row\Methods\GetGoingDescription;

/**
 * Class GoingChanges
 *
 * @package Api\Output\Mapper\RaceMeetings\GoingChanges
 */
class GoingChanges extends Mapper\HorsesMapper
{
    use GetGoingDescription;
    use Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            '(trim)country_code' => 'country_code',
            '(getCourseContinent)country_code' => 'course_region',
            '(getGoingDescription)race_status_code,md_going_desc,pmd_going_desc' => 'meeting_going_desc',
            '(removeAllExtraSymbols)weather_conditions' => 'weather_conditions',
            'races' => 'races'
        ];
    }
}
