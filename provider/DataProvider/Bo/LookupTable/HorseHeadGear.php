<?php

namespace Api\DataProvider\Bo\LookupTable;

/**
 * @package Api\DataProvider\Bo\LookupTable
 */
class HorseHeadGear extends \Phalcon\Mvc\DataProvider
{
    /**
     * @return array
     */
    public function getData()
    {
        $sql = "
            SELECT
                horse_head_gear_uid,
                horse_head_gear_code,
                horse_head_gear_desc,
                blinkers_yn,
                visors_yn,
                first_time_yn,
                rp_horse_head_gear_code
            FROM
                horse_head_gear
            ORDER BY horse_head_gear_uid
        ";

        $result = $this->query($sql);
        return $result->toArrayWithRows();
    }
}
