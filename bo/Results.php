<?php

namespace Bo;

use Api\Bo\Traits;
use Api\Constants\Horses as Constants;
use Api\DataProvider\Bo\Results\PastWinners as DataProviderPastWinners;
use Api\DataProvider\Factory\TmpResultsTables;
use Api\Input\Request\Horses\Results\SalesData;
use Api\Input\Request\HorsesRequest;
use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Row\General;
use Phalcon\DI;

/**
 * Class Results
 *
 * @package Bo
 */
class Results extends Standart
{
    use Traits\EveningMeetingCheck;
    use Traits\FirstSeasonSire;
    use Traits\OwnerGroups;

    /**
     * The past races limit
     */
    const PAST_RACES_LIMIT = 10;

    /**
     * Straight Round Jubilee Code for Grand National races
     */
    const SRJ_GRAND_NATIONAL_CODE = 'G';

    /**
     * temp course ids for Scoop 6 & World Wide Stakes meetings sometimes need to be treated differently
     */
    const SPECIAL_CASE_COURSE_IDS = [-1, -2];

    /**
     * @var TmpResultsTables TmpResultsTables
    */
    private $factoryResultsTmpTables;

    private $dataProviderPastWinners = null;

    /**
     * Results constructor.
     *
     * @param \Api\Input\Request\HorsesRequest $request
     * @param bool                             $checkUnboundParams
     */
    public function __construct(HorsesRequest $request, $checkUnboundParams = false)
    {
        parent::__construct($request, $checkUnboundParams);
        $this->factoryResultsTmpTables = new TmpResultsTables();
    }

    /**
     * @return \Api\DataProvider\Factory\TmpResultsTables
     */
    public function getFactoryResultsTmpTables()
    {
        return $this->factoryResultsTmpTables;
    }

