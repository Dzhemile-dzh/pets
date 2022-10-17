<?php

namespace Tests;

use \Api\Input\Request\Validator\StartEndYear as Validator;

class StartEndYearTest extends \PHPUnit\Framework\TestCase
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
    public function testException(array $requestParams)
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
            [['getStartYear' => 2005, 'getEndYear' => 2000]]
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
    public function testSuccess(array $requestParams)
    {
        $request = $this->getRequestMockObject($requestParams);
        $validator = new Validator();
        $validator->setRequest($request);
        $validator->validate();
    }

    public function dataProviderTestSuccess()
    {
        return [
            [['getStartYear' => 2000, 'getEndYear' => 2005]],
            [['getStartYear' => 2010, 'getEndYear' => 2010]],
        ];
    }
}
