<?php

namespace Tests;

use \Tests\Api\Input\Request\Mocks\SalesRequestMock;

class RegDateFromToTest extends \PHPUnit\Framework\TestCase
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
            [['age' => '1']],
            [[]]
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
            [['dateFrom' => '2017-01-01', 'dateTo' => '2017-01-11']],
            [['regId' => 35455]]
        ];
    }
}
