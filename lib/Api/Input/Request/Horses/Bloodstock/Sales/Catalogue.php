<?php
namespace Api\Input\Request\Horses\Bloodstock\Sales;

use Api\Input\Request\HorsesRequest;
use Api\Input\Request\Parameter\Validator\SeasonYear;
use Phalcon\Input\Request\Parameter\Validator\Boolean;
use Phalcon\Input\Request\Parameter\Cast;

class Catalogue extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'year',
            new SeasonYear()
        );
        $this->addCast('year', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'limitToDate',
            new Boolean(),
            false
        );
        $this->addCast('limitToDate', new Cast\Boolean());
    }
}
