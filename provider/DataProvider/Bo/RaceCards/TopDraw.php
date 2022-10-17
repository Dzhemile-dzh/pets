<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 10/11/2016
 * Time: 4:03 PM
 */

namespace Api\DataProvider\Bo\RaceCards;

use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;

class TopDraw extends HorsesDataProvider
{
    const LAST_RACES_TMP_TABLE = '#lastYearsRacesTD';
    const OUTCOME_POSITIONS_NOT_QUALIFIED = "'F', 'U', 'C', 'P', 'R', 'O', 'B', 'S'";

    /**
     * Check and drop tmp table in DB
     *
     * @param string $tableName
     */
    public function dropTmpTable($tableName)
    {
        $sql = "
            IF OBJECT_ID('{$tableName}') IS NOT NULL
            DROP TABLE {$tableName}
        ";
        $this->execute($sql, null, null, false);
    }

    /**
     * Drop all temporary tables used by this response
     */
    public function dropTmpTables()
    {
        $this->dropTmpTable($this::LAST_RACES_TMP_TABLE);
    }

    /**
     * Get race data
     *
     * @param int $raceId
     *
     * @return mixed
     */
    public function getRaceInfo($raceId)
    {
        $sql = "
            SELECT course_uid = c.course_uid
                , c.course_name
                , country_code = rtrim(c.country_code)
                , season_10_year = CONVERT(DATETIME,
                    CONVERT(VARCHAR, '1/1/' + CONVERT(CHAR(4), year(dateadd(YEAR, - 10, ri.race_datetime))) + ' 00:01')
                  )
                , pre_race_datetime = ri.race_datetime
                , pre_distance_yard = ri.distance_yard
                , pre_direction = c.direction_flag
                , srj = isnull(ri.straight_round_jubilee_code, ' ')
                , srj_desc = isnull(srj.straight_round_jubilee_desc, ' ')
                , race_type_code = ri.race_type_code
                , pre_stalls_pos = isnull(ri.rp_stalls_position, ' ')
                , race_group_uid = isnull(ri.race_group_uid, 0)
                , pre_race_instance_uid = ri.race_instance_uid
                , pre_going_band_uid = gt.going_band_uid
                , going_type_code = ri.going_type_code
                , pre_going_type_value = gt.rp_going_type_value
                , pre_safety_factor_number = isnull(ri.safety_factor_number, 0)
                , no_of_runners = (
                    SELECT COUNT(*)
                    FROM pre_horse_race phr
                    WHERE phr.race_instance_uid = ri.race_instance_uid
                        AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                        AND isnull(upper(phr.irish_reserve_yn), 'N') = 'N'
                    )
            FROM race_instance ri
                JOIN course c ON ri.course_uid = c.course_uid
                JOIN going_type gt ON ri.going_type_code = gt.going_type_code
                LEFT JOIN straight_round_jubilee srj ON ri.straight_round_jubilee_code = srj.straight_round_jubilee_code
            WHERE ri.race_instance_uid = :race_instance_uid
                AND ri.race_status_code IN (" . Constants::RACE_STATUS_OVERNIGHT . ", " . Constants::RACE_STATUS_4DAYS
            . ", " . Constants::RACE_STATUS_5DAYS . "," . Constants::RACE_STATUS_RESULTS . ")
                AND ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
        ";

        $res = $this->query(
            $sql,
            ['race_instance_uid' => $raceId],
            new \Api\Row\RaceInstance()
        );
        $raceInfo = $res->getFirst();

        if ($raceInfo === false) {
            return null;
        }

        return $raceInfo;
    }

    /**
     * Creates tmp tables with last years races
     *
     * @param $raceInfo
     *
     * @return bool
     */

    public function crateLastYearsRaces($raceInfo)
    {
        // get all last years races for the past 10 years
        $sql = "
            SELECT 
                  ri.race_instance_uid
                , ri.race_datetime
                , safety_factor_number = CASE 
                                            WHEN isnull(ri.safety_factor_number, 0) = 0 
                                            THEN 100 
                                            ELSE ri.safety_factor_number 
                                         END
                , rp_stalls_position = isnull(ri.rp_stalls_position, ' ')
                , ran = (
                    SELECT COUNT(*)
                    FROM horse_race hr
                    WHERE hr.race_instance_uid = ri.race_instance_uid
                        AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                  )
            INTO " . $this::LAST_RACES_TMP_TABLE . "    
            FROM race_instance ri,
                going_type gt
            WHERE ri.race_datetime > :season_10_year:
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND ri.course_uid = :course_uid:
                AND ri.race_type_code = :race_type_code: 
                AND ri.distance_yard BETWEEN (:pre_distance_yard: - 5) AND (:pre_distance_yard: + 5)
                AND isnull(ri.straight_round_jubilee_code, ' ') = :srj: 
                AND isnull(ri.race_group_uid, 0) IN (5, 6, 11, 12, 13, 14, 15, 16)
                AND ri.going_type_code = gt.going_type_code
                AND (gt.going_band_uid = :pre_going_band_uid:
                    OR (:pre_going_type_value: < 7
                        AND (gt.rp_going_type_value = :pre_going_type_value: + 1
                            OR gt.rp_going_type_value = :pre_going_type_value: - 1))
                    OR (:pre_going_type_value: = 7
                        AND gt.rp_going_type_value IN (6, 7))
                )
            ORDER BY
                race_datetime DESC
        ";

        $result = $this->execute(
            $sql,
            [
                'season_10_year' => $raceInfo->season_10_year,
                'course_uid' => $raceInfo->course_uid,
                'race_type_code' => $raceInfo->race_type_code,
                'pre_distance_yard' => $raceInfo->pre_distance_yard,
                'srj' => $raceInfo->srj,
                'pre_going_band_uid' => $raceInfo->pre_going_band_uid,
                'pre_going_type_value' => $raceInfo->pre_going_type_value,
            ],
            null,
            false
        );


        return $result;
    }

    /**
     * Gets last years races
     *
     * @return array
     */
    public function getLastYearsRaces()
    {
        $sql = "
            SELECT * 
            FROM  " . $this::LAST_RACES_TMP_TABLE . "   
            ORDER BY
                race_datetime DESC";

        $races = $this->query(
            $sql,
            [],
            new \Api\Row\RaceInstance()
        );

        return $races->toArrayWithRows();
    }

    /**
     * Get actual stalls positions
     *
     * @return array
     */
    public function getActualStallsPositions()
    {
        $sql = "
            SELECT
                hr.race_instance_uid
                , hr.draw
            FROM  " . $this::LAST_RACES_TMP_TABLE . " t
                JOIN horse_race hr ON hr.race_instance_uid = t.race_instance_uid
            WHERE  hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
            ORDER BY 
                hr.race_instance_uid
                , hr.draw
        ";

        $res = $this->query($sql, null, new \Api\Row\RaceInstance());

        return $res->toArrayWithRows('race_instance_uid', null, true);
    }

    /**
     * Get runners
     *
     * @return array
     */
    public function getRunners()
    {
        $sql = "
            SELECT
                hr.race_instance_uid
                , hr.horse_uid
                , horse_draw = hr.draw
                , pos_num = CASE WHEN ro.race_outcome_form_char IN (" . self::OUTCOME_POSITIONS_NOT_QUALIFIED . ") 
                                 OR ro.race_outcome_position = 0 
                                 THEN 99 ELSE ro.race_outcome_position 
                            END
            FROM  " . $this::LAST_RACES_TMP_TABLE . " t
              JOIN horse_race hr ON hr.race_instance_uid = t.race_instance_uid
              JOIN race_outcome ro ON hr.final_race_outcome_uid = ro.race_outcome_uid
            WHERE  hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
            ORDER BY 
                hr.race_instance_uid
                , ro.race_output_order
        ";

        $res = $this->query($sql, null, new \Api\Row\RaceInstance());

        return $res->toArrayWithRows('race_instance_uid', null, true);
    }
}
