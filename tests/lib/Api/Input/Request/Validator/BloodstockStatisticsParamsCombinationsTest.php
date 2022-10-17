<?php

namespace Tests;

use Tests\Stubs\Models\Selectors;
use Api\Input\Request\Validator\BloodstockStatisticsParamsCombinations;

class BloodstockStatisticsParamsCombinationsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param array $parameters
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getRequestMockObject(array $parameters)
    {
        $parameters += [
            'getGivenParametersCount' => count($parameters),
            'isParameterExists' => null,
            'isParameterSet' => null
        ];
        $methods = array_keys($parameters);
        $stub = $this->getMockForAbstractClass('Phalcon\Input\Request', [], '', false, true, true, $methods);

        // Configure the stub.
        foreach ($parameters as $methodName => $methodResult) {
            if ($methodName == 'isParameterExists') {
                $stub->expects($this->any())->method($methodName)
                    ->will(
                        $this->returnValueMap(
                            [
                                ['jumpsCode', array_key_exists('getJumpsCode', $parameters)]
                            ]
                        )
                    );
            } else if ($methodName == 'isParameterSet') {
                $stub->expects($this->any())->method($methodName)
                    ->will(
                        $this->returnValueMap(
                            [
                                ['jumpsCode', !empty($parameters['getJumpsCode'])]
                            ]
                        )
                    );
            } else {
                $stub->expects($this->any())->method($methodName)
                    ->willReturn($methodResult);
            }
        }

        return $stub;
    }

    /**
     * @param $requestParams
     * @param $entity
     *
     * @dataProvider dataProviderTestValidateSuccess
     */
    public function testValidateSuccess($requestParams, $entity)
    {
        $request = $this->getRequestMockObject($requestParams);

        $validator = new BloodstockStatisticsParamsCombinations(new Selectors(), $entity);
        $validator->setRequest($request);
        $this->assertNull($validator->validate());
    }

    /**
     * @param $requestParams
     * @param $entity
     *
     * @expectedException \Api\Exception\ValidationError
     * @dataProvider dataProviderTestValidateFailure
     */
    public function testValidateFailure($requestParams, $entity)
    {
        $request = $this->getRequestMockObject($requestParams);

        $validator = new BloodstockStatisticsParamsCombinations(new Selectors(), $entity);
        $validator->setRequest($request);
        $validator->validate();
    }

    /**
     * @return array
     */
    public function dataProviderTestValidateSuccess()
    {
        return [
            [
                [
                    'getRaceType' => 'jumps',
                    'getSurface' => null,
                    'getJumpsCode' => 'hurdle'
                ],
                'bloodstock_horse'
            ],
            [
                [
                    'getRaceType' => 'jumps',
                    'getSurface' => null,
                    'getJumpsCode' => 'chase'
                ],
                'bloodstock_horse'
            ],
            [
                [
                    'getRaceType' => 'jumps',
                    'getSurface' => null,
                    'getJumpsCode' => 'nhf'
                ],
                'bloodstock_horse'
            ],
            [
                [
                    'getRaceType' => 'flat',
                    'getSurface' => 'turf',
                    'getJumpsCode' => null
                ],
                'bloodstock_horse'
            ],
            [
                [
                    'getRaceType' => 'flat',
                    'getSurface' => 'aw',
                    'getJumpsCode' => null
                ],
                'bloodstock_horse'
            ],
            [
                [
                    'getRaceType' => 'jumps',
                    'getSurface' => null,
                    'getJumpsCode' => null
                ],
                'bloodstock_horse'
            ],
            [
                [
                    'getRaceType' => 'flat',
                    'getSurface' => null,
                    'getJumpsCode' => null
                ],
                'bloodstock_horse'
            ]
        ];
    }

    /**
     * @return array
     */
    public function dataProviderTestValidateFailure()
    {
        return [
            [
                [
                    'getRaceType' => 'jumps',
                    'getSurface' => 'turf',
                    'getJumpsCode' => 'hurdle'
                ],
                'bloodstock_horse'
            ],
            [
                [
                    'getRaceType' => 'flat',
                    'getSurface' => 'all-weather',
                    'getJumpsCode' => 'hurdle'
                ],
                'bloodstock_horse'
            ],
            [
                [
                    'getRaceType' => 'flat',
                    'getSurface' => 'turf',
                    'getJumpsCode' => 'hurdle'
                ],
                'bloodstock_horse'
            ],
            [
                [
                    'getRaceType' => 'jumps',
                    'getSurface' => 'all-weather',
                    'getJumpsCode' => 'hurdle'
                ],
                'bloodstock_horse'
            ],
            [
                [
                    'getRaceType' => 'jumps',
                    'getSurface' => 'turf',
                    'getJumpsCode' => 'hurdle'
                ],
                'bloodstock_horse'
            ],
        ];
    }
}
