<?php
/**
 * Created by PhpStorm.
 * User: Igor_Vorobyov
 * Date: 11/17/2015
 * Time: 6:02 PM
 */

namespace Api\Output\Mapper\RaceCards\Rpr;

class RprMapper extends \Api\Output\Mapper\HorsesMapper
{
    use \Api\Methods\RemoveDotFromAwCourse;
    /**
     * @return integer || null
     */
    protected function getAdjustedRpPostmark($adjustment, $rp_postmark)
    {
        $result = !empty($rp_postmark) ? $rp_postmark + $adjustment : $rp_postmark;
        return $result != 0 ? $result : null;
    }

    /**
     * @return array
     */
    protected function getMap()
    {
        return [];
    }
}
