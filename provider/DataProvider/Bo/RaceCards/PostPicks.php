<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\RaceCards;

use Phalcon\Mvc\Model\Row;
use Api\Constants\Horses as Constants;
use Phalcon\Mvc\Model\Resultset\ResultsetException;
use Api\DataProvider\HorsesDataProvider as DataProvider;

/**
 * @package Api\DataProvider\Bo\RaceCards
 */
class PostPicks extends DataProvider
{
    /**
     * @param int $raceId
     *
     * @return Row
     * @throws ResultsetException
     */
    public function getRaceInfo(int $raceId): ?Row
    {
        $priRaceStatusCodeIn = implode(
            ', ',
            [
                Constants::RACE_STATUS_6DAYS,
                Constants::RACE_STATUS_5DAYS,
                Constants::RACE_STATUS_4DAYS,
                Constants::RACE_STATUS_3DAYS
            ]
        );

        $sql = "
            SELECT
                actual_runners = CASE
                    WHEN pri.race_status_code = " . Constants::RACE_STATUS_CALENDAR . " THEN
                        CASE WHEN rif.forfeit_number IS NULL
                            THEN pri.no_of_runners ELSE rif.forfeit_number
                         END
                    WHEN pri.race_status_code IN (" . $priRaceStatusCodeIn . ") THEN
                        CASE
                            WHEN pric.rp_confirmed IS NULL THEN pri.no_of_runners ELSE pric.rp_confirmed
                        END
                    WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . " THEN (
                        SELECT COUNT(*)
                        FROM pre_horse_race phr
                        WHERE
                            phr.race_instance_uid = :raceId
                            AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                            AND (phr.doubtful_runner IS NULL OR phr.doubtful_runner != 'Y')
                            AND (phr.non_runner IS NULL OR phr.non_runner != 'Y')
                            AND (phr.irish_reserve_yn IS NULL OR phr.irish_reserve_yn != 'Y')
                        )
                    ELSE pri.no_of_runners
                END,
                rg.race_group_code
            FROM race_instance ri
                INNER JOIN pre_race_instance pri ON pri.race_instance_uid = ri.race_instance_uid
                LEFT JOIN pre_race_instance_comments pric ON pric.race_instance_uid = ri.race_instance_uid
                LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                LEFT JOIN race_instance_forfeit rif ON rif.race_instance_uid = ri.race_instance_uid
                    AND stage = (
                        SELECT MAX(stage)
                        FROM race_instance_forfeit rif2
                        WHERE rif2.race_instance_uid = ri.race_instance_uid
                    )
            WHERE ri.race_instance_uid = :raceId
                AND CASE WHEN pri.race_status_code = " . Constants::RACE_STATUS_RESULTS . " THEN '-1' ELSE
                        CASE
                            WHEN pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                            THEN '0' ELSE pri.race_status_code
                        END
                    END = (
                        SELECT MIN(
                            CASE
                                WHEN ipri.race_status_code = " . Constants::RACE_STATUS_RESULTS . " THEN '-1'
                                ELSE CASE
                                        WHEN ipri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                                        THEN '0' ELSE ipri.race_status_code
                                    END
                            END
                        )
                        FROM pre_race_instance ipri
                        WHERE ipri.race_instance_uid = ri.race_instance_uid
                        GROUP BY ipri.race_instance_uid
                )
        ";

        $result = $this->query(
            $sql,
            [
                'raceId' => $raceId
            ]
        )->getFirst();

        return $result ?: null;
    }
}
