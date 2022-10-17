<?php

declare(strict_types=1);

namespace Api\Tools;

/**
 * @package Api\Tools
 */
class Math
{
    /**
     * @param int|null $min
     * @param int|null $max
     *
     * @return int
     */
    public static function random(?int $min = null, ?int $max = null): int
    {
        return ($min === null && $max === null) ? mt_rand() : mt_rand($min, $max);
    }
}