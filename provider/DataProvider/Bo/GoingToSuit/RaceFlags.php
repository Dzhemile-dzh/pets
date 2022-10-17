<?php

namespace Api\DataProvider\Bo\GoingToSuit;

use Api\Constants\Horses as Constants;

/**
 * Class RaceFlags
 *
 * @package Api\DataProvider\Bo\GoingToSuit
 */
class RaceFlags extends \Api\DataProvider\HorsesDataProvider
{
    /**
     * @param \Api\Input\Request\Horses\GoingToSuit\RaceFlags $request
     *
     * @return mixed
     */
    public function getHorsesUid($request)
    {
        $sql = "
            SELECT
                ri.race_instance_uid,
                ri.race_datetime,
                ri.going_type_code,
                ri.race_type_code,
                gt.going_type_desc,
                h.horse_uid,
                horse_country_origin_code = h.country_origin_code,
                horse_style_name = h.style_name,
                sire_uid = h.sire_uid,
                going_form = NULL
            FROM race_instance ri
                INNER JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
                INNER JOIN horse h ON h.horse_uid = phr.horse_uid
                LEFT JOIN going_type gt ON gt.going_type_code = ri.going_type_code
            WHERE phr.race_status_code =
                (CASE WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                    ELSE ri.race_status_code
                END)
                AND ri.race_instance_uid = :raceId
            ORDER BY phr.saddle_cloth_no, h.style_name
        ";

        $result = $this->query($sql, ['raceId' => $request->getRaceId()]);

        $dataSet = $result->getGroupedResult(
            [
                'race_instance_uid',
                'race_datetime',
                'race_type_code',
                'going_type_code',
                'going_type_desc',
                'horses' => [
                    'horse_uid',
                    'horse_style_name',
                    'horse_country_origin_code',
                    'sire_uid',
                    'going_form',
                ]
            ]
        );

        return current($dataSet);
    }
}
