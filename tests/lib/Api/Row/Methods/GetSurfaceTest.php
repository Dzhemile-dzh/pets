<?php

namespace Tests;

use Phalcon\Exception;

class GetSurfaceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException \Exception
     */
    public function testGetSurfaceWrongRaceType()
    {
        $row = \Api\Row\RaceInstance::createFromArray([
            'race_type_code' => 'A'
        ]);

        $row->getSurface();
    }

    /**
     * @param \Api\Row\RaceInstance $row
     * @param array $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetSurface(\Api\Row\RaceInstance $row, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->getSurface());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return[
            [
                \Api\Row\RaceInstance::createFromArray([
                    'race_type_code' => 'F'
                ]),
                'turf'
            ],
            [
                \Api\Row\RaceInstance::createFromArray([
                    'race_type_code' => 'H'
                ]),
                'turf'
            ],
            [
                \Api\Row\RaceInstance::createFromArray([
                    'race_type_code' => 'C'
                ]),
                'turf'
            ],
            [
                \Api\Row\RaceInstance::createFromArray([
                    'race_type_code' => 'B'
                ]),
                'turf'
            ],
            [
                \Api\Row\RaceInstance::createFromArray([
                    'race_type_code' => 'Z'
                ]),
                'aw'
            ],
            [
                \Api\Row\RaceInstance::createFromArray([
                    'race_type_code' => 'X'
                ]),
                'aw'
            ],
            [
                \Api\Row\RaceInstance::createFromArray([
                    'race_type_code' => 'Y'
                ]),
                'aw'
            ],
        ];
    }
}
