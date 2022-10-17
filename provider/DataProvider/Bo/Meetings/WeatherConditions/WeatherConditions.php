<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Meetings\WeatherConditions;

use Api\Constants\Horses;
use Api\DataProvider\HorsesDataProvider;
use Phalcon\Db\Sql\Builder;

/**
 * Class WeatherConditions
 *
 * @package Api\DataProvider\Bo\Meetings\WeatherConditions
 */
class WeatherConditions extends HorsesDataProvider
{
    /**
     * @param string $raceDate
     * @param int|null $courseId
     *
     * @throws \Exception
     */
    public function getWeatherConditionsData(string $raceDate, int $courseId = null): array
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT DISTINCT 
                c.course_uid,
                country_code,
                c.course_type_code,
                course_style_name = c.style_name,
                pre_going_desc = pmd.going_desc,
                going_desc = md.going_desc,
                pre_weather_desc = pmd.weather_details,
                md.meeting_date,
                meeting_abandoned = md.meeting_abandoned,
                ri.race_type_code,
                weather_details = null,
                has_finished_race = case when ri.race_status_code = '" . Horses::RACE_STATUS_RESULTS_STR . "' THEN 1 ELSE 0 END
            FROM race_instance ri
                 INNER JOIN course c on ri.course_uid = c.course_uid
                 LEFT JOIN meeting_details md ON md.course_uid = ri.course_uid 
                    AND DATEDIFF(dd, md.meeting_date, ri.race_datetime) = 0
                 LEFT JOIN pre_meeting_details pmd ON pmd.course_uid = ri.course_uid
                    AND DATEDIFF(DD, pmd.meeting_date, ri.race_datetime) = 0
                 INNER JOIN pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
                    AND pri.race_status_code = (
                        CASE
                            WHEN ri.race_status_code = " . Horses::RACE_STATUS_RESULTS . "
                                THEN " . Horses::RACE_STATUS_OVERNIGHT . "
                            ELSE 
                                ri.race_status_code
                            END
                        )
            WHERE ri.race_datetime BETWEEN :startDate AND :endDate
            AND 
                ri.race_status_code != '" . Horses::RACE_STATUS_ABANDONED_STR . "'
            AND
                c.country_code IN ('" . Horses::COUNTRY_GB . "','" . Horses::COUNTRY_IRE . "')
            /*{WHERE}*/
            ORDER BY c.course_uid, ri.race_status_code
	    ");

        $builder->setParam('startDate', date("Y-m-d H:i:s", strtotime($raceDate . " 00:01:00")));
        $builder->setParam('endDate', date("Y-m-d H:i:s", strtotime($raceDate . " 23:59:59")));

        if ($courseId) {
            $builder->where("ri.course_uid = :courseId");
            $builder->setParam('courseId', $courseId);
        }

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        return $data->getGroupedResult(
            [
                'course_uid',
                'meeting_abandoned',
                'country_code',
                'course_style_name',
                'course_type_code',
                'meeting_date',
                'pre_going_desc',
                'going_desc',
                'pre_weather_desc',
                'weather_details',
                'has_finished_race',
                'race_type_codes' =>
                    ['race_type_code']
            ],
            [
                'course_uid',
                'race_type_code'
            ],
        );
    }
}
