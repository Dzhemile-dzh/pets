<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 4/19/2017
 * Time: 2:21 PM
 */

namespace Tests\Input\Request\Parameter\Validator;

use Phalcon\Input\Request\Parameter\Validator\SybaseInt;

class SybaseIntTest extends \Tests\CommonTestCase
{
    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param mixed $value
     */
    public function testWrong($value)
    {
        $validator = new SybaseInt();

        $this->assertFalse($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            ['1'],
            [null],
            [false],
            [0.2],
            [-2147483649],
            [2147483648],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param mixed $value
     */
    public function testSuccess($value)
    {
        $validator = new SybaseInt();

        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            [-2147483648],
            [135],
            [2147483647],
        ];
    }
}
