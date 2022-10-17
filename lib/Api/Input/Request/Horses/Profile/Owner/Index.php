<?php

namespace Api\Input\Request\Horses\Profile\Owner;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Index extends \Api\Input\Request\HorsesRequest
{
    /**
     * Setup Parameters
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'ownerId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('ownerId', new Cast\DecimalInteger());
    }
}
