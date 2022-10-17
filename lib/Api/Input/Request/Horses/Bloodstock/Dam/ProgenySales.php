<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 29/12/14
 * Time: 12:41 PM
 */

namespace Api\Input\Request\Horses\Bloodstock\Dam;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class ProgenySales extends \Api\Input\Request\HorsesRequest
{
    /**
     * Setup parameters
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'damId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('damId', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'startDate',
            new StandardValidator\Date(),
            false,
            '1900-01-01'
        );

        $this->addOrderedParameter(
            'endDate',
            new StandardValidator\Date(),
            false,
            //we can have sales in the future, so we add year to ensure an integrity of a result
            (new \DateTime('+1 Year'))->format('Y-m-d')
        );
    }
}
