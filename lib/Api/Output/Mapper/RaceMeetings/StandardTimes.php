<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 7/22/2016
 * Time: 12:29 PM
 */

namespace Api\Output\Mapper\RaceMeetings;

class StandardTimes extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Row\Methods\GetDistanceInFurlong;

    protected function getMap()
    {
        return [
            'race_type_code' => 'race_type_code',
            'straight_round_jubilee_code' => 'straight_round_jubilee_code',
            '(dateISO8601)race_date' => 'race_date',
            'horse_name' => 'horse_name',
            'distance_yards' => 'distance_yards',
            '(getDistanceInFurlong)distance_yards' => 'distance_furlong_rounded',
            'time_secs' => 'time_secs',
            'rp_ages_allowed_desc' => 'rp_ages_allowed_desc',
            'no_of_fences' => 'no_of_fences',
            'average_time_sec' => 'average_time_sec'
        ];
    }
}
