<?php

namespace Api\Input\Request\Horses;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Form extends \Api\Input\Request\HorsesRequest
{
    /**
     * @method  getnumberOfRaces()
     * @method  getRaceId()
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('raceId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'numberOfRaces',
            new StandardValidator\IntegerId(),
            false,
            6
        );
        $this->addCast('numberOfRaces', new Cast\DecimalInteger());
    }
}
