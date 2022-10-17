<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 01/11/2017
 * Time: 1:59 PM
 */
namespace Tests;

class TopDrawTest extends \PHPUnit\Framework\TestCase
{

    private function getMockBoTopDraw($raceId)
    {
        return new \Tests\Stubs\Bo\RaceCards\TopDraw($raceId);
    }

    /**
     * @dataProvider             providerTestWrongRaceId
     * @expectedException \Api\Exception\InternalServerError
     * @expectedExceptionMessage Illegal argument
     */
    public function testWrongRaceId($raceId)
    {
        new \Bo\RaceCards\TopDraw($raceId);
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
     * @dataProvider dataProviderTestGetTopDrawEmpty
     */
    public function testGetTopDrawEmpty($raceId)
    {
        $bo = $this->getMockBoTopDraw($raceId);

        $actual = $bo->getTopDraw();
        $this->assertNull($actual);
    }

    /**
     * @return array
     */
    public function dataProviderTestGetTopDrawEmpty()
    {
        return [
            [100001],
            [100002],
        ];
    }

    /**
     * @param int    $raceId
     * @param object $expected
     *
     * @dataProvider dataProviderTestGetTopDrawNotEmpty
     */
    public function testGetTopDrawNotEmpty($raceId, $expected)
    {
        $bo = $this->getMockBoTopDraw($raceId);

        $actual = $bo->getTopDraw();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    public function dataProviderTestGetTopDrawNotEmpty()
    {
        return [
            [
                200001, // from 665842
                (Object)array(
                    'going_type_code' => 'SS',
                    'no_of_runners' => 14,
                    'race_instance_uid' => 200001,
                    'race_datetime' => 'Jan 11 2017  4:45PM',
                    'distance' => 7,
                    'stalls' => 'Low',
                    'low_final' => 54,
                    'mid_final' => 46,
                    'high_final' => 50,
                    'low_wins' => 6,
                    'mid_wins' => 5,
                    'high_wins' => 9,
                    'races' => 20
                )
            ],
            [
                200002,
                (Object)array(
                    'race_instance_uid' => 200002,
                    'race_datetime' => 'Jan 11 2017  4:45PM',
                    'no_of_runners' => 14,
                    'distance' => 12.0,
                    'going_type_code' => 'SS',
                    'stalls' => 'Low',
                    'low_final' => 57,
                    'mid_final' => 42,
                    'high_final' => 51,
                    'low_wins' => 1,
                    'mid_wins' => 1,
                    'high_wins' => 3,
                    'races' => 5,
                )
            ],
        ];
    }

    /**
     * Get low minimum test
     *
     * @param int    $distanceYard
     * @param string $courseName
     * @param int    $expected
     *
     * @dataProvider dataProviderTestGetLowMinimum
     *
     * @return int
     */
    public function testGetLowMinimum($distanceYard, $courseName, $expected)
    {
        $bo = $this->getMockBoTopDraw(1);

        $actual = $bo->getLowMinimum($distanceYard, $courseName);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    public function dataProviderTestGetLowMinimum()
    {
        return [
            [1539, 'CHESTER', 6],
            [1539, 'BEVERLEY', 7],
            [1539, 'HAMILTON', 7],
            [1539, 'KEMPTON (A.W)', 8],
            [1540, 'CHESTER', 6],
            [1979, 'CHESTER', 6],
            [1979, 'AYR', 12],
            [1980, 'CHESTER', 14],
            [1980, 'AYR', 14],
            [2639, 'AYR', 14],
            [2640, 'AYR', 16],
            [3519, 'KEMPTON', 16],
            [3520, 'KEMPTON', 30],
            [3520, 'AYR', 30],
            [3520, 'NEWCASTLE (A.W)', 8],
            [3520, 'KEMPTON (A.W)', 8],
        ];
    }

    /**
     * Get stalls
     *
     * @param string $direction
     * @param string $stallsPos
     * @param string $expected
     *
     * @dataProvider dataProviderTestGetStalls
     */
    public function testGetStalls($direction, $stallsPos, $expected)
    {
        $bo = $this->getMockBoTopDraw(1);

        $actual = $bo->GetStalls($direction, $stallsPos);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    public function dataProviderTestGetStalls()
    {
        return [
            ['L', 'L', "Low"],
            ['L', 'M', "Middle"],
            ['L', 'H', "High"],
            ['L', 'C', "Middle"],
            ['L', 'F', "None"],

            ['R', 'L', "Low"],
            ['R', 'M', "Middle"],
            ['R', 'H', "High"],
            ['R', 'C', "Middle"],
            ['R', 'F', "None"],

            ['E', 'F', "None"],
            ['W', 'F', "None"],
            ['W', 'W', ""],
        ];
    }
}
