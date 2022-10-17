<?php

namespace Api\Input\Request\Validator;

use Api\Exception\ValidationError;
use Phalcon\Input\Request\Validator;

class StatsRaceTypeDependent extends Validator
{

    /**
     * @throws ValidationError
     */
    public function validate()
    {
        if ($this->request->getRaceType() == 'flat' && $this->request->getStatisticsTypeCode() == 'race-category') {
            throw new ValidationError(14);
        }
        if ($this->request->getRaceType() == 'jumps' && $this->request->getStatisticsTypeCode() == 'age-of-horse') {
            throw new ValidationError(13);
        }
    }
}
