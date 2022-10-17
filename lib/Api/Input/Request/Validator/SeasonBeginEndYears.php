<?php

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class SeasonBeginEndYears extends Validator
{

    /**
     * @throws ValidationError
     */
    public function validate()
    {
        if ((int)$this->request->getSeasonYearEnd() < (int)$this->request->getSeasonYearBegin()) {
            throw new ValidationError(12);
        }
    }
}
