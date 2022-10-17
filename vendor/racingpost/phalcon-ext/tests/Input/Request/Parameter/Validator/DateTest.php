<?php

namespace Tests\Input\Request\Parameter\Validator;

class DateTest extends \Tests\CommonTestCase
{
    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param string $date
     */
    public function testWrong($date)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\Date();

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
            ['2014-01-01 00:01:57'],
            ['2014-15-01'],
            ['2014-02-31'],
            ['2014-31-03']
            ['21-02-01'],
            ['2021-2-3']
        ];
    }

    /**
     * @dataProvider             dataProviderTestRangeException
     *
     * @param $date
     * @param $min
     * @param $max
     */
    public function testRangeException($date, $min, $max)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\Date(
            $min,
            $max
        );

        $this->assertFalse($validator->validate($date));
    }

    /**
     * @return array
     */
    public function dataProviderTestRangeException()
    {
        return [
            ['2016-06-01', '2016-06-02', null],
            ['2016-06-01', null, '2016-05-31'],
            ['2015-01-01', '2016-01-01', '2016-12-31'],
            ['2017-01-01', '2016-01-01', '2016-12-31'],
            ['2017-01-01', [1], [2]],
            ['2017-01-01', new \stdClass(), null],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param      $date
     * @param null $min
     * @param null $max
     *
     * @internal param string $countryCode
     *
     */
    public function testSuccess($date, $min = null, $max = null)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\Date(
            $min,
            $max
        );
        $this->assertTrue($validator->validate($date));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            ['2014-01-01'],
            ['2014-12-31'],
            ['2016-06-02', '2016-01-01', null],
            ['2016-06-02', '2016-06-02', null],
            ['2016-06-02', null, '2016-12-31'],
            ['2016-06-02', null, '2016-06-02'],
            ['2016-06-02', '2016-01-01', '2016-12-31'],
            ['2016-01-01', '2016-01-01', '2016-12-31'],
            ['2016-12-31', '2016-01-01', '2016-12-31'],
            ['2016-06-02', new \DateTime('2016-01-01'), new \DateTime('2016-12-31')],
        ];
    }

    /**
     * @param $dateFrom
     * @param $dateTo
     * @param $expectedTitle
     *
     * @dataProvider dataProviderTestGetValidatorTitle
     */
    public function testGetValidatorTitle($dateFrom, $dateTo, $expectedTitle)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\Date($dateFrom, $dateTo);
        $this->assertEquals($expectedTitle, $validator->getValidatorTitle());
    }

    /**
     * @return array
     */
    public function dataProviderTestGetValidatorTitle()
    {
        return [
            ['2016-10-01', '2016-11-01', 'date [YYYY-MM-DD], with range [from 2016-10-01to 2016-11-01]'],
            ['2016-10-01', null, 'date [YYYY-MM-DD], with range [from 2016-10-01]'],
            [null, '2016-11-01', 'date [YYYY-MM-DD], with range [to 2016-11-01]'],
            [null, null, 'date [YYYY-MM-DD]'],
        ];
    }
}
