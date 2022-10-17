<?php

namespace Models;

use Phalcon\Db\Sql\Builder;
use Phalcon\Mvc\Model;
use Phalcon\Db\Column;
use Phalcon\Mvc\Model\MetaData;
use Models\Selectors as Util;
use Api\Input\Request\HorsesRequest;
use Api\Constants\Horses as Constants;

abstract class Statistics extends \Phalcon\Mvc\Model
{

    const MAIN_CATEGORY_NAME = 'OVERALL';

    abstract protected function initLocalParams();

    abstract protected function getStatisticsResult();

    /**
     * @param HorsesRequest $request
     * @param Selectors     $selectors
     *
     * @return mixed
     * @throws \Api\Exception\InternalServerError
     * @throws \Exception
     */
    public function getStatistics(HorsesRequest $request, \Models\Selectors $selectors)
    {
        $this->initParams($request, $selectors);

        $this->dropStatisticsTempTables();
        $this->createStatisticsTempTables();

        $result = $this->getStatisticsResult();

        $this->dropStatisticsTempTables();

        if (is_null($result)) {
            throw new \Api\Exception\InternalServerError([$this->getErrorCode()]);
        }

        return $result;
    }

    /**
     * @param HorsesRequest $request
     * @param Selectors     $selectors
     *
     * @throws \Exception
     */
    protected function initParams(HorsesRequest $request, \Models\Selectors $selectors)
    {
        $selectors->getDistance()->setRaceType($request->getRaceType());

        $this->setSelectors($selectors);
        $this->setRequest($request);
        $this->setCountryCode($request->getCountryCode());
        $this->setRaceTypeCodes($request->getRaceTypeCodes());
        $this->setStatisticsTypeCode($request->getStatisticsTypeCode());
        $this->setRaceType($request->getRaceType());
        $this->setAgeSql(
            $selectors->getHorseAgeSQL('h.horse_date_of_birth', 'h.country_origin_code', 'ri.race_datetime')
        );
        $this->setSuffix(mt_rand());

        $this->setDateBegin($request->getSeasonDateBegin());
        $this->setDateEnd($request->getSeasonDateEnd());

        $this->initLocalParams();
    }

    protected function createStatisticsTempTables()
    {
        if ($this->getStatisticsTypeCode() == 'race-type') {
            $this->createTmpRacesRaceType();
            $this->createTmpStatsRaceType();
        } else {
            $this->createTmpRacesCommon();
            $this->createTmpStatsCommon();
        }
    }

