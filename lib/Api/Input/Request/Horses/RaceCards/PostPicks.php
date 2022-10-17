<?php

namespace Api\Input\Request\Horses\RaceCards;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;

/**
 * @method int getRaceId()
 *
 * @package Api\Input\Request\Horses\RaceCards
 */
class PostPicks extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceId',
            new IntegerId()
        );
        $this->addCast('raceId', new Cast\DecimalInteger());
    }
}
