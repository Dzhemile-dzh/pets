<?php

declare(strict_types=1);

namespace Api\Input\Request\Horses\Native\Competitor;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;

/**
 * @package Api\Input\Request\Horses\Native\Competitor
 */
class CompetitorDetails extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters(): void
    {
        $this->addNamedParameter(
            'horseId',
            new IntegerId()
        );
        $this->addCast('horseId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'raceId',
            new IntegerId()
        );
        $this->addCast('raceId', new Cast\DecimalInteger());
    }
}
