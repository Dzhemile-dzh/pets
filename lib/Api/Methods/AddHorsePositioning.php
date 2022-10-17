<?php

namespace Api\Methods;

use Api\Constants\Horses as Constants;
use Models\Bo\Results\HorseRace;

trait AddHorsePositioning
{
    /**
     * Method to add the necessary horse positioning depending on the different given scenarios based on race outcome
     *
     * Scenario Example:
     * 1. When race_outcome_uid between 70-120: these are considered dead-heats so we should use race_output_order for the positions
     * 2. When race_outcome_uid between 50 - 65: these are considered non-finishers so we need to set dnf = true
     *
     * The TABLE in the DB to gather the race_outcome data is: race_outcome
     * Join on race_outcome_uid or final_race_outcome_uid (can be found in TABLE: horse_race)
     *
     * @param $horse
     * @param bool $setDefaults - we want only default values set for races that are NOT at results status
     */
    public function addHorsePositioning(&$horse, $setDefaults = false)
    {
        $position = new \StdClass();
        $position->pos_deadheat     = false;
        $position->pos_dnf          = false;
        $position->pos_dnf_status   = null;
        $position->pos_disqualified = false;
        $position->pos_disq_status  = null;
        $position->pos_original     = null;
        $position->pos_official     = null;

        if ($setDefaults) {
            $horse->position = $position;
            return;
        }

        // This covers Horses that have finished between 0-50
        if ($horse->race_outcome_uid < 51) {
            $position->pos_original = $horse->orig_race_outcome_position;
        }

        if ($horse->final_race_outcome_uid < 51) {
            $position->pos_official = $horse->final_race_outcome_position;
        }

        // This covers dead heats (values between 71 & 121)
        if ($horse->final_race_outcome_uid > 70  && $horse->final_race_outcome_uid < 121) {
            $position->pos_official = $horse->final_race_outcome_position;
            $position->pos_deadheat = true;
        }

        if ($horse->race_outcome_uid > 70  && $horse->race_outcome_uid < 121) {
            $position->pos_original = $horse->orig_race_outcome_position;
        }

        // This covers Void and Virtual unplaced
        if ($horse->race_outcome_uid == Constants::VOID_RACE_ATTRIBUTE_ID || $horse->race_outcome_uid == Constants::VIRTUAL_UNPLACED_RACE_ATTRIBUTE_ID) {
            $position->pos_dnf = true;
            $position->pos_dnf_status = Constants::VOID_STATUS;
        }

        // This covers NON-FINISHERS (did not finish)
        if ($horse->race_outcome_uid > 50 && $horse->race_outcome_uid < 65) {
            $position->pos_dnf = true;
            // Field may very in name depending on the SQL that retrieves it, to avoid breaking we do this check
            $position->pos_dnf_status = $horse->final_race_outcome_desc ?? $horse->race_outcome_desc;
        }

        // This covers Disqualified horses
        if (!empty($horse->disqualification_uid)) {
            if (!empty($horse->disqualification_uid)) {
                $position->pos_disqualified = true;
                $disqualificationInfo = (new HorseRace())->getDisqualificationData($horse->disqualification_uid);
                $position->pos_disq_status = $disqualificationInfo[0]->disqualification_desc;
            }
        }
        $horse->position = $position;
    }
}
