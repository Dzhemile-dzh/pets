<?php

namespace Tests;

use Phalcon\Exception;

class GetLifetimeNameTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @expectedException \Exception
     */
    public function testGetLifetimeWrongLineType()
    {
        $row = $this->getMockBuilder('\Api\Row\HorseRace')
            ->setMethods(['getLineType'])
            ->getMock();

        $row->expects($this->any())->method('getLineType')->will($this->returnValue('G'));

        $row->getLifetimeName();
    }

    /**
     * @param \Api\Row\HorseRace $row
     * @param array $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetLifetimeName(\Api\Row\HorseRace $row, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->getLifetimeName());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return[
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'H']),
                'Hurdle'
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'C']),
                'Chase'
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'Z']),
                'Chase'
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'U']),
                'Chase'
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'Y']),
                'Hurdle'
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'B']),
                'NHF'
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'W']),
                'NHF'
            ],
            [
                \Api\Row\HorseRace::createFromArray(['race_type_code' => 'P']),
                'PTP'
            ],
        ];
    }
}
