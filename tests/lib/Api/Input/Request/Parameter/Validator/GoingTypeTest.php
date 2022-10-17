<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 1/22/2016
 * Time: 4:21 PM
 */

namespace Tests;

class GoingTypeTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @dataProvider             dataProviderTestWrong
     *
     * @param string $goingType
     *
     * @throws \Exception
     */
    public function testWrong($goingType)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\GoingType(
            new Stubs\Models\Selectors()
        );

        $this->assertFalse($validator->validate($goingType));
    }

    /**
     * @return array
     */
    public function dataProviderTestWrong()
    {
        return [
            ['Slow'],
            ['Standard'],
            [null],
            [false],
            [123],
            ['Wd'],
            ['Hard/firm'],
            ['all'],
            ['*'],
            ['/'],
            ['-'],
        ];
    }

    /**
     * @dataProvider dataProviderTestSuccess
     *
     * @param string $raceType
     *
     * @throws \Exception
     */
    public function testSuccess($raceType)
    {
        $validator = new \Api\Input\Request\Parameter\Validator\GoingType(
            new Stubs\Models\Selectors()
        );

        $this->assertTrue($validator->validate($raceType));
    }

    /**
     * @return array
     */
    public function dataProviderTestSuccess()
    {
        return [
            ['F'],
            ['FT'],
            ['FZ'],
            ['G'],
            ['GF'],
            ['GF', 'G'],
            ['GS', 'S'],
            ['GS'],
            ['GY'],
            ['HD'],
            ['HO'],
            ['HY'],
            ['MY'],
            ['S'],
            ['SD'],
            ['SF'],
            ['SH'],
            ['SN'],
            ['SS'],
            ['SW'],
            ['SY'],
            ['VS'],
            ['Y'],
            ['YS'],
        ];
    }
}
