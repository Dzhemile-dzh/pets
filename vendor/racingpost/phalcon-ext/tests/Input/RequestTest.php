<?php
/**
 * Created by PhpStorm.
 * User: myroslav_kosinskyi
 * Date: 2/3/15
 * Time: 3:14 PM
 */

namespace Tests\Input;

use Phalcon\Input\Request\Parameter\Validator as StandardValidator;
use Tests\Input\Mock\Request;

class RequestTest extends \Tests\CommonTestCase
{

    /**
     * @param array $params
     * @param array $ordered
     * @param array $named
     * @param       $validatorParams
     *
     * @return RequestMock
     */
    private function getRequestMock(array $params, $ordered = [], $named = [], $validatorParams = null)
    {
        $request = new Request($this, $params);
        if ($validatorParams) {
            $validator = new \Tests\Input\Request\ValidatorMock();
            $validator->setUp($validatorParams);
            $request->setValidator($validator);
        }
        return $request->invokeConstructor($ordered, $named);
    }

    /**
     * @param string $getParameter
     * @param array $params
     * @param array $ordered
     * @param array $named
     *
     * @expectedException \Phalcon\Input\Request\Exception\ParameterDoesNotExist
     * @expectedExceptionMessage Parameter otherParam does not exists
     *
     * @dataProvider             providerTestGetNotExistsOrderedParameter
     */
    public function testGetNotExistsOrderedParameter($getParameter, $params, $ordered, $named)
    {
        $request = $this->getRequestMock($params, $ordered, $named);

        $request->{$getParameter}();
    }

    /**
     * @return array
     */
    public function providerTestGetNotExistsOrderedParameter()
    {
        return [
            [
                'getOtherParam',
                [
                    'params' => [
                        [
                            'getType' => 'ordered',
                            'getName' => 'someParam',
                        ],
                    ],
                    'errorBuilder' => [],
                ],
                ['someValue'],//ordered
                []//named
            ],
        ];
    }

    /**
     * @param array $params
     * @param string $expected
     *
     * @dataProvider providerTestToString
     */
    public function testToString(array $params, $expected)
    {
        $request = $this->getRequestMock($params['mockParams'], $params['ordered'], $params['named']);

        $this->assertEquals((string)$request, $expected);
    }

