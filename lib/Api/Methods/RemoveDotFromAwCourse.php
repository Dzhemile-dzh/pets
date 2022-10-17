<?php

namespace Api\Methods;

trait RemoveDotFromAwCourse
{
    /**
     * @param $value
     *
     * @return mixed
     */
    public function removeDotFromAwCourse($value)
    {
        return preg_replace('/\(\s?[aA]\.[wW]\s?\)/', '(AW)', $value);
    }
}
