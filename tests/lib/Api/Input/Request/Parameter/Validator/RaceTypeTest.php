<?php

namespace Tests;

class RaceTypeTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param string $raceType
     *
     * @throws \Exception
     */
    public function testWrong($raceType)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\RaceType(
            new Stubs\Models\Selectors()
        );

        $this->assertFalse($validator->validate($raceType));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            ['jump'],
            ['UA'],
            [null],
            [false],
            [true],
            [1],
            ['FLAT'],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param string $raceType
     *
     * @throws \Exception
     */
    public function testSuccess($raceType)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\RaceType(
            new Stubs\Models\Selectors()
        );

        $this->assertTrue($validator->validate($raceType));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            ['jumps'],
            ['flat']
        ];
    }
}
