<?php

namespace Api\Row\Methods;

/**
 * Trait GetDistanceInFurlong
 *
 * @package Api\Row\Methods
 */
trait GetDistanceInFurlong
{
    /**
     * Will convert the yards to furlongs and will print the halfs in decimal number (.5) + "f" suffix
     * if the second argument is true.
     *
     * @param  $yards number
     * @return string
     */
    public function printDistanceInDecimal($yards, $addF = false)
    {
        if (is_numeric($yards)) {
            $suffix = $addF ? 'f' : '';
            return $this->getDistanceInFurlong($yards) . $suffix;
        } else {
            return null;
        }
    }

    /**
     * Will convert the yards to furlongs and will print the halfs as a formula (½) + "f" suffix
     * if the second argument is true
     *
     * @param $yards
     * @param bool $addF
     * @return mixed|null
     */
    public function printDistanceAsFormula($yards, $addF = false)
    {
        if (is_numeric($yards)) {
            $suffix = $addF ? 'f' : '';
            return str_replace('.5', '½', $this->getDistanceInFurlong($yards) . $suffix);
        } else {
            return null;
        }
    }

    /**
     * Converts distance from yards to furlong.
     *
     * @param null $yards
     * @return float|int|null
     */
    public function getDistanceInFurlong($yards = null)
    {
        if (!$yards) {
            $yards = isset($this->distance_yard) ? $this->distance_yard : null;
        }
        if (isset($yards) and $yards) {
            $furlong = round($yards / 220, 2);
            $fractal = fmod($furlong, 1);

            if ($fractal < 0.25) {
                $fractal = 0;
            } elseif ($fractal >= 0.25 and $fractal < 0.75) {
                $fractal = 0.5;
            } else {
                $fractal = 1;
            }
            return floor($furlong) + $fractal;
        } else {
            return null;
        }
    }
}
