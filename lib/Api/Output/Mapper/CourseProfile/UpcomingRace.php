<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 8/5/14
 * Time: 12:41 PM
 */

namespace Api\Output\Mapper\CourseProfile;

class UpcomingRace extends \Api\Output\Mapper\HorsesMapper
{

    protected function getMap()
    {
        return [
            '(dateISO8601)race_date' => 'race_date',
            '(dateISO8601)race_datetime_first' => 'race_datetime_first',
            '(dateISO8601)race_datetime_last' => 'race_datetime_last',
            'race_instance_uid_first' => 'race_instance_uid_first',
            'race_instance_uid_last' => 'race_instance_uid_last',
        ];
    }
}
