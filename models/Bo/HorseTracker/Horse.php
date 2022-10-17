<?php

namespace Models\Bo\HorseTracker;

use Phalcon\Mvc\Model\Resultset\General as ResultSet;
use Api\Constants\Horses as Constants;

class Horse extends \Models\Horse
{
    /**
     * @param \Api\Input\Request\Horses\HorseTracker\Index $request
     * @param \Models\Selectors                            $selectors
     *
     * @return array
     * @throws \Exception
     */
    private function getFilters(
        \Api\Input\Request\Horses\HorseTracker\Index $request,
        \Models\Selectors $selectors
    ) {
        $filters = [
            'filter' => '',
            'params' => []
        ];

        if ($request->isParameterSet('raceType')) {
            $filters['filter'] = '
                WHERE (EXISTS (
                    SELECT 1
                    FROM pre_horse_race phr1
                        JOIN race_instance ri1 ON
                            ri1.race_instance_uid = phr1.race_instance_uid
                            AND phr1.race_status_code = (CASE WHEN ri1.race_status_code = \'R\' THEN \'O\' ELSE ri1.race_status_code END)
                            AND ri1.race_type_code IN (:raceTypeCodes:)
                    WHERE
                        phr1.horse_uid = h.horse_uid
                        AND ri1.race_datetime > getdate()
                ) OR EXISTS (
                    SELECT 1
                    FROM horse_race hr
                        JOIN race_instance ri2 ON
                            ri2.race_instance_uid = hr.race_instance_uid
                            AND ri2.race_status_code = \'R\'
                            AND ri2.race_type_code IN (:raceTypeCodes:)
                    WHERE
                        hr.horse_uid = h.horse_uid
                        AND ri2.race_datetime = (
                            SELECT MAX(ri3.race_datetime)
                            FROM horse_race hr3
                                JOIN race_instance ri3 ON
                                    ri3.race_instance_uid = hr3.race_instance_uid
                                    AND ri3.race_status_code = \'R\'
                                    AND ri3.race_type_code IN (:raceTypeCodes:)
                            WHERE hr3.horse_uid = h.horse_uid
                        )
                )
            )';

            $filters['params']['raceTypeCodes'] = $request->getRaceTypeCodes();

            if ($request->isParameterSet('age')) {
                $age = $request->getAge();
                $horseAgeSql = $selectors->getHorseAgeSql(
                    'h.horse_date_of_birth',
                    'h.country_origin_code',
                    'getdate()'
                );
                $filters['filter'] .= ' AND '
                    . $horseAgeSql
                    . ((strpos($age, '+') > 0) ? '>=' : '=')
                    . ':age';
                $filters['params']['age'] = intval($age);
            }
        }
        return $filters;
    }

    public function getHorsesByUser(
        \Api\Input\Request\Horses\HorseTracker\Index $request,
        \Models\Selectors $selectors
    ) {
        $ugcDb = $selectors->getDb()->getUgcDb();
        $filters = $this->getFilters($request, $selectors);

        $ageSql = $selectors->getHorseAgeSQL('h.horse_date_of_birth', 'h.country_origin_code', 'getdate()');

        $sql = "
            SELECT
                h.horse_uid,
                h.horse_name,
                h.style_name horse_style_name,
                h.country_origin_code,
                h.horse_date_of_birth,
                h.dam_uid,
                h.sire_uid,
                horse_sire.horse_name AS sire_horse_name,
                horse_sire.style_name AS sire_style_name,
                horse_dam.horse_name AS dam_horse_name,
                horse_dam.style_name AS dam_style_name,
                o.owner_uid,
                o.owner_name AS owner_name,
                o.style_name AS owner_style_name,
                t.trainer_uid,
                t.trainer_name AS trainer_name,
                t.style_name AS trainer_style_name,
                horse_entered = (
                    CASE WHEN EXISTS (
                        SELECT 1
                        FROM
                            race_instance ri_he
                        INNER JOIN pre_horse_race phr_he ON phr_he.race_instance_uid = ri_he.race_instance_uid
                            AND  phr_he.race_status_code = ri_he.race_status_code
                        WHERE
                            phr_he.horse_uid = h.horse_uid
                            AND ri_he.race_datetime >= CONVERT(DATETIME, CONVERT(DATE, GETDATE()))
                            AND ri_he.race_type_code != " . Constants::RACE_TYPE_P2P . "
                            AND NOT EXISTS (
                                    SELECT 1 FROM race_attrib_lookup ral, race_attrib_join raj
                                    WHERE raj.race_instance_uid = ri_he.race_instance_uid
                                        AND raj.race_attrib_uid = ral.race_attrib_uid
                                        AND ral.race_attrib_uid IN (:exclude1:, :exclude2:)
                                )
                    )
                    THEN 1
                    ELSE 0
                    END
                ),
                horse_declared = (
                    CASE WHEN EXISTS (
                        SELECT 1
                        FROM
                            pre_race_instance pri
                        INNER JOIN pre_horse_race phr ON phr.race_instance_uid = pri.race_instance_uid
                        INNER JOIN race_instance ri ON ri.race_instance_uid = pri.race_instance_uid
                        WHERE
                            phr.horse_uid = h.horse_uid
                            AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                            AND pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                            AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                            AND pri.race_datetime >= CONVERT(DATETIME, CONVERT(DATE, GETDATE()))
                    )
                    THEN 1
                    ELSE 0
                    END
                ),
                stats.wins,
                stats.runs,
                stats.stake,
                rht.note,
                horse_age = {$ageSql},
                rpr_figure = (
                    CASE WHEN rh.master_postmark_chase IS NOT NULL
                    THEN rh.master_postmark_chase
                    ELSE
                        CASE WHEN rh.master_postmark_hurdle IS NOT NULL
                        THEN rh.master_postmark_hurdle
                        ELSE
                            CASE WHEN rh.master_postmark_bumper IS NOT NULL
                            THEN rh.master_postmark_bumper
                            ELSE
                                CASE WHEN rh.master_postmark_flat_turf IS NOT NULL
                                THEN rh.master_postmark_flat_turf
                                ELSE
                                    CASE WHEN rh.master_postmark_flat_aw IS NOT NULL
                                    THEN rh.master_postmark_flat_aw
                                    ELSE NULL
                                    END
                                END
                            END
                        END
                    END
                ),
                (
                    SELECT
                        MAX(ri.race_type_code)
                    FROM
                        race_instance ri
                        JOIN pre_horse_race phr ON ri.race_instance_uid = phr.race_instance_uid
                                  AND  phr.race_status_code = ri.race_status_code
                    WHERE ri.race_datetime =
                    (
                        SELECT
                            MIN(ri.race_datetime)
                        FROM race_instance ri
                        JOIN pre_horse_race phr ON ri.race_instance_uid = phr.race_instance_uid
                          AND  phr.race_status_code = ri.race_status_code
                        WHERE
                            ri.race_datetime >= CONVERT(DATETIME, CONVERT(DATE, GETDATE()))
                            AND phr.horse_uid = h.horse_uid
                    )
                    AND phr.horse_uid = h.horse_uid
                    AND (phr.non_runner IS NULL OR phr.non_runner != 'Y')
                    AND (phr.irish_reserve_yn IS NULL OR phr.irish_reserve_yn != 'Y')
                    AND (phr.doubtful_runner IS NULL OR phr.doubtful_runner != 'Y')
                ) next_race_type_code,
                (
                    SELECT
                        MAX(ri.race_type_code)
                    FROM
                        race_instance ri
                        INNER JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                    WHERE
                        hr.horse_uid = h.horse_uid
                        AND ri.race_datetime =
                        (
                            SELECT
                                MAX(ri.race_datetime)
                            FROM
                                race_instance ri
                                INNER JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                            WHERE
                                ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . " 
                                AND hr.horse_uid = h.horse_uid
                        )
                ) last_race_type_code
            FROM
            horse h
            LEFT JOIN (
                SELECT
                    hr.horse_uid,
                    runs = COUNT(*),
                    wins = SUM(CASE WHEN ro.race_outcome_code = '1' THEN 1 ELSE 0 END),
                    stake = SUM(CASE WHEN hr.final_race_outcome_uid IN (1, 71)
                                  THEN
                                        CASE WHEN hr.final_race_outcome_uid = 71
                                            THEN(o.odds_value / 2) - 0.50
                                            ELSE o.odds_value
                                        END
                                  ELSE - 1
                             END)
                FROM race_instance ri
                    INNER JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
                    INNER JOIN {$ugcDb}..organiser_horses rht ON rht.horse_uid = hr.horse_uid
                        AND rht.reg_uid = :userId:
                        AND rht.alert_me = 'Y'
                    INNER JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                    LEFT JOIN odds o ON hr.starting_price_odds_uid = o.odds_uid
                WHERE
                    ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                    AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                GROUP BY hr.horse_uid
            ) stats ON h.horse_uid = stats.horse_uid
            INNER JOIN {$ugcDb}..organiser_horses rht ON rht.horse_uid = h.horse_uid
               AND rht.reg_uid = :userId:
               AND rht.alert_me = 'Y'
            LEFT JOIN horse horse_sire ON horse_sire.horse_uid = h.sire_uid
            LEFT JOIN horse horse_dam ON horse_dam.horse_uid = h.dam_uid
            LEFT JOIN horse_owner ho ON ho.horse_uid = h.horse_uid
              AND isnull(ho.owner_change_date, '1900-01-01 00:00:00.0') = '1900-01-01 00:00:00.0'
            LEFT JOIN owner o ON o.owner_uid = ho.owner_uid
            LEFT JOIN horse_trainer ht ON ht.horse_uid = h.horse_uid
              AND isnull(ht.trainer_change_date, '1900-01-01 00:00:00.0') = '1900-01-01 00:00:00.0'
            LEFT JOIN trainer t ON t.trainer_uid = ht.trainer_uid
            LEFT JOIN racing_horse rh ON rh.horse_uid = h.horse_uid
            {$filters['filter']}
        ";

        $result = $this->getReadConnection()->query(
            $sql,
            array_merge(
                [
                    'userId' => $request->getUserId(),
                    'exclude1' => Constants::INCOMPLETE_CARD_ATTRIBUTE_ID,
                    'exclude2' => Constants::INCOMPLETE_RACE_ATTRIBUTE_ID
                ],
                $filters['params']
            )
        );

        $resultSet = new ResultSet(null, new \Api\Row\Horse(), $result);
        return $resultSet->toArrayWithRows();
    }
}
