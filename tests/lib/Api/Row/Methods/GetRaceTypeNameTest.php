<?php

namespace Tests;

class GetRaceTypeNameTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException \Exception
     */
    public function testGetRaceTypeNameWrongRaceType()
    {
        $row = \Api\Row\HorseRace::createFromArray([
            'race_type_code' => 'A'
        ]);

        $row->getRaceTypeName();
    }


    /**
     * @param \Api\Row\HorseRace $row
     * @param array $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetRaceTypeName(\Api\Row\HorseRace $row, $expectedResult)
    {

        $this->assertEquals($expectedResult, $row->getRaceTypeName());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return[
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'F']),
                'flat'
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'X']),
                'flat'
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'H']),
                'jumps'
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'C']),
                'jumps'
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'U']),
                'jumps'
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'B']),
                'jumps'
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'P']),
                'jumps'
            ],
        ];
    }
}
