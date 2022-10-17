<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 9/28/2016
 * Time: 2:31 PM
 */

namespace Api\Input\Request\Horses\RaceCards;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

class TopSelections extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'date',
            new StandardValidator\Date()
        );
    }
}
