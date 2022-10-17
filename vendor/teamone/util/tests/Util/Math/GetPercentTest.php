<?php

namespace Test\Util\Math;

use Test\Stubs\Math\GetPercentStub;

/**
 * Class GetPercentTest
 *
 * @package Test\Util\Math
 */
class GetPercentTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var $stub GetPercentStub
     */
    private $stub;

    /**
     * setup
     */
    public function setUp()
    {
        $this->stub = new GetPercentStub();
    }

    /**
     * @param int   $mult
     * @param int   $div
     * @param mixed $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetPercent($mult, $div, $expectedResult)
    {

        $this->assertEquals(
            $expectedResult,
            $this->stub->getPercent($mult, $div)
        );
    }

    /**
     * @return array
     */
    public function dataProvider()
    {

        return [
            [
                0,
                0,
                null
            ],
            [
                0,
                100,
                0
            ],
            [
                10,
                100,
                10
            ],
            [
                3,
                15,
                20
            ],
            [
                8,
                35,
                23
            ],
            [
                0,
                5,
                0
            ],
            [
                10,
                10,
                100
            ],
            [
                null,
                10,
                null
            ],
            [
                null,
                null,
                null
            ],
        ];
    }
}
