<?php

/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 6/24/2016
 * Time: 3:13 PM
 */

namespace Api\Input\Request\Horses\Bloodstock\StallionBook;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Names extends \Api\Input\Request\HorsesRequest
{

    /**
     * This method initialises all necessary validators and other restrictions for the certain request object
     */
    protected function setupParameters()
    {
        // Type of list
        $this->addNamedParameter(
            'type',
            new StandardValidator\ExistsInArray(['active', 'inactive', 'weatherbys']),
            false,
            'active'
        );
    }
}
