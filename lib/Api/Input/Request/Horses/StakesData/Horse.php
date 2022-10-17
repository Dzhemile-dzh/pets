<?php
namespace Api\Input\Request\Horses\StakesData;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Horse extends HorsesRequest
{
    /**
     * This method initialises all necessary validators and other restrictions for the certain request object
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'horseId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('horseId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'courseId',
            new StandardValidator\IntegerId(),
            false
        );
        $this->addCast('courseId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'raceType',
            new StandardValidator\ExistsInArray(['flat', 'jumps']),
            false
        );
    }
}
