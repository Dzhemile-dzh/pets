<?php

namespace Tests;

use Phalcon\Exception;

class GetTimeOfDayLetterTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException \Api\Exception\InternalServerError
     */
    public function testGetSurfaceWrongRaceType()
    {
        $row = \Api\Row\RaceInstance::createFromArray([
            'race_timestamp' => '',
            'latitude' => '',
            'longitude' => ''
        ]);

        $row->getTimeOfDayLetter();
    }

    /**
     * @param \Api\Row\RaceInstance $row
     * @param array $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetTimeOfDayLetter(\Api\Row\RaceInstance $row, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->getTimeOfDayLetter());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return[
            [
                \Api\Row\RaceInstance::createFromArray([
                    'race_timestamp' => 1409331000,
                    'latitude' => '52.604012',
                    'longitude' => '-2.144823'
                ]),
                'D'
            ],
            [
                \Api\Row\RaceInstance::createFromArray([
                    'race_timestamp' => 1409200000,
                    'latitude' => '52.604012',
                    'longitude' => '-2.144823'
                ]),
                'N'
            ],
        ];
    }
}
