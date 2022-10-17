<?php

namespace Tests\Input\Request\Parameter\Validator;

class DateTimeTest extends \Tests\CommonTestCase
{
    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param string $date
     */
    public function testWrong($date)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\DateTime();
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
            ['2014-01-01 00:01:67'],
            ['2014-13-01 00:01:27'],
            ['2014-01-01'],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param string $date
     */
    public function testSuccess($date)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\DateTime();

        $this->assertTrue($validator->validate($date));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            ['2014-01-01 12:43:00'],
            ['2014-01-01 00:01:57'],
            ['2014-01-01 00:00:00'],
        ];
    }
}
