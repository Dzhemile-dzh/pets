<?php

namespace Api\Input\Request\Horses\Results;

use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator;

/**
 * Class RaceInfo
 *
 * @method int getRaceId()
 *
 * @package Api\Input\Request\Horses\Results
 */
class RaceInfo extends \Api\Input\Request\HorsesRequest
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
