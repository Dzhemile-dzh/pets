<?php

namespace Tests;

use \Api\Input\Request\Validator\SearchDateRange as Validator;

class SearchDateRangeTest extends \PHPUnit\Framework\TestCase
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
     * @param array $requestParams
     *
     * @throws \Api\Exception\ValidationError
     *
     * @expectedException \Api\Exception\ValidationError
     * @dataProvider dataProviderTestException
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
            [['getRaceTitle' => null, 'getCourseId' => null, 'getStartDate' => '2014-01-01', 'getEndDate' => '2014-01-09']],
            [['getRaceTitle' => null, 'getCourseId' => 184, 'getStartDate' => '2013-01-01', 'getEndDate' => '2015-01-01']],
            [['getRaceTitle' => null, 'getCourseId' => null, 'getStartDate' => '2014-01-01', 'getEndDate' => '2015-01-01']],
        ];
    }

    /**
     * @param array $requestParams
     *
     * @throws \Api\Exception\ValidationError
     *
     * @doesNotPerformAssertions
     *
     * @dataProvider dataProviderTestSuccess
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
            [['getRaceTitle' => null, 'getCourseId' => null, 'getStartDate' => '2015-01-01', 'getEndDate' => '2015-01-08']],
            [['getRaceTitle' => null, 'getCourseId' => 184, 'getStartDate' => '2014-01-01', 'getEndDate' => '2015-01-01']],
            [['getRaceTitle' => 'mmm', 'getCourseId' => null, 'getStartDate' => '1988-01-01', 'getEndDate' => '2015-01-01']],
            [['getRaceTitle' => 'mmm', 'getCourseId' => 898, 'getStartDate' => '1988-01-01', 'getEndDate' => '2015-01-01']],
        ];
    }
}
