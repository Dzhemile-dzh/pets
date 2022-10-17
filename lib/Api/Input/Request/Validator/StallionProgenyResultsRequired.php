<?php

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class StallionProgenyResultsRequired extends Validator
{

    /**
     * @throws ValidationError
     */
    public function validate()
    {
        if ($this->request->boundOrderedParametersCount() > 0) {
            $seasonYearBegin = $this->request->getSeasonYearBegin();
            $seasonYearEnd = $this->request->getSeasonYearEnd();
            $raceType = $this->request->getRaceType();
            $countryCode = $this->request->getCountryCode();

            if (!($seasonYearBegin && $seasonYearEnd && $raceType && $countryCode)) {
                throw new ValidationError(1002);
            }
        }
    }
}
