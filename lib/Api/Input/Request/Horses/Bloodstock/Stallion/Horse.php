<?php

namespace Api\Input\Request\Horses\Bloodstock\Stallion;

use Phalcon\Input\Request\Parameter\Validator;
use Phalcon\Input\Request\Parameter\Cast;

class Horse extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'stallionId',
            new Validator\IntegerId()
        );
        $this->addCast('stallionId', new Cast\DecimalInteger());
    }
}
