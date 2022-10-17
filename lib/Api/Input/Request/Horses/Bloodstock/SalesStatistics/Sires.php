<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/4/2016
 * Time: 12:42 PM
 */

namespace Api\Input\Request\Horses\Bloodstock\SalesStatistics;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class Sires
 *
 * @method int getVenueId()
 * @method string getStartDate()
 * @method string getEndDate()
 *
 * @package Api\Input\Request\Horses\Bloodstock\SalesStatistics
 *
 */
class Sires extends \Api\Input\Request\HorsesRequest
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
    }
}
