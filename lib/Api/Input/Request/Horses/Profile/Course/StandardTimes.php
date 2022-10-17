<?php
/**
 * Created by PhpStorm.
 * User: oleg_symonchuk
 * Date: 29/12/14
 * Time: 12:41 PM
 */

namespace Api\Input\Request\Horses\Profile\Course;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class StandardTimes extends \Api\Input\Request\HorsesRequest
{
    use \Api\Input\Request\Method\GetRaceTypeCodes;

    protected function setupParameters()
    {
        $this->addNamedParameter(
            'courseId',
            new StandardValidator\SmallInteger()
        );
        $this->addCast('courseId', new Cast\DecimalInteger());
    }
}
