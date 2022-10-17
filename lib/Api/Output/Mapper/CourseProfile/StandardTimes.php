<?php
namespace Api\Output\Mapper\CourseProfile;

use \Api\Row\Methods\GetDistanceInFurlong;

class StandardTimes extends \Api\Output\Mapper\HorsesMapper
{
    use GetDistanceInFurlong;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            'race_type_code' => 'race_type_code',
            'distance_yards' => 'distance_yards',
            '(getDistanceInFurlong)distance_yards' => 'distance_furlong_rounded',
            'straight_round_jubilee_code' => 'straight_round_jubilee_code',
            '(dateISO8601)race_date' => 'race_date',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            'course_record_horse_name' => 'course_record_horse_name',
            '(trim)country_origin_code' => 'horse_country_origin_code',
            'rp_ages_allowed_desc' => 'rp_ages_allowed_desc',
            'winners_time' => 'winners_time',
            'no_of_fences' => 'no_of_fences',
            'average_time_sec' => 'average_time_sec'
        ];
    }
}
