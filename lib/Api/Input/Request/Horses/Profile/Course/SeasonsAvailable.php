<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 3/14/2016
 * Time: 4:36 PM
 */

namespace Api\Input\Request\Horses\Profile\Course;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class SeasonsAvailable extends \Api\Input\Request\HorsesRequest
{
    /**
     * Setup parameters
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'courseId',
            new StandardValidator\SmallInteger()
        );
        $this->addCast('courseId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'activeSeasons',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('activeSeasons', new Cast\Boolean());
    }
}
