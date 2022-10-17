<?php
declare(strict_types=1);

namespace Api\Output\Mapper\Methods;

trait CheckIfNotNullAndGreaterOrEqualToZero
{
    /**
     * @param mixed $value
     * @return bool
     */
    private function checkIfNotNullAndGreaterOrEqualToZero($value) : bool
    {
        return !is_null($value) && floatval($value) >= 0;
    }
}
