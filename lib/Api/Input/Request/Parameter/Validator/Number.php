<?php

namespace Api\Input\Request\Parameter\Validator;

class Number extends \Phalcon\Input\Request\Parameter\Validator
{
    const VALIDATOR_TITLE = 'number';

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return !((ctype_digit((string)$value) && ((int)$value <= 0 || strval($value)[0] == '0'))
            || (!ctype_digit((string)$value) && !is_infinite($value))
        );
    }
}
