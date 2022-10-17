<?php

namespace Tests;

use Phalcon\Exception;

class GetNoOfRunnersTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\RaceInstance $row
     * @param array $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetNoOfRunners(\Api\Row\RaceInstance $row, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->getNoOfRunners());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return[
            [
                \Api\Row\RaceInstance::createFromArray(['no_of_runners' => 1, 'no_of_runners_calculated' => 1]),
                1
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['no_of_runners' => 1, 'no_of_runners_calculated' => 5]),
                5
            ],
            [
                \Api\Row\RaceInstance::createFromArray(['no_of_runners' => 5, 'no_of_runners_calculated' => 0]),
                5
            ],
        ];
    }
}
