<?php

namespace Api\Input\Request\Horses\Profile\Owner;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Api\Input\Request\Parameter\Validator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class Results
 * @package Api\Input\Request\Horses\Profile\Owner
 */
class Results extends \Api\Input\Request\HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'ownerId',
            new StandardValidator\IntegerId(),
            true
        );
        $this->addCast('ownerId', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'year',
            new Validator\SeasonYear(),
            true
        );
        $this->addCast('year', new Cast\DecimalInteger());
    }
}
