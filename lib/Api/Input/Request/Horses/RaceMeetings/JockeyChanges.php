<?php

namespace Api\Input\Request\Horses\RaceMeetings;

use \Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator\Date;

/**
 * Class JockeyChanges
 *
 * @package Api\Input\Request\Horses\RaceMeetings
 *
 * @method string getRaceDate()
 */
class JockeyChanges extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceDate',
            new Date()
        );
    }
}
