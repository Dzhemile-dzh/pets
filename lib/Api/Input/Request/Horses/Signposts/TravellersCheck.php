<?php

namespace Api\Input\Request\Horses\Signposts;

use Api\Input\Request\Horses\Signposts;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

class TravellersCheck extends Signposts
{
    protected function setupParameters()
    {
        $this->addOrderedParameter(
            'daily',
            new StandardValidator\ExistsInArray(['daily']),
            false
        );

        $this->addNamedParameter(
            'courseId',
            new StandardValidator\SmallInteger(),
            false
        );
        $this->addCast('courseId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'raceId',
            new StandardValidator\IntegerId(),
            false
        );
        $this->addCast('raceId', new Cast\DecimalInteger());

        $this->addNamedParameter(
            'dist',
            new StandardValidator\SmallInteger(),
            false,
            200
        );
        $this->addCast('dist', new Cast\DecimalInteger());
    }
}
