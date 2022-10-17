<?php

namespace Api\Input\Request\Horses\Results;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class DateRequestAllRaces
 *
 * @package Api\Input\Request\Horses\Results
 *
 * @method getRaceDate()
 * @method getReturnP2P()
 *
 */
class DateRequestAllRaces extends \Api\Input\Request\HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'raceDate',
            new StandardValidator\Date(null, new \DateTime('today')),
            false,
            new \DateTime('today')
        );

        $this->addNamedParameter(
            'returnP2P',
            new StandardValidator\Boolean(),
            false
        );
        $this->addCast('returnP2P', new Cast\Boolean());
    }
}
