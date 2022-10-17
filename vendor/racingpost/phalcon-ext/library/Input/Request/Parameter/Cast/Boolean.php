<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/26/2016
 * Time: 12:26 PM
 */

namespace Phalcon\Input\Request\Parameter\Cast;

class Boolean extends \Phalcon\Input\Request\Parameter\Cast
{

    /**
     * @return mixed
     */
    protected function cast()
    {
        $value = strtoupper($this->getInitValue());
        switch ($value) {
            case 'Y':
            case 'YES':
            case 'TRUE':
            case '1':
                return true;
            case 'N':
            case 'NO':
            case 'FALSE':
            case '0':
                return false;
        }
    }
}
