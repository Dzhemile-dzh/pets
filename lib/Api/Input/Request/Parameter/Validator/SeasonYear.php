<?php

namespace Api\Input\Request\Parameter\Validator;

class SeasonYear extends \Phalcon\Input\Request\Parameter\Validator
{
    const VALIDATOR_TITLE = 'date';
    const MIN_YEAR = 1950;

    public function getValidatorTitle()
    {
        return self::VALIDATOR_TITLE . ' [YYYY] must be greater than ' . self::MIN_YEAR;
    }

    public function validate($value)
    {
        return is_integer($value) && $value >= self::MIN_YEAR && $value <= (date('Y') + 1);
    }
}