    /**
     * Method creates temporary table containing needed for stats data
     */
    protected function createTmpRacesRaceType()
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
                SELECT
                    horse_age = (CASE
                                    WHEN ({$this->getAgeSql()}) = 2 THEN '2YO'
                                    WHEN ({$this->getAgeSql()}) = 3 THEN '3YO'
                                    ELSE '4YO+'
                                END)
                    , prize = (SELECT SUM(CASE WHEN c.country_code = 'IRE' THEN rip.prize_euro_gross ELSE rip.prize_sterling END)
                                FROM race_outcome ro, race_instance_prize rip, course c
                                WHERE ro.race_outcome_uid = hr.final_race_outcome_uid
                                    AND rip.race_instance_uid = ri.race_instance_uid
                                    AND rip.position_no = ro.race_outcome_position
                                    AND c.course_uid = ri.course_uid)
                    , hr.final_race_outcome_uid
                    , hr.race_instance_uid
                    , ri.race_group_code
                    , ri.race_instance_title
                    , o.odds_value
                    , race_type = (CASE
                                        WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_CHASE . ") THEN 'CHASE'
                                        WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_HURDLE . ") THEN 'HURDLE'
                                        WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_NHF . ") THEN 'NHF'
                                    END)
                    , graduation = (CASE WHEN lower(ri.race_instance_title) LIKE '%graduation%'
                                            OR EXISTS (/*{EXPRESSION(subQueryRaceAttribUid)}*/ = 175)
                                        THEN 1 ELSE 0
                                    END)
                    , maiden =      (CASE WHEN lower(ri.race_instance_title) LIKE '%maiden%'
                                            OR EXISTS (/*{EXPRESSION(subQueryRaceAttribUid)}*/ = 170)
                                        THEN 1 ELSE 0
                                    END)
                    , listed =      (CASE WHEN ri.race_group_code = 'Listed'
                                            OR EXISTS (/*{EXPRESSION(subQueryRaceAttribUid)}*/ = 216)
                                        THEN 1 ELSE 0
                                    END)
                    , group123 =    (CASE WHEN ri.race_group_code LIKE '[123]'
                                            OR EXISTS (/*{EXPRESSION(subQueryRaceAttribUid)}*/ IN (210, 211, 212))
                                        THEN 1 ELSE 0
                                    END)
                    , novice =      (CASE WHEN ((
                                                :flatOrJumps != '" . Constants::RACE_TYPE_FLAT_ALIAS . "'
                                             OR (
                                                :flatOrJumps = '" . Constants::RACE_TYPE_FLAT_ALIAS . "' AND
                                                ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . "))
                                            ))
                                            AND (lower(ri.race_instance_title) LIKE '%novice%'
                                                 OR EXISTS (/*{EXPRESSION(subQueryRaceAttribUid)}*/ = 171))
                                        THEN 1 ELSE 0
                                    END)
                    , selling =     (CASE WHEN lower(ri.race_instance_title) LIKE '%selling%'
                                            OR EXISTS (/*{EXPRESSION(subQueryRaceAttribUid)}*/ = 173)
                                        THEN 1 ELSE 0
                                    END)
                    , claiming =    (CASE WHEN lower(ri.race_instance_title) LIKE '%claiming%'
                                            OR EXISTS (/*{EXPRESSION(subQueryRaceAttribUid)}*/ = 174)
                                        THEN 1 ELSE 0
                                    END)
                    , apprentice = (CASE WHEN lower(ri.race_instance_title) LIKE '%apprentice%'
                                            OR EXISTS (/*{EXPRESSION(subQueryRaceAttribUid)}*/ = 190)
                                        THEN 1 ELSE 0
                                    END)
                    , handicap =    (CASE WHEN ri.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP . "
                                            OR EXISTS (/*{EXPRESSION(subQueryRaceAttribUid)}*/ IN (200, 201, 426, 427))
                                        THEN 1 ELSE 0
                                    END)
                    , graded =    (CASE WHEN ri.race_group_uid IN (7, 8, 9, 11, 12, 13, 14, 15, 16)
                                        THEN 1 ELSE 0
                                    END)
                    , wins =             (CASE WHEN hr.final_race_outcome_uid IN (1, 71) THEN 1 ELSE 0 END)
                    , place_2nd_number = (CASE WHEN hr.final_race_outcome_uid IN (2, 72) THEN 1 ELSE 0 END)
                    , place_3rd_number = (CASE WHEN hr.final_race_outcome_uid IN (3, 73) THEN 1 ELSE 0 END)
                    , place_4th_number = (CASE WHEN hr.final_race_outcome_uid IN (4, 74) THEN 1 ELSE 0 END)
                    , placed =    (CASE WHEN (hr.final_race_outcome_uid IN (1, 71))
                                          OR (hr.final_race_outcome_uid IN (2, 72) AND ri.total_runners > 4)
                                          OR (hr.final_race_outcome_uid IN (3, 73) AND ri.total_runners > 7)
                                          OR (hr.final_race_outcome_uid IN (4, 74) AND ri.total_runners > 15 
                                            AND ri.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP . "
                                            )
                                        THEN 1 ELSE 0 END)
                    , stakes = (CASE WHEN hr.final_race_outcome_uid IN (1, 71)
                                      THEN
                                            CASE WHEN hr.final_race_outcome_uid = 71
                                                THEN(o.odds_value / 2) - 0.50
                                                ELSE o.odds_value
                                            END
                                      ELSE - 1
                                END)
                INTO #{$this->getEntityRacesTmpTableName()}
                FROM (
                     SELECT
                        ari.race_instance_uid
                        , ari.race_datetime
                        , ari.course_uid
                        , ari.distance_yard
                        , ari.race_type_code
                        , ari.race_instance_title
                        , ari.race_group_uid
                        , race_group_code = (SELECT race_group_code FROM race_group rg WHERE ari.race_group_uid = rg.race_group_uid)
                        , total_runners = (SELECT COUNT(1) FROM horse_race thr WHERE thr.race_instance_uid = ari.race_instance_uid)
                    FROM
                        race_instance ari
                    WHERE
                        ari.race_datetime BETWEEN CONVERT(DATETIME, :seasonStartDate:) AND CONVERT(DATETIME, :seasonEndDate:)
                        AND ari.race_type_code IN (:raceTypeCodes:)
                        AND ari.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        AND EXISTS (SELECT 1 FROM course c WHERE ari.course_uid = c.course_uid AND c.country_code = :countryCode:)
                    ) ri
                    INNER JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
                    INNER JOIN horse h ON hr.horse_uid = h.horse_uid
                    LEFT JOIN odds o ON hr.starting_price_odds_uid = o.odds_uid
                WHERE
                    hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_AND_VOID_IDS . ")
                    AND hr.{$this->getKey()} = :{$this->getKey()}
                 PLAN '(use optgoal allrows_dss)'
            ");
        $builder->expression(
            'subQueryRaceAttribUid',
            "SELECT 1 FROM race_attrib_join raj, race_attrib_lookup ral
            WHERE raj.race_instance_uid = ri.race_instance_uid
                AND raj.race_attrib_uid = ral.race_attrib_uid
                AND raj.race_attrib_uid"
        );

        $builder
            ->setParam('countryCode', $this->getCountryCode())
            ->setParam('seasonStartDate', $this->getDateBegin())
            ->setParam('seasonEndDate', $this->getDateEnd())
            ->setParam('raceTypeCodes', $this->getRaceTypeCodes())
            ->setParam($this->getKey(), $this->getId())
            ->setParam('flatOrJumps', $this->getRaceType());

        $builder->build();

        $this->getReadConnection()->execute(
            $builder->getSql(),
            $builder->getParams(),
            null,
            false
        );
    }

