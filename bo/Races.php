<?php

declare(strict_types=1);

namespace Bo;

use Api\Constants\Horses as Constants;
use Api\Exception\NotFound;
use Api\Input\Request\Horses\Races\Request;
use Exception;
use Models\Bo\RaceCards\RaceInstance;
use Models\Bo\RaceCards\Runners;
use Models\Bo\Results\HorseRace;
use Api\DataProvider\Bo\Races\Favourites as Dataprovider;
use Api\Exception\ValidationError;
use Phalcon\Mvc\Model\Resultset\ResultsetException;
use Api\Output\Mapper\Methods\LegacyDecorators;
use Api\DataProvider\Bo\Rpr;
use Phalcon\DI;

/**
 * @package Bo\
 * @property Request $request;
 */
class Races extends BoWithFigures
{

    use LegacyDecorators;
    /**
     * @return array|\StdClass
     */
    public function getOneTwoThree()
    {
        $raceDate = $this->request->getDate() ?? date('Y-m-d');
        $runnersData = $this->getRaceDateRunners($raceDate);

        if (empty($runnersData)) {
            return [];
        }

        $result         = [];
        $raceAttribUids = $this->getRaceAttribUids(array_keys($runnersData));
        // the top four dead heats
        foreach ($runnersData as $raceUid => $runners) {
            /*
            1. Omit the race from the result if it has race_attrib_uid = 432 or 433
            2. If the race is p2p we want to omit it from the response
            3. We want to include some french races based on course_uid regardless of race_attrib_uid.
               These course ids are stored in Constants::FRENCH_COURSES
            */
            if (isset($raceAttribUids[$raceUid]) &&
                !empty($raceAttribUids[$raceUid]['attrib_uids']) &&
                !in_array($runners[0]->course_uid, explode(', ', Constants::FRENCH_COURSES))
            ) {
                $keys = array_keys($raceAttribUids[$raceUid]['attrib_uids']);

                if ($runners[0]->race_type_code == Constants::RACE_TYPE_P2P_STR ||
                    in_array(Constants::INCOMPLETE_CARD_ATTRIBUTE_ID, $keys) ||
                    in_array(Constants::INCOMPLETE_RACE_ATTRIBUTE_ID, $keys)
                ) {
                    continue;
                }
            }

            $race = new \StdClass();
            $race->race_uid = $raceUid;
            foreach ($runners as $horse) {
                $horse->uid                 = $horse->horse_uid;
                $horse->weight_allowance_kg = null;
                $horse->pos_deadheat        = false;
                $horse->pos_dnf             = false;
                $horse->pos_dnf_status      = null;
                $horse->pos_disqualified    = false;
                $horse->pos_disq_status     = null;
                $horse->favourite_bool      = is_string($horse->favourite_flag) ? true : false;

                if (isset($horse->disqualification_uid)) {
                    $horse->pos_disqualified = true;
                    $disqualificationInfo    = $this->getDisqualificationInfo($horse->disqualification_uid);
                    $horse->pos_disq_status  = $disqualificationInfo[0]->disqualification_desc;
                }

                $this->addHorsePositioning($horse, $race);
            }

            if (!empty($race->runners)) {
                $result[] = $race;
            }
        }
        return $result;
    }

