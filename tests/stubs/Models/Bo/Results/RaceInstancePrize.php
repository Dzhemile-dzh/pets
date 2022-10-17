<?php

namespace Tests\Stubs\Models\Bo\Results;

use \Phalcon\Mvc\Model\Row\General as GeneralRow;

/**
 * Class RaceInstancePrize
 *
 * @package Tests\Stubs\Models\Bo\Results
 */
class RaceInstancePrize extends \Phalcon\Mvc\Model
{
    public function getRacePrizes($raceId)
    {
        $data = [
            599697 => array(
                0 =>
                    GeneralRow::createFromArray(array(
                        'prize_sterling' => 3249,
                        'prize_euro' => null,
                        'position_no' => 1,
                        'prize_euro_gross' => null,
                    )),
                1 =>
                    GeneralRow::createFromArray(array(
                        'prize_sterling' => 954,
                        'prize_euro' => null,
                        'position_no' => 2,
                        'prize_euro_gross' => null,
                    )),
                2 =>
                    GeneralRow::createFromArray(array(
                        'prize_sterling' => 477,
                        'prize_euro' => null,
                        'position_no' => 3,
                        'prize_euro_gross' => null,
                    )),
                3 =>
                    GeneralRow::createFromArray(array(
                        'prize_sterling' => 238.5,
                        'prize_euro' => null,
                        'position_no' => 4,
                        'prize_euro_gross' => null,
                    )),
                4 =>
                    GeneralRow::createFromArray(array(
                        'prize_sterling' => 0,
                        'prize_euro' => null,
                        'position_no' => 5,
                        'prize_euro_gross' => null,
                    )),
                5 =>
                    GeneralRow::createFromArray(array(
                        'prize_sterling' => 0,
                        'prize_euro' => null,
                        'position_no' => 6,
                        'prize_euro_gross' => null,
                    )),
            ),
            582658 => [
                GeneralRow::createFromArray(
                    [
                        "prize_sterling" => 26261.2,
                        "prize_euro" => null,
                        "prize_euro_gross" => null,
                        "position_no" => 1
                    ]
                ),
                GeneralRow::createFromArray(
                    [
                        "prize_sterling" => 7878.31,
                        "prize_euro" => null,
                        "prize_euro_gross" => null,
                        "position_no" => 2
                    ]
                )
            ]
        ];

        return $data[$raceId];
    }
}
