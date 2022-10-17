<?php

declare(strict_types=1);

namespace Api\Input\Request\Horses\Races;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator;

/**
 * Class RequestById
 * @method int getRaceId()
 *
 * @package Api\Input\Request\Horses\Races
 */
class RequestById extends HorsesRequest
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
