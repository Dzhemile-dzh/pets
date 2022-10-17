<?php

/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 8/2/2016
 * Time: 6:27 PM
 */

namespace Api\Input\Request\Horses\Bloodstock\SalesStatistics;

use Api\Input\Request\Validator;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class Sale
 *
 * @method int getVenueId()
 * @method string getStartDate()
 * @method string getEndDate()
 *
 * @package Api\Input\Request\Horses\Bloodstock\SalesStatistics
 */
class Sales extends \Api\Input\Request\HorsesRequest
{
    /**
     * This method initialises all necessary validators and other restrictions for the certain request object
     */
    protected function setupParameters()
    {
        //Dates
        $this->addOrderedParameter(
            'venueId',
            new StandardValidator\IntegerId(),
            true
        );
        $this->addCast('venueId', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'startDate',
            new StandardValidator\Date(null, (new \DateTime())->format('Y-m-d')),
            true
        );

        $this->addOrderedParameter(
            'endDate',
            new StandardValidator\Date(null, (new \DateTime())->format('Y-m-d')),
            true
        );

        $this->addValidator(new Validator\StartEndDate());
    }
}
