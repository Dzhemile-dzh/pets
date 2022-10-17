<?php

namespace Api\Input\Request\Horses\RaceMeetings;

use Api\Input\Request\Parameter\Validator;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Statistics extends \Api\Input\Request\HorsesRequest
{
    use \Api\Input\Request\Method\GetRaceTypeCodes;

    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'courseId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('courseId', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'date',
            new StandardValidator\Date()
        );

        $this->addOrderedParameter(
            'raceType',
            new Validator\RaceType(
                $this->getSelectors()
            )
        );
    }
}
