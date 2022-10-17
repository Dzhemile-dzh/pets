<?php

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class SeasonalStatisticsRequired extends Validator
{

    /**
     * @throws ValidationError
     */
    public function validate()
    {
        if ($this->request->getGivenParametersCount()>0) {
            $seasonYearBegin = $this->request->getSeasonYearBegin();
            $raceType = $this->request->getRaceType();
            $countryCodes = $this->request->getCountryCodes();

            if (!($seasonYearBegin && $raceType && $countryCodes)) {
                throw new ValidationError(1003);
            }
        }
    }
}