    /**
     * Method create temporary table with aggregated data
     */
    protected function createTmpStatsRaceType()
    {
        $stmt = '
            SELECT
                    category_name = CASE WHEN :flatOrJumps: = \'flat\' THEN er.horse_age ELSE er.race_type END
                    , total_prize = SUM(CASE WHEN %2$s > 0 THEN ISNULL(prize, 0) ELSE 0 END)
                    , group_name = \'%1$s\'
                    , wins = SUM(CASE WHEN %2$s > 0 THEN wins ELSE 0 END)
                    , place_2nd_number = SUM(CASE WHEN %2$s > 0 THEN place_2nd_number ELSE 0 END)
                    , place_3rd_number = SUM(CASE WHEN %2$s > 0 THEN place_3rd_number ELSE 0 END)
                    , place_4th_number = SUM(CASE WHEN %2$s > 0 THEN place_4th_number ELSE 0 END)
                    , placed = SUM(CASE WHEN %2$s > 0 THEN placed ELSE 0 END)
                    , rides = SUM(%2$s)
                    , stakes = CONVERT(DECIMAL(6, 2), SUM(CASE WHEN %2$s > 0 THEN stakes ELSE 0 END))
                %3$s
                FROM
                    #' . $this->getEntityRacesTmpTableName() . ' er
                GROUP BY CASE WHEN :flatOrJumps: = \'flat\' THEN er.horse_age ELSE er.race_type END
            ';
        $sql = sprintf($stmt, 'Handicap', 'er.handicap', "INTO #{$this->getEntityStatsTmpTableName()}") . ' UNION ' .
            sprintf($stmt, 'Apprentice', 'er.apprentice', '') . ' UNION ' .
            sprintf($stmt, 'Claiming', 'er.claiming', '') . ' UNION ' .
            sprintf($stmt, 'Selling', 'er.selling', '') . ' UNION ' .
            sprintf($stmt, 'Novice', 'er.novice', '') . ' UNION ' .
            sprintf($stmt, 'Group123', 'er.group123', '') . ' UNION ' .
            sprintf($stmt, 'Listed', 'er.listed', '') . ' UNION ' .
            sprintf($stmt, 'Maiden', 'er.maiden', '') . ' UNION ' .
            sprintf($stmt, 'Graduation', 'er.graduation', '') . ' UNION ' .
            sprintf($stmt, 'Graded', 'er.graded', '') . ' ORDER BY 1, 2';

        $this->getReadConnection()->execute(
            Util::purgeQuery($sql, $this->getEntityName()),
            ['flatOrJumps' => $this->getRaceType()],
            null,
            false
        );
    }

