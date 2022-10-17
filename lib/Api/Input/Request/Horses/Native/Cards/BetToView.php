<?php

declare(strict_types=1);

namespace Api\Input\Request\Horses\Native\Cards;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;

/**
 * @method int getRaceId()
 *
 * @package Api\Input\Request\Horses\Native\Cards
 */
class BetToView extends HorsesRequest
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
