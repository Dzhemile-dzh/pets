<?php

namespace Models\Bo\Bloodstock\Dam;

use Api\Constants\Horses as Constants;
use Api\Input\Request\Horses\Bloodstock\Dam\ProgenyResultsDefault;
use Phalcon\Mvc\Model\Resultset\General as GeneralResultSet;
use Phalcon\Mvc\Model\Row;

/**
 * Class Horse
 *
 * @package Models\Bo\Bloodstock\Dam
 */
class Horse extends \Models\Horse
{
    private $cutoffYear;

    /**
     * @param ProgenyResults|ProgenyResultsDefault $request
     *
     * @return \Api\Row\Bloodstock\Dam\ProgenyResults[]
     */
    public function getProgenyResults(ProgenyResultsDefault $request)
    {
        $horseId = $request->getDamId();
        $horse = static::find([
            "horse_uid = :horseId:",
            'bind' => [
                'horseId' => $horseId,
            ],
            "limit" => 1
        ])->getFirst();

        $this->cutoffYear = date("Y", strtotime($horse->getHorseDateOfBirth())) + 4;

        $optionalConditions = [];
        $params = [
            'horseId' => $horseId,
            'cutOffYear' => $this->cutoffYear,
        ];

        $startYear = $request->isParameterExists('startYear') ? $request->getStartYear() : null;
        $endYear = $request->isParameterExists('endYear') ? $request->getEndYear() : null;
        if (!empty($startYear) && !empty($endYear)) {
            $optionalConditions[] = ' AND ri.race_datetime BETWEEN :fromDate: AND :toDate: ';
            $params['fromDate'] = $startYear . '-01-01 00:00:00';
            $params['toDate'] = $endYear . '-12-31 23:59:59';
        }

        $raceType = $request->isParameterExists('raceType') ? $request->getRaceType() : null;
        if (!empty($raceType)) {
            $optionalConditions[] = ' AND ri.race_type_code in (:raceTypeCodes:) ';
            $params['raceTypeCodes'] = $request->getRaceTypeCodes();
        }

        $params['flatLikeCodes'] = '[' . str_replace([' ', ',', '\''], '', Constants::RACE_TYPE_FLAT) . ']';
        $params['jumpsLikeCodes'] = '[' . str_replace([' ', ',', '\''], '', Constants::RACE_TYPE_JUMPS) . ']';

        $sql = "
            SELECT
                 t.*,
                 trainer.trainer_uid,
                 trainer.style_name AS trainer_name
             FROM
             (
                SELECT
                    main_type = CASE
                        WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        THEN '" . strtoupper(Constants::RACE_TYPE_FLAT_ALIAS) . "'
                        ELSE '" . strtoupper(Constants::RACE_TYPE_JUMPS_ALIAS) . "'
                    END
                    , h.horse_uid
                    , h.style_name
                    , country_origin_code = ltrim(rtrim(h.country_origin_code))
                    , h_yob = YEAR(h.horse_date_of_birth)
                    , ltrim(rtrim(h.horse_sex_code)) AS horse_sex_code
                    , runs = count(*)
                    , wins = sum(CASE WHEN ro.race_outcome_code = '1' THEN 1 ELSE 0 END)
                    , places = sum(CASE WHEN ro.race_outcome_code LIKE '[23]' THEN 1 ELSE 0 END)
                    , total_prize_money = sum(rip.prize_sterling)
                    , stakes_winner = sum(CASE WHEN isnull(rg.race_group_uid, 0) IN (0, 6)
                                                        OR ro.race_outcome_code NOT LIKE '[123]'
                                                      THEN 0
                                                      ELSE 1
                                                  END)
                    , sire_uid = h1.horse_uid
                    , sire_style_name = h1.style_name
                    , sire_country_origin_code = h1.country_origin_code
                    , MAX(hr.rp_postmark) rp_postmark
                    , sawd.avg_flat_win_dist_of_progeny
                    , distance_yard = NULL
                    , SUM(CASE WHEN ro.race_outcome_position = 1 THEN 1 ELSE 0 END) AS place_1st_number
                    , COUNT(ri.race_instance_uid) AS races_number
                   FROM
                    horse h
                    , horse_race hr
                    , race_instance ri
                    , race_outcome ro
                    , race_instance_prize rip
                    , race_group rg
                    , horse h1
                    , sire sawd
                WHERE
                    h.dam_uid = :horseId:
                    AND hr.horse_uid = h.horse_uid
                    AND ri.race_instance_uid = hr.race_instance_uid
                    AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                    AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    AND YEAR(ri.race_datetime) >= :cutOffYear:
                    AND ro.race_outcome_uid = hr.final_race_outcome_uid
                    AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                    AND rip.race_instance_uid =* hr.race_instance_uid
                    AND rip.position_no =* ro.race_outcome_position
                    AND rg.race_group_uid =* ri.race_group_uid
                    AND h1.horse_uid = h.sire_uid
                    AND sawd.sire_uid =* h.sire_uid
                    " . implode(' ', $optionalConditions) . "

                GROUP BY
                    CASE WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT . ")
                        THEN  '" . strtoupper(Constants::RACE_TYPE_FLAT_ALIAS) . "'
                        ELSE '" . strtoupper(Constants::RACE_TYPE_JUMPS_ALIAS) . "'
                    END
                 , h.horse_uid
                 , h.style_name
                 , h.country_origin_code
                 , YEAR(h.horse_date_of_birth)
                 , h.horse_sex_code
                 , h1.horse_uid
                 , h1.style_name
                 , h1.country_origin_code
                 , sawd.avg_flat_win_dist_of_progeny
            ) t
            JOIN horse_race hr2 ON
                1 = CASE WHEN t.rp_postmark IS NULL AND hr2.rp_postmark IS NULL
                    OR t.rp_postmark = hr2.rp_postmark THEN 1 ELSE 0 END
                AND hr2.horse_uid = t.horse_uid
                AND hr2.race_instance_uid = (
                    SELECT
                        MAX(hr1.race_instance_uid)
                    FROM
                        horse_race hr1,
                        race_instance ri
                    WHERE
                        1 = CASE WHEN t.rp_postmark IS NULL AND hr1.rp_postmark IS NULL
                            OR t.rp_postmark = hr1.rp_postmark THEN 1 ELSE 0 END
                        AND hr1.horse_uid = t.horse_uid
                        AND ri.race_instance_uid = hr1.race_instance_uid
                        AND ri.race_type_code LIKE (
                                CASE 
                                    WHEN t.main_type = '" . strtoupper(Constants::RACE_TYPE_FLAT_ALIAS) . "' 
                                    THEN :flatLikeCodes
                                    ELSE :jumpsLikeCodes
                                END
                            )
                )
            LEFT JOIN trainer ON trainer.trainer_uid = hr2.trainer_uid
            GROUP BY
                t.main_type,
                t.horse_uid,
                trainer.trainer_uid

            ORDER BY
             t.main_type,
             t.rp_postmark DESC,
             t.total_prize_money DESC,
             t.wins,
             t.runs
        ";

        $res = $this->getReadConnection()->query($sql, $params);
        $rows = (new GeneralResultSet(null, new \Api\Row\Bloodstock\Dam\ProgenyResults(), $res))->toArrayWithRows(
            'main_type',
            null,
            true
        );

        $key = strtoupper(Constants::RACE_TYPE_FLAT_ALIAS);
        if (!empty($rows[$key])) {
            array_walk($rows[$key], [$this, 'addDistanceByRpr']);
        }

        $key = strtoupper(Constants::RACE_TYPE_JUMPS_ALIAS);
        if (!empty($rows[$key])) {
            array_walk($rows[$key], [$this, 'addDistanceByRpr']);
        }

        return $rows;
    }

