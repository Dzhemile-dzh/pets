<?php

namespace Tests;

class IsScoop6RaceTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\RaceInstance $row
     * @param array $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testIsScoop6Race(\Api\Row\RaceInstance $row, $expectedResult)
    {

        $this->assertEquals($expectedResult, $row->isScoop6Race());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return[
            [
                \Api\Row\RaceInstance::createFromArray(['scoop' => 'S6']),
                true
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['scoop' => 'SS']),
                false
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['scoop' => null]),
                false
            ],
            // test is_scoop6_race priority below
            [
                \Api\Row\RaceInstance::createFromArray(['scoop' => null, 'is_scoop6_race' => 1]),
                true
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['scoop' => 'S6', 'is_scoop6_race' => 0]),
                false
            ]
        ];
    }
}
