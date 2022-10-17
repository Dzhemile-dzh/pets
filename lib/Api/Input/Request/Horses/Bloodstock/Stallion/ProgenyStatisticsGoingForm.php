<?php
namespace Api\Input\Request\Horses\Bloodstock\Stallion;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;
use Phalcon\Input\Request\Parameter\Cast;

class ProgenyStatisticsGoingForm extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'stallionId',
            new IntegerId()
        );
        $this->addCast('stallionId', new Cast\DecimalInteger());
    }
}