    /**
     * Method is intended for using by 'array_map' function. It finds modal distance (the longest distance which horse
     * has run more times than other distance with best RPR) or if such distance does not exist - longest distance
     *
     * @example:
     *
     *         1540 -> 3 times   |  +
     *         2200 -> 2 times   |
     *         5280 -> 2 times   |
     *
     *         1540 -> 3 times   |
     *         2200 -> 3 times   |  +
     *         5280 -> 2 times   |
     *
     *         1540 -> 1 times   |
     *         2200 -> 1 times   |
     *         5280 -> 1 times   |  +
     *
     * @param \Api\Row\Bloodstock\Dam\ProgenyResults $row
     *
     * @return \Api\Row\Bloodstock\Dam\ProgenyResults
     */
    public function addDistanceByRpr(\Api\Row\Bloodstock\Dam\ProgenyResults $row)
    {
        $res = $this->getReadConnection()->query(
            "SELECT TOP 1 ri1.distance_yard
                    FROM race_instance ri1
                      INNER JOIN horse_race hr1 ON hr1.race_instance_uid = ri1.race_instance_uid
                        AND hr1.horse_uid = :horseId:
                    WHERE YEAR(ri1.race_datetime) >= :cutOffYear: AND hr1.rp_postmark = :bestRpr:
                    GROUP BY ri1.distance_yard
                    HAVING COUNT(*) = MAX(COUNT(*))
                    ORDER BY ri1.distance_yard DESC",
            [
                'horseId' => $row->horse_uid,
                'cutOffYear' => $this->cutoffYear,
                'bestRpr' => $row->rp_postmark,
            ]
        );
        $data = (new GeneralResultSet(null, new Row\General(), $res))->getFirst();
        $row->distance_yard = $data->distance_yard;

        return $row;
    }
}
