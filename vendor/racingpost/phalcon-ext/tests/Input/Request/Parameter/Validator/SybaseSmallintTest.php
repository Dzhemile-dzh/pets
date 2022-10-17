<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 4/19/2017
 * Time: 2:22 PM
 */

namespace Tests\Input\Request\Parameter\Validator;

use Phalcon\Input\Request\Parameter\Validator\SybaseSmallint;

class SybaseSmallintTest extends \Tests\CommonTestCase
{
    /**
     * @dataProvider dataProviderTestWrong
     *
     * @param mixed $value
     */
    public function testWrong($value)
    {
        $validator = new SybaseSmallint();

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
            [-32769],
            [32768],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param mixed $value
     */
    public function testSuccess($value)
    {
        $validator = new SybaseSmallint();

        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return[
            [-32768],
            [135],
            [32767],
        ];
    }
}
