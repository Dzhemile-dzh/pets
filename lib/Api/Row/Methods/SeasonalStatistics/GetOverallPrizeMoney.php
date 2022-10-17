<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/28/2016
 * Time: 2:41 PM
 */

namespace Api\Row\Methods\SeasonalStatistics;

trait GetOverallPrizeMoney
{
    public function getOverallPrizeMoney($pound, $euro, $rate)
    {
        $pound = (float)$pound;
        $euro = (float)$euro;
        $rate = (float)$rate;

        if ($rate <= 0 || $euro < 0 || $pound < 0) {
            return null;
        }

        return round(($pound + $euro / $rate), 2, 1);
    }
}
