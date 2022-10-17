<?php

namespace Api\DataProvider\Bo\Profile\Jockey;

use Api\Constants\Horses as Constants;

/**
 * Class DefaultInfo
 *
 * @package Api\DataProvider\Bo\Profile\Jockey
 */
class DefaultInfo extends \Phalcon\Mvc\DataProvider implements \Api\DataProvider\Bo\Profile\DefaultInfo
{

    /**
     * The method derives default info for Jockey by ID
     *
     * @param int    $id
     * @param string $countryCode
     * @param array  $raceTypeCodes
     *
     * @return \Phalcon\Mvc\ModelInterface|null
     */
    public function get($id, $countryCode, array $raceTypeCodes)
    {
        $restrictions[] = "hr.jockey_uid = :jockeyUid:";
        $restrictionsInternal[] = "hrm.jockey_uid = :jockeyUid:";
        $parameters['jockeyUid'] = $id;
        if (!empty($countryCode)) {
            $restrictions[] = "c.country_code = :countryCode:";
            $restrictionsInternal[] = "cm.country_code = :countryCode:";
            $parameters['countryCode'] = $countryCode;
        }
        if (!empty($raceTypeCodes)) {
            $restrictions[] = "ri.race_type_code IN (:raceTypeCodes:)";
            $restrictionsInternal[] = "rim.race_type_code IN (:raceTypeCodes:)";
            $parameters['raceTypeCodes'] = $raceTypeCodes;
        } else {
            $restrictionsInternal[] = "rim.race_type_code != " . Constants::RACE_TYPE_P2P;
        }
        $sql = "
            SELECT 
              country_code = rtrim(c.country_code)
              , ri.race_type_code
            FROM race_instance ri
                , horse_race hr, course c
            WHERE ri.race_instance_uid = hr.race_instance_uid
             AND ri.course_uid = c.course_uid
             AND " . implode(" AND ", $restrictions) . "
             AND ri.race_datetime = ( SELECT MAX(rim.race_datetime)
                                      FROM race_instance rim, horse_race hrm, course cm
                                      WHERE rim.race_instance_uid = hrm.race_instance_uid
                                        AND rim.course_uid = cm.course_uid
                                        AND " . implode(" AND ", $restrictionsInternal) . ")
            PLAN'(use optgoal allrows_dss)(use merge_join off)"
            ." ( sequence"
            ."    ( scalar_agg"
            ."          ( join"
            ."                ( join"
            ."                      ( i_scan ( table ( hrm horse_race    ) ) )"
            ."                      ( i_scan ( table ( rim race_instance ) ) ) )"
            ."                ( i_scan ( table ( cm course             ) ) ) ) )"
            ."    ( scalar_agg"
            ."          ( join"
            ."                ( join"
            ."                      ( i_scan ( table ( hr horse_race    ) ) )"
            ."                      ( i_scan ( table ( ri race_instance ) ) ) )"
            ."                ( i_scan ( table ( c course             ) ) ) ) ) )'
        ";

        $result = $this->query($sql, $parameters);

        return $result->getFirst() ? : null;
    }
}
