<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/20/2016
 * Time: 2:13 PM
 */

namespace Api\Input\Request\Parameter\Validator;

use Phalcon\Input\Request\Parameter\Validator as ParamsValidator;

class ChampionshipFlag extends ParamsValidator
{
    const FLAG = 'championship';
    const VALIDATOR_TITLE = 'enum [championship]';

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return !($value != self::FLAG);
    }
}
