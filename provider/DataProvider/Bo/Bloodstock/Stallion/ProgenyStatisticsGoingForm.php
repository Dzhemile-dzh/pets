<?php
namespace Api\DataProvider\Bo\Bloodstock\Stallion;

use Models\Selectors;
use Phalcon\Mvc\DataProvider;
use Phalcon\Mvc\Model\Resultset\Utility\GroupResult;
use Api\Constants\Horses as Constants;

class ProgenyStatisticsGoingForm extends DataProvider
{
    /**
     * @param \Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyStatisticsGoingForm $request
     *
     * @return \Phalcon\Mvc\Model\Row\General[]
     */
    public function getGoingForm(\Api\Input\Request\Horses\Bloodstock\Stallion\ProgenyStatisticsGoingForm $request)
    {
        $result = $this->query(
            "SELECT
                tg.going_group
                , wins = SUM(CASE WHEN tg.final_race_outcome_uid IN (1, 71) THEN 1 ELSE 0 END)
                , runs = COUNT(*)
                , win_percentage = CASE WHEN COUNT(*) > 0
                    THEN
                        ROUND(CAST(100 * SUM(CASE WHEN tg.final_race_outcome_uid IN (1, 71) THEN 1 ELSE 0 END) as float) / CAST(COUNT(*) as float), 0)
                    ELSE
                        NULL
                END
                , impact_value = NULL
            FROM
            (
                SELECT
                    going_group = CASE
                        WHEN ri.going_type_code IN ('HY', 'S', 'SH', 'VS', 'Y') THEN 'heavy_soft'
                        WHEN ri.going_type_code IN ('GS', 'GY')                 THEN 'good_to_soft'
                        WHEN ri.going_type_code IN ('G')                        THEN 'good'
                        WHEN ri.going_type_code IN ('GF')                       THEN 'good_to_firm'
                        WHEN ri.going_type_code IN ('HD', 'F')                  THEN 'firm'
                    END
                    , hr.final_race_outcome_uid
                FROM
                    horse h
                JOIN
                    horse_race hr ON hr.horse_uid = h.horse_uid
                JOIN
                    race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                WHERE
                    h.sire_uid = :stallionId
                    AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
            ) tg
            WHERE
                tg.going_group IS NOT NULL
            GROUP BY
                tg.going_group
            ",
            [
                'stallionId' => $request->getStallionId(),
            ]
        );

        return $result->toArrayWithRows('going_group');
    }

    /**
     * @param array $horseIds
     *
     * @param       $prefix
     *
     * @return \Phalcon\Mvc\Model\Row\General[]
     */
    public function getGoingFormBySire(array $horseIds, $prefix)
    {
        switch ($prefix) {
            case "detailed":
                $sub = "WHEN ri.going_type_code IN ('HY', 'SH')                 THEN 'heavy'
                        WHEN ri.going_type_code IN ('S', 'VS', 'Y')             THEN 'soft'";
                break;
            default:
                $sub = "WHEN ri.going_type_code IN ('HY', 'SH', 'S', 'VS', 'Y')     THEN 'heavy_soft'";
        }

        $sql = "SELECT
                tg.sire_uid
                , going_group = tg.going_group
                , wins = SUM(CASE WHEN tg.final_race_outcome_uid IN (1, 71) THEN 1 ELSE 0 END)
                , runs = COUNT(*)
                , sire_going_runs = SUM(tg.sire_going_run)
                , sire_going_wins = SUM(tg.sire_going_win)
                , win_percentage = CASE WHEN COUNT(*) > 0
                    THEN
                        ROUND(CAST(100 * SUM(CASE WHEN tg.final_race_outcome_uid IN (1, 71) THEN 1 ELSE 0 END) as float) / CAST(COUNT(*) as float), 0)
                    ELSE
                        NULL
                END
                , impact_value = NULL
            FROM
            (
                SELECT
                    h.sire_uid
                    , going_group = CASE
                        {$sub}
                        WHEN ri.going_type_code IN ('GS', 'GY')                 THEN 'good_to_soft'
                        WHEN ri.going_type_code IN ('G')                        THEN 'good'
                        WHEN ri.going_type_code IN ('GF')                       THEN 'good_to_firm'
                        WHEN ri.going_type_code IN ('HD', 'F')                  THEN 'firm'
                    END
                    , sire_going_run =
                        CASE
                            WHEN ri.going_type_code IN ('HY', 'S', 'SH', 'VS', 'Y', 'GS', 'GY', 'G', 'GF', 'HD', 'F')
                            THEN 1
                            ELSE 0
                        END
                    , sire_going_win =
                        CASE
                            WHEN ri.going_type_code IN ('HY', 'S', 'SH', 'VS', 'Y', 'GS', 'GY', 'G', 'GF', 'HD', 'F')
                                AND hr.final_race_outcome_uid IN (1, 71)
                            THEN 1
                            ELSE 0
                        END
                    , hr.final_race_outcome_uid
                FROM
                    horse h
                JOIN
                    horse_race hr ON hr.horse_uid = h.horse_uid
                JOIN
                    race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                WHERE
                    h.sire_uid IN (SELECT sire_uid FROM horse WHERE horse_uid IN(:horseIds:))
                    AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ", 0)
            ) tg
            WHERE
                tg.going_group IS NOT NULL
            GROUP BY
                tg.sire_uid
                , tg.going_group
            ";

        $result = $this->query($sql, ['horseIds' => $horseIds]);

        $sireData = $result->toArrayWithRows();

        $sireGroupedData = [];
        if (!empty($sireData)) {
            $groupResult = new GroupResult(['sire_uid', 'going_group']);
            $sireGroupedData = $groupResult->getGroupedResult($sireData, [
                'sire_uid',
                'going_groups(\Phalcon\Mvc\Model\Row\General)' => [
                    'going_group',
                    'wins',
                    'runs',
                    'sire_going_runs',
                    'sire_going_wins',
                    'win_percentage',
                    'impact_value',
                ]
            ]);
        }

        return $sireGroupedData;
    }
}