    /**
     * Method creates temporary table containing needed for stats data
     */
    protected function createTmpRacesCommon()
    {
        $sql = "
            SELECT DISTINCT
                horse_age = (CASE
                                WHEN ({$this->getAgeSql()}) = 2 THEN '2YO'
                                WHEN ({$this->getAgeSql()}) = 3 THEN '3YO'
                                ELSE '4YO+'
                            END)
                -->>>>>>> The code in comments below will be uncommented by a special function, only needed pieces will remain <<<<<<<

                --owner>>, hr.jockey_uid
                --trainer>>, hr.jockey_uid
                , prize = (SELECT SUM(CASE WHEN c.country_code = 'IRE' THEN rip.prize_euro_gross ELSE rip.prize_sterling END)
                                FROM race_outcome ro, race_instance_prize rip, course c
                                WHERE ro.race_outcome_uid = hr.final_race_outcome_uid
                                    AND rip.race_instance_uid = ri.race_instance_uid
                                    AND rip.position_no = ro.race_outcome_position
                                    AND c.course_uid = ri.course_uid)
                , hr.horse_uid
                , hr.race_instance_uid
                , hr.trainer_uid
                , ri.course_uid
                , ri.distance_yard
                , ri.race_datetime
                , ri.race_group_code
                , ri.race_type_code
                , race_type = (CASE
                                    WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_CHASE . ") THEN 'CHASE'
                                    WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_HURDLE . ") THEN 'HURDLE'
                                    WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_NHF . ") THEN 'NHF'
                                END)
                , wins =             (CASE WHEN hr.final_race_outcome_uid IN (1, 71) THEN 1 ELSE 0 END)
                , place_2nd_number = (CASE WHEN hr.final_race_outcome_uid IN (2, 72) THEN 1 ELSE 0 END)
                , place_3rd_number = (CASE WHEN hr.final_race_outcome_uid IN (3, 73) THEN 1 ELSE 0 END)
                , place_4th_number = (CASE WHEN hr.final_race_outcome_uid IN (4, 74) THEN 1 ELSE 0 END)
                , placed =    (CASE WHEN (hr.final_race_outcome_uid IN (1, 71))
                                      OR (hr.final_race_outcome_uid IN (2, 72) AND ri.total_runners > 4)
                                      OR (hr.final_race_outcome_uid IN (3, 73) AND ri.total_runners > 7)
                                      OR (hr.final_race_outcome_uid IN (4, 74) AND ri.total_runners > 15
                                        AND ri.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP . "
                                        )
                                    THEN 1 ELSE 0 END)
                , stakes = (CASE WHEN hr.final_race_outcome_uid IN (1, 71)
                                  THEN
                                        CASE WHEN hr.final_race_outcome_uid = 71
                                            THEN(o.odds_value / 2) - 0.50
                                            ELSE o.odds_value
                                        END
                                  ELSE - 1
                            END)
            INTO #{$this->getEntityRacesTmpTableName()}
            FROM
                (
                    SELECT
                        ari.race_instance_uid
                        , ari.race_datetime
                        , ari.course_uid
                        , ari.distance_yard
                        , ari.race_type_code
                        , ari.race_instance_title
                        , ari.race_group_uid
                        , race_group_code = (SELECT race_group_code FROM race_group rg WHERE ari.race_group_uid = rg.race_group_uid)
                        , total_runners = (SELECT COUNT(1) FROM horse_race thr WHERE thr.race_instance_uid = ari.race_instance_uid)
                    FROM
                      race_instance ari
                    WHERE
                        ari.race_datetime BETWEEN CONVERT(DATETIME, :seasonStartDate:) AND CONVERT(DATETIME, :seasonEndDate:)
                        AND ari.race_type_code IN (:raceTypeCodes:)
                        AND ari.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        AND EXISTS (SELECT 1 FROM course c WHERE ari.course_uid = c.course_uid AND c.country_code = :countryCode:)
                    ) ri
                , horse_race hr
                , horse h
                , odds o
            WHERE
                ri.race_instance_uid = hr.race_instance_uid
                AND hr.starting_price_odds_uid *= o.odds_uid
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_AND_VOID_IDS . ")
                AND hr.{$this->getKey()} = :{$this->getKey()}
                AND hr.horse_uid = h.horse_uid
        ";

        $this->getReadConnection()->execute(
            Util::purgeQuery($sql, $this->getEntityName()),
            [
                'countryCode' => $this->getCountryCode(),
                'seasonStartDate' => $this->getDateBegin(),
                'seasonEndDate' => $this->getDateEnd(),
                'raceTypeCodes' => $this->getRaceTypeCodes(),
                $this->getKey() => $this->getId()
            ],
            null,
            false
        );
        return $sql;
    }

