<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 12/19/2016
 * Time: 2:59 PM
 */

namespace Api\DataProvider\Bo\Profile\Trainer;

class DefaultInfo extends \Phalcon\Mvc\DataProvider implements \Api\DataProvider\Bo\Profile\DefaultInfo
{

    /**
     * The method derives default info of entity by ID
     *
     * @param int    $id
     * @param string $countryCode
     * @param array  $raceTypeCodes
     *
     * @return \Phalcon\Mvc\ModelInterface|null
     */
    public function get($id, $countryCode, array $raceTypeCodes)
    {
        $restrictions[] = "trainer_uid = :trainerUid:";
        $parameters['trainerUid'] = $id;
        if (!empty($countryCode)) {
            $restrictions[] = "country_code = :countryCode:";
            $parameters['countryCode'] = $countryCode;
        }
        if (!empty($raceTypeCodes)) {
            $restrictions[] = "primary_trainer_code IN (:raceTypeCodes:)";
            $parameters['raceTypeCodes'] = $raceTypeCodes;
        }

        $sql = "SELECT
                    country_code
                    , race_type_code = primary_trainer_code
                FROM 
                    trainer
                WHERE 
                " . implode(" AND ", $restrictions);

        $result = $this->query($sql, $parameters);

        return $result->getFirst() ? : null;
    }
}
