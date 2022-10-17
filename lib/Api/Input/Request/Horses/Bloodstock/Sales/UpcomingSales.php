<?php

namespace Api\Input\Request\Horses\Bloodstock\Sales;

use Api\Input\Request\Validator\DependentLotParameters;
use Api\Input\Request\Validator\DateFromTo;
use Api\Input\Request\Validator\RegDateFromTo;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use Api\Input\Request\Parameter\Validator\HorseAge;
use \Api\Constants\Horses as Constants;

/**
 * Class UpcomingSales
 *
 * @package Api\Input\Request\Horses\Bloodstock\Sales
 */
class UpcomingSales extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        //Sale Details
        $this->addNamedParameter(
            'sales',
            new StandardValidator\ArrayParameter(new StandardValidator\RegEx("/[0-9]+_[0-9]+/")),
            false
        );

        $this->addNamedParameter(
            'salesAll',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('salesAll', new Cast\Boolean());

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

        //Horse
        $this->addNamedParameter(
            'name',
            new StandardValidator\StringLength(3, 30),
            false
        );

        $this->addNamedParameter(
            'sex',
            new StandardValidator\ExistsInArray(Constants::AVAILABLE_SEX_CODES),
            false
        );

        $this->addNamedParameter(
            'age',
            new HorseAge(['0', '1', '2', '3+']),
            false
        );
        $this->addCast('age', new Cast\HorseAge());

        $this->addNamedParameter(
            'vendor',
            new StandardValidator\StringLength(3, 75),
            false
        );

        //pedigree
        $this->addNamedParameter(
            'sire',
            new StandardValidator\StringLength(3, 30),
            false
        );

        $this->addNamedParameter(
            'dam',
            new StandardValidator\StringLength(3, 30),
            false
        );

        $this->addNamedParameter(
            'damSire',
            new StandardValidator\StringLength(3, 30),
            false
        );

        //With Entries flag
        $this->addNamedParameter(
            'withEntries',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('withEntries', new Cast\Boolean());

        //Dates
        $this->addNamedParameter(
            'dateFrom',
            new StandardValidator\Date((new \DateTime())->sub(new \DateInterval('P14D'))->format('Y-m-d')),
            false
        );

        $this->addNamedParameter(
            'dateTo',
            new StandardValidator\Date(),
            false
        );

        $this->addNamedParameter(
            'regId',
            new StandardValidator\IntegerId(),
            false
        );
        $this->addCast('regId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'venueId',
            new StandardValidator\IntegerId(),
            false
        );
        $this->addCast('venueId', new Cast\DecimalInteger());

        $this->addValidator(new DependentLotParameters($this));
        $this->addValidator(new RegDateFromTo($this));
        $this->addValidator(new DateFromTo());
    }
}
