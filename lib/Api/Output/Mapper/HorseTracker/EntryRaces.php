<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/7/2016
 * Time: 12:00 PM
 */

namespace Api\Output\Mapper\HorseTracker;

class EntryRaces extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Row\Methods\GetSilkImagePath;
    use \Api\Row\Methods\GetDistanceInFurlong;

    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_status_code' => 'race_status_code',
            'race_instance_title' => 'race_instance_title',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            'race_group_code' => 'race_group_code',
            'race_group_desc' => 'race_group_desc',
            'saddle_cloth_no' => 'saddle_cloth_no',
            'running_conditions' => 'running_conditions',
            'rp_postmark' => 'rp_postmark',
            'rp_owner_choice' => 'rp_owner_choice',
            'course_name' => 'course_name',
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            'jockey_uid' => 'jockey_uid',
            'jockey_style_name' => 'jockey_style_name',
            'owner_uid' => 'owner_uid',
            'owner_name' => 'owner_name',
            '(getSilkImagePath)' => 'silk_image_path',
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            'race_class' => 'race_class',
            '(dbYNFlagToBoolean)big_race_entry' => 'big_race_entry',
            '(boolval)declared' => 'declared'
        ];
    }
}
