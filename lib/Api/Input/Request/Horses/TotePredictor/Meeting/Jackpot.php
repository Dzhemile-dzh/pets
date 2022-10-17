<?php

namespace Api\Input\Request\Horses\TotePredictor\Meeting;

use Api\Input\Request\HorsesRequest;
use Phalcon\Input\Request\Parameter\Validator\Date;

/**
 * Class Jackpot
 * @package Api\Input\Request\Horses\TotePredictor
 * @method string getDate()
 */
class Jackpot extends HorsesRequest
{
    /**
     * @inheritdoc
     */
    protected function setupParameters()
    {
        $this->addNamedParameter(
            'date',
            new Date()
        );
    }
}
