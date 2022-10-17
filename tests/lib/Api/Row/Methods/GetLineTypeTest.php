<?php

namespace Tests;

use Phalcon\Exception;

class GetLineTypeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\RaceInstance $row
     * @param array $expectedResult
     *
     * @dataProvider providerTestGetLineType
     */
    public function testGetLineType(\Api\Row\RaceInstance $row, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->getLineType());
    }

    /**
     * @return array
     */
    public function providerTestGetLineType()
    {
        return[
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'F']),
                'F'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'X']),
                'X'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'C']),
                'C'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'C']),
                'C'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'C']),
                'C'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'B']),
                'N'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'P']),
                'P'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'Y']),
                'H'
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['race_type_code' => 'Z']),
                'C'
            ],
        ];
    }
}
