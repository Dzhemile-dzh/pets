<?php

namespace Api\Input\Request\Horses\RaceCards;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class GodolphinReplay
 * @package Api\Input\Request\Horses\RaceCards
 *
 * @method int getRaceId
 */
class GodolphinReplay extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('raceId', new Cast\DecimalInteger());
    }
}
