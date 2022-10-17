<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/17/2015
 * Time: 4:05 PM
 */
namespace Phalcon\Input\Request;

abstract class Validator
{
    /**
     * @var \Phalcon\Input\Request
     */
    protected $request;

    /**
     * @param \Phalcon\Input\Request $request
     */
    public function setRequest(\Phalcon\Input\Request $request)
    {
        $this->request = $request;
    }

    /**
     * @throws \Exception
     */
    abstract public function validate();
}
