<?php

declare(strict_types=1);

namespace Api\Input\Request\Horses;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator as StandardValidator;

/**
 * Class WeatherConditions
 *
 * @package Api\Input\Request\Horses
 *
 * @method string getMeetingDate()
 * @method int getCourseId()
 */
class WeatherConditions extends HorsesRequest
{
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'meetingDate',
            new StandardValidator\Date(),
            true
        );

        $this->addNamedParameter(
            'courseId',
            new StandardValidator\SmallInteger(),
            false
        );
        $this->addCast('courseId', new Cast\DecimalInteger());
    }
}
