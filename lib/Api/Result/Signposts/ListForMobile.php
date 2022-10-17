<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 11/4/2016
 * Time: 2:57 PM
 */

namespace Api\Result\Signposts;

class ListForMobile extends \Api\Result\Json
{
    protected function getMappers()
    {
        return [
            'hot_trainers' => '\Api\Output\Mapper\Signposts\ListForMobile',
            'hot_jockeys' => '\Api\Output\Mapper\Signposts\ListForMobile',
            'course_jockeys' => '\Api\Output\Mapper\Signposts\ListForMobile',
            'course_trainers' => '\Api\Output\Mapper\Signposts\ListForMobile',
            'travellers_check' => '\Api\Output\Mapper\Signposts\ListForMobile',
            'trainers_jockeys' => '\Api\Output\Mapper\Signposts\ListForMobile',
            'horses_for_courses' => '\Api\Output\Mapper\Signposts\ListForMobile',
            'ahead_of_handicapper' => '\Api\Output\Mapper\Signposts\ListForMobile',
            'seven_day_winners' => '\Api\Output\Mapper\Signposts\ListForMobile'
        ];
    }
}
