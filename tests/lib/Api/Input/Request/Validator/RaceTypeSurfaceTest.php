<?php

namespace Tests;

use Tests\Stubs\Models\Selectors;
use \Api\Input\Request\Validator\RaceTypeSurface as Validator;

class RaceTypeSurfaceTest extends \PHPUnit\Framework\TestCase
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

        $validator = new Validator(new Selectors());
        $validator->setRequest($request);
        $validator->validate();
    }


    /**
     * @return array
     */
    public function dataProviderTestException()
    {
        return [
            [['getRaceType' => 'jumps', 'getSurface' => 'turf']],
            [['getRaceType' => 'jumps', 'getSurface' => 'aw']],
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

        $validator = new Validator(new Selectors());
        $validator->setRequest($request);
        $validator->validate();
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            [['getRaceType' => 'flat', 'getSurface' => null]],
            [['getRaceType' => 'jumps', 'getSurface' => null]],
            [['getRaceType' => 'flat', 'getSurface' => 'turf']],
            [['getRaceType' => 'flat', 'getSurface' => 'aw']],
        ];
    }
}
