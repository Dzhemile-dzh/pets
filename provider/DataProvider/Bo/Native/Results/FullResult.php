<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Results;

use Phalcon\Db\Sql\Builder;
use \Phalcon\Mvc\Model\Row;
use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;

/**
 * @package Api\DataProvider\Bo\Native\Results
 */
class FullResult extends HorsesDataProvider
{
    private $horseRaceTmpTable = '#tmp_horse_race';

    public function __construct(?int $raceId = null)
    {
        if ($raceId) {
            $this->creteHorseRaceTmpTable($raceId);
        }
    }

    /**
     * @param int $raceId
     *
     * @return array|null
     */
    public function getData(int $raceId): ?Row
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                ri.race_instance_title as raceTitle,
                ri.race_datetime as raceDate,
                raceTime = NULL,
                c.style_name as meetingName,
                c.country_code,
                md.placepot_text,
                md.quadpot_text,
                md.jackpot_text,
                hasCompetitorDetails = 1,
                ri.race_type_code as type,
                ri.distance_yard as distance,
                ri.distance_yard as distanceRounded,
                ri.distance_yard as distanceRoundedFurlong,
                CASE WHEN rg.race_group_uid != 0 THEN rg.race_group_desc ELSE NULL END 'group',
                gt.going_type_desc as going,
                rp_ages_allowed_desc as agesAllowed,
                class = attr.race_attrib_desc,
                adsChangeDelay = NULL,
                ri.winners_time_secs as winnerTime,
                (ri.winners_time_secs - dat.average_time_sec) as diffStdTimeSec,
                actualRunners = ( SELECT COUNT(1) 
                                  FROM horse_race hr
                                  WHERE hr.race_instance_uid = ri.race_instance_uid
                                  AND hr.final_race_outcome_uid NOT IN (60,61,62))
            FROM
                race_instance ri
                LEFT JOIN course c ON ri.course_uid = c.course_uid                
                LEFT JOIN meeting_details md
                  on ri.course_uid = md.course_uid AND CONVERT(datetime, CONVERT(char(8),ri.race_datetime, 112)) = md.meeting_date
                LEFT JOIN going_type gt ON ri.going_type_code = gt.going_type_code
                LEFT JOIN ages_allowed aa ON aa.ages_allowed_uid = ri.ages_allowed_uid
                LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
                LEFT JOIN dist_ave_time dat ON
                    dat.course_uid = ri.course_uid
                    AND dat.race_type_code = 
                        CASE
                            WHEN ri.race_type_code = " . Constants::RACE_TYPE_HUNTER_CHASE . "
                            THEN " . Constants::RACE_TYPE_CHASE_TURF . "
                            ELSE ri.race_type_code
                        END
                    AND dat.distance_yard = ri.distance_yard
                    AND isnull(dat.straight_round_jubilee_code, '*') = isnull(ri.straight_round_jubilee_code, '*')                
                LEFT JOIN (
                    SELECT ral.race_attrib_code, raj.race_instance_uid, ral.race_attrib_desc
                    FROM race_attrib_join raj
                       LEFT JOIN race_attrib_lookup ral ON raj.race_attrib_uid = ral.race_attrib_uid
                    WHERE ral.race_attrib_desc IS NOT NULL 
                    AND ral.race_attrib_code IN (" . Constants::RACE_CLASS_SUB . ", " . Constants::RACE_CLASS . ")
                    ) attr ON attr.race_instance_uid = ri.race_instance_uid
                    AND (c.country_code = 'GB' AND attr.race_attrib_code = " . Constants::RACE_CLASS_SUB . "
                        OR c.country_code != 'GB' AND  attr.race_attrib_code = " . Constants::RACE_CLASS . ")
            WHERE
                ri.race_instance_uid = :raceId
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
              PLAN '(use optgoal allrows_dss)'
        ");

