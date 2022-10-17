<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 1/22/2016
 * Time: 4:39 PM
 */

namespace Tests;

class JumpsCodeTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider             dataProviderTestWrong
     *
     * @param string $jumpsCode
     *
     * @throws \Exception
     */
    public function testWrong($jumpsCode)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\JumpsCode(
            new Stubs\Models\Selectors()
        );

        $this->assertFalse($validator->validate($jumpsCode));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return [
            ['CHASES'],
            ['CS'],
            [null],
            [false],
            [0],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param string $jumpsCode
     *
     * @throws \Exception
     */
    public function testSuccess($jumpsCode)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\JumpsCode(
            new Stubs\Models\Selectors()
        );

        $this->assertTrue($validator->validate($jumpsCode));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            ['CHASE'],
            ['HURDLE'],
            ['NHF'],
        ];
    }
}
