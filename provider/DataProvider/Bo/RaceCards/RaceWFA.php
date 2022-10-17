<?php

namespace Api\DataProvider\Bo\RaceCards;

use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;

class RaceWFA extends HorsesDataProvider
{
    /**
     * @param $raceId       int
     * @param $raceStatus   string
     * @param $raceDateTime string
     *
     * @return \Api\Row\RaceInstance|boolean
     *
     * @codeCoverageIgnore
     */
    public function getTopStats($raceId, $raceStatus, $raceDateTime)
    {
        $raceDT = $this->getDI()->getDb()->escapeString($raceDateTime);

        $sql = "
            SELECT
                t.max_age
                , t.min_age
                , top_age = (SELECT datediff(year, h.horse_date_of_birth, {$raceDT}))
            FROM
                (
                SELECT
                    max_age = MAX(rd.age)
                    , min_age = MIN(rd.age)
                    , topwt = MAX(rd.weight_carried_lbs)
                    , best_horse_uid = MAX(CASE
                          WHEN  MAX(rd.weight_carried_lbs) = rd.weight_carried_lbs
                          THEN rd.horse_uid
                      END
                    )
                FROM (
                    SELECT age = datediff(year, h.horse_date_of_birth, {$raceDT})
                        , phr.weight_carried_lbs
                        , phr.official_rating
                        , phr.horse_uid
                    FROM pre_horse_race phr
                        JOIN horse h ON h.horse_uid = phr.horse_uid
                    WHERE phr.race_instance_uid = :raceId:
                        AND phr.race_status_code = :raceStatus:
                    ) rd
                ) t
                , pre_horse_race phr
                , horse h
            WHERE phr.race_instance_uid = :raceId:
                AND phr.race_status_code = :raceStatus:
                AND phr.horse_uid = t.best_horse_uid
                AND h.horse_uid = phr.horse_uid
        ";

        $rows = $this->query(
            $sql,
            [
                'raceId' => $raceId,
                'raceStatus' => $raceStatus,
            ],
            new \Api\Row\RaceInstance()
        );


        return $rows->getFirst();
    }

    /**
     * @param int $raceId
     *
     * @return \Api\Row\RaceInstance|boolean
     *
     * @codeCoverageIgnore
     */
    public function getRaceInfo($raceId)
    {
        $sql = "
            SELECT
                ri.race_type_code,
                ri.race_datetime,
                ri.race_status_code,
                ri.distance_yard,
                going_type_code = rtrim(gt.going_type_code)
            FROM race_instance ri
                LEFT JOIN going_type gt ON ri.going_type_code = gt.going_type_code
            WHERE
                ri.race_instance_uid = :race_instance_uid
        ";

        $rows = $this->query(
            $sql,
            ['race_instance_uid' => $raceId],
            new \Api\Row\RaceInstance()
        );

        return $rows->getFirst();
    }

