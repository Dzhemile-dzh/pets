<?php

namespace Models\Bo\OwnerProfile;

use Phalcon\Db\Sql\Builder;
use Api\Constants\Horses as Constants;
use Phalcon\Mvc\Model\Resultset\ResultsetException;

/**
 * Class RaceInstance
 *
 * @package Models\Bo\OwnerProfile
 */
class RaceInstance extends \Models\RaceInstance
{
    /**
     * @param int $ownerId
     *
     * @return array|null
     * @throws ResultsetException
     */
    public function getBigRaceWins(int $ownerId)
    {
        $sql = "
                SELECT
                    ri.race_datetime race_date,
                    c.rp_abbrev_3 rp_abbrev_3,
                    c.country_code country,
                    ri.distance_yard,
                    ri.race_instance_uid,
                    ri.race_instance_title,
                    c.course_name,
                    course_style_name = c.style_name,
                    trainer_short_name = t.mirror_name,
                    trainer_ptp_type_code = t.ptp_type_code,
                    prize_sterling = CONVERT(MONEY, isnull(
                        CASE WHEN c.country_code = 'IRE'
                        THEN rip.prize_euro_gross / CASE WHEN cc.exchange_rate = 0 THEN 1 ELSE cc.exchange_rate END
                        ELSE rip.prize_sterling END, 0)),
                    prize_euro = isnull(CASE WHEN c.country_code = 'IRE'
                        THEN rip.prize_euro_gross END, 0),
                    datediff(DAY, ri.race_datetime, getdate()) days_diff,
                    race_outcome_code = rtrim(ro.race_outcome_code),
                    ro.race_outcome_position,
                    LOWER(d.disqualification_desc) disq_desc,
                    h.style_name horse_style_name,
                    h.country_origin_code,
                    h.horse_uid,
                    t.style_name trainer_style_name,
                    t.trainer_uid,
                    ri.race_type_code,
                    rg.race_group_desc,
                    rg.race_group_code,
                    c.course_uid,
                    c.course_type_code
              FROM race_instance ri
              INNER JOIN horse_race hr ON
                   hr.owner_uid = :ownerUid
                   AND ri.race_instance_uid = hr.race_instance_uid
              INNER JOIN horse h ON
                   h.horse_uid = hr.horse_uid
              INNER JOIN course c ON
                   c.course_uid = ri.course_uid
              INNER JOIN trainer t ON
                   t.trainer_uid = hr.trainer_uid
              INNER JOIN race_instance_prize rip ON
                   rip.race_instance_uid = hr.race_instance_uid
                   AND rip.position_no = 1
              INNER JOIN race_outcome ro ON
                   ro.race_outcome_uid = hr.final_race_outcome_uid
                   AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                   AND ro.race_outcome_position = 1
              INNER JOIN race_group rg ON
                   rg.race_group_uid = ri.race_group_uid
              LEFT JOIN disqualification d ON
                   d.disqualification_uid = hr.disqualification_uid
              LEFT JOIN country_currencies cc ON cc.country_code = 'EUR'
                    AND year(ri.race_datetime) = cc.year
              WHERE
                  ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                  AND ( rg.race_group_uid IN (:big_race_groups)
                      OR (ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ") AND rip.prize_sterling >= 60000.00)
                      OR (ri.race_type_code IN (" . Constants::RACE_TYPE_JUMPS . ") AND rip.prize_sterling >= 25000.00)
                  )
              ORDER BY ri.race_datetime DESC
        ";

        $result = $this->getReadConnection()->query(
            $sql,
            [
                'ownerUid' => $ownerId,
                'big_race_groups' => Constants::$bigRaceWinsGroups,
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $result
        );

        $resArray = $result->toArrayWithRows('race_instance_uid');

        return !empty($resArray) ? $resArray : null;
    }

    /**
     * @param int $ownerId
     *
     * @return array|null
     * @throws ResultsetException
     */
    public function getEntries(int $ownerId)
    {
        //CAST(GETDATE() AS DATE)
        //return current date without time

        $sql = "
            SELECT
                ri.race_instance_uid
                , ri.race_datetime
                , c.course_name
                , course_style_name = c.style_name
                , ri.race_instance_title
                , ri.race_status_code
                , h.style_name horse_name
                , h.country_origin_code
                , phr.horse_uid
                , c.course_uid
                , c.course_type_code
                , phr.running_conditions
            FROM
                race_instance ri
                , pre_horse_race phr
                , pre_horse_race_stats phrs
                , course c
                , horse h
            WHERE
                ri.race_instance_uid = phr.race_instance_uid
                AND ri.race_status_code != " . Constants::RACE_STATUS_RESULTS . "
                AND ri.race_status_code != " . Constants::RACE_STATUS_ABANDONED . "
                AND ri.race_status_code = phr.race_status_code
                AND ri.race_datetime >  CONVERT(DATETIME, CONVERT(VARCHAR, getdate(), 101) + ' 00:01')
                AND c.course_uid = ri.course_uid
                AND phrs.race_instance_uid = phr.race_instance_uid
                AND phrs.horse_uid = phr.horse_uid
                AND phrs.owner_id = :owner_id
                AND h.horse_uid = phr.horse_uid
                AND NOT EXISTS (
                        SELECT 1 FROM race_attrib_lookup ral, race_attrib_join raj
                        WHERE raj.race_instance_uid = ri.race_instance_uid
                            AND raj.race_attrib_uid = ral.race_attrib_uid
                            AND ral.race_attrib_uid IN (:exclude1, :exclude2)
                        )
            ORDER BY ri.race_datetime
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'owner_id' => $ownerId,
                'exclude1' => Constants::INCOMPLETE_CARD_ATTRIBUTE_ID,
                'exclude2' => Constants::INCOMPLETE_RACE_ATTRIBUTE_ID
            ],
            null,
            null
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $res
        );

        $resArray = $result->toArrayWithRows();

        return !empty($resArray) ? $resArray : null;
    }

