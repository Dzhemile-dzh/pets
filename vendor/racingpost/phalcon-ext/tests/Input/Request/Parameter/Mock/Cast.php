<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/26/2016
 * Time: 1:52 PM
 */
namespace Tests\Input\Request\Parameter\Mock;

class Cast extends \Phalcon\Input\Request\Parameter\Cast
{
    private $cast;

    public function setCast($cast)
    {
        $this->cast = $cast;
        return $this;
    }

    /**
     * @return mixed
     */
    protected function cast()
    {
        return $this->cast;
    }
}
