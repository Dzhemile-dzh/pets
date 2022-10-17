<?php

namespace Api\Methods;

trait YardsToFurlongs
{
    /**
     * Turns yards into furlongs.
     * @param   $yards          Distance in yards
     * @return  float|null      Distance in furlongs
     */
    public function yardsToFurlongs(float $yards) : ?float
    {
        if (is_numeric($yards)) {
            $furlong = round($yards / 220, 2);
            $fractal = fmod($furlong, 1);

            if ($fractal < 0.25) {
                $fractal = 0;
            } elseif ($fractal >= 0.25 and $fractal < 0.75) {
                $fractal = 0.5;
            } else {
                $fractal = 1;
            }
            $rtn = floor($furlong) + $fractal;
            return $rtn;
        } else {
            return null;
        }
    }
}