    /**
     * @param int $ownerId
     *
     * @return array|null
     * @throws ResultsetException
     */
    public function getLast14Days(int $ownerId)
    {
        $sql = "
            SELECT
                ri.race_instance_uid
                , ri.race_datetime
                , ri.course_uid
                , ri.race_instance_title
                , ri.race_type_code
                , ri.no_of_runners
                , ri.distance_yard
                , ri.race_group_uid
                , ri.going_type_code
                , ri.ages_allowed_uid
                , hr.horse_uid
                , hr.weight_carried_lbs
                , hr.rp_postmark
                , hr.rp_pre_postmark
                , hr.trainer_uid
                , hr.final_race_outcome_uid
                , hr.race_outcome_uid
                , hr.horse_head_gear_uid
                , hr.starting_price_odds_uid
                , hr.dist_to_horse_in_front_uid
                , hr.distance_to_winner_uid
                , hr.rp_betting_movements
            INTO #active_horses
            FROM horse_race hr
            , race_instance ri
            WHERE
                hr.race_instance_uid = ri.race_instance_uid
                AND hr.owner_uid = :ownerUid
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.race_datetime > DATEADD(DAY, - 14, GETDATE())
        ";
        $this->getReadConnection()->execute(
            $sql,
            ['ownerUid' => $ownerId],
            null,
            false
        );

        $sql = "
            SELECT
                hr.race_instance_uid
                , hr.race_datetime
                , hr.course_uid
                , hr.race_instance_title
                , hr.race_type_code
                , hr.distance_yard
                , hr.horse_uid
                , horse_style_name = h.style_name
                , horse_country_origin_code = h.country_origin_code
                , hr.weight_carried_lbs
                , hr.rp_betting_movements
                , course_rp_abbrev_3 = c.rp_abbrev_3
                , course_rp_abbrev_4 = c.rp_abbrev_4
                , c.course_name
                , course_style_name = c.style_name
                , c.course_type_code
                , c.course_code
                , hhg.first_time_yn
                , rp_postmark_difference = CASE WHEN ISNULL(hr.rp_pre_postmark, 0) > 0 AND ISNULL(hr.rp_postmark, 0) > 0
                        THEN hr.rp_postmark - hr.rp_pre_postmark
                        ELSE NULL
                    END
                , race_outcome_code = rtrim(ro.race_outcome_code)
                , o.odds_value
                , trainer_short_name = t.mirror_name
                , trainer_ptp_type_code = t.ptp_type_code
                , going_type_services_desc = (
                    SELECT rtrim(gt.services_desc)
                    FROM going_type gt
                    WHERE hr.going_type_code = gt.going_type_code
                )
                , prize_sterling = CONVERT(MONEY, isnull(
                    CASE WHEN c.country_code = 'IRE'
                        THEN rip.prize_euro_gross / CASE WHEN cc.exchange_rate = 0 THEN 1 ELSE cc.exchange_rate END
                        ELSE rip.prize_sterling END, 0))
                , prize_euro = isnull(CASE
                        WHEN c.country_code = 'IRE'
                        THEN rip.prize_euro_gross END, 0)
                , ro.race_outcome_position
                , no_of_runners = (
                    SELECT COUNT(*)
                    FROM horse_race hr2
                    WHERE hr.race_instance_uid = hr2.race_instance_uid
                        AND hr2.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                )
                , rp_close_up_comment = (
                    SELECT hrc.rp_close_up_comment
                    FROM horse_race_comments hrc
                    WHERE
                        hr.horse_uid = hrc.horse_uid
                        AND hr.race_instance_uid = hrc.race_instance_uid
                )
                , rp_horse_head_gear_code = (
                    SELECT rp_horse_head_gear_code
                    FROM horse_head_gear hhg2
                    WHERE hr.horse_head_gear_uid = hhg2.horse_head_gear_uid
                )
                , odds_desc = (
                    SELECT o.odds_desc
                    FROM odds o
                    WHERE hr.starting_price_odds_uid = o.odds_uid
                )
                , t.trainer_uid
                , trainer_style_name = t.style_name
                , hr.rp_postmark
                , hr.rp_pre_postmark
                , actual_race_class = (
                    SELECT ral2.race_attrib_desc
                    FROM race_attrib_join raj2
                    , race_attrib_lookup ral2
                    WHERE
                        raj2.race_attrib_uid = ral2.race_attrib_uid
                        AND ((c.country_code = 'GB' AND ral2.race_attrib_code = " . Constants::RACE_CLASS_SUB . ")
                            OR (c.country_code != 'GB' AND ral2.race_attrib_code = " . Constants::RACE_CLASS . "))
                        AND raj2.race_instance_uid = hr.race_instance_uid
                        AND ral2.race_attrib_desc IS NOT NULL
                )
                , rp_ages_allowed_desc = (
                    SELECT rp_ages_allowed_desc
                    FROM ages_allowed aa
                    WHERE aa.ages_allowed_uid = hr.ages_allowed_uid
                )
                , rg.race_group_code
                , rg.race_group_desc
                , ro.race_output_order
                , orig_race_output_order = ro_orig.race_output_order
                , dtw_rp_distance_desc = (
                    SELECT dth2.rp_distance_desc
                    FROM horse_race hr2
                        JOIN race_outcome ro2 ON ro2.race_outcome_uid = hr2.race_outcome_uid
                            AND ro2.race_output_order = 2
                        JOIN dist_to_horse dth2 ON dth2.dist_to_horse_uid = hr2.dist_to_horse_in_front_uid
                            AND dth2.rp_distance_desc != " . Constants::DIST_TO_HORSE_DHT . "
                    WHERE
                        hr2.race_instance_uid = hr.race_instance_uid
                        AND hr2.horse_uid = hr.horse_uid
                    )
                , dtw_sum_distance_value = (
                    SELECT SUM(dth2.distance_value)
                    FROM horse_race hr2
                        , race_outcome ro2
                        , dist_to_horse dth2
                    WHERE
                        dth2.dist_to_horse_uid = hr2.dist_to_horse_in_front_uid
                        AND ro2.race_outcome_uid = hr2.race_outcome_uid
                        AND ro2.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                        AND hr2.race_instance_uid = hr.race_instance_uid
                        AND ro2.race_output_order <=
                            CASE WHEN ro_orig.race_output_order = 1 THEN 2 ELSE ro_orig.race_output_order END
                        AND ro_orig.race_output_order BETWEEN 1 AND 50
                    )
                , dtw_count_horse_race = (
                    SELECT COUNT(1)
                    FROM horse_race hr2
                        , race_outcome ro2
                        , dist_to_horse dth2
                    WHERE
                        dth2.dist_to_horse_uid = hr2.dist_to_horse_in_front_uid
                        AND ro2.race_outcome_uid = hr2.race_outcome_uid
                        AND ro2.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                        AND hr2.race_instance_uid = hr.race_instance_uid
                        AND ro2.race_output_order <= ro.race_output_order
                        AND dth2.plus_flag = 'Y'
                )
                , dtw_total_distance_value = (
                    SELECT SUM(dth2.distance_value)
                    FROM horse_race hr2
                        , race_outcome ro2
                        , dist_to_horse dth2
                    WHERE
                        dth2.dist_to_horse_uid = hr2.dist_to_horse_in_front_uid
                        AND ro2.race_outcome_uid = hr2.race_outcome_uid
                        AND ro2.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                        AND hr2.race_instance_uid = hr.race_instance_uid
                        AND ro_orig.race_output_order BETWEEN 1 AND 50
                    )
            FROM #active_horses hr
                JOIN course c ON hr.course_uid = c.course_uid
                JOIN horse h ON hr.horse_uid = h.horse_uid
                JOIN race_outcome ro ON hr.final_race_outcome_uid = ro.race_outcome_uid
                JOIN race_outcome ro_orig ON hr.race_outcome_uid = ro_orig.race_outcome_uid
                JOIN trainer t ON hr.trainer_uid = t.trainer_uid
                LEFT JOIN race_group rg ON hr.race_group_uid = rg.race_group_uid
                LEFT JOIN horse_head_gear hhg ON hr.horse_head_gear_uid = hhg.horse_head_gear_uid
                LEFT JOIN odds o ON hr.starting_price_odds_uid = o.odds_uid
                LEFT JOIN race_instance_prize rip ON hr.race_instance_uid = rip.race_instance_uid
                    AND rip.position_no = 1
                LEFT JOIN country_currencies cc ON year(hr.race_datetime) = cc.year AND cc.country_code = 'EUR'
            WHERE
                hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND hr.race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")

            ORDER BY hr.race_datetime DESC

            PLAN '(use optgoal allrows_dss)(nl_join (i_scan hr)  (i_scan c)  (i_scan ro)(i_scan ro_orig)(i_scan o) )'
        ";

        $result = $this->getReadConnection()->query($sql);

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $result
        );
        $resArray = $result->toArrayWithRows();
        $this->getReadConnection()->execute("DROP TABLE #active_horses");

