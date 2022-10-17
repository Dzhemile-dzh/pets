<?php

namespace Bo\Native\Meetings;

use Bo\Standart;
use Api\DataProvider\Bo\Native\Meetings\MeetingList as DataProvider;

/**
 * Class MeetingList
 *
 * @package Bo\Native\Meetings
 */
class MeetingList extends Standart
{
    /**
     * @return array|null
     * @throws \Exception
     */
    public function getListByDate(): ?array
    {
        return (new DataProvider())->getListByDate($this->request);
    }
}
