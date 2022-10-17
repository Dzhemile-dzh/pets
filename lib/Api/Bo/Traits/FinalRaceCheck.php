<?php

namespace Api\Bo\Traits;

use \Api\Constants\Horses as Constants;

/**
 * Trait FinalRaceCheck
 *
 * @package Api\Bo\Traits
 */
trait FinalRaceCheck
{
    /**
     * @param $race
     *
     * @return bool
     * @throws \Exception
     */
    private function isFinalRace($race)
    {
        return $this->checkIsFinalRaceByFields($race->race_datetime, $race->race_status_code);
    }

    /**
     * Based on date and race status function check if the race is final or not
     *
     * @param $raceDatetime
     * @param $raceStatus
     * @return bool
     * @throws \Exception
     */
    private function checkIsFinalRaceByFields($raceDatetime, $raceStatus)
    {
        $result = false;

        $dayDiff = (int)(new \DateTime('Today'))->diff((new \DateTime(date('Y-m-d', strtotime($raceDatetime)))))
            ->format('%r%a');
        list($curMonth, $curDay, $curHour) = array_map('intval', explode('-', date('n-j-G')));

        if ($raceStatus == Constants::getConstantValue(Constants::RACE_STATUS_OVERNIGHT)) {
            if ($dayDiff == 1 && $curHour >= 18) {
                // race tomorrow and more than 6pm now
                $result = true;
            } elseif ($curMonth == 12 && (($curDay == 23 && $curHour >= 18) || $curDay == 24 || $curDay == 25)) {
                // 23rd Dec and after 6pm, or 24th, 25th Dec
                $result = true;
            } elseif ($dayDiff == 0) {
                // race today
                $result = true;
            }
        } elseif ($raceStatus == Constants::getConstantValue(Constants::RACE_STATUS_RESULTS)) {
            $result = true;
        }

        return $result;
    }
}
