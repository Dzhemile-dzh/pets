<?php
/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/31/2016
 * Time: 12:08 PM
 */

namespace Tests\Bo\GoingToSuit;

use Api\Input\Request\Horses\GoingToSuit as Request;
use Tests\Stubs\Bo\GoingToSuit as Bo;

class RaceLevelTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @param Request\RaceLevel $request
     * @param array             $expectedResult
     *
     * @dataProvider providerTestGetRaceLevelSuccess
     */
    public function testGetRaceLevelSuccess(Request\RaceLevel $request, $expectedResult)
    {
        $bo = new Bo\RaceLevel($request);
        $actualResult = $bo->getRaceLevel();

        $this->assertEquals($expectedResult, $actualResult);
    }

    /**
     * @param Request\RaceLevel $request
     *
     * @expectedException \LogicException
     * @dataProvider providerTestGetRaceLevelFailure
     */
    public function testGetRaceLevelFailure(Request\RaceLevel $request)
    {
        $bo = new Bo\RaceLevel($request);
        $bo->getRaceLevel();
    }

    public function providerTestGetRaceLevelFailure()
    {
        return [
            [
                new Request\RaceLevel(['1900-01-01'])
            ]
        ];
    }

    public function providerTestGetRaceLevelSuccess()
    {
        return [
            [
                new Request\RaceLevel(['2017-04-10']),
                array(
                    0 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'race_instance_uid' => 672928,
                                'going_to_suit' => 'Y',
                            )
                        ),
                    1 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'race_instance_uid' => 672927,
                                'going_to_suit' => 'Y',
                            )
                        ),
                    2 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'race_instance_uid' => 672926,
                                'going_to_suit' => 'Y',
                            )
                        ),
                    3 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'race_instance_uid' => 672925,
                                'going_to_suit' => 'Y',
                            )
                        ),
                    4 =>
                        \Phalcon\Mvc\Model\Row\General::createFromArray(
                            array(
                                'race_instance_uid' => 671153,
                                'going_to_suit' => 'Y',
                            )
                        ),
                )
            ],

        ];
    }
}
