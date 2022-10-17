<?php

namespace Api\Output\Mapper\RaceCards\RaceCardsDate;

use Api\Methods\RemoveDotFromAwCourse;
use Api\Row\Methods\GetCourseImagePath;
use Api\Row\Methods\GetGoingDescription;
use Api\Row\Methods\IsEarlyCloserPdfAvailable;
use Api\Row\Methods\PrepareToPdfExtended;

/**
 * Class Meeting
 * @package Api\Output\Mapper\RaceCards\RaceCardsDate
 */
class Meeting extends \Api\Output\Mapper\HorsesMapper
{
    use RemoveDotFromAwCourse;
    use GetCourseImagePath;
    use IsEarlyCloserPdfAvailable;
    use GetGoingDescription;
    use PrepareToPdfExtended;
    use \Api\Output\Mapper\Methods\LegacyDecorators;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_uid' => 'course_uid',
            'rp_meeting_order' => 'rp_meeting_order',
            'mixed_course_uid' => 'mixed_course_uid',
            'course_name' => 'course_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(prepareToPdfExtended)course_style_name' => 'pdf_name',
            '(stringToURLkey)course_name' => 'course_key',
            'rp_abbrev_3' => 'rp_abbrev_3',
            '(trim)country_code' => 'country_code',
            'course_type_code' => 'course_type_code',
            'latitude' => 'latitude',
            'longitude' => 'longitude',
            '(dbYNFlagToBoolean)tote_jackpot_yn' => 'jackpot_meeting',
            '(dateISO8601)race_date' => 'race_date',
            'has_finished_race' => 'has_finished_race',
            'abandoned' => 'abandoned',
            'going_desc' => 'going_desc',
            'stalls_position' => 'stalls_position',
            '(getGoingDescription)race_status_code,going_desc,pmd_going_desc' => 'pre_going_desc',
            'pre_weather_desc' => 'pre_weather_desc',
            'foreign' => 'foreign',
            'meeting_number' => 'meeting_number',
            'digital_colour' => 'digital_colour',
            'digital_order' => 'digital_order',
            'cards_order' => 'cards_order',
            '(getCourseTeaserSuffix)country_code,course_uid,course_straight_round_jubilee_code,course_race_type_code' => 'course_teaser_suffix',
            '(isPdfAvailable)' => 'pdf_available',
            '(isEarlyCloserPdfAvailable)races' => 'early_closer_pdf_available',
            'complete_card' => 'complete_card',
            'early_complete_card' => 'early_complete_card',
            'aw_surface_type' => 'aw_surface_type',
            'meeting_type' => 'meeting_type',
            'rails' => 'rails',
            'races' => 'races',
            '(getCourseImagePath)country_code,course_uid,course_straight_round_jubilee_code,course_race_type_code' => 'course_image_path',
        ];
    }
}
