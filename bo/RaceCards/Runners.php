<?php

namespace Bo\RaceCards;

use Api\Exception\ValidationError;
use Api\Constants\Horses as Constants;
use Phalcon\Mvc\Model\Resultset\ResultsetException;

/**
 * Class Runners
 *
 * @package Bo\RaceCards
 */
class Runners extends \Bo\RaceCards
{
    use \Api\Bo\Traits\CompareEntities;
    use \Api\Bo\Traits\FirstSeasonSire;
    use \Api\Bo\Traits\OwnerGroups;

    /**
     * Get runners
     *
     * @param $request
     * @param bool $getAdditionalData - used to get additional horse data like spotlight, colours, sex, tips etc.
     * @param $raceStatusCode - Sometimes we already have the race status code so no need to check the DB again
     * @param bool $returnP2P - Whether to include P2P races to the response
     *
     * @return array
     *
     * @throws ValidationError
     * @throws \Exception
     */
    public function getRunners($request, bool $getAdditionalData = false, $raceStatusCode = null, $returnP2P = true)
    {
        $model = $this->getModelRunners();
        $raceAbandoned = null;

        if (empty($raceStatusCode)) {
            $raceAbandoned = $model->checkRaceAbandoned($this->request->getRaceId());
        }

        if ($raceStatusCode && $raceStatusCode == Constants::RACE_STATUS_ABANDONED_STR) {
            $raceAbandoned = true;
        }

        if ($raceAbandoned) {
            throw new ValidationError(7115);
        }

        $raceInstance = $model->getRaceInstance($this->request->getRaceId());

        if (!$raceInstance) {
            return [];
        }

        return $this->getRunnersInfo(
            [$this->request->getRaceId()],
            $request,
            $getAdditionalData,
            true,
            $returnP2P
        );
    }

    /**
     * @return array
     */
    public function getRunnerIds(): array
    {
        $model = $this->getModelRunners();
        $runners = $model->getRaceRunners($this->request->getRaceId());

        return $runners;
    }

    /**
     * @param $raceIds
     * @param $request
     * @param bool $getAdditionalData - used to get additional horse data like spotlight, colours, sex, tips etc.
     * @param bool $includeFinishedRaces
     * @param bool $returnP2P - Whether to include P2P races to the response
     *
     * @return array
     * @throws ResultsetException
     */
    public function getRunnersInfo(
        array $raceIds,
        $request,
        bool $getAdditionalData,
        bool $includeFinishedRaces = true,
        $returnP2P = true
    ) {
    
        $model = $this->getModelRunners();

        $trainerBo = $this->getBoTrainerProfile($request);

        $runners = $model->getRunners($raceIds, $this->getModelSelectors(), $getAdditionalData, $includeFinishedRaces);

        if (empty($runners)) {
            return [];
        }

        $horseIds = array_keys($runners);

        $trainerIds = array_map(
            function ($runner) {
                return $runner->trainer_uid;
            },
            $runners
        );

        $trainerRunningForm = $trainerBo->getRunningToForm($trainerIds);
        $this->addBeatenFavourite($runners);

        $horseForms = $this->getModelRunners()->getHorseFormsPerRaces(
            $horseIds,
            $raceIds
        );

        $this->addCourseDistanceForRaces($runners, $horseForms);

        $handicaps = $this->getLongHandicapByRaces($raceIds);

        $geldingFirstTimeRunners = $model->getGeldingFirstTimeRunners($raceIds);
        $trainers = $model->getPreviousTrainers($horseIds);
        $handicapsPerRace = [];
        foreach ($runners as $runner) {
            $runner->official_rating_today = $runner->official_rating + $runner->extra_weight_lbs;

            if ($runner->race_status_code === Constants::getConstantValue(Constants::RACE_STATUS_OVERNIGHT)
                && !isset($handicapsPerRace[$runner->race_instance_uid])
            ) {
                $currentHandicap = $handicaps[$runner->race_instance_uid]['handicap'] ?? [];
                $handicapsPerRace[$runner->race_instance_uid] = $this->getLongHandicapByRace($runner->race_instance_uid, $currentHandicap);
            }

            $handicap = $handicapsPerRace[$runner->race_instance_uid] ?? [];

            if (isset($handicap[$runner->horse_uid])) {
                $runner->lh_weight_carried_lbs = $handicap[$runner->horse_uid]->lh_weight_carried_lbs;
                $runner->out_of_handicap = $runner->weight_carried_lbs - $runner->lh_weight_carried_lbs;
                $runner->official_rating_today += $runner->out_of_handicap;
            }

            $runner->gelding_first_time = ($runner->date_gelded !== null
                && array_key_exists($runner->horse_uid, $geldingFirstTimeRunners));

            $runner->trainer_rtf = $trainerRunningForm[$runner->trainer_uid] ?? null;

            $runner->jockey_last_14_days = $this->getJockeyLast14DaysStats($runner);

            if (isset($trainers[$runner->horse_uid])
                && ($runner->trainer_uid == $trainers[$runner->horse_uid]->trainer_uid
                || $this->isSameEntity($trainers[$runner->horse_uid], $runner, 'trainer'))
            ) {
                $runner->new_trainer_races_count = null;
            }

            $runner->future_rating_difference = null;

            if (trim($runner->course_country_code) !== trim($runner->trainer_country_code)) {
                $runner->future_rating_difference = 0;
            } // we add this check, isset() inside the elseIf, in case the official ratings are unavailable for some reason.
            elseif (trim($runner->race_group_code) == Constants::RACE_GROUP_CODE_HANDICAP_STR
                && isset($runner->official_rating, $runner->official_rating_today)
            ) {
                // we have to restrict the results for future_rating_difference
                // to be calculated only for GB and IRE.
                if (in_array(trim($runner->course_country_code), [Constants::COUNTRY_GB, Constants::COUNTRY_IRE])) {
                    $runner->future_rating_difference = $runner->current_official_rating - $runner->official_rating_today;
                }
            }
        }
        reset($runners);

        $this->addCalculatedFigures($runners, 6, $returnP2P);
        $this->addDaysSinceLastRun($runners);
        $this->addTipsOrSelections($raceIds, $runners, $getAdditionalData);
        $this->addRatings($runners, $raceIds, true);
        $this->addImproverFlag($runners, $raceIds);
        $this->addGoingPerformance($runners);
        $this->addOwnerGroups($runners, $raceIds);
        $this->addFirstSeasonSire($runners);

        return $runners;
    }



