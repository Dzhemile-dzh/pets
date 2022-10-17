<?php

namespace Tests\Input\Request\Parameter\Validator;

class SmallIntegerTest extends \Tests\CommonTestCase
{
    /**
     * @dataProvider             dataProviderTestWrong
     *
     * @param mixed $value
     */
    public function testWrong($value)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\SmallInteger();

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
            ['444e4'],
            ['0x1A'],
            ['0b11111111'],
            [null],
            [false],
            [32768],
            [53.02]
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param mixed $value
     */
    public function testSuccess($value)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\SmallInteger();

        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            [1],
            [135],
            [32767],
        ];
    }
}
