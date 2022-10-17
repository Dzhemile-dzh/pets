<?php

namespace Api\Input\Request\Horses\Results;

use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator;

/**
 * Class Index
 *
 * @method int getRaceId()
 *
 * @package Api\Input\Request\Horses\Results
 */
class Index extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceId',
            new Validator\IntegerId(),
            true
        );
        $this->addCast('raceId', new Cast\DecimalInteger());
    }
}
