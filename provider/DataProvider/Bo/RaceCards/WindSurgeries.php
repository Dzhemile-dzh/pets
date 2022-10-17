<?php

namespace Api\DataProvider\Bo\RaceCards;

use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;

/**
 * Class WindSurgeries
 *
 * @package Api\DataProvider\Bo\RaceCards
 */
class WindSurgeries extends HorsesDataProvider
{
    /**
     * @param int $dataId
     *
     * @return array
     */
    public function getData($dataId)
    {
        $result = $this->query(
            "
                SELECT
                main.*,
                is_wind_surgery_first_time = (
                    CASE 
                        WHEN main.amount_races_after_surgery = 0
                        THEN 'Y' ELSE 'N'
                    END
                ),
                is_wind_surgery_second_time = (
                    CASE 
                        WHEN main.amount_races_after_surgery = 1
                        THEN 'Y' ELSE 'N'
                    END
                )
                FROM
                (
                    SELECT
                        ri.race_datetime,
                        phr.horse_uid,
                        amount_races_after_surgery =
                        CASE WHEN
                            (
                                SELECT
                                    MAX(hma.information_receipt_date)
                                FROM
                                    horse_medical_attributes hma
                                WHERE
                                    hma.horse_uid = phr.horse_uid
                                    AND hma.medical_type_uid = 1
                                    AND hma.information_receipt_date < ri.race_datetime
                            ) IS NOT NULL
                        THEN
                            (
                                SELECT COUNT(*) FROM race_instance ri1, horse_race hr1
                                        WHERE
                                            hr1.horse_uid = phr.horse_uid
                                            AND hr1.race_instance_uid = ri1.race_instance_uid
                                            AND hr1.race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                                            AND ri1.race_datetime >
                                                (
                                                    SELECT
                                                        MAX(hma.information_receipt_date)
                                                    FROM
                                                        horse_medical_attributes hma
                                                    WHERE
                                                        hma.horse_uid = phr.horse_uid
                                                        AND hma.medical_type_uid = 1
                                                        AND hma.information_receipt_date < ri.race_datetime
                                                )
                                            AND ri1.race_datetime < ri.race_datetime
                            )
                        ELSE
                            -1
                        END
                    FROM
                        race_instance ri
                        INNER JOIN pre_horse_race phr ON phr.race_instance_uid = ri.race_instance_uid
                    WHERE
                        phr.race_status_code = (
                            CASE
                                WHEN ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                                THEN " . Constants::RACE_STATUS_OVERNIGHT . "
                                ELSE ri.race_status_code
                            END
                        )
                        AND ri.race_instance_uid = :raceId
                        AND ri.race_status_code != " . Constants::RACE_STATUS_ABANDONED . "
                        AND NOT EXISTS (
                            SELECT *
                            FROM race_attrib_join raj
                            WHERE
                                raj.race_instance_uid = ri.race_instance_uid
                                AND raj.race_attrib_uid = :attrId
                        )
                ) AS main
            ",
            [
                'raceId' => $dataId,
                'attrId' => Constants::INCOMPLETE_CARD_ATTRIBUTE_ID,
            ]
        );

        return $result->toArrayWithRows();
    }
}
