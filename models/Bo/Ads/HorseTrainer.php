<?php

namespace Models\Bo\Ads;

class HorseTrainer extends \Models\Trainer
{
    /**
     * @param int $horseId
     * @return int
     */
    public function getHorseTrainerId($horseId)
    {
        $sql = "
                SELECT
                    trainer_uid,
                    (CASE
                        WHEN ht.trainer_change_date = CAST('1900-01-01' AS DATE) THEN getdate()
                        ELSE CAST(ht.trainer_change_date AS DATE)
                    END)
                FROM
                    horse_trainer ht
                WHERE
                    ht.horse_uid = :horse_uid:
                    AND   (
                        CASE
                            WHEN ht.trainer_change_date = CAST('1900-01-01' AS DATE) THEN getdate()
                            ELSE CAST(ht.trainer_change_date AS DATE)
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
        return $result ? $result[0]->trainer_uid : null;
    }
}
