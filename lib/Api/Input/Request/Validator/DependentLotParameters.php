<?php

namespace Api\Input\Request\Validator;

use Phalcon\Input\Request\Validator;
use Api\Exception\ValidationError;

class DependentLotParameters extends Validator
{
    /**
     * RegDateFromTo constructor.
     *
     * @param $request
     */
    public function __construct($request)
    {
        if (array_key_exists('lotLetter', $request->getIncomingNamedParameters())) {
            $request->getParameters()['lotNo']->setRequired(true);
        }
    }

    /**
     * @throws ValidationError
     */
    public function validate()
    {
    }
}
