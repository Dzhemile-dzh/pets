<?php

namespace Api\DataProvider\Bo\Bloodstock\Dam;

use Api\Constants\Horses as Constants;
use Phalcon\Mvc\Model\Row\General;
use Api\DataProvider\HorsesDataProvider;

/**
 * Class ProgenyResultsSeasons
 *
 * @package Api\DataProvider\Bo\Bloodstock\Dam
 */
class ProgenyResultsSeasons extends HorsesDataProvider
{
    /**
     * @param int $damId
     *
     * @return General[]
     */
    public function getProgenyResultsSeasons($damId)
    {
        $result = $this->query(
            "SELECT DISTINCT
                season_type = 
                    CASE 
                        WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . " )
                        THEN '" . strtoupper(Constants::RACE_TYPE_FLAT_ALIAS) . "'
                        ELSE '" . strtoupper(Constants::RACE_TYPE_JUMPS_ALIAS) . "'
                    END
                , s.season_start_date
                , s.season_end_date
                , s.season_desc
            FROM
                horse h
            JOIN
                horse_race hr ON hr.horse_uid = h.horse_uid
            JOIN
                race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
            JOIN
                race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
            LEFT JOIN
                race_instance_prize rip ON rip.race_instance_uid = hr.race_instance_uid AND rip.position_no = ro.race_outcome_position
            JOIN
                season s ON season_type_code =
                    CASE 
                        WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . " )
                        THEN '" . Constants::SEASON_TYPE_CODE_FLAT . "'
                        ELSE '" . Constants::SEASON_TYPE_CODE_JUMPS . "' 
                    END 
                    AND ri.race_datetime BETWEEN s.season_start_date AND s.season_end_date
            WHERE
                h.dam_uid = :damId
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
            ORDER BY
                s.season_start_date DESC
            ",
            [
                'damId' => $damId,
            ]
        );

        return $result->toArrayWithRows('season_type', null, true);
    }
}
