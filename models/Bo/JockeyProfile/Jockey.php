<?php

namespace Models\Bo\JockeyProfile;

use Api\Constants\Horses as Constants;
use Api\Input\Request\HorsesRequest;

/**
 * Class Jockey
 *
 * @package Models\Bo\JockeyProfile
 */
class Jockey extends \Models\Jockey
{

    /**
     * @param HorsesRequest $request
     *
     * @return \Phalcon\Mvc\Model\Row\General|null
     */
    public function getJockey(HorsesRequest $request)
    {
        $sql = "SELECT
                    jockey_uid,
                    jockey_name,
                    ptp_type_code,
                    flat_jockey_type_code,
                    jump_jockey_type_code,
                    jockey_sex,
                    style_name,
                    aka_style_name,
                    christian_name,
                    longest_flat_losing_seq,
                    longest_flat_winning_seq,
                    present_flat_losing_seq,
                    present_flat_winning_seq,
                    longest_jump_losing_seq,
                    longest_jump_winning_seq,
                    present_jump_losing_seq,
                    present_jump_winning_seq,
                    lowest_riding_weight = (
                        SELECT MIN(hr.weight_carried_lbs)
                            FROM horse_race hr
                            INNER JOIN race_instance ri ON ri.race_instance_uid = hr.race_instance_uid
                        WHERE
                            ri.race_datetime > dateadd(DAY, -365, convert(DATE, getdate()))
                            AND hr.jockey_uid = j.jockey_uid
                    ),
                    address.country_code
                FROM jockey j
                LEFT JOIN address ON address.address_uid = j.address_uid
                WHERE jockey_uid = :jockeyUid:
                ";

        $result = $this->getReadConnection()->query(
            $sql,
            array('jockeyUid' => $request->getJockeyId())
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $result
        );
        return $result->getFirst() ?: null;
    }

    /**
     * @param HorsesRequest $request
     *
     * @return \Phalcon\Mvc\Model\Row\General|null
     */
    public function getDefaultValues(HorsesRequest $request)
    {
        $sql = "
            SELECT country_code = rtrim(c.country_code)
              , ri.race_type_code
            FROM race_instance ri
                , horse_race hr, course c
            WHERE ri.race_instance_uid = hr.race_instance_uid
             AND ri.course_uid = c.course_uid
             AND hr.jockey_uid = :jockeyUid:
             AND ri.race_datetime = ( SELECT MAX(rim.race_datetime)
                                      FROM race_instance rim, horse_race hrm, course cm
                                      WHERE rim.race_instance_uid = hrm.race_instance_uid
                                        AND rim.course_uid = cm.course_uid
                                        AND rim.race_type_code != " . Constants::RACE_TYPE_P2P . "
                                        AND hrm.jockey_uid = :jockeyUid:)
            PLAN '(join ( join ( scan rim ) ( scan hrm ) ) ( scan cm ))'
        ";

        $result = $this->getReadConnection()->query(
            $sql,
            array('jockeyUid' => $request->getJockeyId())
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Phalcon\Mvc\Model\Row\General(),
            $result
        );
        return $result->getFirst() ?: null;
    }
}
