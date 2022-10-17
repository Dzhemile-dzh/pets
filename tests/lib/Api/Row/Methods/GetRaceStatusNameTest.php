<?php

namespace Tests;

use Phalcon\Exception;

class GetRaceStatusName extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\RaceInstance $row
     * @param array $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetRaceStatusName(\Api\Row\RaceInstance $row, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->getRaceStatusName());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return[
            [
                \Api\Row\RaceInstance::createFromArray(['race_status_code' => '4']),
                'Four Day'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_status_code' => '3']),
                'Four Day'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_status_code' => 4]),
                'Four Day'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_status_code' => 3]),
                'Four Day'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_status_code' => '2']),
                "Two Day"
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_status_code' => 'O']),
                "Overnight"
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_status_code' => 'C']),
                "Early closer"
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_status_code' => 'B']),
                null
            ],
        ];
    }
}
