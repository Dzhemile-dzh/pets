<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/26/2016
 * Time: 11:06 AM
 */

namespace Phalcon\Input\Request\Parameter\Cast;

class HorseAge extends \Phalcon\Input\Request\Parameter\Cast
{
    /**
     * @return mixed
     */
    protected function cast()
    {
        $cast = null;

        if (preg_match("/^([0-9][0-9]?)(yo)?(\+?)$/i", $this->getInitValue(), $match) == 1
            && !empty($match)
            && !is_null($match[1])
        ) {
            $cast = $match[1] . (!is_null($match[3]) ? $match[3] : '');
        }
        return $cast;
    }
}
