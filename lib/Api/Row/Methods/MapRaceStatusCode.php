<?php

namespace Api\Row\Methods;

use \Api\Constants\Horses as Constants;

/**
 * Class MapRaceStatusCode
 *
 * @package \Api\Row\Methods
 */
trait MapRaceStatusCode
{
    /**
     * This method is used to map the race_status_code specifically for Janus endpoints.
     *
     * @param string $raceStatusCode
     * @param int $numberOfrunners
     * @param $earlyCloser
     * @return string
     */
    public function mapRaceStatusCode(string $raceStatusCode, $numberOfrunners, $earlyCloser): string
    {
        if ($raceStatusCode == Constants::RACE_STATUS_CALENDAR_STR
            && !empty($earlyCloser)
            && strtolower($earlyCloser) == 'y'
            && $numberOfrunners > 1
        ) {
            return Constants::RACE_STATUS_WORD_EARLY_CLOSER;
        } else {
            return Constants::RACE_STATUS_MAPPING[$raceStatusCode];
        }
    }
}
