<?php

namespace Tests;

class TrainerChampionshipTest extends \PHPUnit\Framework\TestCase
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
        $validator = new \Api\Input\Request\Parameter\Validator\TrainerChampionship();

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
        $validator = new \Api\Input\Request\Parameter\Validator\TrainerChampionship();
        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            ['trainer'],
        ];
    }
}
