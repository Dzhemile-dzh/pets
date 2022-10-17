<?php

namespace Phalcon\Input\Request\Parameter\Validator;

class SmallInteger extends Integer
{
    const MAX_INT = 32767;
    const MIN_INT = 1;

    public function __construct()
    {
        parent::__construct(self::MIN_INT, self::MAX_INT);
    }
}
