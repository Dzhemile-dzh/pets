<?php

namespace Api\Methods;

trait GetIntFromYNFlag
{
    /**
     * @param $value
     *
     * @return int
     */
    public function dbYNFlagToInt($value)
    {
        if (in_array(trim((string)$value), ['y', 'n', 'Y', 'N', ''], true)) {
            $value = ($value === 'Y' || $value === 'y');
        }

        return intval($value);
    }
}
