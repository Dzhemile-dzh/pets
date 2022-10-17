<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/26/2016
 * Time: 3:28 PM
 */

namespace Api\Input\Request\Horses\LookupTable;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;

class AdditionalCourseInfo extends HorsesRequest
{
    /**
     * Setup parameters
     */
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'straightRoundJubileeCode',
            new StandardValidator\StringLength(1, 1),
            false
        );
        $this->addCast('straightRoundJubileeCode', new Cast\Text());
    }
}
