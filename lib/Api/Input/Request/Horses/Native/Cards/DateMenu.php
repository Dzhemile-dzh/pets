<?php

declare(strict_types=1);

namespace Api\Input\Request\Horses\Native\Cards;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use \Api\Input\Request\HorsesRequest;

/**
 * @package Api\Input\Request\Horses\Native\Cards
 * @method getRaceDate
 */
class DateMenu extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters(): void
    {
        $this->addNamedParameter(
            'raceDate',
            new StandardValidator\Date(),
            false,
            date('Y-m-d')
        );
    }
}
