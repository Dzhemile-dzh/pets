<?php

namespace Api\Input\Request\Parameter\Validator;

class SearchCourseId extends \Phalcon\Input\Request\Parameter\Validator\SmallInteger
{
    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        if (is_array($value)) {
            foreach ($value as $val) {
                if (!parent::validate($val)) {
                    return false;
                }

                return true;
            }
        } else {
            return parent::validate($value);
        }
    }
}
