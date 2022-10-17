<?php

declare(strict_types=1);

namespace Api\Input\Request\Horses\Native\Profiles\Horses;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;

/**
 * @method string getResultsDate()
 * @package Api\Input\Request\Horses\Native\Results
 */
class Horse extends HorsesRequest
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
    }
}
