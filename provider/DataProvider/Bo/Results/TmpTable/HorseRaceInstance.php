<?php

namespace Api\DataProvider\Bo\Results\TmpTable;

use Api\Constants\Horses as Constants;
use Api\DataProvider\Bo\Results\TmpTable as TmpProvider;

/**
 * Class HorseRaceInstance
 *
 * @package Api\DataProvider\Bo\Results\TmpTable
 */
class HorseRaceInstance extends TmpProvider
{
    const TMP_TABLE_NAME = 'race_instance_horse_race';

    /**
     * @var bool
     */
    protected $includeNonrunners;

    /**
     * HorseRaceInstance constructor.
     * @param $includeNonRunners
     */
    public function __construct($includeNonRunners)
    {
        $this->includeNonrunners = $includeNonRunners;
        parent::__construct();
    }

    /**
     * Method creates temporary table race_instance_horse_raceXXXXXX
     */
    protected function createTmpTable()
    {
        $sql = "
            SELECT
                hr.race_instance_uid
                , hr.horse_uid
                , hr.jockey_uid
                , hr.race_outcome_uid
                , hr.final_race_outcome_uid
                , hr.dist_to_horse_in_front_uid
                , hr.distance_to_winner_uid
                , hr.disqualification_uid
                , hr.stop_watch_rating
                , hr.weight_carried_lbs
                , hr.weight_allowance_lbs
                , hr.over_weight_lbs
                , hr.extra_weight_lbs
                , hr.out_of_handicap_lbs
                , hr.horse_head_gear_uid
                , hr.official_rating_ran_off
                , hr.form_rating_chars
                , hr.form_rating_number
                , hr.point_to_point_rating
                , hr.starting_price_odds_uid
                , hr.opening_odds_uid
                , hr.touched_odds_uid
                , hr.and_odds_uid
                , hr.draw
                , hr.saddle_cloth_no
                , hr.saddle_cloth_letter
                , hr.rp_postmark
                , hr.rp_pre_postmark
                , hr.rp_topspeed
                , hr.rp_betting_movements
                , hr.trainer_uid
                , hr.owner_uid
                , hr.ptp_allowance_lbs
                , hr.rp_owner_choice
                , ri.ages_allowed_uid
                , ri.distance_yard
                , ri.course_uid
                , ri.going_type_code
                , ri.official_rating_band_uid
                , ri.pool_prize_sterling
                , ri.race_comments
                , ri.race_datetime
                , ri.early_closing_race_yn
                , ri.race_group_uid
                , ri.race_instance_title
                , ri.race_type_code
                , ri.race_start_datetime
                , ri.race_status_code
                , ri.rp_omitted_fences
                , ri.rp_analysis
                , ri.start_flag_yn
                , ri.straight_round_jubilee_code
                , rg.race_group_code
                , rg.race_group_desc
            INTO #{$this->getTmpTableName()}
            FROM race_instance ri
                JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
                LEFT JOIN race_group rg ON rg.race_group_uid = ri.race_group_uid
            WHERE ri.race_instance_uid = :raceId
            -- This is to include non runners 
            %s
            ";
        $additionalSql = null;
        if (!$this->includeNonrunners) {
            $additionalSql = 'AND hr.final_race_outcome_uid NOT IN (' . Constants::NON_RUNNER_IDS . ')';
        }

        $sql = sprintf($sql, $additionalSql);

        $this->execute($sql, ['raceId' => $this->getRaceId()], false);
    }
}
