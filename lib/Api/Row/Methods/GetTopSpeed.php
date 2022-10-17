<?php

namespace Api\Row\Methods;

/**
 * Class GetTopSpeed
 *
 * @package \Api\Row\Methods
 */
trait GetTopSpeed
{
    /**
     * @return int | null
     */
    public function getTopSpeed()
    {
        $ret = null;
        if (isset($this->rp_topspeed) && (int)$this->rp_topspeed > 0) {
            $ret = (int)$this->rp_topspeed;
        }
        return $ret;
    }
}
