<?php

namespace Api\Input\Request\Horses\RaceMeetings;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use \Api\Input\Request\HorsesRequest;

/**
 * Class DailyRaceMeetings
 *
 * @package Api\Input\Request\Horses\RaceMeetings
 *
 * @method string getMeetingDate()
 */
class DailyRaceMeetings extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'meetingDate',
            new StandardValidator\Date(),
            true
        );
    }
}
