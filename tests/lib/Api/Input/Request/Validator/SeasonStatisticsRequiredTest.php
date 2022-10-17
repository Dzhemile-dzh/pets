<?php

namespace Tests;

use \Api\Input\Request\Validator\SeasonalStatisticsRequired as Validator;

class SeasonStatisticsRequiredTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param array $parameters
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getRequestMockObject(array $parameters)
    {
        $parameters += ['getGivenParametersCount' => count($parameters)];

        $methods = array_keys($parameters);
        $stub = $this->getMockForAbstractClass('Phalcon\Input\Request', [], '', false, true, true, $methods);

        // Configure the stub.
        foreach ($parameters as $methodName => $methodResult) {
            $stub->expects($this->any())->method($methodName)->willReturn($methodResult);
        }

        return $stub;
    }

    /**
     * @expectedException \Api\Exception\ValidationError
     *
     * @dataProvider dataProviderTestException
     *
     * @param array $requestParams
     *
     * @throws \Api\Exception\ValidationError
     */
    public function testException($requestParams)
    {
        $request = $this->getRequestMockObject($requestParams);

        $validator = new Validator();
        $validator->setRequest($request);
        $validator->validate();
    }


    /**
     * @return array
     */
    public function dataProviderTestException()
    {
        return [
            [['getSeasonYearBegin' => '2015', 'getRaceType' => null, 'getCountryCodes' => null]],
            [['getSeasonYearBegin' => '2015', 'getRaceType' => null, 'getCountryCodes' => null]],
            [['getSeasonYearBegin' => '2015', 'getRaceType' => null, 'getCountryCodes' => ['GB']]],
            [['getSeasonYearBegin' => null, 'getRaceType' => null, 'getCountryCodes' => null]]
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param array $requestParams
     *
     * @doesNotPerformAssertions
     *
     * @throws \Api\Exception\ValidationError
     */
    public function testSuccess($requestParams)
    {
        $request = $this->getRequestMockObject($requestParams);

        $validator = new Validator();
        $validator->setRequest($request);
        $validator->validate();
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            [['getSeasonYearBegin' => '2015', 'getRaceType' => 'flat', 'getCountryCodes' => ['IRE']]],
            [['getSeasonYearBegin' => '2015', 'getRaceType' => 'flat', 'getCountryCodes' => ['GB']]],
            [['getSeasonYearBegin' => true, 'getRaceType' => true, 'getCountryCodes' => true]]
        ];
    }
}
