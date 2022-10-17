<?php

namespace Api\Input\Request\Horses\RaceCards;

use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator;

/**
 * Class Index
 *
 * @method int getRaceId()
 * @package Api\Input\Request\Horses\RaceCards
 */
class Index extends \Api\Input\Request\HorsesRequest
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
