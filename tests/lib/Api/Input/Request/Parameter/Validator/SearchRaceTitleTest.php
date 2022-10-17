<?php

namespace Tests;

class SearchRaceTitleTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param string $raceTitle
     *
     * @throws \Exception
     */
    public function testWrong($raceTitle)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\SearchRaceTitle();

        $this->assertFalse($validator->validate($raceTitle));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            ['dd'],
            ['d'],
            [1],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param string $raceTitle
     *
     * @throws \Exception
     */
    public function testSuccess($raceTitle)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\SearchRaceTitle();
        $this->assertTrue($validator->validate($raceTitle));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            ['test'],
            ['tes'],
        ];
    }
}
