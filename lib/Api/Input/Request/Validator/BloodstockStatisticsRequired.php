<?php

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class BloodstockStatisticsRequired extends Validator
{

    /**
     * @throws ValidationError
     */
    public function validate()
    {
        if ($this->request->getGivenParametersCount() > 0) {
            $seasonYearBegin = $this->request->getSeasonYearBegin();
            $seasonYearEnd = $this->request->getSeasonYearEnd();
            $raceType = $this->request->getRaceType();

            if (!($seasonYearBegin && $seasonYearEnd && $raceType)) {
                throw new ValidationError(1007);
            }
        }
    }
}
