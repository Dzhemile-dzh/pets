<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 1/20/2017
 * Time: 11:36 AM
 */

namespace Tests\Api\Input\Request\Parameter\Calculate;

use Api\Input\Request\Parameter\Calculate;
use Tests\Api\Input\Request\Parameter\Calculate as Base;

class ChampionshipTest extends Base
{
    /**
     * @param $requestMethods
     * @param $championship
     * @param $expectedChampionship
     *
     * @dataProvider dataProviderTestGetChampionship
     */
    public function testGetChampionships($requestMethods, $championship, $expectedChampionship)
    {
        $champ = new Calculate\Championship($championship);
        $this->setUpCalculation($requestMethods, $champ);
        $this->assertSame($expectedChampionship, $champ->getValue());
    }

    public function dataProviderTestGetChampionship()
    {
        return [
            [
                [
                    'isRegisterEmpty' => false,
                    'isParameterProvided' => true,
                    'getRaceType' => 'flat',

                ],
                'champ',
                'champ'
            ],
            [
                [
                    'isRegisterEmpty' => false,
                    'isParameterProvided' => false,
                    'retrieveDefaultValue' => 'jumps',

                ],
                'champ',
                null
            ],
            [
                [
                    'isRegisterEmpty' => true,
                ],
                'champ',
                null
            ],
        ];
    }
}
