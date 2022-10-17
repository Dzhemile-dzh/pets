<?php
namespace Api\Output\Mapper\HorseProfile;

use Api\Output\Mapper;
use Api\Methods\RemoveDotFromAwCourse;
use Api\Row\Methods\GetCourseComments;
use Api\Row\Methods\GetPrize;

class Wins extends Mapper\HorsesMapper
{
    use RemoveDotFromAwCourse;
    use GetCourseComments;
    use GetPrize;
    use Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            'race_group_uid' => 'race_group_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            'course_type_code' => 'course_type_code',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(trim)country_code' => 'country_code',
            'race_instance_title' => 'race_instance_title',
            'race_type_code' => 'race_type_code',
            '(mb_strtoupper)course_rp_abbrev_3' => 'course_rp_abbrev_3',
            '(getCourseComments)race_type_code,rp_jump_course_comment,rp_flat_course_comment' => 'course_comments',
            'going_type_services_desc' => 'going_type_services_desc',
            '(getPrizeSterling)country_code,prize_euro_gross,exchange_rate,prize_sterling' => 'prize_sterling',
            '(getPrizeEuro)country_code,prize_euro_gross' => 'prize_euro',
            'distance_yard' => 'distance_yard',
            '(getDistanceInFurlong)' => 'distance_furlong',
            'actual_race_class' => 'race_class',
            'rp_ages_allowed_desc' => 'ages_allowed_desc',
            'rp_betting_movements' => 'rp_betting_movements',
            'race_group_code' => 'race_group_code',
            'race_group_desc' => 'race_group_desc',
            'weight_carried_lbs' => 'weight_carried_lbs',
            '(getNoOfRunners)' => 'no_of_runners',
            'rp_close_up_comment' => 'rp_close_up_comment',
            'rp_horse_head_gear_code' => 'horse_head_gear',
            '(isFirstTimeHeadgear)' => 'first_time_headgear',
            'odds_desc' => 'odds_desc',
            'odds_value' => 'odds_value',
            'jockey_style_name' => 'jockey_style_name',
            'aka_style_name' => 'jockey_short_name',
            'jockey_jockey_uid' => 'jockey_uid',
            'jockey_ptp_type_code' => 'jockey_ptp_type_code',
            'official_rating_ran_off' => 'official_rating_ran_off',
            '(getTopSpeed)' => 'rp_topspeed',
            'rp_postmark' => 'rp_postmark',
            'video_detail' => 'video_detail',
            '(getRaceDescriptionForForm)' => 'race_description',
            '(getDistanceToWinnerForm)' => 'distance_to_winner',
            '(getWinningDistance)' => 'winning_distance',
            'going_type_code' => 'going_type_code',
            '(trim)race_outcome_code' =>  'race_outcome_code',
            'other_horse' => 'other_horse',
            'disqualification_uid' => 'disqualification_uid',
            'disqualification_desc' => 'disqualification_desc',
            'rp_straight_round_jubilee_desc' => 'rp_straight_round_jubilee_desc',
            'weight_allowance_lbs' => 'weight_allowance_lbs',
        ];
    }
}
