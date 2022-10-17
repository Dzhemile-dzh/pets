<?php

/**
 * Created by PhpStorm.
 * User: Anton_Gurkovsky
 * Date: 8/31/2016
 * Time: 12:16 PM
 */

namespace Tests\Stubs\DataProvider\Bo\GoingToSuit;

use Api\Input\Request\Horses\GoingToSuit as Request;

class RaceLevel extends \Api\DataProvider\Bo\GoingToSuit\RaceLevel
{
    /**
     * @param Request\RaceLevel $request
     *
     * @return mixed
     */
    public function getRaceLevel(Request\RaceLevel $request)
    {
        $res = [
            '2017-04-10' => array(
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
            ),
            '1900-01-01' => null
        ];

        return $res[$request->getRaceDate()];
    }
}
