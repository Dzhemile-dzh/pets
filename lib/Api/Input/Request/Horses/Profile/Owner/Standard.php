<?php

namespace Api\Input\Request\Horses\Profile\Owner;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class Standard
 *
 * @method int getOwnerId()
 * @package Api\Input\Request\Horses\Profile\Owner
 */
class Standard extends \Api\Input\Request\HorsesRequest
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
