<?php
namespace Api\Output\Mapper\RaceCards;

use Api\Methods\RemoveDotFromAwCourse;
use Api\Output\Mapper\HorsesMapper;
use Api\Row\Methods\GetSilkImagePath;

class TopNaps extends HorsesMapper
{
    use RemoveDotFromAwCourse;
    use GetSilkImagePath;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
           'horse_uid' => 'horse_uid',
            'horse_style_name' => 'horse_style_name',
            '(fixAroHorseName)horse_name,country_origin_code' => 'horse_name',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'race_instance_uid' => 'race_instance_uid',
            'race_instance_title' => 'race_instance_title',
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            'owner_uid' => 'owner_uid',
            'owner_name' => 'owner_name',
            'owner_style_name' => 'owner_style_name',
            'owner_choice' => 'owner_choice',
            '(getSilkImagePath)' => 'silk_image_path',
            'trainer_uid' => 'trainer_uid',
            'trainer_style_name' => 'trainer_style_name',
            'trainer_name' => 'trainer_name',
            'jockey_uid' => 'jockey_uid',
            'jockey_style_name' => 'jockey_style_name',
            'jockey_name' => 'jockey_name',
            'naps_count' => 'naps_count',
        ];
    }
}
