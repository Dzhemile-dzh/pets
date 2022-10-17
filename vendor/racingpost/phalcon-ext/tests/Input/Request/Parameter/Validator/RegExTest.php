<?php

namespace Tests\Input\Request\Parameter\Validator;

class RegExTest extends \Tests\CommonTestCase
{
    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param mixed $value
     */
    public function testWrong($value, $pattern)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\RegEx(
            $pattern
        );
        $this->assertFalse($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            [null, '/^[0-9]+$/'],
            [false, '/^[0-9]+$/'],
            [1, '/^[0-9]+$/'],
            ['test', '/^[0-9]+$/'],
            ['', '/^[0-9]+$/']
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param mixed $value
     */
    public function testSuccess($value, $pattern)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\RegEx(
            $pattern
        );
        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            ['01', '/^[0-9]+$/'],
            ['', '/^[0-9]?$/']
        ];
    }

    /**
     * @param $pattern
     * @param $expectedTitle
     *
     * @dataProvider dataProviderTestGetValidatorTitle
     */
    public function testGetValidatorTitle($pattern, $expectedTitle)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\RegEx($pattern);
        $this->assertEquals($expectedTitle, $validator->getValidatorTitle());
    }

    /**
     * @return array
     */
    public function dataProviderTestGetValidatorTitle()
    {
        return [
            [
                '/^test$/', 'regEx with rule [/^test$/]'
            ]
        ];
    }
}
