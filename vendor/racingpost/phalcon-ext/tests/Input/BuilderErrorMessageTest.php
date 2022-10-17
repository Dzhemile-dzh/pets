<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/28/2016
 * Time: 2:08 PM
 */

namespace Tests\Input;

use Tests\Input\Mock\BuilderErrorMessage;

class BuilderErrorMessageTest extends \Tests\CommonTestCase
{
    /*
     * Testing strategy
     *
     * Partition the inputs as follows:
     * count(absentParameters) == 0 && count(invalidParameters) == 0
     * count(absentParameters) > 0 && count(invalidParameters) == 0 ordered parameters
     * count(absentParameters) > 0 && count(invalidParameters) == 0 named parameters
     * count(absentParameters) > 0 && count(invalidParameters) == 0 named & ordered parameters
     * count(absentParameters) == 0 && count(invalidParameters) > 0 ordered parameters
     * count(absentParameters) == 0 && count(invalidParameters) > 0 named parameters
     * count(absentParameters) == 0 && count(invalidParameters) > 0 named & ordered parameters
     * count(absentParameters) > 0 && count(invalidParameters) > 0 ordered parameters
     * count(absentParameters) > 0 && count(invalidParameters) > 0 named parameters
     * count(absentParameters) > 0 && count(invalidParameters) > 0 named & ordered parameters
     * count(absentParameters) > 0 && count(invalidParameters) > 0 named & ordered parameters AND non empty router params
     */

    /**
     * @param $params
     *
     * @return BuilderErrorMessage
     */
    private function getMockBuilderErrorMessage($params)
    {
        $builder = new \Tests\Input\Mock\BuilderErrorMessage($this, $params['request']);
        foreach ($params['invalid'] as $param) {
            $builder->pushInvalidParameter($this->getMockParameter($param));
        }
        foreach ($params['absent'] as $param) {
            $builder->pushAbsentParameter($this->getMockParameter($param));
        }
        $router = new \Tests\Input\Mock\Router();
        foreach ($params['router'] as $method => $value) {
            $router->{$method}($value);
        }
        $builder->setRouter($router);
        return $builder;
    }

    /**
     * @param $param
     *
     * @return \Phalcon\Input\Request\Parameter
     */
    private function getMockParameter($param)
    {
        $mockParameter = $this->getMockBuilder('\Phalcon\Input\Request\Parameter')
            ->setMethods(['getName', 'getValidator', 'getValidatorTitle'])
            ->getMock();
        $mockParameter->expects($this->any())->method('getName')->willReturn($param['name']);
        $mockParameter->expects($this->any())->method('getValidator')->will($this->returnSelf());
        $mockParameter->expects($this->any())->method('getValidatorTitle')->willReturn($param['title']);
        return $mockParameter;
    }
    /**
     * @param $params
     *
     * @return BuilderErrorMessage
     */
    private function getMockBuilderErrorMessageWithNullValidator($params)
    {
        $builder = new \Tests\Input\Mock\BuilderErrorMessage($this, $params['request']);
        foreach ($params['invalid'] as $param) {
            $builder->pushInvalidParameter($this->getMockParameterWithNullValidator($param));
        }
        foreach ($params['absent'] as $param) {
            $builder->pushAbsentParameter($this->getMockParameterWithNullValidator($param));
        }
        $router = new \Tests\Input\Mock\Router();
        foreach ($params['router'] as $method => $value) {
            $router->{$method}($value);
        }
        $builder->setRouter($router);
        return $builder;
    }

    /**
     * @param $param
     *
     * @return \Phalcon\Input\Request\Parameter
     */
    private function getMockParameterWithNullValidator($param)
    {
        $mockParameter = $this->getMockBuilder('\Phalcon\Input\Request\Parameter')
            ->setMethods(['getName', 'getValidator'])
            ->getMock();
        $mockParameter->expects($this->any())->method('getName')->willReturn($param['name']);
        $mockParameter->expects($this->any())->method('getValidator')->willReturn(null);

        return $mockParameter;
    }

    /**
     * @param array $params
     *
     * @dataProvider providerTestEmptyParameters
     */
    public function testEmptyParameters($params)
    {
        $builder = $this->getMockBuilderErrorMessage($params);

        $this->assertEmpty($builder->collectInfoForInvalidParameters());
        $this->assertEmpty($builder->collectInfoForAbsentParameters());
    }

    public function providerTestEmptyParameters()
    {
        return [
            [
                [
                    'request' => [
                        'named' => [],
                        'ordered' => [],
                    ],
                    'invalid' => [],
                    'absent' => [],
                    'router' => [],
                ]
            ],
        ];
    }

