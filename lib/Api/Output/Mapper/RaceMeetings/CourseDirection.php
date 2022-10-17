<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\RaceMeetings;

class CourseDirection extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            'direction_type_code' => 'direction_type_code',
            'direction' => 'direction',
        ];
    }
}
