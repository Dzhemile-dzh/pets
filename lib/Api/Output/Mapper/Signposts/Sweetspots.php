<?php

namespace Api\Output\Mapper\Signposts;

class Sweetspots extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;

    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(strip_tags)verdict' => 'signpost_text',
            'horse_uid' => 'horse_uid',
            'horse_name' => 'horse_name',
            '(dbYNFlagToBoolean)non_runner' => 'non_runner',
            'jockey_uid' => 'jockey_uid',
            'jockey_name' => 'jockey_name',
            'owner_uid' => 'owner_uid',
            'owner_name' => 'owner_name',
            'trainer_uid' => 'trainer_uid',
            'trainer_name' => 'trainer_name',
            'start_number' => 'start_number',
            '(getSilkImagePath)' => 'silk_image_path',
        ];
    }
}
