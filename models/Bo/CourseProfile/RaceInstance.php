<?php

namespace Models\Bo\CourseProfile;

use Api\Constants\Horses as Constants;

/**
 * Class RaceInstance
 *
 * @package Models\Bo\CourseProfile
 */
class RaceInstance extends \Models\RaceInstance
{
    /**
     * @param $courseId
     *
     * @return bool
     */
    public function getLastRaceTypeCode($courseId)
    {
        $res = $this->getReadConnection()->query(
            "
                SELECT
                  TOP 1 race_type_code
                FROM
                  race_instance
                WHERE
                  course_uid = :courseUId
                  AND race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                  ORDER BY race_datetime DESC
            ",
            [
                'courseUId' => $courseId
            ]
        );

        $row = (object)$res->fetch();

        return $row ? $row->race_type_code : null;
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Course\Statistics $request
     * @return array
     */
    public function getStatisticsTopHorses(\Api\Input\Request\Horses\Profile\Course\Statistics $request)
    {
        $sql = "
            SELECT TOP 5
                horse.horse_uid,
                horse.style_name,
                horse.country_origin_code,
                SUM (CASE WHEN race_outcome.race_outcome_code = '1' THEN 1 ELSE 0 END) AS wins,
                COUNT(horse.horse_uid) AS runs,
                t.trainer_uid,
                t.style_name as trainer_name,
                MAX(horse_race.rp_postmark) AS top_rpr,
                CONVERT(DECIMAL(6, 2), SUM(
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
                )) AS stake
            FROM race_instance
            JOIN horse_race ON race_instance.race_instance_uid = horse_race.race_instance_uid
            JOIN horse ON horse_race.horse_uid = horse.horse_uid
            JOIN race_outcome ON
                race_outcome.race_outcome_uid = horse_race.final_race_outcome_uid
                AND race_outcome.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
            LEFT JOIN odds ON odds.odds_uid = horse_race.starting_price_odds_uid
            LEFT JOIN horse_trainer ht ON ht.horse_uid = horse.horse_uid
                AND  ht.trainer_change_date = '" . Constants::EMPTY_DATE . "'
            LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid
            LEFT JOIN horse_race_stats hrs ON
                hrs.race_uid = race_instance.race_instance_uid
                AND hrs.horse_uid = horse.horse_uid
            WHERE
                race_instance.course_uid = :course_uid:
                AND race_instance.race_datetime BETWEEN :season_year_begin: AND :season_year_end:
                AND race_instance.race_type_code IN (:race_type_codes:)
                AND race_instance.race_type_code != " . Constants::RACE_TYPE_P2P . "
            GROUP BY
                t.trainer_uid,
                t.style_name,
                horse.horse_uid,
                horse.style_name,
                horse.country_origin_code
            ORDER BY
                wins DESC,
                runs,
                stake,
                style_name
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'course_uid' => $request->getCourseId(),
                'season_year_begin' => $request->getSeasonDateBegin(),
                'season_year_end' => $request->getSeasonDateEnd(),
                'race_type_codes' => $request->getRaceTypeCodes(),
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\Course(),
            $res
        );

        return $result->toArrayWithRows();
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Course\Statistics $request
     * @return array
     */
    public function getStatisticsTopJockeys(\Api\Input\Request\Horses\Profile\Course\Statistics $request)
    {
        $sql = "
            SELECT TOP 5
                jockey.jockey_uid,
                jockey.style_name,
                jockey.ptp_type_code,
                SUM (CASE WHEN race_outcome.race_outcome_code = '1' THEN 1 ELSE 0 END) AS wins,
                COUNT(jockey.jockey_uid) AS runs,
                CONVERT(DECIMAL(6, 2), SUM(
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
                )) AS stake
            FROM race_instance
            JOIN horse_race ON race_instance.race_instance_uid = horse_race.race_instance_uid
            JOIN jockey ON horse_race.jockey_uid = jockey.jockey_uid
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
                runs,
                stake,
                style_name
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'course_uid' => $request->getCourseId(),
                'season_year_begin' => $request->getSeasonDateBegin(),
                'season_year_end' => $request->getSeasonDateEnd(),
                'race_type_codes' => $request->getRaceTypeCodes(),
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\Course(),
            $res
        );

        return $result->toArrayWithRows();
    }

    /**
     * @param \Api\Input\Request\Horses\Profile\Course\Statistics $request
     * @return array
     */
    public function getStatisticsTopTrainers(\Api\Input\Request\Horses\Profile\Course\Statistics $request)
    {
        $sql = "
            SELECT TOP 5
                trainer.trainer_uid,
                trainer.style_name,
                trainer.ptp_type_code,
                SUM (CASE WHEN race_outcome.race_outcome_code = '1' THEN 1 ELSE 0 END) AS wins,
                COUNT(trainer.trainer_uid) AS runs,
                CONVERT(DECIMAL(6, 2), SUM(
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
                )) AS stake

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

            GROUP BY
                trainer.trainer_uid,
                trainer.style_name
            ORDER BY
                wins DESC,
                runs,
                stake,
                style_name
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'course_uid' => $request->getCourseId(),
                'season_year_begin' => $request->getSeasonDateBegin(),
                'season_year_end' => $request->getSeasonDateEnd(),
                'race_type_codes' => $request->getRaceTypeCodes(),
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\Course(),
            $res
        );

        return $result->toArrayWithRows();
    }


    /**
     * @param \Api\Input\Request\Horses\Profile\Course\Statistics $request
     * @return array
     */
    public function getStatisticsTopOwners(\Api\Input\Request\Horses\Profile\Course\Statistics $request)
    {
        $sql = "
            SELECT TOP 5
                owner.owner_uid,
                owner.style_name,
                owner.ptp_type_code,
                SUM (CASE WHEN race_outcome.race_outcome_code = '1' THEN 1 ELSE 0 END) AS wins,
                COUNT(owner.owner_uid) AS runs,
                CONVERT(DECIMAL(6, 2), SUM(
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
                )) AS stake

            FROM race_instance
            JOIN horse_race ON race_instance.race_instance_uid = horse_race.race_instance_uid
            JOIN owner ON horse_race.owner_uid = owner.owner_uid
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
                owner.owner_uid,
                owner.style_name
            ORDER BY
                wins DESC,
                runs,
                stake,
                style_name
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'course_uid' => $request->getCourseId(),
                'season_year_begin' => $request->getSeasonDateBegin(),
                'season_year_end' => $request->getSeasonDateEnd(),
                'race_type_codes' => $request->getRaceTypeCodes(),
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\Course(),
            $res
        );

        return $result->toArrayWithRows();
    }
}