    protected function createTmpStatsCommon()
    {
        $sql = "
            SELECT
                category_name = CASE WHEN :flatOrJumps = '" . Constants::RACE_TYPE_FLAT_ALIAS . "' THEN er.horse_age ELSE er.race_type END
                -->>>>>>> The code in comments below will be uncommented by a special function, only needed pieces will remain <<<<<<<

                --owner>>, er.horse_uid
                --owner>>, er.jockey_uid
                --trainer>>, er.horse_uid
                --trainer>>, er.jockey_uid
                , total_prize = SUM(ISNULL(er.prize, 0))
                , er.course_uid
                , er.distance_yard
                , er.race_datetime
                , er.race_instance_uid
                , er.race_type_code
                , er.trainer_uid
                , rides = COUNT(*)
                , wins = SUM(wins)
                , place_2nd_number = SUM(place_2nd_number)
                , place_3rd_number = SUM(place_3rd_number)
                , place_4th_number = SUM(place_4th_number)
                , placed = SUM(placed)
                , stake = SUM(stakes)
            INTO #{$this->getEntityStatsTmpTableName()}
            FROM
                #{$this->getEntityRacesTmpTableName()} er
            GROUP BY
                CASE WHEN :flatOrJumps = '" . Constants::RACE_TYPE_FLAT_ALIAS . "' THEN er.horse_age ELSE er.race_type END
                , er.race_datetime
                , er.course_uid
                , er.distance_yard
                --trainer>>, er.jockey_uid
                --jockey>>, er.trainer_uid
                --owner>>, er.jockey_uid
                --owner>>, er.trainer_uid
                --owner>>, er.horse_uid
                , er.race_type_code
                , er.race_instance_uid
        ";

        $this->getReadConnection()->execute(
            Util::purgeQuery($sql, $this->getEntityName()),
            ['flatOrJumps' => $this->getRaceType()],
            null,
            false
        );
    }

    /**
     * @return array
     */
    protected function getStatisticsByDistance()
    {
        $partOfQueryDistanceYard = $this->getSelectors()->getDistance()->getQueryDistanceYard();
        $statsType = $this->getReadConnection()->escapeString($this->getStatisticsTypeCode());
        $category = self::MAIN_CATEGORY_NAME;
        $sql = "
            SELECT
                stats_type = {$statsType}
                --first>>, category = '{$category}'
                --second>>, category = es.category_name
                , group_name = $partOfQueryDistanceYard
                , group_id = null
                , rides = SUM(rides)
                , stake = SUM(stake)
                , total_prize = SUM(total_prize)
                , wins = SUM(wins)
                , place_2nd_number = SUM(place_2nd_number)
                , place_3rd_number = SUM(place_3rd_number)
                , place_4th_number = SUM(place_4th_number)
                , placed = SUM(placed)
            FROM
                #{$this->getEntityStatsTmpTableName()} es
            GROUP BY
                --second>>es.category_name,
                $partOfQueryDistanceYard
            --first>>ORDER BY 3
            --second>>ORDER BY 2, 3
        ";

        return $this->aggregateQueries($sql);
    }

