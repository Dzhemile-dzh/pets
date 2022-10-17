<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\OwnerProfile;

class Last14Days extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_uid' => 'course_uid',
            'course_type_code' => 'course_type_code',
            'race_instance_title' => 'race_instance_title',
            'race_type_code' => 'race_type_code',
            'course_rp_abbrev_3' => 'course_rp_abbrev_3',
            'course_rp_abbrev_4' => 'course_rp_abbrev_4',
            'course_code' => 'course_code',
            'going_type_services_desc' => 'going_type_services_desc',
            '(getRaceDescriptionForForm)' => 'race_description',
            'prize_sterling' => 'prize_sterling',
            'prize_euro' => 'prize_euro',
            'no_of_runners' => 'no_of_runners',
            'distance_yard' => 'distance_yard',
            '(getDistanceToWinner)' => 'distance_to_winner',
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_style_name',
            'weight_carried_lbs' => 'weight_carried_lbs',
            'rp_betting_movements' => 'rp_betting_movements',
            'rp_close_up_comment' => 'rp_close_up_comment',
            'rp_horse_head_gear_code' => 'horse_head_gear',
            'odds_desc' => 'odds_desc',
            'trainer_uid' => 'trainer_uid',
            'trainer_style_name' => 'trainer_style_name',
            'trainer_ptp_type_code' => 'trainer_ptp_type_code',
            'rp_postmark' => 'rp_postmark',
            'rp_pre_postmark' => 'rp_pre_postmark',
            'video_detail' => 'video_detail',
            'actual_race_class' => 'race_class',
            'rp_ages_allowed_desc' => 'rp_ages_allowed_desc',
            'race_group_code' => 'race_group_code',
            'race_group_desc' => 'race_group_desc',
            '(getDistanceInFurlong)' => 'distance_furlong',
            '(getWinningDistance)' => 'winning_distance',
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            'rp_postmark_difference' => 'rp_postmark_difference',
            '(IsFirstTimeHeadgear)' => 'first_time_headgear',
            'race_outcome_code' => 'race_outcome_code',
            'trainer_short_name' => 'trainer_short_name',
            'odds_value' => 'odds_value',
        ];
    }
}
