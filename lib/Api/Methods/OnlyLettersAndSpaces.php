<?php

namespace Api\Methods;

trait OnlyLettersAndSpaces
{
    /**
     * @param $value
     *
     * @return mixed
     */
    public function onlyLettersAndSpaces($value)
    {
        return $value ? preg_replace('/[^A-Za-z\s]/', '', $value) : null;
    }
}
