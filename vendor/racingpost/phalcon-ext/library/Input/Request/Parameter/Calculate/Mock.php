<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/28/2016
 * Time: 4:56 PM
 */

namespace Phalcon\Input\Request\Parameter\Calculate;

use Phalcon\Input\Request\Parameter\Calculate\ByDefault;

class Mock extends ByDefault
{
    private $value;

    /**
     * Mock constructor.
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}
