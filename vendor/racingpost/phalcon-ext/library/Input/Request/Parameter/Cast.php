<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/26/2016
 * Time: 10:01 AM
 */

namespace Phalcon\Input\Request\Parameter;

/**
 * Class Cast
 *
 * @package Phalcon\Input\Request\Parameter
 */
abstract class Cast
{
    /**
     * @var string
     */
    private $initValue;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @return mixed
     */
    abstract protected function cast();

    /**
     * @param $initValue
     *
     * @return mixed
     */
    public function castValue($initValue)
    {
        $this->initValue = $initValue;
        $this->value = $this->cast();

        return $this->value;
    }

    /**
     * @return string
     */
    public function getInitValue()
    {
        return $this->initValue;
    }
}
