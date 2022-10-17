<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/17/2014
 * Time: 11:03 AM
 */
namespace Api\Output\Mapper\RaceCards\RaceCardsUpcoming;

class Upcoming extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return array
     */
    protected function getMap()
    {
        return [
            'course_uid' => 'course_uid',
            'course_name' => 'course_name',
            'race_instance_uid' => 'race_instance_uid',
            '(dateISO8601)race_datetime' => 'race_datetime',
            '(prepareToDiffusion)course_name' => 'diffusion_course_name',
        ];
    }
}
