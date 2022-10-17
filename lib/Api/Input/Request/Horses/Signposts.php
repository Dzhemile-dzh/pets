<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 2/27/2017
 * Time: 5:55 PM
 */

namespace Api\Input\Request\Horses;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;
use Api\Input\Request\HorsesRequest;

class Signposts extends HorsesRequest
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
    }
}
