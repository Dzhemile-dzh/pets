<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/28/2016
 * Time: 4:02 PM
 */

namespace Phalcon\Input\Request\Parameter\Calculate;

abstract class ByDefault
{
    private $request;

    abstract public function getValue();

    public static function init($value, \Phalcon\Input\Request\Parameter $parameter)
    {
        if (!($value instanceof self)) {
            $value = new Mock($value);
        }
        $value->setRequest($parameter->getCurrentObserver());

        return $value;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request)
    {
        $this->request = $request;
    }
}
