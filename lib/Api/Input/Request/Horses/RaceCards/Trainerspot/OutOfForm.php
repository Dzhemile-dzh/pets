<?php

namespace Api\Input\Request\Horses\RaceCards\Trainerspot;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * Class OutOfForm
 *
 * @package Api\Input\Request\Horses\RaceCards\Trainerspot
 */
class OutOfForm extends \Api\Input\Request\HorsesRequest
{
    const REQUEST_TYPE = 'out-of-form';

    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'countryCode',
            new StandardValidator\ExistsInArray(['GB', 'IRE']),
            false
        );
    }

    /**
     * @return string
     */
    public function getRequestType()
    {
        return static::REQUEST_TYPE;
    }
}
