<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 29/12/14
 * Time: 12:41 PM
 */

namespace Api\Input\Request\Horses\Profile\Trainer;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class BigRaceWins extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'trainerId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('trainerId', new Cast\DecimalInteger());
    }
}