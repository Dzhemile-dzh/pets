<?php


namespace Api\Row\Methods;

use Api\Constants\Horses as Constants;

/**
 * Trait GetGoingDescription
 *
 * Will return the right going description depending on the race status
 * (if it's finished or not)
 *
 * @param $flag - can be boolean value or race status char
 *
 * $package \Api\Row\Methods
 */
trait GetGoingDescription
{
    /**
     * @param $flag
     * @param $md_going_desc
     * @param $pmd_going_desc
     * @return
     */
    public function getGoingDescription($flag, $md_going_desc, $pmd_going_desc)
    {
        if ($flag === Constants::RACE_STATUS_RESULTS_STR || $flag === 1) {
            $result = $md_going_desc;
        } else {
            $result = $pmd_going_desc;
        }

        return $result;
    }
}
