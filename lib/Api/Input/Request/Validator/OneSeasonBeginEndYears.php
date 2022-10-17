<?php

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class OneSeasonBeginEndYears extends Validator
{

    /**
     * @throws ValidationError
     */
    public function validate()
    {
        $difference = (int)$this->request->getSeasonYearEnd() - (int)$this->request->getSeasonYearBegin();
        if ($difference < 0 || $difference > 1) {
            throw new ValidationError(16);
        }
    }
}
