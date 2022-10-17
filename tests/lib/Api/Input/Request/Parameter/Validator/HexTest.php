<?php

namespace Tests;

class HexTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param mixed $value
     *
     * @throws \Exception
     */
    public function testWrong($value)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\Hex();

        $this->assertFalse($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            ['DE'],
            ['0000000000065776'],
            [false],
            [true],
            [null],
            [1],
            ['0x000000000006577k'],
            ['0x000000000006\'5a3'],
            ['0x000000000006"5a3'],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param mixed $value
     *
     * @throws \Exception
     */
    public function testSuccess($value)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\Hex();

        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            ['0x0000000000065776'],
            ['0x0000000000065a13'],
        ];
    }
}
