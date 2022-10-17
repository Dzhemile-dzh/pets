<?php

namespace Api\Input\Request\Horses\Profile\Trainer;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Api\Input\Request\Parameter\Validator;
use Phalcon\Input\Request\Parameter\Cast;

class Results extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'trainerId',
            new StandardValidator\IntegerId(),
            true
        );
        $this->addCast('trainerId', new Cast\DecimalInteger());
        
        $this->addOrderedParameter(
            'year',
            new Validator\SeasonYear(),
            false,
            (new \DateTime())->format('Y')
        );
        $this->addCast('year', new Cast\DecimalInteger());
    }
}
