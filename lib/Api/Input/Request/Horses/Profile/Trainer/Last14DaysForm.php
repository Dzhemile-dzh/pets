<?php

namespace Api\Input\Request\Horses\Profile\Trainer;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Last14DaysForm extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'trainerId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('trainerId', new Cast\DecimalInteger());
    }
}
