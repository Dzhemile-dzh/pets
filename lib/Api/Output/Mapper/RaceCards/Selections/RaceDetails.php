<?php

namespace Api\Output\Mapper\RaceCards\Selections;

class RaceDetails extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    use \Api\Row\Methods\GetDistanceInFurlong;

    protected function getMap()
    {
        return [
            '(dateISO8601)race_datetime' => 'race_datetime',
            'course_uid' => 'course_uid',
            '(removeDotFromAwCourse)course_style_name' => 'course_style_name',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            'distance_yard' => 'distance_yard',
            '(GetDistanceInFurlong)' => 'distance_furlong_rounded',
            '(trim)going_type_code' => 'going_type_code'
        ];
    }
}
