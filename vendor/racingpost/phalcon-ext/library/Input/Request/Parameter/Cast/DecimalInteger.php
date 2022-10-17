<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/26/2016
 * Time: 11:06 AM
 */
namespace Phalcon\Input\Request\Parameter\Cast;

class DecimalInteger extends \Phalcon\Input\Request\Parameter\Cast
{
    /**
     * @return mixed
     */
    protected function cast()
    {
        $cast = null;
        $initValue = $this->getInitValue();
        if ($initValue === 'INF') {
            $cast = INF;
        } elseif ($initValue === '-INF') {
            $cast = -INF;
        } elseif ((string)(int)$initValue === $initValue) {
            $cast = (int)$initValue;
        }
        return $cast;
    }
}
