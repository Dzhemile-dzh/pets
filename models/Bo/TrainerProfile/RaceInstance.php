<?php
/**
 * Created by PhpStorm.
 * User: Ievgen_Rebrakov
 * Date: 02.10.2014
 * Time: 13:52
 */

namespace Models\Bo\TrainerProfile;

use Api\Input\Request\HorsesRequest;
use Api\Constants\Horses as Constants;

class RaceInstance extends \Models\RaceInstance
{
    /**
     * @param int $trainerId
     *
     * @return array
     */
    public function getBigRaceWins($trainerId)
    {
        $sql = "
            SELECT
                race_date = ri.race_datetime,
                rp_abbrev_3 = c.rp_abbrev_3,
                country = c.country_code,
                c.course_name,
                course_style_name = c.style_name,
                c.course_type_code,
                ri.distance_yard,
                ri.race_instance_uid,
                ri.race_instance_title,
                cc.exchange_rate,
                rip.prize_sterling,
                rip.prize_euro_gross,
                days_diff = datediff(DAY, ri.race_datetime, getdate()),
                ro.race_outcome_code,
                ro.race_outcome_position,
                d.disqualification_desc,
                horse_style_name = h.style_name,
                h.country_origin_code,
                h.horse_uid,
                jockey_style_name = j.style_name,
                j.jockey_uid,
                jockey_short_name = j.aka_style_name ,
                jockey_ptp_type_code = j.ptp_type_code,
                ri.race_type_code,
                rg.race_group_desc,
                rg.race_group_code,
                c.course_uid
            FROM race_instance ri
                INNER JOIN horse_race hr ON
                    hr.trainer_uid = :trainerUid:
                    AND ri.race_instance_uid = hr.race_instance_uid
                INNER JOIN horse h ON
                    h.horse_uid = hr.horse_uid
                INNER JOIN course c ON
                    c.course_uid = ri.course_uid
                INNER JOIN jockey j ON
                    j.jockey_uid = hr.jockey_uid
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
                    AND YEAR(ri.race_datetime) = cc.year
            WHERE
                ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND (rg.race_group_uid IN (:big_race_groups:)
                    OR (ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ") AND rip.prize_sterling >= 60000.00)
                    OR (ri.race_type_code IN (" . Constants::RACE_TYPE_JUMPS . ") AND rip.prize_sterling >= 25000.00)
                )
            ORDER BY ri.race_datetime DESC
        ";

        $result = $this->getReadConnection()->query(
            $sql,
            [
                'trainerUid' => $trainerId,
                'big_race_groups' => Constants::$bigRaceWinsGroups,
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $result
        );

        return $result->toArrayWithRows('race_instance_uid');
    }

    /**
     * @param int $trainerId
     *
     * @return array
     */
    public function getLast14Days($trainerId)
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
                , hr.jockey_uid
                , hr.weight_allowance_lbs
                , hr.rp_betting_movements
            INTO #active_horses
            FROM horse_race hr
                JOIN race_instance ri ON hr.race_instance_uid = ri.race_instance_uid
            WHERE
                hr.trainer_uid = :trainerId
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.race_datetime > DATEADD(DAY, - 14, GETDATE())
        ";
        $this->getReadConnection()->execute(
            $sql,
            ['trainerId' => $trainerId],
            null,
            false
        );

        $dtwTempTableSql = "
                SELECT DISTINCT
                    hr.race_instance_uid,
                    dth.distance_value,
                    ro.race_output_order,
                    ro.race_outcome_code,
                    dth.plus_flag
                INTO
                    #active_dth_table
                FROM
                    #active_horses hr
                    JOIN horse_race hr2 ON hr.race_instance_uid = hr2.race_instance_uid
                    JOIN race_outcome ro ON ro.race_outcome_uid = hr2.race_outcome_uid
                    JOIN dist_to_horse dth ON dth.dist_to_horse_uid = hr2.dist_to_horse_in_front_uid
                WHERE
                    ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
               ";

        $this->getReadConnection()->execute(
            $dtwTempTableSql,
            [],
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
                , h.country_origin_code
                , hr.weight_carried_lbs
                , hr.weight_allowance_lbs
                , hr.rp_betting_movements
                , course_rp_abbrev_3 = c.rp_abbrev_3
                , course_rp_abbrev_4 = c.rp_abbrev_4
                , c.course_code
                , c.country_code
                , going_type_services_desc = gt.services_desc
                , rip.prize_euro_gross
                , cc.exchange_rate
                , rip.prize_sterling
                , no_of_runners = (
                    SELECT COUNT(1)
                    FROM horse_race hr2
                    WHERE hr.race_instance_uid = hr2.race_instance_uid
                        AND hr2.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                    )
                , hrc.rp_close_up_comment
                , hhg.rp_horse_head_gear_code
                , o.odds_desc
                , j.jockey_uid
                , jockey_style_name = j.style_name
                , jockey_ptp_type_code = j.ptp_type_code
                , hr.rp_postmark
                , hr.rp_pre_postmark
                , actual_race_class = (
                    SELECT ral2.race_attrib_desc
                    FROM race_attrib_join raj2
                    , race_attrib_lookup ral2
                    WHERE
                        raj2.race_attrib_uid = ral2.race_attrib_uid
                        AND ((c.country_code = '" . Constants::COUNTRY_GB . "' AND ral2.race_attrib_code = " . Constants::RACE_CLASS_SUB . ")
                            OR (c.country_code != '" . Constants::COUNTRY_GB . "' AND ral2.race_attrib_code = " . Constants::RACE_CLASS . "))
                        AND raj2.race_instance_uid = hr.race_instance_uid
                        AND ral2.race_attrib_desc IS NOT NULL
                    )
                , aa.rp_ages_allowed_desc
                , rg.race_group_code
                , rg.race_group_desc
                , orig_race_output_order = ro_orig.race_output_order
                , dtw_sum_distance_value = (
                    SELECT SUM(dth.distance_value)
                    FROM #active_dth_table dth
                    WHERE
                        dth.race_instance_uid = hr.race_instance_uid
                        AND dth.race_output_order <=
                            CASE WHEN ro_orig.race_output_order = 1 THEN 2 ELSE ro_orig.race_output_order END
                        AND ro_orig.race_output_order BETWEEN 1 AND 50
                    )
                , dtw_count_horse_race = (
                    SELECT COUNT(1)
                    FROM #active_dth_table dth
                    WHERE
                        dth.race_instance_uid = hr.race_instance_uid
                        AND dth.race_output_order <= ro.race_output_order
                        AND dth.plus_flag = 'Y'
                    )
                , dtw_total_distance_value = (
                    SELECT SUM(dth.distance_value)
                    FROM #active_dth_table dth
                    WHERE
                        dth.race_instance_uid = hr.race_instance_uid
                        AND ro_orig.race_output_order BETWEEN 1 AND 50
                    )
                , c.course_name
                , course_style_name = c.style_name
                , c.course_type_code
                , hhg.first_time_yn
                , ro.race_outcome_code
                , jockey_short_name = j.aka_style_name
                , o.odds_value
            FROM #active_horses hr
                JOIN course c ON hr.course_uid = c.course_uid
                JOIN horse h ON hr.horse_uid = h.horse_uid
                JOIN race_outcome ro ON hr.final_race_outcome_uid = ro.race_outcome_uid
                JOIN race_outcome ro_orig ON hr.race_outcome_uid = ro_orig.race_outcome_uid
                JOIN jockey j ON hr.jockey_uid = j.jockey_uid
                LEFT JOIN race_group rg ON hr.race_group_uid = rg.race_group_uid
                LEFT JOIN horse_head_gear hhg ON hr.horse_head_gear_uid = hhg.horse_head_gear_uid
                LEFT JOIN odds o ON hr.starting_price_odds_uid = o.odds_uid
                LEFT JOIN race_instance_prize rip ON hr.race_instance_uid = rip.race_instance_uid AND rip.position_no = 1
                LEFT JOIN country_currencies cc ON year(hr.race_datetime) = cc.year AND cc.country_code = 'EUR'
                LEFT JOIN going_type gt ON hr.going_type_code = gt.going_type_code
                LEFT JOIN horse_race_comments hrc ON hr.horse_uid = hrc.horse_uid
                        AND hr.race_instance_uid = hrc.race_instance_uid
                LEFT JOIN ages_allowed aa ON aa.ages_allowed_uid = hr.ages_allowed_uid
            WHERE
                hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND hr.race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
            ORDER BY hr.race_datetime DESC
            PLAN '(use optgoal allrows_dss)(nl_join (i_scan hr)  (i_scan c)  (i_scan ro)(i_scan ro_orig)(i_scan o) )'
        ";

        $result = $this->getReadConnection()->query(
            $sql,
            null,
            null,
            false
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $result
        );

        $resultArray = $result->toArrayWithRows();

        $this->getReadConnection()->execute(
            "IF OBJECT_ID('tempdb..#active_horses') IS NOT NULL DROP TABLE #active_horses"
        );

        $this->getReadConnection()->execute(
            "IF OBJECT_ID('tempdb..#active_dth_table') IS NOT NULL DROP TABLE #active_dth_table"
        );

        return !empty($resultArray) ? $resultArray : null;
    }

    /**
     * @param int $trainerId
     *
     * @return array
     */
    public function getSinceAWin($trainerId)
    {
        $sql = "
            SELECT
                race_type = '" . Constants::RACE_TYPE_FLAT_ALIAS . "',
                runs = CASE WHEN COUNT(*) > 0 then COUNT(*) - 1 ELSE 0 END,
                days = isnull(MAX(DATEDIFF(dd, ri1.race_datetime, GETDATE())), 0)
            FROM race_instance ri1
                JOIN horse_race hr1 ON hr1.race_instance_uid = ri1.race_instance_uid
            WHERE hr1.trainer_uid = :trainerId
                AND ri1.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                AND hr1.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND ri1.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND ri1.race_datetime >= (
                    SELECT
                    MAX(ri2.race_datetime)
                    FROM race_instance ri2
                        JOIN horse_race hr2 ON hr2.race_instance_uid = ri2.race_instance_uid
                    WHERE hr2.trainer_uid = :trainerId
                        AND ri2.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        AND hr2.final_race_outcome_uid IN (1, 71)
                        AND ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    GROUP BY hr2.trainer_uid
                    )
            UNION ALL
            SELECT
                race_type = '" . Constants::RACE_TYPE_JUMPS_ALIAS . "',
                runs = CASE WHEN COUNT(*) > 0 then COUNT(*) - 1 ELSE 0 END,
                days = isnull(MAX(DATEDIFF(dd, ri1.race_datetime, GETDATE())), 0)
            FROM race_instance ri1
                JOIN horse_race hr1 ON hr1.race_instance_uid = ri1.race_instance_uid
            WHERE hr1.trainer_uid = :trainerId
                AND ri1.race_type_code IN (" . Constants::RACE_TYPE_JUMPS . ")
                AND hr1.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND ri1.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND ri1.race_datetime >= (
                    SELECT
                    MAX(ri2.race_datetime)
                    FROM race_instance ri2
                        JOIN horse_race hr2 ON hr2.race_instance_uid = ri2.race_instance_uid
                    WHERE hr2.trainer_uid = :trainerId
                        AND ri2.race_type_code IN (" . Constants::RACE_TYPE_JUMPS . ")
                        AND hr2.final_race_outcome_uid IN (1, 71)
                        AND ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    GROUP BY hr2.trainer_uid
                    )
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'trainerId' => $trainerId
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
     * @param \Api\Input\Request\Horses\Profile\Trainer\Horses $request
     *
     * @return array
     */
    public function getHorses(\Api\Input\Request\Horses\Profile\Trainer\Horses $request)
    {
        $sql = "
            SELECT
                t.*,
                owner.owner_uid,
                owner.style_name AS owner_style_name,
                owner.ptp_type_code AS owner_ptp_type_code
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
                        AND s.season_type_code = :seasonTypeCode:
                    LEFT JOIN race_instance_prize rip ON rip.race_instance_uid = ri.race_instance_uid
                        AND rip.position_no = ro.race_outcome_position
                    LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
                    LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                    LEFT JOIN country_currencies cc ON cc.country_code = 'EUR' AND YEAR(ri.race_datetime) = cc.year
                WHERE
                    hr.trainer_uid = :trainerUid:
                    AND ri.race_type_code IN (:raceTypeCode:)
                    AND c.country_code = :countryCode:
                    AND YEAR(s.season_start_date) = :seasonYearBegin:
                GROUP BY
                    h.horse_uid,
                    h.style_name,
                    h.country_origin_code
                ) t
                JOIN horse_race hr1 ON t.max_race_instance_uid = hr1.race_instance_uid AND hr1.horse_uid = t.horse_uid
                JOIN owner ON owner.owner_uid = hr1.owner_uid

                ORDER BY
                    CASE WHEN t.total_prize IS NULL THEN 0 ELSE t.total_prize END DESC,
                    t.horse_style_name
                PLAN '(use optgoal allrows_dss)(nl_join (i_scan hr) (i_scan ri) (i_scan s) (i_scan c) (i_scan ro)(i_scan h)(i_scan o) )'
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'trainerUid' => $request->getTrainerId(),
                'countryCode' => $request->getCountryCode(),
                'raceTypeCode' => $request->getRaceTypeCodes(),
                'seasonTypeCode' => $request->getSeasonTypeCode(),
                'seasonYearBegin' => $request->getSeasonYearBegin(),
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\TrainerProfile\Horse(),
            $res
        );

        return $result->toArrayWithRows();
    }

    /**
     * @param HorsesRequest $request
     *
     * @return array
     */
    public function getStatisticalSummary($request)
    {
        $restrictions = [];
        $params = [];
        $restrictions[] = "YEAR(s.season_start_date) >= 1988";
        if ($request->isParameterSet('seasonYearBegin')) {
            $restrictions[] = "YEAR(s.season_start_date) >= :seasonYearBegin:";
            $params['seasonYearBegin'] = $request->getSeasonYearBegin();
        }
        if ($request->isParameterSet('seasonYearEnd')) {
            $restrictions[] = "YEAR(s.season_end_date) <= :seasonYearEnd:";
            $params['seasonYearEnd'] = $request->getSeasonYearEnd();
        }
        $sql = "
            SELECT
                season_start_date = MAX(s.season_start_date),
                season_end_date = MAX(s.season_end_date),
                COUNT(ri.race_instance_uid) AS races_number,
                place_1st_number = SUM(CASE WHEN ro.race_outcome_position = 1 THEN 1 ELSE 0 END),
                place_2nd_number = SUM(CASE WHEN ro.race_outcome_position = 2 THEN 1 ELSE 0 END),
                place_3rd_number = SUM(CASE WHEN ro.race_outcome_position = 3 THEN 1 ELSE 0 END),
                place_4th_number = SUM(CASE WHEN ro.race_outcome_position = 4 THEN 1 ELSE 0 END),
                win_prize = convert(MONEY, isnull(SUM(
                    CASE WHEN ro.race_outcome_position = 1
                    THEN CASE WHEN c.country_code = 'IRE'
                        THEN rip.prize_euro_gross / CASE WHEN cc.exchange_rate = 0 THEN 1 ELSE cc.exchange_rate END
                        ELSE rip.prize_sterling END
                    ELSE 0 END), 0)),
                total_prize = convert(MONEY, isnull(SUM(
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
            FROM horse_race hr
                JOIN race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                JOIN season s ON ri.race_datetime BETWEEN s.season_start_date AND s.season_end_date
                    AND s.season_type_code = :seasonTypeCode:
                JOIN course c ON c.course_uid = ri.course_uid
                JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                    AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_AND_VOID_CODES . ")
                JOIN horse h ON h.horse_uid = hr.horse_uid
                LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
                LEFT JOIN race_instance_prize rip ON rip.race_instance_uid = ri.race_instance_uid AND rip.position_no = ro.race_outcome_position
                LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                LEFT JOIN country_currencies cc ON cc.country_code = 'EUR' AND YEAR(ri.race_datetime) = cc.year
            WHERE
                hr.trainer_uid = :trainerUid:
                AND ri.race_type_code IN (:raceTypeCode:)
                AND c.country_code = :countryCode:
                AND " . implode(" AND ", $restrictions) . "
            GROUP BY
                CONVERT(VARCHAR, YEAR(s.season_start_date)) + '-' + CONVERT(VARCHAR, YEAR(s.season_end_date))
            ORDER BY
                season_start_date
            PLAN '(use optgoal allrows_dss)'
        ";

        $params += [
            'trainerUid' => $request->getTrainerId(),
            'raceTypeCode' => $request->getRaceTypeCodes(),
            'countryCode' => $request->getCountryCode(),
            'seasonTypeCode' => $request->getSeasonTypeCode(),
        ];

        $res = $this->getReadConnection()->query($sql, $params);

        $result = new \Phalcon\Mvc\Model\Resultset\General(null, new \Api\Row\TrainerProfile\RecordByRaceType(), $res);

        return $result->toArrayWithRows();
    }

    /**
     * @param $trainerId
     *
     * @return array
     */
    public function getEntries($trainerId)
    {
        $sql = "
            SELECT
                ri.race_instance_uid
                , phr.horse_uid
                , h.style_name horse_name
                , h.country_origin_code
                , ri.race_datetime
                , c.course_name
                , c.style_name course_style_name
                , c.course_uid
                , c.course_type_code
                , ri.race_instance_title
                , ri.race_status_code
                , rg.race_group_uid
                , rg.race_group_desc
                , phr.running_conditions
                , ri.race_type_code
                , rt.race_type_desc
            FROM
                race_instance ri
                JOIN pre_horse_race phr ON ri.race_instance_uid = phr.race_instance_uid
                    AND ri.race_status_code = phr.race_status_code
                JOIN horse_trainer ht ON ht.horse_uid = phr.horse_uid
                JOIN course c ON ri.course_uid = c.course_uid
                JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                JOIN horse h ON phr.horse_uid = h.horse_uid
                JOIN race_type rt ON rt.race_type_code = ri.race_type_code
            WHERE
                ht.trainer_uid = :trainerId:
                AND isnull(ht.trainer_change_date, '" . Constants::EMPTY_DATE_AND_TIME . "') = '" . Constants::EMPTY_DATE_AND_TIME . "'
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND NOT EXISTS (
                        SELECT 1 FROM race_attrib_lookup ral, race_attrib_join raj
                        WHERE raj.race_instance_uid = ri.race_instance_uid
                            AND raj.race_attrib_uid = ral.race_attrib_uid
                            AND ral.race_attrib_uid IN (:exclude1:, :exclude2:)
                        )
            ORDER BY ri.race_datetime
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'trainerId' => $trainerId,
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

        $resultArray = $result->toArrayWithRows();

        return !empty($resultArray) ? $resultArray : null;
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Trainer\Results $request
     *
     * @return array
     */
    public function getResults(\Api\Input\Request\Horses\Profile\Trainer\Results $request)
    {
        $sql = "
            SELECT
                ri.race_datetime
                , c.rp_abbrev_3
                , c.country_code
                , ri.distance_yard
                , ri.race_instance_uid
                , ri.race_instance_title
                , course_style_name = c.style_name
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
                , days_diff = DATEDIFF(DAY, ri.race_datetime, GETDATE())
                , race_outcome_code = RTRIM(ro.race_outcome_code)
                , ro.race_outcome_position
                , disq_desc = LOWER(d.disqualification_desc)
                , jockey_style_name = j.style_name
                , j.jockey_uid
                , jockey_short_name = j.aka_style_name
                , jockey_ptp_type_code = j.ptp_type_code
                , ri.race_type_code
                , rg.race_group_desc
                , rg.race_group_code
                , c.course_uid
                , c.course_type_code
            FROM
                horse_race hr
                , race_instance ri
                , course c
                , jockey j
                , horse h
                , race_group rg
                , disqualification d
                , race_instance_prize rip
                , race_outcome ro
                , country_currencies cc
            WHERE
                ri.race_datetime BETWEEN :start_date AND :end_date
                AND hr.trainer_uid = :trainer_id
                AND ri.race_instance_uid = hr.race_instance_uid
                AND ri.course_uid = c.course_uid
                AND hr.jockey_uid = j.jockey_uid
                AND hr.horse_uid = h.horse_uid
                AND rg.race_group_uid =* ri.race_group_uid
                AND d.disqualification_uid =* hr.disqualification_uid
                AND rip.race_instance_uid =* hr.race_instance_uid
                AND rip.position_no =* ro.race_outcome_position
                AND ro.race_outcome_uid =* hr.final_race_outcome_uid
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                AND cc.country_code = 'EUR' AND cc.year =* year(ri.race_datetime)
            ORDER BY ri.race_datetime
            PLAN '(use optgoal allrows_dss)(nl_join (i_scan ri) (i_scan hr) (i_scan ro) (i_scan rig)(i_scan d)(i_scan h)(i_scan j))'
        ";

        $result = $this->getReadConnection()->query(
            $sql,
            [
                'trainer_id' => $request->getTrainerId(),
                'start_date' => $request->getYear() . '-01-01 00:00',
                'end_date' => $request->getYear() . '-12-31 23:59',
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\RaceInstance(),
            $result
        );

        return $result->toArrayWithRows('race_instance_uid');
    }
}
