<?php

namespace Tests;

use Phalcon\Exception;

class IsJumpRaceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\RaceInstance $row
     * @param array                               $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testIsJumpRace(
        \Api\Row\RaceInstance $row,
        $expectedResult
    ) {

        $this->assertEquals($expectedResult, $row->isJumpRace());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return [
            [
                \Api\Row\RaceInstance::createFromArray(
                    ['race_type_code' => 'F']
                ),
                false
            ],
            [
                \Api\Row\RaceInstance::createFromArray(
                    ['race_type_code' => 'X']
                ),
                false
            ],
            [
                \Api\Row\RaceInstance::createFromArray(
                    ['race_type_code' => 'H']
                ),
                true
            ],
            [
                \Api\Row\RaceInstance::createFromArray(
                    ['race_type_code' => 'C']
                ),
                true
            ],
            [
                \Api\Row\RaceInstance::createFromArray(
                    ['race_type_code' => 'U']
                ),
                true
            ],
            [
                \Api\Row\RaceInstance::createFromArray(
                    ['race_type_code' => 'B']
                ),
                true
            ],
            [
                \Api\Row\RaceInstance::createFromArray(
                    ['race_type_code' => 'P']
                ),
                true
            ],
            [
                \Api\Row\RaceInstance::createFromArray(
                    ['race_type_code' => 'Y']
                ),
                true
            ],
            [
                \Api\Row\RaceInstance::createFromArray(
                    ['race_type_code' => 'W']
                ),
                true
            ],
            [
                \Api\Row\RaceInstance::createFromArray(
                    ['race_type_code' => 'Z']
                ),
                true
            ],
        ];
    }
}
