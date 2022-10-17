<?php

namespace Api\Output\Mapper\RaceCards\Date;

use Api\Methods\GetIntFromYNFlag;
use Api\Output\Mapper\HorsesMapper;

/**
 * @package Api\Output\Mapper\RaceCards\Date
 */
class AllMeetings extends HorsesMapper
{
    use GetIntFromYNFlag;
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(trim)country_code' => 'country_code',
            '(dbYNFlagToInt)meeting_abandoned' => 'abandoned',
            '(dbYNFlagToBoolean)horses_database' => 'horses_database',
            'races' => 'races'
        ];
    }
}
