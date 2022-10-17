<?php

namespace Phalcon\Input\Request\Parameter\Validator;

class DateTime extends Time
{
    const VALIDATOR_TITLE = 'datetime [YYYY-MM-DD HH:MM:SS]';
    const FORMAT = 'Y-m-d H:i:s';
}
