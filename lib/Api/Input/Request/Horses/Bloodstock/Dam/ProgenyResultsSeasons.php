<?php
namespace Api\Input\Request\Horses\Bloodstock\Dam;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class ProgenyResultsSeasons extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'damId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('damId', new Cast\DecimalInteger());
    }
}
