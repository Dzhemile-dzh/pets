<?php

namespace Models\Bo\LookupTable;

class RaceType extends \Models\RaceType
{
    /**
     * @return array
     */
    public function getRaceTypeTable()
    {
        $res = $this->getReadConnection()->query(
            'SELECT
                race_type_code,
                race_type_desc
            FROM race_type'
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row(), $res);

        return $result->toArrayWithRows('race_type_code');
    }
}
