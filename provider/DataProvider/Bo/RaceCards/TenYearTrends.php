<?php

namespace Api\DataProvider\Bo\RaceCards;

use Api\Mvc\DataProvider\BuilderBasedTemporaryTable as TmpBuilder;
use Phalcon\Db\Sql\Builder;
use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;
use \Api\Row\RaceInstance as RiRow;
use \Phalcon\Mvc\Model\Resultset\ResultsetException;
use \Api\Exception\ValidationError;

/**
 * Class TenYearTrends
 *
 * @package Api\DataProvider\Bo\RaceCards
 */
class TenYearTrends extends HorsesDataProvider
{
    const RPR_MIN_DATE = '2 June 1998';
    const RPR_MIN_AGE = 2;
    const RPR_MAX_AGE = 20;

    /**
     * Temporary table base names
     */
    const TMP_TABLE_BASE_NAME_LY_RACES = 'lastYearsRaces';
    const TMP_TABLE_BASE_NAME_LY_WIN_RACES = 'lastYearsWinRaces';
    const TMP_TABLE_BASE_NAME_RACE_TRAINERS = 'raceTrainers';
    const TMP_TABLE_BASE_NAME_PAST_TRAINERS = 'pastTrainers';
    const TMP_TABLE_BASE_NAME_RACE_JOCKEYS = 'raceJockeys';
    const TMP_TABLE_BASE_NAME_PAST_JOCKEYS = 'pastJockeys';

    /**
     * @var int
     */
    private $raceId = 0;

    /**
     * @var string
     */
    private $raceGroup;

    /**
     * @var array
     */
    private $lastRacesIDs = [];

    /**
     * Temporary table objects
     *
     * @var TmpBuilder
     */
    private $tmpTableLastYearsRaces;
    /**
     * @var TmpBuilder
     */
    private $tmpTableLastYearsWinRaces;
    /**
     * @var TmpBuilder
     */
    private $tmpTableRaceTrainers;
    /**
     * @var TmpBuilder
     */
    private $tmpTablePastTrainers;
    /**
     * @var TmpBuilder
     */
    private $tmpTableRaceJockeys;
    /**
     * @var TmpBuilder
     */
    private $tmpTablePastJockeys;

    /**
     * TenYearTrends constructor.
     *
     * @param int $raceId
     *
     * @throws ResultsetException
     */
    public function __construct(int $raceId)
    {
        $this->setRaceId($raceId);
        $raceInfo = $this->getRaceInfo();

        if (!is_null($raceInfo)) {
            $this->setRaceGroup($raceInfo->race_group_code);
        } else {
            $this->setRaceId(0);
        }
    }

    /**
     * @return int
     */
    public function getRaceId(): ?int
    {
        return $this->raceId;
    }

    /**
     * @param int $raceId
     */
    protected function setRaceId(?int $raceId): void
    {
        $this->raceId = $raceId;
    }

    /**
     * @return null|string
     */
    public function getRaceGroup(): ?string
    {
        return $this->raceGroup;
    }

    /**
     * @param null|string $raceGroup
     */
    protected function setRaceGroup(?string $raceGroup): void
    {
        $this->raceGroup = $raceGroup;
    }

    /**
     * @return array
     */
    public function getLastRacesIDs(): ?array
    {
        return $this->lastRacesIDs;
    }

    /**
     * @param array $lastRacesIDs
     */
    public function setLastRacesIDs($lastRacesIDs): void
    {
        $this->lastRacesIDs = $lastRacesIDs;
    }


    /**
     * @return TmpBuilder|null
     */
    public function getTmpTableLastYearsRaces(): ?TmpBuilder
    {
        if (!isset($this->tmpTableLastYearsRaces)) {
            $this->tmpTableLastYearsRaces = $this->crateLastYearsRaces();
        }
        return $this->tmpTableLastYearsRaces;
    }

    /**
     * @return TmpBuilder|null
     */
    protected function getTmpTableLastYearsWinRaces(): ?TmpBuilder
    {
        if (!isset($this->tmpTableLastYearsWinRaces)) {
            $this->tmpTableLastYearsWinRaces = $this->crateLastYearsWinRaces();
        }
        return $this->tmpTableLastYearsWinRaces;
    }

    /**
     * @return TmpBuilder|null
     */
    protected function getTmpTableRaceTrainers(): ?TmpBuilder
    {
        if (!isset($this->tmpTableRaceTrainers)) {
            $this->tmpTableRaceTrainers = $this->crateRaceTrainers();
        }
        return $this->tmpTableRaceTrainers;
    }

