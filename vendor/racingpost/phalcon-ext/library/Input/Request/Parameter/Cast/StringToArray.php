<?php

/**
 * Created by PhpStorm.
 * User: Andriy_Zubrytskyy
 * Date: 2/28/2017
 * Time: 11:29 AM
 */

//namespace Api\Input\Request\Parameter\Cast;
namespace Phalcon\Input\Request\Parameter\Cast;

class StringToArray extends \Phalcon\Input\Request\Parameter\Cast
{
    
    protected function cast()
    {
        return (array)$this->getInitValue();
    }
}
