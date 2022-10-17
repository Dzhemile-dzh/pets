<?php

namespace Tests\Input\Request\Parameter\Validator;

class IntegerTest extends \Tests\CommonTestCase
{
    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param mixed $value
     */
    public function testWrong($value, $min = null, $max = null)
    {
        if (!isset($min)) {
            $validator = new \Phalcon\Input\Request\Parameter\Validator\Integer();
        } elseif (!isset($max)) {
            $validator = new \Phalcon\Input\Request\Parameter\Validator\Integer(
                $min
            );
        } else {
            $validator = new \Phalcon\Input\Request\Parameter\Validator\Integer(
                $min,
                $max
            );
        }

        $this->assertFalse($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            ['DE'],
            ['01'],
            ['444e4'],
            ['0x1A'],
            ['0b11111111'],
            [null],
            [false],
            [1, 2],
            [5, 0, 4]
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param mixed $value
     */
    public function testSuccess($value, $min = null, $max = null)
    {
        $validator = new \Phalcon\Input\Request\Parameter\Validator\Integer($min, $max);
        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            [1],
            [0],
            [135],
            [-1],
            [3, 2],
            [3, 0, 4],
            [3, null, 4],
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
        $validator = new \Phalcon\Input\Request\Parameter\Validator\Integer($min, $max);
        $this->assertEquals($expectedTitle, $validator->getValidatorTitle());
    }

    /**
     * @return array
     */
    public function dataProviderTestGetValidatorTitle()
    {
        return [
            [1, 100, 'integer with value range [1-100]'],
            [1, null, 'integer with value range [1-]'],
            [null, 100, 'integer with value range [-100]'],
            [null, null, 'integer with value range [-]'],
        ];
    }
}
