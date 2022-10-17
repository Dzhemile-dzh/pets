<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 1/29/2016
 * Time: 5:14 PM
 */

namespace Tests;

use Tests\Stubs\Models\Selectors;
use Api\Input\Request\Validator\RaceDistances;

class RaceDistancesTest extends \PHPUnit\Framework\TestCase
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
            'isParameterExists' => null
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
                                ['raceType', array_key_exists('getRaceType', $parameters)],
                                ['distance', array_key_exists('getDistance', $parameters)],
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
     *
     * @dataProvider dataProviderTestValidateSuccess
     */
    public function testValidateSuccess($requestParams)
    {
        $request = $this->getRequestMockObject($requestParams);
        $raceType = $request->getRaceType();

        $selectors = new Stubs\Models\Selectors();
        $distance = new \Models\Bo\Selectors\Distance();
        $distance->setRaceType($raceType);
        $selectors->setDistance($distance);

        $validator = new RaceDistances($selectors, $raceType);
        $validator->setRequest($request);
        $this->assertNull($validator->validate());
    }

    /**
     * @param $requestParams
     *
     * @expectedException \Api\Exception\ValidationError
     * @dataProvider dataProviderTestValidateFailure
     */
    public function testValidateFailure($requestParams)
    {
        $request = $this->getRequestMockObject($requestParams);
        $raceType = $request->getRaceType();

        $selectors = new Stubs\Models\Selectors();
        $distance = new \Models\Bo\Selectors\Distance();
        $distance->setRaceType($raceType);
        $selectors->setDistance($distance);

        $validator = new RaceDistances($selectors, $raceType);
        $validator->setRequest($request);
        $this->assertNull($validator->validate());
    }

    /**
     * @return array
     */
    public function dataProviderTestValidateSuccess()
    {
        return [
            [
                ['getDistance' => '0-1210', 'getRaceType' => 'flat', 'getCode'=> null]
            ],
            [
                ['getDistance' => '2971-3410', 'getRaceType' => 'flat', 'getCode'=> null]
            ],
            [
                ['getDistance' => '3411-null', 'getRaceType' => 'flat', 'getCode'=> null]
            ],
            [
                ['getDistance' => '0-3850', 'getRaceType' => 'jumps', 'getCode'=> null]
            ],
            [
                ['getDistance' => '4951-5830', 'getRaceType' => 'jumps', 'getCode'=> null]
            ],
            [
                ['getDistance' => '5831-null', 'getRaceType' => 'jumps', 'getCode'=> null]
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
                ['getDistance' => '0-0', 'getRaceType' => 'flat', 'getCode'=> null]
            ],
            [
                ['getDistance' => '2971-3410', 'getRaceType' => 'jumps', 'getCode'=> null]
            ],
            [
                ['getDistance' => '3411-null', 'getRaceType' => 'jumps', 'getCode'=> null]
            ],
            [
                ['getDistance' => '0-3850', 'getRaceType' => 'flat', 'getCode'=> null]
            ],
            [
                ['getDistance' => '4951-5830', 'getRaceType' => 'flat', 'getCode'=> null]
            ],
            [
                ['getDistance' => 'null-null', 'getRaceType' => 'flat', 'getCode'=> null]
            ],
            [
                ['getDistance' => '', 'getRaceType' => 'flat', 'getCode'=> null]
            ]
        ];
    }

    /**
     * @expectedException \Api\Exception\ValidationError
     * @expectedExceptionMessage Wrong distance parameter range
     *
     * @dataProvider dataProviderTestValidateFailure
     *
     * @param $requestParams
     *
     * @throws \Api\Exception\ValidationError
     */
    public function testDefaultException($requestParams)
    {
        $request = $this->getRequestMockObject($requestParams);
        $raceType = $request->getRaceType();
        $code = $request->getCode();

        $selectors = new Stubs\Models\Selectors();
        $distance = new \Models\Bo\Selectors\Distance();
        $distance->setRaceType($raceType);
        $selectors->setDistance($distance);

        $validator = new RaceDistances($selectors, $raceType, $code);
        $validator->setRequest($request);
        $this->assertNull($validator->validate());
    }

    /**
     * @expectedException \Api\Exception\ValidationError
     * @expectedExceptionMessage Wrong distance parameter range for a given raceType
     *
     * @dataProvider dataProviderTestException
     *
     * @param $requestParams
     *
     * @throws \Api\Exception\ValidationError
     */
    public function testException($requestParams)
    {
        $request = $this->getRequestMockObject($requestParams);
        $raceType = $request->getRaceType();
        $code = $request->getCode();

        $selectors = new Stubs\Models\Selectors();
        $distance = new \Models\Bo\Selectors\Distance();
        $distance->setRaceType($raceType);
        $selectors->setDistance($distance);

        $validator = new RaceDistances($selectors, $raceType, $code);
        $validator->setRequest($request);
        $this->assertNull($validator->validate());
    }
    /**
     * @return array
     */
    public function dataProviderTestException()
    {
        return [
            [
                ['getDistance' => '0-0', 'getRaceType' => 'flat', 'getCode'=> 1013]
            ],
            [
                ['getDistance' => '3411-null', 'getRaceType' => 'legacy_alt', 'getCode' => 1013]
            ],

        ];
    }
}
