<?php
namespace Api\Input\Request\Horses\RaceMeetings;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator\Date;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;
use Phalcon\Input\Request\Parameter\Validator\SmallInteger;
use Phalcon\Input\Request\Parameter\Cast;

class NonRunners extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'date',
            new Date()
        );

        $this->addNamedParameter(
            'courseId',
            new SmallInteger(),
            false
        );
        $this->addCast('courseId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'raceId',
            new IntegerId(),
            false
        );
        $this->addCast('raceId', new Cast\DecimalInteger());
    }
}
