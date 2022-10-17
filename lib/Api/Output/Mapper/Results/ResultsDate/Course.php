<?php

namespace Api\Output\Mapper\Results\ResultsDate;

use Api\Row\Methods\GetCourseImagePath;

class Course extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use GetCourseImagePath;
    use \Api\Output\Mapper\Methods\LegacyDecorators;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'crs_id' => 'course_uid',
            'rp_meeting_order' => 'rp_meeting_order',
            'mixed_crs_id' => 'mixed_course_uid',
            'course_name' => 'course_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(stringToURLkey)course_name' => 'course_key',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(trim)course_country' => 'course_country_code',
            '(getCourseContinent)course_country' => 'course_region',
            'country_desc' => 'country_desc',
            'course_type_code' => 'course_type_code',
            'mnemonic' => 'course_mnemonic',
            'replaced_aw' => 'replaced_aw',
            'rp_abbrev_3' => 'course_rp_abbrev_3',
            'graphic_name' => 'course_graphic_name',
            'graphic_height' => 'course_graphic_height',
            'rp_flat_course_comment' => 'rp_flat_course_comment',
            'rp_jump_course_comment' => 'rp_jump_course_comment',
            '(nullIfStringEmpty)stalls_position' => 'stalls_position',
            '(nullIfStringEmpty)weather_cond' => 'weather_cond',
            'rp_admission_prices' => 'admission_prices',
            '(nullIfStringEmpty)wind' => 'wind',
            '(boolval)is_gb_or_ire' => 'gb_or_ire',
            'going_desc' => 'meeting_going_desc',
            '(getCourseTeaserSuffix)course_country,crs_id,course_straight_round_jubilee_code,course_race_type_code' => 'course_teaser_suffix',
            'results_order' => 'results_order',
            'races' => 'races'
        ];
    }
}
