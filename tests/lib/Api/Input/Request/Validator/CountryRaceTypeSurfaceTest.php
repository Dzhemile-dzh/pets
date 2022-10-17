<?php

namespace Tests;

use Tests\Stubs\Models\Selectors;
use \Api\Input\Request\Validator\CountryRaceTypeSurface as Validator;

class CountryRaceTypeSurfaceTest extends \PHPUnit\Framework\TestCase
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
            [['getCountryCode' => 'GB', 'getRaceType' => 'jumps', 'getSurface' => 'turf']],
            [['getCountryCode' => 'IRE', 'getRaceType' => 'jumps', 'getSurface' => 'aw']],
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
            [['getCountryCode' => 'IRE', 'getRaceType' => 'flat', 'getSurface' => 'aw']],
            [['getCountryCode' => 'IRE', 'getRaceType' => 'flat', 'getSurface' => 'turf']],
            [['getCountryCode' => 'IRE', 'getRaceType' => 'jumps', 'getSurface' => null]],
            [['getCountryCode' => 'GB', 'getRaceType' => 'jumps', 'getSurface' => null]],
            [['getCountryCode' => 'GB', 'getRaceType' => 'flat', 'getSurface' => 'turf']],
            [['getCountryCode' => 'GB', 'getRaceType' => 'flat', 'getSurface' => 'aw']],
        ];
    }
}
