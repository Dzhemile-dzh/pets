<?php

namespace Phalcon\Input\Request\Parameter;

abstract class Validator
{
    const VALIDATOR_TITLE = 'Validator title is not specified';

    /**
     * @param $value
     *
     * @return mixed
     */
    abstract public function validate($value);

    /**
     * @return mixed
     */
    public function getValidatorTitle()
    {
        return static::VALIDATOR_TITLE;
    }
}
