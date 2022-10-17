<?php

namespace Tests;

use Phalcon\Exception;
use Tests\Stubs\Models\Selectors;
use Models\Bo\Selectors\Distance;

class SelectorsTest extends \PHPUnit\Framework\TestCase
{
    // ============================= RaceType ====================================

    /**
     * @param $raceType
     * @param $expectedResult
     *
     * @dataProvider providerTestRaceType
     * @throws \Exception
     */
    public function testRaceType($raceType, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getRaceType($raceType);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestRaceType()
    {
        return [
            ['jumps', 'Jumps'],
            ['flat', 'Flat']
        ];
    }

    /**
     * @param $raceType
     *
     * @throws \Exception
     * @expectedException \Exception
     * @dataProvider providerWrongTestRaceType
     */
    public function testWrongRaceType($raceType)
    {
        $selectors = new Selectors();
        $selectors->getRaceType($raceType);
    }

    /**
     * @return array
     */
    public function providerWrongTestRaceType()
    {
        return [
            ['jumps_wrong'],
            ['flat_wrong']
        ];
    }

    // ============================= DistanceGroup ====================================
    /**
     * @param $distanceGroup
     * @param $expectedResult
     *
     * @dataProvider providerTestDistanceFlatGroup
     * @throws \Exception
     */
    public function testDistanceFlatGroup($distanceGroup, $expectedResult)
    {
        $selectors = new Selectors();
        $distance = new Distance();
        $distance->setRaceType('flat');
        $selectors->setDistance($distance);
        $actualResult = $selectors->getDistanceGroup($distanceGroup);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestDistanceFlatGroup()
    {
        return [
            [
                "0-1210",
                [
                    'from' => 0,
                    'to' => 1210
                ]
            ],
            [
                "1100-1320",
                [
                    'from' => 1100,
                    'to' => 1320
                ]
            ],
            [
                "1540-1980",
                [
                    'from' => 1540,
                    'to' => 1980
                ]
            ],
            [
                "2200-2420",
                [
                    'from' => 2200,
                    'to' => 2420
                ]
            ],
            [
                "2640-2860",
                [
                    'from' => 2640,
                    'to' => 2860
                ]
            ],
            [
                "1211-1430",
                [
                    'from' => 1211,
                    'to' => 1430
                ]
            ],
            [
                "1431-1650",
                [
                    'from' => 1431,
                    'to' => 1650
                ]
            ],
            [
                "1651-2090",
                [
                    'from' => 1651,
                    'to' => 2090
                ]
            ],
            [
                "2091-2530",
                [
                    'from' => 2091,
                    'to' => 2530
                ]
            ],
            [
                "2531-2970",
                [
                    'from' => 2531,
                    'to' => 2970
                ]
            ],
            [
                "2971-3410",
                [
                    'from' => 2971,
                    'to' => 3410
                ]
            ],
            [
                "3411-null",
                [
                    'from' => 3411,
                    'to' => null
                ]
            ],
        ];
    }

       /**
     * @param $distanceGroup
     * @param $expectedResult
     *
     * @dataProvider providerTestDistanceJumpGroup
     * @throws \Exception
     */
    public function testDistanceJumpGroup($distanceGroup, $expectedResult)
    {
        $selectors = new Selectors();
        $distance = new Distance();
        $distance->setRaceType('jumps');
        $selectors->setDistance($distance);
        $actualResult = $selectors->getDistanceGroup($distanceGroup);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestDistanceJumpGroup()
    {
        return [
            [
                "0-3850",
                [
                    'from' => 0,
                    'to' => 3850
                ]
            ],
            [
                "3520-3740",
                [
                    'from' => 3520,
                    'to' => 3740
                ]
            ],
            [
                "3851-4290",
                [
                    'from' => 3851,
                    'to' => 4290
                ]
            ],
            [
                "4291-4950",
                [
                    'from' => 4291,
                    'to' => 4950
                ]
            ],
            [
                "4951-5830",
                [
                    'from' => 4951,
                    'to' => 5830
                ]
            ],
            [
                "5831-null",
                [
                    'from' => 5831,
                    'to' => null
                ]
            ]
        ];
    }

    /**
     * @param $distanceGroup
     *
     * @throws \Exception
     * @expectedException \Exception
     * @dataProvider providerTestWrongDistanceGroup
     */
    public function testWrongDistanceGroup($distanceGroup)
    {
        $selectors = new Selectors();
        $distance = new Distance();
        $distance->setRaceType('jumps');
        $selectors->setDistance($distance);
        $selectors->getDistanceGroup($distanceGroup);
    }

    /**
     * @param $distanceGroup
     * @param $expectedResult
     *
     * @dataProvider providerTestDistanceLegacyAltGroup
     * @throws \Exception
     */
    public function testDistanceLegacyAltGroup($distanceGroup, $expectedResult)
    {
        $selectors = new Selectors();
        $distance = new Distance();
        $distance->setRaceType('legacy_alt');
        $selectors->setDistance($distance);
        $actualResult = $selectors->getDistanceGroup($distanceGroup);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestDistanceLegacyAltGroup()
    {
        return [
            [
                "5f",
                [
                    'from' => 0,
                    'to' => 1209
                ]
            ],
            [
                "6f" ,
                [
                    'from' => 1210,
                    'to' => 1429
                ]
            ],
            [
                "7f",
                [
                    'from' => 1430,
                    'to' => 1649
                ]
            ],
            [
                "1m",
                [
                    'from' => 1650,
                    'to' => 1759
                ]
            ],
            [
                "1m-1m1f",
                [
                    'from' => 1760,
                    'to' => 2089
                ]
            ],
            [
                "1m2f-1m3f",
                [
                    'from' => 2090,
                    'to' => 2529
                ]
            ],
            [
                "1m4f-1m5f",
                [
                    'from' => 2530,
                    'to' => 2969
                ]
            ],
            [
                "1m6f-1m7f",
                [
                    'from' => 2970,
                    'to' => 3409
                ]
            ],
            [
                "2m-null",
                [
                    'from' => 3410,
                    'to' => null
                ]
            ]
        ];
    }

    /**
     * @param $distanceGroup
     * @param $expectedResult
     *
     * @dataProvider providerTestDistanceBloodstockGroup
     * @throws \Exception
     */
    public function testDistanceBloodstockGroup($distanceGroup, $expectedResult)
    {
        $selectors = new Selectors();
        $distance = new Distance();
        $distance->setRaceType('bloodstock');
        $selectors->setDistance($distance);
        $actualResult = $selectors->getDistanceGroup($distanceGroup);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestDistanceBloodstockGroup()
    {
        return [
            [
                "5-6f",
                [
                    'from' => 990,
                    'to' => 1429
                ]
            ],
            [
                "7-9f" ,
                [
                    'from' => 1430,
                    'to' => 2089
                ]
            ],
            [
                "10-11f",
                [
                    'from' => 2090,
                    'to' => 2529
                ]
            ],
            [
                "12-13f",
                [
                    'from' => 2530,
                    'to' => 2969
                ]
            ],
            [
                "14f+",
                [
                    'from' => 2970,
                    'to' => null
                ]
            ]
        ];
    }

    /**
     * @return array
     */
    public function providerTestWrongDistanceGroup()
    {
        return [
            [-1],
            [100],
        ];
    }

    /**
     * @param $raceType
     * @param $expectedResult
     *
     * @dataProvider providerTestGetDistanceByRaceType
     * @throws \Exception
     */
    public function testGetDistanceByRaceType($raceType, $expectedResult)
    {
        $selectors = new Selectors();
        $distance = new Distance();
        $selectors->setDistance($distance);
        $actualResult = $selectors->getDistanceByRaceType($raceType);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestGetDistanceByRaceType()
    {
        return [
            [
                'legacy',
                [
                    "5-6f" => [
                        'from' => 1100,
                        'to' => 1429
                    ],
                    "7f-1m" => [
                        'from' => 1430,
                        'to' => 1869
                    ],
                    "9f-10f" => [
                        'from' => 1870,
                        'to' => 2309
                    ],
                    "11f-12f" => [
                        'from' => 2310,
                        'to' => 2749
                    ],
                    "13f+" => [
                        'from' => 2750,
                        'to' => null
                    ]
                ]
            ],
            [
                'legacy_alt',
                [
                    "5f" => [
                        'from' => 0,
                        'to' => 1209
                    ],
                    "6f" => [
                        'from' => 1210,
                        'to' => 1429
                    ],
                    "7f" => [
                        'from' => 1430,
                        'to' => 1649
                    ],
                    "1m" => [
                        'from' => 1650,
                        'to' => 1759
                    ],
                    "1m-1m1f" => [
                        'from' => 1760,
                        'to' => 2089
                    ],
                    "1m2f-1m3f" => [
                        'from' => 2090,
                        'to' => 2529
                    ],
                    "1m4f-1m5f" => [
                        'from' => 2530,
                        'to' => 2969
                    ],
                    "1m6f-1m7f" => [
                        'from' => 2970,
                        'to' => 3409
                    ],
                    "2m-null" => [
                        'from' => 3410,
                        'to' => null
                    ]
                ]
            ]
        ];
    }

    /**
     * @param $raceType
     *
     * @throws \Exception
     * @expectedException \Exception
     * @dataProvider providerTestWrongDistanceByRaceType
     */
    public function testWrongDistanceByRaceType($raceType)
    {
        $selectors = new Selectors();
        $distance = new Distance();
        $selectors->setDistance($distance);
        $selectors->getDistanceByRaceType($raceType);
    }

    /**
     * @return array
     */
    public function providerTestWrongDistanceByRaceType()
    {
        return [
            [1],
            [100],
        ];
    }


// ============================= SeasonDefaultTypeCodes ====================================

    /**
     * Common provider for testSeasonDefaultTypeCodes, testSeasonalStatisticTypeCodes, testSeasonalStatisticTypeSelector
     *
     * @return array
     */
    public function providerWrongStatisticKey()
    {
        return [
            ['trainer_wrong'],
            ['jockey_wrong']
        ];
    }

    /**
     * @param $seasonalStatisticKey
     * @param $expectedResult
     *
     * @dataProvider providerTestSeasonDefaultTypeCodes
     * @throws \Exception
     */
    public function testSeasonDefaultTypeCodes($seasonalStatisticKey, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getSeasonDefaultTypeCodes($seasonalStatisticKey);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestSeasonDefaultTypeCodes()
    {
        return [
            ['trainer', ['L', 'N', 'A', 'W', 'J']],
            ['jockey', ['K', 'M', 'A', 'W', 'J']]
        ];
    }



    /**
     * @param $seasonalStatisticKey
     * @param $expectedResult
     *
     * @dataProvider providerTestGetAvailableSeasonTypeCodes
     * @throws \Exception
     */
    public function testGetAvailableSeasonTypeCodes($seasonalStatisticKey, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getAvailableSeasonTypeCodes($seasonalStatisticKey);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestGetAvailableSeasonTypeCodes()
    {
        return [
            ['trainer', ['F', 'F', 'L', 'N', 'F', 'F', 'L', 'N', 'F', 'F', 'A', 'W', 'J', 'I', 'J', 'I']],
            ['jockey', ['F', 'F', 'K', 'M', 'F', 'F', 'K', 'M', 'F', 'F', 'A', 'W', 'J', 'I']],
            ['owner', ['F', 'F', 'K', 'N', 'F', 'F', 'K', 'E', 'F', 'F', 'A', 'W', 'J', 'I', 'J', 'I']],
        ];
    }

    /**
     * @param $seasonalStatisticKey
     *
     * @throws \Exception
     * @expectedException \Exception
     * @dataProvider providerWrongStatisticKey
     */
    public function testWrongSeasonDefaultTypeCodes($seasonalStatisticKey)
    {
        $selectors = new Selectors();
        $selectors->getSeasonDefaultTypeCodes($seasonalStatisticKey);
    }

// ============================= SeasonTypeCode ====================================
    /**
     * @param $country
     * @param $raceType
     * @param $surface
     * @param $championship
     * @param $expectedResult
     *
     * @dataProvider providerTestSeasonTypeCode
     * @throws \Exception
     */
    public function testSeasonTypeCode($country, $raceType, $surface, $championship, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getSeasonTypeCode($country, $raceType, $surface, $championship);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestSeasonTypeCode()
    {
        return [
            ['GB', 'flat', 'AW', null, 'F'],
            [null, 'flat', 'AW', null, 'F'],
            ['IRE', 'flat', null, 'trainer', 'N'],
            ['IRE', 'jumps', null, null, 'I'],
            ['IRE', 'flat', 'TURF', 'owner', 'E'],
            ['GB', 'flat', 'TURF', 'owner', 'K'],
            ['GB', 'flat', 'AW', 'owner', 'A'],
            ['IRE', 'flat', 'AW', 'owner', 'W'],
        ];
    }

    /**
     * @param $country
     * @param $raceType
     * @param $surface
     * @param $championship
     * @param $expectedResult
     *
     * @dataProvider providerWrongSeasonTypeCode
     */
    public function testWrongSeasonTypeCode($country, $raceType, $surface, $championship, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getSeasonTypeCode($country, $raceType, $surface, $championship);
        $this->assertNotEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerWrongSeasonTypeCode()
    {
        return [
            ['GB', 'flat', 'aw', null, 'GB Flat AW'],
            ['IRE', 'flat', 'turf', 'jockey', 'IRE Flat Jockey Championship'],
            ['IRE', 'jumps', null, null, 'Jumps'],
        ];
    }

    /**
     * @param $params
     *
     * @dataProvider providerTestGetSeasonTypeCodeFailure
     * @expectedException \Exception
     * @throws \Exception
     */
    public function testGetSeasonTypeCodeFailure($params)
    {
        $selectors = new Selectors();
        list($country, $raceType, $surface, $championship) = $params;
        $selectors->getSeasonTypeCode($country, $raceType, $surface, $championship, true);
    }

    public function providerTestGetSeasonTypeCodeFailure()
    {
        return [
            [['usa', 'flat', null, null]],
            [[null, 'flats', 'aw', null]],
            [['gb', 'flat', 'turf', 'bloodstock_horse']],
            [['gb', 'flat', 'nhf', null]],
        ];
    }

    public function testSeasonTypeCodeDefault()
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getSeasonTypeCode('USA', 'jumps');
        $this->assertEquals('F', $actualResult);
    }

// ============================= Championship ====================================
    /**
     * @param $key
     * @param $expectedResult
     *
     * @dataProvider providerTestChampionship
     * @throws \Exception
     */
    public function testChampionship($key, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getChampionship($key);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestChampionship()
    {
        return [
            [
                'trainer',
                'Trainer Title'
            ],
            [
                'jockey',
                'Jockey Title'
            ]
        ];
    }

    /**
     * @param $key
     *
     * @throws \Exception
     * @expectedException \Exception
     * @dataProvider providerWrongChampionship
     */
    public function testWrongChampionship($key)
    {
        $selectors = new Selectors();
        $selectors->getChampionship($key);
    }

    /**
     * @return array
     */
    public function providerWrongChampionship()
    {
        return [
            ['trainer_wrong_key'],
            ['jockey_wrong_key'],
            [''],
            [null]
        ];
    }
// ============================= JumpsTypeCodes ====================================
    /**
     * @param $key
     * @param $expectedResult
     *
     * @dataProvider providerTestJumpsTypeCodes
     * @throws \Exception
     */
    public function testJumpsTypeCodes($key, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getJumpsTypeCodes($key);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestJumpsTypeCodes()
    {
        return [
            [
                'CHASE',
                ['C', 'U', 'Z']
            ],
            [
                'hurdle',
                ['H', 'Y']
            ],
            [
                'NHF',
                ['B', 'W']
            ],
        ];
    }

    /**
     * @param $key
     *
     * @throws \Exception
     * @expectedException \Exception
     * @dataProvider providerWrongJumpsTypeCodes
     */
    public function testWrongJumpsTypeCodes($key)
    {
        $selectors = new Selectors();
        $selectors->getJumpsTypeCodes($key);
    }

    /**
     * @return array
     */
    public function providerWrongJumpsTypeCodes()
    {
        return [
            ['chase_wrong_key'],
            ['NHF_wrong'],
        ];
    }

// ============================= Surface ====================================
    /**
     * @param $key
     * @param $expectedResult
     *
     * @dataProvider providerTestSurface
     * @throws \Exception
     */
    public function testSurface($key, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getSurface($key);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestSurface()
    {
        return [
            [
                'aw',
                'AW'
            ],
            [
                'turf',
                'Turf'
            ]
        ];
    }

    /**
     * @param $key
     *
     * @throws \Exception
     * @expectedException \Exception
     * @dataProvider providerWrongSurface
     */
    public function testWrongSurface($key)
    {
        $selectors = new Selectors();
        $selectors->getSurface($key);
    }

    /**
     * @return array
     */
    public function providerWrongSurface()
    {
        return [
            ['TURF'],
            ['AW_wrong'],
            [''],
            [null]
        ];
    }

// ============================= StatisticsTypeKeys ====================================
    /**
     * @param $expectedResult
     *
     * @dataProvider providerTestStatisticsTypeKeys
     * @throws \Exception
     */
    public function testStatisticsTypeKeys($expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getStatisticsTypeKeys();
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestStatisticsTypeKeys()
    {
        return [
            [
                ['jockey', 'trainer', 'owner']
            ],
        ];
    }
// ============================= StatisticsTypeCodeKeys ====================================
    /**
     * @param $key
     * @param $expectedResult
     *
     * @dataProvider providerTestStatisticsTypeCodeKeys
     * @throws \Exception
     */
    public function testStatisticsTypeCodeKeys($key, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getStatisticsTypeCodeKeys($key);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestStatisticsTypeCodeKeys()
    {
        return [
            [
                'trainer',
                ['course', 'distance', 'month', 'race-type', 'jockey', 'age-of-horse', 'race-category', 'race-class']
            ],
            [
                'jockey',
                ['course', 'distance', 'month', 'race-type', 'trainer', 'age-of-horse', 'race-category', 'race-class']
            ],
            [
                'owner',
                ['course', 'distance', 'month', 'race-type', 'trainer', 'jockey', 'horse', 'age-of-horse', 'race-category', 'race-class']
            ],
        ];
    }

    /**
     * @param $key
     *
     * @throws \Exception
     * @expectedException \Exception
     * @dataProvider providerWrongStatisticsTypeCodeKeys
     */
    public function testWrongStatisticsTypeCodeKeys($key)
    {
        $selectors = new Selectors();
        $selectors->getStatisticsTypeCodeKeys($key);
    }

    /**
     * @return array
     */
    public function providerWrongStatisticsTypeCodeKeys()
    {
        return [
            ['trainer_wrong'],
            ['horse'],
            [''],
            [null]
        ];
    }

// ============================= StatisticsTypeCode ====================================
    /**
     * @param $key
     * @param $expectedResult
     *
     * @dataProvider providerTestStatisticsTypeCode
     * @throws \Exception
     */
    public function testStatisticsTypeCode($key, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getStatisticsTypeCode($key);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestStatisticsTypeCode()
    {
        return [
            [
                'trainer',
                [
                    'course' => 'Course',
                    'distance' => 'Distance',
                    'month' => 'Month',
                    'race-type' => 'Race Type',
                    'jockey' => 'Jockey',
                    'age-of-horse' => 'Age Of Horse',
                    'race-category' => 'Race Category',
                    'race-class' => 'Race Class',
                ]
            ],
            [
                'jockey',
                [
                    'course' => 'Course',
                    'distance' => 'Distance',
                    'month' => 'Month',
                    'race-type' => 'Race Type',
                    'trainer' => 'Trainer',
                    'age-of-horse' => 'Age Of Horse',
                    'race-category' => 'Race Category',
                    'race-class' => 'Race Class',
                ]
            ],
            [
                'owner',
                [
                    'course' => 'Course',
                    'distance' => 'Distance',
                    'month' => 'Month',
                    'race-type' => 'Race Type',
                    'trainer' => 'Trainer',
                    'jockey' => 'Jockey',
                    'horse' => 'Horse',
                    'age-of-horse' => 'Age Of Horse',
                    'race-category' => 'Race Category',
                    'race-class' => 'Race Class',
                ]
            ],
        ];
    }

    /**
     * @param $key
     *
     * @throws \Exception
     * @expectedException \Exception
     * @dataProvider providerWrongStatisticsTypeCode
     */
    public function testWrongStatisticsTypeCode($key)
    {
        $selectors = new Selectors();
        $selectors->getStatisticsTypeCode($key);
    }

    /**
     * @return array
     */
    public function providerWrongStatisticsTypeCode()
    {
        return [
            ['jockey_wrong'],
            ['horse'],
            [''],
            [null]
        ];
    }

// ============================= RaceTypeCode ====================================
    /**
     * @param $key
     * @param $type
     * @param $expectedResult
     *
     * @dataProvider providerTestRaceTypeCode
     * @throws \Exception
     */
    public function testRaceTypeCode($key, $type, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getRaceTypeCode($key, $type);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestRaceTypeCode()
    {
        return [
            [
                'flat',
                null,
                ['F', 'X']
            ],
            [
                'flat',
                'turf',
                ['F']
            ],
            [
                'flat',
                'aw',
                ['X']
            ],
            [
                'jumps',
                null,
                ['H', 'Y', 'C', 'U', 'Z', 'B', 'W']
            ],
            [
                'jumps',
                'hurdle',
                ['H', 'Y']
            ],
            [
                'jumps',
                'chase',
                ['C', 'U', 'Z']
            ],
            [
                'jumps',
                'nhf',
                ['B', 'W']
            ],
            [
                'other',
                'p2p',
                ['P']
            ]
        ];
    }

    /**
     * @param $code
     * @param $expectedRaceType
     *
     * @dataProvider providerTestGetRaceTypeByRaceTypeCodeSuccess
     */
    public function testGetRaceTypeByRaceTypeCodeSuccess($code, $expectedRaceType)
    {
        $selectors = new Selectors();
        $actualRaceType = $selectors->getRaceTypeByRaceTypeCode($code);
        $this->assertEquals($expectedRaceType, $actualRaceType);
    }

    public function providerTestGetRaceTypeByRaceTypeCodeSuccess()
    {
        return [
            ['F', 'flat'],
            ['X', 'flat'],
            ['H', 'jumps'],
            ['Y', 'jumps'],
            ['C', 'jumps'],
            ['U', 'jumps'],
            ['Z', 'jumps'],
            ['B', 'jumps'],
            ['W', 'jumps'],
            ['J', 'jumps'],
            ['Z', 'jumps'],
            ['I', 'jumps'],
            //Attention! Any letter or string that not in the list above will produce 'flat' as result
            ['qwerty', 'flat'],
            ['K', 'flat'],
            ['V', 'flat'],

        ];
    }

    public function testGetGroupedRaceTypeCodes()
    {
        $selectors = new Selectors();
        $expectedRaceTypeCodes = [
            'flat' => ['F', 'X'],
            'jumps' => ['H', 'Y', 'C', 'U', 'Z', 'B', 'W'],
        ];
        $this->assertEquals($expectedRaceTypeCodes, $selectors->getGroupedRaceTypeCodes());
    }

    public function testGetGoingSuccess()
    {
        $selectors = new Selectors();

        foreach (['F' => 'Firm', 'FT' => 'Fast', 'FZ' => 'Frozen', 'YS' => 'Yielding To Soft',] as $k => $v) {
            $this->assertEquals($v, $selectors->getGoing($k));
        }
    }

    /**
     * @throws \Exception
     * @expectedException \Exception
     */
    public function testGetGoingFailure()
    {
        $selectors = new Selectors();

        $selectors->getGoing('Foo');
    }

    /**
     * @param $key
     * @param $surface
     *
     * @throws \Exception
     * @expectedException \Exception
     * @dataProvider providerWrongRaceTypeCode
     */
    public function testWrongRaceTypeCode($key, $surface)
    {
        $selectors = new Selectors();
        $selectors->getRaceTypeCode($key, $surface);
    }

    /**
     * @return array
     */
    public function providerWrongRaceTypeCode()
    {
        return [
            ['flat', 'jumps'],
            ['jumps', 'aw'],
            ['jumps', 'turf'],
        ];
    }

// ============================= RaceTypeKeys ====================================
    /**
     * @param $expectedResult
     *
     * @dataProvider providerTestRaceTypeKeys
     * @throws \Exception
     */
    public function testRaceTypeKeys($expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getRaceTypeKeys();
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestRaceTypeKeys()
    {
        return [
            [
                ['flat', 'jumps']
            ],
        ];
    }

// ============================= RaceTypeByDate ====================================
    /**
     * @param $expectedResult
     *
     * @dataProvider providerTestRaceTypeByDate
     * @throws \Exception
     */
    public function testRaceTypeByDate($expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getRaceTypeByDate();
        $this->assertTrue(in_array($actualResult, $expectedResult));
    }

    /**
     * @return array
     */
    public function providerTestRaceTypeByDate()
    {
        return [
            [
                ['flat', 'jumps']
            ]
        ];
    }

// ============================= getSiresCategories ====================================

    /**
     * @param $params
     * @param $expectedResult
     *
     * @dataProvider providerTestSiresCategories
     * @throws \Exception
     */
    public function testSiresCategories($params, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getSiresCategories($params[0], $params[1], $params[2], $params[3]);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerTestSiresCategories()
    {
        return [
            [
                ['gb', 'flat', null ,'sire'],
                ['Flat', 'All-weather'],
            ],
            [
                ['gb','jumps', null,'sire'],
                ['Jumps'],
            ],
            [
                ['gb','flat','turf','sire'],
                ['Flat'],
            ],
            [
                ['gb','flat','aw','sire'],
                ['All-weather'],
            ],
        ];
    }

    /**
     * @param $params
     *
     * @throws \Exception
     * @expectedException \Exception
     * @dataProvider providerWrongSiresCategories
     */
    public function testWrongSiresCategories($params)
    {
        $selectors = new Selectors();
        $selectors->getSiresCategories($params[0], $params[1], $params[2]);
    }

    /**
     * @return array
     */
    public function providerWrongSiresCategories()
    {
        return [
            [['gb','flat', null]],
            [['horse', null, null]],
            [['ire', 'flat', 'turf']],
        ];
    }


// ============================= getHorseAgeSQL ====================================
    /**
     * @param $arg            Array
     * @param $expectedResult String
     *
     * @dataProvider providerGetHorseAgeSQL
     */
    public function testGetHorseAgeSQL($arg, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = preg_replace("[\r\n]", "", $selectors->getHorseAgeSQL($arg[0], $arg[1], $arg[2]));
        $actualResult = preg_replace("|\s+|", " ", $actualResult);
        $this->assertEquals(strtolower($expectedResult), strtolower($actualResult));
    }

    /**
     * @return array
     */
    public function providerGetHorseAgeSQL()
    {
        return [
            [
                ['2011-06-09', 'AUS', '2015-06-09'],
                "datediff(year, 2011-06-09, 2015-06-09) - ( case when (aus in ('aus', 'nz', 'saf', 'zim', 'ndo') and datepart(mm, 2015-06-09) < 8) or (aus in ('arg', 'brz', 'chi', 'col', 'ecu', 'per', 'uru', 'ven', 'fi') and datepart(mm, 2015-06-09) < 7) then 1 else 0 end )"
            ],
            [
                ['2007-01-19', 'FI', null],
                "datediff(year, 2007-01-19, getdate()) - ( case when (fi in ('aus', 'nz', 'saf', 'zim', 'ndo') and datepart(mm, getdate()) < 8) or (fi in ('arg', 'brz', 'chi', 'col', 'ecu', 'per', 'uru', 'ven', 'fi') and datepart(mm, getdate()) < 7) then 1 else 0 end )"
            ],
            [
                ['2014-08-24', 'GB', '2015-11-24'],
                "datediff(year, 2014-08-24, 2015-11-24) - ( case when (gb in ('aus', 'nz', 'saf', 'zim', 'ndo') and datepart(mm, 2015-11-24) < 8) or (gb in ('arg', 'brz', 'chi', 'col', 'ecu', 'per', 'uru', 'ven', 'fi') and datepart(mm, 2015-11-24) < 7) then 1 else 0 end )"
            ],
            // We test the behavior if we add a double quoted date string, and if the date provided is greater than
            // current date which is hardcoded to be 06/09/2016.
            [
                ['2007-01-19', 'FI', "'2030-11-24''"],
                "datediff(year, 2007-01-19, getdate()) - ( case when (fi in ('aus', 'nz', 'saf', 'zim', 'ndo') and datepart(mm, getdate()) < 8) or (fi in ('arg', 'brz', 'chi', 'col', 'ecu', 'per', 'uru', 'ven', 'fi') and datepart(mm, getdate()) < 7) then 1 else 0 end )"
            ],
        ];
    }

    // ============================= GetRaceTypeKey ====================================
    /**
     * @param $raceTypeCode            String
     * @param $expectedResult          String
     *
     * @dataProvider providerGetRaceTypeKey
     */
    public function testGetRaceTypeKey($raceTypeCode, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getRaceTypeKey($raceTypeCode);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerGetRaceTypeKey()
    {
        return [
            ['F', 'flat'],
            ['X', 'flat'],
            ['H', 'jumps'],
            ['C', 'jumps'],
            ['Z', 'jumps'],
            ['B', 'jumps'],
            ['Y', 'jumps'],
            ['U', 'jumps'],
            ['W', 'jumps'],
            [null, null],
        ];
    }

    /**
     * @param $raceTitle
     * @param $courseId
     * @param $endDate
     * @param $expectedResult
     *
     * @dataProvider providerGetSearchDefaultStartDate
     */
    public function testGetSearchDefaultStartDate($raceTitle, $courseId, $endDate, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getSearchDefaultStartDate($raceTitle, $courseId, $endDate);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerGetSearchDefaultStartDate()
    {
        return [
            [null, null, '2015-01-31', '2015-01-24'],
            ['test', null, '2015-01-31', '1988-01-01'],
            [null, 184, '2015-01-31', '2014-01-31'],
            ['test', 184, '2015-01-31', '1988-01-01'],

        ];
    }

    /**
     * @param int     $seasonYear
     * @param string  $seasonTypeCode
     * @param string (date) $expectedResult
     *
     * @dataProvider providerGetSeasonDateBegin
     */
    public function testGetSeasonDateBegin($seasonYear, $seasonTypeCode, $expectedResult)
    {
        $selectors = new Selectors();
        $selectors->setDb(new Stubs\Models\Bo\Selectors\Database());
        $actualResult = $selectors->getDb()->getSeasonDateBegin(
            $seasonYear,
            $seasonTypeCode
        );
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerGetSeasonDateBegin()
    {
        return [
            [2011, 'F', '2011-01-01 00:00:00.0'],
            [2014, 'J', '2014-04-27 00:00:00.0'],
            [2010, 'I', '2010-04-25 00:00:00.0'],
            [2012, 'T', '2012-03-31 00:00:00.0'],
            [2016, 'A', '2016-10-29 00:00:00.0'],
        ];
    }

    /**
     * @param int           $seasonYear
     * @param string        $seasonTypeCode
     * @param string (date) $expectedResult
     *
     * @dataProvider providerGetSeasonDateEnd
     */
    public function testGetSeasonDateEnd($seasonYear, $seasonTypeCode, $expectedResult)
    {
        $selectors = new Selectors();
        $selectors->setDb(new Stubs\Models\Bo\Selectors\Database());
        $actualResult = $selectors->getDb()->getSeasonDateEnd(
            $seasonYear,
            $seasonTypeCode
        );
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerGetSeasonDateEnd()
    {
        return [
            [2013, 'F', '2013-12-31 23:59:00.0'],
            [2014, 'J', '2015-04-25 23:59:00.0'],
            [2010, 'I', '2011-05-07 23:59:00.0'],
            [2012, 'T', '2012-11-10 23:59:00.0'],
            [2016, 'A', '2017-03-25 23:59:00.0'],
        ];
    }

    /**
     * @param $isFlatRace
     * @param $expectedResult
     *
     * @dataProvider providerGetRaceCardStatsGroups
     */
    public function testGetRaceCardStatsGroups($isFlatRace, $expectedResult)
    {
        $selectors = new Selectors();
        $actualResult = $selectors->getRaceCardStatsGroups($isFlatRace);
        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @return array
     */
    public function providerGetRaceCardStatsGroups()
    {
        return [
            [
                true,
                ['2yo', '3yo', '4yo',]
            ],
            [
                false,
                ['chase', 'hurdle', 'nhf']
            ],
        ];
    }

    /**
     * @param $params
     * @param $expectedResult
     *
     * @dataProvider providerTestIsSeasonalStatisticsAvailable
     */
    public function testIsSeasonalStatisticsAvailable($params, $expectedResult)
    {
        $selectors = new Selectors();
        list($entity, $country, $raceType, $surface, $championship) = $params;
        $actualResult = $selectors->isSeasonalStatisticsAvailable($entity, $country, $raceType, $surface, $championship);
        $this->assertEquals($expectedResult, $actualResult);
    }

    public function providerTestIsSeasonalStatisticsAvailable()
    {
        return [
            [['jockey', 'gb', 'flat', null, null], true],
            [['jockey', 'gb', 'flat', null, 'jockey'], true],
            [['jockey', 'gb', 'flat', 'turf', null], true],
            [['jockey', 'gb', 'flat', 'turf', 'jockey',], true],
            [['jockey', 'gb', 'flat', 'aw', null], true],
            [['jockey', 'gb', 'flat', 'aw', 'jockey',], true],
            [['jockey', 'ire', 'flat', null, null], true],
            [['jockey', 'ire', 'flat', null, 'jockey',], true],
            [['jockey', 'ire', 'flat', 'turf', null], true],
            [['jockey', 'ire', 'flat', 'turf', 'jockey',], true],
            [['jockey', 'ire', 'flat', 'aw', null], true],
            [['jockey', 'ire', 'flat', 'aw', 'jockey',], true],
            [['jockey', 'gb', 'jumps', null, null], true],
            [['jockey', 'ire', 'jumps', null, null], true],

            [['jockey', null, 'jumps', null, null], false],

            [['trainer', 'gb', 'flat', null, 'trainer'], true],
            [['trainer', 'gb', 'flat', null, null], true],
            [['trainer', 'gb', 'flat', 'turf', null], true],
            [['trainer', 'gb', 'flat', 'turf', 'trainer',], true],
            [['trainer', 'gb', 'flat', 'aw', null], true],
            [['trainer', 'gb', 'flat', 'aw', 'trainer',], true],
            [['trainer', 'ire', 'flat', null, null], true],
            [['trainer', 'ire', 'flat', null, 'trainer',], true],
            [['trainer', 'ire', 'flat', 'turf', null], true],
            [['trainer', 'ire', 'flat', 'turf', 'trainer',], true],
            [['trainer', 'ire', 'flat', 'aw', null], true],
            [['trainer', 'ire', 'flat', 'aw', 'trainer',], true],
            [['trainer', 'ire', 'jumps', null, 'trainer',], true],
            [['trainer', 'gb', 'jumps', null, null], true],
            [['trainer', 'gb', 'jumps', null, 'trainer',], true],
            [['trainer', 'ire', 'jumps', null, null], true],

            [['trainer', null, 'jumps', null, null], false],


            [['owner', 'gb', 'jumps', null, null], true],
            [['owner', 'gb', 'jumps', null, 'owner',], true],
            [['owner', 'ire', 'jumps', null, null], true],
            [['owner', 'ire', 'jumps', null, 'owner',], true],
            [['owner', 'gb', 'flat', null, null], true],
            [['owner', 'gb', 'flat', null, 'owner',], true],
            [['owner', 'gb', 'flat', 'turf', null], true],
            [['owner', 'gb', 'flat', 'aw', null], true],
            [['owner', 'gb', 'flat', 'aw', 'owner',], true],
            [['owner', 'ire', 'flat', null, null], true],
            [['owner', 'ire', 'flat', null, 'owner',], true],
            [['owner', 'ire', 'flat', 'aw', null], true],
            [['owner', 'ire', 'flat', 'aw', 'owner',], true],
            [['owner', 'ire', 'flat', 'turf', null], true],

            [['horse', 'gb', 'flat', null, null], true],
            [['horse', 'gb', 'flat', 'turf', null], true],
            [['horse', 'gb', 'flat', 'aw', null], true],
            [['horse', 'gb', 'flat', 'aw', 'horse'], true],
            [['horse', 'gb', 'flat', null, 'horse'], true],
            [['horse', 'gb', 'jumps', null, null], true],
            [['horse', 'gb', 'jumps', null, 'horse'], true],
            [['horse', 'ire', 'flat', null, null], true],
            [['horse', 'ire', 'jumps', null, null], true],
            [['horse', 'ire', 'jumps', null, 'horse'], true],
            [['horse', 'ire', 'flat', 'aw', null], true],
            [['horse', 'ire', 'flat', 'turf', null], true],
            [['horse', 'ire', 'flat', null, 'horse'], true],
            [['horse', 'ire', 'flat', 'aw', 'horse'], true],

            [['horse', null, 'flat', 'aw', null], false],


            [['bloodstock_horse', null, 'jumps', null, null], true],
            [['bloodstock_horse', null, 'jumps', 'hurdle', null], true],
            [['bloodstock_horse', null, 'jumps', 'chase', null], true],
            [['bloodstock_horse', null, 'jumps', 'nhf', null], true],
            [['bloodstock_horse', null, 'flat', 'turf', null], true],
            [['bloodstock_horse', null, 'flat', 'aw', null], true],

            [['bloodstock_horse', 'gb', 'flat', 'aw', null], false],
            [['bloodstock_horse', 'gb', 'jumps', null, null], false],


            [['sire', 'gb', 'flat', null, null,], true],
            [['sire', 'gb', 'flat', null, 'sire',], true],
            [['sire', 'gb', 'flat', 'turf', null,], true],
            [['sire', 'gb', 'flat', 'aw', null,], true],
            [['sire', 'gb', 'flat', 'turf', 'sire',], true],
            [['sire', 'gb', 'flat', 'aw', 'sire',], true],
            [['sire', 'ire', 'flat', null, null,], true],
            [['sire', 'ire', 'flat', 'turf', null,], true],
            [['sire', 'ire', 'flat', 'aw', null,], true],
            [['sire', 'gb', 'jumps', null, null,], true],
            [['sire', 'gb', 'jumps', null, 'sire',], true],
            [['sire', 'ire', 'jumps', null, null,], true],

        ];
    }

    /**
     * @param $racesTypes
     * @param $expectedMeetingType
     *
     * @dataProvider providerTestGetMeetingTypeByRacesTypesSuccess
     */
    public function testGetMeetingTypeByRacesTypesSuccess($racesTypes, $expectedMeetingType)
    {
        $selectors = new Selectors();
        $actualMeetingType = $selectors->getMeetingTypeByRacesTypes($racesTypes);
        $this->assertEquals($expectedMeetingType, $actualMeetingType);
    }

    public function providerTestGetMeetingTypeByRacesTypesSuccess()
    {
        return [
            [['F', 'X'], \Models\Selectors::MEETING_TYPE_FLAT],
            [['F'], \Models\Selectors::MEETING_TYPE_FLAT],
            [['H'], \Models\Selectors::MEETING_TYPE_JUMPS],
            [['Y', 'C', 'U', 'Z'], \Models\Selectors::MEETING_TYPE_JUMPS],
            [['F', 'H'], \Models\Selectors::MEETING_TYPE_MIXED],
            [['X', 'B', 'W'], \Models\Selectors::MEETING_TYPE_MIXED],
            [['F', 'X', 'Y'], \Models\Selectors::MEETING_TYPE_MIXED],
        ];
    }

    /**
     * @param $racesTypes
     *
     * @dataProvider providerTestGetMeetingTypeByRacesTypesFailure
     * @expectedException \Exception
     */
    public function testGetMeetingTypeByRacesTypesFailure($racesTypes)
    {
        $selectors = new Selectors();
        $selectors->getMeetingTypeByRacesTypes($racesTypes);
    }

    public function providerTestGetMeetingTypeByRacesTypesFailure()
    {
        return [
            [''],
            [[]],
            [['P', 'D']],
        ];
    }

    /**
     * @param string $seasonTypeCode
     * @param string $expectedRaceType
     *
     * @dataProvider providerTestGetRaceTypeBySeasonTypeCodeSuccess
     */
    public function testGetRaceTypeBySeasonTypeCodeSuccess($seasonTypeCode, $expectedRaceType)
    {
        $selectors = new Selectors();
        $this->assertSame($expectedRaceType, $selectors->getRaceTypeBySeasonTypeCode($seasonTypeCode));
    }

    public function providerTestGetRaceTypeBySeasonTypeCodeSuccess()
    {
        return [
            ['F', 'flat'],
            ['L', 'flat'],
            ['N', 'flat'],
            ['K', 'flat'],
            ['M', 'flat'],
            ['E', 'flat'],
            ['T', 'flat'],
            ['A', 'flat'],
            ['W', 'flat'],
            ['J', 'jumps'],
            ['I', 'jumps'],
            ['C', 'jumps'],
            ['H', 'jumps'],
            ['B', 'jumps'],
        ];
    }

    /**
     * @param string $seasonTypeCode
     * @expectedException \InvalidArgumentException
     *
     * @dataProvider providerTestGetRaceTypeBySeasonTypeCodeFailure
     */
    public function testGetRaceTypeBySeasonTypeCodeFailure($seasonTypeCode)
    {
        $selectors = new Selectors();
        $selectors->getRaceTypeBySeasonTypeCode($seasonTypeCode);
    }

    public function providerTestGetRaceTypeBySeasonTypeCodeFailure()
    {
        return [
            ['Z'],
            ['X'],
            ['V'],
        ];
    }

    /**
     * @param       $seasonTypeCode
     * @param array $expectedResult
     *
     * @dataProvider dataProviderGetCountryCodesBySeasonTypeSuccess
     */
    public function testGetCountryCodesBySeasonTypeSuccess($seasonTypeCode, array $expectedResult)
    {
        $selectors = new Selectors();
        $this->assertEquals($selectors->getCountryCodesBySeasonType($seasonTypeCode), $expectedResult);
    }

    /**
     * @return array
     */
    public function dataProviderGetCountryCodesBySeasonTypeSuccess()
    {
        return [
            ['A', ['GB']],
            ['C', ['GB']],
            ['D', ['GB']],
            ['E', ['IRE']],
            ['F', ['GB', 'IRE']],
            ['I', ['IRE']],
            ['J', ['GB']],
            ['K', ['GB']],
            ['L', ['GB']],
            ['M', ['IRE']],
            ['N', ['IRE']],
            ['P', ['GB']],
            ['S', ['GB']],
            ['T', ['GB']],
            ['W', ['IRE']],
            ['H', ['HK']],
            [[], []],
            [null, []],
            [false, []],
            ['Z', []],
            [new \stdClass(), []]
        ];
    }

    /**
     * @param $raceTypeCode
     * @param array $expectedResult
     *
     * @dataProvider dataProviderGetRaceTypeSubGroup
     */
    public function testGetRaceTypeSubGroup($raceTypeCode, array $expectedResult)
    {
        $selectors = new Selectors();
        $this->assertEquals($selectors->getRaceTypeSubGroup($raceTypeCode), $expectedResult);
    }

    /**
     * @return array
     */
    public function dataProviderGetRaceTypeSubGroup()
    {
        return [
            ['F', ['F', 'X']],
            ['X', ['F', 'X']],
            ['H', ['H', 'Y']],
            ['Y', ['H', 'Y']],
            ['C', ['C', 'U', 'Z']],
            ['U', ['C', 'U', 'Z']],
            ['Z', ['C', 'U', 'Z']],
            ['B', ['B', 'W']],
            ['W', ['B', 'W']],
//            This part will always return 'flat' for incorrent input parameters
            ['Q', ['F', 'X']],
        ];
    }

    /**
     * @param $raceTypeCode
     * @param string $expectedResult
     *
     * @dataProvider dataProviderGetRaceTypeGroupNameByRaceType
     */
    public function testGetRaceTypeGroupNameByRaceType($raceTypeCode, string $expectedResult)
    {
        $selectors = new Selectors();
        $this->assertEquals($selectors->getRaceTypeGroupNameByRaceType($raceTypeCode), $expectedResult);
    }

    /**
     * @return array
     */
    public function dataProviderGetRaceTypeGroupNameByRaceType()
    {
        return [
            ['F', 'flat'],
            ['X', 'flat'],
            ['H', 'hurdle'],
            ['Y', 'hurdle'],
            ['C', 'chase'],
            ['U', 'chase'],
            ['Z', 'chase'],
            ['B', 'nhf'],
            ['W', 'nhf'],
//            Wrong input parameter
            ['N', 'Unknown'],
        ];
    }
}
