<?php
namespace Api\Input\Request\Horses\Bloodstock\Dam;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;
use Phalcon\Input\Request\Parameter\Cast;

class ProgenyResultsDefault extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'damId',
            new IntegerId()
        );
        $this->addCast('damId', new Cast\DecimalInteger());
    }
}
