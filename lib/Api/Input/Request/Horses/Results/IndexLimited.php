<?php

namespace Api\Input\Request\Horses\Results;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class IndexLimited extends \Api\Input\Request\Horses\Results\Index
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceId',
            new StandardValidator\IntegerId(),
            true
        );
        $this->addCast('raceId', new Cast\DecimalInteger());
        $this->addValidator(new \Api\Input\Request\Validator\ResultsRaceIdLimitedDate());
    }
}
