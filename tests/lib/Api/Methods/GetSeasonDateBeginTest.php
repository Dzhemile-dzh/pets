<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 4/6/2017
 * Time: 11:09 AM
 */

namespace Tests;

class GetSeasonDateBeginTest extends \PHPUnit\Framework\TestCase
{
    /*
     * Testing strategy:
     *
     * Partition inputs as follows:
     *
     * seasonYearBegin - parameter is provided
     * coursePrincipalSeason - parameter is not provided
     *
     * seasonYearBegin - parameter is not provided
     * coursePrincipalSeason - parameter is provided
     *
     * seasonYearBegin - parameter is not provided
     * coursePrincipalSeason - parameter is not provided
     *
     * For one call
     * For multiple call with different season type codes
     * For multiple call with partial overlapping of type codes
     */

    /**
     * @param array $methods
     * @param array $expectedDates
     *
     * @dataProvider dataProviderTestGetSeasonDateBegin
     */
    public function testGetSeasonDateBegin(array $methods, array $expectedDates)
    {
        $traitGetSeasonDateBegin = $this->getMockSeasonDateBegin($methods);

        foreach ($expectedDates as $expectedDate) {
            $this->assertSame($expectedDate, $traitGetSeasonDateBegin->getSeasonDateBegin());
        }
    }

    public function dataProviderTestGetSeasonDateBegin()
    {
        return [
            [
                [
                    'trait' => [
                        'getSeasonTypeCode' => ['M', 'F', 'K', 'F'],
                        'isParameterProvided' => [true, false, true, false, false],
                        'getSeasonYearBegin' => [2016, 2011],
                    ],
                    'db' => [
                        'getSeasonDateBegin' => ['2016-03-20 00:00:00', '2011-01-01 00:00:00'],
                        'getCurrentSeasonDateBegin' => ['2017-05-06 00:00:00']
                    ]
                ],
                [
                    '2016-03-20 00:00:00', '2011-01-01 00:00:00', '2017-05-06 00:00:00', '2011-01-01 00:00:00'
                ]
            ]
        ];
    }

    /**
     * @param array $methods
     * @return \Api\Input\Request\Method\GetSeasonDateBegin
     */
    private function getMockSeasonDateBegin(array $methods)
    {
        $mock = $this->getMockBuilder('\Api\Input\Request\Method\GetSeasonDateBegin')
            ->setMethods(array_keys($methods['trait']) + [3 => 'getSelectors', 4 => 'getDb'])
            ->getMockForTrait();
        $mockDb = $this->getMockBuilder('\stdClass')
            ->setMethods(array_keys($methods['db']))
            ->getMock();

        $mock->expects($this->atLeastOnce())->method('getSelectors')->willReturnSelf();
        $mock->expects($this->atLeastOnce())->method('getDb')->willReturn($mockDb);

        foreach ($methods['trait'] as $methodName => $methodValues) {
            /** @todo: refactor call_user_func_array to (...$methodValues) after migration on PHP 7.X */
            $mock->expects($this->exactly(count($methodValues)))
                ->method($methodName)
                ->will(call_user_func_array([$this, 'onConsecutiveCalls'], $methodValues));
        }

        foreach ($methods['db'] as $methodName => $methodValues) {
            /** @todo: refactor call_user_func_array to (...$methodValues) after migration on PHP 7.X */
            $mockDb->expects($this->exactly(count($methodValues)))
                ->method($methodName)
                ->will(call_user_func_array([$this, 'onConsecutiveCalls'], $methodValues));
        }

        return $mock;
    }
}
