<?php

namespace Api\Input\Request\Horses\Results;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class Courses
 *
 * @package Api\Input\Request\Horses\Results
 *
 * @method getReturnP2P()
 */
class Courses extends \Api\Input\Request\HorsesRequest
{
    /**
     * Setup parameters
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'returnP2P',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('returnP2P', new Cast\Boolean());
    }
}
