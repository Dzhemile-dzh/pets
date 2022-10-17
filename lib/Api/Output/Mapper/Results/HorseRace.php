<?php
namespace Api\Output\Mapper\Results;

class HorseRace extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'race_instance_uid' => 'race_instance_uid',
            'course_uid' => 'course_uid',
            '(stringToURLkey)course_name' => 'course_key',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
            '(dateISO8601)race_datetime' => 'race_datetime',
        ];
    }
}
