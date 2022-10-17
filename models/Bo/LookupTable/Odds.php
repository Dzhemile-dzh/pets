<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/9/2015
 * Time: 4:02 PM
 */

namespace Models\Bo\LookupTable;

class Odds extends \Models\Odds
{
    /**
     * @return array
     */
    public function getOddsTable()
    {
        $res = $this->getReadConnection()->query(
            'SELECT
                odds_uid,
                odds_desc,
                odds_value
            FROM odds'
        );

        $result = new \Phalcon\Mvc\Model\Resultset\General(null, new \Phalcon\Mvc\Model\Row(), $res);

        return $result->toArrayWithRows('odds_uid');
    }
}
