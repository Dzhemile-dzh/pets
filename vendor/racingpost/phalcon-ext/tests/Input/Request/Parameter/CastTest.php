<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/26/2016
 * Time: 1:52 PM
 */

namespace Tests\Input\Request\Parameter;

class CastTest extends \Tests\CommonTestCase
{
    public function testCastSuccess()
    {
        $value = 'someValue';
        $cast = (new \Tests\Input\Request\Parameter\Mock\Cast())->setCast($value);

        $this->assertEquals($value, $cast->castValue($value));
    }

    public function testCastMismatch()
    {
        $cast = (new \Tests\Input\Request\Parameter\Mock\Cast())->setCast(null);

        $this->assertNull($cast->castValue('someValue'));
    }

    public function testInitValue()
    {
        $value = 'someValue';
        $cast = (new \Tests\Input\Request\Parameter\Mock\Cast())->setCast($value);
        $cast->castValue($value);
        $this->assertEquals($value, $cast->getInitValue());
    }
}
