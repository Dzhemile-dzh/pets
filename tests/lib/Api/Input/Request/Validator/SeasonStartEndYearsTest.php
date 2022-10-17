<?php

namespace Tests;

class SeasonStartEndYearsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param array $parameters
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getRequestMockObject(array $parameters)
    {
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

        $validator = new \Api\Input\Request\Validator\SeasonBeginEndYears();
        $validator->setRequest($request);
        $validator->validate();
    }


    /**
     * @return array
     */
    public function dataProviderTestException()
    {
        return [
            [['getSeasonYearBegin' => '2015', 'getSeasonYearEnd' => '2014']],
            [['getSeasonYearBegin' => date('Y') + 2, 'getSeasonYearEnd' => date('Y')]],
            [['getSeasonYearBegin' => 0, 'getSeasonYearEnd' => -1]],
            [['getSeasonYearBegin' => 1998, 'getSeasonYearEnd' => '1995']],
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

        $validator = new \Api\Input\Request\Validator\SeasonBeginEndYears();
        $validator->setRequest($request);
        $validator->validate();
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            [['getSeasonYearBegin' => date('Y'), 'getSeasonYearEnd' => date('Y')]],
            [['getSeasonYearBegin' => 1997, 'getSeasonYearEnd' => 1998]],
            [['getSeasonYearBegin' => 0, 'getSeasonYearEnd' => 1]],
            [['getSeasonYearBegin' => date('Y'), 'getSeasonYearEnd' => date('Y') + 1]],
            [['getSeasonYearBegin' => date('Y') - 1, 'getSeasonYearEnd' => date('Y')]],
        ];
    }
}
