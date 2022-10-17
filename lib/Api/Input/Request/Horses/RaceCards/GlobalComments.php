<?php

namespace Api\Input\Request\Horses\RaceCards;

use Models\Selectors;
use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast\DecimalInteger;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;
use Phalcon\Input\Request\Parameter\Validator\StringLength;

/**
 * @method string getRaceDate()
 *
 * @package Api\Input\Request\Horses\RaceCards
 */
class GlobalComments extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'raceId',
            new IntegerId()
        );
        $this->addCast('raceId', new DecimalInteger());

        $this->addNamedParameter(
            'commentLanguage',
            new StringLength(3, 3),
            false
        );

        $this->addNamedParameter(
            'horseId',
            new IntegerId(),
            false
        );
        $this->addCast('horseId', new DecimalInteger());
    }
}
