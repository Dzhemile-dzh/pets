<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 4/6/2016
 * Time: 12:06 PM
 */

namespace lib\Api\Input\Request\Validator;

class MinMaxPriceDependantTest extends \PHPUnit\Framework\TestCase
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
     */
    public function testException($requestParams)
    {
        $request = $this->getRequestMockObject($requestParams);

        $validator = new \Api\Input\Request\Validator\MinMaxPriceDependant();
        $validator->setRequest($request);
        $validator->validate();
    }


    /**
     * @return array
     */
    public function dataProviderTestException()
    {
        return [
            [['getMinPrice' => 100, 'getMaxPrice' => 1, 'isParameterSet' => true]],
            [['getMinPrice' => 0, 'getMaxPrice' => -1, 'isParameterSet' => true]],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param array $requestParams
     *
     * @doesNotPerformAssertions
     */
    public function testSuccess($requestParams)
    {
        $request = $this->getRequestMockObject($requestParams);

        $validator = new \Api\Input\Request\Validator\MinMaxPriceDependant();
        $validator->setRequest($request);
        $validator->validate();
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            [['getMinPrice' => 0, 'getMaxPrice' => 0, 'isParameterSet' => true]],
            [['getMinPrice' => 0, 'getMaxPrice' => 50, 'isParameterSet' => true]],
            [['getMinPrice' => 100, 'getMaxPrice' => 100, 'isParameterSet' => true]],
            [['getMaxPrice' => 100, 'isParameterSet' => false]],
            [['getMinPrice' => 100, 'isParameterSet' => false]],
        ];
    }
}
