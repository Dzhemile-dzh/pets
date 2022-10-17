<?php

namespace Phalcon\Input\Request\Parameter\Validator;

class Integer extends \Phalcon\Input\Request\Parameter\Validator
{
    private $min;
    private $max;

    const VALIDATOR_TITLE = 'integer';

    public function getValidatorTitle()
    {
        return self::VALIDATOR_TITLE . " with value range [{$this->min}-{$this->max}]";
    }

    public function __construct($min = null, $max = null)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        $valid = is_int($value);
        if ($valid) {
            if (!is_null($this->min) && !is_null($this->max)) {
                $valid = ($value >= $this->min && $value <= $this->max);
            } elseif (!is_null($this->min)) {
                $valid = $value >= $this->min;
            } elseif (!is_null($this->max)) {
                $valid = $value <= $this->max;
            }
        }
        return $valid;
    }
}
