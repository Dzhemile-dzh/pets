<?php

namespace Tests;

use \Tests\Api\Input\Request\Mocks\SalesRequestMock;

class DependentLotParametersTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException \Exception
     *
     * @dataProvider dataProviderTestException
     *
     * @param array $requestParams
     *
     * @throws \Api\Exception\ValidationError
     */
    public function testException($requestParams)
    {
        new SalesRequestMock([], $requestParams);
    }


    /**
     * @return array
     */
    public function dataProviderTestException()
    {
        return [
            [['lotLetter' => 'a', 'regId' => 1]]
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
        new SalesRequestMock([], $requestParams);
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            [['lotLetter' => 'a', 'lotNo' => 1, 'regId' => 1]],
        ];
    }
}
