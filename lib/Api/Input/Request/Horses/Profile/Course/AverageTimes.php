<?php

namespace Api\Input\Request\Horses\Profile\Course;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Phalcon\Input\Request\Parameter\Cast;

/**
 * Class AverageTimes
 * @package Api\Input\Request\Horses\Profile\Course
 */
class AverageTimes extends \Api\Input\Request\HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'courseId',
            new StandardValidator\SmallInteger()
        );
        $this->addCast('courseId', new Cast\DecimalInteger());
    }
}
