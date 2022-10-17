<?php

namespace Tests;

use Phalcon\Exception;

class GetStakeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Phalcon\Mvc\Model\Row\General $row
     * @param array                          $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetStake(
        \Phalcon\Mvc\Model\Row\General $row,
        $expectedResult
    ) {

        $this->assertEquals($expectedResult, $row->getStake());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return [
            [
                \Api\Row\JockeyProfile\RecordByRaceType::createFromArray(
                    [
                        'stake' => 0
                    ]
                ),
                '0.00'
            ],
            [
                \Api\Row\JockeyProfile\RecordByRaceType::createFromArray(
                    [
                        'stake' => 3.00000000
                    ]
                ),
                '+3.00'
            ],
            [
                \Api\Row\JockeyProfile\RecordByRaceType::createFromArray(
                    [
                        'stake' => -5.55555
                    ]
                ),
                '-5.56'
            ],
            [
                \Api\Row\JockeyProfile\RecordByRaceType::createFromArray(
                    [
                        'stake' => -2.11111
                    ]
                ),
                '-2.11'
            ],
            [
                \Api\Row\TrainerProfile\RecordByRaceType::createFromArray(
                    [
                        'stake' => 0
                    ]
                ),
                '0.00'
            ],
            [
                \Api\Row\TrainerProfile\RecordByRaceType::createFromArray(
                    [
                        'stake' => 3.00000000
                    ]
                ),
                '+3.00'
            ],
            [
                \Api\Row\TrainerProfile\RecordByRaceType::createFromArray(
                    [
                        'stake' => -5.55555
                    ]
                ),
                '-5.56'
            ],
            [
                \Api\Row\TrainerProfile\RecordByRaceType::createFromArray(
                    [
                        'stake' => -2.11111
                    ]
                ),
                '-2.11'
            ],
        ];
    }
}