    /**
     * @throws ResultsetException
     */
    public function getOneTwoThreeRaceId(): array
    {
        $raceId = $this->request->getRaceId();
        $runnersData = $this->getRaceDateRunnersById($raceId);

        if (empty($runnersData)) {
            return [];
        }

        $result         = [];
        $raceAttribUids = $this->getRaceAttribUids(array_keys($runnersData));

        foreach ($runnersData as $runners) {

            if (isset($raceAttribUids[$raceId]) &&
                !empty($raceAttribUids[$raceId]['attrib_uids']) &&
                !in_array($runners[0]->course_uid, explode(', ', Constants::FRENCH_COURSES))
            ) {
                $keys = array_keys($raceAttribUids[$raceId]['attrib_uids']);

                if ($runners[0]->race_type_code == Constants::RACE_TYPE_P2P_STR ||
                    in_array(Constants::INCOMPLETE_CARD_ATTRIBUTE_ID, $keys) ||
                    in_array(Constants::INCOMPLETE_RACE_ATTRIBUTE_ID, $keys)
                ) {
                    continue;
                }
            }

            foreach ($runners as $horse) {
                $horse->uid                 = $horse->horse_uid;
                $horse->weight_allowance_kg = null;
                $horse->pos_deadheat        = false;
                $horse->pos_dnf             = false;
                $horse->pos_dnf_status      = null;
                $horse->pos_disqualified    = false;
                $horse->pos_disq_status     = null;
                $horse->favourite_bool      = is_string($horse->favourite_flag) ? true : false;
                $horse->pos_original        = null;
                $horse->pos_official        = null;

                if (isset($horse->disqualification_uid)) {
                    $horse->pos_disqualified = true;
                    $disqualificationInfo    = $this->getDisqualificationInfo($horse->disqualification_uid);
                    $horse->pos_disq_status  = $disqualificationInfo[0]->disqualification_desc;
                }

                $this->addHorsePositioningTopThree($horse);
                if ($horse->pos_original != null) {
                    $result[] = $horse;
                }
            }
        }
        return $result;
    }

    /**
     * @return array
     * @throws ResultsetException
     */
    public function getFavourites()
    {
        $dataProvider = new Dataprovider();
        $raceDate     = $this->request->getDate() ?? date('Y-m-d');
        $raceIds      = $dataProvider->getDateRaces($raceDate);

        if (empty($raceIds)) {
            return [];
        }

        $racesAndRunners    = $this->getModelRunners()->getRunners(
            array_keys($raceIds),
            $this->getModelSelectors(),
            false,
            false,
            true
        );

        $result = [];
        foreach ($racesAndRunners as $raceId => $runners) {
            // We should skip the p2p races
            if ($runners[0]->race_type_code == Constants::RACE_TYPE_P2P_STR) {
                continue;
            }

            $lowestOddsIndex        = null;
            $lowestSaddleClothIndex = null;
            $duplicateOddsIndex     = null;

            foreach ($runners as $index => $horse) {
                // by default we show lbs but not kg so we just set it to null to use in the mapper
                $horse->weight_allowance_kg = null;

                // Since the mapper uses an associative array we cannot have the same key
                $horse->uid = $horse->horse_uid;

                // As a business rule we shouldn't display non-runners
                if (!is_null($horse->non_runner) && $horse->non_runner == 'Y') {
                    continue;
                }

                // lets find the lowest saddle cloth in case we have no odds for any horses in the given race
                if (!is_null($lowestSaddleClothIndex) &&
                    $horse->saddle_cloth_no < $runners[$lowestSaddleClothIndex]->saddle_cloth_no
                ) {
                    $lowestSaddleClothIndex = $index;
                } elseif (is_null($lowestSaddleClothIndex)) {
                    $lowestSaddleClothIndex = $index;
                }

                // lets find the horse with the lowest ->forecast_odds_value
                if (!is_null($lowestOddsIndex) &&
                    !is_null($horse->forecast_odds_value) &&
                    $horse->forecast_odds_value <= $runners[$lowestOddsIndex]->forecast_odds_value
                ) {
                    // if two horses have the same lowest odds then we should grab the one with lowest saddle_cloth_no
                    if ($horse->forecast_odds_value < $runners[$lowestOddsIndex]->forecast_odds_value ||
                        $horse->saddle_cloth_no < $runners[$lowestOddsIndex]->saddle_cloth_no
                    ) {
                        $lowestOddsIndex = $index;
                    }
                } elseif (is_null($lowestOddsIndex) &&
                    !is_null($horse->forecast_odds_value)
                ) {
                    $lowestOddsIndex = $index;
                }
            }
            // If lowestOddsIndex == NULL -> then we are sure that all horses in the race don't have odds
            $result[] = $runners[$lowestOddsIndex] ?? $runners[$lowestSaddleClothIndex];
        }
        return $result;
    }

