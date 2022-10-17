<?php

namespace Api\Input\Request\Horses\RaceCards;

use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator;

/**
 * Class StandardRunners
 *
 * @method int getRaceId()
 * @method bool getReturnP2P()
 *
 * @package Api\Input\Request\Horses\RaceCards
 */
class StandardRunners extends \Api\Input\Request\HorsesRequest
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

        $this->addNamedParameter(
            'returnP2P',
            new Validator\Boolean(),
            false
        );
        $this->addCast('returnP2P', new Cast\Boolean());
    }
}
