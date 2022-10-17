<?php

namespace Models\Bo\RaceMeetings;

class CourseRecords extends \Models\CourseRecords
{
    /**
     * @param int $courseId
     * @param array $raceTypeCodes
     *
     * @return array
     */
    public function getStandardTimesRecords($courseId, array $raceTypeCodes)
    {
        $sql = "
            SELECT
                course_records.race_type_code,
                course_records.straight_round_jubilee_code,
                course_records.race_date,
                course_records.horse_name,
                course_records.distance_yards,
                course_records.time_secs,
                ages_allowed.rp_ages_allowed_desc,
                dist_ave_time.no_of_fences,
                dist_ave_time.average_time_sec

            FROM course_records
            JOIN ages_allowed ON ages_allowed.ages_allowed_uid = course_records.ages_allowed_uid
            JOIN course ON course_records.course_uid = course.course_uid
            LEFT JOIN dist_ave_time ON
                dist_ave_time.course_uid = course_records.course_uid
                AND dist_ave_time.race_type_code = course_records.race_type_code
                AND dist_ave_time.distance_yard = course_records.distance_yards
                AND (
                    dist_ave_time.straight_round_jubilee_code = course_records.straight_round_jubilee_code
                    OR (dist_ave_time.straight_round_jubilee_code IS NULL AND course_records.straight_round_jubilee_code IS NULL)
                )

            WHERE
                course.course_uid = :courseId:
                AND course_records.race_type_code IN (:raceTypeCodes:)

            ORDER BY
                course_records.distance_yards,
                course_records.race_type_code
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'courseId' => $courseId,
                'raceTypeCodes' => $raceTypeCodes
            ]
        );

        $meetingInfo = new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row\General(), $res);
        $result = $meetingInfo->toArrayWithRows();

        return !empty($result) ? $result : null;
    }
}
