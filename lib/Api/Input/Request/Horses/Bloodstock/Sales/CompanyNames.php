<?php

namespace Api\Input\Request\Horses\Bloodstock\Sales;

use Api\Input\Request\Parameter\Validator\HorseAge;
use Api\Input\Request\Validator\DateFromTo;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use \Api\Constants\Horses as Constants;

/**
 * Class CompanyNames
 *
 * @package Api\Input\Request\Horses\Bloodstock\Sales
 */
class CompanyNames extends \Api\Input\Request\HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        if (count($this->rawNamedParameters) > 0) {
            $this->addNamedParameter(
                'dateFrom',
                new StandardValidator\Date(),
                true
            );

            $this->addNamedParameter(
                'dateTo',
                new StandardValidator\Date(null, (new \DateTime())->format('Y-m-d')),
                true
            );

            // Sale details
            $this->addNamedParameter(
                'sale',
                new StandardValidator\StringLength(3, 50),
                false
            );

            $this->addNamedParameter(
                'saleCompany',
                new StandardValidator\IntegerId(),
                false
            );
            $this->addCast('saleCompany', new Cast\DecimalInteger());

            $this->addNamedParameter(
                'vendor',
                new StandardValidator\StringLength(3, 50),
                false
            );

            $this->addNamedParameter(
                'buyer',
                new StandardValidator\StringLength(3, 50),
                false
            );

            $this->addNamedParameter(
                'minPrice',
                new StandardValidator\Integer(0),
                false
            );
            $this->addCast('minPrice', new Cast\DecimalInteger());

            $this->addNamedParameter(
                'maxPrice',
                new StandardValidator\Integer(0),
                false
            );
            $this->addCast('maxPrice', new Cast\DecimalInteger());

            $this->addNamedParameter(
                'lotNo',
                new StandardValidator\Integer(),
                false
            );
            $this->addCast('lotNo', new Cast\DecimalInteger());

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

            $this->addNamedParameter(
                'resultsWithSold',
                new StandardValidator\Boolean(),
                false
            );
            $this->addCast('resultsWithSold', new Cast\Boolean());

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

            $this->addValidator(new \Api\Input\Request\Validator\MinMaxPriceDependant());
            $this->addValidator(new DateFromTo());
        }
    }
}
