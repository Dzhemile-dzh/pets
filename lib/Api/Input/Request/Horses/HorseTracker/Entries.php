<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/6/2016
 * Time: 12:39 PM
 */

namespace Api\Input\Request\Horses\HorseTracker;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Entries extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'userId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('userId', new Cast\DecimalInteger());
    }
}
