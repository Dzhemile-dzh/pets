<?php

namespace Api\Input\Request\Horses\Profile\Horse;

use Phalcon\Input\Request\Parameter\Validator;
use Phalcon\Input\Request\Parameter\Cast;

class Medical extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'horseId',
            new Validator\IntegerId()
        );
        $this->addCast('horseId', new Cast\DecimalInteger());
    }
}
