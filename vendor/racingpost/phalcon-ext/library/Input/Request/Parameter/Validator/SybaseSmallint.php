<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 4/19/2017
 * Time: 2:18 PM
 */

namespace Phalcon\Input\Request\Parameter\Validator;

class SybaseSmallint extends Integer
{
    const MAX_INT = 32767;
    const MIN_INT = -32768;

    public function __construct()
    {
        parent::__construct(self::MIN_INT, self::MAX_INT);
    }
}
