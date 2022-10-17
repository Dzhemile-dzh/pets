<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/10/2015
 * Time: 4:25 PM
 */

namespace Api\Output\Mapper\OwnerProfile;

class Results extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Row\Methods\GetDistanceInFurlong;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(dateISO8601)race_datetime' => 'race_date',
            'rp_abbrev_3' => 'rp_abbrev_3',
            '(trim)country_code' => 'country',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'race_instance_uid' => 'race_instance_uid',
            'race_instance_title' => 'race_instance_title',
            'prize_sterling' => 'prize_sterling',
            'prize_euro' => 'prize_euro',
            'days_diff' => 'days_diff',
            'race_outcome_code' => 'race_outcome_code',
            'race_outcome_position' => 'race_outcome_position',
            'disq_desc' => 'disq_desc',
            '(fixAroHorseName)horse_style_name,country_origin_code' => 'horse_style_name',
            'horse_uid' => 'horse_uid',
            'trainer_ptp_type_code' => 'trainer_ptp_type_code',
            'trainer_style_name' => 'trainer_style_name',
            'trainer_uid' => 'trainer_uid',
            'race_type_code' => 'race_type_code',
            'race_group_desc' => 'race_group_desc',
            'race_group_code' => 'race_group_code',
            'video_detail' => 'video_detail',
            'course_uid' => 'course_uid',
            'course_type_code' => 'course_type_code',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            'trainer_short_name' => 'trainer_short_name'
        ];
    }
}