    /**
     * @return array
     */
    protected function getStatisticsByCourse()
    {
        $category = self::MAIN_CATEGORY_NAME;
        $sql = "
            SELECT
                --first>>category = '{$category}'
                --second>>category = es.category_name
                , group_id = es.course_uid
                , group_name = c.style_name
                , rides = SUM(rides)
                , wins = SUM(wins)
                , place_2nd_number = SUM(es.place_2nd_number)
                , place_3rd_number = SUM(es.place_3rd_number)
                , place_4th_number = SUM(es.place_4th_number)
                , total_prize = SUM(total_prize)
                , stake = SUM(stake)
                , placed = SUM(es.placed)
            FROM
                #{$this->getEntityStatsTmpTableName()} es
                , course c
            WHERE es.course_uid = c.course_uid
            GROUP BY
                --second>>es.category_name,
                es.course_uid,
                c.style_name
            --first>>ORDER BY 2, 4 DESC, 3
            --second>>ORDER BY 1, 3, 5 DESC, 4
        ";

        return $this->aggregateQueries($sql);
    }

    /**
     * @return array
     */
    protected function getStatisticsByMonth()
    {
        $category = self::MAIN_CATEGORY_NAME;
        $sql = "
            SELECT
                --first>>category = '{$category}'
                --second>>category = es.category_name
                , year_yy = YEAR(es.race_datetime)
                , month_mm = MONTH(es.race_datetime)
                , group_name = DATENAME(MONTH, es.race_datetime) + ' ' + CONVERT(VARCHAR, YEAR(es.race_datetime))
                , group_id = null
                , rides = SUM(rides)
                , wins = SUM(wins)
                , place_2nd_number = SUM(es.place_2nd_number)
                , place_3rd_number = SUM(es.place_3rd_number)
                , place_4th_number = SUM(es.place_4th_number)
                , total_prize = SUM(total_prize)
                , stake = SUM(stake)
                , placed = SUM(es.placed)
            FROM
                #{$this->getEntityStatsTmpTableName()} es
            GROUP BY
                --second>>es.category_name,
                YEAR(es.race_datetime),
                MONTH(es.race_datetime),
                DATENAME(MONTH, es.race_datetime) + ' ' + CONVERT(VARCHAR, YEAR(es.race_datetime))
            --first>>ORDER BY 2, 3
            --second>>ORDER BY 1, 2, 3
        ";

        return $this->aggregateQueries($sql);
    }

    /**
     * @return array
     */
    protected function getStatisticsByRaceType()
    {
        $category = self::MAIN_CATEGORY_NAME;
        $sql = "
            SELECT
                --first>>category = '{$category}'
                --second>>category = category_name
                , group_name
                , group_id = null
                , rides = SUM(rides)
                , wins = SUM(wins)
                , place_2nd_number = SUM(place_2nd_number)
                , place_3rd_number = SUM(place_3rd_number)
                , place_4th_number = SUM(place_4th_number)
                , total_prize = SUM(total_prize)
                , stake = SUM(stakes)
                , placed = SUM(placed)
            FROM #{$this->getEntityStatsTmpTableName()}
            GROUP BY
                --second>>category_name,
                group_name
            HAVING SUM(rides) > 0
            ORDER BY 1, 2
        ";

        return $this->aggregateQueries($sql);
    }

    /**
     * @return array
     */
    protected function getStatisticsByCategory()
    {
        $category = self::MAIN_CATEGORY_NAME;
        $sql = "
            SELECT
                --first>>category = '{$category}'
                --first>>, group_name = '{$category}'
                --second>>category = category_name
                --second>>, group_name = category_name
                , group_id = null
                , rides = SUM(rides)
                , wins = SUM(wins)
                , place_2nd_number = SUM(place_2nd_number)
                , place_3rd_number = SUM(place_3rd_number)
                , place_4th_number = SUM(place_4th_number)
                , total_prize = SUM(total_prize)
                , stake = SUM(stake)
                , placed = SUM(placed)
            FROM
                #{$this->getEntityStatsTmpTableName()}
            --second>>GROUP BY category_name
            --second>>ORDER BY 1, 2
        ";

        return $this->aggregateQueries($sql);
    }

