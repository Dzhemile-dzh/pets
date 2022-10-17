<?php
namespace Api\Output\Mapper\BetPrompts;

use Api\Output\Mapper;
use Api\Methods\RemoveDotFromAwCourse;
use \Api\Row\Methods\GetDistanceInFurlong;

class BetPrompts extends Mapper\HorsesMapper
{
    use RemoveDotFromAwCourse;
    use GetDistanceInFurlong;
    use Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_type_code' => 'race_type_code',
            'course_uid' => 'course_uid',
            'country_code' => 'country_code',
            'race_group_code' => 'race_group_code',
            'race_status_code' => 'race_status_code',
            'declared_runners' => 'declared_runners',
            'no_of_runners' => 'no_of_runners',
            'going_type_desc' => 'going_type_desc',
            'rp_tv_text' => 'rp_tv_text',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'most_tipped' => 'most_tipped',
            'most_napped' => 'most_napped',
            'post_data_selection' => 'post_data_selection',
            'rpr_selection' => 'rpr_selection',
            'hot_trainers' => 'hot_trainers',
            'ahead_of_handicapper' => 'ahead_of_handicapper',
            'course_jockeys' => 'course_jockeys',
            'course_trainers' => 'course_trainers',
            'horses_for_courses' => 'horses_for_courses',
            'hot_jockeys' => 'hot_jockeys',
            'seven_day_winners' => 'seven_day_winners',
            'trainers_jockeys' => 'trainers_jockeys',
            'travellers_check' => 'travellers_check',
        ];
    }
}
