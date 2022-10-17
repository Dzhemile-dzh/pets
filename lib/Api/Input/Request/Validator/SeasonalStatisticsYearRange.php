<?php

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class SeasonalStatisticsYearRange extends Validator
{

    /**
     * @throws ValidationError
     */
    public function validate()
    {
        if (((int)$this->request->getSeasonYearEnd() - (int)$this->request->getSeasonYearBegin())>1) {
            throw new ValidationError(1004);
        }
    }
}
