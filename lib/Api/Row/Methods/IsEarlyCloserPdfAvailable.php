<?php

namespace Api\Row\Methods;

use \Api\Constants\Horses as Constants;

/**
 * Trait IsEarlyCloserPdfAvailable
 *
 * @package \Api\Row\Methods
 */
trait IsEarlyCloserPdfAvailable
{
    /**
     * @param array $races
     *
     * @return bool
     */
    public function isEarlyCloserPdfAvailable($races)
    {
        foreach ($races as $race) {
            if ($this->isEarlyCloserPdfAvailableByRace(
                $race->early_closing_race_yn,
                $race->race_status_code,
                $race->no_of_runners
            )) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param string $earlyClosingRaceYn
     * @param string $raceStatusCode
     * @param int    $noOfRunners
     *
     * @return bool
     */
    public function isEarlyCloserPdfAvailableByRace($earlyClosingRaceYn, $raceStatusCode, $noOfRunners)
    {
        return (
            $earlyClosingRaceYn === 'Y'
            && $raceStatusCode === Constants::getConstantValue(Constants::RACE_STATUS_CALENDAR)
            && $noOfRunners > 1
        );
    }
}
