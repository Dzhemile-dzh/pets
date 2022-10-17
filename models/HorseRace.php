<?php

namespace Models;

use Api\Constants\Horses as Constants;
use Phalcon\Db\Sql\Builder;
use Phalcon\Mvc\Model;

/**
 * Class HorseRace
 *
 * @package Models
 */
class HorseRace extends \Phalcon\Mvc\Model
{
    /**
     * @var integer
     */
    protected $race_instance_uid;

    /**
     * @var integer
     */
    protected $horse_uid;

    /**
     * @var integer
     */
    protected $jockey_uid;

    /**
     * @var integer
     */
    protected $race_outcome_uid;

    /**
     * @var integer
     */
    protected $final_race_outcome_uid;

    /**
     * @var integer
     */
    protected $dist_to_horse_in_front_uid;

    /**
     * @var integer
     */
    protected $distance_to_winner_uid;

    /**
     * @var integer
     */
    protected $disqualification_uid;

    /**
     * @var integer
     */
    protected $stop_watch_rating;

    /**
     * @var integer
     */
    protected $weight_carried_lbs;

    /**
     * @var integer
     */
    protected $weight_allowance_lbs;

    /**
     * @var integer
     */
    protected $over_weight_lbs;

    /**
     * @var integer
     */
    protected $extra_weight_lbs;

    /**
     * @var integer
     */
    protected $out_of_handicap_lbs;

    /**
     * @var integer
     */
    protected $horse_head_gear_uid;

    /**
     * @var integer
     */
    protected $official_rating_ran_off;

    /**
     * @var string
     */
    protected $form_rating_chars;

    /**
     * @var integer
     */
    protected $form_rating_number;

    /**
     * @var integer
     */
    protected $point_to_point_rating;

    /**
     * @var integer
     */
    protected $starting_price_odds_uid;

    /**
     * @var integer
     */
    protected $opening_odds_uid;

    /**
     * @var integer
     */
    protected $touched_odds_uid;

    /**
     * @var integer
     */
    protected $and_odds_uid;

    /**
     * @var integer
     */
    protected $draw;

    /**
     * @var integer
     */
    protected $saddle_cloth_no;

    /**
     * @var string
     */
    protected $saddle_cloth_letter;

    /**
     * @var integer
     */
    protected $rp_postmark;

    /**
     * @var integer
     */
    protected $rp_pre_postmark;

    /**
     * @var string
     */
    protected $rp_pm_chars;

    /**
     * @var integer
     */
    protected $rp_topspeed;

    /**
     * @var integer
     */
    protected $forecast_sp_uid;

    /**
     * @var string
     */
    protected $rp_in_places;

    /**
     * @var string
     */
    protected $rp_betting_movements;

    /**
     * @var integer
     */
    protected $trainer_uid;

    /**
     * @var integer
     */
    protected $owner_uid;

    /**
     * @var integer
     */
    protected $ptp_allowance_lbs;

    /**
     * @var string
     */
    protected $rp_owner_choice;

    /**
     * @var string
     */
    protected $subscription_list;

    /**
     * @var integer
     */
    protected $rf_form_rt;

    /**
     * @var string
     */
    protected $rf_form_rt_char;

    /**
     * @var integer
     */
    protected $rf_speed_rt;

    /**
     * @var string
     */
    protected $rf_speed_rt_char;


