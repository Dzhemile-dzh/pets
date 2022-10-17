<?php

namespace Api\DataProvider\Bo\LookupTable;

/**
 * @package Api\DataProvider\Bo\LookupTable
 */
class RaceGroup extends \Phalcon\Mvc\DataProvider
{
    /**
     * @return array
     */
    public function getData()
    {
        $sql = "
        SELECT
            rg.race_group_uid,
            rg.race_group_code,
            rg.race_group_desc
        FROM
            race_group rg
        ";

        $result = $this->query($sql);
        return $result->toArrayWithRows();
    }
}
