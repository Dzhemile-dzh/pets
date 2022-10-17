<?php

namespace Tests;

use \Tests\Stubs\DataProvider\Bo\RaceCards\RaceWFA as dataProvider;

/**
 * Class RaceWFATest
 *
 * @package Tests
 */
class RaceWFATest extends \PHPUnit\Framework\TestCase
{

    /**
     * @param $raceId
     *
     * @return Stubs\Bo\RaceCards\RaceWFA
     */
    private function getMockBoRaceWFA($raceId)
    {
        $bo = new \Tests\Stubs\Bo\RaceCards\RaceWFA($raceId);
        $dataProvider = new dataProvider();
        $dataProvider->setKey($raceId);
        $bo->setDataProvider($dataProvider);

        return $bo;
    }

    /**
     * @dataProvider             providerTestWrongRaceId
     * @expectedException \Api\Exception\InternalServerError
     * @expectedExceptionMessage Illegal argument
     */
    public function testWrongRaceId($raceId)
    {
        new \Bo\RaceCards\RaceWFA($raceId);
    }

    /**
     * @return array
     */
    public function providerTestWrongRaceId()
    {
        return [
            ['id'],
            [-1]
        ];
    }

    /**
     * @param $raceId
     *
     * @dataProvider dataProviderTestGetRaceWFAEmpty
     */
    public function testGetRaceWFAEmpty($raceId)
    {
        $bo = $this->getMockBoRaceWFA($raceId);

        $actual = $bo->getRaceWFA();
        $this->assertNull($actual);
    }

    /**
     * @return array
     */
    public function dataProviderTestGetRaceWFAEmpty()
    {
        return [
            [100001],
            [100002], //690613
            [100003],
            [100004]
        ];
    }

    /**
     * @param $raceId
     * @param $expected
     *
     * @dataProvider dataProviderTestGetRaceWFANotEmpty
     */
    public function testGetRaceWFANotEmpty($raceId, $expected)
    {
        $bo = $this->getMockBoRaceWFA($raceId);

        $actual = $bo->getRaceWFA();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    public function dataProviderTestGetRaceWFANotEmpty()
    {
        return [
            [
                // from 690709
                200001,
                '4yo from 5yo+ 5lb'
            ],
            [
                // from 690632
                200002,
                '5yo from 6yo+ 3lb'
            ],
        ];
    }

    /**
     * @param int    $furlong
     * @param string $raceType
     *
     * @param        $expected
     *
     * @dataProvider dataProviderTestAdjustFurlong
     */
    public function testAdjustFurlong($furlong, $raceType, $expected)
    {
        $bo = $this->getMockBoRaceWFA(1);

        $actual = $bo->adjustFurlong($furlong, $raceType);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    public function dataProviderTestAdjustFurlong()
    {
        return [
            [1, 'Z', 1],
            [3, 'F', 5],
            [17, 'X', 16],
            [19, 'F', 18],
            [22, 'X', 20],
            [15, 'C', 16],
            [19, 'Y', 20],
            [21, 'U', 20],
            [28, 'U', 24],
        ];
    }

    /**
     * @param int    $furlong
     * @param string $topAge
     *
     * @param        $expected
     *
     * @dataProvider dataProviderTestAdjustTopAge
     */
    public function testAdjustTopAge($furlong, $topAge, $expected)
    {
        $bo = $this->getMockBoRaceWFA(1);

        $actual = $bo->AdjustTopAge($furlong, $topAge);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    public function dataProviderTestAdjustTopAge()
    {
        return [
            [1, 'F', 1],
            [7, 'X', 5],
            [1, 'H', 1],
            [6, 'Y', 5],
            [7, 'Y', 5],
            [7, 'C', 6],
        ];
    }
}
