<?php

namespace Api\Methods;

trait NullifyEmptyValue
{
    /**
     * Method will check an input var of the data types string, int, float, boolean or array, and return a null value if
     * it is empty.
     *
     * @param mixed|null $inputValue
     *
     * @return mixed|null
     */
    public function nullifyEmptyValue($inputValue)
    {
        $applicableTypes = array('string', 'integer', 'double', 'boolean', 'array');

        if (in_array(gettype($inputValue), $applicableTypes) && empty($inputValue)) {
            return null;
        }

        return $inputValue;
    }
}
