<?php

namespace Api\DataProvider\Bo\Signposts\TmpTable\SevenDaysWinners;

use Api\DataProvider\Bo\Signposts\TmpTable\PreRaceInstanceExtended;
use Api\Constants\Horses as Constants;

/**
 * Class Today
 *
 * @package Api\DataProvider\Bo\Signposts\TmpTable\SevenDaysWinners
 */
class Today extends PreRaceInstanceExtended
{
    const TABLE_ALIAS_PRE_RACE_INSTANCE = 't';

    /**
     * @return string
     */
    protected function getSql(string $tableName)
    {
        return "
            SELECT 
                t.horse_uid
                , t.horse_name
                , t.horse_country_origin_code
                , date_won = ri.race_datetime
                , course_won = c.style_name
                , course_won_uid = c.course_uid
                , t.trainer_uid
                , t.trainer_name
                , t.country_code
                , t.race_datetime
                , t.course_name
                , t.course_uid
                , t.owner_uid
                , t.rp_owner_choice
                , t.saddle_cloth_no
                , t.non_runner
                , t.race_instance_uid
                , t.race_instance_title
                , t.declared_runners 
                , t.race_group_desc
                , t.perform_race_uid_atr
                , t.perform_race_uid_ruk
            INTO {$tableName}
            FROM 
                horse_race hr
                , race_instance ri
                , course c
                , (
                    SELECT 
                        phr.horse_uid
                        , c.country_code
                        , pri.race_datetime
                        , t.trainer_uid
                        , trainer_name = t.style_name
                        , course_name = c.style_name
                        , horse_name = h.style_name
                        , horse_country_origin_code = h.country_origin_code
                        , c.course_uid
                        , phr.rp_owner_choice
                        , phr.saddle_cloth_no
                        , ho.owner_uid
                        , phr.non_runner
                        , pri.race_instance_uid
                        , iri.race_instance_title
                        , declared_runners = pri.no_of_runners 
                        , rg.race_group_desc
                        , perform_race_uid_atr = {$this->getSqlPerformRaceUidAtr()}
                        , perform_race_uid_ruk = {$this->getSqlPerformRaceUidRuk()}
                    FROM 
                        pre_horse_race phr
                        , pre_race_instance pri (index pre_race_instance_alt2)
                        , course c
                        , horse_trainer ht
                        , trainer t
                        , horse h
                        , horse_owner ho
                        , pre_race_instance_comments pric
                        , race_instance iri
                        , race_group rg
                    WHERE 
                        CONVERT(VARCHAR, pri.race_datetime, 101) = CONVERT(VARCHAR, GETDATE(), 101)
                        AND c.course_uid = pri.course_uid
                        AND c.country_code IN ('GB', 'IRE')
                        AND pri.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
                        AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT. "
                        AND phr.race_instance_uid = pri.race_instance_uid
                        AND phr.horse_uid = ht.horse_uid
                        AND phr.horse_uid = h.horse_uid
                        AND t.trainer_uid = ht.trainer_uid
                        AND ht.trainer_change_date = '" . Constants::EMPTY_DATE . "'
                        AND phr.horse_uid = ho.horse_uid
                        AND ho.owner_change_date = '" . Constants::EMPTY_DATE . "'
                        AND iri.race_instance_uid = pri.race_instance_uid
                        AND pric.race_instance_uid =* pri.race_instance_uid
                        AND iri.race_group_uid *= rg.race_group_uid
                ) t
            " . $this
                ->resetRestrictions()
                ->setDirectRestrictions()
                ->setRequestRestrictions()
                ->getRestrictions();
    }

    protected function setDirectRestrictions()
    {
        $this->restrictions[] = "hr.horse_uid = t.horse_uid";
        $this->restrictions[] = "hr.race_instance_uid = ri.race_instance_uid";
        $this->restrictions[] = "ri.race_datetime < t.race_datetime";
        $this->restrictions[] = "DATEDIFF(DAY, ri.race_datetime, t.race_datetime) < 8";
        $this->restrictions[] = "ri.race_type_code <> " . Constants::RACE_TYPE_P2P;
        $this->restrictions[] = "ri.race_status_code = " . Constants::RACE_STATUS_RESULTS;
        $this->restrictions[] = "hr.final_race_outcome_uid IN (1, 71)";
        $this->restrictions[] = "c.course_uid = ri.course_uid";

        return $this;
    }

    protected function getTemporaryTableName(): string
    {
        return 'tmp_work_signposts_data_7dw_today';
    }
}