    /**
     * Get races for generating form figures.
     * @param array $horsesIds
     * @param array $raceTypeCodes
     * @param $raceDate
     * @return array
     */
    public function getHorsesForm(array $horsesIds, array $raceTypeCodes, $raceDate = null)
    {
        $builder = new Builder();

        $builder->setSqlTemplate("
            SELECT
                hr.horse_uid,
                ri.race_instance_uid,
                ri.race_datetime,
                ri.race_type_code,
                ro.race_outcome_position,
                race_outcome_form_char =
                    CASE WHEN ISNULL(d.disqualification_uid, 0) > 0
                        THEN d.disqualification_desc
                        ELSE ro.race_outcome_form_char
                    END
            FROM horse_race hr
            JOIN race_instance ri ON hr.race_instance_uid = ri.race_instance_uid
            JOIN race_outcome ro ON
                ro.race_outcome_uid = hr.final_race_outcome_uid
                AND ro.race_outcome_uid NOT IN (" . Constants::NON_RUNNER_IDS . ")
            LEFT JOIN disqualification d ON d.disqualification_uid = hr.disqualification_uid
            WHERE
                hr.horse_uid IN (:horsesIds:)
                AND ri.race_status_code = " .Constants::RACE_STATUS_RESULTS. "
                /*{WHERE}*/
                
            ORDER BY ri.race_datetime DESC
        ");

        $builder->setParam('horsesIds', $horsesIds);

        if (is_null($raceDate)) {
            $builder->where("ri.race_datetime < GETDATE()");
        } else {
            $builder->where("ri.race_datetime < :raceDate:");
            $builder->setParam('raceDate', $raceDate);
        }

        if (!empty($raceTypeCodes)) {
            $builder->where("ri.race_type_code IN (:raceTypeCodes:)");
            $builder->setParam('raceTypeCodes', $raceTypeCodes);
        }

        $builder->build();

        $res = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $collection = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $collection->toArrayWithRows('horse_uid', null, true);
    }

    public function getOwnerStatsLast14Days($ownerId)
    {
        $sql = "
            SELECT
                COUNT(ro.race_outcome_position) AS runs,
                ISNULL(SUM(CASE WHEN ro.race_outcome_position = 1 THEN 1 ELSE 0 END),0) AS wins
            FROM
                race_instance ri,
                horse_race hr,
                race_outcome ro
            WHERE
                hr.race_instance_uid = ri.race_instance_uid
                AND hr.owner_uid = :ownerId
                AND ro.race_outcome_uid = hr.final_race_outcome_uid
                AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                AND ri.race_datetime > DATEADD(DAY, - 14, GETDATE())
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'ownerId' => $ownerId
            ]
        );

        $stats = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\WinsRuns(),
            $res
        );

        return $stats->getFirst();
    }

    public function getJockeyStatsLast14Days($jockeyId)
    {
        $sql = "
            SELECT
                COUNT(ro.race_outcome_position) AS runs,
                ISNULL(SUM(CASE WHEN ro.race_outcome_position = 1 THEN 1 ELSE 0 END),0) AS wins
            FROM
                race_instance ri,
                horse_race hr,
                race_outcome ro
            WHERE
                hr.race_instance_uid = ri.race_instance_uid
                AND hr.jockey_uid = :jockeyId:
                AND ro.race_outcome_uid = hr.final_race_outcome_uid
                AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                AND ri.race_datetime > DATEADD(DAY, - 14, GETDATE())
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            [
                'jockeyId' => $jockeyId
            ]
        );

        $stats = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\WinsRuns(),
            $res
        );

        return $stats->getFirst();
    }

    /**
     * Combine getTrainerStatsLast14Days(), getOwnerStatsLast14Days() and getJockeyStatsLast14Days() methods
     * @param int|null $id - uid value of the passed $type
     * @param string $type - it can be one of the following : trainer, owner, jockey
     * @return \Phalcon\Mvc\ModelInterface
     * @throws Model\Resultset\ResultsetException
     */
    public function getStatsLast14Days(?int $id, string $type)
    {
        $builder = new Builder();
        $builder->setSqlTemplate(
            "SELECT
                COUNT(ro.race_outcome_position) AS runs,
                ISNULL(SUM(CASE WHEN ro.race_outcome_position = 1 THEN 1 ELSE 0 END),0) AS wins
            FROM race_instance ri
            JOIN horse_race hr ON hr.race_instance_uid = ri.race_instance_uid
            JOIN race_outcome ro ON ro.race_outcome_uid = hr.final_race_outcome_uid
            WHERE
                /*{WHERE}*/
                AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                AND ri.race_datetime > DATEADD(DAY, - 14, GETDATE())
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                AND ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
            PLAN '(use optgoal allrows_dss)'"
        );

        //Since trainer_uid, jockey_uid and owner_uid are from horse_race we create dynamic where clause
        $type_id = "hr." . $type . "_uid";

        //We are doing this because $id can be null
        $builder->where($type_id ." = :uid");
        $builder->setParam('uid', $id);

        $builder->build();

        $result = $this->getReadConnection()->query(
            $builder->getSql(),
            $builder->getParams()
        );

        $stats = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\WinsRuns(),
            $result
        );

        return $stats->getFirst();
    }
}
