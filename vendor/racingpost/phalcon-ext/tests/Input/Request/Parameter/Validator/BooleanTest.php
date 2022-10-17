<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 11/3/2016
 * Time: 3:29 PM
 */

namespace Tests\Input\Request\Parameter\Validator;

use Phalcon\Input\Request\Parameter\Validator\Boolean;

class BooleanTest extends \Tests\CommonTestCase
{
    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param mixed $flag
     */
    public function testWrong($flag)
    {
        $validator = new Boolean();

        $this->assertFalse($validator->validate($flag));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return[
            [''],
            [1],
            [0],
            [null],
            ['1'],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param mixed $flag
     */
    public function testSuccess($flag)
    {
        $validator = new Boolean();

        $this->assertTrue($validator->validate($flag));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            [true],
            [false],
        ];
    }
}
