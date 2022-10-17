<?php

namespace Api\Input\Request\Horses\RaceCards;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class Upcoming
 * @package Api\Input\Request\Horses\RaceCards
 * @method getLimit()
 */
class Upcoming extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'limit',
            new StandardValidator\Integer(1, 50),
            false
        );
        $this->addCast('limit', new Cast\DecimalInteger());
    }
}
