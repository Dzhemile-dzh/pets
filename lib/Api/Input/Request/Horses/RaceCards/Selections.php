<?php

namespace Api\Input\Request\Horses\RaceCards;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class Selections
 * @package Api\Input\Request\Horses\RaceCards
 *
 * @method int getRaceId
 */
class Selections extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'raceId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('raceId', new Cast\DecimalInteger());
    }
}
