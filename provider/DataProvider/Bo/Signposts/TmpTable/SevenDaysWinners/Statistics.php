<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 2/23/2017
 * Time: 12:24 PM
 */

namespace Api\DataProvider\Bo\Signposts\TmpTable\SevenDaysWinners;

use Api\DataProvider\Factory\TmpSignpostsTables as Factory;
use Api\Mvc\DataProvider\TemporaryTable;

class Statistics extends TemporaryTable
{
    /**
     * @param string $tableName
     *
     * @return void
     */
    protected function createTemporaryTable(string $tableName): void
    {
        $sql = "
            SELECT 
                t.trainer_uid
                , t.d7_wins
                , t.d7_runs
                , d7_perc = round((CONVERT(FLOAT,t.d7_wins) / CONVERT(FLOAT, CASE WHEN t.d7_runs = 0 THEN 1 ELSE t.d7_runs END)) * 100, 0)
                , t.d8_wins
                , t.d8_runs
                , d8_perc = round((CONVERT(FLOAT,t.d8_wins) / CONVERT(FLOAT,CASE WHEN t.d8_runs = 0 THEN 1 ELSE t.d8_runs END)) * 100, 0)
            INTO {$tableName}
            FROM 
                (SELECT 
                    t.trainer_uid,
                    d7_wins = SUM(CASE WHEN t.final_race_outcome_uid IN (1,71) AND t.diff < 7 THEN 1 ELSE 0 END),
                    d7_runs = SUM(CASE WHEN t.diff < 7 THEN 1 ELSE 0 END),
                    d8_wins = SUM(CASE WHEN t.final_race_outcome_uid IN (1,71) AND t.diff >= 7 THEN 1 ELSE 0 END),
                    d8_runs = SUM(CASE WHEN t.diff >= 7 THEN 1 ELSE 0 END)
                FROM 
                    {$this->getTrainersTmpTable()->getTemporaryTable()} t
                    , {$this->getTodayTmpTable()->getTemporaryTable()} h
                WHERE 
                    h.trainer_uid = t.trainer_uid
                GROUP BY     
                    t.trainer_uid
                ) t
        ";

        $this->execute($sql, [], false);
    }

    /**
     * @return \Api\DataProvider\Bo\Signposts\TmpTable\SevenDaysWinners\Today
     */
    private function getTodayTmpTable()
    {
        return Factory::getSevenDaysWinners()->today;
    }

    /**
     * @return \Api\DataProvider\Bo\Signposts\TmpTable\SevenDaysWinners\Trainers
     */
    private function getTrainersTmpTable()
    {
        return Factory::getSevenDaysWinners()->trainers;
    }

    /**
     * @return string
     */
    protected function getTemporaryTableName(): string
    {
        return 'tmp_work_signposts_data_7dw_stats';
    }
}
