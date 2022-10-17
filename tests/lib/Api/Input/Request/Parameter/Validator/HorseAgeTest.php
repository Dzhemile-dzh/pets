<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 1/22/2016
 * Time: 4:21 PM
 */

namespace Tests;

class HorseAgeTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider             dataProviderTestWrong
     *
     * @param array      $availableValues
     * @param string|int $value
     *
     * @throws \Exception
     */
    public function testWrong($availableValues, $value)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\HorseAge(
            $availableValues
        );

        $this->assertFalse($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return [
            [['0', '1', '2', '3+'], null],
            [['0', '1', '2', '3+'], 5],
            [['0', '1', '2', '3+'], -1],
            [['0', '1', '2', '3+'], '5'],
        ];
    }

    /**
     * @param array      $availableValues
     * @param string|int $value
     *
     * @dataProvider dataProviderTestSuccess
     */
    public function testSuccess($availableValues, $value)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\HorseAge(
            $availableValues
        );

        $this->assertTrue($validator->validate($value));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            [['0', '1', '2', '3+'], '3+'],
            [['0', '1', '2', '3+'], 1],
            [['0', '1', '2', '3+'], '0'],
            [['0', '1', '2', '3+'], '2'],
        ];
    }

    /**
     * @param array      $availableValues
     * @param string|int $expectedValue
     *
     * @dataProvider dataProviderTestGetValidatorTitle
     */
    public function testGetValidatorTitle($availableValues, $expectedValue)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\HorseAge(
            $availableValues
        );

        $this->assertEquals($validator->getValidatorTitle(), $expectedValue);
    }

    /**
     * @return array
     */
    public function dataProviderTestGetValidatorTitle()
    {
        return [
            [['0', '1', '2', '3+'], 'horse age [0, 1, 2, 3+]'],
            [['7', '7+'], 'horse age [7, 7+]'],
        ];
    }
}
