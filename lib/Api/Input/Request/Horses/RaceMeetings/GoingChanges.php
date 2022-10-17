<?php

namespace Api\Input\Request\Horses\RaceMeetings;

use \Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator\Date;

/**
 * Class GoingChanges
 *
 * @package Api\Input\Request\Horses\RaceMeetings
 *
 * @method string getRaceDate()
 */
class GoingChanges extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceDate',
            new Date()
        );
    }
}
