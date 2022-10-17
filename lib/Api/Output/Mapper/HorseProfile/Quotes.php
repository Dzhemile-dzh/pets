<?php
namespace Api\Output\Mapper\HorseProfile;

class Quotes extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            '(fixAroHorseName)horse_style_name,country_origin_code' => 'horse_style_name',
            'race_id' => 'race_id',
            '(dateISO8601)race_date' => 'race_date',
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            'course_type_code' => 'course_type_code',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(stringToURLkey)course_name' => 'course_key',
            'distance_yard' => 'distance_yard',
            'race_title' => 'race_title',
            '(trim)going_type_code' => 'going_type_code',
            'rp_postmark' => 'rp_postmark',
            '(getCleanQuoteNotes)' => 'notes',
            '(getDistanceInFurlong)' => 'distance_furlong'
        ];
    }
}
