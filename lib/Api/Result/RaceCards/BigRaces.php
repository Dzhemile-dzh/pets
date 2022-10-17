<?php
/**
 * Created by PhpStorm.
 * User: Oleg_Symonchuk
 * Date: 10/13/2015
 * Time: 12:09 PM
 */

namespace Api\Result\RaceCards;

class BigRaces extends \Api\Result\Json
{

    /**
     * @return array
     */
    protected function getMappers()
    {
        return [
            'big_races' => '\Api\Output\Mapper\RaceCards\BigRaces',
        ];
    }
}