    /**
     * @param $params
     *
     * @dataProvider providerTestAbsentOrderedParameters
     */
    public function testAbsentOrderedParameters($params)
    {
        $builder = $this->getMockBuilderErrorMessage($params);

        $this->assertEquals([], $builder->collectInfoForInvalidParameters());
        $this->assertEquals(
            [
                'ending' => '',
                'message' => 'first [something goes wrong]',
                'pretext' => 'is',
                'url' => '/root/show-test/{first}'
            ],
            $builder->collectInfoForAbsentParameters()
        );
    }

    public function providerTestAbsentOrderedParameters()
    {
        return [
            [
                [
                    'request' => [
                        'named' => [],
                        'ordered' => [
                            'first' => null
                        ],
                    ],
                    'invalid' => [],
                    'absent' => [
                        [
                            'name' => 'first',
                            'title' => 'something goes wrong',
                        ]
                    ],
                    'router' => [
                        'setParams' => [],
                        'setActionName' => 'show-test',
                        'setPattern' => '/root/:action/:params'
                    ]
                ]
            ],
        ];
    }

    /**
     * @param $params
     *
     * @dataProvider providerTestAbsentNamedParameters
     */
    public function testAbsentNamedParameters($params)
    {
        $builder = $this->getMockBuilderErrorMessage($params);

        $this->assertEquals([], $builder->collectInfoForInvalidParameters());
        $this->assertEquals(
            [
                'ending' => 's',
                'message' => 'first [#1 mistake] and second [#2 mistake]',
                'pretext' => 'are',
                'url' => '/root/show-test?{first}&{second}'
            ],
            $builder->collectInfoForAbsentParameters()
        );
    }

    public function providerTestAbsentNamedParameters()
    {
        return [
            [
                [
                    'request' => [
                        'named' => [
                            'first' => null,
                            'second' => null,
                        ],
                        'ordered' => [],
                    ],
                    'invalid' => [],
                    'absent' => [
                        [
                            'name' => 'first',
                            'title' => '#1 mistake',
                        ],
                        [
                            'name' => 'second',
                            'title' => '#2 mistake',
                        ],
                    ],
                    'router' => [
                        'setParams' => [],
                        'setActionName' => 'show-test',
                        'setPattern' => '/root/:action/:params'
                    ]
                ]
            ],
        ];
    }

    /**
     * @param $params
     *
     * @dataProvider providerTestAbsentNamedParametersWithNullValidator
     */
    public function testAbsentNamedParametersWithNullValidator($params)
    {
        $builder = $this->getMockBuilderErrorMessageWithNullValidator($params);

        $this->assertEquals([], $builder->collectInfoForInvalidParameters());
        $this->assertEquals(
            [
                'ending' => 's',
                'message' => 'first and second',
                'pretext' => 'are',
                'url' => '/root/show-test?{first}&{second}'
            ],
            $builder->collectInfoForAbsentParameters()
        );
    }

    /**
     * @return array
     */
    public function providerTestAbsentNamedParametersWithNullValidator()
    {
        return [
            [
                [
                    'request' => [
                        'named' => [
                            'first' => null,
                            'second' => null,
                        ],
                        'ordered' => [],
                    ],
                    'invalid' => [],
                    'absent' => [
                        [
                            'name' => 'first',
                        ],
                        [
                            'name' => 'second',
                        ],
                    ],
                    'router' => [
                        'setParams' => [],
                        'setActionName' => 'show-test',
                        'setPattern' => '/root/:action/:params'
                    ]
                ]
            ],
        ];
    }

    /**
     * @param $params
     *
     * @dataProvider providerTestAbsentNamedAndOrderedParameters
     */
    public function testAbsentNamedAndOrderedParameters($params)
    {
        $builder = $this->getMockBuilderErrorMessage($params);

        $this->assertEquals([], $builder->collectInfoForInvalidParameters());
        $this->assertEquals(
            [
                'ending' => 's',
                'message' => 'first [#1 mistake] and second [#2 mistake]',
                'pretext' => 'are',
                'url' => '/root/show-test/{second}?{first}'
            ],
            $builder->collectInfoForAbsentParameters()
        );
    }

    public function providerTestAbsentNamedAndOrderedParameters()
    {
        return [
            [
                [
                    'request' => [
                        'named' => [
                            'first' => null,
                        ],
                        'ordered' => [
                            'second' => null,
                        ],
                    ],
                    'invalid' => [],
                    'absent' => [
                        [
                            'name' => 'first',
                            'title' => '#1 mistake',
                        ],
                        [
                            'name' => 'second',
                            'title' => '#2 mistake',
                        ],
                    ],
                    'router' => [
                        'setParams' => [],
                        'setActionName' => 'show-test',
                        'setPattern' => '/root/:action/:params'
                    ]
                ]
            ],
        ];
    }

