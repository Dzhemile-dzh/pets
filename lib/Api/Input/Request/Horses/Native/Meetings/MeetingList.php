<?php

namespace Api\Input\Request\Horses\Native\Meetings;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * Class MeetingList
 *
 * @method getMeetingDate()
 *
 * @package Api\Input\Request\Horses\Native\Meetings
 */
class MeetingList extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'meetingDate',
            new StandardValidator\Date()
        );
    }
}
