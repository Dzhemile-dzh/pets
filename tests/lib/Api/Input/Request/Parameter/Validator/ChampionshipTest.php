<?php

namespace Tests;

class ChampionshipTest extends \PHPUnit\Framework\TestCase
{

    /**
     *
     * @dataProvider dataProviderTestWrong
     *
     * @param mixed $value
     *
     * @throws \Exception
     */
    public function testWrong($value)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\Championship();
        $this->assertFalse($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            [false],
            [true],
            [null],
            [1],
            ['horse']
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
        $validator = new \Api\Input\Request\Parameter\Validator\Championship();
        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            ['trainer'],
            ['jockey'],
            ['owner'],
        ];
    }
}
