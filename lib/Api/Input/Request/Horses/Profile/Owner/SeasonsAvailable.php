<?php

namespace Api\Input\Request\Horses\Profile\Owner;

use Api\Input\Request\Horses\Profile;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * Class SeasonsAvailable
 * @package Api\Input\Request\Horses\Profile\Owner
 */
class SeasonsAvailable extends Profile
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'ownerId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('ownerId', new Cast\DecimalInteger());
    }
}
