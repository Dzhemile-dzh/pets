<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\AdPrompts;

use Api\DataProvider\HorsesDataProvider;
use Phalcon\Mvc\Model\Row;
use Phalcon\Mvc\Model\Row\General;
use Api\Constants\Horses as Constants;

/**
 * Class NextRace
 * @package Api\DataProvider\Bo\AdPrompts
 */
class NextRace extends HorsesDataProvider
{
    /**
     * @return General
     * @throws \Phalcon\Mvc\Model\Resultset\ResultsetException
     */
    public function getNextRace(): Row
    {
        $sql = "
        SELECT TOP 1
            pri.race_instance_uid,
            pri.race_datetime,
            pri.course_uid,
            course_style_name = c.style_name
        FROM
            pre_race_instance pri
            LEFT JOIN course as c ON pri.course_uid = c.course_uid
        WHERE
            pri.race_datetime > GETDATE()
            AND country_code in ('GB','IRE')
        ORDER BY pri.race_datetime
        ";
        return $this->query($sql)->getFirst();
    }

    /**
     * @return int|null
     * @throws \Exception
     */
    public function getLastRecentRace(): ?int
    {
        $sql = "
            SELECT TOP 1 ri.race_instance_uid
            FROM
                race_instance ri
                , course c
            WHERE
                c.country_code IN (:countries)
                AND ri.race_status_code = :raceStatus
                AND ri.race_datetime = (
                    SELECT MAX(race_datetime) FROM race_instance
                    WHERE race_datetime <= :currentDate
                        AND race_status_code = :raceStatus
                )
            ORDER BY ri.race_datetime DESC
        ";

        $params["countries"] = [Constants::COUNTRY_IRE, Constants::COUNTRY_GB];
        $params["raceStatus"] =  Constants::getConstantValue(Constants::RACE_STATUS_RESULTS);
        $params["currentDate"] = (new \DateTime())->format('Y-m-d');

        $result = $this->query($sql, $params)->getField("race_instance_uid");

        return isset($result) && count($result) > 0 ? $result[0] : null;
    }
}
