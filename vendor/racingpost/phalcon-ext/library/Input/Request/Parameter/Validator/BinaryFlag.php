<?php

namespace Phalcon\Input\Request\Parameter\Validator;

class BinaryFlag extends \Phalcon\Input\Request\Parameter\Validator
{
    const VALIDATOR_TITLE = 'binary [0,1]';

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return in_array($value, [1, 0, '1', '0'], true);
    }
}
