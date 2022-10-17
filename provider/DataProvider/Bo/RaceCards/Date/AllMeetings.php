<?php

namespace Api\DataProvider\Bo\RaceCards\Date;

use Api\Exception\InternalServerError;
use Phalcon\Db\Sql\Builder;
use Api\Constants\Horses as Constants;

/**
 * @package Api\DataProvider\Bo\RaceCards\Date
 */
class AllMeetings extends Common
{

    /**
     * @return string
     * @throws InternalServerError
     */
    protected function getGlobalHorsesDbName()
    {
        $db = $this->getRequest()->getSelectors()->getDb();

        return $db->getGlobalHorsesDb();
    }

    /**
     * @return array|null
     * @throws InternalServerError
     */
    public function getData(): ?array
    {
        $raceDate = $this->getRequest()->getRaceDate();
        $countryCode = $this->getRequest()->getCountryCode();

        $countryCodeSQL = $countryCode ? " and country_code like :countryCode " : "";

        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                ri1.course_uid,
                course_name = c1.style_name,
                c1.country_code,
                md.meeting_abandoned,
                ri1.race_status_code,
                ri1.race_instance_uid,
                ri1.race_datetime,
                horses_database = 'Y'
            FROM race_instance ri1
                INNER JOIN course c1 ON c1.course_uid = ri1.course_uid
                LEFT JOIN meeting_details md ON md.course_uid = ri1.course_uid
                    AND  DATEDIFF(DD, md.meeting_date, ri1.race_datetime) = 0
            WHERE
                ri1.race_datetime BETWEEN :startDate AND :endDate
                AND NOT EXISTS (SELECT 1
                    FROM race_attrib_join raj
                    WHERE raj.race_instance_uid = ri1.race_instance_uid 
                        AND raj.race_attrib_uid IN (".Constants::INCOMPLETE_RACE_ATTRIBUTE_ID.")
                        AND NOT EXISTS (SELECT 1 FROM /*{EXPRESSION(globalHorsesDB)}*/..race_instance ri2
                                              WHERE ri1.race_instance_uid = ri2.race_instance_uid)
                                              )
                AND EXISTS (
                    SELECT 1
                    FROM pre_race_instance pri1
                    WHERE pri1.race_instance_uid = ri1.race_instance_uid
                ) " . $countryCodeSQL . "
            UNION

            SELECT
                ri3.course_uid,
                course_name = c3.style_name,
                c3.country_code,
                md.meeting_abandoned,
                ri3.race_status_code,
                ri3.race_instance_uid,
                ri3.race_datetime,
                horses_database = 'N'
            FROM /*{EXPRESSION(globalHorsesDB)}*/..race_instance ri3
                INNER JOIN /*{EXPRESSION(globalHorsesDB)}*/..course c3 ON c3.course_uid = ri3.course_uid
                LEFT JOIN /*{EXPRESSION(globalHorsesDB)}*/..meeting_details md ON md.course_uid = ri3.course_uid
                    AND  DATEDIFF(DD, md.meeting_date, ri3.race_datetime) = 0
            WHERE
                ri3.race_datetime BETWEEN :startDate AND :endDate
                AND EXISTS (
                    SELECT 1
                    FROM /*{EXPRESSION(globalHorsesDB)}*/..pre_race_instance pri3
                    WHERE pri3.race_instance_uid = ri3.race_instance_uid
                )
                AND NOT EXISTS (
                    SELECT 1
                    FROM race_instance ri5
                        INNER JOIN course c5 ON c5.course_uid = ri5.course_uid
                    WHERE ri5.race_datetime = ri3.race_datetime
                        AND c5.course_name = c3.course_name
                        AND NOT EXISTS (SELECT 1
                            FROM race_attrib_join raj2
                            WHERE raj2.race_instance_uid = ri5.race_instance_uid 
                                AND raj2.race_attrib_uid IN (".Constants::INCOMPLETE_RACE_ATTRIBUTE_ID.")
                            )
                        AND EXISTS (
                            SELECT 1
                            FROM pre_race_instance pri5
                            WHERE pri5.race_instance_uid = ri5.race_instance_uid
                        )
                    ) " . $countryCodeSQL . "
            ORDER BY
                race_datetime
        ");
        $builder
            ->setParam('startDate', date("Y-m-d H:i:s", strtotime($raceDate . " 00:01:00")))
            ->setParam('endDate', date("Y-m-d H:i:s", strtotime($raceDate . " 23:59:59")))
            ->setParam('countryCode', $countryCode);

        $builder->expression("globalHorsesDB", $this->getGlobalHorsesDbName());
        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = $data->getGroupedResult([
            'course_uid',
            'course_name',
            'country_code',
            'meeting_abandoned',
            'horses_database',
            'races' => [
                'race_datetime',
                'race_instance_uid',
                'race_status_code',
            ],
        ]);

        return empty($result) ? null : $result;
    }
}
