<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 11/4/2016
 * Time: 12:42 PM
 */

namespace Api\Input\Request\Horses\Signposts;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

class ListForMobile extends \Api\Input\Request\HorsesRequest
{
    /**
     * This method initialises all necessary validators and other restrictions for the certain request object
     */
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'daily',
            new StandardValidator\ExistsInArray(['daily']),
            false
        );
    }
}
