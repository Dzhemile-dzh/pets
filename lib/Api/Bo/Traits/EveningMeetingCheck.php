<?php

namespace Api\Bo\Traits;

use Api\Constants\Horses as Constants;

trait EveningMeetingCheck
{
    /**
     * An evening meeting is defined by having its first race after 16:00 (UK time).
     *
     * @param string $raceDateTime
     * @return boolean
     * @throws \Exception
     */
    private function isEveningMeeting(string $raceDateTime)
    {
        $result = false;

        if ((new \DateTime($raceDateTime))->format('Y-m-d H:i:s') >=
            (new \DateTime($raceDateTime))->format('Y-m-d') . ' ' . Constants::EVENING_TIME
        ) {
            $result = true;
        }

        return $result;
    }

    /**
     * Return a value of 1 when a race datetime indicates an evening meeting, else return -1
     *
     * @param string $raceDateTime
     * @return int
     * @throws \Exception
     */
    private function getEveningMeetingFlag(string $raceDateTime)
    {
        return ($this->isEveningMeeting($raceDateTime) ? 1 : -1);
    }
}
