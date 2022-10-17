<?php

namespace Api\Input\Request\Parameter\Validator;

class CountryCode extends \Phalcon\Input\Request\Parameter\Validator
{
    private $countryCodes = ['GB', 'IRE', 'FR', 'USA'];
    const VALIDATOR_TITLE = 'enum';

    public function getValidatorTitle()
    {
        return self::VALIDATOR_TITLE . ' [' . implode(', ', $this->countryCodes) . ']';
    }

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
        }

        return in_array(strtoupper($value), $this->countryCodes);
    }
}
