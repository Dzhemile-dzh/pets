<?php

namespace Test\Util\Math;

use Test\Stubs\Math\GetPercentStub;
use Test\Stubs\Math\GetSumStub;

/**
 * Class GetPercentTest
 *
 * @package Test\Util\Math
 */
class GetSumTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @var $stub GetSumStub
     */
    private $stub;

    /**
     * setup
     */
    public function setUp()
    {
        $this->stub = new GetSumStub();
    }

    /**
     *
     * @dataProvider providerTestGetSum
     */
    public function testGetSum($param1, $param2, $expected)
    {
        $this->assertSame(
            $expected,
            $this->stub->getSum($param1, $param2)
        );
    }

    /**
     * @return array
     */
    public function providerTestGetSum()
    {
        return [
            [2, 4, 6],
            [10, 12, 22],
            ['4', '3', 7]
        ];
    }
}
