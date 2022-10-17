<?php

namespace Models\Bo\RaceMeetings;

use Api\Constants\Horses as Constants;
use Phalcon\Mvc\Model\Resultset\General;
use Phalcon\Mvc\Model\Row;
use \Api\Input\Request\Horses\RaceMeetings as InputRequest;

/**
 * Class RaceInstance
 *
 * @package Models\Bo\RaceMeetings
 */
class RaceInstance extends \Models\RaceInstance
{
    /**
     * @param int    $courseId
     * @param string $raceDate
     *
     * @return Row\General[]|null
     */
    public function getTravelersCheck($courseId, $raceDate)
    {
        $sql = "
            SELECT
                ri.race_instance_uid
                , h.horse_uid
                , horse_style_name = h.style_name
                , pri.race_datetime
                , trainer_style_name = t.style_name
                , c.course_uid
                , t.trainer_location
                , miles = ROUND(
                    SQRT(POWER(c.rp_x_coord - t.rp_x_coord, 2) + POWER(c.rp_y_coord - t.rp_y_coord,2))/1.355, 0
                )
                , t.trainer_uid
                , horse_country_origin_code = h.country_origin_code
                , course_country_code = c.country_code
            FROM
                race_instance ri
            INNER JOIN
                pre_race_instance pri ON ri.race_instance_uid = pri.race_instance_uid
                    AND pri.race_status_code = (
                        CASE
                            WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri.race_status_code
                        END)
            INNER JOIN
                pre_horse_race phr ON phr.race_instance_uid = pri.race_instance_uid
                    AND phr.race_status_code = (
                        CASE
                            WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri.race_status_code 
                        END)
            INNER JOIN
                pre_horse_race_stats phrs ON phrs.race_instance_uid = ri.race_instance_uid
                    AND phrs.horse_uid = phr.horse_uid
            INNER JOIN
                course c ON c.course_uid = pri.course_uid
            INNER JOIN
                trainer t ON t.trainer_uid = phrs.trainer_id
            INNER JOIN
                horse h ON h.horse_uid = phr.horse_uid
            WHERE
                ri.race_datetime BETWEEN :startDate AND :endDate
                AND c.course_uid = :courseId
                AND ROUND(
                    SQRT(POWER(c.rp_x_coord - t.rp_x_coord, 2) + POWER(c.rp_y_coord - t.rp_y_coord,2))/1.355, 0
                ) >= 5
            ORDER BY
                c.country_code DESC,
                miles DESC,
                t.style_name
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'courseId' => $courseId,
                'startDate' => $raceDate . ' 00:00:00',
                'endDate' => $raceDate . ' 23:59:59',
            ]
        );

        $result = new General(null, new Row\General(), $res);

        return $result->toArrayWithRows() ?: null;
    }

    /**
     * @param int    $courseId
     * @param string $raceDate
     *
     * @return Row\General[]|null
     */
    public function getFirstTimeBlinkers($courseId, $raceDate)
    {
        $sql = "
            SELECT
                ri.race_instance_uid
                , horse_style_name = h.style_name
                , horse_country_origin_code = h.country_origin_code
                , h.horse_uid
                , ri.race_datetime
                , course_country_code = course.country_code
            FROM
                race_instance ri
            JOIN
                pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
                    AND phr.race_status_code = (
                        CASE 
                            WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri.race_status_code
                        END)
            JOIN
                horse h ON h.horse_uid = phr.horse_uid
            JOIN
                horse_head_gear hhg ON hhg.horse_head_gear_uid = phr.horse_head_gear_uid
                    AND hhg.first_time_yn = 'Y'
            JOIN
                course ON course.course_uid = ri.course_uid
            WHERE
                ri.course_uid = :courseId
                AND ri.race_datetime BETWEEN :startDate AND :endDate
                AND ri.race_status_code != " . Constants::RACE_TYPE_P2P . "
            ORDER BY
                h.style_name
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'courseId' => $courseId,
                'startDate' => $raceDate . ' 00:00:00',
                'endDate' => $raceDate . ' 23:59:59',
            ]
        );

        $result = new General(null, new Row\General(), $res);

        return $result->toArrayWithRows() ?: null;
    }

    /**
     * @param int    $courseId
     * @param string $raceDate
     *
     * @return Row\General[]|null
     */
    public function getSevenDayWinners($courseId, $raceDate)
    {
        $sql = "
            SELECT
                ri.race_datetime
                , course_style_name = c.style_name
                , ri.race_instance_uid
                , ri.race_instance_title
                , horse_style_name = h.style_name
                , horse_country_origin_code = h.country_origin_code
                , h.horse_uid
                , course_country_code = c.country_code
                , c.course_uid
                , upcoming_race = NULL
            FROM race_instance ri
                JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                JOIN course c ON c.course_uid = ri.course_uid
                JOIN horse h ON h.horse_uid = hr.horse_uid
            WHERE
                ri.race_datetime BETWEEN :raceDateTimeDayBeginMinus7days: AND :raceDateTimeDayBegin:
                AND hr.final_race_outcome_uid IN (1, 71)
                AND ri.race_status_code != " . Constants::RACE_TYPE_P2P . "
                AND hr.horse_uid IN (
                    SELECT phr.horse_uid
                    FROM race_instance ri2
                        JOIN pre_horse_race phr ON phr.race_instance_uid = ri2.race_instance_uid
                    WHERE
                        ri2.course_uid = :courseId:
                        AND ri2.race_datetime BETWEEN :raceDateTimeDayBegin AND :raceDateTimeDayEnd
                        AND phr.race_status_code = CASE
                            WHEN ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri2.race_status_code
                        END
                )
            ORDER BY ri.race_datetime DESC
            PLAN '(use optgoal allrows_dss)(join (i_scan ri)(i_scan hr))'
        ";

        $raceDateTimeDayBegin = new \DateTime($raceDate . ' 00:00:00');
        $raceDateTimeDayEnd = new \DateTime($raceDate . ' 23:59:59');
        $raceDateTimeDayBeginMinus7days = clone $raceDateTimeDayBegin;
        $raceDateTimeDayBeginMinus7days->add(\DateInterval::createFromDateString('-7 days'));

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'courseId' => $courseId,
                'raceDateTimeDayBegin' => $raceDateTimeDayBegin->format('Y-m-d H:i:s'),
                'raceDateTimeDayEnd' => $raceDateTimeDayEnd->format('Y-m-d H:i:s'),
                'raceDateTimeDayBeginMinus7days' => $raceDateTimeDayBeginMinus7days->format('Y-m-d H:i:s')
            ]
        );

        $result = new General(null, new Row\General(), $res);

        return $result->toArrayWithRows() ?: null;
    }

    /**
     * @param int[]  $horseIds
     * @param string $fromDate
     *
     * @return Row\General[]|null
     */
    public function getUpcomingRace(array $horseIds, $fromDate)
    {
        $fromDateTime = (new \DateTime($fromDate))->format('Y-m-d 00:00:00');

        $sql = "
            SELECT
               phr.horse_uid
               , ri.race_instance_uid
               , ri.race_datetime
            FROM
               race_instance ri
               INNER JOIN pre_horse_race phr ON
                   ri.race_instance_uid = phr.race_instance_uid
                   AND ri.race_status_code = phr.race_status_code
               INNER JOIN (
                   SELECT
                       phr2.horse_uid
                       , min_date = MIN(ri2.race_datetime)
                   FROM
                       race_instance ri2
                       INNER JOIN pre_horse_race phr2 ON
                           ri2.race_instance_uid = phr2.race_instance_uid
                           AND ri2.race_status_code = phr2.race_status_code
                   WHERE
                       ri2.race_datetime > :fromDateTime
                       AND ri2.race_status_code NOT IN (" . Constants::RACE_STATUS_RESULTS . ", "
            . Constants::RACE_STATUS_ABANDONED . ")
                       AND phr2.horse_uid IN (:horseIds)
                   GROUP BY phr2.horse_uid
                   ) m ON m.horse_uid = phr.horse_uid AND m.min_date = ri.race_datetime
            WHERE
               ri.race_datetime > :fromDateTime
               AND ri.race_status_code NOT IN (" . Constants::RACE_STATUS_RESULTS . ", "
            . Constants::RACE_STATUS_ABANDONED . ")
               AND phr.horse_uid IN (:horseIds)
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horseIds' => $horseIds,
                'fromDateTime' => $fromDateTime
            ]
        );

        $result = new General(null, new Row\General(), $res);

        return $result->toArrayWithRows('horse_uid') ?: null;
    }

    /**
     * @param $date
     *
     * @return array
     */
    public function getJockeyChanges($date)
    {

        $sql = "
            SELECT
              c.course_uid,
              c.style_name AS course_name,
              ri.race_instance_uid,
              ri.race_datetime,
              h.horse_uid,
              h.horse_name,
              phr.saddle_cloth_no,
              wjc.new_jockey_uid AS jockey_uid,
              wjc.new_jockey_name AS jockey_name,
              hr.weight_allowance_lbs,
              wjc.old_jockey_uid,
              wjc.old_jockey_name,
              wjc.change_date
            FROM race_instance ri
            LEFT JOIN course c ON c.course_uid = ri.course_uid
            LEFT JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
            LEFT JOIN horse h ON h.horse_uid = hr.horse_uid
            LEFT JOIN work_jockey_changes wjc ON wjc.horse_uid = hr.horse_uid
            LEFT JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
            WHERE ri.race_datetime BETWEEN :startDate AND :endDate
            AND wjc.old_jockey_name != wjc.new_jockey_name
            AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
            AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
            AND phr.horse_uid = h.horse_uid
            AND wjc.new_jockey_name != " . Constants::NON_RUNNER_JOCKEY . "
            AND datediff(DAY, wjc.change_date  , :raceDate) = 0
        ";

        $params = [
            'startDate' => $date . ' 00:00:00',
            'endDate' => $date . ' 23:59:59',
            'raceDate' => $date
        ];

        $results = $this->getReadConnection()->query($sql, $params);

        $result = new General(null, new Row\General(), $results);

        return $result->getGroupedResult([
            'course_uid',
            'course_name',
            'races' => [
                'race_instance_uid',
                'race_datetime',
                'horses' => [
                    'horse_uid',
                    'horse_name',
                    'saddle_cloth_no',
                    'jockey_uid',
                    'jockey_name',
                    'weight_allowance_lbs',
                    'previous_jockeys' => [
                        'old_jockey_uid',
                        'old_jockey_name',
                        'change_date'
                    ]
                ]
            ]
        ], ['course_uid', 'race_instance_uid', 'horse_uid', 'old_jockey_uid']);
    }

    /**
     * @param InputRequest\Statistics $request
     * @param                         $seasonDateBegin
     * @param                         $seasonDateEnd
     *
     * @return array
     * @throws \Exception
     */
    public function getStatisticsTopJockeys(
        InputRequest\Statistics $request,
        $seasonDateBegin,
        $seasonDateEnd
    ) {
        $jockeyIds = $this->getJockeyForStatistics($request);

        $sql = "
            SELECT
                jockey.jockey_uid,
                jockey.style_name,
                SUM (CASE WHEN race_outcome.race_outcome_code = '1' THEN 1 ELSE 0 END) AS wins,
                COUNT(jockey.jockey_uid) AS runs,
                SUM(
                    CASE
                        WHEN race_outcome.race_outcome_position = 1 THEN
                            CASE
                                WHEN horse_race.final_race_outcome_uid = 71 THEN
                                    (odds.odds_value / 2) - 0.50
                                ELSE
                                    odds.odds_value
                            END
                        ELSE
                            -1
                    END
                ) AS stake

            FROM race_instance
            JOIN horse_race ON race_instance.race_instance_uid = horse_race.race_instance_uid
            JOIN jockey ON
              horse_race.jockey_uid = jockey.jockey_uid
              " . (!empty($jockeyIds) ? " AND horse_race.jockey_uid IN (:jockey_ids:)" : '') . "
            JOIN race_outcome ON
                race_outcome.race_outcome_uid = horse_race.final_race_outcome_uid
                AND race_outcome.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
            LEFT JOIN odds ON odds.odds_uid = horse_race.starting_price_odds_uid

            WHERE
                race_instance.course_uid = :course_uid:
                AND race_instance.race_datetime BETWEEN :season_year_begin: AND :season_year_end:
                AND race_instance.race_type_code IN (:race_type_codes:)
                AND race_instance.race_type_code != " . Constants::RACE_TYPE_P2P . "

            GROUP BY
                jockey.jockey_uid,
                jockey.style_name
            ORDER BY
                wins DESC,
                runs
        ";

        $params = [
            'course_uid' => $request->getCourseId(),
            'season_year_begin' => $seasonDateBegin,
            'season_year_end' => $seasonDateEnd,
            'race_type_codes' => $request->getRaceTypeCodes(),
        ];

        if (!empty($jockeyIds)) {
            $params['jockey_ids'] = $jockeyIds;
        }

        $res = $this->getReadConnection()->query(
            $sql,
            $params
        );

        $result = new General(
            null,
            new \Api\Row\RaceCards\Statistics(),
            $res
        );

        return $result->toArrayWithRows();
    }

    /**
     * @param InputRequest\Statistics $request
     *
     * @return array
     * @throws \Exception
     */
    private function getJockeyForStatistics(InputRequest\Statistics $request)
    {
        $subSql = "
            SELECT DISTINCT
                j2.jockey_uid
            FROM
                race_instance ri2, pre_horse_race phr2, jockey j2
            WHERE ri2.race_datetime BETWEEN :start_date AND :end_date
                AND ri2.course_uid = :course_uid
                AND phr2.race_instance_uid = ri2.race_instance_uid
                AND phr2.race_status_code = (CASE
                    WHEN ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                    ELSE ri2.race_status_code
                END)
            AND j2.jockey_uid = phr2.jockey_uid
        ";

        $res = $this->getReadConnection()->query(
            $subSql,
            [
                'course_uid' => $request->getCourseId(),
                'start_date' => $request->getDate() . ' 00:00:00',
                'end_date' => $request->getDate() . ' 23:59:59',
            ]
        );

        $result = new General(
            null,
            new Row\General(),
            $res
        );

        $rtn = $result->getField('jockey_uid');
        return $rtn;
    }

    /**
     * @param InputRequest\Statistics $request
     * @param                         $seasonDateBegin
     * @param                         $seasonDateEnd
     *
     * @return array
     * @throws \Exception
     */
    public function getStatisticsTopTrainers(
        InputRequest\Statistics $request,
        $seasonDateBegin,
        $seasonDateEnd
    ) {
        $trainersIds = $this->getTrainersForStatistics($request);

        $sql = "
            SELECT
                trainer.trainer_uid,
                trainer.style_name,
                SUM (CASE WHEN race_outcome.race_outcome_code = '1' THEN 1 ELSE 0 END) AS wins,
                COUNT(trainer.trainer_uid) AS runs,
                SUM(
                    CASE
                        WHEN race_outcome.race_outcome_position = 1 THEN
                            CASE
                                WHEN horse_race.final_race_outcome_uid = 71 THEN
                                    (odds.odds_value / 2) - 0.50
                                ELSE
                                    odds.odds_value
                            END
                        ELSE
                            -1
                    END
                ) AS stake

            FROM race_instance
            JOIN horse_race ON race_instance.race_instance_uid = horse_race.race_instance_uid
            JOIN trainer ON horse_race.trainer_uid = trainer.trainer_uid
            JOIN race_outcome ON
                race_outcome.race_outcome_uid = horse_race.final_race_outcome_uid
                AND race_outcome.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
            LEFT JOIN odds ON odds.odds_uid = horse_race.starting_price_odds_uid

            WHERE
                race_instance.course_uid = :course_uid:
                AND race_instance.race_datetime BETWEEN :season_year_begin: AND :season_year_end:
                AND race_instance.race_type_code IN (:race_type_codes:)
                AND race_instance.race_type_code != " . Constants::RACE_TYPE_P2P . "
                " . (!empty($trainersIds) ? " AND horse_race.trainer_uid IN (:trainers_ids:)" : '') . "
            GROUP BY
                trainer.trainer_uid,
                trainer.style_name
            ORDER BY
                wins DESC,
                runs
        ";

        $params = [
            'course_uid' => $request->getCourseId(),
            'season_year_begin' => $seasonDateBegin,
            'season_year_end' => $seasonDateEnd,
            'race_type_codes' => $request->getRaceTypeCodes(),
        ];

        if (!empty($trainersIds)) {
            $params['trainers_ids'] = $trainersIds;
        }

        $res = $this->getReadConnection()->query(
            $sql,
            $params
        );

        $result = new General(
            null,
            new \Api\Row\RaceCards\Statistics(),
            $res
        );

        $rtn = $result->toArrayWithRows();
        return $rtn;
    }

    /**
     * @param InputRequest\Statistics $request
     *
     * @return array
     * @throws \Exception
     */
    private function getTrainersForStatistics(InputRequest\Statistics $request)
    {
        $subSql = "
            SELECT DISTINCT 
                ht.trainer_uid
            FROM
                race_instance ri2
                INNER JOIN pre_horse_race phr2 ON
                    phr2.race_instance_uid = ri2.race_instance_uid
                    AND phr2.race_status_code = (
                        CASE 
                            WHEN ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri2.race_status_code
                        END)
                INNER JOIN horse_trainer ht ON
                    ht.horse_uid = phr2.horse_uid
                    AND ht.trainer_change_date = (
                        SELECT
                            MIN(htr2.trainer_change_date)
                        FROM
                            horse_trainer htr2
                        WHERE
                            htr2.horse_uid = phr2.horse_uid
                            AND (htr2.trainer_change_date >= ri2.race_datetime
                            OR htr2.trainer_change_date <= '1900-01-02')
                    )
            WHERE
                ri2.race_datetime BETWEEN :start_date: AND :end_date:
                AND   ri2.course_uid = :course_uid:
        ";

        $res = $this->getReadConnection()->query(
            $subSql,
            [
                'course_uid' => $request->getCourseId(),
                'start_date' => $request->getDate() . ' 00:00:00',
                'end_date' => $request->getDate() . ' 23:59:59',
            ]
        );

        $result = new General(
            null,
            new Row\General(),
            $res
        );

        $rtn = $result->getField('trainer_uid');
        return $rtn;
    }


    /**
     * @param InputRequest\Statistics $request
     * @param                         $seasonDateBegin
     * @param                         $seasonDateEnd
     *
     * @return array
     * @throws \Exception
     */
    public function getStatisticsTopOwners(
        InputRequest\Statistics $request,
        $seasonDateBegin,
        $seasonDateEnd
    ) {
        $ownersIds = $this->getOwnersForStatistics($request);

        $sql = "
            SELECT
                o.owner_uid,
                o.style_name,
                SUM (CASE WHEN ro.race_outcome_code = '1' THEN 1 ELSE 0 END) AS wins,
                COUNT(o.owner_uid) AS runs,
                SUM(
                    CASE
                        WHEN ro.race_outcome_position = 1 THEN
                            CASE
                                WHEN hr.final_race_outcome_uid = 71 THEN
                                    (odds.odds_value / 2) - 0.50
                                ELSE
                                    odds.odds_value
                            END
                        ELSE
                            -1
                    END
                ) AS stake

            FROM race_instance ri
            JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
            JOIN owner o ON hr.owner_uid = o.owner_uid
            JOIN race_outcome ro ON
                ro.race_outcome_uid = hr.final_race_outcome_uid
                AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
            LEFT JOIN odds ON odds.odds_uid = hr.starting_price_odds_uid

            WHERE
                ri.course_uid = :course_uid
                AND ri.race_datetime BETWEEN :season_year_begin AND :season_year_end
                AND ri.race_type_code IN (:race_type_codes)
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                " . (!empty($ownersIds) ? " AND hr.owner_uid IN (:owners_ids)" : '') . "
            GROUP BY
                o.owner_uid,
                o.style_name
            ORDER BY
                wins DESC,
                runs
        ";

        $params = [
            'course_uid' => $request->getCourseId(),
            'season_year_begin' => $seasonDateBegin,
            'season_year_end' => $seasonDateEnd,
            'race_type_codes' => $request->getRaceTypeCodes(),
        ];

        if (!empty($ownersIds)) {
            $params['owners_ids'] = $ownersIds;
        }

        $res = $this->getReadConnection()->query(
            $sql,
            $params
        );

        $result = new General(
            null,
            new \Api\Row\RaceCards\Statistics(),
            $res
        );

        return $result->toArrayWithRows();
    }

    /**
     * @param InputRequest\Statistics $request
     *
     * @return array
     * @throws \Exception
     */
    private function getOwnersForStatistics(InputRequest\Statistics $request)
    {
        $subSql = "
            SELECT DISTINCT ht.owner_uid
            FROM race_instance ri2
            INNER JOIN pre_horse_race phr2 ON phr2.race_instance_uid = ri2.race_instance_uid
                AND phr2.race_status_code = (
                    CASE 
                        WHEN ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                        ELSE ri2.race_status_code
                    END)
            INNER JOIN horse_owner ht ON ht.horse_uid = phr2.horse_uid
                AND ht.owner_change_date = '" . Constants::EMPTY_DATE . "'
            WHERE
               ri2.race_datetime BETWEEN :start_date AND :end_date
               AND ri2.course_uid = :course_uid
        ";

        $res = $this->getReadConnection()->query(
            $subSql,
            [
                'course_uid' => $request->getCourseId(),
                'start_date' => $request->getDate() . ' 00:00:00',
                'end_date' => $request->getDate() . ' 23:59:59',
            ]
        );

        $result = new General(
            null,
            new Row\General(),
            $res
        );

        $rtn = $result->getField('owner_uid');
        return $rtn;
    }

    /**
     * @param InputRequest\RunnersIndex $request
     *
     * @return array
     */

    public function getRunnersIndexByDate(InputRequest\RunnersIndex $request)
    {
        $courseId = $request->getCourseId();
        $raceDate = $request->getRaceDate();

        $sql = "
            SELECT
                group_name = CASE WHEN ISNULL(phr.non_runner, '') = 'Y' THEN 'non_runners' ELSE 'runners' END,
                horse_name = h.style_name,
                h.country_origin_code,
                h.horse_uid,
                position = NULL,
                starting_price = NULL,
                ten_to_follow_horse = htf.horse_uid,
                htf.reasoning,
                ri.race_type_code,
                c.course_name,
                course_abbrev = c.rp_abbrev_3,
                c.course_uid,
                ri.race_datetime,
                ri.race_instance_uid,
                ri.race_status_code
            FROM race_instance ri
            INNER JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
            INNER JOIN horse h ON h.horse_uid = phr.horse_uid
            INNER JOIN course c ON c.course_uid = ri.course_uid
            LEFT JOIN horse_to_follow htf ON htf.horse_uid = h.horse_uid 
                AND htf.to_follow_uid = " . Constants::TEN_TO_FOLLOW_HORSE_FOLLOW_ID ."
            WHERE ri.race_datetime BETWEEN :raceDateBegin AND :raceDateEnd
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND phr.race_status_code = ri.race_status_code
                AND ri.course_uid = :courseId
            UNION ALL
            SELECT
                group_name =
                    CASE
                        WHEN ro.race_outcome_code IN (" . Constants::NON_RUNNER_CODES . ")
                        THEN 'non_runners'
                        ELSE 'runners'
                    END,
                horse_name = h.style_name,
                h.country_origin_code,
                h.horse_uid,
                position = ro.race_outcome_code,
                starting_price = o.odds_desc,
                ten_to_follow_horse = htf.horse_uid,
                htf.reasoning,
                ri.race_type_code,
                c.course_name,
                course_abbrev = c.rp_abbrev_3,
                c.course_uid,
                ri.race_datetime,
                ri.race_instance_uid,
                ri.race_status_code
            FROM race_instance ri
                INNER JOIN horse_race hr ON
                    hr.race_instance_uid = ri.race_instance_uid
                INNER JOIN horse h ON
                    h.horse_uid = hr.horse_uid
                INNER JOIN course c ON
                    c.course_uid = ri.course_uid
                INNER JOIN race_outcome ro ON
                    ro.race_outcome_uid = hr.final_race_outcome_uid
                LEFT JOIN odds o ON
                    o.odds_uid = hr.starting_price_odds_uid
                LEFT JOIN horse_to_follow htf ON htf.horse_uid = h.horse_uid 
                    AND htf.to_follow_uid = " . Constants::TEN_TO_FOLLOW_HORSE_FOLLOW_ID ."
            WHERE ri.race_datetime BETWEEN :raceDateBegin AND :raceDateEnd
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.course_uid = :courseId
            ORDER BY h.style_name
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'raceDateBegin' => $raceDate . ' 00:00:00',
                'raceDateEnd' => $raceDate . ' 23:59:59',
                'courseId' => $courseId
            ]
        );

        $collection = new General(
            null,
            new Row\General(),
            $res
        );

        $returnArray = $collection->toArrayWithRows('group_name', null, true) + [
                'non_runners' => null,
                'runners' => null
            ];

        return Row\General::createFromArray($returnArray);
    }

    /**
     * @param $request
     * @return array
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getRunners($request)
    {
        $additionalConditions = [];

        $date = $request->getDate();

        $params = [
            'meetingDate' => $date,
            'dateFrom' => $date . ' 00:00:00',
            'dateTo' => $date . ' 23:59:59',
            'exclude1' => Constants::INCOMPLETE_CARD_ATTRIBUTE_ID,
            'exclude2' => Constants::INCOMPLETE_RACE_ATTRIBUTE_ID
        ];

        $courseId = $request->getCourseId();
        if (!empty($courseId)) {
            $additionalConditions[] = 'c.course_uid = :courseId:';
            $params['courseId'] = $courseId;
        }

        $raceId = $request->getRaceId();
        if (!empty($raceId)) {
            $additionalConditions[] = 'ri.race_instance_uid = :raceId:';
            $params['raceId'] = $raceId;
        }

        $additionalConditions = implode(' AND ', $additionalConditions);

        $this->getReadConnection()->execute(
            "IF OBJECT_ID('#courses') IS NOT NULL DROP TABLE #courses",
            null,
            null,
            false
        );

        $sql = "
                SELECT
                    c.course_uid
                    , c.rp_abbrev_3
                    , course_style_name = c.style_name
                    , c.course_name
                    , c.country_code
                    , mixed_course_uid = CASE WHEN c2.course_uid IS NOT NULL AND c2.course_uid != c.course_uid THEN c2.course_uid END
                    , md_going_desc = md.going_desc
                    , pmd_going_desc = pmd.going_desc
                    , md.stalls_position
                    , weather_cond = (CASE WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                           THEN md.weather_cond
                                           ELSE pmd.weather_details
                                      END)
                INTO #courses
                FROM
                    course c
                JOIN
                    race_instance ri ON ri.course_uid = c.course_uid
                LEFT JOIN
                    course c2 ON -- Mixed meeting checking
                                c.rp_abbrev_3 = c2.rp_abbrev_3
                                AND c.country_code = c2.country_code
                                AND c2.course_uid = 31
                                AND EXISTS (
                                   SELECT 1
                                    FROM race_instance ri2
                                    WHERE ri2.race_datetime BETWEEN :dateFrom: AND :dateTo:
                                        AND DAY(ri2.race_datetime) = DAY(ri.race_datetime)
                                        AND ri2.course_uid != c.course_uid
                                        AND ri2.course_uid = c2.course_uid
                                    )
                LEFT JOIN pre_meeting_details pmd ON
                    pmd.course_uid = CASE WHEN c2.course_uid IS NOT NULL THEN c2.course_uid ELSE c.course_uid END
                    AND pmd.meeting_date = :meetingDate:
                LEFT JOIN meeting_details md ON
                    md.course_uid = (CASE WHEN c2.course_uid IS NOT NULL THEN c2.course_uid ELSE c.course_uid END)
                    AND md.meeting_date = :meetingDate
                WHERE
                    ri.race_datetime BETWEEN :dateFrom AND :dateTo
                AND c.course_name NOT LIKE ('%P-T-P%')
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.race_status_code != " . Constants::RACE_STATUS_ABANDONED . "
                AND NOT EXISTS (
                    SELECT 1 FROM race_attrib_lookup ral, race_attrib_join raj
                    WHERE raj.race_instance_uid = ri.race_instance_uid
                    AND raj.race_attrib_uid = ral.race_attrib_uid
                    AND ral.race_attrib_uid IN (:exclude1:, :exclude2:)
                )
                " . (!empty($additionalConditions) ? "AND " . $additionalConditions : "") . "
        ";

        $this->getReadConnection()->execute(
            $sql,
            $params,
            null,
            false
        );

        $sql = "
                SELECT DISTINCT
                    ri.*
                    , c.*
                FROM #courses c
                LEFT JOIN (
                    SELECT
                        h.horse_uid
                        , h.horse_name
                        , ri1.course_uid join_course_uid
                        , ri1.race_datetime
                        , ri1.race_instance_uid
                        , ri1.race_instance_title
                        , ri1.race_status_code
                        , horse_style_name = h.style_name
                        , horse_country_origin_code = h.country_origin_code
                        , t.trainer_name
                        , t.trainer_uid
                        , trainer_style_name = t.style_name
                        , phr.draw
                        , race_number = phr.saddle_cloth_no --PHA-2778
                        , phr.rp_owner_choice
                        , ho.owner_uid
                    FROM race_instance ri1
                    JOIN pre_horse_race phr ON phr.race_instance_uid = ri1.race_instance_uid
                        AND phr.race_status_code = ri1.race_status_code
                    JOIN horse h ON h.horse_uid = phr.horse_uid
                    JOIN horse_trainer ht ON ht.trainer_change_date = '" . Constants::EMPTY_DATE . "' AND ht.horse_uid = h.horse_uid
                    JOIN trainer t ON t.trainer_uid = ht.trainer_uid
                    JOIN horse_owner ho ON ho.horse_uid = phr.horse_uid
                        AND ho.owner_change_date = '1900-01-01'
                    WHERE ri1.race_datetime BETWEEN :dateFrom: AND :dateTo:
                    AND phr.non_runner = 'Y'
                    AND NOT EXISTS (
                        SELECT 1 FROM race_attrib_lookup ral, race_attrib_join raj
                        WHERE raj.race_instance_uid = ri1.race_instance_uid
                            AND raj.race_attrib_uid = ral.race_attrib_uid
                            AND ral.race_attrib_uid IN (:exclude1:, :exclude2:)
                        )
                UNION
                    SELECT
                        h.horse_uid
                        , h.horse_name
                        , ri1.course_uid join_course_uid
                        , ri1.race_datetime
                        , ri1.race_instance_uid
                        , ri1.race_instance_title
                        , ri1.race_status_code
                        , horse_style_name = h.style_name
                        , horse_country_origin_code = h.country_origin_code
                        , t.trainer_name
                        , t.trainer_uid
                        , trainer_style_name = t.style_name
                        , hr.draw
                        , race_number = hr.saddle_cloth_no --PHA-2778
                        , hr.rp_owner_choice
                        , hr.owner_uid
                    FROM race_instance ri1
                    JOIN horse_race hr ON hr.race_instance_uid = ri1.race_instance_uid
                    JOIN horse h ON h.horse_uid = hr.horse_uid
                    JOIN trainer t ON t.trainer_uid = hr.trainer_uid
                    WHERE ri1.race_datetime BETWEEN :dateFrom: AND :dateTo:
                    AND hr.final_race_outcome_uid IN (" . Constants::NON_RUNNER_IDS . ")
                    AND NOT EXISTS (
                        SELECT 1 FROM race_attrib_lookup ral, race_attrib_join raj
                        WHERE raj.race_instance_uid = ri1.race_instance_uid
                            AND raj.race_attrib_uid = ral.race_attrib_uid
                            AND ral.race_attrib_uid IN (:exclude1:, :exclude2:)
                        )
                ) ri ON ri.join_course_uid = c.course_uid
                " . (!empty($additionalConditions) ? "WHERE " . $additionalConditions : "") . "
                order by c.course_uid, ri.race_datetime, ri.draw
        ";

        array_splice($params, 0, 1); // remove meetingDate parameter

        $res = $this->getReadConnection()->query(
            $sql,
            $params
        );

        $collection = new General(
            null,
            new Row\General(),
            $res
        );

        $nonRunners = $collection->toArrayWithRows();

        $this->getReadConnection()->execute(
            "IF OBJECT_ID('#courses') IS NOT NULL DROP TABLE #courses",
            null,
            null,
            false
        );

        return $nonRunners;
    }


    /**
     * @param $date
     *
     * @return array
     */
    public function getGoingChanges($date)
    {

        $sql = "
            SELECT
              c.course_uid,
              c.style_name AS course_name,
              c.country_code,
              ri.race_status_code,
              ri.race_instance_uid,
              ri.race_instance_title,
              ri.distance_yard,
              ri.race_datetime,
              md_going_desc = md.going_desc,
              pmd_going_desc = pmd.going_desc,
              weather_conditions = pmd.weather_details,
              rgh.race_going_history_uid,
              rgh.going_type_code AS h_going_type_code,
              gth.going_type_desc AS h_going_type_desc,
              ri.going_type_code AS ri_going_type_code,
              gtri.going_type_desc AS ri_going_type_desc,
              rgh.change_datetime AS going_change_date_time
            FROM race_instance ri
            LEFT JOIN course c ON c.course_uid = ri.course_uid
            LEFT JOIN pre_meeting_details pmd ON pmd.course_uid = ri.course_uid
            LEFT JOIN meeting_details md ON md.course_uid = ri.course_uid
            LEFT JOIN race_going_history rgh ON rgh.race_instance_uid = ri.race_instance_uid
            INNER JOIN going_type gth ON gth.going_type_code = rgh.going_type_code
            LEFT JOIN going_type gtri ON gtri.going_type_code = ri.going_type_code
            WHERE ri.race_datetime BETWEEN :startDate AND :endDate
            AND md.meeting_date BETWEEN :startDate AND :endDate
            AND pmd.meeting_date BETWEEN :startDate AND :endDate
            AND rgh.race_going_history_uid != NULL
            AND ri.race_status_code NOT IN (" . Constants::RACE_STATUS_RESULTS . "," . Constants::RACE_STATUS_ABANDONED . ")
            AND gth.going_type_desc != gtri.going_type_desc
        ";

        $params = [
            'startDate' => $date . ' 00:00:00',
            'endDate' => $date . ' 23:59:59',
        ];

        $results = $this->getReadConnection()->query($sql, $params);

        $result = new General(null, new Row\General(), $results);

        return $result->getGroupedResult([
            'course_uid',
            'course_name',
            'country_code',
            'race_status_code',
            'md_going_desc',
            'pmd_going_desc',
            'meeting_going_desc',
            'weather_conditions',
            'course_uid',
                'races' => [
                    'race_instance_uid',
                    'race_datetime',
                    'race_instance_title',
                    'distance_yard',
                    'ri_going_type_code',
                    'ri_going_type_desc',
                    'previous_goings' => [
                        'race_going_history_uid',
                        'h_going_type_code',
                        'h_going_type_desc',
                        'going_change_date_time'
                    ]
                ]
            ], ['course_uid', 'race_instance_uid']);
    }
}
