<?php

namespace Api\DataProvider\Bo;

use Phalcon\Mvc\DataProvider;
use Phalcon\Db\Sql\Builder;
use Api\Constants\Horses as Constants;
use Api\Input\Request\HorsesRequest as Request;

/**
 * Class TotePredictor
 *
 * @package Api\DataProvider\Bo
 */
abstract class TotePredictor extends DataProvider
{
    /**
     * @param Request $request
     *
     * @return array|null
     */
    abstract public function getTotePredictorRaces($request);

    /**
     * @param Request $request
     *
     * @return array
     */
    abstract public function getTotePredictorRunners($request);

    /**
     * @param Request $request
     *
     * @return Builder
     */
    protected function getTotePredictorRacesBuilder(Request $request)
    {
        $builder = new Builder($request);

        $builder->setSqlTemplate("
            SELECT
                ri.race_instance_uid
                , ri.race_datetime
                , ri.race_instance_title
                , ri.race_type_code
                , ri.race_status_code
                , rg.race_group_code
                , c.course_uid
                , course_name = c.style_name
                , declared_runners = pri.no_of_runners
                , actual_runners = CASE
                    WHEN pri.race_status_code = " . Constants::RACE_STATUS_CALENDAR . " THEN
                        CASE WHEN rif.forfeit_number IS NULL
                            THEN pri.no_of_runners
                            ELSE rif.forfeit_number
                        END
                    WHEN pri.race_status_code IN (" . Constants::RACE_STATUS_6DAYS . "," . Constants::RACE_STATUS_5DAYS
            . "," . Constants::RACE_STATUS_4DAYS . "," . Constants::RACE_STATUS_3DAYS . ") THEN
                        CASE WHEN pric.rp_confirmed IS NULL
                            THEN pri.no_of_runners
                            ELSE pric.rp_confirmed
                        END
                    WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . " THEN
                        (SELECT
                            COUNT(*)
                        FROM
                            pre_horse_race phr
                        WHERE phr.race_instance_uid = ri.race_instance_uid
                            AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                            AND ISNULL(phr.doubtful_runner, 'N') != 'Y'
                            AND ISNULL(phr.non_runner, 'N') != 'Y'
                            AND ISNULL(phr.irish_reserve_yn, 'N') != 'Y'
                        )
                    ELSE pri.no_of_runners
                END
                , runners = NULL
            FROM
                race_instance ri
            INNER JOIN
                course c ON c.course_uid = ri.course_uid
            INNER JOIN
                pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
                    AND pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
            LEFT JOIN
                pre_race_instance_comments pric ON pric.race_instance_uid = ri.race_instance_uid
            LEFT JOIN
                race_instance_forfeit rif ON rif.race_instance_uid = ri.race_instance_uid AND stage = (
                    SELECT MAX(stage)
                    FROM race_instance_forfeit rif2
                    WHERE rif2.race_instance_uid = ri.race_instance_uid
                )
            LEFT JOIN
                race_group rg ON rg.race_group_uid = ri.race_group_uid
            /*{JOINS}*/
            WHERE
                /*{WHERE}*/
        ");

        return $builder;
    }

    /**
     * @param Request $request
     *
     * @return Builder
     */
    public function getTotePredictorRunnersBuilder(Request $request)
    {
        $builder = new Builder($request);

        $builder->setSqlTemplate("
            SELECT
                phr.race_instance_uid,
                phr.horse_uid,
                horse_name = h.style_name,
                phr.saddle_cloth_no,
                non_runner = CASE
                    WHEN ISNULL(phr.doubtful_runner, 'N') = 'Y'
                        OR ISNULL(phr.non_runner, 'N') = 'Y'
                        OR ISNULL(phr.irish_reserve_yn, 'N') = 'Y'
                    THEN 'Y' ELSE 'N'
                END,
                score =
                    CASE
                        WHEN prn.draw_output = 'a' THEN 1
                        WHEN prn.draw_output = 'aa' THEN 2
                        ELSE 0
                    END +
                    CASE
                        WHEN prn.course_output = 'a' THEN 1
                        WHEN prn.course_output = 'aa' THEN 2
                        ELSE 0
                    END +
                    CASE
                        WHEN prn.going_output = 'a' THEN 1
                        WHEN prn.going_output = 'aa' THEN 2
                        ELSE 0
                    END +
                    CASE
                        WHEN prn.distance_output = 'a' THEN 1
                        WHEN prn.distance_output = 'aa' THEN 2
                        ELSE 0
                    END,
                phr.rp_postmark,
                form =
                    CASE
                        WHEN prn.recent_form_output = 'aa' THEN 5
                        WHEN prn.recent_form_output = 'a' THEN 2
                        -- A question mark sign must be escaped as Sybase treats it as a prepared statement template,
                        -- so applying of function CHAR(63) solves this issue
                        WHEN prn.recent_form_output = CHAR(63) THEN 0
                        WHEN prn.recent_form_output = 'x' THEN -2
                        ELSE 0
                    END,
                conditions_score = 0,
                rpr_score = 0,
                form_score = 0
            FROM pre_horse_race phr
                JOIN horse h ON h.horse_uid = phr.horse_uid
                JOIN race_instance ri ON phr.race_instance_uid = ri.race_instance_uid
                JOIN pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
                LEFT JOIN postdata_results_new prn ON prn.race_instance_uid = phr.race_instance_uid
                    AND prn.horse_uid = phr.horse_uid
            WHERE phr.race_status_code =
                (CASE WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                    ELSE ri.race_status_code
                END)
                AND /*{EXPRESSION(raceCondition)}*/
                AND CASE WHEN pri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        THEN '-1'
                        ELSE
                            CASE WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                THEN '0'
                                ELSE pri.race_status_code
                            END
                    END = (
                        SELECT MIN(CASE WHEN ipri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN '-1'
                            ELSE
                                CASE WHEN ipri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                    THEN '0'
                                    ELSE ipri.race_status_code
                                END
                            END)
                        FROM pre_race_instance ipri
                        WHERE ipri.race_instance_uid = ri.race_instance_uid
                        GROUP BY ipri.race_instance_uid
                    )
        ");

        return $builder;
    }

    /**
     * @param array $horseIds
     *
     * @return array
     */
    public function getLastRunPositions($horseIds)
    {
        if (empty($horseIds)) {
            return [];
        }

        $result = $this->query(
            "
            SELECT
                t.horse_uid
                , last_pos = (SELECT hr2.final_race_outcome_uid FROM horse_race hr2, race_instance ri2
                    WHERE
                        ri2.race_instance_uid = hr2.race_instance_uid
                        AND hr2.horse_uid = t.horse_uid
                        AND ri2.race_datetime = t.race_datetime
                    )
            FROM (
                SELECT
                    hr.horse_uid
                    , race_datetime = MAX(ri.race_datetime)
                FROM
                    race_instance ri
                    , horse_race hr
                WHERE
                    ri.race_instance_uid = hr.race_instance_uid
                    AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                    AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    AND hr.horse_uid IN (:horseIds)
                GROUP BY hr.horse_uid
                ) t
            ",
            [
                'horseIds' => $horseIds
            ]
        );

        return $result->toArrayWithRows('horse_uid');
    }
}
