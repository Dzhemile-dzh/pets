<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 11/17/2015
 * Time: 6:02 PM
 */

namespace Api\Output\Mapper\RaceCards\Topspeed;

class TopspeedMapper extends \Api\Output\Mapper\HorsesMapper
{
    /**
     * @return integer || null
     */
    protected function getAdjustedRpTopspeed($adjustment, $rp_topspeed)
    {
        return !is_null($rp_topspeed) && $rp_topspeed > 0 ? $rp_topspeed + $adjustment : null;
    }

    /**
     * @return array
     */
    protected function getMap()
    {
        return [];
    }
}
