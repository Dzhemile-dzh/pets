<?php

declare(strict_types=1);

namespace Api\Input\Request\Horses\OwnerGroups;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use \Api\Input\Request\HorsesRequest;

/**
 * @package Api\Input\Request\Horses\OwnerGroups
 * @method getDate()
 */
class DailyStats extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters(): void
    {
        $this->addNamedParameter(
            'date',
            new StandardValidator\Date(),
            false,
            date("Y-m-d")
        );
    }
}
