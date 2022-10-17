<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 4/19/2017
 * Time: 2:17 PM
 */

namespace Phalcon\Input\Request\Parameter\Validator;

class SybaseInt extends Integer
{
    /*
     * On Windows Unit tests can fail with -2147483648 value  because of 32-bit builds.
     * To be sure run tests on Linux
     */
    const MAX_INT = 2147483647;
    const MIN_INT = -2147483648;

    public function __construct()
    {
        parent::__construct(self::MIN_INT, self::MAX_INT);
    }
}
