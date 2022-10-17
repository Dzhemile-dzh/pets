<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

trait GetAdjustmentDistance
{
    /**
     * @return string | null
     */
    public function getAdjustmentDistance()
    {
        $result = null;

        if ($this->isFlatRace()) {
            if ($this->distance_yard <= 1760) {
                $result = 55;
            } elseif ($this->distance_yard > 1760 && $this->distance_yard <= 3520) {
                $result = 110;
            } else {
                $result = 165;
            }
        } elseif ($this->isJumpRace()) {
            $result = 219;
        } else {
            throw new \Exception('Wrong race type');
        }

        return $result;
    }
}
