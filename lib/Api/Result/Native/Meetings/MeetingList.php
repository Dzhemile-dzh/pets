<?php

namespace Api\Result\Native\Meetings;

use Api\Result\Xml as Result;

/**
 * Class MeetingList
 *
 * @package Api\Result\Native\Meetings
 */
class MeetingList extends Result
{
    /**
     * @return array
     */
    protected function getMappers(): array
    {
        return [
            'meetings' => 'Api\Output\Mapper\Native\Meetings\MeetingList'
        ];
    }
}
