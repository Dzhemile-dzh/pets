<?php

namespace Api\Row\Methods;

use \Api\Constants\Horses as Constants;

/**
 * Trait GetEachWayTerms
 * @package Api\Methods
 */
trait GetEachWayTerms
{
    /**
     * Method returns the appropriate each-way terms for the given number of runners and the race category.
     * Each-way terms are only relevant when race status is Overnight or Result. Otherwise return a null value.
     * For Overnight and Results the rules are:
     * if numberOfRunners <= 4 then eachWayTerms = Win Only
     * if numberOfRunners between 5 and 7 then eachWayTerms = 1-2
     * if numberOfRunners between 8 and 15 then eachWayTerms = 1-3
     * if numberOfRunners > 15 then eachWayTerms = 1-4 for handicap races, 1-3 for non-handicap races.
     *
     * @param string $raceStatus
     * @param int $numberOfRunners
     * @param string $raceGroupCode
     *
     * @return string|null
     */
    public function getEachWayTerms(string $raceStatus, int $numberOfRunners, ?string $raceGroupCode): ?string
    {
        if (($raceStatus == Constants::RACE_STATUS_OVERNIGHT_STR
                || $raceStatus == Constants::RACE_STATUS_RESULTS_STR)
            && $numberOfRunners > 0
        ) {
            if ($numberOfRunners <= 4) {
                $eachWayTerms = 'Win Only';
            } elseif ($numberOfRunners <= 7) {
                $eachWayTerms = '1-2';
            } elseif ($numberOfRunners <= 15) {
                $eachWayTerms = '1-3';
            } else { // > 15
                // if $raceGroupCode = H (for handicap races) return 1-4, otherwise 1-3 for all other categories
                if (!empty($raceGroupCode) && $raceGroupCode == 'H') {
                    $eachWayTerms = '1-4';
                } else {
                    $eachWayTerms = '1-3';
                }
            }
        } else {
            // All other race status values
            $eachWayTerms = null;
        }

        return $eachWayTerms;
    }
}