    /**
     * @param $params
     *
     * @dataProvider providerTestInvalidOrderedParameters
     */
    public function testInvalidOrderedParameters($params)
    {
        $builder = $this->getMockBuilderErrorMessage($params);

        $this->assertEquals(
            [
                'message' => 'first [something goes wrong]',
                'url' => '/root/show-test/{first}/{second}'
            ],
            $builder->collectInfoForInvalidParameters()
        );
        $this->assertEquals(
            [],
            $builder->collectInfoForAbsentParameters()
        );
    }

    public function providerTestInvalidOrderedParameters()
    {
        return [
            [
                [
                    'request' => [
                        'named' => [],
                        'ordered' => [
                            'first' => null,
                            'second' => null
                        ],
                    ],
                    'invalid' => [
                        [
                            'name' => 'first',
                            'title' => 'something goes wrong',
                        ]
                    ],
                    'absent' => [],
                    'router' => [
                        'setParams' => [],
                        'setActionName' => 'show-test',
                        'setPattern' => '/root/:action/:params'
                    ]
                ]
            ],
        ];
    }

    /**
     * @param $params
     *
     * @dataProvider providerTestInvalidNamedParameters
     */
    public function testInvalidNamedParameters($params)
    {
        $builder = $this->getMockBuilderErrorMessage($params);

        $this->assertEquals(
            [
                'message' => 'first [#1 mistake] and second [#2 mistake]',
                'url' => '/root/show-test?{first}&{second}'
            ],
            $builder->collectInfoForInvalidParameters()
        );
        $this->assertEquals([], $builder->collectInfoForAbsentParameters());
    }

    public function providerTestInvalidNamedParameters()
    {
        return [
            [
                [
                    'request' => [
                        'named' => [
                            'first' => null,
                            'second' => null,
                        ],
                        'ordered' => [],
                    ],
                    'invalid' => [
                        [
                            'name' => 'first',
                            'title' => '#1 mistake',
                        ],
                        [
                            'name' => 'second',
                            'title' => '#2 mistake',
                        ],
                    ],
                    'absent' => [],
                    'router' => [
                        'setParams' => [],
                        'setActionName' => 'show-test',
                        'setPattern' => '/root/:action/:params'
                    ]
                ]
            ],
        ];
    }

    /**
     * @param $params
     *
     * @dataProvider providerTestInvalidNamedAndOrderedParameters
     */
    public function testInvalidNamedAndOrderedParameters($params)
    {
        $builder = $this->getMockBuilderErrorMessage($params);

        $this->assertEquals(
            [
                'message' => 'first [#1 mistake] and second [#2 mistake]',
                'url' => '/root/show-test/{second}?{first}'
            ],
            $builder->collectInfoForInvalidParameters()
        );
        $this->assertEquals([], $builder->collectInfoForAbsentParameters());
    }

    public function providerTestInvalidNamedAndOrderedParameters()
    {
        return [
            [
                [
                    'request' => [
                        'named' => [
                            'first' => null,
                        ],
                        'ordered' => [
                            'second' => null,
                        ],
                    ],
                    'invalid' => [
                        [
                            'name' => 'first',
                            'title' => '#1 mistake',
                        ],
                        [
                            'name' => 'second',
                            'title' => '#2 mistake',
                        ],
                    ],
                    'absent' => [],
                    'router' => [
                        'setParams' => [],
                        'setActionName' => 'show-test',
                        'setPattern' => '/root/:action/:params'
                    ]
                ]
            ],
        ];
    }

    /**
     * @param $params
     *
     * @dataProvider providerTestInvalidAndAbsentOrderedParameters
     */
    public function testInvalidAndAbsentOrderedParameters($params)
    {
        $builder = $this->getMockBuilderErrorMessage($params);

        $this->assertEquals(
            [
                'message' => 'first [#1 invalid]',
                'url' => '/root/show-test/{first}/{second}'
            ],
            $builder->collectInfoForInvalidParameters()
        );
        $this->assertEquals(
            [
                'ending' => '',
                'message' => 'second [#2 wrong]',
                'pretext' => 'is',
                'url' => '/root/show-test/{first}/{second}'
            ],
            $builder->collectInfoForAbsentParameters()
        );
    }

    public function providerTestInvalidAndAbsentOrderedParameters()
    {
        return [
            [
                [
                    'request' => [
                        'named' => [],
                        'ordered' => [
                            'first' => null,
                            'second' => null
                        ],
                    ],
                    'invalid' => [
                        [
                            'name' => 'first',
                            'title' => '#1 invalid',
                        ]
                    ],
                    'absent' => [
                        [
                            'name' => 'second',
                            'title' => '#2 wrong',
                        ]
                    ],
                    'router' => [
                        'setParams' => [],
                        'setActionName' => 'show-test',
                        'setPattern' => '/root/:action/:params'
                    ]
                ]
            ],
        ];
    }

