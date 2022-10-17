<?php

namespace Models\Bo\OwnerProfile;

use Api\Constants\Horses as Constants;

class Owner extends \Models\Owner
{

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     *
     * @return \Phalcon\Mvc\ModelInterface
     */
    public function getOwner(\Api\Input\Request\HorsesRequest $request)
    {
        $sql = "
            SELECT
                o.owner_uid
                , o.owner_name
                , o.silk
                , o.style_name
                , o.ptp_type_code
            FROM owner o
            WHERE
                o.owner_uid = :ownerUid
        ";

        $result = $this->getReadConnection()->query(
            $sql,
            array('ownerUid' => $request->getOwnerId())
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\OwnerProfile\Owner(),
            $result
        );

        return $result->getFirst() ? : null;
    }

    /**
     * @param \Api\Input\Request\HorsesRequest $request
     *
     * @return \Phalcon\Mvc\ModelInterface
     */
    public function getDefaultValues(\Api\Input\Request\HorsesRequest $request)
    {
        $sql = "
            SELECT TOP 1
                    country_code = rtrim(c.country_code),
                    ri.race_type_code
            FROM race_instance ri
                INNER JOIN course c ON ri.course_uid = c.course_uid
                INNER JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
                INNER JOIN race_outcome ro ON
                    ro.race_outcome_uid = hr.final_race_outcome_uid
                    AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                INNER JOIN season s ON (ri.race_datetime BETWEEN s.season_start_date AND s.season_end_date)
            WHERE
                hr.owner_uid = :ownerUid:
                AND getdate() BETWEEN s.season_start_date AND s.season_end_date
                AND ri.race_type_code != " . Constants::RACE_TYPE_P2P . "
            ORDER BY ri.race_datetime DESC
            PLAN '(use optgoal allrows_dss)(nl_join (i_scan hr)(i_scan ri))'
                ";

        $result = $this->getReadConnection()->query(
            $sql,
            [
                'ownerUid' => $request->getOwnerId()
            ]
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(
            null,
            new \Api\Row\OwnerProfile\Owner(),
            $result
        );

        return $result->getFirst() ? : null;
    }
}
