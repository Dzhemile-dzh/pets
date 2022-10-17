<?php

namespace Tests;

use Phalcon\Exception;

class IsFirstTimeHeadgearTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Api\Row\RaceInstance $row
     * @param array                               $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testIsFirstTimeHeadgear(\Phalcon\Mvc\Model\Row\General $row, $expectedResult)
    {

        $this->assertEquals($expectedResult, $row->IsFirstTimeHeadgear());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return [
            [
                \Api\Row\Results\Horse::createFromArray(['first_time_yn' => 'Y']),
                true
            ],
            [
                \Api\Row\Results\Horse::createFromArray(['first_time_yn' => '']),
                false
            ],
            [
                \Api\Row\Results\Horse::createFromArray(['first_time_yn' => null]),
                false
            ],

        ];
    }
}
