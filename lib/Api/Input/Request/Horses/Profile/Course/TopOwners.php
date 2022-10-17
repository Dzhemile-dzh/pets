<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/13/2016
 * Time: 11:49 AM
 */

namespace Api\Input\Request\Horses\Profile\Course;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class TopOwners extends \Api\Input\Request\HorsesRequest
{

    /**
     * This method initialises all necessary validators and other restrictions for the certain request object
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'courseId',
            new StandardValidator\SmallInteger()
        );
        $this->addCast('courseId', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'startYear',
            new StandardValidator\Integer(1900, 2038)
        );
        $this->addCast('startYear', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'endYear',
            new StandardValidator\Integer(1900, 2038)
        );
        $this->addCast('endYear', new Cast\DecimalInteger());

        $this->addValidator(new \Api\Input\Request\Validator\StartEndYear());
    }
}