    /**
     * Method to add the necessary horse positioning.
     *
     * The following logic should be applied:
     *    If two horses are 4st place, we include 1,2,3,4,4 (in this case there is no 5th place)
     *
     * @param $horse
     * @param $race
     */
    private function addHorsePositioning(&$horse, $race)
    {
        $topIds      = [1, 2, 3, 4];
        $deadHeatIds = [71, 72, 73, 74];

        // we want to avoid all non-finishers apart from void race runners.
        if (in_array($horse->race_outcome_uid ?? 0, Constants::RACE_OUTCOME_UID_NON_FINISHERS_ARRAY)) {
            return;
        }

        if (in_array($horse->race_outcome_uid, $deadHeatIds)) {
            $horse->pos_deadheat = true;
            // This covers when 2 horses dead-heat for 4th position. In that case include 5 runners in the result.
            if ($horse->race_outcome_uid == 74) {
                $topIds[] = 5;
            }
        }

        // we merge the arrays to check for either top 4 dead-heats (71-74) or top four
        if (in_array($horse->race_outcome_uid, array_merge($topIds, $deadHeatIds))) {
            $horse->pos_official = $horse->race_output_order;
            $horse->pos_original = $horse->orig_race_output_order;
            $race->runners[]     = $horse;
        }

        // in-case of a void race we should take the top four by saddle_cloth_no
        // no horses will match the above criteria in this case to $topIds includes 1-4
        if ($horse->race_outcome_uid == Constants::VOID_RACE_ATTRIBUTE_ID) {
            if (in_array($horse->saddle_cloth_no, $topIds)) {
                $horse->pos_original   = null;
                $horse->pos_official   = null;
                $horse->pos_dnf        = true;
                $horse->pos_dnf_status = Constants::VOID_STATUS;
                $race->runners[]       = $horse;
            }
        }
    }

    private function addHorsePositioningTopThree(&$horse)
    {
        $topIds      = [1, 2, 3];
        $deadHeatIds = [71, 72, 73];

        // we want to avoid all non-finishers apart from void race runners.
        if (in_array($horse->race_outcome_uid ?? 0, Constants::RACE_OUTCOME_UID_NON_FINISHERS_ARRAY)) {
            return;
        }

        if (in_array($horse->race_outcome_uid, $deadHeatIds)) {
            $horse->pos_deadheat = true;
            // This covers when 2 horses dead-heat for 4th position. In that case include 5 runners in the result.
            if ($horse->race_outcome_uid == 73) {
                $topIds[] = 4;
            }
        }
        if (in_array($horse->race_outcome_uid, array_merge($topIds, $deadHeatIds))) {
            $horse->pos_official = $horse->race_output_order;
            $horse->pos_original = $horse->orig_race_output_order;
        }

        if ($horse->race_outcome_uid == Constants::VOID_RACE_ATTRIBUTE_ID) {
            if (in_array($horse->saddle_cloth_no, $topIds)) {
                $horse->pos_original   = null;
                $horse->pos_official   = null;
                $horse->pos_dnf        = true;
                $horse->pos_dnf_status = Constants::VOID_STATUS;
            }
        }
    }

    /**
     * @param $raceDate
     * @return array
     */
    private function getRaceDateRunners(string $raceDate)
    {
        return (new HorseRace())->getResultsDateRunners($raceDate);
    }

    /**
     * @throws ResultsetException
     */
    private function getRaceDateRunnersById($raceId): array
    {
        return (new HorseRace())->getResultsDateRunnersById($raceId);

    }

    /**
     * @param string $raceDate
     * @return array
     */
    private function getRaceDateRunnersIndex(string $raceDate): array
    {
        $selectors = $this->getModelSelectors();
        return (new HorseRace())->getResultsDateRunnersIndex($raceDate, $selectors);
    }

    /**
     * @param $discUid
     * @return mixed
     */
    private function getDisqualificationInfo($discUid)
    {
        return (new HorseRace())->getDisqualificationData($discUid);
    }

