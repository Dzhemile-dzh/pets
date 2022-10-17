<?php
/**
 * Created by PhpStorm.
 * User: Sergii_Vorobei
 * Date: 9/11/14
 * Time: 9:35 AM
 */

namespace Api\Result\RaceMeetings;

class MeetingInfo extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'meeting_info' => '\Api\Output\Mapper\RaceMeetings\MeetingInfo',
            'meeting_info.course_directions' => '\Api\Output\Mapper\RaceMeetings\CourseDirection'
        ];
    }
}
