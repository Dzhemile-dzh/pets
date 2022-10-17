<?php

namespace Tests;

/**
 * Class GetTopSpeedTest
 *
 * @package Tests
 */
class GetTopSpeedTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param \Phalcon\Mvc\Model\Row\General $row
     * @param array                          $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetWinPercent(\Phalcon\Mvc\Model\Row\General $row, $expectedResult)
    {
        $this->assertEquals($expectedResult, $row->getTopSpeed());
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                \Api\Row\Results\Horse::createFromArray(['rp_topspeed' => null]),
                null
            ],
            [
                \Api\Row\Results\Horse::createFromArray(['rp_tops1peed' => 11]),
                null
            ],
            [
                \Api\Row\Results\Horse::createFromArray(['rp_topspeed' => -5]),
                null
            ],
            [
                \Api\Row\Results\Horse::createFromArray(['rp_topspeed' => 0]),
                null
            ],
            [
                \Api\Row\Results\Horse::createFromArray(['rp_topspeed' => 2]),
                2
            ],
            [
                \Api\Row\Results\Horse::createFromArray(['rp_topspeed' => '3']),
                3
            ],
            [
                \Api\Row\Results\Horse::createFromArray(['rp_topspeed' => 'abc']),
                null
            ],
        ];
    }
}
