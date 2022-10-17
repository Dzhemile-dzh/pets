<?php
namespace RP\Util\Math;

/**
 * Class GetPercent
 * @package RP\Util\Math
 */

trait GetSum
{
    /**
     * @return int
     */
    public function getSum()
    {
        $sum=0;
        foreach (func_get_args() as $v) {
            $sum += (int)$v;
        }

        return $sum;
    }
}
