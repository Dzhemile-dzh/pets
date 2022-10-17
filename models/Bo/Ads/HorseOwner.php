<?php

namespace Models\Bo\Ads;

class HorseOwner extends \Models\Owner
{
    /**
     * @param int $horseId
     * @return int
     */
    public function getHorseOwnerId($horseId)
    {
        $sql = "
                SELECT
                    owner_uid,
                    (CASE
                        WHEN ho.owner_change_date = CAST('1900-01-01' AS DATE) THEN getdate()
                        ELSE CAST(ho.owner_change_date AS DATE)
                    END)
                FROM
                    horse_owner ho
                WHERE
                    ho.horse_uid = :horse_uid:
                    AND   (
                        CASE
                            WHEN ho.owner_change_date = CAST('1900-01-01' AS DATE) THEN getdate()
                            ELSE CAST(ho.owner_change_date AS DATE)
                        END
                    ) >= CAST('2004-12-28' AS DATE)
                ORDER BY
                    2 DESC
        ";


        $res = $this->getReadConnection()->query(
            $sql,
            [
                'horse_uid' => $horseId
            ]
        );
        $resultCollection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        $result = $resultCollection->toArrayWithRows();
        return $result ? $result[0]->owner_uid : null;
    }
}
