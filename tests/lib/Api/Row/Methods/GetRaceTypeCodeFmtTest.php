<?php

namespace Tests;

use Phalcon\Exception;

class GetRaceTypeCodeFmtTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\RaceInstance $row
     * @param array $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetRaceTypeCodeFmt(\Api\Row\RaceInstance $row, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->getRaceTypeCodeFmt());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return[
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'H']),
                'H'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'C']),
                'Ch'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'Z']),
                'Ch'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'U']),
                'HntCh'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'Y']),
                'H'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'B']),
                'NHF'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'W']),
                'NHF'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'P']),
                'PTP'
            ],
        ];
    }
}