    /**
     * @param $runners
     *
     * @throws \Exception
     */
    public function addDaysSinceLastRun(&$runners)
    {
        if (empty($runners)) {
            return;
        }

        $tmpRunner = array_values($runners)[0];

        $raceDate = new \DateTime($tmpRunner->race_datetime);

        $daysSinceLastRun = $this->getModelRunners()->getDaysSinceLastRun(
            array_keys($runners),
            $raceDate->format('Y-m-d')
        );

        foreach ($runners as $horseId => $runner) {
            if (strpos(Constants::RACE_TYPE_FLAT, $runner->race_type_code) !== false) {
                $currentRaceType = Constants::RACE_TYPE_FLAT_ALIAS;
            } elseif (strpos(Constants::RACE_TYPE_P2P, $runner->race_type_code) !== false) {
                $currentRaceType = Constants::RACE_TYPE_P2P_ALIAS;
            } else {
                $currentRaceType = Constants::RACE_TYPE_JUMPS_ALIAS;
            }

            $runner->days_since_last_run = null;
            $runner->days_since_last_run_flat = null;
            $runner->days_since_last_run_jumps = null;
            $runner->days_since_last_run_ptp = null;

            if (isset($runner->figures_calculated)
                || in_array($runner->race_group_uid, Constants::$groupClassRaces)
                || in_array(trim($runner->course_country_code), ['HK', 'GB', 'IRE'])
            ) {
                $minDaysDiff = PHP_INT_MAX;
                $minDaysObj = null;
                $curTypeDaysObj = null;

                if (!isset($daysSinceLastRun[$horseId])) {
                    continue;
                }
                foreach ($daysSinceLastRun[$horseId] as $daysValue) {
                    if ($daysValue->days_since_run < $minDaysDiff) {
                        $minDaysDiff = $daysValue->days_since_run;
                        $minDaysObj = $daysValue;
                    }
                    if ($daysValue->race_type_code == $currentRaceType) {
                        $curTypeDaysObj = $daysValue;
                    }
                }
                if (is_null($minDaysObj)) {
                    continue;
                }
                if ($minDaysObj->race_type_code == $currentRaceType
                    || (!is_null($curTypeDaysObj)
                    && $minDaysObj->days_since_run == $curTypeDaysObj->days_since_run)
                ) {
                    $runner->days_since_last_run = $minDaysObj->days_since_run;
                } else {
                    if (!is_null($curTypeDaysObj)) {
                        $runner->days_since_last_run = $curTypeDaysObj->days_since_run;
                    }
                    $runner->{'days_since_last_run_' . $minDaysObj->race_type_code} = $minDaysObj->days_since_run;
                }
            }
        }
    }

