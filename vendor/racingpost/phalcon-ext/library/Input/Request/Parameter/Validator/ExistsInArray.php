<?php

namespace Phalcon\Input\Request\Parameter\Validator;

class ExistsInArray extends \Phalcon\Input\Request\Parameter\Validator
{
    private $availableValues = [];
    const VALIDATOR_TITLE = 'enum';

    public function getValidatorTitle()
    {
        return self::VALIDATOR_TITLE . ' [' . implode(', ', array_map('urlencode', $this->availableValues)).']';
    }

    /**
     * ExistsInArray constructor.
     *
     * @param array      $availableValues
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
        return in_array($value, $this->availableValues);
    }
}
