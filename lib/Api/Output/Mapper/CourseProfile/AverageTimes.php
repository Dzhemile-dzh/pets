<?php

namespace Api\Output\Mapper\CourseProfile;


use \Api\Row\Methods\GetDistanceInFurlong;
/**
 * Class AverageTimes
 * @package Api\Output\Mapper\CourseProfile
 */
class AverageTimes extends \Api\Output\Mapper\HorsesMapper
{
    use GetDistanceInFurlong;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_type_code' => 'race_type_code',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'straight_round_jubilee_code' => 'track_detail',
            'straight_round_jubilee_desc' => 'track_detail_desc',
            'no_of_fences' => 'no_of_obstacles',
            'average_time_sec' => 'average_time_sec'
        ];
    }
}
