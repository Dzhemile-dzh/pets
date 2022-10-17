<?php

namespace Tests\Input\Request\Parameter\Validator;

class BinaryFlagTest extends \Tests\CommonTestCase
{
    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param mixed $flag
     */
    public function testWrong($flag)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\BinaryFlag();

        $this->assertFalse($validator->validate($flag));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            ['DE'],
            [-1],
            [false],
            [null],
            ['2014-01-01 00:01:67'],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param mixed $flag
     */
    public function testSuccess($flag)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\BinaryFlag();

        $this->assertTrue($validator->validate($flag));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            [1],
            [0],
            ['1'],
            ['0'],
        ];
    }
}
