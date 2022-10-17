<?php

namespace Api\Input\Request\Horses\Predictor;

use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;

/**
 * Class Index
 *
 * @method int getRaceId()
 *
 * @package Api\Input\Request\Horses\Predictor
 */
class Index extends \Api\Input\Request\HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters(): void
    {
        $this->addNamedParameter(
            'raceId',
            new IntegerId()
        );
        $this->addCast('raceId', new Cast\DecimalInteger());
    }
}
