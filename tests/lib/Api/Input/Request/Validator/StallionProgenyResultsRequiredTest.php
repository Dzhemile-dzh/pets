<?php

namespace Tests;

use \Api\Input\Request\Validator\StallionProgenyResultsRequired as Validator;

class StallionProgenyResultsRequiredTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param array $parameters
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getRequestMockObject(array $parameters)
    {
        $parameters += [
            'boundOrderedParametersCount' => count(
                array_filter(
                    $parameters,
                    function ($x) {
                        return !empty($x);
                    }
                )
            )
        ];

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
            [['getSeasonYearBegin' => '2015', 'getSeasonYearEnd' => null, 'getRaceType' => null, 'getCountryCode' => null]],
            [['getSeasonYearBegin' => '2015', 'getSeasonYearEnd' => '2016', 'getRaceType' => null, 'getCountryCode' => null]],
            [['getSeasonYearBegin' => '2015', 'getSeasonYearEnd' => '2016', 'getRaceType' => 'jumps', 'getCountryCode' => null]],
            [['getSeasonYearBegin' => '2015', 'getSeasonYearEnd' => '2016', 'getRaceType' => null, 'getCountryCode' => 'GB']],
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
            [['getSeasonYearBegin' => '2015', 'getSeasonYearEnd' => '2016', 'getRaceType' => 'flat', 'getCountryCode' => 'IRE']],
            [['getSeasonYearBegin' => null, 'getSeasonYearEnd' => null, 'getRaceType' => null, 'getCountryCode' => null]]
        ];
    }
}
