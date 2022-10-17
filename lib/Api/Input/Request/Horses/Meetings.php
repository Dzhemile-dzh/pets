<?php

declare(strict_types=1);

namespace Api\Input\Request\Horses;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * @package Api\Input\Request\Horses
 * @method getDate
 */
class Meetings extends HorsesRequest
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
