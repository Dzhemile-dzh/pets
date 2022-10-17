<?php

namespace Tests\Api\Methods;

use Api\Methods\NullifyEmptyValue;

class NullifyEmptyValueTest extends \PHPUnit\Framework\TestCase
{
    use NullifyEmptyValue;

    /**
     * @param $value
     * @param $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testNullifyEmptyValue($value, $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->nullifyEmptyValue($value));
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                'Not empty',
                'Not empty'
            ],
            [
                '',
                null
            ],
            [
                '0',
                null
            ],
            [
                4,
                4
            ],
            [
                0,
                null
            ],
            [
                0.1,
                0.1
            ],
            [
                0.0,
                null
            ],
            [
                true,
                true
            ],
            [
                false,
                null
            ],
            [
                array('1', '2'),
                array('1', '2')
            ],
            [
                array(),
                null
            ],
        ];
    }
}
