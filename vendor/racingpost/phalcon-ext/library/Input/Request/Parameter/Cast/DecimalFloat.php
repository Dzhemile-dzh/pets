<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/26/2016
 * Time: 11:14 AM
 */

namespace Phalcon\Input\Request\Parameter\Cast;

class DecimalFloat extends \Phalcon\Input\Request\Parameter\Cast
{
    /**
     * @return mixed
     */
    protected function cast()
    {
        if (preg_match('/^[-+]?([1-9]\d*|0)(\.\d+)?(E[-+]\d+)?$/i', $this->getInitValue())) {
            return (float)$this->getInitValue();
        }
    }
}
