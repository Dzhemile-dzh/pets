<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 6/7/2016
 * Time: 3:16 PM
 */

namespace Api\Input\Request\Horses\Profile\Course;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use Api\Input\Request\HorsesRequest;
use Api\Input\Request\Validator\StartEndYear;
use Api\Constants\Horses as Constants;

class TopTrainers extends HorsesRequest
{

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

        $this->addValidator(new StartEndYear());

        $this->addOrderedParameter(
            'raceDate',
            new StandardValidator\Date(),
            false
        );
        $this->addOrderedParameter(
            'raceType',
            new StandardValidator\ExistsInArray([Constants::RACE_TYPE_FLAT_ALIAS, Constants::RACE_TYPE_JUMPS_ALIAS]),
            false
        );
    }
}
