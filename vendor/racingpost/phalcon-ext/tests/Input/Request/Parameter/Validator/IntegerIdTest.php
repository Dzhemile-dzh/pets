<?php

namespace Tests\Input\Request\Parameter\Validator;

class IntegerIdTest extends \Tests\CommonTestCase
{
    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param mixed $value
     */
    public function testWrong($value)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\IntegerId();

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
            [-1],
            ['-1'],
            [0],
            [null],
            [false],
            [64000000000],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param mixed $value
     */
    public function testSuccess($value)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\IntegerId();

        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            [1],
            [135],
            [2147483647],
        ];
    }
}
