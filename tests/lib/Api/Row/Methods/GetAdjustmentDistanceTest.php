<?php

namespace Tests;

class GetAdjustmentDistanceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException \Exception
     */
    public function testGetAdjustmentDistanceTestWrongRaceType()
    {
        $row = \Api\Row\HorseRace::createFromArray(
            [
                'race_type_code' => 'A',
                'distance_yard' => 1120
            ]
        );

        $row->getAdjustmentDistance();
    }


    /**
     * @param \Api\Row\HorseRace $row
     * @param array              $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetAdjustmentDistanceTest(\Api\Row\HorseRace $row, $expectedResult)
    {

        $this->assertEquals($expectedResult, $row->getAdjustmentDistance());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return [
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'F', 'distance_yard' => 1760]),
                55
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'X', 'distance_yard' => 1761]),
                110
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'F', 'distance_yard' => 3520]),
                110
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'F', 'distance_yard' => 3521]),
                165
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'C', 'distance_yard' => 1761]),
                219
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'U','distance_yard' => 1120]),
                219
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'P', 'distance_yard' => 1120]),
                219
            ],
        ];
    }
}