    /**
     * @return TmpBuilder|null
     * @throws ValidationError
     */
    protected function getTmpTablePastTrainers(): ?TmpBuilder
    {
        if (!isset($this->tmpTablePastTrainers)) {
            $this->tmpTablePastTrainers = $this->createPastTrainers();
        }
        return $this->tmpTablePastTrainers;
    }

    /**
     * @return TmpBuilder|null
     */
    protected function getTmpTableRaceJockeys(): ?TmpBuilder
    {
        if (!isset($this->tmpTableRaceJockeys)) {
            $this->tmpTableRaceJockeys = $this->createRaceJockeys();
        }
        return $this->tmpTableRaceJockeys;
    }

    /**
     * @return TmpBuilder|null
     * @throws ValidationError
     */
    protected function getTmpTablePastJockeys(): ?TmpBuilder
    {
        if (!isset($this->tmpTablePastJockeys)) {
            $this->tmpTablePastJockeys = $this->createPastJockeys();
        }
        return $this->tmpTablePastJockeys;
    }

    /**
     * Gets descriptions of min and max odds
     *
     * @param float $minSp
     * @param float $maxSp
     *
     * @return array
     * @throws ResultsetException
     */
    public function getMinMaxSPDesc(float $minSp, float $maxSp)
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT TOP 1
                min_sp_desc = odds_desc
            FROM /*{EXPRESSION(tmpTableLastYearRaces)}*/
            WHERE odds_value = CAST(:min_sp AS DECIMAL(10,2))
            ORDER BY race_datetime DESC
         ");

        $builder->expression("tmpTableLastYearRaces", $this->getTmpTableLastYearsRaces()->getTemporaryTable());
        $builder->setParam('min_sp', $minSp);

        $rows = $this->queryBuilder($builder);
        $rowMinSp = $rows->getFirst();

        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT TOP 1
                max_sp_desc = odds_desc
            FROM /*{EXPRESSION(tmpTableLastYearRaces)}*/
            WHERE odds_value = CAST(:max_sp AS DECIMAL(10,2))
            ORDER BY race_datetime DESC
        ");

        $builder->expression("tmpTableLastYearRaces", $this->getTmpTableLastYearsRaces()->getTemporaryTable());
        $builder->setParam('max_sp', $maxSp);

        $rows = $this->queryBuilder($builder);
        $rowMaxSp = $rows->getFirst();

