<?php

namespace Models\Bo\LookupTable;

class HorseSex extends \Models\HorseSex
{
    /**
     * @return array
     */
    public function getHorseSexTable()
    {
        $res = $this->getReadConnection()->query(
            'SELECT
                horse_sex_code,
                horse_sex_desc,
                horse_sex_flag
            FROM horse_sex'
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row(), $res);

        return $result->toArrayWithRows('horse_sex_code');
    }
}