    /**
     * @param $params
     *
     * @dataProvider providerTestInvalidAndAbsentNamedParameters
     */
    public function testInvalidAndAbsentNamedParameters($params)
    {
        $builder = $this->getMockBuilderErrorMessage($params);

        $this->assertEquals(
            [
                'message' => 'first [#1 mistake]',
                'url' => '/root/show-test?{first}&{second}'
            ],
            $builder->collectInfoForInvalidParameters()
        );
        $this->assertEquals(
            [
                'ending' => '',
                'message' => 'second [#2 mistake]',
                'pretext' => 'is',
                'url' => '/root/show-test?{first}&{second}'
            ],
            $builder->collectInfoForAbsentParameters()
        );
    }

    public function providerTestInvalidAndAbsentNamedParameters()
    {
        return [
            [
                [
                    'request' => [
                        'named' => [
                            'first' => null,
                            'second' => null,
                        ],
                        'ordered' => [],
                    ],
                    'invalid' => [
                        [
                            'name' => 'first',
                            'title' => '#1 mistake',
                        ],
                    ],
                    'absent' => [
                        [
                            'name' => 'second',
                            'title' => '#2 mistake',
                        ],
                    ],
                    'router' => [
                        'setParams' => [],
                        'setActionName' => 'show-test',
                        'setPattern' => '/root/:action/:params'
                    ]
                ]
            ],
        ];
    }

    /**
     * @param $params
     *
     * @dataProvider providerTestInvalidAndAbsentNamedAndOrderedParameters
     */
    public function testInvalidAndAbsentNamedAndOrderedParameters($params)
    {
        $builder = $this->getMockBuilderErrorMessage($params);

        $this->assertEquals(
            [
                'message' => 'first [#1 mistake]',
                'url' => '/root/show-test/{second}?{first}'
            ],
            $builder->collectInfoForInvalidParameters()
        );
        $this->assertEquals(
            [
                'ending' => '',
                'message' => 'second [#2 mistake]',
                'pretext' => 'is',
                'url' => '/root/show-test/{second}?{first}'
            ],
            $builder->collectInfoForAbsentParameters()
        );
    }

    public function providerTestInvalidAndAbsentNamedAndOrderedParameters()
    {
        return [
            [
                [
                    'request' => [
                        'named' => [
                            'first' => null,
                        ],
                        'ordered' => [
                            'second' => null,
                        ],
                    ],
                    'invalid' => [
                        [
                            'name' => 'first',
                            'title' => '#1 mistake',
                        ],
                    ],
                    'absent' => [
                        [
                            'name' => 'second',
                            'title' => '#2 mistake',
                        ],
                    ],
                    'router' => [
                        'setParams' => [],
                        'setActionName' => 'show-test',
                        'setPattern' => '/root/:action/:params'
                    ]
                ]
            ],
        ];
    }

    /**
     * @param $params
     *
     * @dataProvider providerTestInvalidAndAbsentNamedAndOrderedParametersAndRouterParams
     */
    public function testInvalidAndAbsentNamedAndOrderedParametersAndRouterParams($params)
    {
        $builder = $this->getMockBuilderErrorMessage($params);

        $this->assertEquals(
            [
                'message' => 'first [#1 mistake]',
                'url' => '/root/{productId}/path1/show-test/{second}?{first}'
            ],
            $builder->collectInfoForInvalidParameters()
        );
        $this->assertEquals(
            [
                'ending' => '',
                'message' => 'second [#2 mistake]',
                'pretext' => 'is',
                'url' => '/root/{productId}/path1/show-test/{second}?{first}'
            ],
            $builder->collectInfoForAbsentParameters()
        );
    }

    public function providerTestInvalidAndAbsentNamedAndOrderedParametersAndRouterParams()
    {
        return [
            [
                [
                    'request' => [
                        'named' => [
                            'first' => null,
                            'productId' => null,
                        ],
                        'ordered' => [
                            'second' => null,
                        ],
                    ],
                    'invalid' => [
                        [
                            'name' => 'first',
                            'title' => '#1 mistake',
                        ],
                    ],
                    'absent' => [
                        [
                            'name' => 'second',
                            'title' => '#2 mistake',
                        ],
                    ],
                    'router' => [
                        'setParams' => [
                            'productId' => null,
                        ],
                        'setActionName' => 'show-test',
                        'setPattern' => '/root/{productId}/path1/:action/:params'
                    ]
                ]
            ],
        ];
    }
}
