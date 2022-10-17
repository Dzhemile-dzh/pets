<?php

namespace Tests\Input\Request\Parameter\Validator;

class ExistsInArrayTest extends \Tests\CommonTestCase
{
    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param array $array
     * @param mixed $value
     */
    public function testWrong(array $array, $value)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\ExistsInArray(
            $array
        );
        $this->assertFalse($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            [
                ['fd', 'fd', 'fd'],
                'DE'
            ],
            [
                [1, 2, 3, 4, 5],
                6
            ],
            [
                [],
                5
            ],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param array $array
     * @param mixed $value
     */
    public function testSuccess(array $array, $value)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\ExistsInArray(
            $array
        );

        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            [
                [1, 2, 3],
                1
            ],
            [
                ['gf', 'hf', 'ff'],
                'gf'
            ],
        ];
    }

    /**
     * @dataProvider dataProviderTestGetValidatorTitle
     *
     * @param array $array
     * @param       $title
     */
    public function testGetValidatorTitle(array $array, $title)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\ExistsInArray($array);
        $this->assertEquals($title, $validator->getValidatorTitle());
    }

    /**
     * @return array
     */
    public function dataProviderTestGetValidatorTitle()
    {
        return [
            [
                ['2yo', '3yo', '4yo', '4yo+'],
                'enum [2yo, 3yo, 4yo, 4yo%2B]'
            ]
        ];
    }
}
