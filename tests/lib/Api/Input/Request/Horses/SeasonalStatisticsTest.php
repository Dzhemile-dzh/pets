<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 7/22/2016
 * Time: 12:32 PM
 */

namespace Tests;

use Phalcon\DI;
use Bo\SeasonalStatistics as Bo;

class SeasonalStatisticsTest extends \PHPUnit\Framework\TestCase
{
    public static function setUpBeforeClass()
    {
        $s = new \Models\Selectors();
        DI::getDefault()->set('selectors', $s);
    }

    /**
     * @param array $parameters
     * @return \Api\Input\Request\Horses\SeasonalStatistics
     */
    private function getMockRequest(array $parameters)
    {
        $methods = array_keys($parameters);
        $stub = $this->getMockForAbstractClass('Api\Input\Request\Horses\SeasonalStatistics', [], '', false, true, true, $methods);

        // Configure the stub.
        foreach ($parameters as $methodName => $methodResult) {
            $stub->expects($this->any())->method($methodName)->willReturn($methodResult);
        }

        return $stub;
    }

    private function getMockSeason(array $parameters, $consecutive = false)
    {
        $stub = null;
        $methods = array_keys($parameters);
        $stub = $this->getMockBuilder('Models\Bo\SeasonalStatistics\Season')->setMethods($methods)->getMock();

        // Configure the stub.
        foreach ($parameters as $methodName => $methodResult) {
            if ($consecutive) {
                $stub->expects($this->any())->method($methodName)->will(
                    $this->onConsecutiveCalls($methodResult[0], $methodResult[1])
                );
            } else {
                $stub->expects($this->any())->method($methodName)->willReturn($methodResult);
            }
        }

        return $stub;
    }

    /**
     * @param $request
     * @param $seasonParams
     * @param $expected
     *
     * @dataProvider dataProviderTestGetSeasonDataNotEmptyRequestSuccess
     */
    public function testGetSeasonDataNotEmptyRequestSuccess($request, $seasonParams, $expected)
    {
        $season = $this->getMockSeason($seasonParams, count($request['getCountryCodes']) === 2);
        $request['get'] = $season;

        $r = $this->getMockRequest($request);

        $this->assertEquals($expected['start_date'], $r->getSeasonDateBegin(), 'start date');
        $this->assertEquals($expected['end_date'], $r->getSeasonDateEnd(), 'end date');
    }

