<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/26/2016
 * Time: 11:21 AM
 */

namespace Phalcon\Input\Request\Parameter\Cast;

class Text extends \Phalcon\Input\Request\Parameter\Cast
{

    /**
     * @return mixed
     */
    protected function cast()
    {
        return $this->getInitValue();
    }
}
