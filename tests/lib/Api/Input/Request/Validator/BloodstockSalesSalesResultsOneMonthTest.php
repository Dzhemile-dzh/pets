<?php
/**
 * Created by PhpStorm.
 * User: Stanislav_Kosatkin
 * Date: 12/16/2016
 * Time: 3:16 PM
 */

namespace Tests;

use Api\Exception\ValidationError;
use Api\Input\Request\Validator\BloodstockSalesSalesResultsOneMonth;
use Phalcon\Input\Request;

class BloodstockSalesSalesResultsOneMonthTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param $isParameterSet
     * @param $dateFrom
     * @param $dateTo
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockRequest($isParameterSet, $dateFrom, $dateTo)
    {
        $mock = $this->getMockBuilder(Request::class)
            ->setMethods(['isParameterSet', 'getDateFrom', 'getDateTo'])
            ->getMockForAbstractClass();

        $mock->expects($this->any())
            ->method('isParameterSet')
            ->willReturnMap($isParameterSet);

        $mock->expects($this->any())
            ->method('getDateFrom')
            ->willReturn($dateFrom);

        $mock->expects($this->any())
            ->method('getDateTo')
            ->willReturn($dateTo);

        return $mock;
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param array $isParameterSet
     * @param       $dateFrom
     * @param       $dateTo
     *
     * @doesNotPerformAssertions
     * @throws ValidationError
     */
    public function testSuccess(array $isParameterSet, $dateFrom, $dateTo)
    {
        $mockRequest = $this->getMockRequest($isParameterSet, $dateFrom, $dateTo);

        $validator = new BloodstockSalesSalesResultsOneMonth(new ValidationError("Test message"));
        $validator->setRequest($mockRequest);
        $validator->validate();
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            [
                [
                    ['sale', false],
                    ['vendor', false],
                    ['buyer', false],
                    ['name', false],
                    ['dam', true],
                    ['sire', false],
                    ['damSire', false]
                ],
                '2015-01-01',
                '2016-01-01'
            ]
        ];
    }

    /**
     * @dataProvider dataProviderTestException
     *
     * @param array $isParameterSet
     * @param       $dateFrom
     * @param       $dateTo
     *
     * @throws ValidationError
     */
    public function testException(array $isParameterSet, $dateFrom, $dateTo)
    {
        $mockRequest = $this->getMockRequest($isParameterSet, $dateFrom, $dateTo);

        $validator = new BloodstockSalesSalesResultsOneMonth(new ValidationError(1));
        $validator->setRequest($mockRequest);

        $this->expectException(ValidationError::class);
        $this->expectExceptionMessage('Undefined error occurred');
        $validator->validate();
    }

    /**
     * @return array
     */
    public function dataProviderTestException()
    {
        return [
            [
                [
                    ['sale', false],
                    ['vendor', false],
                    ['buyer', false],
                    ['name', false],
                    ['dam', false],
                    ['sire', false],
                    ['damSire', false]
                ],
                '2015-01-01',
                '2016-01-01'
            ],
            [
                [
                    ['sale', false],
                    ['vendor', false],
                    ['buyer', false],
                    ['name', false],
                    ['dam', false],
                    ['sire', false],
                    ['damSire', false]
                ],
                '2015-01-01',
                '2015-02-04'
            ]
        ];
    }
}