    /**
     * @param array $raceIds
     * @return \Phalcon\Mvc\Model\Resultset\General
     */
    private function getRaceAttribUids(array $raceIds)
    {
        return (new RaceInstance())->getRaceAttributes($raceIds, 'races');
    }

    /**
     * @throws ResultsetException
     * @throws NotFound
     * @throws ValidationError
     * @throws Exception
     */

    public function getRunnersIndex(): array
    {
        $raceDate     = $this->request->getDate() ?? date('Y-m-d');
        $runners      = $this->getRaceDateRunnersIndex($raceDate);
        if (empty($runners)) {
            return [];
        }

        $race = new \StdClass();
        $result = [];
        $raceIds = [];

        foreach ($runners as $horse) {
            if (!in_array($horse->race_instance_uid, $raceIds)) {
                $raceIds[] = $horse->race_instance_uid;
            }
        }
        $this->addRatings($runners,$raceIds);

        foreach ($runners as $horse) {
            $horse->selection_cnt               = null;
            $horse->expected_weight_carried_kg  = null;
            $horse->weight_allowance_kg         = null;
            $horse->weight_carried_kg           = null;
            $horse->position                    = null;
            $horse->race_status_code            = $horse->race_status_code ?? null;

            if (in_array($horse->race_status_code, Constants::RACE_STATUS_CODES_PRE_RACE_DATA)) {
                $horse->saddle_cloth_no             = $this->addSaddleClothNo($horse->saddle_cloth_no);
                $horse->non_runner                  = $horse->non_runner == 'Y';
                $horse->race_datetime               = $horse->race_date;
                $horse->expected_weight_carried_kg  = null;
                $horse->weight_allowance_kg         = null;
                $horse->weight_carried_lbs          = null;
                $horse->weight_carried_kg           = null;
                $horse->rp_postmark_pre             = $horse->rp_postmark;
                $horse->rp_postmark_post            = null;
                $horse->position                    = null;
                $horse->odds_desc                   = null;
                $horse->stable_tour_comments        = $this->trimAndNullifyString($horse->notes);
                $horse->tips                        = $horse->tips ?? [];

                if (!empty($horse->figures_calculated)) {
                    $horse->figures_calculated = array_slice($horse->figures_calculated, 0, 6);
                }

                if (!empty($horse->figures)) {
                    $horse->figures = substr($horse->figures, -6);
                }
            } else {
                $horse->saddle_cloth_no             = $this->addSaddleClothNo($horse->saddle_cloth_no);
                $horse->non_runner                  = in_array($horse->race_outcome_uid, Constants::NON_RUNNER_IDS_ARRAY);
                $horse->figures_calculated          = null;
                $horse->figures                     = null;
                $horse->race_datetime               = $horse->race_date;
                $horse->expected_weight_carried_lbs = null;
                $horse->expected_weight_carried_kg  = null;
                $horse->weight_carried_kg           = null;
                $horse->rp_postmark_pre             = null;
                $horse->rp_postmark_post            = $horse->rp_postmark;
                $horse->odds_desc                   = $horse->forecast_odds_desc;
                $horse->stable_tour_comments        = $this->trimAndNullifyString($horse->notes);
                $horse->tips                        = null;

                $position_desc_codes = [51,52,53,54,55,56,57,58,59,63,64,121];

                if (isset($horse->race_outcome_uid)) {
                    if ($horse->race_outcome_uid >= 1 && $horse->race_outcome_uid <= 49) {
                        $horse->position = $horse->race_outcome_desc;
                    }
                    if (in_array($horse->race_outcome_uid, $position_desc_codes, true)) {
                        $horse->position = $horse->race_outcome_code;
                    }
                    if (in_array($horse->race_outcome_uid, Constants::NON_RUNNER_IDS_ARRAY)) {
                        $horse->position = "NR";
                    }
                    if ($horse->race_outcome_uid >= 71 && $horse->race_outcome_uid <= 120) {
                        if ($horse->race_outcome_desc == 'Deadheat') {
                            continue;
                        }
                        $horse->position = $horse->race_outcome_desc;
                    }
                }
            }
            $race->runners[] = $horse;
        }

        if (!empty($race->runners)) {
            $result[] = $race;
        }

        if ($raceDate >= date('Y-m-d')) {
            $this->addDaysSinceLastRun($runners);
            $this->addTipsOrSelections($raceIds, $runners, $getTips = true);
            $this->addCalculatedFigures($runners, 6, true);
        }

        return $result;
    }

