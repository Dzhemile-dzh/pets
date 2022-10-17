<?php

namespace Tests\Input\Request\Parameter\Validator;

class TimeTest extends \Tests\CommonTestCase
{

    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param string $date
     */
    public function testWrong($date)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\Time();

        $this->assertFalse($validator->validate($date));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            ['DE'],
            [1],
            [false],
            [null],
            ['54:67'],
            ['2014-01-01 00:01:00'],
            ['24:59'],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param string $date
     */
    public function testSuccess($date)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\Time();

        $this->assertTrue($validator->validate($date));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            ['12:43:00'],
            ['00:00:01'],
            ['23:59:59'],
        ];
    }
}
