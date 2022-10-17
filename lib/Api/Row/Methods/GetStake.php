<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 11/4/14
 * Time: 11:44 AM
 */

namespace Api\Row\Methods;

/**
 * Class GetStake
 *
 * @package \Api\Row\Methods
 */
trait GetStake
{
    /**
     * @param $stake
     * @return float
     */
    public function getStake($stake = null)
    {
        if (is_null($stake)) {
            $stake = $this->stake;
        }
        return round($stake, 2);
    }
}
