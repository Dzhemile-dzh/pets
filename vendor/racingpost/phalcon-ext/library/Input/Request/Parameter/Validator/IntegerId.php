<?php

namespace Phalcon\Input\Request\Parameter\Validator;

class IntegerId extends Integer
{
    /**
     * Shows max integer value acceptable for sybase driver
     */
    const MAX_INT = 2147483647;
    const MIN_INT = 1;

    public function __construct()
    {
        parent::__construct(self::MIN_INT, self::MAX_INT);
    }
}
