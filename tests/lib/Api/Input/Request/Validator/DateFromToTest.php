<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 6/2/2016
 * Time: 3:23 PM
 */

namespace Tests;

class DateFromToTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param array $parameters
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    private function getRequestMockObject(array $parameters)
    {
        $methods = array_keys($parameters);
        $stub = $this->getMockForAbstractClass(
            'Phalcon\Input\Request',
            [],
            '',
            false,
            true,
            true,
            array_merge($methods, ['isParameterSet'])
        );

        // Configure the stub.
        foreach ($parameters as $methodName => $result) {
            $stub->expects($this->any())->method($methodName)->willReturn($result);
        }
        $stub->expects($this->any())->method('isParameterSet')->willReturnCallback(
            function ($name) use ($methods) {
                return in_array('get' . ucfirst($name), $methods);
            }
        );

        return $stub;
    }

    /**
     * @param array $methodParams
     *
     * @return \Api\Input\Request\Validator\DateFromTo
     */
    private function getValidator($methodParams)
    {
        if (count($methodParams) < 1) {
            $validator = new \Api\Input\Request\Validator\DateFromTo();
        } else {
            list($maxRange, $paramNameFrom, $paramNameTo) = $methodParams;

            if (!is_null($maxRange) && !is_null($paramNameFrom) && is_null($paramNameTo)) {
                $validator = new \Api\Input\Request\Validator\DateFromTo($maxRange, $paramNameFrom);
            } elseif (!is_null($maxRange) && is_null($paramNameFrom) && is_null($paramNameTo)) {
                $validator = new \Api\Input\Request\Validator\DateFromTo($maxRange);
            } else {
                $validator = new \Api\Input\Request\Validator\DateFromTo($maxRange, $paramNameFrom, $paramNameTo);
            }
        }

        return $validator;
    }

    /**
     * @expectedException \Exception
     *
     * @dataProvider dataProviderTestException
     *
     * @param array $requestParams
     * @param array $methodParams
     *
     * @throws \Api\Exception\ValidationError
     */
    public function testException($requestParams, $methodParams)
    {
        $request = $this->getRequestMockObject($requestParams);

        $validator = $this->getValidator($methodParams);
        $validator->setRequest($request);
        $validator->validate();
    }


    /**
     * @return array
     */
    public function dataProviderTestException()
    {
        return [
            [['getDateFrom' => '2017-01-01', 'getDateTo' => '2000-01-01'], []],
            [['getStartDate' => '2017-01-01', 'getEndDate' => '2017-01-02'], []],
            [['getDateFrom' => '2016-01-01', 'getDateTo' => '2017-02-01'], ['P1Y', null, null]],
            [['getDateFrom' => '2016-01-01', 'getDateTo' => '2016-05-05'], ['P3M', null, null]],

            [['getDateFrom' => '2016-06-01', 'getDateTo' => '2016-08-01'], ['P1M', 'getStartDate', 'getEndDate']],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param array $requestParams
     * @param array $methodParams
     *
     * @doesNotPerformAssertions
     *
     * @throws \Api\Exception\ValidationError
     */
    public function testSuccess($requestParams, $methodParams)
    {
        $request = $this->getRequestMockObject($requestParams);

        $validator = $this->getValidator($methodParams);
        $validator->setRequest($request);
        $validator->validate();
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            [['getDateFrom' => '2016-01-01', 'getDateTo' => '2017-01-01'], []],
            [['getDateFrom' => '2016-01-01', 'getDateTo' => '2017-01-01'], ['P1Y', null, null]],
            [['getDateFrom' => '2016-01-01', 'getDateTo' => '2016-01-05'], ['P3M', null, null]],

            [['getDateFrom' => '2016-06-01', 'getDateTo' => '2016-07-01'], ['P1M', 'DateFrom', 'DateTo']],
            [['getDateFrom' => '2016-01-01', 'getDateTo' => '2016-01-01'], ['P1M', 'DateFrom', 'DateTo']],
            [['getDateFrom' => '2016-01-01', 'getDateTo' => '2017-01-01'], ['P1Y', 'DateFrom', 'DateTo']],

            [['getStartDate' => '2012-01-01', 'getEndDate' => '2017-01-01'], ['P5Y', 'StartDate', 'EndDate']],
        ];
    }
}
