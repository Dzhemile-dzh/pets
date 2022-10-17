<?php

namespace Api\DataProvider\Bo\Profile\Owner;

use Api\Constants\Horses as Constants;

/**
 * Class DefaultInfo
 *
 * @package Api\DataProvider\Bo\Profile\Owner
 */
class DefaultInfo extends \Phalcon\Mvc\DataProvider implements \Api\DataProvider\Bo\Profile\DefaultInfo
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $countryCode;

    /**
     * @var string[]
     */
    protected $raceTypeCodes;

    /**
     * @var array
     */
    protected $restrictions;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * The method derives default info for Owner by ID
     *
     * @param int    $id
     * @param string $countryCode
     * @param array  $raceTypeCodes
     *
     * @return \Phalcon\Mvc\ModelInterface|null
     */
    public function get($id, $countryCode, array $raceTypeCodes)
    {
        $this->id = $id;
        $this->countryCode = $countryCode;
        $this->raceTypeCodes = $raceTypeCodes;

        $this->setCommonRestrictions();
        $this->setLocalRestrictions();

        $sql = "
            SELECT TOP 1
                    country_code = rtrim(c.country_code)
                    , ri.race_type_code
                FROM race_instance ri
                INNER JOIN course c ON ri.course_uid = c.course_uid
                INNER JOIN horse_race hr ON ri.race_instance_uid = hr.race_instance_uid
                INNER JOIN race_outcome ro ON
                    ro.race_outcome_uid = hr.final_race_outcome_uid
                    AND ro.race_outcome_code NOT IN (" . Constants::NON_RUNNER_CODES . ")
                INNER JOIN season s ON (ri.race_datetime BETWEEN s.season_start_date AND s.season_end_date)
                WHERE
                    " . implode(" AND ", $this->restrictions) . "
                ORDER BY ri.race_datetime DESC
                PLAN '(use optgoal allrows_dss)(nl_join (i_scan hr)(i_scan ri))'
                ";

        $result = $this->query($sql, $this->parameters);

        return $result->getFirst() ? : null;
    }

    protected function setLocalRestrictions()
    {
        $this->restrictions[] = "GETDATE() BETWEEN s.season_start_date AND s.season_end_date";
    }

    private function setCommonRestrictions()
    {
        $this->restrictions[] = "hr.owner_uid = :ownerUid:";
        $this->parameters['ownerUid'] = $this->id;
        if (!empty($this->countryCode)) {
            $this->restrictions[] = "c.country_code = :countryCode:";
            $this->parameters['countryCode'] = $this->countryCode;
        }
        if (!empty($this->raceTypeCodes)) {
            $this->restrictions[] = "ri.race_type_code IN (:raceTypeCodes:)";
            $this->parameters['raceTypeCodes'] = $this->raceTypeCodes;
        } else {
            $this->restrictions[] = "ri.race_type_code != " . Constants::RACE_TYPE_P2P ;
        }
    }
}
