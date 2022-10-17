<?php
namespace Api\Input\Request\Horses\Bloodstock\Sales;

use Api\Input\Request\HorsesRequest;
use Api\Input\Request\Validator\StartEndDate;
use Phalcon\Input\Request\Parameter\Validator\Date;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator\SybaseSmallint;

class CataloguePreviouslySold extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'venueId',
            new SybaseSmallint()
        );
        $this->addCast('venueId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'startDate',
            new Date()
        );

        $this->addNamedParameter(
            'endDate',
            new Date()
        );

        $this->addValidator(new StartEndDate());
    }
}
