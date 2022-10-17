<?php

namespace Api\DataProvider\Bo\Signposts\TmpTable\SevenDaysWinners;

use Api\Constants\Horses as Constants;
use Api\DataProvider\Factory\TmpSignpostsTables as Factory;
use Api\Mvc\DataProvider\TemporaryTable;

class Trainers extends TemporaryTable
{
    /**
     * @param string $tableName
     *
     * @return void
     */
    protected function createTemporaryTable(string $tableName): void
    {
        $dateFourYearAgo = (new \DateTime('-4 year'))->format('Y-m-d 00:00:00');
        $sql = "
            SELECT 
                t.trainer_uid
                , t.horse_uid
                , diff = datediff(dd, CASE WHEN isnull(t.next_date, '') = '' THEN '1980-01-01' ELSE t.next_date END, t.race_datetime)
                , t.final_race_outcome_uid
            INTO {$tableName}
            FROM
                (
                SELECT 
                    hr.trainer_uid
                    , hr.horse_uid
                    , ri.race_datetime
                    , hr.final_race_outcome_uid
                    , (SELECT MAX(ri2.race_datetime) FROM horse_race hr2, race_instance ri2
                    WHERE 
                        hr2.horse_uid = hr.horse_uid
                        AND hr2.trainer_uid = hr.trainer_uid
                        AND ri2.race_datetime < ri.race_datetime
                        AND ri2.race_type_code != " . Constants::RACE_TYPE_P2P . "
                        AND ri2.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                        AND ri2.race_instance_uid = hr2.race_instance_uid
                        AND hr2.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                        AND ri2.race_datetime > :dateFourYearAgo
                    ) as next_date
                FROM 
                    horse_race hr
                    , race_instance ri
                WHERE 
                    hr.trainer_uid IN (SELECT DISTINCT trainer_uid FROM {$this->getTodayTmpTable()->getTemporaryTable()})
                    AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                    AND hr.race_instance_uid = ri.race_instance_uid
                    AND ri.race_datetime > :dateFourYearAgo
                    AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                    AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                ) t
        ";

        $this->execute($sql, ['dateFourYearAgo' => $dateFourYearAgo], false);
    }

    /**
     * @return \Api\DataProvider\Bo\Signposts\TmpTable\SevenDaysWinners\Today
     */
    private function getTodayTmpTable()
    {
        return Factory::getSevenDaysWinners()->today;
    }

    /**
     * @return string
     */
    protected function getTemporaryTableName(): string
    {
        return 'tmp_work_signposts_data_7dw_trainers';
    }
}
