<?php
namespace Api\Output\Mapper\GoingToSuit;

use Api\Methods\RemoveDotFromAwCourse;
use Api\Output\Mapper\HorsesMapper;
use \Api\Row\Methods\GetDistanceInFurlong;

class TopRprRace extends HorsesMapper
{
    use RemoveDotFromAwCourse;
    use GetDistanceInFurlong;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)course_name' => 'course_name',
            'rp_abbrev_3' => 'course_abbrev_3',
            'distance_yard' => 'distance',
            '(getDistanceInFurlong)distance_yard' => 'distance_furlong_rounded',
            'race_type_code' => 'race_type_code',
            'weight_carried_lbs' => 'weight_carried',
            'race_outcome_position' => 'position_no',
            'no_of_runners' => 'no_of_runners',
            'rp_postmark' => 'rp_postmark',
        ];
    }
}
