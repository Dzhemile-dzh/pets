<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 3/15/2016
 * Time: 6:14 PM
 */

namespace Api\Input\Request\Horses\Bloodstock\Stallion;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Nick extends \Api\Input\Request\HorsesRequest
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
