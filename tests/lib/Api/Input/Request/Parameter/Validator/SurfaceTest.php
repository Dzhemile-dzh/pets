<?php

namespace Tests;

class SurfaceTest extends \PHPUnit\Framework\TestCase
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
        $validator = new \Api\Input\Request\Parameter\Validator\Surface(
            new \Models\Selectors()
        );

        $this->assertFalse($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            ['DE'],
            ['tru'],
            ['wa'],
            [false],
            [true],
            [null],
            [1]
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
        $validator = new \Api\Input\Request\Parameter\Validator\Surface(
            new \Models\Selectors()
        );

        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            ['aw'],
            ['turf']
        ];
    }
}
