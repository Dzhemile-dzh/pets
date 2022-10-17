<?php
namespace Tests\Api\Input\Request\Mocks;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use Api\Input\Request\Validator\RegDateFromTo;
use Api\Input\Request\Validator\DependentLotParameters;

class SalesRequestMock extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'dateFrom',
            new StandardValidator\Date(),
            false
        );

        $this->addNamedParameter(
            'dateTo',
            new StandardValidator\Date(null, (new \DateTime())->format('Y-m-d')),
            false
        );

        $this->addNamedParameter(
            'regId',
            new StandardValidator\IntegerId(),
            false
        );
        $this->addCast('regId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'lotNo',
            new StandardValidator\Integer(),
            false
        );
        $this->addCast('lotNo', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'lotLetter',
            new StandardValidator\StringLength(1, 1),
            false
        );
        $this->addCast('lotLetter', new Cast\Text());

        $this->addValidator(new DependentLotParameters($this));
        $this->addValidator(new RegDateFromTo($this));
    }
}
