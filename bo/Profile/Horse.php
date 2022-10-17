<?php

namespace Bo\Profile;

use Bo\RaceCards\Runners;
use Phalcon\Mvc\Model;
use Api\Input\Request\HorsesRequest as Request;
use \Api\Constants\Horses as Constants;

/**
 * Class HorseProfile
 *
 * @package \Bo
 */
class Horse extends \Bo\BoWithFigures
{
    use \Api\Bo\Traits\AddVideoDetails;
    use \Api\Bo\Traits\CompareEntities;

    const STABLE_TOURS_NOTES_LIMIT = 2;
    const LINE_TYPE_STAKE = 'S';
    const LINE_TYPE_RULES_RACES = 'A';

    /**
     * @var int
     */
    private $horseId;

    /**
     * @param integer $horseId
     *
     * @throws \Api\Exception\InternalServerError
     */
    public function __construct($horseId)
    {
        if (!is_numeric($horseId) || $horseId <= 0) {
            throw new \Api\Exception\InternalServerError(3);
        }

        $this->horseId = $horseId;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\HorseProfile\Horse
     */
    protected function getModelHorse()
    {
        return new \Models\Bo\HorseProfile\Horse();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\HorseProfile\RaceInstance|RaceInstance
     */
    protected function getModelRaceInstance()
    {
        return new \Models\Bo\HorseProfile\RaceInstance();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\HorseProfile\HorseRace|HorseRace
     */
    protected function getModelHorseRace()
    {
        return new \Models\Bo\HorseProfile\HorseRace();
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Models\Bo\HorseProfile\PreHorseRace
     */
    protected function getModelPreHorseRace()
    {
        return new \Models\Bo\HorseProfile\PreHorseRace();
    }

    /**
     * @param Request $request
     * @param $returnP2P

     * @return array|null
     * @throws Model\Resultset\ResultsetException
     */
    public function getEntries(Request $request, $returnP2P = false)
    {
        $entries = $this->getModelRaceInstance()->getEntries($request, $returnP2P);

        if ($entries) {
            //Get jockey_uids from entries and skip null values
            $jockeyIds = [];
            foreach ($entries as $entry) {
                if (!empty($entry->jockey_uid)) {
                    $jockeyIds[] = $entry->jockey_uid;
                }
            }

            $jockeyStat = [];

            if (!empty($jockeyIds)) {
                $jockeyStat = $this->getModelHorseRace()->getJockeyStats14Days($jockeyIds);
            }

            $emptyStatObj = new \Api\Row\WinsRuns();
            $emptyStatObj->runs = 0;
            $emptyStatObj->wins = 0;

            $runnersBo = new \Models\Bo\RaceCards\Runners();
            foreach ($entries as $entry) {
                $entry->jockey_last_14_days = array_key_exists($entry->jockey_uid, $jockeyStat) ?
                    $jockeyStat[$entry->jockey_uid] : $emptyStatObj;

                $entry->days_since_last_run = null;
                $entry->days_since_last_run_flat = null;
                $entry->days_since_last_run_jumps = null;
                $entry->days_since_last_run_ptp = null;

                // Business requirement: we need to only show days since last run for races with status code "O"
                if ($entry->race_status_code == Constants::RACE_STATUS_OVERNIGHT_STR) {
                    $raceDate = new \DateTime($entry->race_datetime);
                    $horseId = $request->getHorseId();
                    $daysSinceLastRun = $runnersBo->getDaysSinceLastRun(
                        $horseId,
                        $raceDate->format('Y-m-d')
                    );
                    $currentRaceType = Constants::RACE_TYPE_JUMPS_ALIAS;

                    if (property_exists($entry, 'race_type_code') &&
                        strpos(Constants::RACE_TYPE_FLAT, $entry->race_type_code) !== false) {
                        $currentRaceType = Constants::RACE_TYPE_FLAT_ALIAS;
                    }
                    if (property_exists($entry, 'race_type_code') &&
                        strpos(Constants::RACE_TYPE_P2P, $entry->race_type_code) !== false) {
                        $currentRaceType = Constants::RACE_TYPE_P2P_ALIAS;
                    }

                    if (property_exists($entry, 'race_group_uid') &&
                        in_array($entry->race_group_uid, Constants::$groupClassRaces) ||
                        property_exists($entry, 'country_code') &&
                        in_array(trim($entry->country_code), ['HK', 'GB', 'IRE'])
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
                            $entry->days_since_last_run = $minDaysObj->days_since_run;
                        } else {
                            if (!is_null($curTypeDaysObj)) {
                                $entry->days_since_last_run = $curTypeDaysObj->days_since_run;
                            }
                            $entry->{'days_since_last_run_' . $minDaysObj->race_type_code} = $minDaysObj->days_since_run;
                        }
                    }
                }
            }
        }
        return $entries;
    }

    /**
     * @param array $raceType
     *
     * @return array
     * @throws \Exception
     */
    public function getStatistics(array $raceTypeCodes)
    {
        return $this->getModelRaceInstance()->getStatistics($this->horseId, $raceTypeCodes);
    }

    /**
     * @return array | null
     */
    public function getWins()
    {
        $modelRI = $this->getModelRaceInstance();
        $modelRI->dropHorsesUidsTmpTables();
        $modelRI->createHorsesIdTables(0, $this->horseId);
        $wins = $modelRI->getWins();
        $modelRI->dropHorsesUidsTmpTables();
        $this->addVideoDetails($wins[$this->horseId]->races);

        return empty($wins[$this->horseId]->races) ? null : $wins[$this->horseId]->races;
    }

    /**
     * @param $returnP2P
     *
     * @return array | null
     */
    public function getForm($returnP2P = false)
    {
        $modelRI = $this->getModelRaceInstance();
        $modelRI->dropHorsesUidsTmpTables();
        $modelRI->createHorsesIdTables(0, $this->horseId);
        $ptpGbFlag = $returnP2P && !empty($modelRI->getPtpGbHorses());

        $form = $modelRI->getForm($ptpGbFlag, $returnP2P);

        if (!empty($form[$this->horseId]->races)) {
            $this->addVideoDetails($form[$this->horseId]->races);
            $raceTactics = $modelRI->getRaceTactics($this->horseId, array_keys($form[$this->horseId]->races));
            foreach ($form[$this->horseId]->races as $raceId => &$race) {
                $race->race_tactics = (Object)[
                    'actual' => [
                        'runner_attrib_type' => null,
                        'runner_attrib_description' => null
                    ],
                    'predicted' => [
                        'runner_attrib_type' => null,
                        'runner_attrib_description' => null
                    ]
                ];

                if (isset($raceTactics[$raceId])) {
                    $category = $raceTactics[$raceId]->predicted_yn == 'Y' ? 'predicted' : 'actual';

                    $race->race_tactics->{$category} = [
                        'runner_attrib_type' => $raceTactics[$raceId]->runner_attrib_type,
                        'runner_attrib_description' => $raceTactics[$raceId]->runner_attrib_description
                    ];
                }
            }

            unset($race);
        }
        $modelRI->dropHorsesUidsTmpTables();

        return empty($form[$this->horseId]->races) ? null : $form[$this->horseId]->races;
    }

    /**
     * @return array | null
     */
    public function getMyRatings()
    {
        $modelRI = $this->getModelRaceInstance();
        $modelRI->dropHorsesUidsTmpTables();
        $modelRI->createHorsesIdTables(0, $this->horseId);
        $myRatings = $modelRI->getMyRatings($this->horseId);
        $modelRI->dropHorsesUidsTmpTables();
        $this->addVideoDetails($myRatings[$this->horseId]->races);

        return empty($myRatings[$this->horseId]->races) ? null : $myRatings[$this->horseId]->races;
    }

    /**
     * It is stub data
     *
     * @codeCoverageIgnore
     *
     * @return array
     */
    public function getMyNotes()
    {
        $id = intval($this->horseId);

        return [
            (Object)[
                'reg_id' => 1094646,
                'horse_uid' => $id,
                'race_type' => 'F',
                'comment' => 'test F',
                'rating' => 0,
                'rating_flag' => null
            ],
            (Object)[
                'reg_id' => 1094646,
                'horse_uid' => $id,
                'race_type' => 'X',
                'comment' => 'test X',
                'rating' => 100,
                'rating_flag' => null
            ],
            (Object)[
                'reg_id' => 1094646,
                'horse_uid' => $id,
                'race_type' => 'H',
                'comment' => 'test H',
                'rating' => 0,
                'rating_flag' => null
            ],
            (Object)[
                'reg_id' => 1094646,
                'horse_uid' => $id,
                'race_type' => 'C',
                'comment' => 'test C',
                'rating' => 0,
                'rating_flag' => null
            ]
        ];
    }


    /**
     * @return object
     */
    public function getPedigree()
    {

        $horses = $this->getModelHorse()->getHorseDataForPedigree(
            [$this->horseId]
        );

        $result = isset($horses[$this->horseId]) ? $horses[$this->horseId]
            : null;

        if (!$result) {
            throw new \Api\Exception\NotFound(3101);
        }

        return $this->getPedigreeToLevel($result, 2);
    }

    /**
     * @param array $pedigree
     * @param int   $level
     *
     * @return array mixed
     */
    private function getPedigreeToLevel($pedigree, $level)
    {

        $horses = $this->getModelHorse()->getHorseDataForPedigree(
            [$pedigree->sire_uid, $pedigree->dam_uid]
        );

        $pedigree->dam = isset($horses[$pedigree->dam_uid])
            ? $horses[$pedigree->dam_uid] : null;
        $pedigree->sire = isset($horses[$pedigree->sire_uid])
            ? $horses[$pedigree->sire_uid] : null;

        if ($level > 1) {
            --$level;
            if ($pedigree->dam) {
                $pedigree->dam = $this->getPedigreeToLevel(
                    $pedigree->dam,
                    $level
                );
            }
            if ($pedigree->sire) {
                $pedigree->sire = $this->getPedigreeToLevel(
                    $pedigree->sire,
                    $level
                );
            }
        }

        return $pedigree;
    }

    /**
     * @return \Api\Row\Horse
     * @throws \Api\Exception\NotFound
     */
    public function getHorseData() : \Api\Row\Horse
    {
        $horse = $this->getModelHorse()->getHorseDataForProfile($this->horseId);

        if (empty($horse)) {
            throw new \Api\Exception\NotFound(3101);
        }

        return $horse;
    }

    /**
     * @return \Api\Row\Horse
     * @throws Model\Resultset\ResultsetException
     * @throws \Api\Exception\NotFound
     */
    public function getProfile() : \Api\Row\Horse
    {
        $horse = $this->getHorseData();

        $horse->to_follow = $this->getModelHorse()->getToFollow($this->horseId);

        $horse->tips = $this->getModelPreHorseRace()->getTips($this->horseId);

        $horse->comments = $this->getModelPreHorseRace()->getComments($this->horseId);

        $horse->trainer_last_14_days = $this->getModelHorseRace()->getStatsLast14Days($horse->trainer_uid, 'trainer');

        $horse->previous_trainers = $this->getPreviousTrainers($horse);

        $horse->previous_owners = $this->getPreviousOwners($horse);

        $horse->stud_fee = $this->getStudFee();

        return $horse;
    }

    /**
     * @param \Api\Row\Horse $horse
     * @return array|null
     * @throws Model\Resultset\ResultsetException
     */
    private function getPreviousTrainers(\Api\Row\Horse $horse)
    {
        $trainers = $this->getModelHorseRace()->getPreviousTrainers($this->horseId);
        $result = null;

        if (!empty($trainers)) {
            $prevTrainer = $trainers[0];

            if (!$this->isSameEntity($prevTrainer, $horse, 'trainer')) {
                $result[] = $prevTrainer;
            }

            foreach ($trainers as $trainer) {
                if ($prevTrainer->trainer_uid != $trainer->trainer_uid
                    && !$this->isSameEntity($prevTrainer, $trainer, 'trainer')
                ) {
                    $result[] = $trainer;
                    $prevTrainer = $trainer;
                }
            }

            //In case there are no previous trainers we need to create additional check
            if (isset($result)) {
                usort($result, function ($a, $b) {
                    return strtotime($b->trainer_change_date) - strtotime($a->trainer_change_date);
                });
            }
        }

        return $result;
    }

    /**
     * @param \Api\Row\Horse $horse
     * @return array|null
     * @throws Model\Resultset\ResultsetException
     */
    private function getPreviousOwners(\Api\Row\Horse $horse)
    {
        $owners = $this->getModelHorseRace()->getPreviousOwners($this->horseId);
        $result = null;

        if (!empty($owners)) {
            $prevOwner = $owners[0];

            if (!$this->isSameEntity($prevOwner, $horse, 'owner')) {
                $result[] = $prevOwner;
            }

            foreach ($owners as $owner) {
                if ($prevOwner->owner_uid != $owner->owner_uid && !$this->isSameEntity($prevOwner, $owner, 'owner')) {
                    $result[] = $owner;
                    $prevOwner = $owner;
                }
            }

            //In case there are no previous owners we need to create additional check
            if (isset($result)) {
                usort($result, function ($a, $b) {
                    return strtotime($b->owner_change_date) - strtotime($a->owner_change_date);
                });
            }
        }

        return $result;
    }

    /**
     * @return array|null
     */
    private function getStudFee()
    {
        $stallionYear = intval(date('Y'));
        if (date('m') == '12') {
            $stallionYear += 1;
        }

        $fees = $this->getModelHorse()->getStudFee($this->horseId);

        $result = null;
        if (!empty($fees)) {
            //Get fees for current and next year
            $result = array_filter($fees, function ($fee) use ($stallionYear) {
                return $fee->nomination_year == $stallionYear || $fee->nomination_year == $stallionYear + 1;
            });

            //If there are no fees for current or next year, we have to return the latest existing fee
            if (empty($result)) {
                $result[] = $fees[0];
            }
        }

        return $result;
    }

    /**
     * @return \Api\Row\Horse
     * @throws \Api\Exception\NotFound
     */
    public function getProfileForIndex()
    {
        $horse = $this->getModelHorse()->getHorseDataForProfileInIndex($this->horseId);

        if (!$horse) {
            throw new \Api\Exception\NotFound(3101);
        }

        return $horse;
    }

    /**
     * @param $returnP2P
     *
     * @return object
     * @throws Model\Exception
     * @throws \Exception
     */
    public function getRaceRecord($returnP2P)
    {
        $placings = $this->getPlacings($returnP2P);

        $data = [
            'lifetime_records' => $this->getLifetimeRecords($returnP2P),
            'flat_placings' => empty($placings->flatPlacings) ? null : $placings->flatPlacings,
            'jumps_placings' => empty($placings->jumpsPlacings) ? null : $placings->jumpsPlacings,
            'flat_figures_calculated' => $this->getCalculatedFigures(Constants::RACE_TYPE_FLAT_ALIAS, $returnP2P),
            'jumps_figures_calculated' => $this->getCalculatedFigures(Constants::RACE_TYPE_JUMPS_ALIAS, $returnP2P),
            'surface_record' => $this->getSurfaceRecords($returnP2P)
        ];

        array_walk_recursive(
            $data,
            function (&$val) {
                if (is_float($val)) {
                    $val = round($val, 2);
                }
            }
        );

        return (object)$data;
    }

    /**
     * @param $raceTypeName
     * @param $returnP2P
     *
     * @return array|null
     */
    protected function getCalculatedFigures($raceTypeName, $returnP2P)
    {
        // Season start date in figures is start date of seasons of racecard, not season of race of figure.
        $seasons = $this->getSeasonsForFigures($raceTypeName);

        $forms = $this->getFormForFigures(
            [$this->horseId],
            $raceTypeName,
            null,
            $returnP2P
        );

        return !empty($forms[$this->horseId]) ? $this->getFiguresArray(
            $forms[$this->horseId],
            $seasons
        ) : null;
    }

    /**
     * @param $returnP2P
     *
     * @throws \Exception
     *
     * @return array | null
     */
    private function getLifetimeRecords($returnP2P)
    {
        $result = [];

        foreach ($this->getModelHorseRace()->getLifetimeRecordsData($this->horseId, $returnP2P) as $horseRace) {
            $result = $this->joinDataToLifetimeRecords($result, $horseRace);

            if ($horseRace->isFlatRace()
                && in_array(
                    $horseRace->race_group_uid,
                    [7, 8, 9, 1, 2, 3, 4, 5, 11, 12, 13, 14, 15, 16]
                )
            ) {
                $horseRaceClone = clone $horseRace;
                $result = $this->joinDataToLifetimeRecords(
                    $result,
                    $horseRaceClone,
                    \Api\Row\HorseRace::getLifetimeNameForLineType(self::LINE_TYPE_STAKE)
                );
            }

            if (($horseRace->race_type_code != Constants::getConstantValue(Constants::RACE_TYPE_P2P)
                    || $horseRace->country_code != 'GB')
                && $horseRace->getLineType() != Constants::getConstantValue(Constants::RACE_TYPE_P2P)
            ) {
                $horseRaceClone = clone $horseRace;
                $horseRaceClone->current_official_turf_rating = 0;
                $horseRaceClone->current_official_aw_rating = 0;
                $horseRaceClone->current_official_rating_hurdle = 0;
                $horseRaceClone->current_official_rating_chase = 0;
                $result = $this->joinDataToLifetimeRecords(
                    $result,
                    $horseRaceClone,
                    \Api\Row\HorseRace::getLifetimeNameForLineType(self::LINE_TYPE_RULES_RACES)
                );
            }
        }

        return empty($result) ? null : $result;
    }

    /**
     * @throws Model\Resultset\ResultsetException
     */
    public function getSurfaceRecords($returnP2P): array
    {
        return $this->getModelHorseRace()->getSurfaceRecordsRunsWins($this->horseId, $returnP2P);
    }


    /**
     * @param array              $result
     * @param \Api\Row\HorseRace $horseRace
     * @param null|string        $lifetimeName
     *
     * @return array
     * @throws Exception
     */
    private function joinDataToLifetimeRecords(
        array $result,
        \Api\Row\HorseRace $horseRace,
        $lifetimeName = null
    ) {

        $lifetimeName = $lifetimeName ?: $horseRace->getLifetimeName();

        if (!isset($result[$lifetimeName])) {
            $result[$lifetimeName] = [
                'starts' => 0,
                'wins' => 0,
                '2nds' => 0,
                '3rds' => 0,
                'winnigs' => 0,
                'earnings' => 0,
                'total_prize' => 0,
                'win_prize' => 0,
                'net_total_prize' => 0,
                'net_win_prize' => 0,
                'euro_win_prize' => 0,
                'euro_total_prize' => 0,
                'usd_win_prize' => 0,
                'usd_total_prize' => 0,
                'best_ts' => 0,
                'best_rpr' => 0,
                'or+' => 0,
                'stake' => 0,
            ];
        }

        ++$result[$lifetimeName]['starts'];

        $result[$lifetimeName]['stake'] += $horseRace->stake;

        if ($horseRace->race_outcome_position == 1) {
            ++$result[$lifetimeName]['wins'];
        }

        if ($horseRace->race_outcome_position == 2) {
            ++$result[$lifetimeName]['2nds'];
        }
        if ($horseRace->race_outcome_position == 3) {
            ++$result[$lifetimeName]['3rds'];
        }

        $result[$lifetimeName]['total_prize'] += $horseRace->prize_sterling;
        $result[$lifetimeName]['win_prize'] += $horseRace->win_prize_sterling;
        $result[$lifetimeName]['net_total_prize'] += $horseRace->net_total_prize;
        $result[$lifetimeName]['net_win_prize'] += $horseRace->net_win_prize;
        $result[$lifetimeName]['euro_win_prize'] += $horseRace->win_prize_euro;
        $result[$lifetimeName]['euro_total_prize'] += $horseRace->prize_euro;
        $result[$lifetimeName]['usd_win_prize'] += $horseRace->usd_win_prize;
        $result[$lifetimeName]['usd_total_prize'] += $horseRace->usd_total_prize;

        // Just for back compatibility
        $result[$lifetimeName]['earnings'] = $result[$lifetimeName]['total_prize'];
        $result[$lifetimeName]['winnigs'] = $result[$lifetimeName]['win_prize'];

        if ($lifetimeName
            != \Api\Row\HorseRace::getLifetimeNameForLineType(self::LINE_TYPE_RULES_RACES)
        ) {
            $result[$lifetimeName]['best_ts'] = max(
                $result[$lifetimeName]['best_ts'],
                $horseRace->rp_topspeed
            );
            $result[$lifetimeName]['best_rpr'] = max(
                $result[$lifetimeName]['best_rpr'],
                $horseRace->rp_postmark
            );
        }

        switch ($horseRace->getLineType()) {
            case 'F':
                $result[$lifetimeName]['or+'] = max(
                    $result[$lifetimeName]['or+'],
                    $horseRace->current_official_turf_rating
                );
                $result[$lifetimeName]['latest_bhb'] = $horseRace->current_official_turf_rating;
                break;
            case 'X':
                $result[$lifetimeName]['or+'] = max(
                    $result[$lifetimeName]['or+'],
                    $horseRace->current_official_aw_rating
                );
                $result[$lifetimeName]['latest_bhb'] = $horseRace->current_official_aw_rating;
                break;
            case 'H':
                $result[$lifetimeName]['or+'] = max(
                    $result[$lifetimeName]['or+'],
                    $horseRace->current_official_rating_hurdle
                );
                $result[$lifetimeName]['latest_bhb'] = $horseRace->current_official_rating_hurdle;
                break;
            case 'C':
                $result[$lifetimeName]['or+'] = max(
                    $result[$lifetimeName]['or+'],
                    $horseRace->current_official_rating_chase
                );
                $result[$lifetimeName]['latest_bhb'] = $horseRace->current_official_rating_chase;
                break;
        }

        return $result;
    }

    /**
     * @param string $noteTypeCode
     * @param bool $shouldAddHorseName
     * @param bool $shouldRemoveRaceTime
     * @return array|null
     * @throws Model\Resultset\ResultsetException
     */
    public function getNotes(
        string $noteTypeCode,
        bool $shouldAddHorseName = false,
        bool $shouldRemoveRaceTime = false
    ) {
        $notes = $this->getModelRaceInstance()->getNotes($this->horseId, $noteTypeCode);

        if ($shouldRemoveRaceTime) {
            $notes = $this->clearRaceTimeFromNotes($notes);
        }

        if ($shouldAddHorseName) {
            $notes = $this->addHorseNameToNotes($notes);
        }

        return empty($notes) ? null : $notes;
    }

    /**
     * We need to remove race time from the notes. If we have race time in the note it will looks like \b(3.20)\p
     *
     * @param array $notes
     * @return array
     */
    private function clearRaceTimeFromNotes(array $notes): array
    {
        foreach ($notes as $note) {
            $note->notes = preg_replace('/\\\b\(\d+\.\d+\)\\\p/', '', $note->notes);
        }
        return $notes;
    }

    /**
     * For some note types horse name is missing, so we need to add it at beginning of the note
     *
     * @param array $notes
     * @return array
     */
    private function addHorseNameToNotes(array $notes): array
    {
        foreach ($notes as $note) {
            // In case the first symbol is not ',' or interval, we need to add interval after the name
            $nameSuffix = !in_array($note->notes[0], [',', ' ']) ? ' ' : '';
            $note->notes = $note->horse_style_name . $nameSuffix . $note->notes;
        }
        return $notes;
    }

    /**
     * @param callable $funcCheckType
     * @param $returnP2P
     *
     * @return array
     * @throws Model\Exception
     */
    private function getPlacings($returnP2P)
    {
        $result = (Object)[
            'flatPlacings' => [],
            'jumpsPlacings' => []
        ];

        foreach ($this->getModelHorseRace()->getHorseRacesForPlacings($this->horseId, $returnP2P) as $horseRace) {
            $year = intval(date('Y', strtotime($horseRace->season_start_date)));

            if ($horseRace->isFlatRace()) {
                $raceTypePlacings = &$result->flatPlacings;
            } elseif ($horseRace->isJumpRace()) {
                $raceTypePlacings = &$result->jumpsPlacings;
            }

            if ($horseRace->isFlatRace() || $horseRace->isJumpRace()) {
                !isset($raceTypePlacings[$year]) && ($raceTypePlacings[$year] = []);
                $raceTypePlacings[$year][] = $horseRace->getOutcomePositionForPlacings();
            }
        }

        return $result;
    }

    /**
     * @return array | null
     * @throws \Api\Exception\NotFound
     */
    public function getSales()
    {
        $salesObject = $this->getModelHorse()->getSales([$this->horseId]);
        $sales = $salesObject[$this->horseId]['sales'];
        return empty($sales) ? null : $sales;
    }

    /**
     * @return array
     * @throws \Api\Exception\InternalServerError
     * @throws \Api\Exception\NotFound
     */
    public function getRelatives()
    {
        return $this->getModelHorse()->getRelatives($this->horseId);
    }

    /**
     * @return array|null
     */
    public function getStableTourQuotes()
    {
        $stableTourQuotes = $this->getModelRaceInstance()->getStableTourQuotes($this->horseId);
        $this->limitStableToursNotes($stableTourQuotes, self::STABLE_TOURS_NOTES_LIMIT);

        return empty($stableTourQuotes) ? null : $stableTourQuotes;
    }
}
