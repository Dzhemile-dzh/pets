<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 9/30/2016
 * Time: 11:25 AM
 */

namespace Api\Output\Mapper\RaceCards\Selections;

class TopSelections extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Row\Methods\GetSilkImagePath;
    use \Api\Methods\RemoveDotFromAwCourse;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'horse_uid' => 'horse_uid',
            '(fixAroHorseName)horse_style_name,horse_country_origin_code' => 'horse_style_name',
            'horse_name' => 'horse_name',
            'race_instance_uid' => 'race_instance_uid',
            'race_instance_title' => 'race_instance_title',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            'owner_uid' => 'owner_uid',
            'owner_name' => 'owner_name',
            'owner_style_name' => 'owner_style_name',
            'rp_owner_choice' => 'owner_choice',
            '(getSilkImagePath)' => 'silk_image_path',
            'trainer_uid' => 'trainer_uid',
            'trainer_style_name' => 'trainer_style_name',
            'trainer_name' => 'trainer_name',
            'jockey_uid' => 'jockey_uid',
            'jockey_style_name' => 'jockey_style_name',
            'jockey_name' => 'jockey_name',
            'selection_cnt' => 'selection_cnt',
        ];
    }
}
