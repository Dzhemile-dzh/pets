<?php

namespace Tests;

use Phalcon\Exception;

class OnlyLettersAndSpacesTest extends \PHPUnit\Framework\TestCase
{
    use \Api\Methods\OnlyLettersAndSpaces;

    /**
     * @param $value
     * @param $expectedResult
     *
     * @dataProvider dataProvider
     */
    public function testOnlyLettersAndSpaces($value, $expectedResult)
    {
        $this->assertEquals($expectedResult, $this->onlyLettersAndSpaces($value));
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            [
                '(a.w)',
                'aw'
            ],
            [
                '(test)',
                'test'
            ],
            [
                '#-=Linda}',
                'Linda'
            ],
            [
                'Lingfield',
                'Lingfield'
            ],
            [
                '(Partly cloudy)',
                'Partly cloudy'
            ],
            [
                null,
                null
            ],
        ];
    }
}