    /**
     * @return array
     */
    protected function getStatisticsByRaceClass()
    {
        $category = self::MAIN_CATEGORY_NAME;
        $sql = "
            SELECT
                --first>>category = '{$category}'
                --second>>category = es.category_name
                , group_name = ral.race_attrib_desc
                , group_id = null
                , rides = SUM(es.rides)
                , wins = SUM(es.wins)
                , place_2nd_number = SUM(es.place_2nd_number)
                , place_3rd_number = SUM(es.place_3rd_number)
                , place_4th_number = SUM(es.place_4th_number)
                , total_prize = SUM(total_prize)
                , stake = SUM(es.stake)
                , placed = SUM(es.placed)
            FROM
                #{$this->getEntityStatsTmpTableName()} es
                JOIN race_attrib_join raj ON es.race_instance_uid = raj.race_instance_uid
                JOIN race_attrib_lookup ral ON raj.race_attrib_uid = ral.race_attrib_uid
                    AND ral.race_attrib_code = " . Constants::RACE_CLASS_SUB . "
            GROUP BY
                --second>>es.category_name,
                ral.race_attrib_desc
            ORDER BY 1, 2
        ";

        return $this->aggregateQueries($sql);
    }

    /**
     * Method performs two queries (each queries prepares by removing of certain comments), and it glues obtained
     * outcomes.
     *
     * @param string $query
     *
     * @return array
     */
    protected function aggregateQueries($query)
    {
        $result = $this->prepareSqlResult(Util::purgeQuery($query, ['first', $this->getEntityName()]));
        $overall[self::MAIN_CATEGORY_NAME] = $result->toArrayWithRows();

        $result = $this->prepareSqlResult(Util::purgeQuery($query, ['second', $this->getEntityName()]));
        $secondResult = $result->toArrayWithRows('category', null, true);

        return array_merge($overall, $secondResult);
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param int $errorCode
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
    }

    /**
     * @return string
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @param string $countryCode
     */
    public function setCountryCode($countryCode)
    {
        $this->countryCode = $countryCode;
    }

    /**
     * @return string
     */
    public function getRaceTypeCodes()
    {
        return $this->raceTypeCodes;
    }

    /**
     * @param string $raceTypeCodes
     */
    public function setRaceTypeCodes($raceTypeCodes)
    {
        $this->raceTypeCodes = $raceTypeCodes;
    }

    /**
     * @return string
     */
    public function getStatisticsTypeCode()
    {
        return $this->statisticsTypeCode;
    }

    /**
     * @param string $statisticsTypeCode
     */
    public function setStatisticsTypeCode($statisticsTypeCode)
    {
        $this->statisticsTypeCode = $statisticsTypeCode;
    }

    /**
     * @return string
     */
    public function getRaceType()
    {
        return $this->raceType;
    }

    /**
     * @param string $raceType
     */
    public function setRaceType($raceType)
    {
        $this->raceType = $raceType;
    }

    /**
     * @return string
     */
    public function getAgeSql()
    {
        return $this->ageSql;
    }

