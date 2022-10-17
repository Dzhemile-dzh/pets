<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 2/25/2016
 * Time: 12:37 PM
 */

namespace Api\Input\Request\Horses\Bloodstock\Stallion;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use Api\Input\Request\Parameter\Validator;

class Index extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'stallionId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('stallionId', new Cast\DecimalInteger());
    }
}
