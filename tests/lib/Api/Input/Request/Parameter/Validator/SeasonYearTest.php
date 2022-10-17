<?php

namespace Tests;

class SeasonYearTest extends \PHPUnit\Framework\TestCase
{

    /**
     *
     * @dataProvider dataProviderTestWrong
     *
     * @param mixed $value
     */
    public function testWrong($value)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\SeasonYear();

        $this->assertFalse($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return [
            ['DE'],
            ['01'],
            [-1],
            [date('Y') + 2],
            [date('Y') + 100],
            [null],
            [false],
            [1949]
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param mixed $value
     */
    public function testSuccess($value)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\SeasonYear();
        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            [1951],
            [2014],
            [(int)date('Y')],
            [date('Y') + 1],
        ];
    }
}