        $builder->setParam('raceId', $raceId);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );


        $result = null;

        if ($data->count()) {
            $result = $data->current();
        }

        return $result;
    }


    public function getPrizes(int $raceId): array
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
              TOP 4
                prize_sterling as prizeGbp,
                prize_euro as prizeEur
            FROM 
                race_instance_prize
            WHERE
                race_instance_uid = :raceId
            ORDER BY position_no
        ");

        $builder->setParam('raceId', $raceId);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = $data->toArrayWithRows();

        return $result;
    }

    public function getTote(int $raceId): ?Row
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT 
              tote_win_money,
              tote_place_1_money,
              tote_place_2_money,
              tote_place_3_money,
              tote_place_4_money,
              tricast_money,
              tote_dual_forecast_money,
              computer_strght_frcst_money,
              tote_deadheat_text
            FROM 
                race_instance_tote
            WHERE
                race_instance_uid = :raceId
        ");

        $builder->setParam('raceId', $raceId);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        return $data->count() ? $data->current() : null;
    }

    public function getRunners(int $raceId, string $date, \Models\Selectors $selectors): array
    {


        $ageSql = $selectors->getHorseAgeSQL(
            'hr.horse_date_of_birth',
            'hr.country_origin_code',
            '\'' . $date . '\''
        );
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                hr.horse_uid,
                hr.horse_name,
                hr.country_origin_code,
                hr.rate,
                hr.owner_uid,
                hr.rp_owner_choice,
                hr.rp_close_up_comment,
                hr.rp_betting_movements,
                hr.race_outcome_code,
                hr.trainer,
                hr.jockey,
                hr.draw,
                hr.weight,
                hr.rp_distance_desc,
                age = {$ageSql}
            FROM 
                " . $this->horseRaceTmpTable . " hr
            WHERE
                hr.final_race_outcome_uid NOT IN (60, 61, 62, 121)
            ORDER BY 
              hr.race_output_order,
              hr.race_outcome_code,
              hr.horse_name
        ");

        $builder->setParam('raceId', $raceId);


        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = $data->toArrayWithRows();

        return $result;
    }

    public function getNonRunners(int $raceId, string $date, \Models\Selectors $selectors): array
    {


        $ageSql = $selectors->getHorseAgeSQL(
            'hr.horse_date_of_birth',
            'hr.country_origin_code',
            '\'' . $date . '\''
        );
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                hr.horse_uid,
                hr.horse_name,
                hr.trainer,
                jockey = '-',
                hr.weight,
                age = {$ageSql}
            FROM 
                " . $this->horseRaceTmpTable . " hr
            WHERE
                hr.final_race_outcome_uid  IN (60, 61, 62, 121)
            ORDER BY
              hr.final_race_outcome_uid, 
              hr.horse_name
        ");

        $builder->setParam('raceId', $raceId);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $result = $data->toArrayWithRows();

        return $result;
    }

    public function getLastRace(int $raceId): ?Row
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT TOP 1 ri_a.race_instance_uid
            FROM race_instance ri
            LEFT JOIN race_instance ri_a ON ri.course_uid = ri_a.course_uid
              AND CONVERT(datetime, CONVERT(char(8),ri.race_datetime, 112)) =
                    CONVERT(datetime, CONVERT(char(8),ri_a.race_datetime, 112))
            WHERE ri.race_instance_uid = :raceId
            ORDER BY ri_a.race_datetime desc
        ");

        $builder->setParam('raceId', $raceId);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );

        return $data->count() ? $data->current() : null;
    }

    private function creteHorseRaceTmpTable(int $raceId): void
    {
        $sql = "Select 
                h.horse_date_of_birth,
                h.country_origin_code,
                h.horse_uid,
                h.style_name as horse_name,
                o.odds_desc as rate,
                hr.owner_uid,
                phr.rp_owner_choice,
                hrc.rp_close_up_comment,
                hr.rp_betting_movements,
                t.style_name as trainer,
                j.style_name as jockey,
                hr.draw,
                hr.weight_carried_lbs as weight,
                dth.rp_distance_desc,
                hr.final_race_outcome_uid,
                ro.race_output_order,
                ro.race_outcome_code
            INTO " . $this->horseRaceTmpTable . "
            FROM
                horse_race hr
                INNER JOIN horse h ON hr.horse_uid = h.horse_uid
                LEFT JOIN pre_horse_race phr ON phr.race_instance_uid = hr.race_instance_uid
                          AND phr.race_status_code = 'O'
                          AND hr.horse_uid = phr.horse_uid
                LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
                LEFT JOIN trainer t ON hr.trainer_uid = t.trainer_uid
                LEFT JOIN jockey j ON hr.jockey_uid = j.jockey_uid
                LEFT JOIN race_outcome ro on hr.final_race_outcome_uid = ro.race_outcome_uid
                LEFT JOIN horse_race_comments hrc ON hrc.race_instance_uid = hr.race_instance_uid
                            AND hrc.horse_uid = hr.horse_uid
                LEFT JOIN dist_to_horse dth ON dth.dist_to_horse_uid = hr.dist_to_horse_in_front_uid
            WHERE
                hr.race_instance_uid = :raceId
              PLAN '(use optgoal allrows_dss)'";

        $this->execute($sql, ['raceId' => $raceId]);
    }
}
