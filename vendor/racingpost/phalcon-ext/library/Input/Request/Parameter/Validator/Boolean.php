<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 11/3/2016
 * Time: 3:26 PM
 */

namespace Phalcon\Input\Request\Parameter\Validator;

class Boolean extends \Phalcon\Input\Request\Parameter\Validator
{
    const VALIDATOR_TITLE = 'boolean';
    /**
     * @param $value
     *
     * @return mixed
     */
    public function validate($value)
    {
        return is_bool($value);
    }
}
