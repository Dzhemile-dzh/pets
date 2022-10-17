<?php

namespace Api\Input\Request\Horses\RaceCards;

use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator;
use \Api\Input\Request\HorsesRequest as Request;

/**
 * Class KeyStats
 *
 * @method int getRaceId()
 *
 * @package Api\Input\Request\Horses\RaceCards
 */
class KeyStats extends Request
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceId',
            new Validator\IntegerId()
        );

        $this->addCast('raceId', new Cast\DecimalInteger());
    }
}
