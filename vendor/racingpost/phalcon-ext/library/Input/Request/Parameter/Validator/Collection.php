<?php

namespace Phalcon\Input\Request\Parameter\Validator;

class Collection extends \Phalcon\Input\Request\Parameter\Validator
{
    private $validators = [];

    public function getValidatorTitle()
    {
        $titles = [];
        foreach ($this->validators as $validator) {
            $titles[] = $validator->getValidatorTitle();
        }
        return implode(',', array_filter($titles));
    }

    /**
     *
     * @param array $validators
     */
    public function __construct(array $validators)
    {
        $this->validators = $validators;
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        foreach ($this->validators as $validator) {
            if (!$validator->validate($value))
                return false;
        }
        return true;
    }
}
