<?php

namespace Phalcon\Input\Request\Parameter\Validator;

class FloatPositive extends \Phalcon\Input\Request\Parameter\Validator
{
    const VALIDATOR_TITLE = 'float';

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return is_float($value) && $value > 0.0;
    }
}
