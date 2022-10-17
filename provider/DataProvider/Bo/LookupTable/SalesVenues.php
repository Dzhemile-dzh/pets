<?php

namespace Api\DataProvider\Bo\LookupTable;

/**
 * Class SalesVenues
 * @package Models\Bo\LookupTable
 */
class SalesVenues extends \Phalcon\Mvc\DataProvider
{
    /**
     * @return array
     */
    public function getData()
    {
        $sql = "
            SELECT
                venue_uid,
                venue_desc,
                country_flag,
                currency_code
            FROM 
                venue
        ";

        $result = $this->query($sql);

        return $result->toArrayWithRows();
    }
}
