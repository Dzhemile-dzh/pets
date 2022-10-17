<?php

namespace Api\Output\Mapper\HorseProfile;


/**
 * Class AllEntry
 * @package Api\Output\Mapper\HorseProfile
 */
class AllEntry extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Row\Methods\GetDistanceInFurlong;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            '(localDateISO8601)race_datetime,hours_difference' => 'local_meeting_race_datetime',
            'course_name' => 'course_name',
            'course_type_code' => 'course_type_code',
            'course_uid' => 'course_uid',
            'rp_abbrev_3' => 'rp_abbrev_3',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(stringToURLkey)course_name' => 'course_key',
            'race_instance_title' => 'race_instance_title',
            'race_status_code' => 'race_status_code',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'saddle_cloth_no' => 'saddle_cloth_no',
            'rp_postmark' => 'rp_postmark',
            'running_conditions' => 'running_conditions',
            'rp_owner_choice' => 'rp_owner_choice',
            '(getSilkImagePath)' => 'silk_image_path',
            'jockey_uid' => 'jockey_uid',
            'jockey_style_name' => 'jockey_style_name',
            'jockey_last_14_days' => 'jockey_last_14_days',
            '(getIndicator)' => 'preference'
        ];
    }
}
