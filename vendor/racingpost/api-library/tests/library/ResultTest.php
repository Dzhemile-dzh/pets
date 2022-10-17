<?php

namespace Tests;

use Api\Result\Json as Result;

/**
 * @package Tests
 */
class ResultTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $operation
     * @param $httpCode
     *
     * @dataProvider dataProviderTestGetHttpCodeByModelOperationMadeSuccess
     */
    public function testGetHttpCodeByModelOperationMadeSuccess($operation, $httpCode)
    {
        $this->assertEquals($httpCode, Result::getHttpCodeByModelOperationMade($operation));
    }

    /**
     * @return array
     */
    public function dataProviderTestGetHttpCodeByModelOperationMadeSuccess()
    {
        return [
            [0, 400],
            [1, 201],
            [2, 200],
            [3, 200],
        ];
    }

    /**
     * @param $operation
     *
     * @dataProvider dataProviderTestGetHttpCodeByModelOperationMadeFailure
     */
    public function testGetHttpCodeByModelOperationMadeFailure($operation)
    {
        $this->expectException('\LogicException');
        $this->expectExceptionMessage('operationMadeType must be a constant of Phalcon\Mvc\Model::OP_*');
        Result::getHttpCodeByModelOperationMade($operation);
    }

    /**
     * @return array
     */
    public function dataProviderTestGetHttpCodeByModelOperationMadeFailure()
    {
        return [
            [404],
            [202],
            [300],
            [301],
        ];
    }

    /**
     * @param $data
     *
     * @dataProvider dataProviderTestSetDataSuccess
     */
    public function testSetDataSuccess($data)
    {
        $result = new Result();
        $this->assertSame($result, $result->setData($data));
    }

    /**
     * @return array
     */
    public function dataProviderTestSetDataSuccess()
    {
        return [
            [
                ['result' => true],
            ],
            [
                ['result' => false],
            ],
            [
                ['result' => 0],
            ],
            [
                ['result' => ''],
            ],
            [
                ['result' => ['result' => false]],
            ],
            [
                ['result' => ['result' => 0]],
            ],
            [
                ['result' => ['result' => '']],
            ],
        ];
    }

    /**
     * @param $data
     *
     * @dataProvider dataProviderTestSetDataFailureWithDefaultException
     */
    public function testSetDataFailureWithDefaultException($data)
    {
        $result = new Result();
        $this->expectException('\Exception');
        $this->expectExceptionMessage("Child of BaseExceptionsList must be declared as a service in DI['exceptions']");
        $result->setData($data);
    }

    /**
     * @return array
     */
    public function dataProviderTestSetDataFailureWithDefaultException()
    {
        return [
            [
                ['result' => null],
            ],
            [
                ['result' => ['result' => null]],
            ],
        ];
    }

    /**
     * @param $data
     *
     * @dataProvider dataProviderTestSetDataFailureWithSpecificException
     */
    public function testSetDataFailureWithSpecificException($data)
    {
        $result = new Result();
        $result->setEmptyResultException(new \Exception("Specific exception"));
        $this->expectException('\Exception');
        $this->expectExceptionMessage("Specific exception");
        $result->setData($data);
    }

    /**
     * @return array
     */
    public function dataProviderTestSetDataFailureWithSpecificException()
    {
        return [
            [
                ['result' => null],
            ],
            [
                ['result' => ['result' => null]],
            ],
        ];
    }

    /**
     * @param \stdClass $queryResult
     * @param \stdClass $expectedResult
     * @dataProvider providerRacesWithSameKeyParams
     */
    public function testResultWithoutEmptySection($queryResult, $expectedResult)
    {
        $obj = new Result();
        $obj->setData($queryResult)->collapseEmptySection();
        $reflect = new \ReflectionClass($obj);
        $data = $reflect->getProperty('data');
        $data->setAccessible(true);
        $this->assertEquals($data->getValue($obj), $expectedResult);
    }

    /**
     * @return array
     */
    public function providerRacesWithSameKeyParams()
    {
        return
            [
                [
                    (object)[
                        "riu" => 1284841,
                        "date" => "Mar 21 2014  7:25PM",
                        "tv" => [
                            (object)[
                                "tvid" => null,
                                "name" => null,
                            ]
                        ],
                    ],
                    (object)[
                        "riu" => 1284841,
                        "date" => "Mar 21 2014  7:25PM",
                        "tv" => null,
                    ]
                ],
                [
                    (object)[
                        "riu" => 1284841,
                        "date" => "Mar 22 2014  7:25PM",
                        "tv" => [
                            (object)[
                                "tvid" => 2,
                                "name" => 'TV',
                                "vid" => null,
                            ]
                        ],
                    ],
                    (object)[
                        "riu" => 1284841,
                        "date" => "Mar 22 2014  7:25PM",
                        "tv" => [
                            (object)[
                                "tvid" => 2,
                                "name" => 'TV',
                                "vid" => null,
                            ]
                        ],
                    ]
                ],
                [
                    (object)[
                        "riu" => 1284841,
                        "date" => "Mar 23 2014  7:25PM",
                        "tv" => [
                            (object)[
                                "tvid" => 2,
                                "name" => 'TV',
                                "vval" => [
                                    (object)[
                                        "vid" => null,
                                        "vkey" => null,
                                    ]

                                ],
                                "cid" => null,
                            ]
                        ],
                    ],
                    (object)[
                        "riu" => 1284841,
                        "date" => "Mar 23 2014  7:25PM",
                        "tv" => [
                            (object)[
                                "tvid" => 2,
                                "name" => 'TV',
                                "vval" => null,
                                "cid" => null,
                            ]
                        ],
                    ]
                ],
                [
                    (object)[
                        "riu" => 1284841,
                        "date" => "Mar 24 2014  7:25PM",
                        "tv" => [
                            (object)[
                                "tvid" => 2,
                                "name" => 'TV',
                                "vval" => [
                                    [
                                        "vid" => null,
                                        "vkey" => null,
                                    ],
                                    [
                                        "vid" => null,
                                        "vkey" => null,
                                    ]
                                ],
                                "cid" => null,
                            ]
                        ],
                    ],
                    (object)[
                        "riu" => 1284841,
                        "date" => "Mar 24 2014  7:25PM",
                        "tv" => [
                            (object)[
                                "tvid" => 2,
                                "name" => 'TV',
                                "vval" => null,
                                "cid" => null,
                            ]
                        ],
                    ]
                ],
            ];
    }
}
