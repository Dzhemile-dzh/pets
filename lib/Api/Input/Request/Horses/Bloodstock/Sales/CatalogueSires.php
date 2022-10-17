<?php
namespace Api\Input\Request\Horses\Bloodstock\Sales;

use Phalcon\Input\Request\Parameter\Validator\IntegerId;
use Phalcon\Input\Request\Parameter\Validator\Date;
use Phalcon\Input\Request\Parameter\Cast;
use Api\Exception\ValidationError;
use Api\Input\Request\Validator\DateFromTo;

class CatalogueSires extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'venueId',
            new IntegerId(),
            true
        );
        $this->addCast('venueId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'startDate',
            new Date(),
            true
        );

        $this->addNamedParameter(
            'endDate',
            new Date(),
            true
        );

        $this->addValidator(new DateFromTo());
    }
}
