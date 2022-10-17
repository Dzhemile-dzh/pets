<?php

namespace Tests;

class BloodstockStatisticsRequiredTest extends \PHPUnit\Framework\TestCase
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

        $validator = new \Api\Input\Request\Validator\BloodstockStatisticsRequired();
        $validator->setRequest($request);
        $validator->validate();
    }


    /**
     * @return array
     */
    public function dataProviderTestException()
    {
        return [
            [['getSeasonYearBegin' => '2015', 'getSeasonYearEnd' => null, 'getRaceType' => null]],
            [['getSeasonYearBegin' => '2015', 'getSeasonYearEnd' => '2016', 'getRaceType' => null]],
            [['getSeasonYearBegin' => null, 'getSeasonYearEnd' => '2016', 'getRaceType' => 'flat']],
            [['getSeasonYearBegin' => null, 'getSeasonYearEnd' => null, 'getRaceType' => 'flat']],
            [['getSeasonYearBegin' => null, 'getSeasonYearEnd' => null, 'getRaceType' => null]]
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

        $validator = new \Api\Input\Request\Validator\BloodstockStatisticsRequired();
        $validator->setRequest($request);
        $validator->validate();
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            [['getSeasonYearBegin' => '2015', 'getSeasonYearEnd' => '2016', 'getRaceType' => 'flat']],
            [['getSeasonYearBegin' => '2014', 'getSeasonYearEnd' => '2015', 'getRaceType' => 'jumps']],
            [['getSeasonYearBegin' => true, 'getSeasonYearEnd' => true, 'getRaceType' => true]]
        ];
    }
}
