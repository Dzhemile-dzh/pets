<?php

namespace Api\Input\Request\Horses\Results;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * Class DateLimitedRequest
 *
 * @package Api\Input\Request\Horses\Results
 */
class DateLimitedRequest extends \Api\Input\Request\Horses\Results\DateRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceDate',
            new StandardValidator\Date(
                new \DateTime('today -7 Days'),
                new \DateTime('today')
            ),
            true
        );
    }
}
