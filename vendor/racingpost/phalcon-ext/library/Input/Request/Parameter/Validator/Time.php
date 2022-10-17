<?php

namespace Phalcon\Input\Request\Parameter\Validator;

class Time extends \Phalcon\Input\Request\Parameter\Validator
{
    const VALIDATOR_TITLE = 'time [HH:MM:SS]';
    const FORMAT = 'H:i:s';

    public function validate($value)
    {
        $dateInfo = date_parse_from_format(static::FORMAT, $value);
        return (is_array($dateInfo)
            && $dateInfo['error_count'] === 0
            && $dateInfo['warning_count'] === 0);
    }
}
