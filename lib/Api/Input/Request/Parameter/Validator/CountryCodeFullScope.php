<?php

namespace Api\Input\Request\Parameter\Validator;

class CountryCodeFullScope extends \Phalcon\Input\Request\Parameter\Validator
{
    const VALIDATOR_TITLE = 'string';

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        if (is_array($value)) {
            foreach ($value as $val) {
                if (!$this->validate($val)) {
                    return false;
                }
            }
            return true;
        } else {
            return !empty(preg_match("/^[A-Z]{2,3}$/", $value));
        }
    }
}
