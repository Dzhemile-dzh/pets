<?php

declare(strict_types=1);

namespace Api\DataProvider\Bo\Native\Profiles\Horses;

use Phalcon\Db\Sql\Builder;
use Api\Constants\Horses as Constants;
use Api\DataProvider\HorsesDataProvider;

/**
 * @package Api\DataProvider\Bo\Native\Profiles\Horses
 */
class Horse extends HorsesDataProvider
{
    /**
     * @param int $horseId
     *
     * @return array|null
     */
    public function getData(int $horseId): ?array
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
                    SELECT
                        ow.style_name AS Owner,
                        tr.style_name AS Trainer,
                        br.style_name AS Breeder,
                        h.style_name AS name,
                        silk=NULL,
                        ho.owner_uid,
                        LOWER(h.horse_sex_code) as sex,
                        hc.rp_newspaper_output_desc,
                        h.horse_date_of_birth,
                        h.horse_date_of_death,
                        h.country_origin_code,
                        h_avg=NULL,
                        hdam.style_name AS dam_name,
                        hdam.country_origin_code AS dam_country,
                        d_avg=NULL,
                        hsire.style_name AS h_sire_name,
                        hsire.country_origin_code AS h_sire_country,
                        sireh.avg_flat_win_dist_of_progeny AS h_sire_avg,
                        dsire.style_name AS d_sire_name,
                        dsire.country_origin_code AS d_sire_country,
                        sired.avg_flat_win_dist_of_progeny AS d_sire_avg,
                        ssire.style_name AS s_sire_name,
                        ssire.country_origin_code AS s_sire_country,
                        sires.avg_flat_win_dist_of_progeny AS s_sire_avg
                    FROM horse h
                        LEFT JOIN horse hdam ON hdam.horse_uid = h.dam_uid
                        LEFT JOIN horse hsire ON hsire.horse_uid = h.sire_uid
                        LEFT JOIN sire sireh ON sireh.sire_uid = hsire.horse_uid
                        LEFT JOIN horse dsire ON dsire.horse_uid = hdam.sire_uid
                        LEFT JOIN sire sired ON sired.sire_uid = dsire.horse_uid
                        LEFT JOIN horse ssire ON ssire.horse_uid = hsire.sire_uid
                        LEFT JOIN sire sires ON sires.sire_uid = ssire.horse_uid
                        LEFT JOIN horse_owner ho ON h.horse_uid = ho.horse_uid
                          AND ISNULL(ho.owner_change_date, '1900-01-01 00:00:00.0') = '1900-01-01 00:00:00.0'
                        LEFT JOIN owner ow ON ho.owner_uid = ow.owner_uid
                        LEFT JOIN horse_trainer ht ON h.horse_uid = ht.horse_uid 
                          AND ISNULL(ht.trainer_change_date,  '1900-01-01 00:00:00.0') = '1900-01-01 00:00:00.0'
                        LEFT JOIN trainer tr ON ht.trainer_uid = tr.trainer_uid
                        LEFT JOIN breeder br ON h.breeder_uid = br.breeder_uid
                        LEFT JOIN horse_colour hc ON h.horse_colour_code = hc.horse_colour_code
                    WHERE h.horse_uid = :horseId
        ");

        $builder->setParam('horseId', $horseId);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );


        $result = $data->getGroupedResult(
            [
                'Owner',
                'Trainer',
                'Breeder',
                'Horse' => [
                    'name',
                    'owner_uid',
                    'silk',
                    'sex',
                    'rp_newspaper_output_desc',
                    'horse_date_of_birth',
                    'horse_date_of_death',
                    'country_origin_code',
                    'h_avg',
                ],
                'HorseDam' => [
                    'dam_name',
                    'dam_country',
                    'd_avg',
                ],
                'DamSir' => [
                    'd_sire_name',
                    'd_sire_country',
                    'd_sire_avg',
                ],
                'HorseSir' => [
                    'h_sire_name',
                    'h_sire_country',
                    'h_sire_avg',
                ],
                'SireSir' => [
                    's_sire_name',
                    's_sire_country',
                    's_sire_avg',
                ]
            ]
        );
        return $result;
    }

    /**
     * @param int $horseId
     *
     * @return array|null
     */
    public function getHorseForm(int $horseId): ?array
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
               SELECT 
                    ri.race_instance_uid,
                    ri.race_instance_title,
                    ri.race_group_uid,
                    ri.race_datetime,
                    LOWER(c.rp_abbrev_3) AS course_name,
                    ri.distance_yard,
                    gt.services_desc as going_type_code,
                    ri.race_type_code,
                    hr.weight_carried_lbs,
                    hr.final_race_outcome_uid,
                    ro.race_outcome_code,
                    j.style_name AS jockey_name,
                    hr.rp_postmark,
                    hr.rp_topspeed,
                    raceOR = CASE
                            WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT_TURF . ")
                            THEN rh.current_official_turf_rating
                            WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_CHASE . ")
                            THEN rh.current_official_rating_chase
                            WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_HURDLE . ")
                            THEN rh.current_official_rating_hurdle
                            WHEN ri.race_type_code IN (" . Constants::RACE_TYPE_FLAT_AW . ")
                            THEN rh.current_official_aw_rating
                         END,
                rip.prize_sterling as earnings,
                    (SELECT COUNT(1) FROM horse_race hr2 WHERE hr2.race_instance_uid = hr.race_instance_uid AND hr2.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")) AS noRunners,
                    hr.official_rating_ran_off
                    FROM horse_race hr
                    LEFT JOIN race_instance ri ON hr.race_instance_uid = ri.race_instance_uid
                    LEFT JOIN course c ON ri.course_uid = c.course_uid
                    LEFT JOIN jockey j ON hr.jockey_uid = j.jockey_uid
                    LEFT JOIN racing_horse rh ON rh.horse_uid = hr.horse_uid
                    LEFT JOIN race_outcome ro on hr.final_race_outcome_uid = ro.race_outcome_uid
                    LEFT JOIN going_type gt ON ri.going_type_code = gt.going_type_code
                    LEFT JOIN race_instance_prize rip ON rip.position_no = ro.race_outcome_position
                                AND  rip.race_instance_uid = hr.race_instance_uid
                                AND ro.race_outcome_uid = hr.final_race_outcome_uid
                WHERE hr.horse_uid = :horseId
                AND hr.final_race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
                ORDER BY ri.race_datetime DESC
        ");

        $builder->setParam('horseId', $horseId);

        $builder->build();

        $data = $this->query(
            $builder->getSql(),
            $builder->getParams()
        );


        return $data->count() > 0 ? $data->toArrayWithRows() : null;
    }
}
