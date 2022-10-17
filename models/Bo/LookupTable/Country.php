<?php

namespace Models\Bo\LookupTable;

class Country extends \Models\Country
{
    /**
     * @return array
     */
    public function getCountryTable()
    {
        $res = $this->getReadConnection()->query(
            'SELECT
                rtrim(country_code) as country_code,
                country_desc
            FROM country'
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row(), $res);

        return $result->toArrayWithRows('country_code');
    }
}
