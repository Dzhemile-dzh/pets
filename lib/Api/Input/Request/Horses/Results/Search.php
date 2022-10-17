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

class Search extends \Api\Input\Request\HorsesRequest
{
    use \Api\Input\Request\Method\GetSearchDefaultStartDate;
    /**
     * Setup parameters
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceTitle',
            new Validator\SearchRaceTitle(),
            false
        );

        $this->addNamedParameter(
            'countryCode',
            new Validator\CountryCodeFullScope(),
            false
        );

        $this->addNamedParameter(
            'courseId',
            new \Api\Input\Request\Parameter\Validator\SearchCourseId(),
            false
        );
        $this->addCast('courseId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'startDate',
            new Validator\SearchDate(),
            false
        );

        $this->addNamedParameter(
            'endDate',
            new Validator\SearchDate(),
            false,
            date('Y-m-d')
        );

        $this->addValidator(new \Api\Input\Request\Validator\StartEndDate());
        $this->addValidator(new \Api\Input\Request\Validator\SearchDateRange());
    }
}
