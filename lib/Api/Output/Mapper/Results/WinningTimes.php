<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\Results;

class WinningTimes extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Row\Methods\GetDistanceInFurlong;


    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,country_origin_code' => 'horse_style_name',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'winners_time_secs' => 'winners_time_secs',
            'winners_time_secs_per_furlong' => 'winners_time_secs_per_furlong',
            'time_comparison' => 'time_comparison',
            'time_comparison_per_furlong' => 'time_comparison_per_furlong',
            'rp_going_correction' => 'rp_going_correction',
            'rp_topspeed' => 'rp_topspeed',
            'rp_postmark' => 'rp_postmark',
            'rp_going_type_desc' => 'rp_going_type_desc',
            'rp_going_correction_desc' => 'rp_going_correction_desc'

        ];
    }
}