    /**
     * @param string $ageSql
     */
    public function setAgeSql($ageSql)
    {
        $this->ageSql = $ageSql;
    }

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }

    /**
     * @return string
     */
    public function getEntityName()
    {
        return $this->entityName;
    }

    /**
     * @param string $entityName
     */
    public function setEntityName($entityName)
    {
        $this->entityName = $entityName;
    }

    /**
     * @return Model\Row\General
     */
    public function getMapper()
    {
        return $this->mapper;
    }

    /**
     * @param Model\Row\General $mapper
     */
    public function setMapper($mapper)
    {
        $this->mapper = $mapper;
    }

    /**
     * @return string
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * @param string $dateBegin
     */
    public function setDateBegin($dateBegin)
    {
        $this->dateBegin = $dateBegin;
    }

    /**
     * @return string
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * @param string $dateEnd
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }

    /**
     * @return \Api\Input\Request\HorsesRequest
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     */
    public function setRequest(HorsesRequest $request)
    {
        $this->request = $request;
    }

    /**
     * @return \Models\Selectors
     */
    public function getSelectors()
    {
        return $this->selectors;
    }

    /**
     * @param \Models\Selectors $selectors
     */
    public function setSelectors(\Models\Selectors $selectors)
    {
        $this->selectors = $selectors;
    }

    /**
     * @return int
     */
    public function getSuffix()
    {
        return $this->suffix;
    }

    /**
     * @param int $suffix
     */
    protected function setSuffix($suffix)
    {
        $this->suffix = $suffix;
    }

    protected function getEntityRacesTmpTableName()
    {
        return 'entity_races_' . $this->getSuffix();
    }

    protected function getEntityStatsTmpTableName()
    {
        return 'entity_stats_' . $this->getSuffix();
    }

    /**
     * @param $sql
     *
     * @return \Phalcon\Mvc\Model\Resultset\General
     */
    protected function prepareSqlResult($sql)
    {
        $sqlResult = $this->getReadConnection()->query($sql);
        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            $this->getMapper(),
            $sqlResult
        );
        return $result;
    }

    private function dropStatisticsTempTables()
    {
        // Drop tmp tables
        $this->getReadConnection()->execute(
            "IF OBJECT_ID('tempdb..#{$this->getEntityRacesTmpTableName()}') IS NOT NULL DROP TABLE #{$this->getEntityRacesTmpTableName()}"
        );
        $this->getReadConnection()->execute(
            "IF OBJECT_ID('tempdb..#{$this->getEntityStatsTmpTableName()}') IS NOT NULL DROP TABLE #{$this->getEntityStatsTmpTableName()}"
        );
    }

    /**
     * @return array
     */
    public function metaData()
    {
        return [

            //Every column in the mapped table
            MetaData::MODELS_ATTRIBUTES => [
                'category',
                'group_name',
                'group_id',
                'distance_yard',
                'trainer_uid',
                'rides',
                'wins ',
                'stakes',

            ],
            //Every column that isn't part of the primary key
            MetaData::MODELS_NON_PRIMARY_KEY => [
                'group_name',
                'group_id',
                'rides',
                'wins ',
                'stakes',
            ],
            //Every column that doesn't allows null values
            MetaData::MODELS_NOT_NULL => [
                'category',
                'group_name',
            ],
            //Every column and their data types
            MetaData::MODELS_DATA_TYPES => [
                'category' => Column::TYPE_VARCHAR,
                'group_name' => Column::TYPE_VARCHAR,
                'group_id' => Column::TYPE_INTEGER,
                'rides' => Column::TYPE_INTEGER,
                'wins ' => Column::TYPE_INTEGER,
                'stakes' => Column::TYPE_INTEGER,
            ],
            //The columns that have numeric data types
            MetaData::MODELS_DATA_TYPES_NUMERIC => [
                'group_id' => true,
                'rides' => true,
                'wins ' => true,
                'stakes' => true,
            ],
            //The identity column, use boolean false if the model doesn't have
            //an identity column
            MetaData::MODELS_IDENTITY_COLUMN => false,
            //How every column must be bound/casted
            MetaData::MODELS_DATA_TYPES_BIND => [
                'category' => Column::BIND_PARAM_STR,
                'group_name' => Column::BIND_PARAM_STR,
                'group_id' => Column::BIND_PARAM_INT,
                'rides' => Column::BIND_PARAM_INT,
                'wins ' => Column::BIND_PARAM_INT,
                'stakes' => Column::BIND_PARAM_INT,
            ],
            //Fields that must be ignored from INSERT SQL statements
            MetaData::MODELS_AUTOMATIC_DEFAULT_INSERT => [],
            //Fields that must be ignored from UPDATE SQL statements
            MetaData::MODELS_AUTOMATIC_DEFAULT_UPDATE => []

        ];
    }

    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $key;

    /**
     * @var integer
     */
    private $errorCode;

    /**
     * @var string
     */
    private $countryCode;

    /**
     * @var string
     */
    private $raceTypeCodes;

    /**
     * @var string
     */
    private $statisticsTypeCode;

    /**
     * @var string
     */
    private $raceType;

    /**
     * @var string A part of SQL query
     */
    private $ageSql;

    /**
     * @var string
     */
    private $dateBegin;

    /**
     * @var string
     */
    private $dateEnd;

    /**
     * @var \Api\Input\Request\HorsesRequest
     */
    private $request;

    /**
     * @var \Models\Selectors
     */
    private $selectors;

    /**
     * @var integer
     */
    private $suffix;

    /**
     * @var string This string could be trainer|owner|jockey
     */
    private $entityName;

    /**
     * @var \Phalcon\Mvc\Model\Row\General
     */
    private $mapper;
}
