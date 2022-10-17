<?php

namespace Api\Input\Request\Horses\RaceCards\Date;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use \Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator\StringLength;

/**
 * Class AllMeetings
 *
 * @package Api\Input\Request\Horses\RaceCards\Date
 */
class AllMeetings extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceDate',
            new StandardValidator\Date()
        );
        
        $this->addNamedParameter(
            'countryCode',
            new StringLength(2, 3),
            false
        );
    }
}
