<?php

namespace Api\Input\Request\Horses\Tipping;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use \Api\Input\Request\HorsesRequest;

/**
 * Class Multiples
 *
 * @package Api\Input\Request\Horses\Tipping
 *
 * @method string getRaceDate()
 */
class Multiples extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceDate',
            new StandardValidator\Date(),
            true
        );
    }
}
