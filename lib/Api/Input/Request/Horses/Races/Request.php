<?php

declare(strict_types=1);

namespace Api\Input\Request\Horses\Races;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * Class Request
 * @package Api\Input\Request\Horses\Races
 * @method getDate
 */
class Request extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters(): void
    {
        $this->addNamedParameter(
            'date',
            new StandardValidator\Date(),
            false
        );
    }
}
