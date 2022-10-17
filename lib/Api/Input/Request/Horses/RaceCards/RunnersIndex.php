<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 29/12/14
 * Time: 12:41 PM
 */

namespace Api\Input\Request\Horses\RaceCards;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

class RunnersIndex extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'raceDate',
            new StandardValidator\Date()
        );
    }
}
