<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 2/10/2015
 * Time: 4:29 PM
 */

namespace Models\Bo\LookupTable;

class GoingType extends \Models\GoingType
{
    /**
     * @return array
     */
    public function getGoingTypeTable()
    {
        $res = $this->getReadConnection()->query(
            'SELECT
                rtrim(going_type_code) as going_type_code,
                going_type_desc,
                going_band_uid,
                sporting_life_code,
                rtrim(services_desc) as services_desc,
                rtrim(rp_going_type_desc) as rp_going_type_desc,
                rp_going_type_value
            FROM going_type'
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row(), $res);

        return $result->toArrayWithRows('going_type_code');
    }
}
