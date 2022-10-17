<?php

namespace Api\Input\Request\Horses\Profile\Trainer;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

class Standard extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'trainerId',
            new StandardValidator\IntegerId(),
            true
        );
        $this->addCast('trainerId', new Cast\DecimalInteger());
    }
}
