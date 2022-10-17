<?php

namespace Models\Bo\TrainerProfile;

use Api\Constants\Horses as Constants;
use Api\Input\Request\HorsesRequest;

/**
 * Class HorseRace
 *
 * @package Models\Bo\TrainerProfile
 */
class HorseRace extends \Models\HorseRace
{
    /**
     * @param $trainerUid
     *
     * @return array
     */
    public function getRunningToForm($trainerUids)
    {
        $sql = "SELECT
                    hr.trainer_uid,
                    hr.horse_uid,
                    ri.race_instance_uid,
                    ri.race_datetime,
                    ro.race_outcome_position,
                    ro.race_outcome_form_char,
                    hr.rp_postmark,
                    hr.rp_pre_postmark,
                    race_distance = ri.distance_yard,
                    dist_to_winner = isnull(d.distance_value,0),
                    ri.race_group_uid,
                    runners = (SELECT COUNT(1)
                        FROM horse_race ihr, race_outcome iro
                        WHERE ihr.race_instance_uid = ri.race_instance_uid
                        AND ihr.final_race_outcome_uid = iro.race_outcome_uid
                        AND iro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . "))
                FROM race_instance ri,
                    course c,
                    horse_race hr,
                    race_outcome ro,
                    dist_to_winner d
                WHERE ri.race_status_code = " . Constants::RACE_STATUS_RESULTS . "
                    AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
                    AND ri.race_datetime > DATEADD(DAY, - 14, GETDATE())
                    AND ri.course_uid = c.course_uid
                    AND (c.country_code in ('GB','IRE')
                        OR (c.country_code in ('FR','GER','ITY','SPN','NOR','DEN','SWE')
                            AND isnull(ri.race_group_uid,0) in (1,2,3))
                        )
                    AND hr.trainer_uid IN (:trainerUids)
                    AND hr.race_instance_uid = ri.race_instance_uid
                    AND hr.final_race_outcome_uid = ro.race_outcome_uid
                    AND ro.race_outcome_code not in (" . Constants::NON_RUNNER_CODES . ")
                    AND hr.distance_to_winner_uid *= d.dist_to_winner_uid
                ORDER BY ri.race_datetime
                ";

        $result = $this->getReadConnection()->query(
            $sql,
            ['trainerUids' => $trainerUids]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $result
        );


        $result = $result->getGroupedResult([
            'trainer_uid',
            'races' => [
                'race_instance_uid',
                'horse_uid',
                'race_datetime',
                'race_outcome_position',
                'race_outcome_form_char',
                'rp_postmark',
                'rp_pre_postmark',
                'race_distance',
                'dist_to_winner',
                'race_group_uid',
                'runners'
            ]
        ], ['trainer_uid']);
        return $result;
    }
}
