<?php

namespace Models\Bo\RaceMeetings;

use Api\Constants\Horses as Constants;
use Models\Selectors;

/**
 * Class Course
 *
 * @package Models\Bo\RaceMeetings
 */
class Course extends \Models\Course
{
    /**
     * @param int $courseId
     *
     * @return \Phalcon\Mvc\Model\Row\General | null
     */
    public function getMeetingInfo($courseId)
    {
        $sql = '
            SELECT
                course_comments.rp_admission_prices,
                course_comments.rp_parking,
                course_comments.rp_children,
                course_comments.rp_disabled,
                course_comments.rp_flat_course_comment,
                course_comments.rp_jump_course_comment,

                course_details.course_stewards,
                course_details.course_stewards_secs,
                course_details.course_starters,
                course_details.course_judge,
                course_details.course_scales_clerk,
                course_details.course_clerk,
                course_details.course_address,
                course_details.course_tel,

                course.course_name,
                course.course_type_code,
                rtrim(course.country_code) AS country_code
            FROM course
            JOIN course_details ON course_details.course_uid = course.course_uid
            JOIN course_comments ON course_comments.course_uid = course.course_uid
            WHERE
                course.course_uid = :courseId:
        ';

        $res = $this->getReadConnection()->query(
            $sql,
            ['courseId' => $courseId]
        );

        $meetingInfo = new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row\General(), $res);

        //getFirst() will return false if there are no records
        return $meetingInfo->getFirst() ? $meetingInfo->getFirst() : null;
    }

    /**
     * @param \Api\Input\Request\Horses\RaceMeetings\Favourites $request
     *
     * @return array
     */
    public function getFavourites(\Api\Input\Request\Horses\RaceMeetings\Favourites $request, Selectors $selectors)
    {

        $sqlTpl = "
                  SELECT
                      t.*,
                      (CASE WHEN t.race_outcome_position = 1 THEN 1 ELSE 0 END) AS win,
                      (CASE
                            WHEN t.race_outcome_position = 1 THEN
                                CASE
                                    WHEN t.final_race_outcome_uid = 71 THEN
                                       t.odds_value * (1.0/t.num_of_favs/2.0)
                                    ELSE
                                        t.odds_value * (1.0/t.num_of_favs)
                                END
                            ELSE
                                -1.0/t.num_of_favs
                      END) AS profit_loss
                  FROM
                      (
                      SELECT
                          ri.race_instance_uid,
                          ri.race_datetime,
                          ro.race_outcome_position,
                          ro.race_outcome_desc,
                          o.odds_value,
                          %s AS group_by_value,
                          final_race_outcome_uid,
                          (CASE WHEN rg.race_group_code = " . Constants::RACE_GROUP_CODE_HANDICAP . " 
                                THEN 'handicap' 
                                ELSE 'non_handicap' END
                                ) AS handicap_type,
                          (
                              SELECT
                                COUNT(*)
                              FROM
                                horse_race hr2,
                                odds o2
                              WHERE
                                hr2.race_instance_uid = ri.race_instance_uid
                                AND o2.odds_uid = hr2.starting_price_odds_uid
                                AND isnull(o2.favourite_flag, 'x') IN (" . Constants::FAVOURITE_FLAG_CODES . ")
                          ) num_of_favs
                      FROM
                          race_instance ri
                          LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid,
                          season ssn,
                          horse_race hr,
                          horse h,
                          course c,
                          race_outcome ro,
                          odds o
                      WHERE
                          ri.race_instance_uid = hr.race_instance_uid
                          AND ri.race_type_code IN (:raceType:)
                          AND ri.race_datetime BETWEEN ssn.season_start_date AND ssn.season_end_date
                          AND ssn.season_type_code = :seasonType:
                          AND YEAR(ssn.season_start_date) BETWEEN :seasonYearBegin: AND :seasonYearEnd:
                          AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                          AND c.course_uid = :courseId:
                          AND c.course_uid = ri.course_uid
                          AND h.horse_uid = hr.horse_uid
                          AND ro.race_outcome_uid = hr.final_race_outcome_uid
                          AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                          AND o.odds_uid = hr.starting_price_odds_uid
                          AND isnull(o.favourite_flag, 'x') IN (" . Constants::FAVOURITE_FLAG_CODES . ")
                      ) t
                  ORDER BY t.race_datetime
                  ";

        if ($request->getRaceType() == Constants::RACE_TYPE_JUMPS_ALIAS) {
            $groupBy = "
            (CASE
                WHEN ri.race_type_code LIKE '["
                . implode('', $selectors->getJumpsTypeCodes('CHASE')) . "]' THEN 'CHASE'
                WHEN ri.race_type_code LIKE '["
                . implode('', $selectors->getJumpsTypeCodes('HURDLE')) . "]' THEN 'HURDLE'
                WHEN ri.race_type_code LIKE '["
                . implode('', $selectors->getJumpsTypeCodes('NHF')) . "]' THEN 'NHF'
                ELSE ''
            END)";
        } else {
            $groupBy = "
            (CASE
                WHEN YEAR(ri.race_datetime) - YEAR(h.horse_date_of_birth) = 2 THEN '2YO'
                WHEN YEAR(ri.race_datetime) - YEAR(h.horse_date_of_birth) = 3 THEN '3YO'
                ELSE '4YO+'
            END)";
        }

        $params = [
            'courseId' => $request->getCourseId(),
            'seasonYearBegin' => $request->getSeasonYearBegin(),
            'seasonYearEnd' => $request->getSeasonYearEnd(),
            'raceType' => $selectors->getRaceTypeCode($request->getRaceType()),
            'seasonType' => $selectors->getSeasonTypeCode('', $request->getRaceType())
        ];

        $res = $this->getReadConnection()->query(
            sprintf($sqlTpl, $groupBy),
            $params
        );

        $favouritesResObj = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $favouritesResObj->toArrayWithRows();
    }

    /**
     * @param int $courseId
     *
     * @return string
     */
    public function getDefaultRaceTypeCode($courseId)
    {
        $sql = "
            SELECT TOP 1
                ri.race_type_code
            FROM
                race_instance ri
                , course c
            WHERE
                c.course_uid = ri.course_uid
                AND c.course_uid = :courseId:
            ORDER BY
                ri.race_datetime DESC
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['courseId' => $courseId]
        );

        $raceTypeObj = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        $raceTypeArr = $raceTypeObj->toArrayWithRows();
        $raceType = Constants::RACE_TYPE_FLAT_ALIAS;
        if (!(empty($raceTypeArr))) {
            if (strpos(Constants::RACE_TYPE_FLAT, $raceTypeArr[0]->race_type_code) !== false) {
                $raceType = Constants::RACE_TYPE_FLAT_ALIAS;
            } else {
                $raceType = Constants::RACE_TYPE_JUMPS_ALIAS;
            }
        }

        return $raceType;
    }
}
