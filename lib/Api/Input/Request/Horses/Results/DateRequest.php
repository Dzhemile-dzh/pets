<?php

namespace Api\Input\Request\Horses\Results;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * Class DateRequest
 *
 * @package Api\Input\Request\Horses\Results
 */
class DateRequest extends \Api\Input\Request\HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceDate',
            new StandardValidator\Date(
                null,
                new \DateTime('today')
            ),
            false,
            new \DateTime('today')
        );
    }
}
