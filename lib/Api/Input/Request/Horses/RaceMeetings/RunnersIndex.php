<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/25/2015
 * Time: 6:25 PM
 */

namespace Api\Input\Request\Horses\RaceMeetings;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class RunnersIndex extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'courseId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('courseId', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'raceDate',
            new StandardValidator\Date()
        );
    }
}
