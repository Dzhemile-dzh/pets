<?php

namespace Api\Methods;

use Api\Constants\Horses as Constants;

trait TenToFollowHorse
{
    /**
     * Will return true or false if the horse is ten_to_follow depending on the race type
     * @param $tenToFollowHorse
     * @param $reasoning
     * @param $raceTypeCode
     * @return bool
     */
    public function isTenToFollowHorse($tenToFollowHorse, $reasoning, $raceTypeCode)
    {
        $result = false;

        if (!is_null($tenToFollowHorse)) {
            if ($reasoning === Constants::JUMPS_REASONING &&
                in_array($raceTypeCode, Constants::RACE_TYPE_JUMPS_ARRAY)
            ) {
                $result = true;
            } else if ($reasoning === Constants::FLAT_REASONING &&
                in_array($raceTypeCode, Constants::RACE_TYPE_FLAT_ARRAY)
            ) {
                $result = true;
            }
        }


        return $result;
    }
}
