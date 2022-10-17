<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 2/16/2016
 * Time: 1:43 PM
 */
namespace Api\Input\Request\Parameter\Validator;

class RaceStatusType extends \Phalcon\Input\Request\Parameter\Validator
{
    const VALIDATOR_TITLE = 'enum';
    private $values = ['big-race', 'all-races'];

    public function getValidatorTitle()
    {
        return self::VALIDATOR_TITLE . ' [' . implode(', ', $this->values) . ']';
    }

    /**
     * @param $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return is_string($value) && in_array($value, $this->values, true);
    }
}
