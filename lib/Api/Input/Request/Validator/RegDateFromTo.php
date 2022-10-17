<?php

namespace Api\Input\Request\Validator;

use Phalcon\Input\Request\Validator;
use Api\Exception\ValidationError;

class RegDateFromTo extends Validator
{
    /**
     * RegDateFromTo constructor.
     *
     * @param $request
     */
    public function __construct($request)
    {
        if (!array_key_exists('regId', $request->getIncomingNamedParameters())) {
            $request->getParameters()['dateFrom']->setRequired(true);
            $request->getParameters()['dateTo']->setRequired(true);
        }
    }

    /**
     * @throws ValidationError
     */
    public function validate()
    {
    }
}
