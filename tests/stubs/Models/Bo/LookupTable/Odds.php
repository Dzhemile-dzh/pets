<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 11/9/2015
 * Time: 6:20 PM
 */

namespace Tests\Stubs\Models\Bo\LookupTable;

class Odds extends \Tests\Stubs\Models\Odds
{

    /**
     * @return array
     */
    public function getOddsTable()
    {
        return  [
            1 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'odds_uid' => 1,
                    'odds_desc' => '14/1',
                    'odds_value' => 14,
                ]
            ),
            2 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'odds_uid' => 2,
                    'odds_desc' => '11/10F',
                    'odds_value' => 1.1000000000000001,
                ]
            ),
            3 => \Phalcon\Mvc\Model\Row\General::createFromArray(
                [
                    'odds_uid' => 3,
                    'odds_desc' => '6/1',
                    'odds_value' => 6,
                ]
            )
        ];
    }
}
