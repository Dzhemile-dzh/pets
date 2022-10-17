<?php

namespace Tests;

use Phalcon\Exception;

class IsFlatRaceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\RaceInstance $row
     * @param array $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testIsFlatRace(\Api\Row\RaceInstance $row, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->isFlatRace());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return[
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'F']),
                true
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'X']),
                true
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'H']),
                false
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'B']),
                false
            ],
        ];
    }
}
