<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 7/21/2016
 * Time: 11:25 AM
 */

namespace Api\Input\Request\Horses\Bloodstock\Sales;

use Api\Input\Request\Validator;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class CatalogueVendors extends \Api\Input\Request\HorsesRequest
{

    /**
     * This method initialises all necessary validators and other restrictions for the certain request object
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'venueId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('venueId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'startDate',
            new StandardValidator\Date()
        );

        $this->addNamedParameter(
            'endDate',
            new StandardValidator\Date()
        );

        $this->addValidator(new Validator\StartEndDate());
    }
}
