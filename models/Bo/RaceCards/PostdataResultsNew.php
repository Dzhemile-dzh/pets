<?php

namespace Models\Bo\RaceCards;

use \Api\Constants\Horses as Constants;

/**
 * Class PostdataResultsNew
 *
 * @package Bo\RaceCards
 */
class PostdataResultsNew extends \Models\PostdataResultsNew
{

    /**
     * @param $raceId
     *
     * @return array|void
     */
    public function getPostdata($raceId)
    {
        $sql = "
            SELECT
              h.horse_uid
            , h.style_name
            , h.country_origin_code
            , phr.rp_postmark
            , pd.num_topspeed_best_rating
            , phr.official_rating
            , official_rating_today = NULL
            , pd.trainer_form_output
            , pd.going_output
            , pd.distance_output
            , pd.course_output
            , pd.draw_output
            , pd.ability_output
            , pd.recent_form_output
            , pri.race_status_code
            , phr.weight_carried_lbs
            , phr.saddle_cloth_no
            , phr.extra_weight_lbs
            , lh_weight_carried_lbs = NULL
            , out_of_handicap = NULL
            , trainer_record_output = CASE WHEN isnull(rtrim(pd.trainer_record_output),'N') = 'N' THEN NULL ELSE pd.trainer_record_output END             
            , group_race = CASE WHEN isnull(rtrim(pd.group_race),'N') = 'N' THEN NULL ELSE pd.group_race END
            , jockey_no_wins_flag = CASE WHEN isnull(rtrim(pd.jockey_no_wins_flag),'N') = 'N' THEN NULL ELSE pd.jockey_no_wins_flag END
            FROM postdata_results_new pd
            INNER JOIN horse h ON h.horse_uid = pd.horse_uid
            INNER JOIN pre_horse_race phr ON phr.race_instance_uid = pd.race_instance_uid
            INNER JOIN pre_race_instance pri ON pd.race_instance_uid = pri.race_instance_uid
            WHERE pd.race_instance_uid = :race_instance_uid
            AND phr.horse_uid = h.horse_uid
            AND phr.race_status_code = " . Constants::RACE_STATUS_OVERNIGHT . "
        ";

        $res = $this->getReadConnection()->query(
            $sql,
            ['race_instance_uid' => $raceId]
        );

        $rows = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $res
        );

        return $rows->toArrayWithRows('horse_uid');
    }
}