    /**
     * Adds selections or tips data to runners depending on boolean field $getTips.
     *
     * @param $raceIds
     * @param array   $runners
     * @param bool    $getTips
     */
    protected function addTipsOrSelections($raceIds, array &$runners, $getTips)
    {
        if (empty($runners)) {
            return;
        }
        $model = $this->getModelRunners();

        if ($getTips) {
            $tips = $model->getTipsterData($raceIds);
            $this->incrementTipsAndSelectionCount($runners, $tips, 'tips');

            $premiumTips = $model->getPremiumTipsterData($raceIds);
            $this->incrementTipsAndSelectionCount($runners, $premiumTips, 'premium_tips');
        } else {
            $selections = $model->getSelectionsCount($raceIds);
            foreach ($selections as $horseId => $selectionsInfo) {
                if (isset($runners[$horseId])) {
                    $runners[$horseId]->selection_cnt = $selectionsInfo->selection_count;
                }
            }
        }
    }

    /**
     * Adds to the selection count and updates the tips data for the given runners depending on the supplied $fieldName
     *
     * @param array  $runners
     * @param array  $tips
     * @param string $fieldName
     */
    protected function incrementTipsAndSelectionCount(array &$runners, array $tips, string $fieldName)
    {
        if (!empty($fieldName)) {
            foreach ($tips as $item) {
                if (isset($runners[$item->horse_uid])) {
                    if ($fieldName == 'tips') {
                        $runners[$item->horse_uid]->selection_cnt++;
                    }
                        $runners[$item->horse_uid]->{$fieldName}[] = $item;

                }
            }
        }
    }

    /**
     * Count all wins from the same distance or course for each of the provided races and
     * add that information to runners list
     *
     * @param array $runners
     * @param array $horseForms
     */
    public function addCourseDistanceForRaces(array &$runners, array $horseForms)
    {
        foreach ($horseForms as $horseUid => $races) {
            $baseRace = $runners[$horseUid];
            foreach ($races as $race) {
                $courseDistanceWinnerFound = false;
                if ($this->getCourseWinner($baseRace, $race)) {
                    if ($this->getCourseDistanceWinner($baseRace, $race)) {
                        $runners[$horseUid]->course_and_distance_wins += 1;
                        $courseDistanceWinnerFound = true;
                    } else {
                        $runners[$horseUid]->course_wins += 1;
                    }
                }

                if (!$courseDistanceWinnerFound && $this->getDistanceWinner($baseRace, $race)) {
                    $runners[$horseUid]->distance_wins += 1;
                }
            }
        }
    }

    /**
     * @param array $runners
     */
    public function addCourseDistance(array &$runners)
    {
        if (empty($runners)) {
            return;
        }
        $baseRace = reset($runners);
        $horseForms = $this->getModelRunners()->getHorseForms(
            array_keys($runners),
            $baseRace->race_type_code,
            $baseRace->race_datetime
        );
        foreach ($horseForms as $horseUid => $races) {
            foreach ($races as $race) {
                $courseDistanceWinnerFound = false;
                if ($this->getCourseWinner($baseRace, $race)) {
                    if ($this->getCourseDistanceWinner($baseRace, $race)) {
                        $runners[$horseUid]->course_and_distance_wins += 1;
                        $courseDistanceWinnerFound = true;
                    } else {
                        $runners[$horseUid]->course_wins += 1;
                    }
                }

                if (!$courseDistanceWinnerFound && $this->getDistanceWinner($baseRace, $race)) {
                    $runners[$horseUid]->distance_wins += 1;
                }
            }
        }
    }

    /**
     * @param array $runners
     */
    public function addBeatenFavourite(array &$runners)
    {
        if (empty($runners)) {
            return;
        }
        // When we pass empty race_type_code we will get information from flat and jump as assotiative array
        $beatenFavourites = $this->getModelRunners()->getBeatenFavourites(
            array_keys($runners),
            '',
            reset($runners)->race_datetime
        );

        // When we check for beaten_favourite we should look only for current race_type for horse
        foreach ($runners as $horseUid => $runner) {
            $raceType = in_array($runner->race_type_code, Constants::RACE_TYPE_FLAT_ARRAY) ? Constants::RACE_TYPE_FLAT_ALIAS : Constants::RACE_TYPE_JUMPS_ALIAS;
            $runner->beaten_favourite = isset($beatenFavourites[$raceType][$horseUid]) ? 'Y' : 'N';
        }
    }

