<?php

namespace Api\Input\Request\Horses\Profile\Jockey;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class Standard
 *
 * @method int getJockeyId()
 * @package Api\Input\Request\Horses\Profile\Jockey
 */
class Standard extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'jockeyId',
            new StandardValidator\IntegerId(),
            true
        );
        $this->addCast('jockeyId', new Cast\DecimalInteger());
    }
}
