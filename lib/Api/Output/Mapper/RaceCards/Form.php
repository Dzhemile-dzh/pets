<?php

namespace Api\Output\Mapper\RaceCards;

use Api\Methods;
use Api\Row\Methods as RowMethods;
use Api\Output\Mapper\HorsesMapper;

/**
 * Class Form
 * @package Api\Output\Mapper\RaceCards
 */
class Form extends HorsesMapper
{
    use Methods\RemoveDotFromAwCourse;
    use RowMethods\GetCourseComments;
    use RowMethods\GetPrize;
    use Methods\CloseUpComment;
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_uid' => 'course_uid',
            '(trim)country_code' => 'course_country_code',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            'race_instance_title' => 'race_instance_title',
            'race_type_code' => 'race_type_code',
            '(mb_strtoupper)course_rp_abbrev_3' => 'course_rp_abbrev_3',
            'course_code' => 'course_code',
            '(getCourseComments)race_type_code,rp_jump_course_comment,rp_flat_course_comment' => 'course_comments',
            'going_type_services_desc' => 'going_type_services_desc',
            '(getPrizeSterling)country_code,prize_euro_gross,exchange_rate,prize_sterling' => 'prize_sterling',
            'distance_yard' => 'distance_yard',
            '(getDistanceInFurlong)' => 'distance_furlong',
            'actual_race_class' => 'actual_race_class',
            'rp_ages_allowed_desc' => 'rp_ages_allowed_desc',
            'race_group_code' => 'race_group_code',
            'race_group_desc' => 'race_group_desc',
            '(setNullIfZero)weight_carried_lbs' => 'weight_carried_lbs',
            'weight_allowance_lbs' => 'weight_allowance_lbs',
            'race_outcome_form_char' => 'race_outcome_form_char',
            '(getNoOfRunners)' => 'no_of_runners',
            '(getCloseUpComment)rp_close_up_comment,notes' => 'rp_close_up_comment',
            'rp_horse_head_gear_code' => 'rp_horse_head_gear_code',
            '(isFirstTimeHeadgear)' => 'first_time_headgear',
            'odds_desc' => 'odds_desc',
            'jockey_style_name' => 'jockey_style_name',
            'jockey_jockey_uid' => 'jockey_jockey_uid',
            'official_rating_ran_off' => 'official_rating_ran_off',
            '(getTopSpeed)' => 'rp_topspeed',
            '(setNullIfZero)rp_postmark' => 'rp_postmark',
            'video_detail' => 'video_detail',
            '(getRaceDescriptionForForm)' => 'race_description',
            '(getDistanceToWinnerForm)' => 'distance_to_winner',
            '(getWinningDistance)' => 'winning_distance',
            'race_output_order' => 'race_output_order',
            '(trim)going_type_code' => 'going_type_code',
            '(trim)race_outcome_code' =>  'race_outcome_code',
            'other_horse' => 'other_horse',
            'next_run' => 'next_run',
        ];
    }
}
