<?php
namespace Api\Input\Request\Horses\BetPrompts;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast\DecimalInteger;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

class Index extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addCast('raceId', new DecimalInteger());
        $this->addNamedParameter(
            'raceId',
            new IntegerId()
        );

        $this->addOrderedParameter(
            'topNumber',
            new StandardValidator\Integer(1),
            false
        );
        $this->addCast('topNumber', new DecimalInteger());
    }
}
