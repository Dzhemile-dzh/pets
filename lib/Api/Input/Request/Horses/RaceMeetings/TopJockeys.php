<?php
namespace Api\Input\Request\Horses\RaceMeetings;

use Api\Constants\Horses as Constants;
use Api\Input\Request\HorsesRequest;
use Api\Input\Request\Validator\StartEndYear;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class TopJockeys extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'raceDate',
            new StandardValidator\Date()
        );

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
            'courseId',
            new StandardValidator\SmallInteger(),
            false
        );
        $this->addCast('courseId', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'raceType',
            new StandardValidator\ExistsInArray([
                Constants::RACE_TYPE_FLAT_ALIAS,
                Constants::RACE_TYPE_JUMPS_ALIAS
            ]),
            false
        );
    }
}
