<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 2/15/2017
 * Time: 11:02 AM
 */

namespace Api\DataProvider\Bo\Signposts\TmpTable;

use Api\Mvc\DataProvider\TemporaryTable;

class WorkSignpostDataToday extends TemporaryTable
{
    const TABLE_NAME = 'work_signposts_data_today';

    const SWEETSPOTS_STATS = 131;
    const HOT_TRAINERS_STATS = 20;
    const COURSE_TRAINERS_STATS = 23;
    const HOT_JOCKEYS_STATS = 29;
    const TRAINERS_JOCKEYS_STATS = 31;
    const COURSE_JOCKEYS_STATS = 33;
    const SEVEN_DAY_WINNERS = 39;
    const HORSES_FOR_COURSES_STATS = 42;
    const AHEAD_OF_HANDICAPPER = 51;
    const TRAVELLERS_CHECK = 69;

    /**
     * @return void
     */
    protected function createTemporaryTable(string $tableName): void
    {
        $sql = "
            SELECT
                type
                
                , race_datetime
                , country_code
                
                , trainer_uid
                , trainer_name
                
                , jockey_uid
                , jockey_name
                
                , horse_uid
                , horse_name
                
                , course_uid
                , course_name
                , course_and_distance
                , course_winner
                , course_runner
                
                , meeting
                , meeting_or
                
                , trav_wins
                , trav_runs
                , trav_perc
                
                , percent
                
                , losses_out
                , dist_out
                , dist = CASE 
                            WHEN type = " . self::TRAVELLERS_CHECK . " THEN
                                CASE 
                                    WHEN 
                                        dist_out LIKE '[1-9][0-9][0-9][0-9]' OR 
                                        dist_out LIKE '[1-9][0-9][0-9]' OR 
                                        dist_out LIKE '[1-9][0-9]' OR 
                                        dist_out LIKE '[0-9]' THEN CONVERT(INT, dist_out) 
                                    WHEN meeting = 'all GB' THEN 9999
                                    ELSE 0
                                END
                            ELSE 0 
                        END
                
                , wins_14
                , runs_14
                
                , d7_wins
                , d7_runs
                , d7_perc
                
                , d8_perc
                
            INTO {$tableName}
            FROM
                " . self::TABLE_NAME . "
            WHERE
              type IN (
              " . self::HOT_TRAINERS_STATS . ", 
              " . self::COURSE_TRAINERS_STATS . ", 
              " . self::HOT_JOCKEYS_STATS . ", 
              " . self::TRAINERS_JOCKEYS_STATS . ", 
              " . self::COURSE_JOCKEYS_STATS . ", 
              " . self::AHEAD_OF_HANDICAPPER . ", 
              " . self::TRAVELLERS_CHECK . ", 
              " . self::HORSES_FOR_COURSES_STATS . ")
              
            CREATE INDEX {$tableName}_race_datetime_idx ON {$tableName} (type, race_datetime)
            CREATE INDEX {$tableName}_trainer_idx ON {$tableName} (type, trainer_uid)
            CREATE INDEX {$tableName}_jockey_idx ON {$tableName} (type, jockey_uid)
            CREATE INDEX {$tableName}_horse_idx ON {$tableName} (type, horse_uid)
            ";

        $this->execute($sql, [], false);
    }

    /**
     * @return string
     */
    protected function getTemporaryTableName(): string
    {
        return 'tmp_work_signposts_data_today';
    }
}
