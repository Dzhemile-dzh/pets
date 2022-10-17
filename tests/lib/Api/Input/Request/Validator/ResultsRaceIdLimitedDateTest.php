<?php

namespace Tests\Api\Input\Request\Validator;

/**
 * Class ResultsRaceIdLimitedDateTest
 *
 * @package Tests\Api\Input\Request\ResultsRaceIdLimitedDate
 */
class ResultsRaceIdLimitedDateTest extends \PHPUnit\Framework\TestCase
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
     * @return \Tests\Stubs\Lib\Api\Input\Request\Validator\ResultsRaceIdLimitedDate
     */

    private function getValidator()
    {
        return new \Tests\Stubs\Lib\Api\Input\Request\Validator\ResultsRaceIdLimitedDate;
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

        $validator = $this->getValidator();
        $validator->setRequest($request);
        $validator->validate();
    }


    /**
     * @return array
     */
    public function dataProviderTestException()
    {
        return [
            [['getRaceId' => 1111]],
            [['getRaceId' => 2222]],
            [['getRaceId' => 3333]],
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

        $validator = $this->getValidator();
        $validator->setRequest($request);
        $validator->validate();
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            [['getRaceId' => 5555]],
            [['getRaceId' => 6666]],
            [['getRaceId' => 7777]],
        ];
    }
}
