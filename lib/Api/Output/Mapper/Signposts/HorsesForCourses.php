<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 2/1/2016
 * Time: 3:08 PM
 */

namespace Api\Output\Mapper\Signposts;

class HorsesForCourses extends \Api\Output\Mapper\HorsesMapper
{
    protected function getMap()
    {
        return [
            '(fixAroHorseName)horse_name,country_code' => 'horse_name',
            'horse_uid' => 'horse_uid',
            'course_and_distance' => 'course_and_distance_wins',
            'course_winner' => 'course_wins',
            'course_runner' => 'course_runs',
            'cd_perc' => 'cd_win_percentage',
            'c_perc' => 'win_percentage',
            'entries' => 'entries'
        ];
    }
}
