<?php

namespace Api\Input\Request\Horses\Profile\Horse;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class Record
 *
 * @method int getHorseId()
 * @method bool getReturnP2P()
 *
 * @package Api\Input\Request\Horses\Profile\Horse
 */
class Record extends \Api\Input\Request\HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'horseId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('horseId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'returnP2P',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('returnP2P', new Cast\Boolean());
    }
}
