<?php

namespace Api\Input\Request\Horses\TotePredictor;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;

/**
 * Class Race
 *
 * @package Api\Input\Request\Horses\TotePredictor
 *
 * @method int getRaceId()
 */
class Race extends HorsesRequest
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
