<?php

namespace Api\DataProvider\Bo\RaceMeetings;

use Api\DataProvider\HorsesDataProvider;
use Api\Constants\Horses as Constants;

class SilksGen extends HorsesDataProvider
{

    public function getSilksGen(\Api\Input\Request\Horses\RaceMeetings\SilksGen $request)
    {
        $sql = "
            SELECT
                phr.horse_uid
                , phr.rp_owner_choice
                , ri.race_datetime
                , ho.owner_uid
            FROM
                pre_horse_race phr
            JOIN
                race_instance ri ON ri.race_instance_uid = phr.race_instance_uid
            JOIN
                horse_owner ho ON ho.horse_uid = phr.horse_uid
            WHERE
                ri.race_datetime BETWEEN :dateFrom: AND :dateTo:
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                AND ho.owner_change_date = (
                    SELECT
                        MAX(ho2.owner_change_date)
                    FROM
                        horse_owner ho2
                    WHERE
                        ho2.horse_uid = phr.horse_uid
                        AND (ho2.owner_change_date >= ri.race_datetime
                            OR ISNULL(ho2.owner_change_date, '" . Constants::EMPTY_DATE . "') = '"
            . Constants::EMPTY_DATE . "'
                        )
                )
        ";

        $rows = $this->query(
            $sql,
            [
                'dateFrom' => $request->getDateFrom(),
                'dateTo' => $request->getDateTo(),
            ],
            new \Api\Row\RaceMeetings\SilksGen()
        );


        return $rows->toArrayWithRows();
    }
}
