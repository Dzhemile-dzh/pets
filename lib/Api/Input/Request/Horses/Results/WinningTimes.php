<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 29/12/14
 * Time: 12:41 PM
 */

namespace Api\Input\Request\Horses\Results;

use Api\Input\Request\Parameter\Validator;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class WinningTimes extends \Api\Input\Request\HorsesRequest
{
    /**
     * Setup parameters
     */
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'courseId',
            new StandardValidator\SmallInteger(),
            true
        );
        $this->addCast('courseId', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'raceDate',
            new StandardValidator\Date(),
            true
        );
    }
}
