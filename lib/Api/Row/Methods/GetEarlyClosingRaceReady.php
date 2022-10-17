<?php

namespace Api\Row\Methods;

use \Api\Constants\Horses as Constants;

/**
 * Class GetEarlyClosingRaceReady
 *
 * @package \Api\Row\Methods
 */
trait GetEarlyClosingRaceReady
{
    /**
     * $return string
     */
    public function getEarlyClosingRaceReady()
    {
        if ($this->early_closing_race_yn == 'Y') {
            if ($this->race_status_code == Constants::getConstantValue(Constants::RACE_STATUS_CALENDAR)) {
                if ($this->count_runners == $this->no_of_runners) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return true;
            }
        } else {
            return null;
        }
    }
}