        return !empty($resArray) ? $resArray : null;
    }

    /**
     * @param int $ownerId
     *
     * @return array
     * @throws ResultsetException
     */
    public function getSinceAWin(int $ownerId)
    {
        $sql = "
            SELECT
                race_type = '" . Constants::RACE_TYPE_FLAT_ALIAS . "',
                runs = CASE WHEN COUNT(*) > 0 THEN COUNT(*) - 1 ELSE 0 END,
                days = isnull(MAX(DATEDIFF(DD, ri1.race_datetime, GETDATE())), 0)
            FROM race_instance ri1
                JOIN horse_race hr1 ON hr1.race_instance_uid = ri1.race_instance_uid
            WHERE hr1.owner_uid = :ownerId
                AND ri1.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                AND hr1.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND ri1.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND ri1.race_datetime >= (
                    SELECT
                    MAX(ri2.race_datetime)
                    FROM race_instance ri2
                        JOIN horse_race hr2 ON hr2.race_instance_uid = ri2.race_instance_uid
                    WHERE hr2.owner_uid = :ownerId
                        AND ri2.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        AND hr2.final_race_outcome_uid IN (1, 71)
                        AND ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    GROUP BY hr2.owner_uid
                    )
            UNION ALL
            SELECT
                race_type = '" . Constants::RACE_TYPE_JUMPS_ALIAS . "',
                runs = CASE WHEN COUNT(*) > 0 THEN COUNT(*) - 1 ELSE 0 END,
                days = isnull(MAX(DATEDIFF(DD, ri1.race_datetime, GETDATE())), 0)
            FROM race_instance ri1
                JOIN horse_race hr1 ON hr1.race_instance_uid = ri1.race_instance_uid
            WHERE hr1.owner_uid = :ownerId
                AND ri1.race_type_code IN (" . Constants::RACE_TYPE_JUMPS . ")
                AND hr1.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND ri1.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND ri1.race_datetime >= (
                    SELECT
                    MAX(ri2.race_datetime)
                    FROM race_instance ri2
                        JOIN horse_race hr2 ON hr2.race_instance_uid = ri2.race_instance_uid
                    WHERE hr2.owner_uid = :ownerId
                        AND ri2.race_type_code IN (" . Constants::RACE_TYPE_JUMPS . ")
                        AND hr2.final_race_outcome_uid IN (1, 71)
                        AND ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    GROUP BY hr2.owner_uid
                    )

        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'ownerId' => $ownerId
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $res
        );

        return $result->toArrayWithRows('race_type');
    }

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     *
     * @return array|null
     * @throws ResultsetException
     */
    public function getStatisticalSummary($request)
    {
        $this->createTempCore($request);
        $this->createTempBestRpr();
        $this->createTempStat($request);

        $sql = "
                SELECT DISTINCT
                    s.*, b.*
                FROM #tmp_best_rpr b
                  JOIN #tmp_main_stat s ON b.group_date=s.group_date
                ORDER BY s.group_date DESC
        ";

        $res = $this->getReadConnection()->query($sql);

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\OwnerProfile\StatisticalSummary(),
            $res
        );
        $resArray = $result->toArrayWithRows();

        $this->getReadConnection()->execute(
            "IF OBJECT_ID('#tmp_core') IS NOT NULL DROP TABLE #tmp_core",
            null,
            null,
            false
        );
        $this->getReadConnection()->execute(
            "IF OBJECT_ID('#tmp_best_rpr') IS NOT NULL DROP TABLE #tmp_best_rpr",
            null,
            null,
            false
        );
        $this->getReadConnection()->execute(
            "IF OBJECT_ID('#tmp_main_stat') IS NOT NULL DROP TABLE #tmp_main_stat",
            null,
            null,
            false
        );

        return !empty($resArray) ? $resArray : null;
    }

    /**
     * @param $request
     */
    private function createTempCore($request)
    {
        $this->getReadConnection()->execute(
            "IF OBJECT_ID('#tmp_core') IS NOT NULL DROP TABLE #tmp_core",
            null,
            null,
            false
        );

        $restrictions = [];
        $params = [];
        $restrictions[] = "YEAR(s.season_start_date) >= 1988";
        if ($request->isParameterSet('seasonYearBegin')) {
            $restrictions[] = "YEAR(s.season_start_date) >= :seasonYearBegin";
            $params['seasonYearBegin'] = $request->getSeasonYearBegin();
        }
        if ($request->isParameterSet('seasonYearEnd')) {
            $restrictions[] = "YEAR(s.season_end_date) <= :seasonYearEnd";
            $params['seasonYearEnd'] = $request->getSeasonYearEnd();
        }

        $sql = "
                SELECT
                      hr.jockey_uid
                    , hr.owner_uid
                    , hr.horse_uid
                    , hr.trainer_uid
                    , hr.rp_postmark
                    , hr.final_race_outcome_uid
                    , hr.starting_price_odds_uid
                    , ri.race_group_uid
                    , ri.race_instance_uid
                    , ri.course_uid
                    , ri.race_datetime
                    , s.season_start_date
                    , s.season_end_date
                    , CONVERT(VARCHAR, YEAR(s.season_start_date)) + '-'
                        + CONVERT(VARCHAR, YEAR(s.season_end_date)) group_date
                    , total_runners = (
                        SELECT COUNT(*)
                        FROM horse_race thr
                        WHERE thr.race_instance_uid = ri.race_instance_uid)
                    , h.style_name horse_name
                INTO
                  #tmp_core
                FROM
                  race_instance ri
                    JOIN season s ON ri.race_datetime BETWEEN s.season_start_date AND s.season_end_date
                        AND s.season_type_code = :seasonTypeCode
                    JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
                    JOIN horse h ON h.horse_uid = hr.horse_uid
                WHERE
                    hr.owner_uid = :ownerUid
                    AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_AND_VOID_IDS . ")
                    AND ri.race_type_code IN (:raceTypeCode)
                    AND " . implode(" AND ", $restrictions) . "
                PLAN '(use optgoal allrows_dss)(nl_join (i_scan hr)(i_scan ri)(i_scan h)(i_scan s))'
        ";

        $params += [
            'ownerUid' => $request->getOwnerId(),
            'raceTypeCode' => $request->getRaceTypeCodes(),
            'seasonTypeCode' => $request->getSeasonTypeCode(),
        ];

        $this->getReadConnection()->query($sql, $params, null, false);
    }

    private function createTempBestRpr()
    {
        $this->getReadConnection()->execute(
            "IF OBJECT_ID('#tmp_best_rpr') IS NOT NULL DROP TABLE #tmp_best_rpr",
            null,
            null,
            false
        );
        $sql = "
                SELECT DISTINCT
                    r.rp_postmark
                    , r.horse_uid
                    , r.horse_name
                    , r.group_date
                INTO #tmp_best_rpr
                FROM
                    #tmp_core r
                    JOIN (
                        SELECT
                            bh.group_date
                            , bh.rp_postmark
                            , best_horse_name = MIN(bh.horse_name)
                        FROM
                            #tmp_core bh
                            JOIN (
                                SELECT
                                    max_rp_postmark = MAX(rp_postmark)
                                    , group_date
                                FROM #tmp_core
                                GROUP BY
                                    group_date
                                ) bpm ON bpm.max_rp_postmark = bh.rp_postmark
                                  AND bpm.group_date = bh.group_date
                        GROUP BY
                            bh.group_date
                            , bh.rp_postmark
                        ) bhpm ON bhpm.rp_postmark = r.rp_postmark
                          AND bhpm.group_date = r.group_date
                          AND bhpm.best_horse_name = r.horse_name
        ";
        $this->getReadConnection()->execute($sql, null, null, false);
    }

    /**
     * @param $request
     */
    private function createTempStat($request)
    {
        $this->getReadConnection()->execute(
            "IF OBJECT_ID('#tmp_main_stat') IS NOT NULL DROP TABLE #tmp_main_stat",
            null,
            null,
            false
        );
        $sql = "
            SELECT
                group_date,
                season_start_date = MAX(hr.season_start_date),
                season_end_date = MAX(hr.season_end_date),
                races_number = COUNT(hr.race_instance_uid),
                placed = SUM(CASE WHEN ro.race_outcome_position = 1
                        OR (ro.race_outcome_position = 2 AND hr.total_runners > 4)
                        OR (ro.race_outcome_position = 3 AND hr.total_runners > 7)
                        OR (ro.race_outcome_position = 4 AND hr.total_runners > 15
                            AND rg.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP . "
                            )
                    THEN 1 ELSE 0 END
                ),
                place_1st_number = SUM(CASE WHEN ro.race_outcome_position = 1 THEN 1 ELSE 0 END),
                place_2nd_number = SUM(CASE WHEN ro.race_outcome_position = 2 THEN 1 ELSE 0 END),
                place_3rd_number = SUM(CASE WHEN ro.race_outcome_position = 3 THEN 1 ELSE 0 END),
                place_4th_number = SUM(CASE WHEN ro.race_outcome_position = 4 THEN 1 ELSE 0 END),
                win_prize = CONVERT(money, isnull(SUM(
                    CASE WHEN ro.race_outcome_position = 1
                        THEN CASE WHEN c.country_code = 'IRE'
                            THEN rip.prize_euro_gross / CASE WHEN cc.exchange_rate = 0 THEN 1 ELSE cc.exchange_rate END
                            ELSE rip.prize_sterling END
                        ELSE 0 END), 0)),
                total_prize = CONVERT(money, isnull(SUM(
                    CASE WHEN c.country_code = 'IRE'
                        THEN rip.prize_euro_gross / CASE WHEN cc.exchange_rate = 0 THEN 1 ELSE cc.exchange_rate END
                        ELSE rip.prize_sterling END), 0)),
                net_win_prize_money = isnull(SUM(
                    CASE WHEN ro.race_outcome_position = 1
                        THEN rip.prize_sterling
                        END), 0),
                net_total_prize_money = isnull(SUM(rip.prize_sterling), 0),
                euro_win_prize = isnull(SUM(
                    CASE WHEN c.country_code = 'IRE' AND ro.race_outcome_position = 1
                        THEN rip.prize_euro_gross
                        ELSE 0 END), 0),
                euro_total_prize = isnull(SUM(CASE WHEN c.country_code = 'IRE'
                        THEN rip.prize_euro_gross END), 0),
                stake = SUM(
                CASE WHEN ro.race_outcome_position = 1
                    THEN CASE WHEN hr.final_race_outcome_uid = 71
                        THEN(o.odds_value / 2) - 0.50
                        ELSE o.odds_value END
                    ELSE - 1 END
                )
            INTO
                #tmp_main_stat
            FROM
                #tmp_core hr
                JOIN course c ON c.course_uid = hr.course_uid
                JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                    AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_AND_VOID_CODES . ")
                LEFT JOIN race_instance_prize rip ON rip.race_instance_uid = hr.race_instance_uid
                    AND rip.position_no = ro.race_outcome_position
                LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
                LEFT JOIN race_group rg ON rg.race_group_uid = hr.race_group_uid
                LEFT JOIN country_currencies cc ON cc.country_code = 'EUR'
                    AND year(hr.race_datetime) = cc.year
            WHERE
                c.country_code = :countryCode
            GROUP BY hr.group_date
            PLAN '(use optgoal allrows_dss)(nl_join (i_scan hr)(i_scan c)(i_scan ro)(i_scan rip)(i_scan o))'
        ";
        $this->getReadConnection()->execute($sql, ['countryCode' => $request->getCountryCode()], null, false);
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Owner\Horses $request
     *
     * @return array
     * @throws \Exception
     */
    public function getHorses(\Api\Input\Request\Horses\Profile\Owner\Horses $request)
    {
        $sql = "
            SELECT
                t.*,
                tr.trainer_uid,
                trainer_style_name = tr.style_name,
                trainer_ptp_type_code = tr.ptp_type_code
            FROM
            (
                 SELECT
                    races_number = COUNT(ri.race_instance_uid),
                    place_1st_number = SUM(CASE WHEN ro.race_outcome_position = 1 THEN 1 ELSE 0 END),
                    win_prize = CONVERT(MONEY, isnull(SUM(
                        CASE WHEN ro.race_outcome_position = 1
                            THEN CASE WHEN c.country_code = 'IRE'
                                THEN rip.prize_euro_gross / CASE WHEN cc.exchange_rate = 0 THEN 1 ELSE cc.exchange_rate END
                                ELSE rip.prize_sterling END
                            ELSE 0 END), 0)),
                    total_prize = CONVERT(MONEY, isnull(SUM(
                        CASE WHEN c.country_code = 'IRE'
                            THEN rip.prize_euro_gross / CASE WHEN cc.exchange_rate = 0 THEN 1 ELSE cc.exchange_rate END
                            ELSE rip.prize_sterling END), 0)),
                    euro_win_prize = isnull(SUM(
                        CASE WHEN c.country_code = 'IRE' AND ro.race_outcome_position = 1
                            THEN rip.prize_euro_gross
                            ELSE 0 END), 0),
                    euro_total_prize = isnull(SUM(CASE WHEN c.country_code = 'IRE'
                            THEN rip.prize_euro_gross END), 0),
                    net_win_prize_money = isnull(SUM(
                            CASE WHEN ro.race_outcome_position = 1 
                                THEN rip.prize_sterling 
                                END), 0),
                    net_total_prize_money = isnull(SUM(rip.prize_sterling), 0),
                    stake = SUM(
                        CASE WHEN ro.race_outcome_position = 1
                            THEN CASE WHEN hr.final_race_outcome_uid = 71
                                THEN(o.odds_value / 2) - 0.50
                                ELSE o.odds_value END
                            ELSE - 1 END
                    ),
                    rpr = MAX(hr.rp_postmark),
                    h.horse_uid,
                    horse_style_name = h.style_name,
                    h.country_origin_code,
                    max_race_instance_uid = MAX(ri.race_instance_uid)
                FROM horse_race hr
                    JOIN race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                    JOIN horse h ON h.horse_uid = hr.horse_uid
                    JOIN course c ON c.course_uid = ri.course_uid
                    JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                        AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                    JOIN season s ON (ri.race_datetime BETWEEN s.season_start_date AND s.season_end_date)
                        AND s.season_type_code = :seasonTypeCode
                    LEFT JOIN race_instance_prize rip ON rip.race_instance_uid = ri.race_instance_uid
                        AND rip.position_no = ro.race_outcome_position
                    LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
                    LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                    LEFT JOIN country_currencies cc ON cc.country_code = 'EUR' AND year(ri.race_datetime) = cc.year
                WHERE
                    hr.owner_uid = :ownerUid
                    AND ri.race_type_code IN (:raceTypeCode)
                    AND c.country_code = :countryCode
                    AND YEAR(s.season_start_date) = :seasonYearBegin
                GROUP BY
                    h.horse_uid,
                    h.style_name
            ) t
            JOIN horse_race hr1 ON t.max_race_instance_uid = hr1.race_instance_uid AND hr1.horse_uid = t.horse_uid
            JOIN trainer tr ON tr.trainer_uid = hr1.trainer_uid
            ORDER BY
                t.total_prize DESC,
                t.horse_style_name
            PLAN '(use optgoal allrows_dss)(nl_join (i_scan hr) (i_scan ri) (i_scan s) (i_scan c) (i_scan ro)(i_scan h)(i_scan o) )'
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'ownerUid' => $request->getOwnerId(),
                'countryCode' => $request->getCountryCode(),
                'raceTypeCode' => $request->getRaceTypeCodes(),
                'seasonTypeCode' => $request->getSeasonTypeCode(),
                'seasonYearBegin' => $request->getSeasonYearBegin(),
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\OwnerProfile\Horse(),
            $res
        );

        return $result->toArrayWithRows();
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Owner\Results $request
     *
     * @return array
     * @throws ResultsetException
     */
    public function getResults(\Api\Input\Request\Horses\Profile\Owner\Results $request)
    {
        $builder = new Builder();
        $builder->setParam('owner_id', $request->getOwnerId());

        $builder->setSqlTemplate("
            SELECT
                ri.race_datetime
                , c.rp_abbrev_3
                , c.country_code
                , ri.distance_yard
                , ri.race_instance_uid
                , ri.race_instance_title
                , course_style_name = c.style_name
                , trainer_short_name = t.mirror_name
                , trainer_ptp_type_code = t.ptp_type_code
                , horse_style_name = h.style_name
                , h.country_origin_code
                , h.horse_uid
                , prize_sterling = CONVERT(MONEY, isnull(
                        CASE WHEN c.country_code = 'IRE'
                            THEN rip.prize_euro_gross / CASE WHEN cc.exchange_rate = 0 THEN 1 ELSE cc.exchange_rate END
                            ELSE rip.prize_sterling END, 0))
                , prize_euro = isnull(CASE
                        WHEN c.country_code = 'IRE'
                        THEN rip.prize_euro_gross END, 0)
                , days_diff = DATEDIFF(DAY, ri.race_datetime, GETDATE())
                , race_outcome_code = RTRIM(ro.race_outcome_code)
                , ro.race_outcome_position
                , disq_desc = LOWER(d.disqualification_desc)
                , trainer_style_name = t.style_name
                , t.trainer_uid
                , ri.race_type_code
                , rg.race_group_desc
                , rg.race_group_code
                , c.course_uid
                , c.course_type_code
            FROM
                horse_race hr
                , race_instance ri
                , course c
                , trainer t
                , horse h
                , race_group rg
                , disqualification d
                , race_instance_prize rip
                , race_outcome ro
                , country_currencies cc
            WHERE
                hr.owner_uid = :owner_id
                /*{WHERE}*/
                AND ri.race_instance_uid = hr.race_instance_uid
                AND ri.course_uid = c.course_uid
                AND hr.trainer_uid = t.trainer_uid
                AND hr.horse_uid = h.horse_uid
                AND rg.race_group_uid =* ri.race_group_uid
                AND d.disqualification_uid =* hr.disqualification_uid
                AND rip.race_instance_uid =* hr.race_instance_uid
                AND rip.position_no =* ro.race_outcome_position
                AND ro.race_outcome_uid =* hr.final_race_outcome_uid
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND cc.country_code = 'EUR' AND cc.year =* year(ri.race_datetime)
            ORDER BY ri.race_datetime
            PLAN '(use optgoal allrows_dss)(nl_join (i_scan ri) (i_scan hr) (i_scan ro) (i_scan rip)(i_scan d)(i_scan h)(i_scan t) )'
        ");

        if ($request->getYear()) {
            $builder
                ->setParam('start_date', $request->getYear() . '-01-01 00:00')
                ->setParam('end_date', $request->getYear() . '-12-31 23:59');

            $builder->where('AND ri.race_datetime BETWEEN :start_date AND :end_date');
        }

        $builder->build();

        $result = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\OwnerProfile\Owner(),
            $result
        );

        return $result->toArrayWithRows('race_instance_uid');
    }
}
