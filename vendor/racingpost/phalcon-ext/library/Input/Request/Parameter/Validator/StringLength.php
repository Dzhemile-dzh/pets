<?php

namespace Phalcon\Input\Request\Parameter\Validator;

class StringLength extends \Phalcon\Input\Request\Parameter\Validator
{
    private $minLength;
    private $maxLength;

    const VALIDATOR_TITLE = 'string';

    public function getValidatorTitle()
    {
        $range =  array_filter([$this->minLength, $this->maxLength]);
        $rangeStr = implode('-', $range);
        return self::VALIDATOR_TITLE . " with length range [{$rangeStr}]";
    }

    public function __construct($minLength = null, $maxLength = null)
    {
        $this->minLength = $minLength;
        $this->maxLength = $maxLength;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        $valid = is_string($value);
        if ($valid) {
            $stringLength = strlen($value);
            if (!is_null($this->minLength) && !is_null($this->maxLength)) {
                $valid = ($stringLength >= $this->minLength && $stringLength <= $this->maxLength);
            } elseif (!is_null($this->minLength)) {
                $valid = $stringLength >= $this->minLength;
            } elseif (!is_null($this->maxLength)) {
                $valid = $stringLength <= $this->maxLength;
            }
        }
        return $valid;
    }
}
