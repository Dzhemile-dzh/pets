<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 11/2/2016
 * Time: 12:14 PM
 */

namespace Tests\Input\Request\Parameter\Mock;

class Validator extends \Phalcon\Input\Request\Parameter\Validator
{
    private $validatorTitle;
    private $validate;

    /**
     * @return mixed
     */
    public function getValidatorTitle()
    {
        return $this->validatorTitle;
    }

    /**
     * @param $validatorTitle
     *
     * @return $this
     */
    public function setValidatorTitle($validatorTitle)
    {
        $this->validatorTitle = $validatorTitle;

        return $this;
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    public function validate($value)
    {
        return $this->validate;
    }

    /**
     * @param $validate
     *
     * @return $this
     */
    public function setValidate($validate)
    {
        $this->validate = $validate;

        return $this;
    }
}
