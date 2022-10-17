<?php

namespace Tests;

use Phalcon\Exception;

class GetActualRaceClassNameTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\Horse\Statistics $row
     * @param array $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetActualRaceClassName(\Api\Row\Horse\Statistics $row, $expectedResult)
    {

        $this->assertEquals($expectedResult, $row->getActualRaceClassName());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return[
            [
                \Api\Row\Horse\Statistics::createFromArray(['actual_race_class' => null]),
                'Races outside GB'
            ],
            [
                \Api\Row\Horse\Statistics::createFromArray(['actual_race_class' => 'dd']),
                null
            ],
            [
                \Api\Row\Horse\Statistics::createFromArray(['actual_race_class' => '1']),
                'Cl1'
            ],
            [
                \Api\Row\Horse\Statistics::createFromArray(['actual_race_class' => '4']),
                'Cl4'
            ],
        ];
    }
}