    /**
     * @throws Exception
     */
    public function addRatings(array &$runners, array $raceIds = [])
    {
        $raceDate     = $this->request->getDate() ?? date('Y-m-d');
        if (empty($raceIds)) {
            $raceIds[] = $this->request->getRaceId();
        }

        $races = $this
            ->getModelRaceInstance()
            ->getRaceAdditionalData($raceIds);

        if($raceDate >= date('Y-m-d')) {
            $rprDataProvider = new Rpr(current($races), $runners);

            $horseRpr = $this->getHorseRpr($rprDataProvider, $runners);

            foreach ($raceIds as $raceId) {
                if (!isset($races[$raceId])) {
                    continue;
                }
                $race = $races[$raceId];

                if (strpos(Constants::RACE_TYPE_FLAT, $race->race_type_code) !== false) {
                    if ($race->top_age > Constants::MAX_TOP_AGE_PER_RACE_TYPE['flat']) {
                        $race->top_age = Constants::MAX_TOP_AGE_PER_RACE_TYPE['flat'];
                    }
                } else {
                    if (strpos(Constants::RACE_TYPE_HURDLE, $race->race_type_code) !== false) {
                        if ($race->top_age > Constants::MAX_TOP_AGE_PER_RACE_TYPE['hurdle']) {
                            $race->top_age = Constants::MAX_TOP_AGE_PER_RACE_TYPE['hurdle'];
                        }
                    } else {
                        if ($race->top_age > Constants::MAX_TOP_AGE_PER_RACE_TYPE['default']) {
                            $race->top_age = Constants::MAX_TOP_AGE_PER_RACE_TYPE['default'];
                        }
                    }
                }

                if (isset($horseRpr[$raceId])) {
                    $rprDataProvider->addRatingForRace($horseRpr[$raceId], $runners, $race);
                }
            }

            // loop over all race's runners
            foreach ($runners ?? [] as $horse) {
                if (!isset($races[$horse->race_instance_uid])) {
                    continue;
                }
                $race = $races[$horse->race_instance_uid];
                $horseId = $horse->horse_uid;
                if (!isset($runners[$horseId])) {
                    continue;
                }

                if (!isset($horse->wfa_control_flag)) {
                    $horse->wfa_control_flag = 0;
                    if (in_array($race->race_type_code, Constants::RACE_TYPE_FLAT_ARRAY)) {
                        if ($race->min_age != $race->max_age) {
                            if ($race->min_age >= 5) {
                                $horse->wfa_control_flag = 1;
                            } else {
                                $horse->wfa_control_flag = 2;
                            }
                        }
                    } else {
                        if ($race->max_age != $race->min_age && $race->top_age < $race->min_age) {
                            $horse->wfa_control_flag = 2;
                        }
                    }
                }
    
                $runners[$horse->horse_uid]->rp_postmark = $this->adjustRpr($runners[$horse->horse_uid], $race, $horse);
            }
        }
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
     * @return Runners
     */
    protected function getModelRunners(): Runners
    {
        return new Runners();
    }

    /**
     * @return RaceInstance
     */
    protected function getModelRaceInstance(): RaceInstance
    {
        return new RaceInstance();
    }
    /**
     * Adds selections or tips data to runners depending on boolean field $getTips.
     *
     * @param $raceIds
     * @param array $runners
     * @param bool $getTips
     */
    public function addTipsOrSelections($raceIds, array &$runners, bool $getTips)
    {
        if (empty($runners)) {
            return;
        }
        $model = $this->getModelRunners();

        if ($getTips) {
            $tips = $model->getTipsterData($raceIds);
            $this->incrementTipsAndSelectionCount($runners, $tips, 'tips');
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
}

