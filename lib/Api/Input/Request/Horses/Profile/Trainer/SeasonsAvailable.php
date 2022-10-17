<?php

namespace Api\Input\Request\Horses\Profile\Trainer;

use Api\Input\Request\Horses\Profile;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * Class SeasonsAvailable
 * @package Api\Input\Request\Horses\Profile\Trainer
 */
class SeasonsAvailable extends Profile
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'trainerId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('trainerId', new Cast\DecimalInteger());
    }
}
