<?php

namespace Api\Input\Request\Horses\Ads\SuccessBoxes;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

class Index extends \Api\Input\Request\HorsesRequest
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'raceId',
            new StandardValidator\IntegerId()
        );
        $this->addCast('raceId', new Cast\DecimalInteger());

        $this->addOrderedParameter(
            'breakpoint',
            new StandardValidator\IntegerId()
        );
        $this->addCast('breakpoint', new Cast\DecimalInteger());
    }
}
