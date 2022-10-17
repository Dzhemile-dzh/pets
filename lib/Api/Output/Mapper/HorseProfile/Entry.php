<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\HorseProfile;

class Entry extends \Api\Output\Mapper\HorsesMapper
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
            'course_name' => 'course_name',
            'course_type_code' => 'course_type_code',
            'course_uid' => 'course_uid',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(stringToURLkey)course_name' => 'course_key',
            'race_instance_title' => 'race_instance_title',
            'race_status_code' => 'race_status_code',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'race_class' => 'race_class',
            'surface' => 'surface',
            'rp_ages_allowed_desc' => 'rp_ages_allowed_desc',
            'days_since_last_run' => 'days_since_last_run',
            'days_since_last_run_flat' => 'days_since_last_run_flat',
            'days_since_last_run_jumps' => 'days_since_last_run_jumps',
            'days_since_last_run_ptp' => 'days_since_last_run_ptp',
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
