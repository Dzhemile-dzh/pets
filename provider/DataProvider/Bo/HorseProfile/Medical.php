<?php

namespace Api\DataProvider\Bo\HorseProfile;

use Phalcon\Mvc\Model\Row\General;

class Medical extends \Phalcon\Mvc\DataProvider
{
    /**
     * @param integer $horseId
     * @return General
     */
    public function getMedicalInfo($horseId)
    {
        $sql = "
            SELECT
                h.style_name as horse_name,
                mt.description as medical_type,
                hma.information_receipt_date as medical_date
            FROM
                horse_medical_attributes hma
                INNER JOIN medical_type mt ON mt.medical_type_uid = hma.medical_type_uid
                INNER JOIN horse h ON h.horse_uid = hma.horse_uid
            WHERE hma.horse_uid = :horseId:
            ORDER BY medical_date DESC
        ";

        $result = $this->query($sql, ['horseId' => $horseId]);

        $resultData =  $result->getGroupedResult(
            [
                'horse_name',
                'medical_info' => [
                    'medical_type',
                    'medical_date'
                ]
            ],
            ['horse_name' => null]
        );

        return empty($resultData) ? General::createFromArray([]) : current($resultData);
    }
}
