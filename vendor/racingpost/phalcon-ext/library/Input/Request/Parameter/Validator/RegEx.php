<?php

namespace Phalcon\Input\Request\Parameter\Validator;

class RegEx extends \Phalcon\Input\Request\Parameter\Validator
{
    private $pattern;
    const VALIDATOR_TITLE = 'regEx';

    public function getValidatorTitle()
    {
        return self::VALIDATOR_TITLE . ' with rule [' . $this->pattern .']';
    }

    /**
     * RegEx constructor.
     *
     * @param            $pattern
     */
    public function __construct($pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return is_string($value) && !empty(preg_match($this->pattern, $value));
    }
}
