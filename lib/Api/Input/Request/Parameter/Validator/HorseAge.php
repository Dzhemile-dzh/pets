<?php

namespace Api\Input\Request\Parameter\Validator;

class HorseAge extends \Phalcon\Input\Request\Parameter\Validator
{
    private $availableValues = [];
    const VALIDATOR_TITLE = 'horse age';

    public function getValidatorTitle()
    {
        return self::VALIDATOR_TITLE . ' [' . implode(', ', $this->availableValues) . ']';
    }

    /**
     * HorseAge constructor.
     *
     * @param array $availableValues
     */
    public function __construct(array $availableValues)
    {
        $this->availableValues = $availableValues;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        if (preg_match("/^[0-9][0-9]?\+?$/i", $value) != 1) {
            return false;
        }

        return in_array($value, $this->availableValues);
    }
}
