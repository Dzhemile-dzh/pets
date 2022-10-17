<?php

namespace Api\Input\Request\Horses\Tipping;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use \Api\Input\Request\HorsesRequest;

/**
 * Class Tippings
 *
 * @package Api\Input\Request\Horses\Tipping
 *
 * @method string getRaceDate()
 */
class Singles extends HorsesRequest
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
