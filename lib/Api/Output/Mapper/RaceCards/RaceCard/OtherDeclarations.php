<?php

namespace Api\Output\Mapper\RaceCards\RaceCard;

/**
 * Class OtherDeclarations
 *
 * @package Api\Output\Mapper\RaceCards\RaceCard
 */
class OtherDeclarations extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            '(localDateISO8601)race_datetime,hours_difference' => 'local_meeting_race_datetime',
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
        ];
    }
}
