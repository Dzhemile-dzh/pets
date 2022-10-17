<?php

namespace Api\Input\Request\Parameter\Validator;

use Api\Exception\ValidationError;

class Hex extends \Phalcon\Input\Request\Parameter\Validator
{
    const VALIDATOR_TITLE = 'hex [0x00000000000142e2]';

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return !(!is_string($value)
            || substr($value, 0, 2) != '0x'
            || !ctype_xdigit(substr($value, 2))
        );
    }
}
