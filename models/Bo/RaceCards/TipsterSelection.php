<?php

namespace Models\Bo\RaceCards;

use \Api\Constants\Horses as Constants;

/**
 * Class TipsterSelection
 */
class TipsterSelection extends \Models\TipsterSelection
{
    /**
     * @param int $raceId
     * @return \Phalcon\Mvc\ModelInterface
     */
    public function getPostdataSelection($raceId)
    {
        $sql = "
            SELECT
                h.style_name
              , h.country_origin_code
              , h.horse_uid
              , st.selection_type_uid
            FROM
                tipster_selection ts,
                horse h,
                newspapers np,
                selection_type st
            WHERE ts.race_instance_uid = :race_instance_uid
            AND h.horse_uid = ts.horse_uid
            AND np.newspaper_uid = ts.newspaper_uid
            AND np.newspaper_name = 'POSTDATA'
            AND st.selection_type_uid = ts.selection_type_uid
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['race_instance_uid' => $raceId]
        );

        $rows = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $rows->getFirst() ? : null;
    }

    /**
     * @param int $raceId
     * @return \Phalcon\Mvc\Model\Row\General
     */
    public function getTopspeedSelection($raceId)
    {
        $result = $this->getReadConnection()->query(
            "SELECT
                h.style_name,
                h.country_origin_code,
                h.horse_uid,
                st.selection_type_uid
            FROM
                tipster_selection ts,
                horse h,
                newspapers np,
                selection_type st
            WHERE ts.race_instance_uid = :raceInstanceUId:
                AND h.horse_uid = ts.horse_uid
                AND st.selection_type_uid = ts.selection_type_uid
                AND np.newspaper_uid = ts.newspaper_uid
                AND np.newspaper_name = :newspaperName:
                AND ts.selection_type_uid IN (
                    select selection_type_uid from selection_type st where selection_type_code in (:selectionTypeCodes:)
                )
            ",
            [
                'raceInstanceUId' => $raceId,
                'newspaperName' => 'TOPSPEED',
                'selectionTypeCodes' => ['TIP','NAP','NB'],
            ]
        );

        $rows = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $result
        );
        $row = $rows->getFirst();
        return !empty($row) ? $row : null;
    }

    /**
     * @param int $raceId
     * @return \Phalcon\Mvc\Model\Row\General
     */
    public function getSpotlightVerdictSelection($raceId)
    {
        $result = $this->getReadConnection()->query(
            "
            SELECT
                h.style_name,
                h.country_origin_code,
                h.horse_uid,
                st.selection_type_uid,
                phr.saddle_cloth_no,
                phr.non_runner,
                ho.owner_uid,
                phr.rp_owner_choice
            FROM
                tipster_selection ts
            INNER JOIN horse h 
                ON h.horse_uid = ts.horse_uid
            INNER JOIN  newspapers np
                ON np.newspaper_uid = ts.newspaper_uid
                    AND np.newspaper_name = :newspaperName:
            INNER JOIN selection_type st 
                ON st.selection_type_uid = ts.selection_type_uid
            LEFT JOIN race_instance ri
                ON ri.race_instance_uid = ts.race_instance_uid
            LEFT JOIN pre_horse_race phr 
                ON phr.race_instance_uid = ts.race_instance_uid
                    AND phr.horse_uid = ts.horse_uid
                    AND phr.race_status_code = (
                        CASE
                            WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                            THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                            ELSE ri.race_status_code
                        END)
            LEFT JOIN horse_owner ho 
                ON ho.horse_uid = ts.horse_uid
                    AND ho.owner_change_date = ISNULL(
                            (SELECT MIN(t2.owner_change_date)
                            FROM horse_owner t2
                            WHERE
                                t2.horse_uid = ts.horse_uid
                                AND t2.owner_change_date > ri.race_datetime
                            ),
                        '1900-01-01 00:00:00.0'
                    ) 
            WHERE 
                ts.race_instance_uid = :raceInstanceUId:
                AND ts.selection_type_uid IN (
                    select selection_type_uid from selection_type st where selection_type_code in (:selectionTypeCodes:)
                )
            ",
            [
                'raceInstanceUId' => $raceId,
                'newspaperName' => 'SPOTLIGHT',
                'selectionTypeCodes' => ['TIP','NAP','NB'],
            ]
        );

        $rows = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\Horse(),
            $result
        );
        $row = $rows->getFirst();
        return ($row) ? $row : null;
    }
}
