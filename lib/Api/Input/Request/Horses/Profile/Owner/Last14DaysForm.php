<?php

namespace Api\Input\Request\Horses\Profile\Owner;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Last14DaysForm extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'ownerId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('ownerId', new Cast\DecimalInteger());
    }
}
