<?php
namespace Api\Output\Mapper\HeadToHead;

/**
 * Class Entries
 * @package Api\Output\Mapper\HeadToHead
 */
class Entries extends \Api\Output\Mapper\HorsesMapper
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
            'course_name' => 'course_name',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            'race_instance_title' => 'race_instance_title',
            'race_status_code' => 'race_status_code',
            'distance_yard' => 'distance_yard',
            'horses' => 'horses'
        ];
    }
}
