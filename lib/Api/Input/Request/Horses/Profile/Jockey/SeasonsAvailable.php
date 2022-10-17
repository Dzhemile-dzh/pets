<?php

namespace Api\Input\Request\Horses\Profile\Jockey;

use Api\Input\Request\Horses\Profile;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * Class SeasonsAvailable
 * @package Api\Input\Request\Horses\Profile\Jockey
 */
class SeasonsAvailable extends Profile
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'jockeyId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('jockeyId', new Cast\DecimalInteger());
    }
}
