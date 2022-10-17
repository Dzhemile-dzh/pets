<?php

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class StartEndDate extends Validator
{

    /**
     * @throws ValidationError
     */
    public function validate()
    {
        if (strtotime($this->request->getStartDate()) > strtotime($this->request->getEndDate())) {
            throw new ValidationError(1010);
        }
    }
}
