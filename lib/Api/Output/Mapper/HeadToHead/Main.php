<?php
namespace Api\Output\Mapper\HeadToHead;

use Api\Methods\RemoveDotFromAwCourse;

/**
 * Class Main
 * @package Api\Output\Mapper\HeadToHead
 */
class Main extends \Api\Output\Mapper\HorsesMapper
{
    use RemoveDotFromAwCourse;
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            'course_uid' => 'course_uid',
            'race_type_code' => 'race_type_code',
            'no_of_runners' => 'no_of_runners',
            'going_type_desc' => 'going_type_desc',
            'distance_yard' => 'distance_yard',
            'horses' => 'horses'
        ];
    }
}
