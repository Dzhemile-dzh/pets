<?php

namespace Tests\Input\Request\Parameter\Validator;

class FloatPositiveTest extends \Tests\CommonTestCase
{
    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param mixed $value
     */
    public function testWrong($value)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\FloatPositive();
        $this->assertFalse($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            ['DE'],
            ['01'],
            ['444e4'],
            ['0x1A'],
            ['0b11111111'],
            [null],
            [false],
            ['01.01'],
            ['01,01'],
            ['-01,01'],
            [-1.1],
            ['-1.1'],
            [-1],
            ['-1'],
            [0],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param mixed $value
     */
    public function testSuccess($value)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\FloatPositive();
        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            [0.0001],
            [15225154.0],
            [1.1],
            [0.1],
            [135.1],
        ];
    }
}