    /**
     * @param int    $raceId
     * @param string $raceStatus
     * @param string $raceDateTime
     * @param string $raceType
     * @param int    $topAge
     *
     * @return array
     *
     * @codeCoverageIgnore
     */
    public function getRaceHorses(int $raceId, string $raceStatus, string $raceDateTime, string $raceType, int $topAge)
    {
        $raceDateTime = $this->getDI()->getDb()->escapeString($raceDateTime);
        $raceType = $this->getDI()->getDb()->escapeString($raceType);

        $sql = "
            SELECT
                t2.horse_uid
                , adjusted_age =
                CASE
                    WHEN {$raceType} IN (" . Constants::RACE_TYPE_FLAT . ") THEN
                    CASE WHEN t2.adjusted_age > 5 THEN 5 ELSE t2.adjusted_age END
                    ELSE
                        CASE
                            WHEN {$raceType} NOT IN (" . Constants::RACE_TYPE_HURDLE . ") AND t2.adjusted_age > 6 THEN 6
                            WHEN {$raceType} IN (" . Constants::RACE_TYPE_HURDLE . ") AND t2.adjusted_age > 5 THEN 5
                            ELSE t2.adjusted_age
                        END
                END
                , t2.age
                , t2.weight_carried_lbs
                , wfage =
                CASE
                    WHEN {$raceType} IN (" . Constants::RACE_TYPE_FLAT . ") THEN
                    CASE
                        WHEN t2.wfage > 3 AND {$topAge} = 3 THEN 3
                        WHEN t2.wfage > 4 THEN 4
                        ELSE t2.wfage
                    END
                    WHEN {$raceType} IN (" . Constants::RACE_TYPE_HURDLE . ") THEN
                    CASE
                        WHEN t2.wfage <= 3 OR (t2.wfage > 3 AND {$topAge} = 3) THEN 3
                        WHEN t2.wfage > 3 AND ({$topAge} != 3 OR {$topAge} = 0) THEN 4
                        ELSE t2.wfage
                    END
                    WHEN {$raceType} IN (" . Constants::RACE_TYPE_CHASE . ") THEN
                    CASE
                        WHEN t2.wfage < 5 OR (t2.wfage > 4 AND {$topAge} = 4) THEN 4
                        WHEN t2.wfage > 4 AND ({$topAge} != 4 OR {$topAge} = 0) THEN 5
                        ELSE t2.wfage
                    END
                    ELSE t2.wfage
                END
                , wfa = 0
                , currhp =
                CASE
                    WHEN {$raceType} IN (" . Constants::RACE_TYPE_HURDLE . ") THEN current_form_rating_hurdle
                    WHEN {$raceType} IN (" . Constants::RACE_TYPE_CHASE . ")  THEN current_form_rating_chase
                    ELSE 0
                END
                 , currhp2 =
                CASE
                    WHEN {$raceType} IN (" . Constants::RACE_TYPE_HURDLE . ") THEN current_form_rating_chase
                    WHEN {$raceType} IN (" . Constants::RACE_TYPE_CHASE . ")  THEN current_form_rating_hurdle
                    ELSE 0
                END
                , lsnum =
                CASE
                    WHEN {$raceType} IN (" . Constants::RACE_TYPE_HURDLE . ") THEN ls_form_rating_hurdle
                    WHEN {$raceType} IN (" . Constants::RACE_TYPE_CHASE . ")  THEN ls_form_rating_chase
                    ELSE 0
                END
                , lsnum2 =
                CASE
                    WHEN {$raceType} IN (" . Constants::RACE_TYPE_HURDLE . ") THEN ls_form_rating_chase
                    WHEN {$raceType} IN (" . Constants::RACE_TYPE_CHASE . ")  THEN ls_form_rating_hurdle
                    ELSE 0
                END
            FROM
                (
                SELECT
                    t1.horse_uid
                    , t1.weight_carried_lbs
                    , t1.age
                    , wfage = CASE WHEN t1.age BETWEEN 2 AND 20 THEN t1.age ELSE 0 END
                    , adjusted_age = CASE WHEN t1.age BETWEEN 2 AND 20 THEN t1.age ELSE 0 END
                    , t1.ls_form_rating_chase
                    , t1.ls_form_rating_hurdle
                    , t1.current_form_rating_chase
                    , t1.current_form_rating_hurdle
                FROM
                    (
                    SELECT phr.horse_uid
                        , phr.weight_carried_lbs
                        , age = datediff(YEAR, h.horse_date_of_birth, {$raceDateTime})
                        , currhp = CONVERT(INT, current_form_rating)
                        , currhp2 = 0
                        , lsnum = CONVERT(INT, ls_form_rating)
                        , lsnum2 = 0
                        , ls_form_rating_chase = isnull(rh.ls_form_rating_chase, 0)
                        , ls_form_rating_hurdle = isnull(rh.ls_form_rating_hurdle, 0)
                        , current_form_rating_chase = isnull(rh.current_form_rating_chase, 0)
                        , current_form_rating_hurdle = isnull(rh.current_form_rating_hurdle, 0)
                    FROM pre_horse_race phr
                        , horse h
                        , racing_horse rh
                    WHERE phr.race_instance_uid = :raceId
                        AND phr.race_status_code = convert(char(1), :raceStatus)
                        AND h.horse_uid = phr.horse_uid
                        AND rh.horse_uid =* h.horse_uid
                    ) t1
                ) t2
            ORDER BY
                2
                , t2.age
        ";

        $rows = $this->query(
            $sql,
            [
                'raceId' => $raceId,
                'raceStatus' => $raceStatus,
            ],
            new \Api\Row\RaceInstance()
        );

        return $rows->toArrayWithRows();
    }

    /**
     * Gets weight allowances and ages for a flat race
     *
     * @param object $race
     * @param int    $raceMonth
     * @param int    $raceMonthHalf
     *
     * @return array
     *
     * @codeCoverageIgnore
     */
    public function getWfAgesFlat($race, $raceMonth, $raceMonthHalf)
    {
        $sql = "
            SELECT
              age
              , wfa = CONVERT(INT, weight_allowance_lbs)
              , race_type_code = NULL
            FROM flat_weight_for_age
            WHERE distance_furlongs = :furlong
                AND month = :raceMonth
                AND CONVERT(INT, month_half_1_or_2) = :raceMonthHalf
                AND weight_allowance_lbs != 0
                AND age BETWEEN :minAge AND :topAge
        ";

        $res = $this->query(
            $sql,
            [
                'minAge' => $race->minAge,
                'topAge' => $race->topAge,
                'furlong' => $race->furlong,
                'raceMonth' => $raceMonth,
                'raceMonthHalf' => $raceMonthHalf,
            ]
        );

        return $res->toArrayWithRows('age', null, true);
    }

    /**
     * Gets weight allowances and ages for a jumps race
     *
     * @param object $race
     * @param int    $raceMonth
     *
     * @return array
     *
     * @codeCoverageIgnore
     */
    public function getWfAgesJumps($race, $raceMonth)
    {
        $sql = "
            SELECT
              age
              , wfa = CONVERT(INT, weight_allowance_lbs)
              , race_type_code
            FROM jump_weight_for_age
            WHERE distance_furlongs = :furlong
                AND month = :raceMonth
                AND race_type_code IN (" . Constants::RACE_TYPE_HURDLE_TURF . "," . Constants::RACE_TYPE_CHASE_TURF . ")
                AND weight_allowance_lbs != 0
                AND age BETWEEN :minAge AND :topAge
        ";

        $res = $this->query(
            $sql,
            [
                'minAge' => $race->minAge,
                'topAge' => $race->topAge,
                'furlong' => $race->furlong,
                'raceMonth' => $raceMonth,
            ]
        );

        return $res->toArrayWithRows('age', null, true);
    }
}
