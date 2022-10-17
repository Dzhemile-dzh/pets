<?php

namespace Api\Input\Request\Horses\RaceCards;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class Rpr
 * @package Api\Input\Request\Horses\RaceCards
 */
class Rpr extends \Api\Input\Request\HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('raceId', new Cast\DecimalInteger());
    }
}