    /**
     * @return mixed
     * @param $includeNonRunners
     * @throws \Api\Exception\NotFound
     */
    public function getRaceInfo($includeNonRunners = false)
    {
        $raceId = $this->request->getRaceId();
        $raceInfo = $this->getModelRaceInstance()->getRaceInfo($raceId, $includeNonRunners);

        if (!empty($raceInfo)) {
            $raceDate = date('Y-m-d', strtotime($raceInfo->race_datetime));

            $dividends = $this->getDividends($raceDate, [$raceInfo->course_uid]);
            $raceInfo->dividends = isset($dividends[$raceInfo->course_uid]) ? (object)$dividends[$raceInfo->course_uid]
                : null;

            $raceClass = $this->getModelRaceAttribLookup()->getRaceClass($raceId);
            $raceInfo->race_class = $raceClass ? $raceClass->race_attrib_desc : null;

            $raceInfo->prizes = $this->getModelRaceInstancePrize()->getRacePrizes($raceId, $raceDate);

            $videoDetails = $this->getVideoProviders([$raceId])->getDetails();

            $raceInfo->video_detail = (isset($videoDetails[$raceId]))
                ? $videoDetails[$this->request->getRaceId()] : null;

            // Depending on the race_type_code we grab the race_attrib_desc or display null.
            if (in_array($raceInfo['race_type_code'], CONSTANTS::RACE_TYPE_FLAT_AW_ARRAY)
                && isset($raceInfo['race_attrib_desc'])
            ) {
                $raceInfo->aw_surface_type =  $raceInfo['race_attrib_desc'];
            }

            $raceInfo->no_of_fences = $raceInfo->number_of_fences;

            if ($raceInfo->number_of_fences == 0) {
                $raceInfo->no_of_fences = $raceInfo->dist_number_of_fences;
            }
        }

        return $raceInfo;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\Results\RaceInstance
     */
    protected function getModelRaceInstance()
    {
        $instance = new \Models\Bo\Results\RaceInstance();
        $instance->setFactoryTmpResultTables($this->getFactoryResultsTmpTables());
        return $instance;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\Results\RaceAttribLookup
     */
    protected function getModelRaceAttribLookup()
    {
        return new \Models\Bo\Results\RaceAttribLookup();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\Results\RaceInstancePrize
     */
    protected function getModelRaceInstancePrize()
    {
        return new \Models\Bo\Results\RaceInstancePrize();
    }

    /**
     * @param bool $additionalFields
     * @return array
     * @throws Model\Resultset\ResultsetException
     */
    public function getResultsByRaceId(bool $additionalFields = false)
    {
        $raceId = $this->request->getRaceId();
        $selectors = $this->getModelSelectors();
        $result = $this->getModelHorseRace()->fetchResultsByRace($raceId, $selectors, $additionalFields);

        if (!empty($result)) {
            $result = $this->setPrevEndNextRaceForHorseInResult($result);

            // we create temp table which is needed to populate extra fields.
            $this->getModelRunners()->createTmpTableForResultsPopulateExtraFields($raceId);

            $this->addFirstSeasonSire($result);
            $this->addOwnerGroups($result);
            $this->addFavorites($result);

            $fieldsToPopulate = array(
                'horsesRacesSinceLastSurgery',
                'wfaPerAge'
            );

            $this->getModelRunners()->populateExtraFields($result, $fieldsToPopulate);

            return $result;
        }
    }


    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\Results\HorseRace
     */
    public function getModelHorseRace()
    {
        $instance = new \Models\Bo\Results\HorseRace();
        $instance->setFactoryTmpResultTables($this->getFactoryResultsTmpTables());
        return $instance;
    }

    /**
     * @param array $raceResults
     *
     * @return array
     */
    private function setPrevEndNextRaceForHorseInResult(array $raceResults)
    {
        $horsesRaces = $this->getModelHorseRace()->getHorseRacesToCalculatePrevAndNextRaces(
            $this->getFieldFromArrayOfRows($raceResults, 'horse_uid')
        );

        $currentRaceDateTime = strtotime($raceResults[0]->race_datetime);

        $prevAndNextRaces = [];

        foreach ($horsesRaces as $horseRace) {
            if (!isset($prevAndNextRaces[$horseRace->horse_uid])) {
                $prevAndNextRaces[$horseRace->horse_uid] = (Object)['next' => null, 'prev' => null];
            }

            $horseRaceDatetime = strtotime($horseRace->race_datetime);

            if ($currentRaceDateTime > $horseRaceDatetime
                && (is_null($prevAndNextRaces[$horseRace->horse_uid]->prev)
                || strtotime($prevAndNextRaces[$horseRace->horse_uid]->prev->race_datetime) < $horseRaceDatetime)
            ) {
                $prevAndNextRaces[$horseRace->horse_uid]->prev = $horseRace;
            } elseif ($currentRaceDateTime < $horseRaceDatetime
                && (is_null($prevAndNextRaces[$horseRace->horse_uid]->next)
                || strtotime($prevAndNextRaces[$horseRace->horse_uid]->next->race_datetime) > $horseRaceDatetime)
            ) {
                $prevAndNextRaces[$horseRace->horse_uid]->next = $horseRace;
            }
        }

        foreach ($raceResults as $raceResult) {
            $raceResult->next_race = isset($prevAndNextRaces[$raceResult->horse_uid]->next)
                ? $prevAndNextRaces[$raceResult->horse_uid]->next : null;
            $raceResult->prev_race = isset($prevAndNextRaces[$raceResult->horse_uid]->prev)
                ? $prevAndNextRaces[$raceResult->horse_uid]->prev : null;
        }

        return $raceResults;
    }

    /**
     * @param array $raceResults
     */
    private function addOwnerGroups(array &$raceResults): void
    {
        $ownerGroups = $this->getModelHorseRace()->getHorseOwnerGroups([$this->request->getRaceId()]);
        if (empty($ownerGroups)) {
            return;
        }

        $this->addOwnerGroupsUids($raceResults, $ownerGroups);
    }

    /**
     * @param array $nonRunners
     * @param array $raceIds
     */
    private function addOwnerGroupsToNonRunners(array &$nonRunners, array $raceIds): void
    {
        $ownerGroups = $this->getModelHorseRace()->getHorseOwnerGroups($raceIds, false);
        if (empty($ownerGroups)) {
            return;
        }

        $coolmoreHorseToFollowToOwnerGroupMap = array_flip(Constants::COOLMORE_OWNER_GROUPS_TO_HORSE_IDS);
        foreach ($nonRunners as $race) {
            foreach ($race as $raceResult) {
                $groups = [];

                if (isset($ownerGroups[$raceResult->horse_uid])) {
                    foreach ($ownerGroups[$raceResult->horse_uid] as $horse) {
                        if (is_null($horse->owner_group_uid)) {
                            $groups[] = $coolmoreHorseToFollowToOwnerGroupMap[$horse->to_follow_uid];
                        } else {
                            $groups[] = $horse->owner_group_uid;
                        }
                    }
                }
                sort($groups);
                $raceResult->owner_group_uid = !empty($groups) ? $groups : null;
            }
        }
    }

    /**
     * @throws Model\Resultset\ResultsetException
     */
    public function getStatistic()
    {
        $raceId = $this->request->getRaceId();
        $statistics = $this->getModelRaceInstance()->getStatistic($raceId);
        //        $oddsValueArray = $this->getModelRaceInstance()->getOddsValue($raceId);

        $totalSP = 0;
        $result = current($statistics);
        $statisticsCount = 0;
        // we need to loop through the statistics to retrieve all the odds values for the given race
        // and then we calculate the totalSP (total starting price) and add it to the statistics object.
        foreach ($statistics as $record) {
            if (!is_null($record->odds_value)) {
                $totalSP += (1 / ($record->odds_value + 1)) * 100;
            }
            $statisticsCount++;
        }
        $totalSP += 0.5;
        $result->total_sp = $totalSP;

        if (!in_array($result->country_code, Constants::COUNTRIES_GB_IRE)) {
            $result->no_of_runners_calculated = $result->no_of_runners;
        } else {
            $result->no_of_runners_calculated = $statisticsCount;
        }

        return $result;
    }

    /**
     * @return stdClass
     */
    public function getTote()
    {
        $totes = $this->getModelRaceInstance()->getTote([$this->request->getRaceId()]);

        return isset($totes[$this->request->getRaceId()]) ? $totes[$this->request->getRaceId()] : null;
    }

    /**
     * @return array|null
     * @throws Model\Resultset\ResultsetException
     */
    public function getNonRunners()
    {
        $raceId = $this->request->getRaceId();
        $nonRunners = $this->getModelHorse()->getNonRunners([$raceId]);

        if (empty($nonRunners)) {
            return null;
        }
        $this->addOwnerGroupsToNonRunners($nonRunners, [$raceId]);

        $this->addFirstSeasonSire($nonRunners[$raceId]);

        return $nonRunners[$raceId];
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\Results\Horse
     */
    protected function getModelHorse()
    {
        return new \Models\Bo\Results\Horse();
    }

    /**
     * @return array
     */
    public function getFastResult()
    {
        $fastResult = $this->getModelFastHorseRace()->getRaceFastResult($this->request->getFastRaceId());

        if ($fastResult && $fastResult->formbook_yn != 'Y') {
            $fastResult->race_instance_uid = null;
        }

        return $fastResult;
    }

    /**
     * @return array
     */
    public function getFastByRaceResult()
    {
        $model = $this->getModelFastHorseRace();

        $fastRaceId = $model->getFastRaceId($this->request->getRaceId());
        $fastResult = $model->getRaceFastResult($fastRaceId);

        if ($fastResult && $fastResult->formbook_yn != 'Y') {
            $fastResult->race_instance_uid = null;
        }

        return $fastResult;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\Results\FastHorseRace
     */
    protected function getModelFastHorseRace()
    {
        return new \Models\Bo\Results\FastHorseRace();
    }

    /**
     * @param bool $showAllRaces
     * @param bool $returnP2P
     *
     * @throws Model\Resultset\ResultsetException
     * @throws \Api\Exception\InternalServerError
     * @throws \Api\Exception\NotFound
     *
     * @return array|null
     */
    public function getResultsByDate($showAllRaces = false, $returnP2P = true)
    {
        $raceDate = $this->request->getRaceDate();
        if (date('Y-m-d', strtotime($raceDate)) != $raceDate) {
            throw new \Api\Exception\InternalServerError(3);
        }

        $modelCourse = $this->getModelCourse();

        $crs = $this->getResultsDateData($raceDate, $showAllRaces, $returnP2P);

        if (empty($crs)) {
            return null;
        }

        $runners = $this->getModelHorseRaceInstance()->getResultsDateRunners($raceDate, $returnP2P);

        $raceInstanceUids                = [];
        $courseUids                      = [];
        $courseRaceTypes                 = [];
        $courseStraightRoundJubileeCodes = [];
        $courseDirections                = [];
        $nonRunners                      = [];
        $dividends                       = [];
        $meetings                        = [];
        $excludedMeetings                = [];
        $includedMeetings                = [];

        $groupResult = new Model\Resultset\Utility\GroupResult();

        foreach ($crs as $course) {
            $maxPrize = 0.0;

            foreach ($course as $race) {
                $race->runners                            = null;
                $race->dividends                          = null;
                $race->non_runners                        = null;
                $race->course_directions                  = null;
                $race->rule                               = null;
                $race->unplaced_favourites                = null;
                $race->course_race_type_code              = null;
                $race->course_straight_round_jubilee_code = null;

                // Ignore temp course ids. Also any race ids belonging to them will be included by the original courses.
                if ($race->r_status != Constants::getConstantValue(Constants::RACE_STATUS_ABANDONED)
                    && !in_array($race->crs_id, self::SPECIAL_CASE_COURSE_IDS)
                ) {
                    $raceInstanceUids[] = $race->race_instance_uid;
                    $courseUids[] = $race->crs_id;
                }
                if (!isset($courseRaceTypes[$race->crs_id])) {
                    $courseRaceTypes[$race->crs_id] = $race->race_type_code;
                }
                if ($race->prize > $maxPrize) {
                    $courseRaceTypes[$race->crs_id] = $race->race_type_code;
                    $maxPrize = $race->prize;
                }

                $courseStraightRoundJubileeCode = empty($courseStraightRoundJubileeCodes[$race->crs_id])
                    ? null
                    : $courseStraightRoundJubileeCodes[$race->crs_id];

                $courseStraightRoundJubileeCodes[$race->crs_id] = (
                    $courseStraightRoundJubileeCode !== self::SRJ_GRAND_NATIONAL_CODE
                    && $race->crs_id == 32
                    && $race->straight_round_jubilee_code == self::SRJ_GRAND_NATIONAL_CODE)
                    ? self::SRJ_GRAND_NATIONAL_CODE
                    : $courseStraightRoundJubileeCode;
            }

            // Standard meetings will only have one element in the result[0] array returned by getGroupedResult(),
            // but Scoop 6 and / or World Wide Stakes meetings can have multiple
            $groups = $groupResult->getGroupedResult($course, $this->getResultsDateReturnStructure())[0]->result;
            foreach ($groups as $group) {
                $meetings[] = $group;
            }
        }

        unset($crs);

        $raceInstanceUids = array_unique($raceInstanceUids);
        $courseUids       = array_unique($courseUids);

        if (!empty($raceInstanceUids)) {
            $ruleFourByRaceId = $this->getModelRaseInstanceTote()->getRuleFourByRaceId($raceInstanceUids);
            $nonRunners = $this->getModelHorse()->getNonRunners($raceInstanceUids);
            $this->addOwnerGroupsToNonRunners($nonRunners, $raceInstanceUids);
        }
        if (!empty($courseUids)) {
            $courseDirections = $this->getModelCourseDirections()->getCourseDirectionsByCourseId($courseUids);
            $dividends = $this->getDividends($raceDate, $courseUids);

            // For today's meetings $data won't include any prize money from races still at the pre-race stage, so we
            // need to use the Course model.
            if ($raceDate == date('Y-m-d')) {
                $meetingStatus = $modelCourse->getMeetingsStatus($courseUids, $raceDate);
            }
        }

        foreach ($meetings as $meeting) {
            // Assign default values for a meeting. These are the fields required by Course->calculateRpMeetingOrder()
            $meeting->racesItv                 = 0;
            $meeting->containsNotFinishedRaces = 0;
            $meeting->totalPrizeMoney          = 0;
            $meeting->eveningMeeting           = 0;
            $meeting->race_date                = $raceDate;
            $meeting->rp_meeting_order         = $meeting->crs_id;
            $meeting->course_uid               = $meeting->crs_id;

            // Set rp_position to 1 for GB / IRE and 2 for other countries.
            $meeting->rp_position = $meeting->is_gb_or_ire == 1 ? 1 : 2;


            $meeting->course_race_type_code              = $courseRaceTypes[$meeting->crs_id]                 ?? null;
            $meeting->course_straight_round_jubilee_code = $courseStraightRoundJubileeCodes[$meeting->crs_id] ?? null;

            $currentRaceNumber = 0;

            foreach ($meeting->races as $raceKey => $race) {
                if ($race->r_status != Constants::getConstantValue(Constants::RACE_STATUS_ABANDONED)) {
                    if (isset($runners[$race->race_instance_uid])) {
                        $this->addRunners($race, $runners);
                    }
                    $race->non_runners = $nonRunners[$race->race_instance_uid] ?? null;
                    $race->rule = $ruleFourByRaceId[$race->race_instance_uid]->rule4_text ?? null;
                    $race->course_directions = $courseDirections[$meeting->crs_id] ?? null;

                    if ($race->r_status == Constants::getConstantValue(Constants::RACE_STATUS_RESULTS)) {
                        $currentRaceNumber++;
                    }
                    if (isset($dividends[$meeting->crs_id])) {
                        $race->dividends = (object)$dividends[$meeting->crs_id];
                    } else {
                        $race->dividends = null;
                    }

                    if ($race->rp_tv_text && in_array(trim($race->rp_tv_text), Constants::ITV_CODES)) {
                        $meeting->racesItv = -1;
                    }

                    // Only use $race->pool_prize_sterling when calculating $totalPrizeMoney for past dates.
                    // $data would be missing today's races at the pre-race stage, leading to an incomplete prize total.
                    if ($raceDate < date('Y-m-d')) {
                        if (!empty($race->pool_prize_sterling)) {
                            $meeting->totalPrizeMoney -= $race->pool_prize_sterling;
                        }
                    } else {
                        // We only need to do the evening check for today's results.
                        // If $meeting->eveningMeeting = 0 then this must be that meeting's first race.
                        if ($meeting->eveningMeeting == 0) {
                            $meeting->eveningMeeting = $this->getEveningMeetingFlag($race->race_datetime);
                        }
                    }
                }

                //To exclude incomplete results that are input manually
                if (!in_array($race->course_country, Constants::COUNTRIES_GB_IRE)) {
                    if ($race->formbook_yn !== 'Y'
                        && $race->r_status === Constants::getConstantValue(Constants::RACE_STATUS_RESULTS)
                        && !$showAllRaces
                        && $race->no_of_runners != $race->no_of_runners_calculated
                    ) {
                        unset($meeting->races[$raceKey]);
                    } else {
                        $race->no_of_runners_calculated = $race->no_of_runners;
                    }
                }

                if ((new \DateTime())->format('Y-m-d') != $raceDate) {
                    $race->formbook_yn = empty($race->runners) ? 'N' : 'Y';
                }
            }

            // If a meeting has no races left after 1 or more was unset we should skip processing this meeting by
            // excluding it from the $includedMeetings / $excludedMeetings arrays that follow
            if (count($meeting->races) == 0) {
                continue;
            }

            foreach ($meeting->races as $race) {
                if (isset($race->dividends)) {
                    $race->dividends->current_race_number = $currentRaceNumber;
                    $race->dividends->total_number_of_races = count($meeting->races);
                }
            }

            // We want to ignore Scoop 6 & World Wide Stakes meetings when calculating rp_meeting_order
            // Also any meeting not in $courseUids must've been abandoned, so exclude them too.
            if (in_array($meeting->crs_id, self::SPECIAL_CASE_COURSE_IDS)
                || !in_array($meeting->crs_id, $courseUids)
            ) {
                $meeting->rp_meeting_order = null;

                $excludedMeetings[] = $meeting;
            } else {
                // Use $meetingStatus for today's meetings and $totalPrizeMoney for past dates.
                if ($raceDate == date('Y-m-d') && isset($meetingStatus[$meeting->crs_id])) {
                    $meeting->totalPrizeMoney = -1 * $meetingStatus[$meeting->crs_id]->total_prize_money;

                    // Any unfinished races, set to -1. Else 0.
                    $meeting->containsNotFinishedRaces = $meetingStatus[$meeting->crs_id]->no_of_unfinished_races > 0 ? -1 : 0;
                }

                $includedMeetings[] = $meeting;
            }
        }

        $modelCourse->calculateRpMeetingOrder($includedMeetings);

        // Bring all the meetings back together again.
        $meetings = array_merge($includedMeetings, $excludedMeetings);

        $resultsOrder = 1;
        foreach ($meetings as $meeting) {
            $meeting->results_order = $resultsOrder;
            $resultsOrder++;
        }

        return count($meetings) > 0 ? $meetings : null;
    }

    /**
     * Add runners and unplaced favourites to a race
     *
     * @param array $race
     * @param array $runners
     */
    private function addRunners($race, $runners)
    {
        $race->runners = $runners[$race->race_instance_uid];

        $this->addFavorites($race->runners);
        if (!$this->isVoidRace($race->runners)) {
            $this->getEachWayPlacedRunners($race);
            $race->unplaced_favourites = $this->getUnplacedFavorites($race);
            $race->runners = array_filter(
                array_slice($race->runners, 0, 4),
                function ($runner) {
                    return $runner->race_outcome_position > 0 && $runner->race_outcome_position < 5;
                }
            );
        }
    }

    /**
     * We add first and second favorite flags to runners.
     * First favourite will be the runner with the lowest odds_value.
     * Second favorite will be the runner with second lowest odds_value.
     * In cases where more than 1 runner qualifies, we will use joint favourite flags
     *
     * @param $runners
     */
    public function addFavorites(&$runners)
    {
        $min = [
            'value'   => -1,
            'runners' => [],
        ];
        $secondMin = [
            'value'   => -1,
            'runners' => []
        ];

        // We want to know who are the runners that have the first and second lowest odds, so we can add 1st and 2nd
        // favourite flags for them afterwards
        foreach ($runners as $runner) {
            if (is_null($runner['odds_value'])) {
                continue;
            }
            if ($min['value'] == $runner['odds_value']) {
                $min['runners'][] = $runner;
            } else if ($secondMin['value'] == $runner['odds_value']) {
                $secondMin['runners'][] = $runner;
            } else if ($min['value'] == -1) {
                $min['value']     = $runner['odds_value'];
                $min['runners'][] = $runner;
            } elseif ($min['value'] > $runner['odds_value']) {
                $secondMin = $min;
                $min['value']     = $runner['odds_value'];
                $min['runners']   = [];
                $min['runners'][] = $runner;
            } elseif ($secondMin['value'] == -1 || $secondMin['value'] > $runner['odds_value']) {
                $secondMin['value']     = $runner['odds_value'];
                $secondMin['runners']   = [];
                $secondMin['runners'][] = $runner;
            }
        }

        // Set 1st favourites
        if (count($min['runners']) == 1) {
            $min['runners'][0]->fav_1st = 1;
        }

        // If there are 2 joint 1st favourites they are also flagged as joint 2nd favourites.
        // When there are more than 2 joint 1st favourites there are no 2nd favourites
        // Otherwise, the logic for fav_2nd and joint_2nd_fav is the following
        // 3 runners -> runner1 odds_value(ov) = 1, runner2 ov = 2, runner3 ov = 3 -> runner2 2nd_fav = true
        // 3 runners -> runner1 ov = 1, runner2 ov = 2, runner3 ov = 2 -> runner2,runner3 joint_2nd_fav = true
        // 3 runners -> runner1 ov = 1, runner2 ov = 1, runner3 ov = 3 -> joint_2nd_fav = true
        // 3 runners -> runner1 ov = 1, runner2 ov = 1, runner3 ov = 1 -> all false
        // 4 runners -> runner1 ov = 1, runner2 ov = 2, runner3 ov = 2, runner4 ov = 2 -> runner2,runner3,runner4 joint_2nd_fav = true
        if (count($min['runners']) == 2) {
            foreach ($min['runners'] as $runner) {
                $runner->joint_1st_fav = 1;
                $runner->joint_2nd_fav = 1;
            }
        } elseif (count($min['runners']) > 2) {
            foreach ($min['runners'] as $runner) {
                $runner->joint_1st_fav = 1;
            }
        } elseif (count($secondMin['runners']) == 1) {
            $secondMin['runners'][0]->fav_2nd = 1;
        } elseif (count($secondMin['runners']) > 1) {
            foreach ($secondMin['runners'] as $runner) {
                $runner->joint_2nd_fav = 1;
            }
        }
    }

    /**
     * Check if it's a void race inspecting outcome code of each runner in it
     *
     * @param array $runners
     *
     * @return boolean
     */
    private function isVoidRace($runners)
    {
        if (empty($runners)) {
            return false;
        }

        foreach ($runners as $runner) {
            if (strpos(Constants::VOID_CODES, $runner->race_outcome_code) === false) {
                return false;
            }
        }
        return true;
    }

    /**
     * @param array $runners
     *
     * @return array
     */
    private function getFavorites($runners)
    {
        $favorites = [];
        if (empty($runners)) {
            return $favorites;
        }
        foreach ($runners as $runner) {
            if (strpos(Constants::FAVOURITE_FLAG_CODES, $runner->favourite_flag) !== false) {
                $favorites[$runner->horse_uid] = $runner;
            }
        }
        return $favorites;
    }

    /**
     * Get array of horses with odds_value the lowest in the race and not exist in placed runners list
     *
     * @param object $race
     *
     * @return array|null
     */
    protected function getUnplacedFavorites($race)
    {
        $unplaced = [];
        $favorites = $this->getFavorites($race->runners);
        if (empty($favorites)) {
            return $unplaced;
        }

        foreach ($favorites as $id => $favorite) {
            $exists = false;
            foreach ($race->runners as $runner) {
                if ($runner->horse_uid == $id && $runner->each_way_placed == 'Y') {
                    $exists = true;
                    break;
                }
            }

            if (!$exists) {
                $unplaced[] = $favorite;
            }
        }

        return (!empty($unplaced)) ? $unplaced : null;
    }

    /**
     * Set a boolean flag to represent the each-way betting rules applicable to the each runner
     *
     * @param $race
     */
    protected function getEachWayPlacedRunners(&$race)
    {
        $cnt = $race->no_of_runners_calculated;

        foreach ($race->runners as &$runner) {
            if (($cnt > 0 && $cnt <= 4 && $runner->race_outcome_position == 1)
                || ($cnt >= 5 && $cnt <= 7 && in_array($runner->race_outcome_position, [1, 2]))
                || ((($cnt >= 8 && $cnt <= 15)
                || ($cnt >= 16 && strpos(Constants::RACE_GROUP_CODE_HANDICAP, $race->race_group_code) === false)                )
                && in_array($runner->race_outcome_position, [1, 2, 3]))
                || (                $cnt >= 16 && strpos(Constants::RACE_GROUP_CODE_HANDICAP, $race->race_group_code) !== false
                && in_array($runner->race_outcome_position, [1, 2, 3, 4]))
            ) {
                $runner->each_way_placed = 'Y';
            }
        }

        unset($runner);
    }

    /**
     * @return array
     */
    private function getResultsDateReturnStructure()
    {
        return [
            'result(\Api\Row\Course)' => [
                'crs_id',
                'mixed_crs_id',
                'course_name',
                'course_style_name',
                'course_country',
                'course_type_code',
                'mnemonic',
                'replaced_aw',
                'rp_abbrev_3',
                'is_gb_or_ire',
                'rp_admission_prices',
                'rp_flat_course_comment',
                'rp_jump_course_comment',
                'graphic_name',
                'graphic_height',
                'going_desc',
                'weather_cond',
                'stalls_position',
                'wind',
                'country_desc',
                'course_race_type_code',
                'course_straight_round_jubilee_code',
                'races(\Api\Row\RaceInstance)' => [
                    'race_instance_uid',
                    'going_type_desc',
                    'race_datetime',
                    'race_instance_title',
                    'alt_race_title',
                    'formbook_yn',
                    'race_class',
                    'race_type_code',
                    'r_dist',
                    'rp_ages_allowed_desc',
                    'r_status',
                    'course_country',
                    'no_of_runners',
                    'no_of_runners_calculated',
                    'prize',
                    'pool_prize_sterling',
                    'winner_time',
                    'diff_to_standard_time_sec',
                    'scoop',
                    'race_group_desc',
                    'has_details',
                    'rp_omitted_fences',
                    'no_of_fences',
                    'straight_round_jubilee_code',
                    'straight_round_jubilee_desc',
                    'rp_straight_round_jubilee_desc',
                    'is_worldwide_stake',
                    'eyecatcher_horse_uid',
                    'eyecatcher_style_name',
                    'eyecatcher_country_code',
                    'eyecatcher_notes',
                    'star_performer_horse_uid',
                    'star_performer_style_name',
                    'star_performer_country_code',
                    'star_performer_notes',
                    'fast_race_instance_uid',
                    'official_rating_band_desc',
                    'rp_analysis',
                    'total_sp',
                    'non_runners' => 'non_runners(\Api\Row\Results\Horse)',
                    'unplaced_favourites' => 'unplaced_favourites(\Api\Row\Results\Horse)',
                    'rule',
                    'course_directions',
                    'rp_tv_text',
                    'race_group_code',
                    'tote' => 'tote',
                    'runners' => 'runners(\Api\Row\Results\Horse)',
                    'dividends' => 'dividends',
                    'aw_surface_type' => 'aw_surface_type',
                    'video_detail' => 'video_detail'
                ]
            ]
        ];
    }

    /**
     * @param string $date
     * @param bool   $showAllRaces
     * @param bool   $returnP2P
     *
     * @return array
     * @throws \Api\Exception\NotFound
     */
    private function getResultsDateData($date, $showAllRaces, $returnP2P)
    {
        $races = $this->getModelRaceInstance()->getRaceListByDate($date, $showAllRaces, $returnP2P);

        if (empty($races)) {
            return null;
        }

        $raceIDs = $this->getFieldFromArrayOfRows($races, 'race_instance_uid');
        $videoDetails = $this->getVideoProviders($raceIDs)->getDetails();
        $totes = $this->getModelRaceInstance()->getTote($raceIDs);

        $lastCourseId = 0;
        $abandonedForMeeting = 0;
        $countForMeeting = 0;

        $abandonedMeetings = [];
        $scoopSixRaces = [];
        $worldwideStakesRaces = [];

        foreach ($races as $race) {
            $race->tote = (isset($totes[$race->race_instance_uid]))
                ? $totes[$race->race_instance_uid] : null;

            $race->video_detail = (isset($videoDetails[$race->race_instance_uid]))
                ? $videoDetails[$race->race_instance_uid] : null;

            if ($lastCourseId != $race->crs_id) {
                if ($lastCourseId != 0) {
                    $abandonedMeetings[$lastCourseId] = ($abandonedForMeeting == $countForMeeting);
                }
                $abandonedForMeeting = 0;
                $countForMeeting = 0;
                $lastCourseId = $race->crs_id;
            }

            $countForMeeting++;
            if ($race->r_status == Constants::getConstantValue(Constants::RACE_STATUS_ABANDONED)) {
                $abandonedForMeeting++;
            }

            if ($race->scoop == "S6") {
                // create array of scoop6 races only
                $raceClone = clone $race;
                // set dummy id
                $raceClone->crs_id = -1;
                $raceClone->course_name = 'SCOOP6 RACES';
                $raceClone->course_country = 'GB';
                $scoopSixRaces[] = $raceClone;
            }
            if ($race->is_worldwide_stake == 1) {
                // create array of World Wide Stakes races only
                $raceClone = clone $race;
                // set dummy id
                $raceClone->crs_id = -2;
                $raceClone->course_name = 'WORLD WIDE STAKES';
                $worldwideStakesRaces[] = $raceClone;
            }
        }
        $abandonedMeetings[$lastCourseId] = ($abandonedForMeeting == $countForMeeting);

        $abandonedRaces = [];
        $realRaces = [];
        foreach ($races as $key => $race) {
            if ($abandonedMeetings[$race->crs_id]) {
                $abandonedRaces[] = $race;
            } else {
                $realRaces[] = $race;
            }
        }

        usort($scoopSixRaces, [$this, 'sortRaces']);

        $allRaces = array_merge($realRaces, $scoopSixRaces, $worldwideStakesRaces, $abandonedRaces);

        return $this->groupRacesByCourse($allRaces);
    }

    /**
     * @param array $raceIDs
     *
     * @return VideoProviders
     */
    protected function getVideoProviders($raceIDs)
    {
        return new \Bo\VideoProviders($raceIDs);
    }

    /**
     * @param $allRaces
     *
     * @return array
     */
    private function groupRacesByCourse($allRaces)
    {
        $res = [];

        foreach ($allRaces as $race) {
            $res[$race->crs_id][] = $race;
        }
        return $res;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\Results\HorseRace
     */
    protected function getModelHorseRaceInstance()
    {
        return new \Models\Bo\Results\HorseRace();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\Results\RaceInstanceTote
     */
    protected function getModelRaseInstanceTote()
    {
        return new \Models\Bo\Results\RaceInstanceTote();
    }

    /**
     * Returns an array with raceIds for the next/prev/last/first races depending on the
     * race_datetime of the current race.
     *
     * @return array
     * @throws Model\Resultset\ResultsetException
     */
    public function getRaceIds()
    {
        $races = $this->getModelRaceInstance()->getRaceIds($this->request->getRaceId());

        $raceIdArray = array (
          'first_race_id' => $races[0]->race_instance_uid ?? null,
          'last_race_id'  => end($races)->race_instance_uid ?? null,
          'prev_race_id'  => null,
          'next_race_id'  => null
        );

        foreach ($races as $race) {
            // We loop through all the races to determine which is the latest "prev_race_id"
            // the loop will keep updating until it reaches the latest race based on the below set condition.
            if ($race->race_datetime < $race->real_race_datetime) {
                $raceIdArray['prev_race_id'] = $race->race_instance_uid;
                // In the case we will retrieve the first race which is after "real_race_datetime" we break the loop
            } else if ($race->race_datetime > $race->real_race_datetime) {
                $raceIdArray['next_race_id'] = $race->race_instance_uid;
                break;
            }
        }

        return $raceIdArray;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\Results\Course
     */
    protected function getModelCourse()
    {
        return new \Models\Bo\Results\Course();
    }

    /**
     * Function sorts array of races in DESC order by race time.
     *
     * @param object $raceA
     * @param object $raceB
     *
     * @return int comparison result
     */
    private function sortRaces($raceA, $raceB)
    {
        return $raceA->race_datetime > $raceB->race_datetime ? 1 : -1;
    }

    /**
     * @return mixed
     */
    public function getCourses()
    {
        return $this->getModelCourse()->getCourses($this->request->getReturnP2P());
    }

    /**
     * Dividends and Spread make ups for meeting
     * The logic is ported from rp_h_411_get_dividends store procedure, which in turn uses sub_exact_dist_winner
     *
     * @param $raceDate
     * @param array $courses
     * @return array
     * @throws Model\Resultset\ResultsetException
     */
    public function getDividends($raceDate, array $courses)
    {
        $dividends = [];

        $data = $this->getModelRaceInstance()->getDividends($raceDate, $courses);

        if (!isset($data['races'])) {
            return $dividends;
        }

        foreach ($data['races'] as $course => $races) {
            $favoritesIndex   = 0.0;
            $totalRaceSP      = 0.0;
            $totalRaceWinDist = 0;
            $totalRaceDouble  = 0;

            foreach ($races as $race) {
                // Double race cards numbers
                $totalRaceDouble = $totalRaceDouble + $race->race_double;

                // Winning distance
                //case for one finished horse
                if ($race->finishing_horses == 1 && $race->horses_run > 1) {
                    if ($race->flat_or_jumps == Constants::SEASON_TYPE_CODE_JUMPS) {
                        $race->race_win_dist = 30;
                    } elseif ($race->flat_or_jumps == Constants::SEASON_TYPE_CODE_FLAT) {
                        $race->race_win_dist = 12;
                    }
                }

                if ($race->dht > 0) {
                    $race->race_win_dist = 0;
                }

                if ($race->race_win_dist > 30 && $race->flat_or_jumps == Constants::SEASON_TYPE_CODE_JUMPS) {
                    $race->race_win_dist = 30;
                } elseif ($race->race_win_dist > 12 && $race->flat_or_jumps == Constants::SEASON_TYPE_CODE_FLAT) {
                    $race->race_win_dist = 12;
                }

                $totalRaceWinDist = $totalRaceWinDist + $race->race_win_dist;

                // SP
                if ($race->race_sp_count) {
                    $totalRaceSP = $totalRaceSP + ($race->race_sp / $race->race_sp_count);
                } else {
                    $totalRaceSP = $totalRaceSP + 50.0;
                }

                // Favorites
                if ($race->horses_run > 1) {
                    $favoritesIndex = $this->getFavoriteIndex($race, $favoritesIndex);
                }
            }

            if (isset($data['meeting'][$course])) {
                $dividends[$course]['current_race_number']   = 0;
                $dividends[$course]['total_number_of_races'] = 0;
                $dividends[$course]['aggregate_sp']          = $totalRaceSP;
                $dividends[$course]['favorites_index']       = $favoritesIndex;
                $dividends[$course]['winning_distances']     = $totalRaceWinDist;
                $dividends[$course]['double_cards']          = $totalRaceDouble * 2;
            }
        }

        foreach ($data['meeting'] as $course => $row) {
            foreach ($row as $text) {
                if (isset($dividends[$course])) {
                    $dividends[$course]['betting_man']  = $text['betting_man'];
                    $dividends[$course]['analysis_man'] = $text['analysis_man'];
                    $dividends[$course]['close_up_man'] = $text['close_up_man'];
                }
            }
        }

        return $dividends;
    }

    /**
     * @param object $race
     * @param float  $favoritesIndex
     *
     * @return float
     */
    private function getFavoriteIndex(&$race, $favoritesIndex)
    {
        if ($race->race_favs_pos == 62) {
            return $favoritesIndex + 15;
        }

        if ($race->race_favs_count == 1) {
            if ($race->race_favs_pos == 1) {
                $favoritesIndex = $favoritesIndex + 25;
            } elseif ($race->race_favs_pos == 2) {
                $favoritesIndex = $favoritesIndex + 10;
            } elseif ($race->race_favs_pos == 3) {
                $favoritesIndex = $favoritesIndex + 5;
            }
        } elseif ($race->race_favs_count == 2) {
            if ($race->race_favs_pos == 1) {
                $favoritesIndex = $favoritesIndex + 17.5;
            } elseif ($race->race_favs_pos == 2) {
                $favoritesIndex = $favoritesIndex + 7.5;
            } elseif ($race->race_favs_pos == 3) {
                $favoritesIndex = $favoritesIndex + 2.5;
            }
        } elseif ($race->race_favs_count >= 3) {
            if ($race->race_favs_pos == 1) {
                $favoritesIndex = $favoritesIndex + (40 / $race->race_favs_count);
            } elseif ($race->race_favs_pos == 2) {
                $favoritesIndex = $favoritesIndex + (15 / $race->race_favs_count);
            } elseif ($race->race_favs_pos >= 3) {
                $favoritesIndex = $favoritesIndex + (5 / $race->race_favs_count);
            }
        }
        return $favoritesIndex;
    }

    /**
     * @return null|object
     */
    public function getSearchResult()
    {
        $rowsLimit = 100;
        $rowsLimitExceeded = false;

        $result = [];
        $races = $this->getModelRaceInstance()->getSearchResult($this->request, $rowsLimit + 20);

        if (sizeof($races) > $rowsLimit) {
            $rowsLimitExceeded = true;
        }

        foreach ($races as $race) {
            //Exclude incomplete results entered manually
            if ($race->formbook_yn !== 'Y'
                && $race->r_status === Constants::getConstantValue(Constants::RACE_STATUS_RESULTS)
                && $race->course_country !== 'GB'
                && $race->course_country !== 'IRE'
            ) {
                if ($race->no_of_runners === $race->no_of_runners_calculated) {
                    $race->formbook_yn = 'Y';
                    $result[] = $race;
                }
            } else {
                $result[] = $race;
            }
        }

        if ($rowsLimitExceeded === true) {
            if (sizeof($result) <= $rowsLimit) {
                $rowsLimitExceeded = false;
            } else {
                $result = array_slice($result, 0, $rowsLimit);
            }
        }

        return !empty($result) ? (Object)[
            'search_result' => $result,
            'number_of_rows_exceeded' => $rowsLimitExceeded,
        ] : null;
    }

    /**
     *
     * @return General
     */
    public function getDbi()
    {
        $result = null;
        $dbiData = $this->getModelRaceInstance()->getDbi($this->request->getRaceId());

        if (isset($dbiData)) {
            $lowInit = $dbiData['attributes']['lowInit'];
            $low = $dbiData['attributes']['low'];
            $highInit = $dbiData['attributes']['highInit'];
            $high = $dbiData['attributes']['high'];
            $runnersCnt = $dbiData['attributes']['runnersCnt'];

            $dbiSp = $dbiData['sp'];

            $maxAvg = 0;
            $maxRunners = 0;
            $lowPoints = 0;
            $midPoints = 0;
            $highPoints = 0;
            $lowSp = 0;
            $midSp = 0;
            $highSp = 0;
            $lowLowRange = 99;
            $midLowRange = 99;
            $highLowRange = 99;
            $lowHighRange = 0;
            $midHighRange = 0;
            $highHighRange = 0;
            $lowRunners = 0;
            $midRunners = 0;
            $highRunners = 0;

            foreach ($dbiSp as $dbiSpItem) {
                if ($dbiSpItem->position <= $lowInit) {
                    $points = $runnersCnt + 1 - $dbiSpItem->position + $lowInit + 1 - $dbiSpItem->position;
                    $maxAvg += $points;
                    $maxRunners++;
                } elseif ($dbiSpItem->position > $lowInit && $dbiSpItem->position <= $highInit) {
                    $points = $runnersCnt + 1 - $dbiSpItem->position;
                } else {
                    $points = 0;
                }

                if ($dbiSpItem->draw <= $low) {
                    $lowPoints += $points;
                    $lowSp += $dbiSpItem->percent;

                    if ($dbiSpItem->draw < $lowLowRange) {
                        $lowLowRange = $dbiSpItem->draw;
                    }
                    if ($dbiSpItem->draw > $lowHighRange) {
                        $lowHighRange = $dbiSpItem->draw;
                    }
                    if ($dbiSpItem->position < 99) {
                        $lowRunners++;
                    }
                } elseif ($dbiSpItem->draw > $high) {
                    $highPoints += $points;
                    $highSp += $dbiSpItem->percent;

                    if ($dbiSpItem->draw < $highLowRange) {
                        $highLowRange = $dbiSpItem->draw;
                    }
                    if ($dbiSpItem->draw > $highHighRange) {
                        $highHighRange = $dbiSpItem->draw;
                    }
                    if ($dbiSpItem->position < 99) {
                        $highRunners++;
                    }
                } else {
                    $midPoints += $points;
                    $midSp += $dbiSpItem->percent;

                    if ($dbiSpItem->draw < $midLowRange) {
                        $midLowRange = $dbiSpItem->draw;
                    }
                    if ($dbiSpItem->draw > $midHighRange) {
                        $midHighRange = $dbiSpItem->draw;
                    }
                    if ($dbiSpItem->position < 99) {
                        $midRunners++;
                    }
                }
            }

            $lowAvg = 0;
            $highAvg = 0;
            $totalAvg = 0;
            $lowRace = 0;
            $midRace = 0;
            $highRace = 0;

            if ($lowRunners > 0) {
                $lowAvg = round(($lowPoints * 1.0000) / ($lowRunners * 1.0000), 4);
            }
            if ($highRunners > 0) {
                $highAvg = round(($highPoints * 1.0000) / ($highRunners * 1.0000), 4);
            }
            if ($maxRunners > 0) {
                $totalAvg = round(($maxAvg * 1.0000) / ($maxRunners * 1.0000), 4);
            }
            if ($totalAvg > 0) {
                $lowRace = floor(round(($lowAvg / $totalAvg) * 100.0000, 0));
                $highRace = floor(round(($highAvg / $totalAvg) * 100.0000, 0));
                $midRace = 150 - ($lowRace + $highRace);
            }

            $totalSp = $lowSp + $midSp + $highSp;

            $lowSp = (int)floor(round($lowSp * (100.000 / $totalSp), 0));
            $highSp = (int)floor(round($highSp * (100.000 / $totalSp), 0));
            $midSp = (int)100 - ($lowSp + $highSp);

            $dbi = [
                'low_low_range' => $lowLowRange,
                'low_high_range' => $lowHighRange,
                'low_race' => $lowRace,
                'low_sp' => $lowSp,

                'mid_low_range' => $midLowRange,
                'mid_high_range' => $midHighRange,
                'mid_race' => $midRace,
                'mid_sp' => $midSp,

                'high_low_range' => $highLowRange,
                'high_high_range' => $highHighRange,
                'high_race' => $highRace,
                'high_sp' => $highSp,
            ];

            $result = General::createFromArray($dbi);
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getWinningTimes()
    {
        $rows = $this->getModelRaceInstance()->getWinningTimes($this->request);

        foreach ($rows as $row) {
            $row->winners_time_secs_per_furlong = $this->getValuesPerFurlong(
                $row->winners_time_secs,
                $row->distance_yard
            );

            $row->time_comparison_per_furlong = $this->getValuesPerFurlong(
                $row->time_comparison,
                $row->distance_yard
            );

            $row->rp_going_type_desc = implode(
                '-',
                array_map('ucwords', explode('-', strtolower($row->rp_going_type_desc)))
            );

            $this->goingCorrectionProcessing($row);
        }
        return $rows;
    }

    /**
     * @param mixed $value
     * @param int   $distanceYard
     *
     * @return null|float
     */
    private function getValuesPerFurlong($value, $distanceYard)
    {
        if (!is_null($value) && $distanceYard > 0) {
            return $value / ($distanceYard / 220);
        }
        return null;
    }

    /**
     * @param object $row
     */
    private function goingCorrectionProcessing($row)
    {
        $correctionMap = [
            'F' => [
                'going_correction' => 5,
                'default' => 'Heavy',
                'all' => [
                    [0.81, 'Hard'],
                    [0.51, 'FirmX'],
                    [0.21, 'Gd-Fm'],
                    [-0.20, 'Good'],
                    [-0.70, 'Gd-Sft'],
                    [-1.15, 'Soft']
                ]
            ],
            'X' => [
                'going_correction' => 5,
                'default' => 'Slow',
                'all' => [
                    [0.40, 'Fast'],
                    [-0.39, 'Stand']
                ]
            ],
            'jumps' => [
                'going_correction' => 16,
                'default' => 'Heavy',
                'all' => [
                    [0.96, 'Hard'],
                    [0.71, 'Firm'],
                    [0.41, 'Gd-Fm'],
                    [-0.50, 'Good'],
                    [-0.99, 'Gd-Sft'],
                    [-1.50, 'Soft']
                ]
            ],
        ];

        if (is_null($row->rp_going_correction)) {
            return;
        }
        $type = (array_key_exists($row->race_type_code, $correctionMap))
            ? $row->race_type_code
            : Constants::RACE_TYPE_JUMPS_ALIAS;
        $corrections = $correctionMap[$type];

        if ($corrections['going_correction'] == 0) {
            return;
        }
        $row->rp_going_correction = $row->rp_going_correction / $corrections['going_correction'];
        $row->rp_going_correction_desc = $corrections['default'];

        foreach ($corrections['all'] as $map) {
            if ($row->rp_going_correction >= $map[0]) {
                $row->rp_going_correction_desc = $map[1];
                break;
            }
        }
    }

    /**
     * @return object
     */
    public function addNextRun()
    {
        $fakeForm = [0 => 1];
        $nextRunRaces = $this->getModelRaceInstance()->getNextRun($fakeForm, [$this->request->getRaceId()]);

        if (empty($nextRunRaces)) {
            return null;
        }

        $nextRunObject = new \stdClass();
        foreach ($nextRunRaces as $race) {
            $nextRunRace = null;
            $firstThree = null;
            $other = null;

            if (isset($race[0])) {
                $nextRunRace = $race[0];

                $firstThree = (object)[
                    'wins' => $nextRunRace->first_3_wins,
                    'placed' => $nextRunRace->first_3_placed,
                    'unplaced' => $nextRunRace->first_3_unplaced,
                ];
                $other = (object)[
                    'wins' => $nextRunRace->other_wins,
                    'placed' => $nextRunRace->other_placed,
                    'unplaced' => $nextRunRace->other_unplaced,
                ];

                $nextRunObject->first_three = $firstThree;
                $nextRunObject->other = $other;
                $nextRunObject->hot_race = $nextRunRace['hot_race'];
                $nextRunObject->cold_race = $nextRunRace['cold_race'];
                $nextRunObject->average_race =
                    ($nextRunRace['hot_race'] == 0 && $nextRunRace['cold_race'] == 0) ? 1 : 0;
            }
        }

        return $nextRunObject;
    }

    /**
     * @return DataProviderPastWinners|null
     */
    protected function getDataProviderPastWinners()
    {
        if (is_null($this->dataProviderPastWinners)) {
            $this->dataProviderPastWinners = new DataProviderPastWinners();
        }

        return $this->dataProviderPastWinners;
    }

    /**
     * @return array|null
     * @throws \Api\Exception\ValidationError
     */
    public function getPastWinners()
    {
        $raceId = $this->request->getRaceId();
        $lastYearRaces = (new \Bo\LastYearRaces([$raceId]))->getPastRacesIDs(self::PAST_RACES_LIMIT);
        if (empty($lastYearRaces)) {
            return null;
        }

        return $this->getDataProviderPastWinners()->getPastWinners(array_keys($lastYearRaces));
    }

    /**
     * @param SalesData $request
     *
     * @return array
     */
    public function getResultsSalesData(SalesData $request)
    {
        $salesData = $this->getModelRaceInstance()->getResultsSalesData($request->getRaceId());

        if (empty($salesData)) {
            return null;
        }

        $modelHorse = new \Models\Bo\HorseProfile\Horse();
        $sales = $modelHorse->getSales(array_keys($salesData));

        foreach ($salesData as $horse) {
            $horse->sales_info = isset($sales[$horse->horse_uid]) ? $sales[$horse->horse_uid]['sales'] : null;
        }

        return $salesData;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\RaceCards\Runners
     */
    protected function getModelRunners()
    {
        return new \Models\Bo\RaceCards\Runners();
    }
}
