<?php

namespace Tests\Input\Request\Parameter\Validator;

class StringLengthTest extends \Tests\CommonTestCase
{

    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param mixed $value
     */
    public function testWrong($value, $minLength = null, $maxLength = null)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\StringLength($minLength, $maxLength);
        $this->assertFalse($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            [null],
            [false],
            [1],
            ['test', 1, 3],
            ['', 1, 3]
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param mixed $value
     */
    public function testSuccess($value, $minLength = null, $maxLength = null)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\StringLength($minLength, $maxLength);
        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            ['34'],
            ['123456', 6],
            ['', 0, 6],
            ['123', 0, 6],
            ['123', null, 6]
        ];
    }

    /**
     * @param $min
     * @param $max
     * @param $expectedTitle
     *
     * @dataProvider dataProviderTestGetValidatorTitle
     */
    public function testGetValidatorTitle($min, $max, $expectedTitle)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\StringLength($min, $max);
        $this->assertEquals($expectedTitle, $validator->getValidatorTitle());
    }

    /**
     * @return array
     */
    public function dataProviderTestGetValidatorTitle()
    {
        return [
            [1, 100, 'string with length range [1-100]'],
            [null, 100, 'string with length range [100]'],
            [1, null, 'string with length range [1]'],
            [null, null, 'string with length range []'],
        ];
    }
}