    /**
     * @return array
     */
    public function dataProviderTestGetSeasonDataNotEmptyRequestSuccess()
    {
        return [
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => null,
                    'getChampionship' => null,
                    'getSeasonYearBegin' => '2015',
                    'setChampionship' => null,
                    'setSeasonYearBegin' => null,
                    'getGivenParametersCount' => 3,
                ],
                [
                    'getSeasonDatesByYearTypeRace' => (Object)[
                        'season_uid' => 499,
                        'season_type_code' => 'F',
                        'season_start_date' => '2015-01-01 00:00:00',
                        'season_end_date' => '2015-12-31 23:59:00',
                        'season_start_year' => '2015',
                        'season_end_year' => '2015',
                        'season_desc' => 'Flat 2015',
                    ]
                ],
                [
                    'start_date' => '2015-01-01 00:00:00',
                    'end_date' => '2015-12-31 23:59:00',
                ]
            ],
            [
                [
                    'getCountryCodes' => ['IRE'],
                    'getRaceType' => 'jumps',
                    'getSurface' => null,
                    'getChampionship' => null,
                    'getSeasonYearBegin' => '2014',
                    'setChampionship' => null,
                    'setSeasonYearBegin' => null,
                    'getGivenParametersCount' => 3,
                ],
                [
                    'getSeasonDatesByYearTypeRace' => (Object)[
                        'season_uid' => 496,
                        'season_type_code' => 'I',
                        'season_start_date' => '2014-05-04 00:00:00',
                        'season_end_date' => '2015-05-02 23:59:00',
                        'season_start_year' => '2014',
                        'season_end_year' => '2015',
                        'season_desc' => 'Irish Jumps 2014-2015',
                    ]
                ],
                [
                    'start_date' => '2014-05-04 00:00:00',
                    'end_date' => '2015-05-02 23:59:00',
                ]
            ],
            [
                [
                    'getCountryCodes' => ['GB', 'IRE'],
                    'getRaceType' => 'jumps',
                    'getSurface' => null,
                    'getChampionship' => null,
                    'getSeasonYearBegin' => '2015',
                    'setChampionship' => null,
                    'setSeasonYearBegin' => null,
                    'getGivenParametersCount' => 3,
                ],
                [
                    'getSeasonDatesByYearTypeRace' => [
                        (Object)[
                            'season_uid' => 511,
                            'season_type_code' => 'I',
                            'season_start_date' => '2015-05-03 00:00:00',
                            'season_end_date' => '2016-04-30 23:59:00',
                            'season_start_year' => '2015',
                            'season_end_year' => '2016',
                            'season_desc' => 'Irish Jumps 2015-2016',
                        ],
                        (Object)[
                            'season_uid' => 510,
                            'season_type_code' => 'J',
                            'season_start_date' => '2015-04-26 00:00:00',
                            'season_end_date' => '2016-04-23 23:59:00',
                            'season_start_year' => '2015',
                            'season_end_year' => '2016',
                            'season_desc' => 'NH 2015-2016',
                        ],
                    ]
                ],
                [
                    'start_date' => '2015-04-26 00:00:00',
                    'end_date' => '2016-04-30 23:59:00',
                ]
            ],
            [
                [
                    'getCountryCodes' => ['GB', 'IRE'],
                    'getRaceType' => 'flat',
                    'getSurface' => null,
                    'getChampionship' => null,
                    'getSeasonYearBegin' => '2016',
                    'setChampionship' => null,
                    'setSeasonYearBegin' => null,
                    'getGivenParametersCount' => 3,
                ],
                [
                    'getSeasonDatesByYearTypeRace' => [
                        (Object)[
                            'season_uid' => 506,
                            'season_type_code' => 'F',
                            'season_start_date' => '2016-01-01 00:00:00',
                            'season_end_date' => '2016-12-31 23:59:00',
                            'season_start_year' => '2016',
                            'season_end_year' => '2016',
                            'season_desc' => 'Flat 2016',
                        ],
                        (Object)[
                            'season_uid' => 206,
                            'season_type_code' => 'F',
                            'season_start_date' => '2016-01-01 00:00:00',
                            'season_end_date' => '2016-12-31 23:59:00',
                            'season_start_year' => '2016',
                            'season_end_year' => '2016',
                            'season_desc' => 'Flat 2016',
                        ]
                    ]
                ],
                [
                    'start_date' => '2016-01-01 00:00:00',
                    'end_date' => '2016-12-31 23:59:00',
                ]
            ],
        ];
    }

    /**
     * @param $request
     * @param $seasonParams
     * @param $expected
     *
     * @dataProvider dataProviderTestGetSeasonDataEmptyRequestSuccess
     */
    public function testGetSeasonDataEmptyRequestSuccess($request, $seasonParams, $expected)
    {
        $season = $this->getMockSeason($seasonParams);
        $request['get'] = $season;

        $r = $this->getMockRequest($request);

        $this->assertEquals($expected['end_date'], $r->getSeasonDateEnd(), 'end date');
        $this->assertEquals($expected['start_date'], $r->getSeasonDateBegin(), 'start date');
    }

    public function dataProviderTestGetSeasonDataEmptyRequestSuccess()
    {
        return [
            [
                [
                    'getCountryCodes' => null,
                    'getRaceType' => null,
                    'getSurface' => null,
                    'getChampionship' => null,
                    'getSeasonYearBegin' => null,
                    'setChampionship' => null,
                    'setSeasonYearBegin' => null,
                    'setCountryCodes' => null,
                    'setRaceType' => null,
                    'getGivenParametersCount' => 0,
                ],
                [
                    'getDefaultSeasons' => (Object)[
                        'season_uid' => 499,
                        'season_type_code' => 'F',
                        'season_start_date' => '2015-01-01 00:00:00',
                        'season_end_date' => '2015-12-31 23:59:00',
                        'season_start_year' => '2015',
                        'season_end_year' => '2015',
                        'season_desc' => 'Flat 2015',
                    ]
                ],
                [
                    'start_date' => '2015-01-01 00:00:00',
                    'end_date' => '2015-12-31 23:59:00',
                ]
            ],
        ];
    }

    /**
     * @param $request
     * @param $seasonParams
     *
     * @dataProvider dataProviderTestGetSeasonDataFailure
     *
     * @expectedException \Api\Exception\ValidationError
     */
    public function testGetSeasonDataFailure($request, $seasonParams)
    {
        $season = $this->getMockSeason($seasonParams);
        $request['get'] = $season;

        $r = $this->getMockRequest($request);

        $r->getSeasonDateBegin();
    }

    public function dataProviderTestGetSeasonDataFailure()
    {
        return [
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => 'flat',
                    'getSurface' => null,
                    'getChampionship' => null,
                    'getSeasonYearBegin' => '2015',
                    'setChampionship' => null,
                    'setSeasonYearBegin' => null,
                    'getGivenParametersCount' => 3,
                ],
                [
                    'getSeasonDatesByYearTypeRace' => null
                ]
            ],
            [
                [
                    'getCountryCodes' => ['GB'],
                    'getRaceType' => null,
                    'getSurface' => null,
                    'getChampionship' => null,
                    'getSeasonYearBegin' => null,
                    'setChampionship' => null,
                    'setSeasonYearBegin' => null,
                    'setRaceType' => null,
                    'getGivenParametersCount' => 0,
                ],
                [
                    'getDefaultSeasons' => null,
                ]
            ],
        ];
    }
}
