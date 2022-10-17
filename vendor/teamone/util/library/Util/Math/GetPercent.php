<?php
namespace RP\Util\Math;

/**
 * trait GetPercent
 *
 * @package RP\Util\Math
 */

trait GetPercent
{
    /**
     * @param $total
     * @param $achieved
     *
     * @return float|null
     */
    public function getPercent($achieved, $total)
    {
        $total = (int)$total;
        $achieved = (int)$achieved;

        return ($total > 0) ? round((100 * $achieved) / $total) : null;
    }
}
