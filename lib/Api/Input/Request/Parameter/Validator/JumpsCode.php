<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 1/21/2016
 * Time: 5:52 PM
 */

namespace Api\Input\Request\Parameter\Validator;

class JumpsCode extends \Phalcon\Input\Request\Parameter\Validator
{
    private $jumpsCodes = [];
    const VALIDATOR_TITLE = 'enum';

    public function getValidatorTitle()
    {
        return self::VALIDATOR_TITLE . ' [' . implode(', ', $this->jumpsCodes) . ']';
    }

    /**
     * @param \Models\Selectors $selectors
     *
     * @throws \Exception
     */
    public function __construct(\Models\Selectors $selectors)
    {
        $this->jumpsCodes = $selectors->getJumpsTypeKeys();
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public function validate($value)
    {
        return is_string($value) && in_array(strtolower($value), $this->jumpsCodes);
    }
}
