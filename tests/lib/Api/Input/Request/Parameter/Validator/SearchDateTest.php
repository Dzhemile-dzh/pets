<?php

namespace Tests;

class SearchDateTest extends \PHPUnit\Framework\TestCase
{

    /**
     *
     * @dataProvider dataProviderTestWrong
     *
     * @param string $startDate
     *
     * @throws \Exception
     */
    public function testWrong($startDate)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\SearchDate();
        $this->assertFalse($validator->validate($startDate));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            ['1666-01-01'],
            [date("d-m-Y", time()+86400)],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param string $startDate
     *
     * @throws \Exception
     */
    public function testSuccess($startDate)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\SearchDate();

        $this->assertTrue($validator->validate($startDate));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            ['2015-01-01'],
            ['1988-01-01'],
            [date('Y-m-d')],
        ];
    }
}
