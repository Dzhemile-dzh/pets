<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 10/26/2016
 * Time: 2:14 PM
 */

namespace Tests\Input\Request\Parameter\Cast;

class ToAnyTest extends \Tests\CommonTestCase
{
    /**
     * @param $value
     * @param $expected
     *
     * @dataProvider providerTestIntegersSuccess
     */
    public function testIntegersSuccess($value, $expected)
    {
        $cast = new \Phalcon\Input\Request\Parameter\Cast\DecimalInteger();
        $this->assertSame($expected, $cast->castValue($value));
    }

    public function providerTestIntegersSuccess()
    {
        return [
            ['111', 111],
            ['-18', -18],
            ['INF', INF],
            ['-INF', -INF],
        ];
    }

    /**
     * @param $value
     *
     * @dataProvider providerTestIntegersFailure
     */
    public function testIntegersFailure($value)
    {
        $cast = new \Phalcon\Input\Request\Parameter\Cast\DecimalInteger();
        $this->assertNull($cast->castValue($value));
    }

    public function providerTestIntegersFailure()
    {
        return [
            ['111.0'],
            ['012'],
            ['0x12'],
        ];
    }

    /**
     * @param $value
     * @param $expected
     *
     * @dataProvider providerTestFloatSuccess
     */
    public function testFloatsSuccess($value, $expected)
    {
        $cast = new \Phalcon\Input\Request\Parameter\Cast\DecimalFloat();
        $this->assertSame($expected, $cast->castValue($value));
    }

    public function providerTestFloatSuccess()
    {
        return [
            ['111.11', 111.11],
            ['-120.3', -120.3],
            ['+120.3', 120.3],
            ['111.55e+1', 1115.5],
            ['111e+1', 1110.0],
            ['111e-1', 11.1],
            ['111111', 111111.0],
        ];
    }

    /**
     * @param $value
     *
     * @dataProvider providerTestFloatsFailure
     */
    public function testFloatsFailure($value)
    {
        $cast = new \Phalcon\Input\Request\Parameter\Cast\DecimalFloat();
        $this->assertNull($cast->castValue($value));
    }

    public function providerTestFloatsFailure()
    {
        return [
            ['111.11a+2'],
            ['0x12'],
            ['012'],
        ];
    }

    /**
     * @param $value
     * @param $expected
     *
     * @dataProvider providerTestBoolSuccess
     */
    public function testBoolSuccess($value, $expected)
    {
        $cast = new \Phalcon\Input\Request\Parameter\Cast\Boolean();
        $this->assertSame($expected, $cast->castValue($value));
    }

    public function providerTestBoolSuccess()
    {
        return [
            ['y', true],
            ['Y', true],
            ['yeS', true],
            ['n', false],
            ['N', false],
            ['No', false],
            ['true', true],
            ['tRue', true],
            ['false', false],
            ['False', false],
            ['0', false],
            ['1', true],
        ];
    }

    public function testBoolFailure()
    {
        $boolean = '10';
        $cast = new \Phalcon\Input\Request\Parameter\Cast\Boolean();
        $this->assertNull($cast->castValue($boolean));
    }

    public function testCollectionWithCastingSuccess()
    {
        $collection = ['12', '77'];
        $cast = new \Phalcon\Input\Request\Parameter\Cast\Collection(
            new \Phalcon\Input\Request\Parameter\Cast\DecimalInteger()
        );
        $this->assertEquals([12, 77], $cast->castValue($collection));
    }

    public function testCollectionWithCastingFailure()
    {
        $collection = ['12', '77e-1'];
        $cast = new \Phalcon\Input\Request\Parameter\Cast\Collection(
            new \Phalcon\Input\Request\Parameter\Cast\DecimalInteger()
        );
        $this->assertNull($cast->castValue($collection));
    }

    /**
     * @param $value
     * @param $expected
     *
     * @dataProvider providerTestStringToArray
     */
    public function testStringToArray($value, $expected)
    {
        $cast = new \Phalcon\Input\Request\Parameter\Cast\StringToArray();
        $this->assertSame($expected, $cast->castValue($value));
    }

    public function providerTestStringToArray()
    {
        return [
            ['someValue', ['someValue']],
        ];
    }

    /**
     * @param $value
     * @param $expected
     *
     * @dataProvider providerTestHorseAgeSuccess
     */
    public function testHorseAgeSuccess($value, $expected)
    {
        $cast = new \Phalcon\Input\Request\Parameter\Cast\HorseAge();
        $this->assertSame($expected, $cast->castValue($value));
    }

    public function providerTestHorseAgeSuccess()
    {
        return [
            ['1', '1'],
            ['1+', '1+'],
            ['1yo+', '1+'],
            ['2yo', '2'],
            ['99', '99'],
        ];
    }

    /**
     * @param $value
     *
     * @dataProvider providerTestHorseAgeFailure
     */
    public function testHorseAgeFailure($value)
    {
        $cast = new \Phalcon\Input\Request\Parameter\Cast\HorseAge();
        $this->assertNull($cast->castValue($value));
    }

    public function providerTestHorseAgeFailure()
    {
        return [
            ['-1'],
            ['100'],
            ['99 yo'],
            ['2+yo'],
            [''],
            [null],
        ];
    }

    /**
     * @param $value
     * @param $expected
     *
     * @dataProvider providerTestCallback
     */
    public function testCallback($value, $expected)
    {
        $cast = new \Phalcon\Input\Request\Parameter\Cast\Callback(function ($value) {
            return $value ** 3;
        });
        $this->assertSame($expected, $cast->castValue($value));
    }

    /**
     * @return array
     */
    public function providerTestCallback()
    {
        return [
            [1, 1],
            [2, 8],
            [3, 27],
        ];
    }
}
