<?php

namespace Api\Output\Mapper\RaceMeetings;

use Api\Methods\RemoveDotFromAwCourse;
use Api\Output\Mapper\HorsesMapper;
use Api\Row\Methods\GetCourseImagePath;
use Api\Row\Methods\GetGoingDescription;
use Api\Row\Methods\IsEarlyCloserPdfAvailable;
use Api\Row\Methods\PrepareToPdfExtended;

/**
 * Class DailyRaceMeetings
 *
 * @package Api\Output\Mapper\RaceMeetings\DailyRaceMeetings
 */
class DailyRaceMeetings extends HorsesMapper
{
    use \Api\Row\Methods\IsPdfAvailable;
    use GetCourseImagePath;
    use IsEarlyCloserPdfAvailable;
    use RemoveDotFromAwCourse;
    use PrepareToPdfExtended;
    use \Api\Output\Mapper\Methods\LegacyDecorators;
    use GetGoingDescription;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_uid' => 'course_uid',
            '(dateISO8601)meeting_date' => 'race_date',
            '(dbYNFlagToInt)meeting_abandoned' => 'abandoned',
            'aw_surface_type' => 'aw_surface_type',
            'cards_order' => 'cards_order',
            'complete_card' => 'complete_card',
            'country_code' => 'country_code',
            '(getCourseImagePath)country_code,course_uid,straight_round_jubilee_code,course_race_type_code' => 'course_image_path',
            '(stringToURLkey)course_name' => 'course_key',
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(getCourseContinent)country_code' => 'course_region',
            '(getCourseTeaserSuffix)country_code,course_uid,course_straight_round_jubilee_code,course_race_type_code' => 'course_teaser_suffix',
            'course_type_code' => 'course_type_code',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            'rails' => 'rails',
            'rp_abbrev_3' => 'rp_abbrev_3',
            'rp_meeting_order' => 'rp_meeting_order',
            'stalls_position' => 'stalls_position',
            'digital_colour' => 'digital_colour',
            'digital_order' => 'digital_order',
            '(isEarlyCloserPdfAvailable)races' => 'early_closer_pdf_available',
            'early_complete_card' => 'early_complete_card',
            'finished_gb_ire_race' => 'has_finished_race',
            'meeting_number' => 'meeting_number',
            'meeting_type' => 'meeting_type',
            'mixed_course_uid' => 'mixed_course_uid',
            '(isPdfAvailable)' => 'pdf_available',
            '(prepareToPdfExtended)course_style_name' => 'pdf_name',
            '(getGoingDescription)finished_race,going_desc,pre_going_desc' => 'pre_going_desc',
            'pre_weather_desc' => 'pre_weather_desc',
            'races' => 'races',
        ];
    }

    public function dbYNFlagToInt($value)
    {
        if (in_array(trim((string)$value), ['y', 'n', 'Y', 'N', ''], true)) {
            $value = ($value === 'Y' || $value === 'y');
        }

        return intval($value);
    }
}
