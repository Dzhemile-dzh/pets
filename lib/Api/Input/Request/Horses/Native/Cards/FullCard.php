<?php

declare(strict_types=1);

namespace Api\Input\Request\Horses\Native\Cards;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use \Api\Input\Request\HorsesRequest;

/**
 * @package Api\Input\Request\Horses\Native\Cards
 * @method getRaceId
 */
class FullCard extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters(): void
    {
        $this->addNamedParameter(
            'raceId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('raceId', new Cast\DecimalInteger());
    }
}
