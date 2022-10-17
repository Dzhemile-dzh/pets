<?php

namespace Tests\Input\Request\Parameter\Validator;

class CallbackTest extends \Tests\CommonTestCase
{

    public function testWrong()
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\Callback(
            function ($value, $maxValue) {
                return $value <= $maxValue;
            },
            [10]
        );

        $this->assertFalse($validator->validate(11));
    }

    public function testSuccess()
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\Callback(
            function ($value, $maxValue) {
                return $value <= $maxValue;
            },
            [10]
        );
        $this->assertTrue($validator->validate(9));
    }

    /**
     * @param $callback
     * @param $params
     * @param $expectedTitle
     *
     * @dataProvider dataProviderTestGetValidatorTitle
     */
    public function testGetValidatorTitle($callback, $params, $expectedTitle)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\Callback($callback, $params);
        $this->assertEquals($expectedTitle, $validator->getValidatorTitle());
    }

    /**
     * @return array
     */
    public function dataProviderTestGetValidatorTitle()
    {
        return [
            [
                function () {
                }, [1], ''
            ]
        ];
    }
}
