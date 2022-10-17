<?php

namespace Api\DataProvider\Bo\Bloodstock\Stallion;

use Phalcon\Mvc\DataProvider;
use Api\Constants\Horses as Constants;

/**
 * Class ProgenySeason
 *
 * @package Api\DataProvider\Bo\Bloodstock\Stallion
 */
class ProgenySeason extends DataProvider
{
    /**
     * @param int $stallionId
     *
     * @return mixed
     */
    public function getFirstLastProgenyRaceDatetime($stallionId)
    {
        $result = $this->query(
            "
            SELECT
                first_race = MIN(t.race_datetime)
                , last_race = MAX(t.race_datetime)
            FROM (
                SELECT
                    race_datetime = (
                        SELECT
                            ri.race_datetime
                        FROM
                            race_instance ri
                        WHERE
                            hr.race_instance_uid = ri.race_instance_uid
                            AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                            AND YEAR(ri.race_datetime) > 1987
                    )
                FROM
                    horse_race hr
                WHERE
                    hr.horse_uid IN (SELECT DISTINCT horse_uid FROM horse WHERE sire_uid = :horseId:)
            ) t
            ",
            ['horseId' => $stallionId]
        );

        return $result->getFirst();
    }

    /**
     * @param string $raceDatetime
     *
     * @return \Phalcon\Mvc\Model\Row[]
     */
    public function getAppropriateSeasons($raceDatetime)
    {
        $result = $this->query(
            "
            SELECT
                season_start_date
                , season_end_date
                , season_type_code
            FROM
                season
            WHERE
                :raceDateTime BETWEEN season_start_date AND season_end_date
                AND season_type_code IN ('" . Constants::SEASON_TYPE_CODE_FLAT . "','"
            . Constants::SEASON_TYPE_CODE_JUMPS . "','" . Constants::SEASON_TYPE_CODE_JUMPS_IRE . "')
            ",
            [
                'raceDateTime' => $raceDatetime
            ]
        );

        return $result->toArrayWithRows();
    }

    /**
     * @param array $appropriateSeasons
     *
     * @return array
     */
    public function getStartEndSeasonDate(array $appropriateSeasons)
    {
        $season = reset($appropriateSeasons);
        $startDateObj = new \DateTime($season->season_start_date);
        $endDateObj = new \DateTime($season->season_end_date);
        foreach ($appropriateSeasons as $season) {
            $seasonStartDateObj = new \DateTime($season->season_start_date);
            if ((int)$startDateObj->diff($seasonStartDateObj)->format('%r%a') < 0) {
                $startDateObj = $seasonStartDateObj;
            }
            $seasonEndDateObj = new \DateTime($season->season_end_date);
            if ((int)$endDateObj->diff($seasonEndDateObj)->format('%r%a') > 0) {
                $endDateObj = $seasonEndDateObj;
            }
        }

        return [$startDateObj, $endDateObj];
    }

    /**
     * @param int    $stallionId
     * @param string $startDate
     * @param string $endDate
     *
     * @return string
     */
    public function getDefaultProgenyRaceType($stallionId, $startDate, $endDate)
    {
        $rows = $this->query(
            "
            SELECT
                flat = SUM(CASE WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ") THEN 1 END)
                , jumps = SUM(CASE WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_JUMPS . ") THEN 1 END)
            FROM
                race_instance ri
            JOIN
                horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
            JOIN
                horse h ON h.horse_uid = hr.horse_uid AND h.sire_uid = :horseId:
            WHERE
                ri.race_datetime BETWEEN :startDate AND :endDate
            ",
            [
                'horseId' => $stallionId,
                'startDate' => $startDate,
                'endDate' => $endDate
            ]
        );
        $raceTypes = $rows->getFirst();

        return $raceTypes[Constants::RACE_TYPE_FLAT_ALIAS] > $raceTypes[Constants::RACE_TYPE_JUMPS_ALIAS]
            ? Constants::RACE_TYPE_FLAT_ALIAS
            : Constants::RACE_TYPE_JUMPS_ALIAS;
    }

    /**
     * @return \Phalcon\Mvc\ModelInterface
     */
    public function getCurrentSeason()
    {
        $result = $this->query(
            "
            SELECT TOP 1
                raceType = CASE WHEN season_type_code = '" . Constants::SEASON_TYPE_CODE_FLAT . "'
                    THEN '" . Constants::RACE_TYPE_FLAT_ALIAS . "'
                    ELSE '".Constants::RACE_TYPE_JUMPS_ALIAS."'
                END
                , countryCode = CASE
                    WHEN season_type_code = '" . Constants::SEASON_TYPE_CODE_JUMPS_IRE . "'
                        THEN 'IRE'
                        ELSE 'GB'
                    END
                , seasonDateBegin = season_start_date
                , seasonDateEnd = season_end_date
                , seasonYearBegin = YEAR (season_start_date)
                , seasonYearEnd = YEAR (season_end_date)
                , sort_order = CASE WHEN getdate() BETWEEN season_start_date AND season_end_date
                    THEN CASE WHEN season_type_code = '" . Constants::SEASON_TYPE_CODE_JUMPS . "' THEN 1 ELSE 2 END
                    ELSE 3
                END
            FROM
                season
            WHERE
                season_type_code IN ('" . Constants::SEASON_TYPE_CODE_FLAT . "','"
            . Constants::SEASON_TYPE_CODE_JUMPS . "','" . Constants::SEASON_TYPE_CODE_JUMPS_IRE . "')
                AND current_season_yn = 'Y'
            ORDER BY
                sort_order
                , season_end_date DESC"
        );
        return $result->getFirst();
    }

    /**
     * @param $stallionId
     *
     * @return mixed
     */
    public function getLastProgenyRaceDatetime($stallionId)
    {
        $result = $this->query(
            "
            SELECT max ( ri.race_datetime ) as race_datetime
            FROM race_instance ri
            JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
            JOIN horse h ON h.horse_uid = hr.horse_uid
            JOIN course c ON c.course_uid = ri.course_uid
            WHERE
                h.sire_uid = :horseId
            AND h.horse_date_of_birth < ri.race_datetime
            AND ri.race_status_code = 'R'
            AND ri.race_type_code != 'P'
            AND c.country_code IN ('GB', 'IRE')
            ",
            [
                'horseId' => $stallionId
            ]
        );

        return $result->getFirst()['race_datetime'];
    }

    /**
     * @param int    $stallionId
     * @param string $startDate
     * @param string $endDate
     *
     * @return array
     *
     * @throws \Exception
     */
    public function getResultsBySeasons($stallionId, $startDate, $endDate)
    {
        $sql = "
            SELECT
                raceType = CASE WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                    THEN '" . Constants::RACE_TYPE_FLAT_ALIAS . "' 
                    ELSE '" . Constants::RACE_TYPE_JUMPS_ALIAS . "'
                END
                , countryCode = RTRIM(c.country_code)
                , seasonDateBegin = s.season_start_date
                , seasonDateEnd = s.season_end_date
                , seasonYearBegin = YEAR (s.season_start_date)
                , seasonYearEnd = YEAR (s.season_end_date)
                , resultCount = COUNT(ri.race_instance_uid)
            FROM race_instance ri
                JOIN horse_race hr
                    ON hr.race_instance_uid = ri.race_instance_uid
                    AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                    AND hr.horse_uid IN (SELECT horse_uid FROM horse WHERE sire_uid = :stallion_uid)
                JOIN course c
                    ON ri.course_uid = c.course_uid
                JOIN season s
                    ON ri.race_datetime BETWEEN s.season_start_date
                    AND s.season_end_date
                    AND s.season_type_code = CASE
                        WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        THEN '" . Constants::SEASON_TYPE_CODE_FLAT . "'
                        ELSE '" . Constants::SEASON_TYPE_CODE_JUMPS . "'
                    END
                    AND s.season_start_date >= :start_date AND s.season_end_date <= :end_date
            WHERE
                ri.race_datetime BETWEEN :start_date AND :end_date
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND c.country_code IN ('GB', 'IRE')
            GROUP BY
                CASE WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                    THEN '" . Constants::RACE_TYPE_FLAT_ALIAS . "' 
                    ELSE '" . Constants::RACE_TYPE_JUMPS_ALIAS . "'
                END
                , s.season_desc
                , c.country_code
                , s.season_start_date
                , s.season_end_date
            ORDER BY
                7 DESC, 1, 3";

        $result = $this->query(
            $sql,
            [
                'stallion_uid' => $stallionId,
                'start_date' => $startDate,
                'end_date' => $endDate
            ]
        );
        return $result->getFirst();
    }
}
