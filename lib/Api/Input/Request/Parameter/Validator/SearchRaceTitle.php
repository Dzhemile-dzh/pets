<?php

namespace Api\Input\Request\Parameter\Validator;

class SearchRaceTitle extends \Phalcon\Input\Request\Parameter\Validator
{
    const VALIDATOR_TITLE = 'string [value > 3]';

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return !(strlen($value) < 3);
    }
}
