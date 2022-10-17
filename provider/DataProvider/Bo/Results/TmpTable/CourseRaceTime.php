<?php

namespace Api\DataProvider\Bo\Results\TmpTable;

use Api\DataProvider\Bo\Results\TmpTable as TmpProvider;
use \Api\Constants\Horses as Constants;

/**
 * Class CourseRaceTime
 *
 * @package Api\DataProvider\Bo\Results\TmpTable
 */
class CourseRaceTime extends TmpProvider
{
    const TMP_TABLE_NAME = 'course_race_time';

    /**
     * Method creates temporary table course_race_timeXXXXXX
     */
    protected function createTmpTable()
    {
        $sql = "
            SELECT
                ri.course_uid
                , ri.race_instance_uid
                , ri.race_datetime
                , real_race_datetime = s.race_datetime
            INTO #{$this->getTmpTableName()}
            FROM race_instance ri
                , (SELECT
                        race_datetime
                        , course_uid
                    FROM race_instance
                    WHERE race_instance_uid = :raceId:
                    ) AS s
                , course
            WHERE ri.course_uid = s.course_uid 
                AND ri.course_uid = course.course_uid
                AND ri.race_instance_uid != :raceId
                AND ri.race_datetime > CONVERT(datetime, CONVERT(varchar, s.race_datetime, 101) + ' 00:01')
                AND ri.race_datetime < CONVERT(datetime, CONVERT(varchar, s.race_datetime, 101) + ' 23:59')
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND (NOT EXISTS (SELECT 1
                                    FROM race_attrib_join raj
                                    WHERE raj.race_instance_uid = ri.race_instance_uid 
                                    AND raj.race_attrib_uid = 432)
                    OR
                    (EXISTS    (SELECT 1
                                    FROM race_attrib_join raj
                                    WHERE raj.race_instance_uid = ri.race_instance_uid 
                                    AND raj.race_attrib_uid = 432)
                        AND course.course_uid IN (" . Constants::FRENCH_COURSES . ")))
            ";
        $this->execute(
            $sql,
            [
                'raceId' => $this->getRaceId()
            ],
            false
        );
    }
}
