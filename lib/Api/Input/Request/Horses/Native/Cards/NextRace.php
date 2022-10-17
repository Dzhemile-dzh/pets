<?php

declare(strict_types=1);

namespace Api\Input\Request\Horses\Native\Cards;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * Class NextRace
 * @package Api\Input\Request\Horses\Native\Cards
 *
 * @method string getDate()
 */
class NextRace extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'date',
            new StandardValidator\Date()
        );
    }
}
