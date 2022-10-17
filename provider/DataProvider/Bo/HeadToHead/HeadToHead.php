<?php
namespace Api\DataProvider\Bo\HeadToHead;

use Phalcon\Db\Sql\Builder;
use Api\DataProvider\HorsesDataProvider;
use Api\Constants\Horses as Constants;

class HeadToHead extends HorsesDataProvider
{
    /**
     * Get data for past races where at least 2 horses of requested are runners
     *
     * @param array $horseUids
     * @return array
     */
    public function getData(array $horseUids): array
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                ri.race_instance_uid,
                ri.race_datetime,
                c.course_name,
                c.style_name as course_style_name,
                c.course_uid,
                ri.race_type_code,
                ri.no_of_runners,
                gt.going_type_desc,
                ri.distance_yard,
            
                h.style_name as horse_style_name,
                h.horse_uid,
                h.country_origin_code as horse_country_origin_code,
                h.horse_sex_code,
                ro.race_outcome_code,
                o.odds_desc,
                o.odds_value,
                hr.saddle_cloth_no,
                hr.official_rating_ran_off,
                hr.rp_postmark,
                j.style_name as jockey_style_name,
                hr.weight_allowance_lbs,
                t.style_name as trainer_style_name
            FROM
                race_instance ri
                    JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
                    JOIN course c ON c.course_uid = ri.course_uid
                    JOIN horse h ON h.horse_uid = hr.horse_uid
                    JOIN race_outcome ro ON ro.race_outcome_uid = hr.race_outcome_uid
                    LEFT JOIN going_type
                        gt ON gt.going_type_code = ri.going_type_code
                    LEFT JOIN trainer t ON hr.trainer_uid = t.trainer_uid
                    LEFT JOIN jockey j ON j.jockey_uid = hr.jockey_uid
                    LEFT JOIN odds o ON o.odds_uid = hr.starting_price_odds_uid
             WHERE 
                hr.horse_uid IN (:horseUids)
             AND 
                hr.final_race_outcome_uid NOT IN (:nonRunnerIds)
             AND
                ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
        ");

        $builder->setParam('nonRunnerIds', Constants::NON_RUNNER_IDS_ARRAY);
        $builder->setParam('horseUids', $horseUids);
        $data = $this->queryBuilder($builder);

        $result = $data->getGroupedResult([
            'race_instance_uid',
            'race_datetime',
            'course_name',
            'course_style_name',
            'course_uid',
            'race_type_code',
            'no_of_runners',
            'going_type_desc',
            'distance_yard',
            'horses' => [
                'horse_style_name',
                'horse_uid',
                'horse_country_origin_code',
                'horse_sex_code',
                'race_outcome_code',
                'odds_desc',
                'odds_value',
                'saddle_cloth_no',
                'official_rating_ran_off',
                'rp_postmark',
                'jockey_style_name',
                'weight_allowance_lbs',
                'trainer_style_name'
            ]
        ], ['race_instance_uid', 'horse_uid']);

        // We need to return only races where at least two horses are runners.
        return array_filter($result, function ($race) {
            return count($race['horses']) >= 2;
        });
    }

    /**
     * Get statistics for horse performance in past races
     * @param array $horseUids
     * @return array
     */
    public function getStatistics(array $horseUids)
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
           SELECT
                hr.horse_uid,
                starts = COUNT(1),
                wins = SUM (CASE WHEN ro.race_outcome_position = 1 THEN 1 ELSE 0 END),
                seconds = SUM (CASE WHEN ro.race_outcome_position = 2 THEN 1 ELSE 0 END),
                thirds = SUM (CASE WHEN ro.race_outcome_position = 3 THEN 1 ELSE 0 END),
                net_total_prize = SUM (rip.prize_sterling),                  
                rp_topspeed = MAX (hr.rp_topspeed),
                rp_postmark = MAX (hr.rp_postmark),
                stake = SUM (
                    CASE WHEN ro.race_outcome_position = 1 THEN
                        CASE WHEN hr.final_race_outcome_uid = 71
                            THEN (o.odds_value / 2) - 0.50
                            ELSE o.odds_value END
                        ELSE 0
                    END),
                flat_figures_calculated = null,
                jumps_figures_calculated = null
            FROM horse_race hr
                JOIN race_instance ri ON hr.race_instance_uid = ri.race_instance_uid
                JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
                    AND ro.race_outcome_code NOT IN (:nonRunnersAndVoid)
                LEFT JOIN race_instance_prize rip ON rip.race_instance_uid = hr.race_instance_uid
                    AND rip.position_no = ro.race_outcome_position
                LEFT JOIN odds o ON hr.starting_price_odds_uid = o.odds_uid
            WHERE 
                hr.horse_uid IN (:horseUids)
            GROUP BY hr.horse_uid
        ");

        $builder->setParam('nonRunnersAndVoid', Constants::NON_RUNNER_AND_VOID_CODES_ARRAY);
        $builder->setParam('horseUids', $horseUids);
        $data = $this->queryBuilder($builder);

        return $data->toArrayWithRows('horse_uid');
    }

    /**
     * Get all entries where at least two from requested horses are runners
     * @param array $horseUids
     * @return array
     */
    public function getEntries(array $horseUids)
    {
        $builder = new Builder();
        $builder->setSqlTemplate("
            SELECT
                ri.race_instance_uid,
                ri.race_datetime,
                c.course_name,
                c.style_name as course_style_name,
                ri.race_instance_title,
                ri.race_status_code,
                ri.race_type_code,
                ri.distance_yard,
            
                h.style_name as horse_style_name,
                h.horse_uid,
                phr.saddle_cloth_no,
                j.style_name as jockey_style_name
            FROM
                race_instance ri
                    JOIN pre_horse_race phr ON ri.race_instance_uid = phr.race_instance_uid
                        AND ri.race_status_code = phr.race_status_code
                    JOIN course c ON c.course_uid = ri.course_uid
                    JOIN horse h ON h.horse_uid = phr.horse_uid
                    LEFT JOIN jockey j ON j.jockey_uid = phr.jockey_uid
             WHERE 
                phr.horse_uid IN (:horseUids)
        ");

        $builder->setParam('horseUids', $horseUids);

        $data = $this->queryBuilder($builder);

        $result = $data->getGroupedResult([
            'race_instance_uid',
            'race_datetime',
            'course_name',
            'course_style_name',
            'race_instance_title',
            'race_status_code',
            'race_type_code',
            'distance_yard',
            'horses' => [
                'horse_style_name',
                'horse_uid',
                'saddle_cloth_no',
                'jockey_style_name',
            ]
        ], ['race_instance_uid', 'horse_uid']);

        // We need to return only races where at least two horses are runners.
        return array_filter($result, function ($race) {
            return count($race['horses']) == 2;
        });
    }
}
