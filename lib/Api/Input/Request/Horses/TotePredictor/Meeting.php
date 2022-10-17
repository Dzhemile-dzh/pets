<?php

namespace Api\Input\Request\Horses\TotePredictor;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Cast;
use Phalcon\Input\Request\Parameter\Validator\Date;
use Phalcon\Input\Request\Parameter\Validator\IntegerId;

/**
 * Class Meeting
 *
 * @package Api\Input\Request\Horses\TotePredictor
 *
 * @method string getDate()
 * @method int getCourseId()
 */
class Meeting extends HorsesRequest
{
    /**
     * This method initialises all necessary validators and other restrictions for the certain request object
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'date',
            new Date(null, (new \DateTime())->format('Y-m-d'))
        );

        $this->addNamedParameter(
            'courseId',
            new IntegerId()
        );
        $this->addCast('courseId', new Cast\DecimalInteger());
    }
}
