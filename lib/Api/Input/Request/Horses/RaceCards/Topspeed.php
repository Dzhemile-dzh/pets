<?php

namespace Api\Input\Request\Horses\RaceCards;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class Topspeed
 * @package Api\Input\Request\Horses\RaceCards
 * @method getRaceId()
 * @method getRaceDate()
 */
class Topspeed extends \Api\Input\Request\HorsesRequest
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

        $this->addNamedParameter(
            'raceDate',
            new StandardValidator\Date()
        );
    }
}
