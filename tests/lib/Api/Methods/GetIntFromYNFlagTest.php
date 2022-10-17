<?php

namespace Tests\Api\Methods;

use Api\Methods\GetIntFromYNFlag;

class GetIntFromYNFlagTest extends \PHPUnit\Framework\TestCase
{
    use GetIntFromYNFlag;

    /**
     * @param $value
     * @param $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testGetIntFromYNFlag($value, $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->dbYNFlagToInt($value));
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                'y',
                1
            ],
            [
                'n',
                0
            ],
            [
                'Y',
                1
            ],
            [
                'N',
                0
            ],
            [
                null,
                0
            ],
        ];
    }
}