    /**
     * @return array
     */
    public function providerTestToString()
    {
        return [
            [
                [
                    'ordered' => [],
                    'named' => ['namedParam1' => 10],
                    'mockParams' => [
                        'params' => [
                            [
                                'getType' => 'named',
                                'getName' => 'namedParam1',
                            ],
                            [
                                'getType' => 'named',
                                'getName' => 'namedParam2',
                            ],
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam',
                            ],
                        ],
                        'errorBuilder' => [],
                    ],
                ],
                'namedParam1=10&namedParam2=',
            ],
            [
                [
                    'ordered' => [1],
                    'named' => [],
                    'mockParams' => [
                        'params' => [
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam1',
                            ],
                            [
                                'getType' => 'named',
                                'getName' => 'namedParam1',
                                'getDefaultValue' => 777,
                            ],
                            [
                                'getType' => 'named',
                                'getName' => 'namedParam2',
                                'getDefaultValue' => 777,
                            ],
                        ],
                        'errorBuilder' => [],
                    ],
                ],
                'namedParam1=&namedParam2=',
            ],
            [
                [
                    'ordered' => [],
                    'named' => ['CarlosCastanedaBorn' => 1925, 'CarlosCastanedaDied' => 1988],
                    'mockParams' => [
                        'params' => [
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam1',
                            ],
                            [
                                'getType' => 'named',
                                'getName' => 'CarlosCastanedaBorn',
                            ],
                            [
                                'getType' => 'named',
                                'getName' => 'CarlosCastanedaDied',
                            ],
                        ],
                        'errorBuilder' => [],
                    ],
                ],
                'CarlosCastanedaBorn=1925&CarlosCastanedaDied=1988',
            ],
            [
                [
                    'ordered' => [999],
                    'named' => [],
                    'mockParams' => [
                        'params' => [
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam1',
                            ],
                        ],
                        'errorBuilder' => [],
                    ],
                ],
                '',
            ],
        ];
    }

    /**
     * @param $ordered
     * @param $named
     * @param $config
     *
     * @expectedException \Exception
     * @expectedExceptionMessageRegExp /^Wrong (orderedParam1|namedParam1)/
     *
     * @dataProvider providerTestValidation
     */
    public function testValidation($ordered, $named, $config)
    {
        $this->getRequestMock($config, $ordered, $named);
    }

    /**
     * @return array
     */
    public function providerTestValidation()
    {
        return [
            [
                [1],
                ['namedParam1' => 'd'],
                [
                    'params' => [
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam1',
                            'isRequired' => true,
                            'getValidator' => true,
                            'validate' => true,
                        ],
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam2',
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam1',
                            'isRequired' => true,
                            'getValidator' => true,
                            'validate' => false,
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam2',
                        ],
                    ],
                    'errorBuilder' => [
                        'collectInfoForInvalidParameters' => ['namedParam1', ''],
                    ],
                ],
            ],
            [
                ['-'],
                ['namedParam1' => 1],
                [
                    'params' => [
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam1',
                            'isRequired' => true,
                            'getValidator' => true,
                            'validate' => false,//not valid
                        ],
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam2',
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam1',
                            'isRequired' => true,
                            'getValidator' => true,
                            'validate' => true,
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam2',
                        ],
                    ],
                    'errorBuilder' => [
                        'collectInfoForInvalidParameters' => ['orderedParam1', ''],
                    ],
                ],
            ],
        ];
    }

    /**
     * @param array $ordered
     * @param array $named
     * @param array $config
     *
     * @expectedException \Exception
     * @expectedExceptionMess
     * ageRegExp /^Parameter (orderedParam1|namedParam1) \[[a-z]+\] is required/
     *
     * @dataProvider providerTestNotAllRequiredParametersExists
     */
    public function testNotAllRequiredParametersExists($ordered, $named, $config)
    {
        $this->getRequestMock($config, $ordered, $named);
    }

    /**
     * @return array
     */
    public function providerTestNotAllRequiredParametersExists()
    {
        return [
            [
                [],
                [],
                [
                    'params' => [
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam1',
                            'isRequired' => true,
                            'getValidator' => true,
                            'validate' => false,//not valid
                        ],
                    ],
                    'errorBuilder' => [
                        'collectInfoForInvalidParameters' => ['orderedParam1', ''],
                    ],
                ],
            ],
            [
                [],
                [],
                [
                    'params' => [
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam1',
                            'isRequired' => true,
                            'getValidator' => true,
                            'validate' => false,//not valid
                        ],
                    ],
                    'errorBuilder' => [
                        'collectInfoForInvalidParameters' => ['namedParam1', ''],
                    ],
                ],
            ],
        ];
    }


    /**
     *
     * @param array $ordered
     * @param array $named
     * @param array $config
     *
     * @expectedException \Phalcon\Input\Request\Exception\ToManyRawParameters
     * @expectedExceptionMessage Described 2 ordered parameters in request but 3 raw ordered parameters were got
     *
     * @dataProvider             providerTestToManyRawParameters
     */
    public function testToManyRawParameters($ordered, $named, $config)
    {
        $this->getRequestMock($config, $ordered, $named);
    }

    /**
     * @return array
     */
    public function providerTestToManyRawParameters()
    {
        return [
            [
                [1, 2, 3],
                [],
                [
                    'params' => [
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam1',
                            'isRequired' => true,
                        ],
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam2',
                            'isRequired' => true,
                        ],
                    ],
                    'errorBuilder' => [],
                ],
            ],
        ];
    }


    /**
     * @param array $ordered
     * @param array $named
     * @param array $config
     *
     * @dataProvider providerTestGetValue
     */
    public function testGetValue($ordered, $named, $config)
    {
        $request = $this->getRequestMock($config, $ordered, $named);

        $this->assertSame($ordered[0], $request->getOrderedParam1());
        $this->assertSame($ordered[1], $request->getOrderedParam2());
        $this->assertSame($named['namedParam1'], $request->getNamedParam1());
    }

    /**
     * @return array
     */
    public function providerTestGetValue()
    {
        return [
            [
                [1001, 1002],
                ['namedParam1' => 10],
                [
                    'params' => [
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam1',
                            'getValue' => 1001,
                        ],
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam2',
                            'getValue' => 1002,
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam1',
                            'getValue' => 10,
                        ],
                    ],
                    'errorBuilder' => [],
                ],
            ],
        ];
    }

    public function testOptionalParameters()
    {
        $request = $this->getRequestMock(
            [
                'params' => [
                    [
                        'getType' => 'ordered',
                        'getName' => 'orderedParam1',
                        'getValue' => 1,
                        'isRequired' => true,
                    ],
                    [
                        'getType' => 'ordered',
                        'getName' => 'orderedParam2',
                    ],
                    [
                        'getType' => 'ordered',
                        'getName' => 'orderedParam3',
                        'getValue' => [null, 4],
                        'getDefaultValue' => 4,
                    ],
                    [
                        'getType' => 'named',
                        'getName' => 'namedParam1',
                        'isRequired' => true,
                        'getValue' => 1,
                    ],
                    [
                        'getType' => 'named',
                        'getName' => 'namedParam2',
                        'getValue' => [null, 2],
                        'getDefaultValue' => 2,
                    ],
                    [
                        'getType' => 'named',
                        'getName' => 'namedParam3',
                    ],
                ],
                'errorBuilder' => [],
            ],
            [1],
            ['namedParam1' => 1]
        );

        $this->assertSame(1, $request->getOrderedParam1());
        $this->assertSame(null, $request->getOrderedParam2());
        $this->assertSame(4, $request->getOrderedParam3());
        $this->assertSame(1, $request->getNamedParam1());
        $this->assertSame(2, $request->getNamedParam2());
        $this->assertSame(null, $request->getNamedParam3());
    }

    /**
     *
     */
    public function testValidatorIsNotSet()
    {
        $request = $this->getRequestMock(
            [
                'params' => [
                    [
                        'getType' => 'ordered',
                        'getName' => 'orderedParam1',
                        'getValue' => 1,
                        'isRequired' => true,
                    ],
                    [
                        'getType' => 'ordered',
                        'getName' => 'orderedParam2',
                        'getValue' => '11',
                        'isRequired' => true,
                    ],
                    [
                        'getType' => 'ordered',
                        'getName' => 'orderedParam3',
                        'getValue' => [],
                        'isRequired' => true,
                    ],
                    [
                        'getType' => 'named',
                        'getName' => 'namedParam1',
                        'isRequired' => true,
                        'getValue' => 1,
                    ],
                    [
                        'getType' => 'named',
                        'getName' => 'namedParam2',
                        'getValue' => 'ff',
                        'isRequired' => true,
                    ],
                ],
                'errorBuilder' => [],
            ],
            [1, '11', []],
            [
                'namedParam1' => 1,
                'namedParam2' => 'ff',
            ]
        );

        $this->assertSame(1, $request->getOrderedParam1());
        $this->assertSame('11', $request->getOrderedParam2());
        $this->assertSame([], $request->getOrderedParam3());
        $this->assertSame(1, $request->getNamedParam1());
        $this->assertSame('ff', $request->getNamedParam2());
    }

    /**
     * @param array $requestParams
     * @param array $validatorParams
     *
     * @dataProvider providerTestValidatorsSuccess
     */
    public function testValidatorsSuccess(array $requestParams, array $validatorParams)
    {
        $this->getRequestMock(
            $requestParams['config'],
            $requestParams['ordered'],
            $requestParams['named'],
            $validatorParams
        );
        $this->assertEquals(1, 1);
    }

    /**
     * @return array
     */
    public function providerTestValidatorsSuccess()
    {
        return [
            [
                [
                    'ordered' => [],
                    'named' => ['namedParam1' => 10],
                    'config' => [
                        'params' => [
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam1',
                            ],
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam2',
                            ],
                            [
                                'getType' => 'named',
                                'getName' => 'namedParam1',
                                'getValue' => 10,
                            ],
                        ],
                        'errorBuilder' => [],
                    ],
                ],
                [
                    'methods' => [
                        'getOrderedParam1',
                        'getOrderedParam2',
                    ],
                    'exception' => new \Exception('Request validator exception 1'),
                ],
            ],
            [
                [
                    'ordered' => [1],
                    'named' => [],
                    'config' => [
                        'params' => [
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam1',
                                'getValue' => 1,
                            ],
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam2',
                            ],
                            [
                                'getType' => 'named',
                                'getName' => 'namedParam1',
                            ],
                        ],
                        'errorBuilder' => [],
                    ],
                ],
                [
                    'methods' => [
                        'getNamedParam1',
                        'getOrderedParam2',
                    ],
                    'exception' => new \Exception('Request validator exception 1'),
                ],
            ],
            [
                [
                    'ordered' => [],
                    'named' => [],
                    'config' => [
                        'params' => [
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam1',
                            ],
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam2',
                            ],
                            [
                                'getType' => 'named',
                                'getName' => 'namedParam1',
                            ],
                        ],
                        'errorBuilder' => [],
                    ],
                ],
                [
                    'methods' => [
                        'getNamedParam1',
                        'getOrderedParam1',
                        'getOrderedParam2',
                    ],
                    'exception' => new \Exception('Request validator exception 1'),
                ],
            ],
        ];
    }

    /**
     * @param array $requestParams
     * @param array $validatorParams
     *
     * @expectedException \Exception
     * @expectedExceptionMessage Request validator exception 1
     *
     * @dataProvider             providerTestValidatorsFailure
     */
    public function testValidatorsFailure(array $requestParams, array $validatorParams)
    {
        $this->getRequestMock(
            $requestParams['config'],
            $requestParams['ordered'],
            $requestParams['named'],
            $validatorParams
        );
    }

    /**
     * @return array
     */
    public function providerTestValidatorsFailure()
    {
        return [
            [
                [
                    'ordered' => [1, 2],
                    'named' => ['namedParam1' => 10],
                    'config' => [
                        'params' => [
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam1',
                                'getValue' => 1,
                                'isRequired' => true,
                            ],
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam2',
                                'getValue' => 2,
                                'isRequired' => true,
                            ],
                            [
                                'getType' => 'named',
                                'getName' => 'namedParam1',
                                'getValue' => 10,
                                'isRequired' => true,
                            ],
                        ],
                        'errorBuilder' => [],
                    ],
                ],
                [
                    'methods' => [
                        'getNamedParam1',
                        'getOrderedParam1',
                        'getOrderedParam2',
                    ],
                    'exception' => new \Exception('Request validator exception 1'),
                ],
            ],
            [
                [
                    'ordered' => [1],
                    'named' => ['namedParam1' => 10],
                    'config' => [
                        'params' => [
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam1',
                                'getValue' => 1,
                                'isRequired' => true,
                            ],
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam2',
                            ],
                            [
                                'getType' => 'named',
                                'getName' => 'namedParam1',
                                'getValue' => 10,
                                'isRequired' => true,
                            ],
                        ],
                        'errorBuilder' => [],
                    ],
                ],
                [
                    'methods' => [
                        'getNamedParam1',
                        'getOrderedParam1',
                    ],
                    'exception' => new \Exception('Request validator exception 1'),
                ],
            ],
            [
                [
                    'ordered' => [1, 2],
                    'named' => [],
                    'config' => [
                        'params' => [
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam1',
                                'getValue' => 1,
                                'isRequired' => true,
                            ],
                            [
                                'getType' => 'ordered',
                                'getName' => 'orderedParam2',
                                'getValue' => 2,
                            ],
                            [
                                'getType' => 'named',
                                'getName' => 'namedParam1',
                            ],
                        ],
                        'errorBuilder' => [],
                    ],
                ],
                [
                    'methods' => [
                        'getNamedParam1',
                        'getOrderedParam2',
                    ],
                    'exception' => new \Exception('Request validator exception 1'),
                ],
            ],
        ];
    }

    /**
     * @param array $ordered
     * @param array $named
     * @param array $config
     * @param int $givenParametersCount
     *
     * @dataProvider providerTestGetGivenParametersCount
     */
    public function testGetGivenParametersCount($ordered, $named, $config, $givenParametersCount)
    {
        $request = $this->getRequestMock($config, $ordered, $named);

        $this->assertSame($givenParametersCount, $request->getGivenParametersCount());
    }

    /**
     * @return array
     */
    public function providerTestGetGivenParametersCount()
    {
        return [
            [
                [1, 2],
                [
                    'namedParam1' => 10,
                    'namedParam2' => 10,
                ],
                [
                    'params' => [
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam1',
                            'getValue' => 1,
                        ],
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam2',
                            'getValue' => 2,
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam1',
                            'getValue' => 10,
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam2',
                            'getValue' => 10,
                        ],
                    ],
                    'errorBuilder' => [],
                ],
                4,
            ],
            [
                [1, 2],
                ['namedParam1' => 10],
                [
                    'params' => [
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam1',
                            'getValue' => 1,
                        ],
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam2',
                            'getValue' => 2,
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam1',
                            'getValue' => 10,
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam2',
                        ],
                    ],
                    'errorBuilder' => [],
                ],
                3,
            ],
            [
                [1],
                ['namedParam1' => 10],
                [
                    'params' => [
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam1',
                            'getValue' => 1,
                        ],
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam2',
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam1',
                            'getValue' => 10,
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam2',
                        ],
                    ],
                    'errorBuilder' => [],
                ],
                2,
            ],
            [
                [],
                [],
                [
                    'params' => [
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam1',
                        ],
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam2',
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam1',
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam2',
                        ],
                    ],
                    'errorBuilder' => [],
                ],
                0,
            ],
        ];
    }

    /**
     * @param array $ordered
     * @param array $named
     * @param array $config
     *
     * @dataProvider providerParameters
     */
    public function testIsParameterExists(array $ordered, array $named, array $config)
    {
        $request = $this->getRequestMock($config, $ordered, $named);

        $this->assertTrue($request->isParameterExists('orderedParam1'));
        $this->assertTrue($request->isParameterExists('orderedParam2'));
        $this->assertTrue($request->isParameterExists('namedParam1'));
        $this->assertTrue($request->isParameterExists('namedParam2'));

        $this->assertFalse($request->isParameterExists('orderedParam3'));
        $this->assertFalse($request->isParameterExists('namedParam3'));
    }

    /**
     * @param array $ordered
     * @param array $named
     * @param array $config
     *
     * @dataProvider providerParameters
     */
    public function testIsParameterSet(array $ordered, array $named, array $config)
    {
        $request = $this->getRequestMock($config, $ordered, $named);

        $this->assertTrue($request->isParameterSet('orderedParam1'));
        if (count($ordered) == 2) {
            $this->assertTrue($request->isParameterSet('orderedParam2'));
        } else {
            $this->assertFalse($request->isParameterSet('orderedParam2'));
        }

        $this->assertTrue($request->isParameterSet('namedParam2'));
        if (count($named) == 2) {
            $this->assertTrue($request->isParameterSet('namedParam1'));
        } else {
            $this->assertFalse($request->isParameterSet('namedParam1'));
        }

        $this->assertFalse($request->isParameterSet('orderedParam3'));
        $this->assertFalse($request->isParameterSet('namedParam3'));
    }

    /**
     * @param array $ordered
     * @param array $named
     * @param array $config
     *
     * @dataProvider providerParameters
     */
    public function testGetNamesOfUnboundParameters(array $ordered, array $named, array $config)
    {
        $request = $this->getRequestMock($config, $ordered, $named);

        if (count($ordered) == 2) {
            $this->assertEquals([], $request->getNamesOfUnboundParameters());
        } else {
            $this->assertEquals(
                ['orderedParam2', 'namedParam1'],
                array_values($request->getNamesOfUnboundParameters())
            );
        }
    }

    /**
     * @param array $ordered
     * @param array $named
     * @param array $config
     *
     * @dataProvider providerParameters
     */
    public function testGetCounters(array $ordered, array $named, array $config)
    {
        $request = $this->getRequestMock($config, $ordered, $named);

        $this->assertEquals(count($ordered), $request->boundOrderedParametersCount());
        $this->assertEquals(count($named), $request->boundNamedParametersCount());
        $this->assertEquals(
            count(
                array_filter(
                    $config['params'],
                    function ($e) {
                        return $e['getType'] === 'ordered';
                    }
                )
            ),
            $request->expectedOrderedParametersCount()
        );
        $this->assertEquals(
            count(
                array_filter(
                    $config['params'],
                    function ($e) {
                        return $e['getType'] === 'named';
                    }
                )
            ),
            $request->expectedNamedParametersCount()
        );
    }

    /**
     * @dataProvider providerParameters
     */
    public function testSettersSuccess()
    {
        $request = new Request($this, ['params' => [], 'errorBuilder' => []]);
        $request->setOrderedParameter('orderedParam1');

        $initNumber = 77;
        $request->invokeConstructor([$initNumber]);

        $this->assertSame($initNumber, $request->getOrderedParam1());

        $mutateNumber = 88;
        $request->setOrderedParam1($mutateNumber);

        $this->assertSame($mutateNumber, $request->getOrderedParam1());
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage Wrong orderedParam1 [***] parameter, url structure
     */
    public function testSettersFailure()
    {
        $request = new Request(
            $this,
            [
                'params' => [],
                'errorBuilder' => [
                    'collectInfoForInvalidParameters' => [
                        'orderedParam1 [***]',
                        ' ',
                    ],
                ],
            ]
        );
        $validator = (new \Tests\Input\Request\Parameter\Mock\Validator())->setValidate(true);
        $request->setOrderedParameter('orderedParam1', $validator);
        $request->invokeConstructor([77]);
        $request->getOrderedParam1();

        $validator->setValidate(false);

        $request->setOrderedParam1('do exception');
        $request->getOrderedParam1();
    }

    public function testSetIncomingParametersSuccess()
    {
        $request = new Request($this, ['params' => [], 'errorBuilder' => []]);
        $request->setOrderedParameter('orderedParam1');
        $request->setOrderedParameter('orderedParam2');
        $request->setNamedParameter('namedParam1');
        $request->setNamedParameter('namedParam2');
        $incompleteOrdered = [77];
        $completeOrdered = [77, 88];
        $incompleteNamed = ['namedParam2' => 'second'];
        $completeNamed = ['namedParam1' => 'first', 'namedParam2' => 'second'];
        $request->invokeConstructor($incompleteOrdered, $incompleteNamed);

        $this->assertFalse($request->isParameterSet('orderedParam2'));
        $this->assertFalse($request->isParameterSet('namedParam1'));

        $this->assertTrue($request->isParameterSet('orderedParam1'));
        $this->assertTrue($request->isParameterSet('namedParam2'));

        $request->setIncomingOrderedParameters($completeOrdered);
        $request->setIncomingNamedParameters($completeNamed);

        $this->assertEquals($completeOrdered[0], $request->getOrderedParam1());
        $this->assertEquals($completeOrdered[1], $request->getOrderedParam2());
        $this->assertEquals($completeNamed['namedParam1'], $request->getNamedParam1());
        $this->assertEquals($completeNamed['namedParam2'], $request->getNamedParam2());
    }

    public function providerParameters()
    {
        return [
            [
                [1, 2],
                ['namedParam1' => '1', 'namedParam2' => '2'],
                [
                    'params' => [
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam1',
                            'getValue' => 1,
                        ],
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam2',
                            'getValue' => 2,
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam1',
                            'getValue' => '1',
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam2',
                            'getValue' => '2',
                        ],
                    ],
                    'errorBuilder' => [],
                ],
            ],
            [
                [1,],
                ['namedParam2' => '2'],
                [
                    'params' => [
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam1',
                            'getValue' => 1,
                        ],
                        [
                            'getType' => 'ordered',
                            'getName' => 'orderedParam2',
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam1',
                        ],
                        [
                            'getType' => 'named',
                            'getName' => 'namedParam2',
                            'getValue' => '2',
                        ],
                    ],
                    'errorBuilder' => [],
                ],
            ],
        ];
    }

    public function testUpdate()
    {
        $observer = $this->getMockForAbstractClass('Phalcon\Input\Request', [], '', false, true, true, ['update']);

        $expectedObject = \Phalcon\Input\Request\Parameter::builder('parameterName', 0, 'ordered', $observer);
        $expectedObject->attach($observer);


        $observer->expects($this->any())
            ->method('update')
            ->with($this->identicalTo($expectedObject));


        $expectedObject->getValue();
        $this->assertEquals(1, 1);
    }

    public function testDefaultValueLogic()
    {
        $request = new Request($this, ['params' => [], 'errorBuilder' => []]);
        $request->setOrderedParameter('orderedParam1', null, false, new \Tests\Input\Mock\ByDefault());

        $request->invokeConstructor();

        $this->assertNull($request->getOrderedParam1());

        $request->set('model', new \stdClass());
        $this->assertSame('calculated', $request->retrieveDefaultValue('orderedParam1'));
        $this->assertFalse($request->isParameterSet('orderedParam1'));
        $this->assertFalse($request->isParameterProvided('orderedParam1'));

        $this->assertSame('calculated', $request->getOrderedParam1());
        $this->assertTrue($request->isParameterSet('orderedParam1'));
        $this->assertFalse($request->isParameterProvided('orderedParam1'));
    }

    public function testIsRegisterEmpty()
    {
        $request = new Request($this, ['params' => [], 'errorBuilder' => []]);
        $request->invokeConstructor();

        $this->assertTrue($request->isRegisterEmpty());

        $request->set('something', false);
        $this->assertFalse($request->isRegisterEmpty());
    }
}
