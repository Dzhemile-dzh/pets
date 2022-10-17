<?php

namespace Api\Input\Request\Horses\Profile\Horse;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Notes extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'horseId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('horseId', new Cast\DecimalInteger());
    }
}