        return [
            'min_sp_desc' => $rowMinSp->min_sp_desc ?? null,
            'max_sp_desc' => $rowMaxSp->max_sp_desc ?? null
        ];
    }

    /**
     * Get stats for all the trainers in that race that have had a winner in it
     *
     * @return array
     * @throws ValidationError
     */
    public function getWinningTrainers()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                ts.trainer_uid
                , ts.trainer_name
                , ts.trainer_search_name
                , ts.wins
                , ts.placed
                , ts.runners
                , rt.race_datetime
                , rt.course_style_name
                , rt.course_name
                , rt.horse_uid
                , rt.horse_style_name
                , rt.horse_country_origin_code
                , rt.rp_owner_choice
                , rt.owner_uid
            FROM (
                SELECT
                    hr.trainer_uid
                    , pt.trainer_name
                    , pt.trainer_search_name
                    , wins = SUM(CASE WHEN hr.final_race_outcome_uid IN (1, 71) THEN 1 ELSE 0 END)
                    , placed = SUM(CASE WHEN (hr.final_race_outcome_uid IN (2, 72) AND lyr.no_of_runners > 4)
                                            OR (hr.final_race_outcome_uid IN (3, 73) AND lyr.no_of_runners > 7)
                                            OR (hr.final_race_outcome_uid IN (4, 74)
                                                AND lyr.no_of_runners > 15
                                                AND lyr.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP . ")
                                        THEN 1
                                        ELSE 0
                                    END)
                    , runners = COUNT(*)
                FROM horse_race hr
                    , /*{EXPRESSION(tmpTablePastTrainers)}*/ pt
                    , /*{EXPRESSION(tmpTableLastYearWinRaces)}*/ lyr
                WHERE hr.race_instance_uid = lyr.race_instance_uid
                    AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                    AND hr.trainer_uid = pt.trainer_uid
                GROUP BY
                    hr.trainer_uid
                    , pt.trainer_name
                    , pt.trainer_search_name
                ) ts
                , /*{EXPRESSION(tmpTableRaceTrainers)}*/ rt
            WHERE
                ts.trainer_uid = rt.trainer_uid
            ORDER BY
                ts.wins DESC
                , ts.placed DESC
                , ts.runners ASC
                , ts.trainer_search_name ASC
         ");

        $builder->expression("tmpTableLastYearWinRaces", $this->getTmpTableLastYearsWinRaces()->getTemporaryTable());
        $builder->expression("tmpTablePastTrainers", $this->getTmpTablePastTrainers()->getTemporaryTable());
        $builder->expression("tmpTableRaceTrainers", $this->getTmpTableRaceTrainers()->getTemporaryTable());
        $builder->setRow(new RiRow());

        $res = $this->queryBuilder($builder);

        return $res->toArrayWithRows() ?? [];
    }

    /**
     * Get stats for all the jockeys in that race that have had a winner in it
     *
     * @return array
     * @throws ValidationError
     */
    public function getJockeys()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                st.jockey_uid
                , st.jockey_name
                , st.jockey_search_name
                , st.wins
                , st.placed
                , st.rides
                , rj.race_datetime
                , rj.course_style_name
                , rj.course_name
                , rj.horse_uid
                , rj.horse_style_name
                , rj.horse_country_origin_code
                , rj.rp_owner_choice
                , rj.owner_uid
            FROM (
                SELECT
                    hr.jockey_uid
                    , pt.jockey_name
                    , pt.jockey_search_name
                    , wins = SUM(CASE WHEN hr.final_race_outcome_uid IN (1, 71) THEN 1 ELSE 0 END)
                    , placed = SUM(CASE WHEN (hr.final_race_outcome_uid IN (2, 72) AND lyr.no_of_runners > 4)
                                            OR (hr.final_race_outcome_uid IN (3, 73) AND lyr.no_of_runners > 7)
                                            OR (hr.final_race_outcome_uid IN (4, 74)
                                                AND lyr.no_of_runners > 15
                                                AND lyr.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP . ")
                                        THEN 1
                                        ELSE 0
                                    END)
                    , rides = COUNT(*)
                FROM horse_race hr
                    , /*{EXPRESSION(tmpTablePastJockeys)}*/ pt
                    , /*{EXPRESSION(tmpTableLastYearWinRaces)}*/ lyr
                WHERE hr.race_instance_uid = lyr.race_instance_uid
                    AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                    AND hr.jockey_uid = pt.jockey_uid
                GROUP BY
                    hr.jockey_uid
                    , pt.jockey_name
                    , pt.jockey_search_name
                ) st
                , /*{EXPRESSION(tmpTableRaceJockeys)}*/ rj
            WHERE st.jockey_uid = rj.jockey_uid
            ORDER BY
                st.wins DESC
                , st.placed DESC
                , st.rides ASC
                , st.jockey_search_name ASC
        ");

        $builder->expression("tmpTableLastYearWinRaces", $this->getTmpTableLastYearsWinRaces()->getTemporaryTable());
        $builder->expression("tmpTablePastJockeys", $this->getTmpTablePastJockeys()->getTemporaryTable());
        $builder->expression("tmpTableRaceJockeys", $this->getTmpTableRaceJockeys()->getTemporaryTable());
        $builder->setRow(new RiRow());

        $res = $this->queryBuilder($builder);

        return $res->toArrayWithRows() ?? [];
    }


    /**
     * Gets stats of previous run
     *
     * @return array
     * @throws ResultsetException
     */
    public function getPreviousRun()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                wins = SUM(CASE WHEN t.position = 1 THEN 1 ELSE 0 END)
                , placed = SUM(
                    CASE WHEN
                        (total_runners > 4 AND position = 2)
                        OR (total_runners > 7 AND position = 3)
                        OR (
                            total_runners > 15
                            AND race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP . "
                            AND position = 4
                         )
                    THEN 1 ELSE 0 END
                )
                , lost =  SUM(
                    CASE WHEN
                        t.position != 1
                        AND NOT (
                        (total_runners > 4 AND position = 2)
                        OR (total_runners > 7 AND position = 3)
                        OR (
                            total_runners > 15
                            AND race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP . "
                            AND position = 4
                        )
                    )
                    THEN 1 ELSE 0 END
                )
                , debuts = 0
            FROM (
                SELECT pr.horse_uid
                    , position = ro.race_outcome_position
                    , race_group_code = isnull(rg.race_group_code, ' ')
                    , total_runners = (
                        SELECT COUNT(*)
                        FROM horse_race hr
                        WHERE hr.race_instance_uid = ri.race_instance_uid
                            AND hr.race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                        )
                FROM (
                    SELECT
                        horse_uid = hr.horse_uid,
                        prev_race_datetime = isnull(MAX(ri.race_datetime), '1 January 1910')
                    FROM /*{EXPRESSION(tmpTableLastYearWinRaces)}*/ lyr
                        LEFT JOIN race_instance ri ON ri.race_datetime < lyr.race_datetime
                            AND ((ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                            AND lyr.race_type_code IN (" . Constants::RACE_TYPE_FLAT . "))
                                OR (ri.race_type_code NOT IN (" . Constants::RACE_TYPE_FLAT . ")
                                    AND lyr.race_type_code NOT IN (" . Constants::RACE_TYPE_FLAT . ")))
                        LEFT JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
                            AND hr.horse_uid = lyr.horse_uid
                    WHERE
                        hr.race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                        AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                    GROUP BY hr.horse_uid
                    ) pr
                    , race_instance ri
                    , horse_race hr
                    , race_outcome ro
                    , race_group rg
                WHERE ri.race_datetime = pr.prev_race_datetime
                    AND pr.prev_race_datetime > '1 January 1921'
                    AND ri.race_instance_uid = hr.race_instance_uid
                    AND hr.horse_uid = pr.horse_uid
                    AND ro.race_outcome_uid = hr.race_outcome_uid
                    AND ri.race_group_uid *= rg.race_group_uid
                ) t
        ");
        $builder->expression("tmpTableLastYearWinRaces", $this->getTmpTableLastYearsWinRaces()->getTemporaryTable());
        $res = $this->queryBuilder($builder);

        return ($res->getFirst()) ?? [];
    }

    /**
     * Gets race data
     *
     * @return array
     * @throws ResultsetException
     */
    protected function getRaceInfo()
    {
        $sql = "
            SELECT
                race_type_code = ri.race_type_code
                , race_group_code = isnull(rg.race_group_code, '-')
            FROM race_instance ri
              , pre_race_instance pri
              , race_group rg
            WHERE ri.race_instance_uid = :race_instance_uid
                AND ri.race_instance_uid = pri.race_instance_uid
                AND ri.race_status_code = pri.race_status_code
                AND ri.race_group_uid *= rg.race_group_uid
                AND ri.lst_yr_race_instance_uid IS NOT NULL
        ";

        $res = $this->query(
            $sql,
            ['race_instance_uid' => $this->getRaceId()],
            new RiRow
        );
        $raceInfo = $res->getFirst();

        if ($raceInfo === false) {
            return null;
        }

        return $raceInfo;
    }

    /**
     * Gets all odds values and their descriptions
     *
     * @return array
     */
    public function getAllOddsList()
    {
        $sql = "
            SELECT
                o.odds_value
                ,  o.odds_desc
            FROM odds o
            WHERE isnull(o.favourite_flag, 'N') NOT IN (" . Constants::FAVOURITE_FLAG_CODES . ")
                AND o.odds_value > 0.000
                AND o.british_odds_flag = 'Y'
            ORDER BY o.odds_value
        ";

        $res = $this->query($sql, null, new RiRow, false);

        return $res->toArrayWithRows();
    }


    /**
     * Gets races stats
     *
     * @return array
     * @throws ValidationError
     * @throws ResultsetException
     */
    public function getStats()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                diff_ages = COUNT(DISTINCT age)
                , diff_weights = COUNT(DISTINCT weight_carried_lbs)
                , no_of_races = COUNT(DISTINCT CASE WHEN race_outcome_code = '1' THEN race_instance_uid END)
                , no_of_races_or = COUNT(DISTINCT CASE
                    WHEN isnull(rpr, 0) > 0
                        AND race_group_code /*{EXPRESSION(equalORNot)}*/ " . Constants::RACE_GROUP_CODE_HANDICAP . "
                        AND race_outcome_code = '1'
                    THEN race_instance_uid END)
            FROM
                /*{EXPRESSION(tmpTableLastYearRaces)}*/
            ");
        $builder->expression("tmpTableLastYearRaces", $this->getTmpTableLastYearsRaces()->getTemporaryTable());
        $builder->expression(
            "equalORNot",
            (strpos(Constants::RACE_GROUP_CODE_HANDICAP, $this->getRaceGroup()) !== false) ? '=' : '!='
        );
        $rows = $this->queryBuilder($builder);

        return $rows->getFirst();
    }

    /**
     * Gets stats of winners
     *
     * @return \Phalcon\Mvc\ModelInterface
     * @throws ResultsetException
     */
    public function getWinStats()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT min_wt = MIN(weight_carried_lbs)
                , max_wt = MAX(weight_carried_lbs)
                , min_or = MIN(CASE
                    WHEN isnull(rpr, 0) > 0
                        AND race_group_code /*{EXPRESSION(equalORNot)}*/ " . Constants::RACE_GROUP_CODE_HANDICAP . "
                    THEN rpr END)
                , max_or = MAX(CASE
                    WHEN isnull(rpr, 0) > 0
                        AND race_group_code/*{EXPRESSION(equalORNot)}*/ " . Constants::RACE_GROUP_CODE_HANDICAP . "
                    THEN rpr END)
                , min_age = MIN(age)
                , max_age = MAX(age)
                , min_sp = MIN(CASE WHEN odds_value > 0.00 THEN odds_value END)
                , max_sp = MAX(CASE WHEN odds_value > 0.00 THEN odds_value END)
                , min_runners = MIN(no_of_runners)
                , max_runners = MAX(no_of_runners)
            FROM
                /*{EXPRESSION(tmpTableLastYearWinRaces)}*/ lyw
           ");
        $builder->expression("tmpTableLastYearWinRaces", $this->getTmpTableLastYearsWinRaces()->getTemporaryTable());
        $builder->expression(
            "equalORNot",
            (strpos(Constants::RACE_GROUP_CODE_HANDICAP, $this->getRaceGroup()) !== false) ? '=' : '!='
        );

        $rows = $this->queryBuilder($builder);

        return $rows->getFirst();
    }

    /**
     * Creates tmp tables with last years races
     *
     * @return TmpBuilder
     */
    public function crateLastYearsRaces()
    {
        $raceGroupSql = (strpos(Constants::RACE_GROUP_CODE_HANDICAP, $this->getRaceGroup()) !== false)
            ? " hr.official_rating_ran_off"
            : " hr.rp_pre_postmark";

        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                hr.race_instance_uid
                , ri.race_datetime
                , ri.race_type_code
                , hr.horse_uid
                , h.horse_name
                , age = datediff(YEAR, h.horse_date_of_birth, ri.race_datetime)
                , hr.weight_carried_lbs
                , adj_weight_carried_lbs = hr.weight_carried_lbs - isnull(hr.over_weight_lbs, 0) + isnull(hr.weight_allowance_lbs, 0)
                , hr.starting_price_odds_uid
                , o.odds_value
                , o.odds_desc
                , o.favourite_flag
                , race_outcome_code = CONVERT(VARCHAR, ro.race_outcome_position)
                , rpr = /*{EXPRESSION(rprField)}*/
                , hr.trainer_uid
                , trainer_name = t.style_name
                , trainer_search_name = t.search_name
                , hr.jockey_uid
                , jockey_name = j.style_name
                , jockey_search_name = j.search_name
                , hr.draw
                , ri.race_group_uid
                , race_group_code = rg.race_group_code
                , rule4_value = 100.00 - isnull(rit.rule4_value, 0.0)
                , no_of_runners = (
                    SELECT COUNT(*)
                    FROM horse_race hr1
                    WHERE hr1.race_instance_uid = ri.race_instance_uid
                        AND hr1.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                    )
                , ri.distance_yard
                , hr.extra_weight_lbs
            INTO " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "
            FROM horse_race hr,
                horse h,
                odds o,
                race_outcome ro,
                trainer t,
                jockey j,
                race_instance ri,
                race_group rg,
                race_instance_tote rit
            WHERE hr.race_instance_uid IN (:raceIDs)
                AND h.horse_uid = hr.horse_uid
                AND ri.race_instance_uid = hr.race_instance_uid
                AND o.odds_uid =* hr.starting_price_odds_uid
                AND ro.race_outcome_uid = hr.final_race_outcome_uid
                AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                AND t.trainer_uid = hr.trainer_uid
                AND j.jockey_uid = hr.jockey_uid
                AND ri.race_group_uid *= rg.race_group_uid
                AND ri.race_instance_uid *= rit.race_instance_uid
            PLAN '(use optgoal allrows_dss)(use merge_join off)(h_join (i_scan hr)(i_scan ri))'                  
        ");

        $builder->expression("rprField", $raceGroupSql);
        $builder->setParam('raceIDs', $this->getLastRacesIDs());

        return new TmpBuilder($builder, self::TMP_TABLE_BASE_NAME_LY_RACES);
    }

    /**
     * Creates tmp tables with last years races with winners only
     *
     * @return TmpBuilder
     */
    protected function crateLastYearsWinRaces()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT race_instance_uid
                , race_datetime
                , race_group_code
                , race_type_code
                , no_of_runners
                , horse_uid
                , age
                , rpr
                , weight_carried_lbs
                , adj_weight_carried_lbs
                , odds_value
                , odds_desc
                , trainer_uid
                , trainer_name
                , trainer_search_name
                , jockey_uid
                , jockey_name
                , jockey_search_name
                , rule4_value = CASE WHEN rule4_value > 0
                      THEN CONVERT(DECIMAL(8, 3), (100.00 - rule4_value) / 100.00)
                      ELSE rule4_value
                    END
            INTO " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "
            FROM /*{EXPRESSION(tmpTableLastYearRaces)}*/
            WHERE race_outcome_code = '1'
        ");

        $builder->expression("tmpTableLastYearRaces", $this->getTmpTableLastYearsRaces()->getTemporaryTable());

        return new TmpBuilder($builder, self::TMP_TABLE_BASE_NAME_LY_WIN_RACES);
    }

    /**
     * @return TmpBuilder
     * @throws ValidationError
     */
    protected function createPastTrainers()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT DISTINCT
                lyr.trainer_uid
                , lyr.trainer_name
                , lyr.trainer_search_name
            INTO " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "
            FROM /*{EXPRESSION(tmpTableLastYearWinRaces)}*/ lyr
                , /*{EXPRESSION(tmpTableRaceTrainers)}*/ rt
            WHERE lyr.trainer_uid = rt.trainer_uid
        ");

        $builder->expression("tmpTableLastYearWinRaces", $this->getTmpTableLastYearsWinRaces()->getTemporaryTable());
        $builder->expression("tmpTableRaceTrainers", $this->getTmpTableRaceTrainers()->getTemporaryTable());

        return new TmpBuilder($builder, self::TMP_TABLE_BASE_NAME_PAST_TRAINERS);
    }

    /**
     * @return TmpBuilder
     * @throws ValidationError
     */
    protected function createPastJockeys()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT DISTINCT
                lyr.jockey_uid
                , lyr.jockey_name
                , lyr.jockey_search_name
            INTO " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "
            FROM /*{EXPRESSION(tmpTableLastYearWinRaces)}*/ lyr
                , /*{EXPRESSION(tmpTableRaceJockeys)}*/ rt
            WHERE lyr.jockey_uid = rt.jockey_uid
        ");

        $builder->expression("tmpTableLastYearWinRaces", $this->getTmpTableLastYearsWinRaces()->getTemporaryTable());
        $builder->expression("tmpTableRaceJockeys", $this->getTmpTableRaceJockeys()->getTemporaryTable());

        return new TmpBuilder($builder, self::TMP_TABLE_BASE_NAME_PAST_JOCKEYS);
    }

    /**
     * @return TmpBuilder
     */
    protected function crateRaceTrainers()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT DISTINCT
                ri.race_datetime
                , course_style_name = c.style_name
                , c.course_name
                , phr.horse_uid
                , horse_style_name = h.style_name
                , horse_country_origin_code = h.country_origin_code
                , phr.rp_owner_choice
                , ho.owner_uid
                , ht.trainer_uid
            INTO " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "
            FROM horse_trainer ht
                , race_instance ri
                , pre_horse_race phr
                , course c
                , horse h
                , horse_owner ho
            WHERE ri.race_instance_uid = :race_instance_uid
                AND ri.race_instance_uid = phr.race_instance_uid
                AND phr.race_status_code = ri.race_status_code
                AND phr.horse_uid = ht.horse_uid
                AND ht.trainer_change_date =
                    (SELECT MAX(htr2.trainer_change_date)
                    FROM horse_trainer htr2
                    WHERE htr2.horse_uid = ht.horse_uid
                        AND (htr2.trainer_change_date >= CONVERT(DATETIME, ri.race_datetime)
                            OR htr2.trainer_change_date <= CONVERT(DATETIME, '1/2/1900')
                        )
                    )
                AND ri.course_uid = c.course_uid
                AND phr.horse_uid = h.horse_uid
                AND phr.horse_uid *= ho.horse_uid
                AND ho.owner_change_date = CONVERT(SMALLDATETIME, '" . Constants::EMPTY_DATE . "')
        ");

        $builder->setParam("race_instance_uid", $this->getRaceId());

        return new TmpBuilder($builder, self::TMP_TABLE_BASE_NAME_RACE_TRAINERS);
    }

    /**
     * @return TmpBuilder
     */
    protected function createRaceJockeys()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT DISTINCT
                ri.race_datetime
                , course_style_name = c.style_name
                , c.course_name
                , phr.horse_uid
                , horse_style_name = h.style_name
                , horse_country_origin_code = h.country_origin_code
                , phr.rp_owner_choice
                , ho.owner_uid
                , phr.jockey_uid
            INTO " . TmpBuilder::TEMPLATE_FOR_TABLE_NAME . "
            FROM race_instance ri
                , pre_horse_race phr
                , course c
                , horse h
                , horse_owner ho
            WHERE ri.race_instance_uid = :race_instance_uid
                AND ri.race_instance_uid = phr.race_instance_uid
                AND phr.race_status_code = ri.race_status_code
                AND ri.course_uid = c.course_uid
                AND phr.horse_uid = h.horse_uid
                AND phr.horse_uid *= ho.horse_uid
                AND ho.owner_change_date =  CONVERT(SMALLDATETIME, '1900-01-01 00:00:00.0')
        ");
        $builder->setParam("race_instance_uid", $this->getRaceId());

        return new TmpBuilder($builder, self::TMP_TABLE_BASE_NAME_RACE_JOCKEYS);
    }

    /**
     * Gets odds data of last years races
     *
     * @return array
     */
    public function getOddsValues()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                race_instance_uid
                , race_outcome_code
                , horse_uid
                , odds_value
            FROM
                /*{EXPRESSION(tmpTableLastYearRaces)}*/ lyr
            WHERE
                odds_value > 0.00
            ORDER BY
              race_instance_uid
              , odds_value
        ");
        $builder->expression("tmpTableLastYearRaces", $this->getTmpTableLastYearsRaces()->getTemporaryTable());
        $res = $this->queryBuilder($builder);

        return $res->toArrayWithRows('race_instance_uid', null, true);
    }

    /**
     * Gets races stats for RPR section
     *
     * @return array
     */
    public function getRprRacesStats()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                a.race_instance_uid
                , a.max_age
                , a.min_age
                , a.best_horse_uid
                , top_age = lyr2.age
                , rg.race_group_code
                , furlong = (lyr2.distance_yard + 109) / 220
                , race_month = datepart(MONTH, lyr2.race_datetime)
                , race_month_half = datepart(DAY, lyr2.race_datetime)
                , lyr2.race_datetime
                , race_type = lyr2.race_type_code
            FROM(
                SELECT
                    race_instance_uid
                    , max_age
                    , min_age
                    , best_horse_uid = (
                        SELECT MAX(horse_uid)
                        FROM /*{EXPRESSION(tmpTableLastYearRaces)}*/ lyr1
                        WHERE lyr1.adj_weight_carried_lbs = t.topwt
                        AND lyr1.race_instance_uid = t.race_instance_uid
                        )
                    , t.topwt
                FROM(
                    SELECT lyr.race_instance_uid
                        , max_age = MAX(CASE WHEN lyr.age >= 3 THEN lyr.age ELSE 0 END)
                        , min_age = MIN(CASE WHEN lyr.age >= 3 THEN lyr.age ELSE 0 END)
                        , topwt = MAX(lyr.adj_weight_carried_lbs)
                    FROM /*{EXPRESSION(tmpTableLastYearRaces)}*/ lyr
                    WHERE lyr.race_datetime > :rprMinDate
                    GROUP BY lyr.race_instance_uid
                    ) t
                ) a
                LEFT JOIN /*{EXPRESSION(tmpTableLastYearRaces)}*/ lyr2 ON lyr2.horse_uid = a.best_horse_uid
                    AND lyr2.race_instance_uid = a.race_instance_uid
                LEFT JOIN race_group rg ON rg.race_group_uid = lyr2.race_group_uid
            ORDER BY a.race_instance_uid
        ");

        $builder->expression("tmpTableLastYearRaces", $this->getTmpTableLastYearsRaces()->getTemporaryTable());
        $builder->setParam("rprMinDate", self::RPR_MIN_DATE);
        $res = $this->queryBuilder($builder);

        return $res->toArrayWithRows('race_instance_uid');
    }

    /**
     * Gets races data for RPR section
     *
     * @return array
     */
    public function getRprRaces()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT lyr.race_instance_uid
                , lyr.horse_uid
                , lyr.adj_weight_carried_lbs
                , wfage = CASE WHEN lyr.age >= :rprMinAge AND lyr.age <= :rprMaxAge THEN lyr.age END
                , adjusted_age = CASE WHEN lyr.age >= :rprMinAge AND lyr.age <= :rprMaxAge THEN lyr.age END
                , wfa = 0
                , rating = lyr.rpr
            FROM /*{EXPRESSION(tmpTableLastYearWinRaces)}*/ lyr
            WHERE lyr.race_datetime > :rprMinDate
            ORDER BY lyr.race_instance_uid
        ");

        $builder->expression("tmpTableLastYearWinRaces", $this->getTmpTableLastYearsWinRaces()->getTemporaryTable());
        $builder->setParam("rprMinDate", self::RPR_MIN_DATE);
        $builder->setParam("rprMinAge", self::RPR_MIN_AGE);
        $builder->setParam("rprMaxAge", self::RPR_MAX_AGE);

        $res = $this->queryBuilder($builder);

        return $res->toArrayWithRows('race_instance_uid', null, true);
    }

    /**
     * Gets weight allowances and ages
     *
     * @param int $furlong
     * @param int $raceMonth
     * @param int $raceMonthHalf
     *
     * @return array
     */
    public function getWfAges($furlong, $raceMonth, $raceMonthHalf)
    {
        $sql = "
            SELECT
              fwfa.age
              , wfa = CONVERT(INT, fwfa.weight_allowance_lbs)
            FROM flat_weight_for_age fwfa
            WHERE fwfa.distance_furlongs = :furlong
                AND fwfa.month = :raceMonth
                AND :raceMonthHalf = CONVERT(INT, fwfa.month_half_1_or_2)
                AND fwfa.weight_allowance_lbs != 0
        ";

        $res = $this->query(
            $sql,
            [
                'furlong' => $furlong,
                'raceMonth' => $raceMonth,
                'raceMonthHalf' => $raceMonthHalf
            ]
        );

        return $res->toArrayWithRows('age', null, true);
    }

    /**
     * Updates RPR for a horse in a race
     *
     * @param int $raceId
     * @param int $horseId
     * @param int $rating
     *
     */
    public function updateRPR($raceId, $horseId, $rating): void
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            UPDATE 
                /*{EXPRESSION(tmpTableLastYearWinRaces)}*/
            SET rpr = :rpr
            WHERE race_instance_uid = :race_instance_uid
                AND horse_uid = :horse_uid
        ");

        $builder->expression("tmpTableLastYearWinRaces", $this->getTmpTableLastYearsWinRaces()->getTemporaryTable());
        $builder
            ->setParam("race_instance_uid", $raceId)
            ->setParam('horse_uid', $horseId)
            ->setParam('rpr', $rating);

        $this->queryBuilder($builder);
    }

    /**
     * Gets last years races of winners only
     *
     * @return array
     * @throws ValidationError
     */
    public function getLastYearsWinRaces()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT lyr.* 
            FROM /*{EXPRESSION(tmpTableLastYearWinRaces)}*/ lyr
        ");
        $builder->expression("tmpTableLastYearWinRaces", $this->getTmpTableLastYearsWinRaces()->getTemporaryTable());
        $res = $this->queryBuilder($builder);

        return $res->toArrayWithRows();
    }

    /**
     * Gets a favorite debuts number
     *
     * @return int
     * @throws ResultsetException
     * @throws ValidationError
     */

    public function getFavoriteDebuts()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                debuts = COUNT(*)
            FROM /*{EXPRESSION(tmpTableLastYearWinRaces)}*/ lyr
                LEFT JOIN(
                    SELECT
                        horse_uid = hr.horse_uid,
                        debute_race_datetime = MAX(ri.race_datetime)
                    FROM /*{EXPRESSION(tmpTableLastYearWinRaces)}*/ lyr
                        LEFT JOIN race_instance ri ON ri.race_datetime < lyr.race_datetime AND
                            ((ri.race_type_code IN(" . Constants::RACE_TYPE_FLAT . ")
                            AND lyr.race_type_code IN(" . Constants::RACE_TYPE_FLAT . "))
                                OR (ri.race_type_code IN(" . Constants::RACE_TYPE_CHASE . ")
                            AND lyr.race_type_code IN(" . Constants::RACE_TYPE_CHASE . "))
                                OR (ri.race_type_code IN(" . Constants::RACE_TYPE_NHF . ")
                            AND lyr.race_type_code IN(" . Constants::RACE_TYPE_NHF . "))
                                OR (ri.race_type_code = " . Constants::RACE_TYPE_HURDLE_TURF . "
                            AND lyr.race_type_code = " . Constants::RACE_TYPE_HURDLE_TURF . "))
                        LEFT JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
                            AND hr.horse_uid = lyr.horse_uid
                    WHERE
                        hr.race_outcome_uid NOT IN(" . Constants::NON_RUNNER_IDS . ")
                        AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                    GROUP BY hr.horse_uid
                    ) d ON lyr.horse_uid = d.horse_uid
            WHERE
                d.debute_race_datetime IS NULL
        ");
        $builder->expression("tmpTableLastYearWinRaces", $this->getTmpTableLastYearsWinRaces()->getTemporaryTable());
        $res = $this->queryBuilder($builder);

        return ($res->getFirst()->debuts) ?? 0;
    }
}