    /**
     * Add a RP Ratings improver flag for each runner
     * Ported from sub_crs_dist_indicators_totals stored procedure
     *
     * @param array                 $runners
     * @param \Api\Row\RaceInstance $raceInfo
     */
    protected function addImproverFlag(array &$runners, $raceIds)
    {
        if (empty($runners)) {
            return;
        }

        $improverData = $this->getModelRunners()->fetchImproverData($raceIds);

        if (empty($improverData)) {
            return;
        }

        foreach ($improverData as $horseId => $horse) {
            if (!isset($runners[$horseId])) {
                continue;
            }

            $improver = 'N';
            $lastRating = -99;
            $penultimateRating = -99;
            $improverRaceCnt = 0;
            $bestPrevRating = -99;

            foreach ($horse as $race) {
                $raceType = $runners[$horseId]->race_type_code;
                if ((strpbrk($raceType, Constants::RACE_TYPE_FLAT) !== false
                    && strpbrk($race->race_type_code, Constants::RACE_TYPE_FLAT) !== false)
                    || ((strpbrk($raceType, Constants::RACE_TYPE_FLAT) === false
                    && $raceType == $race->race_type_code))
                ) {
                    $improverRaceCnt++;

                    // Get Best rating from all previous races excluding last two
                    if ($lastRating != -99 && $penultimateRating != -99 && $race->rp_postmark > $bestPrevRating) {
                        $bestPrevRating = $race->rp_postmark;
                    }

                    // Get Penultimate run Postmark Rating
                    if ($lastRating != -99 && $penultimateRating == -99) {
                        $penultimateRating = $race->rp_postmark;
                    }

                    // Get Last run Postmark rating
                    if ($race->date_diff < 366 && $lastRating == -99) {
                        $lastRating = $race->rp_postmark;
                    }
                }
            }

            if ($improverRaceCnt > -1 && $penultimateRating != -99) {
                $improver = ($lastRating > $penultimateRating && $penultimateRating > $bestPrevRating) ? 'Y' : 'N';
            }
            $runners[$horseId]->rp_postmark_improver = $improver;
        }
    }

    /**
     * @param array $runners
     */
    protected function addGoingPerformance(array &$runners)
    {
        if (empty($runners)) {
            return;
        }

        $goingPerfData = $this->getModelRunners()->getGoingPerformance(array_keys($runners));

        foreach ($runners as $horseId => $horse) {
            $runners[$horseId]->slow_ground_flat_wins = null;
            $runners[$horseId]->slow_ground_jumps_wins = null;
            $runners[$horseId]->fast_ground_wins = null;

            if (isset($goingPerfData[$horseId])) {
                $runners[$horseId]->slow_ground_flat_wins =
                    $goingPerfData[$horseId]->slow_ground_flat_wins > 0
                        ? $goingPerfData[$horseId]->slow_ground_flat_wins
                        : null;
                $runners[$horseId]->slow_ground_jumps_wins =
                    $goingPerfData[$horseId]->slow_ground_jumps_wins > 0
                        ? $goingPerfData[$horseId]->slow_ground_jumps_wins
                        : null;
                $runners[$horseId]->fast_ground_wins =
                    $goingPerfData[$horseId]->fast_ground_wins > 0
                        ? $goingPerfData[$horseId]->fast_ground_wins
                        : null;
            }
        }
    }

    /**
     * @param array $runners
     * @param array $raceIds
     * @throws ResultsetException
     */
    protected function addOwnerGroups(array &$runners, array $raceIds): void
    {
        if (empty($runners)) {
            return;
        }

        $ownerGroups = $this->getModelRunners()->getHorseOwnerGroups($raceIds);

        if (empty($ownerGroups)) {
            return;
        }

        $this->addOwnerGroupsUids($runners, $ownerGroups);
    }

    /**
     * @param $runner
     *
     * @return \Api\Row\WinsRuns
     */
    private function getJockeyLast14DaysStats($runner)
    {
        $jockey14Stats = new \Api\Row\WinsRuns();
        $jockey14Stats->wins = $runner->jockey_wins ? $runner->jockey_wins : 0;
        $jockey14Stats->runs = $runner->jockey_runs ? $runner->jockey_runs : 0;

        return $jockey14Stats;
    }
}
