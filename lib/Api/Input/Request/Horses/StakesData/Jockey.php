<?php
namespace Api\Input\Request\Horses\StakesData;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast\DecimalInteger;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;
use Phalcon\Input\Request\Parameter\Validator\ExistsInArray;

class Jockey extends HorsesRequest
{
    /**
     * This method initialises all necessary validators and other restrictions for the certain request object
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'jockeyId',
            new IntegerId()
        );
        $this->addCast('jockeyId', new DecimalInteger());

        $this->addNamedParameter(
            'courseId',
            new IntegerId(),
            false
        );
        $this->addCast('courseId', new DecimalInteger());

        $this->addNamedParameter(
            'raceType',
            new ExistsInArray($this->getSelectors()->getRaceTypeKeys()),
            false
        );
    }
}
